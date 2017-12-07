<?php
namespace ExpressiveMigrations\Commands;

use ExpressiveMigrations\Contracts\DatabaseManager;
use ExpressiveMigrations\Contracts\MigrationCommandContract;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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


    abstract public function process(InputInterface $input, OutputInterface $output);
    abstract public function describe();
}
