<?php

use Phinx\Migration\AbstractMigration;

class ChangeTitleNullAbleToPostsTable extends AbstractMigration
{
    private $tableName = 'posts';

    public function up()
    {
        $this->table($this->tableName)
            ->changeColumn('title', 'string', ['limit' => 50, 'null' => true, 'comment' => '標題'])
            ->changeColumn('describe', 'string', ['limit' => 255, 'null' => true, 'comment' => '內文'])
            ->changeColumn('advices', 'string', ['limit' => 255, 'null' => true, 'comment' => '審核意見'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->changeColumn('title', 'string', ['limit' => 255, 'null' => false, 'comment' => '標題'])
            ->changeColumn('describe', 'string', ['limit' => 255, 'null' => false, 'comment' => '描述'])
            ->changeColumn('advices', 'string', ['limit' => 255, 'null' => false, 'comment' => '審核意見'])
            ->save();
    }
}
