<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateVideoTagsTable extends AbstractMigration
{
    private $tableName = 'video_tags';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['site_video_id', 'tag_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台影片標籤',
        ]);

        $table->addColumn('site_video_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping site_videos.id'])
            ->addColumn('tag_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping tags.id'])
            ->save();

        $table->addForeignKey('site_video_id', 'site_videos', 'id', ['constraint' => "fk_{$this->tableName}_video_id"])
            ->addForeignKey('tag_id', 'tags', 'id', ['constraint' => "fk_{$this->tableName}_tag_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
