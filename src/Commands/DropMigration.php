<?php
namespace ExpressiveMigrations\Commands;

use ExpressiveMigrations\Contracts\DatabaseManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class DropMigration extends MigrationBaseCommand
{
    public function process(InputInterface $input, OutputInterface $output)
    {
        if(!$this->confirmAction($input, $output)) {
            return;
        }

        $migrateName = $input->getArgument('name');
        $this->getMigration($migrateName)
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
