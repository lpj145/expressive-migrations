<?php
namespace ExpressiveMigrations\Commands;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListMigrations extends MigrationBaseCommand
{
    const MIGRATION_INDEX = 'migrations';

    public function __construct($name, ContainerInterface $container)
    {
        parent::__construct($name, $container);
        $this->container = $container;
    }

    public function process(InputInterface $input, OutputInterface $output)
    {
        $migrations = $this->container->get('config')[self::MIGRATION_INDEX];

        $output->writeln('All migrations registered is:');
        $output->writeln($migrations);
        return $migrations;
    }

    public function describe()
    {
        $this
            ->setDescription('List all migrations registered');
    }
}
