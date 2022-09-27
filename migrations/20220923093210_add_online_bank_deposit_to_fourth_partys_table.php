<?php

use Phinx\Migration\AbstractMigration;

class AddOnlineBankDepositToFourthPartysTable extends AbstractMigration
{
    private $tableName = 'fourth_partys';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('online_bank_deposit', 'string', ['limit' => 255, 'null' => true, 'comment' => '網銀入款限定金額', 'after' => 'online_bank_deposit_min'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('online_bank_deposit')
            ->save();
    }
}
