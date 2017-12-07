<?php
namespace ExpressiveMigrations\Contracts;

interface MigrationContract
{
    public function up(SchemaBuilderContract $table);
    public function down(SchemaBuilderContract $table);
}
