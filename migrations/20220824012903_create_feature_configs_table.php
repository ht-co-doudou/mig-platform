<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateFeatureConfigsTable extends AbstractMigration
{
    private $tableName = 'feature_configs';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '功能開關設定',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('code', 'string', ['limit' => 50, 'comment' => '功能代碼'])
            ->addColumn('name', 'string', ['limit' => 50, 'comment' => '名稱'])
            ->addColumn('name_en', 'string', ['limit' => 50, 'null' => true, 'comment' => '英文名稱'])
            ->addColumn('status', 'string', ['limit' => 50, 'null' => true, 'comment' => '狀態'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->addIndex(['site_id', 'code'], ['unique' => true, 'name' => 'idx_site_id_code_unique'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
