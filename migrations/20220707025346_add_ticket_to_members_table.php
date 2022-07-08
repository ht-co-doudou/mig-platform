<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddTicketToMembersTable extends AbstractMigration
{
    private $tableName = 'members';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('ticket', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '觀影券', 'after' => 'diamond'])
            ->addColumn('line_code', 'string', ['limit' => 12, 'default' => 'default', 'comment' => '站點標示', 'after' => 'uid'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('ticket')
            ->removeColumn('line_code')
            ->save();
    }
}
