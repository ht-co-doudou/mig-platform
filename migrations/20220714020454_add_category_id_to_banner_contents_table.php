<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddCategoryIdToBannerContentsTable extends AbstractMigration
{
    private $tableName = 'banner_contents';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('category_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'null' => true, 'signed' => false, 'comment' => 'mapping categories.id', 'after' => 'banner_id'])
            ->save();

        $this->table($this->tableName)
            ->addForeignKey('category_id', 'categories', 'id', ['constraint' => "fk_{$this->tableName}_category_id"])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->dropForeignKey('category_id', "fk_{$this->tableName}_category_id")
            ->save();

        $this->table($this->tableName)
            ->removeColumn('category_id')
            ->save();
    }
}
