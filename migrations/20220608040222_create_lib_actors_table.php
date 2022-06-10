<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateLibActorsTable extends AbstractMigration
{
    const TABLE_NAME = 'lib_actors';

    public function up()
    {
        $table = $this->table(self::TABLE_NAME, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '片庫演員',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'identity' => true])
            ->addColumn('uid', 'char', ['limit' => 32, 'comment' => 'UUID'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '中文名字'])
            ->addColumn('name_en', 'string', ['limit' => 50, 'null' => true, 'comment' => '英文名字'])
            ->addColumn('name_jp', 'string', ['limit' => 30, 'null' => true, 'comment' => '日文名字'])
            ->addColumn('prefix', 'string', ['limit' => 1, 'null' => true, 'comment' => '名字英文字首'])
            ->addColumn('country', 'enum', ['values' => ['JP', 'CN', 'TW', 'KR', 'US', 'EU', 'OTHER'], 'null' => true, 'comment' => '國籍'])
            ->addColumn('avatar', 'string', ['limit' => 255, 'null' => true, 'comment' => '頭像'])
            ->addColumn('describe', 'text', ['null' => true, 'comment' => '介紹'])
            ->addColumn('display', 'boolean', ['default' => true, 'comment' => '是否顯示'])
            ->addColumn('cup', 'string', ['limit' => 2, 'null' => true, 'comment' => '罩杯'])
            ->addColumn('height', 'decimal', ['precision' => 4, 'scale' => 1, 'default' => 0, 'comment' => '身高'])
            ->addColumn('metadata', 'json', ['null' => true, 'comment' => '詳細資料'])
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
