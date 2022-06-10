<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateLibraryCategoriesTable extends AbstractMigration
{
    const TABLE_NAME = 'library_categories';

    public function up()
    {
        $table = $this->table(self::TABLE_NAME, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '片庫類別',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'identity' => true])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '類別名稱'])
            ->addColumn('name_en', 'string', ['limit' => 50, 'null' => true, 'comment' => '類別英文名稱'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable(static::TABLE_NAME)) {
            $this->table(static::TABLE_NAME)->drop()->save();
        }
    }
}
