<?php
namespace ExpressiveMigrations\Commands;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class ResetMigration extends MigrationBaseCommand
{
    public function process(InputInterface $input, OutputInterface $output)
    {
        if (!$this->confirmAction($input, $output))
        {
            return;
        }

        $dropCommand = $this->getApplication()->get('migrate:drop');

        foreach ($this->migrations as $migration) {
            $inputArgs = [
                'command' => 'migrate:drop',
                'name' => key($migration)
            ];

            $dropCommand->run(new ArrayInput($inputArgs), $output);
        }

        $output->writeln(sizeof($migrations).' are droped with success!');
    }

    public function describe()
    {
        $this
            ->setDescription('Reset all migrations on database, you lost all data');
    }

}
