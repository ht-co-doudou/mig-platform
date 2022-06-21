<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateBannerContentsTable extends AbstractMigration
{
    private $tableName = 'banner_contents';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '廣告版位內容',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('banner_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping banners.id'])
            ->addColumn('title', 'string', ['limit' => 255, 'comment' => '標題'])
            ->addColumn('title_en', 'string', ['limit' => 255, 'comment' => '英文標題'])
            ->addColumn('image', 'string', ['limit' => 255, 'comment' => '圖片'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '連結類型 BannerContent/Type'])
            ->addColumn('path', 'string', ['limit' => 255, 'null' => true, 'comment' => '路徑'])
            ->addColumn('order', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '排序'])
            ->addColumn('publish', 'boolean', ['comment' => '是否發布'])
            ->addColumn('start_at', 'timestamp', ['comment' => '開始時間'])
            ->addColumn('end_at', 'timestamp', ['null' => true, 'comment' => '結束時間'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->addForeignKey('banner_id', 'banners', 'id', ['constraint' => "fk_{$this->tableName}_banner_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
