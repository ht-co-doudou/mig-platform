<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddCreatorFollowToMembersTable extends AbstractMigration
{
    private $tableName = 'members';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('creator_follow', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0 ,'comment' => '追蹤創作者數', 'after' => 'delete_at'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('creator_follow')
            ->save();
    }
}
