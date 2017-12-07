### Expressive Migrations

When thinking create a new migrations class and implementations to migrations tool, i decide reuse migrations by SchemaBuilder and Blueprint on laravel packages, this a adapter, with basic commands to commit, reset, drop migrations on database.

Feel for free to ask, pr and critics.



##### ServiceManager is you friend!

On your domain service provider configure this to register a migration to global migrations space.
```
[
    'migrations' => [
        Namespace\Domain\Migrations\CreateTableUsers
    ]
]
```

After install this packages, if you have a `config/config.php` he ask you if you can install, press 'y', be happy!