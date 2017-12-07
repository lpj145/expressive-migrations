<?php
namespace ExpressiveMigrations\Commands;

use ExpressiveMigrations\Contracts\DatabaseManager;
use ExpressiveMigrations\Contracts\MigrationCommandContract;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

abstract class MigrationBaseCommand extends Command implements MigrationCommandContract
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct($name, ContainerInterface $container)
    {
        parent::__construct($name);
        $this->container = $container;
    }

    protected function configure()
    {
        return $this->describe();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return $this->process($input, $output);
    }

    protected function getMigration(string $migrateName)
    {
        if (!class_exists($migrateName)) {
            throw new \ErrorException($migrateName.' not found on registered migrations!');
        }
        return new $migrateName($this->container->get(DatabaseManager::class));
    }

    protected function confirmAction(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Continue this action? you data can be lost! (y,n)');
        return $helper->ask($input, $output, $question);
    }

    protected function getAllMigrations()
    {
        $migrationsWithoutNamespace = [];
        $migrations = $this->container->get('config')['migrations'] ?? [];
        foreach ($migrations as $migration) {
            $migrationsWithoutNamespace[] = (new \ReflectionClass($migration))->getShortName();
        }
        return $migrationsWithoutNamespace;
    }


    abstract public function process(InputInterface $input, OutputInterface $output);
    abstract public function describe();
}
