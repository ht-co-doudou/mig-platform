<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{
    private $tableName = 'posts';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '貼文',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('creator_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping creators.id'])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('title', 'string', ['limit' => 255, 'comment' => '貼文標題'])
            ->addColumn('describe', 'string', ['limit' => 50, 'comment' => '貼文內容'])
            ->addColumn('advices', 'string', ['limit' => 255, 'comment' => '審核意見'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '貼文類型'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '貼文狀態'])
            ->addColumn('diamond', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '付費豆豆幣'])
            ->addColumn('likes', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '按讚數'])
            ->addColumn('views', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '觀看數'])
            ->addColumn('follow', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '追縱數'])
            ->addColumn('pay', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '購買數'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex(['site_id', 'creator_id'], ['name' => 'idx_site_id_creator_id'])
            ->addIndex(['creator_id', 'create_at'], ['name' => 'idx_creator_id_create_at'])
            ->save();

        $table->addForeignKey('creator_id', 'creators', 'id', ['constraint' => "fk_{$this->tableName}_creator_id"])
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
