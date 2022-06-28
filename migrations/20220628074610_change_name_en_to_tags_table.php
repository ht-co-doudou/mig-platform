<?php

use Phinx\Migration\AbstractMigration;

class ChangeNameEnToTagsTable extends AbstractMigration
{
    private $tableName = 'tags';

    public function up()
    {

        $this->table($this->tableName)
            ->changeColumn('name_en', 'string', ['null' => true, 'limit' => 30, 'comment' => '英文名稱'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->changeColumn('name_en', 'string', ['limit' => 30, 'comment' => '英文名稱'])
            ->save();
    }
}
