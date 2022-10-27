<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateCreatorFollowsTable extends AbstractMigration
{
    private $tableName = 'creator_follows';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['creator_id', 'member_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '創作者粉絲/追隨',
        ]);

        $table->addColumn('creator_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping creators.id'])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addIndex(['create_at', 'member_id'], ['name' => 'idx_create_at_member_id'])
            ->save();

        $table->addForeignKey('creator_id', 'creators', 'id', ['constraint' => "fk_{$this->tableName}_creator_id"])
            ->addForeignKey('member_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_member_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
