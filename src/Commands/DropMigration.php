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
        $migrateName = $input->getArgument('name');
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Do you can continue this action ?');

        if (!$helper->ask($input, $output, $question)) {
            return;
        }

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
