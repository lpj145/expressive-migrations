<?php
namespace ExpressiveMigrations\Contracts;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface MigrationCommandContract
{
    public function process(InputInterface $input, OutputInterface $output);
    public function describe();
}
