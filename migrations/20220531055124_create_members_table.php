<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateMembersTable extends AbstractMigration
{
    private $tableName = 'members';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '會員',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('parent_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'null' => true, 'comment' => 'mapping members.id'])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('uid', 'char', ['limit' => 32, 'comment' => 'UUID'])
            ->addColumn('name', 'string', ['limit' => 30, 'null' => true, 'comment' => '真實姓名'])
            ->addColumn('username', 'string', ['limit' => 30, 'comment' => '帳號'])
            ->addColumn('mobile', 'string', ['null' => true, 'limit' => 30, 'comment' => '手機號碼'])
            ->addColumn('nickname', 'string', ['limit' => 30, 'comment' => '暱稱'])
            ->addColumn('password', 'string', ['limit' => 60, 'comment' => '密碼'])
            ->addColumn('withdraw_password', 'string', ['limit' => 60, 'null' => true, 'comment' => '出款密碼'])
            ->addColumn('balance', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '餘額'])
            ->addColumn('lien', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '圈存金額'])
            ->addColumn('token_coin', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '豆豆幣餘額'])
            ->addColumn('live_expire_at', 'timestamp', ['null' => true, 'comment' => '觀影到期時間'])
            ->addColumn('first_deposit_amount', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'default' => 0, 'comment' => '首存金額'])
            ->addColumn('first_deposit_at', 'timestamp', ['null' => true, 'comment' => '首存時間'])
            ->addColumn('first_withdraw_amount', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'default' => 0, 'comment' => '首提金額'])
            ->addColumn('first_withdraw_at', 'timestamp', ['null' => true, 'comment' => '首提時間'])
            ->addColumn('last_login_ip', 'varbinary', ['limit' => 16, 'null' => true, 'comment' => '最後登入 IP'])
            ->addColumn('last_login_at', 'timestamp', ['null' => true, 'comment' => '最後登入時間'])
            ->addColumn('register_domain', 'string', ['limit' => 255, 'comment' => '註冊域名'])
            ->addColumn('register_ip', 'varbinary', ['limit' => 16, 'comment' => '註冊 IP'])
            ->addColumn('register_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '註冊時間'])
            ->addColumn('delete_at', 'timestamp', ['null' => true, 'comment' => '刪除時間'])
            ->addColumn('metadata', 'json', ['comment' => '會員資訊'])
            ->addColumn('note', 'string', ['limit' => 255, 'null' => true, 'comment' => '後台備註'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 Member/Type'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 Member/Status'])
            ->save();

        $table->addIndex('uid', ['unique' => true, 'name' => 'idx_uid_unique'])
            ->addIndex(['site_id', 'username'], ['unique' => true, 'name' => 'idx_site_id_username_unique'])
            ->addIndex(['site_id', 'mobile'], ['unique' => true, 'name' => 'idx_site_id_mobile_unique'])
            ->save();

        $table->addForeignKey('parent_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_parent_id"])
            ->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
