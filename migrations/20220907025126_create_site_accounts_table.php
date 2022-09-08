<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSiteAccountsTable extends AbstractMigration
{
    private $tableName = 'site_accounts';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台銀行帳號',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('bank_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping banks.id'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '名稱'])
            ->addColumn('number', 'string', ['limit' => 30, 'comment' => '銀行卡號'])
            ->addColumn('holder', 'string', ['limit' => 30, 'comment' => '開戶人'])
            ->addColumn('deposit_max', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '入款上限'])
            ->addColumn('deposit_min', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '入款下限'])
            ->addColumn('remark', 'string', ['limit' => 255, 'null' => true, 'comment' => '前台備註'])
            ->addColumn('note', 'string', ['limit' => 255, 'null' => true, 'comment' => '後台備註'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 SiteAccount/Status'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->addForeignKey('bank_id', 'banks', 'id', ['constraint' => "fk_{$this->tableName}_bank_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
