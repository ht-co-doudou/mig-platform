<?php

use Phinx\Migration\AbstractMigration;

class AddScopeToFeatureConfigsTable extends AbstractMigration
{
    private $tableName = 'feature_configs';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('scope', 'string', ['limit' => 50, 'null' => true, 'comment' => '適用範圍', 'after' => 'code'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('scope')
            ->save();
    }
}
