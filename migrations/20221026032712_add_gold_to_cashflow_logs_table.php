<?php

use Phinx\Migration\AbstractMigration;

class AddGoldToCashflowLogsTable extends AbstractMigration
{
    private $tableName = 'cashflow_logs';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('gold', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '金豆子餘額', 'after' => 'diamond'])
            ->addColumn('gold_change', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '金豆子異動', 'after' => 'diamond_change'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('gold')
            ->removeColumn('gold_change')
            ->save();
    }
}
