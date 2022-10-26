<?php

use Phinx\Migration\AbstractMigration;

class AddGoldToMembersTable extends AbstractMigration
{
    private $tableName = 'members';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('gold', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '金豆子餘額', 'after' => 'diamond'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('gold')
            ->save();
    }
}
