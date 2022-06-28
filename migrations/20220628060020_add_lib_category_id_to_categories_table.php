<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddLibCategoryIdToCategoriesTable extends AbstractMigration
{
    private $tableName = 'categories';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('lib_category_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '片庫分類id', 'after' => 'id'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('lib_category_id')
            ->save();
    }
}
