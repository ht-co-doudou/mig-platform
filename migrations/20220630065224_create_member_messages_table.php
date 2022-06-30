<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateMemberMessagesTable extends AbstractMigration
{
    private $tableName = 'member_messages';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['member_id', 'message_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '會員站內信',
        ]);

        $table->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('message_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping messages.id'])
            ->addColumn('read', 'boolean', ['comment' => '是否已讀'])
            ->save();

        $table->addForeignKey('member_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_member_id", 'delete' => 'CASCADE'])
            ->addForeignKey('message_id', 'messages', 'id', ['constraint' => "fk_{$this->tableName}_message_id", 'delete' => 'CASCADE'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
