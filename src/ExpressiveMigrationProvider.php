<?php
namespace ExpressiveMigrations;

use ExpressiveMigrations\Commands\AllMigrations;
use ExpressiveMigrations\Commands\CreateMigration;
use ExpressiveMigrations\Commands\DropMigration;
use ExpressiveMigrations\Commands\ListMigrations;
use ExpressiveMigrations\Commands\ResetMigration;
use ExpressiveMigrations\Migrations\BaseMigrationFactory;
use ExpressiveMigrations\Migrations\BaseMigrations;

class ExpressiveMigrationProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    BaseMigrations::class => BaseMigrationFactory::class
                ],
            ],
            'commands' => [
                'migrate' => ListMigrations::class,
                'migrate:migrate' => AllMigrations::class,
                'migrate:commit' => CreateMigration::class,
                'migrate:drop' => DropMigration::class,
                'migrate:reset' => ResetMigration::class,
            ]
        ];
    }
}
