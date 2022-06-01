<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateLoginLogsTable extends AbstractMigration
{
    private $tableName = 'login_logs';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '會員登入紀錄',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('ip', 'varbinary', ['limit' => 16, 'comment' => '登入 IP'])
            ->addColumn('domain', 'string', ['limit' => 255, 'comment' => '登入域名'])
            ->addColumn('area', 'string', ['limit' => 50, 'null' => true,  'comment' => '登入地區'])
            ->addColumn('browser', 'string', ['limit' => 50, 'null' => true, 'comment' => '登入瀏覽器'])
            ->addColumn('os', 'string', ['limit' => 50, 'null' => true, 'comment' => '登入作業系統'])
            ->addColumn('device_type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 LoginLog/DeviceType'])
            ->addColumn('login_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '登入時間'])
            ->save();

        $table->addIndex('site_id', ['name' => 'idx_site_id'])
            ->addIndex('member_id', ['name' => 'idx_member_id'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
