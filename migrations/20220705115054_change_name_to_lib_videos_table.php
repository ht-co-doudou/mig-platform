<?php

use Phinx\Migration\AbstractMigration;

class ChangeNameToLibVideosTable extends AbstractMigration
{
    const TABLE_NAME = 'lib_videos';

    public function up()
    {
        $this->table(self::TABLE_NAME)
            ->changeColumn('name', 'string', ['limit' => 255, 'comment' => '影片名稱'])
            ->changeColumn('name_en', 'string', ['limit' => 255, 'null' => true, 'comment' => '影片英文名稱'])
            ->save();
    }

    public function down()
    {
        $this->table(self::TABLE_NAME)
            ->changeColumn('name', 'string', ['limit' => 30, 'comment' => '影片名稱'])
            ->changeColumn('name_en', 'string', ['limit' => 50, 'null' => true, 'comment' => '影片英文名稱'])
            ->save();
    }
}
