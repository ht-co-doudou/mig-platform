<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateStaticPagesTable extends AbstractMigration
{
    private $tableName = 'static_pages';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '靜態頁面(文案)',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('code', 'string', ['limit' => 30, 'comment' => '靜態頁面代碼'])
            ->addColumn('title', 'string', ['limit' => 255, 'comment' => '標題'])
            ->addColumn('title_en', 'string', ['limit' => 255, 'comment' => '英文標題'])
            ->addColumn('content', 'text', ['comment' => '內容'])
            ->addColumn('content_en', 'text', ['comment' => '英文內容'])
            ->addColumn('publish', 'boolean', ['comment' => '是否發布'])
            ->addColumn('order', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '排序'])
            ->addColumn('is_help_center', 'boolean', ['default' => false, 'comment' => '是否為幫助中心文案'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
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
