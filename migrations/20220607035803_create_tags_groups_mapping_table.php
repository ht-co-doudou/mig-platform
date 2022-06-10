<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateTagsGroupsMappingTable extends AbstractMigration
{
    private $tableName = 'tags_groups_mapping';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['group_id', 'tag_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台標籤所屬群組',
        ]);

        $table->addColumn('group_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping tag_groups.id'])
            ->addColumn('tag_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping tags.id'])
            ->save();

        $table->addForeignKey('group_id', 'tag_groups', 'id', ['constraint' => "fk_{$this->tableName}_group_id"])
            ->addForeignKey('tag_id', 'tags', 'id', ['constraint' => "fk_{$this->tableName}_tag_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
