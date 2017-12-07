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
        $migrationsSuccess = 0;
        $createCommand = $this->getApplication()->get('migrate:commit');

        foreach ($this->migrations as $migrationName => $migration) {
            $inputArgs = new ArrayInput([
                'command' => 'migrate:commit',
                'name' => $migrationName
            ]);

            $createCommand->run($inputArgs, $output);
            $migrationsSuccess++;
        }

        $output->writeln($migrationsSuccess.' are migrated!');

        return sizeof($this->migrations);
    }

    public function describe()
    {
        $this
            ->setDescription('Migrate all migrations registered!');
    }

}