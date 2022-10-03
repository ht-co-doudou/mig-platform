<?php

use Phinx\Migration\AbstractMigration;

class AddDiamondToTxOrdersTable extends AbstractMigration
{
    private $tableName = 'vendor_tx_orders';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('amount_diamond', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '交易鑽石', 'after' => 'lien'])
            ->addColumn('diamond', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '鑽石餘額', 'after' => 'amount_diamond'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('diamond')
            ->save();
    }
}
