<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSiteCategoriesTable extends AbstractMigration
{
    private $tableName = 'site_categories';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台片庫分類設定',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('category_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => '片庫分類id'])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('display', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '是否顯示'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex(['category_id', 'site_id'], ['unique' => true, 'name' => 'idx_category_id_site_id_unique'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
