<?php

use Phinx\Migration\AbstractMigration;

class ChangeBannersUniqueIndex extends AbstractMigration
{
    private $tableName = 'banners';

    public function up()
    {
        $this->table($this->tableName)
            ->removeIndexByName('idx_show_on_type_unique')
            ->addIndex(['site_id', 'show_on', 'type'], ['unique' => true, 'name' => 'idx_site_id_show_on_type_unique'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeIndexByName('idx_site_id_show_on_type_unique')
            ->addIndex(['show_on', 'type'], ['unique' => true, 'name' => 'idx_show_on_type_unique'])
            ->save();
    }
}
