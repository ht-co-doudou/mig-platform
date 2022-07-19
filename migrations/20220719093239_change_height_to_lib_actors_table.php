<?php

use Phinx\Migration\AbstractMigration;

class ChangeHeightToLibActorsTable extends AbstractMigration
{
    const TABLE_NAME = 'lib_actors';

    public function up()
    {
        $this->table(self::TABLE_NAME)
            ->changeColumn('height', 'integer', ['limit' => 32, 'null' => true, 'comment' => '身高'])
            ->save();
    }

    public function down()
    {
        $this->table(self::TABLE_NAME)
            ->changeColumn('height', 'decimal', ['precision' => 4, 'scale' => 1, 'default' => 0, 'comment' => '身高'])
            ->save();
    }
}
