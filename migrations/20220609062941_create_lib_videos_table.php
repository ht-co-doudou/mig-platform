<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateLibVideosTable extends AbstractMigration
{
    const TABLE_NAME = 'lib_videos';

    public function up()
    {
        $table = $this->table(self::TABLE_NAME, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '片庫影片',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'identity' => true])
            ->addColumn('uid', 'char', ['limit' => 32, 'comment' => 'UUID'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '影片名稱'])
            ->addColumn('name_en', 'string', ['limit' => 50, 'null' => true, 'comment' => '影片英文名稱'])
            ->addColumn('category_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'comment' => '類別Id'])
            ->addColumn('cover', 'string', ['limit' => 255, 'null' => true, 'comment' => '封面'])
            ->addColumn('preview', 'string', ['limit' => 255, 'null' => true, 'comment' => '預覽影片'])
            ->addColumn('video', 'string', ['limit' => 255, 'null' => true, 'comment' => '影片'])
            ->addColumn('describe', 'string', ['limit' => 255, 'null' => true, 'comment' => '影片介紹'])
            ->addColumn('display', 'boolean', ['default' => false, 'comment' => '是否顯示'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex('uid', ['unique' => true, 'name' => 'idx_uid_unique'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable(static::TABLE_NAME)) {
            $this->table(static::TABLE_NAME)->drop()->save();
        }
    }
}
