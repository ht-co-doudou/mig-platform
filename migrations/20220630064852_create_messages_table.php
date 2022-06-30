<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateMessagesTable extends AbstractMigration
{
    private $tableName = 'messages';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站內信',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 Message/Type'])
            ->addColumn('title', 'string', ['limit' => 255, 'comment' => '標題'])
            ->addColumn('title_en', 'string', ['limit' => 255, 'comment' => '英文標題'])
            ->addColumn('content', 'text', ['comment' => '內容'])
            ->addColumn('content_en', 'text', ['comment' => '英文內容'])
            ->addColumn('publish', 'boolean', ['comment' => '是否發布'])
            ->addColumn('publish_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '自動發佈時間'])
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
