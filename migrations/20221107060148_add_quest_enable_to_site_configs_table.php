<?php

use Phinx\Migration\AbstractMigration;

class AddQuestEnableToSiteConfigsTable extends AbstractMigration
{
    private $tableName = 'site_configs';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('quest_enable', 'boolean', ['default' => true, 'comment' => '是否開啟任務'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('quest_enable')
            ->save();
    }
}
