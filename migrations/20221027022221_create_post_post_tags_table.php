<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePostPostTagsTable extends AbstractMigration
{
    private $tableName = 'post_post_tags';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['post_tag_id', 'post_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '貼文標籤',
        ]);

        $table->addColumn('post_tag_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping post_tags.id'])
            ->addColumn('post_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping posts.id'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addForeignKey('post_tag_id', 'post_tags', 'id', ['constraint' => "fk_{$this->tableName}_post_tag_id"])
            ->addForeignKey('post_id', 'posts', 'id', ['constraint' => "fk_{$this->tableName}_post_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
