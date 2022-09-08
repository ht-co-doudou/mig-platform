<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSiteThirdPartysTable extends AbstractMigration
{
    private $tableName = 'site_third_partys';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台三方支付帳號',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '名稱'])
            ->addColumn('number', 'string', ['limit' => 30, 'comment' => '微信號、QQ號...'])
            ->addColumn('holder', 'string', ['limit' => 30, 'comment' => '帳號持有人'])
            ->addColumn('qr_code', 'string', ['limit' => 255, 'null' => true, 'comment' => 'QR Code 圖片'])
            ->addColumn('deposit_max', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '入款上限'])
            ->addColumn('deposit_min', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '入款下限'])
            ->addColumn('remark', 'string', ['limit' => 255, 'null' => true, 'comment' => '前台備註'])
            ->addColumn('note', 'string', ['limit' => 255, 'null' => true, 'comment' => '後台備註'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 SiteThirdParty/Type'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 SiteThirdParty/Status'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
