<?php
namespace ExpressiveMigrations\Commands;

use ExpressiveMigrations\Contracts\DatabaseManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateMigration extends MigrationBaseCommand
{
    public function process(InputInterface $input, OutputInterface $output)
    {
        $migrateName = $input->getArgument('name');
        (new $migrateName($this->container->get(DatabaseManager::class)))
            ->commit();
    }

    public function describe()
    {
        $this
            ->setDescription('Create migration from \'migrations\' on container registered')
            ->setHelp('migrate "CreateUsersTable"')
            ->addArgument('name', InputArgument::REQUIRED, 'name of migrate is required')
            ->setAliases('createMigration')
            ->addUsage('migrate CreateUsersTable');
    }

}
