<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateVideoActorsTable extends AbstractMigration
{
    private $tableName = 'video_actors';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['site_video_id', 'site_actor_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台影片演員',
        ]);

        $table->addColumn('site_video_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping site_videos.id'])
            ->addColumn('site_actor_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping site_actors.id'])
            ->save();

        $table->addForeignKey('site_video_id', 'site_videos', 'id', ['constraint' => "fk_{$this->tableName}_video_id"])
            ->addForeignKey('site_actor_id', 'site_actors', 'id', ['constraint' => "fk_{$this->tableName}_actor_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
