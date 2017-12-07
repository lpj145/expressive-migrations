<?php
namespace ExpressiveMigrations\Migrations;

use ExpressiveMigrations\Contracts\DatabaseManager;
use Psr\Container\ContainerInterface;

class BaseMigrationFactory
{
    public function __invoke(ContainerInterface $container, $instance)
    {
        return new $instance($container->get(DatabaseManager::class));
    }
}
