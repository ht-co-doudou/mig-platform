<?php

use Phinx\Migration\AbstractMigration;

class ChangeTitleEnToMessagesTable extends AbstractMigration
{
    const TABLE_NAME = 'messages';

    public function up()
    {
        $this->table(self::TABLE_NAME)
            ->changeColumn('title_en', 'string', ['limit' => 255, 'null' => true, 'comment' => '英文標題'])
            ->changeColumn('content_en', 'string', ['limit' => 255, 'null' => true, 'comment' => '英文內容'])
            ->save();
    }

    public function down()
    {
        $this->table(self::TABLE_NAME)
            ->changeColumn('title_en', 'string', ['limit' => 255, 'comment' => '英文標題'])
            ->changeColumn('content_en', 'string', ['limit' => 255, 'comment' => '英文內容'])
            ->save();
    }
}
