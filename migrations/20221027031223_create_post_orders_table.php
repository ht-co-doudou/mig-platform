<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePostOrdersTable extends AbstractMigration
{
    private $tableName = 'post_orders';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['post_id', 'depositor_id', 'withdrawer_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '貼文購買訂單',
        ]);

        $table->addColumn('depositor_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('withdrawer_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('post_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping posts.id'])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('order_id', 'string', ['limit' => 50, 'comment' => '訂單 ID'])
            ->addColumn('diamond', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '轉出豆豆幣'])
            ->addColumn('gold', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '轉入金豆幣'])
            ->addColumn('detail', 'json', ['null' => true, 'comment' => '購買紀錄詳細'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addForeignKey('depositor_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_depositor_id"])
            ->addForeignKey('withdrawer_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_withdrawer_id"])
            ->addForeignKey('post_id', 'posts', 'id', ['constraint' => "fk_{$this->tableName}_post_id"])
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
