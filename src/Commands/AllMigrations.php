<?php
namespace ExpressiveMigrations\Commands;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

class AllMigrations extends MigrationBaseCommand
{
    public function process(InputInterface $input, OutputInterface $output)
    {
        $getAllCommand = $this->getApplication()->get('migrate');
        $createCommand = $this->getApplication()->get('migrate:commit');
        $migrations = $getAllCommand->execute(new ArrayInput([]), new NullOutput());

        foreach ($migrations as $migration) {
            $inputArgs = new ArrayInput([
                'command' => 'migrate:commit',
                'name' => $migration
            ]);

            $createCommand->run($inputArgs, $output);
        }

        $output->writeln(sizeof($migrations).' are migrated!');

        return sizeof($migrations);
    }

    public function describe()
    {
        $this
            ->setDescription('Migrate all migrations registered!');
    }

}