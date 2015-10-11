<?php
/**
 * Created by PhpStorm.
 * User: tebazil
 * Date: 16.08.15
 * Time: 23:26
 */

namespace tebazil\yii2seeder;
use tebazil\dbseeder\Generator;
use tebazil\dbseeder\GeneratorConfigurator;
use yii\db\Connection;
use yii\db\Migration;
use yii\di\Instance;

class Seeder extends \tebazil\dbseeder\Seeder
{
    /**
     * @var Connection
     */
    private $db;
    public function __construct($db = 'db')
    {
        $this->db = Instance::ensure($db, Connection::className());
        $this->generator = new Generator();
        $this->dbHelper = new Migration([
            'db'=>$this->db
        ]);
	$this->generatorConfigurator = new GeneratorConfigurator();
    }

    public function table($yiiTableName)
    {
        $table = $this->db->schema->getRawTableName($yiiTableName);
        return parent::table($table);
    }


}