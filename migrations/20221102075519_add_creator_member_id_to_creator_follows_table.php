<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddCreatorMemberIdToCreatorFollowsTable extends AbstractMigration
{
    private $tableName = 'creator_follows';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('creator_member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false,'comment' => 'mapping members.id', 'after' => 'creator_id'])
            ->save();

        $this->table($this->tableName)
            ->addForeignKey('creator_member_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_creator_member_id"])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->dropForeignKey('creator_member_id', "fk_{$this->tableName}_creator_member_id")
            ->save();

        $this->table($this->tableName)
            ->removeColumn('_creator_member_id')
            ->save();
    }
}
