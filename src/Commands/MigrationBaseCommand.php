<?php
namespace ExpressiveMigrations\Commands;

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
        $this->describe();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->process($input, $output);
    }


    abstract public function process(InputInterface $input, OutputInterface $output);
    abstract public function describe();
}
