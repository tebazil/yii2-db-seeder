# Yii2 Db Seeder

Yii2 Db seeder is a Yii2 adapter for [Php db seeder](http://github.com/tebazil/db-seeder), which is a tool to quickly populate database with fake data on demand. Great for using in a console application - you can easily refresh your fake data on demand.


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require tebazil/yii2-db-seeder
```

or add

```
"tebazil/yii2-db-seeder": "*"
```

to the `require` section of your `composer.json` file.

## Quick start

You can quickly seed your database with generated data with something like this:

```php
$seeder = new \tebazil\yii2seeder\Seeder();
$generator = $seeder->getGeneratorConfigurator();
$faker = $generator->getFakerConfigurator();

$seeder->table('article')->columns([
    'id', //automatic pk
    'book_id', //automatic fk
    'name'=>$faker->firstName,
    'content'=>$faker->text
        ])->rowQuantity(30);


$seeder->table('book')->columns([
    'id',
    'name'=>$faker->text(20),
])->rowQuantity(30);

$seeder->table('category')->columns([
    'id',
    'book_id',
    'name'=>$faker->text(20),
    'type'=>$faker->randomElement(['shop','cv','test']),
])->rowQuantity(30);

$seeder->refill();
```

Best way to do run this is in console application - then you would be able to run this initially, fix upon database changes and re-run, optionally changing `rowQuantity` and commenting out tables you do not want to refill at the time, like user table.

You can also run this console command in autodeploy hook on dev server, not forgetting to keep it up to date with current migrations.

Please review the [Php db seeder](http://github.com/tebazil/db-seeder) for extended documentation on usage. 

##Differences from original library
- With `Yii2 Db Seeder` you do not need to provide database configuration by default, it uses `Yii::$app->db` to retrieve connection information. 
You can optionally provide seeder with a database connection component name. You do that like:

```php
$seeder = new \tebazil\yii2seeder\Seeder('db2');
```

There. Seeder would be using `Yii::$app->db2` now.

- You can use standart yii wildcards for prefixed table names, like `{{%table_name}}`.



