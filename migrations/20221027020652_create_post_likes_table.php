<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePostLikesTable extends AbstractMigration
{
    private $tableName = 'post_likes';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['post_id', 'member_id', 'type'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '貼文',
        ]);

        $table->addColumn('post_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '0:讚,1:收藏'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addForeignKey('post_id', 'posts', 'id', ['constraint' => "fk_{$this->tableName}_post_id"])
            ->addForeignKey('member_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_member_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
