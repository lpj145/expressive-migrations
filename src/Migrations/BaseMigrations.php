<?php
namespace ExpressiveMigrations\Migrations;

use ExpressiveMigrations\Contracts\DatabaseManager;
use ExpressiveMigrations\Contracts\SchemaBuilderContract;

abstract class BaseMigrations
{
    /**
     * @var string
     */
    protected $tableName;
    /**
     * @var SchemaBuilderContract
     */
    private $schema;

    /**
     * BaseMigrations constructor.
     * Pass Capsule Manager by laravel
     * @param $table
     * @throws \ErrorException
     */
    public function __construct($table)
    {
        if (!$this->tableName) {
            throw new \ErrorException(get_class($this).' tableName property is empty');
        }

        $this->schema = $table->getDatabaseManager()->getSchemaBuilder();
    }

    public function commit()
    {
        $this->schema->create($this->tableName, function ($table){
           return $this->up($table);
        });
    }

    public function drop()
    {
        return $this->schema->drop($this->tableName);
    }


    abstract protected function up($table);
    abstract protected function down($table);

}
