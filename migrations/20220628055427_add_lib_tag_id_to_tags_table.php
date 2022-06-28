<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddLibTagIdToTagsTable extends AbstractMigration
{
    private $tableName = 'tags';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('lib_tag_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '片庫標籤id', 'after' => 'id'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('lib_tag_id')
            ->save();
    }
}
