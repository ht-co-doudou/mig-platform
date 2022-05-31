<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSiteConfigsTable extends AbstractMigration
{
    private $tableName = 'site_configs';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'site_id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台設定',
        ]);

        $table->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('kick_before_enable', 'boolean', ['comment' => '是否開啟登入後踢前'])
            ->addColumn('demo_enable', 'boolean', ['comment' => '是否開啟試玩（訪客帳號登入）'])
            ->addColumn('register_enable', 'boolean', ['comment' => '是否開啟註冊'])
            ->addColumn('invite_enable', 'boolean', ['comment' => '是否開啟會員邀請'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id", 'delete' => 'CASCADE'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
