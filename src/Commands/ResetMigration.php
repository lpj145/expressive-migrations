<?php
namespace ExpressiveMigrations\Commands;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

class ResetMigration extends MigrationBaseCommand
{
    public function process(InputInterface $input, OutputInterface $output)
    {
        $getAllMigrationsCommand = $this->getApplication()->get('getAllMigrations');
        $migrations = $getAllMigrationsCommand->execute(new ArrayInput([]), new NullOutput());
        $dropCommand = $this->getApplication()->get('dropMigration');

        foreach ($migrations as $migration) {
            $inputArgs = [
                'command' => 'dropMigration',
                'name' => $migration
            ];

            $dropCommand->execute($inputArgs, $output);
        }

        $output->writeln(sizeof($migrations).' are droped with success!');
    }

    public function describe()
    {
        $this
            ->setDescription('Reset all migrations on database, you lost all data');
    }

}
