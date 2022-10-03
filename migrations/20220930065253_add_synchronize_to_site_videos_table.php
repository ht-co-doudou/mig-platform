<?php

use Phinx\Migration\AbstractMigration;

class AddSynchronizeToSiteVideosTable extends AbstractMigration
{
    private $tableName = 'site_videos';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('synchronize', 'boolean', ['default' => true, 'comment' => '是否要與片庫同步', 'after' => 'hot'])
            ->addColumn('edit_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '後台更新時間'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('synchronize')
            ->removeColumn('edit_at')
            ->save();
    }
}
