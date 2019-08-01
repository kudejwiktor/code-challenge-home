<?php

use Phinx\Migration\AbstractMigration;
use \Phinx\Db\Adapter\MysqlAdapter;

class CreateLocationTable extends AbstractMigration
{
    public function change()
    {
        $this->table('location', ['id' => false])
            ->addColumn('id', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 36])
            ->addColumn('name', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 100])
            ->addColumn('street', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 64, 'null' => true])
            ->addColumn('postal_code', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 6])
            ->addColumn('suite_number', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 6])
            ->addColumn('city', MysqlAdapter::PHINX_TYPE_STRING, ['limit' => 64])
            ->addColumn('latitude', MysqlAdapter::PHINX_TYPE_FLOAT, [
                'precision' => 10,
                'scale' => 6
            ])
            ->addColumn('longitude', MysqlAdapter::PHINX_TYPE_FLOAT, [
                'precision' => 10,
                'scale' => 6
            ])
            ->create();
    }
}
