<?php
namespace ExpressiveMigrations\Commands;

use ExpressiveMigrations\Contracts\DatabaseManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DropMigration extends MigrationBaseCommand
{
    public function process(InputInterface $input, OutputInterface $output)
    {
        $migrateName = $input->getArgument('name');
        $input->setInteractive(true);
        (new $migrateName($this->container->get(DatabaseManager::class)))
            ->drop();

        $output->writeln($migrateName.' drop with success!');
    }

    public function describe()
    {
        $this
            ->setDescription('Drop migration by migration name')
            ->addArgument('name', InputArgument::REQUIRED, 'migration name');
    }

}
