<?php

use Phinx\Seed\AbstractSeed;

class RequiredPermissionSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            ['code' => 'admin.view', 'name' => '总管帐号', 'allow' => 1],
            ['code' => 'admin.create', 'name' => '总管帐号-新增', 'allow' => 1],
            ['code' => 'admin.update', 'name' => '总管帐号-编辑', 'allow' => 1],
            ['code' => 'admin.delete', 'name' => '总管帐号-删除', 'allow' => 1],
            ['code' => 'admin.export', 'name' => '总管帐号-汇出', 'allow' => 1],
            ['code' => 'admin.recycle', 'name' => '总管帐号-回收站', 'allow' => 1],
            ['code' => 'admin.recycle_operate', 'name' => '总管帐号-回收站-还原', 'allow' => 1],
            ['code' => 'webmaster.view', 'name' => '版主帐号', 'allow' => 7],
            ['code' => 'webmaster.create', 'name' => '版主帐号-新增', 'allow' => 7],
            ['code' => 'webmaster.update', 'name' => '版主帐号-编辑', 'allow' => 7],
            ['code' => 'webmaster.delete', 'name' => '版主帐号-删除', 'allow' => 7],
            ['code' => 'webmaster.export', 'name' => '版主帐号-汇出', 'allow' => 7],
            ['code' => 'webmaster.recycle', 'name' => '版主帐号-回收站', 'allow' => 7],
            ['code' => 'webmaster.recycle_operate', 'name' => '版主帐号-回收站-还原', 'allow' => 7],
            ['code' => 'webmaster_sub.view', 'name' => '版主子帐号', 'allow' => 15],
            ['code' => 'webmaster_sub.create', 'name' => '版主子帐号-新增', 'allow' => 15],
            ['code' => 'webmaster_sub.update', 'name' => '版主子帐号-编辑', 'allow' => 15],
            ['code' => 'webmaster_sub.delete', 'name' => '版主子帐号-删除', 'allow' => 15],
            ['code' => 'webmaster_sub.export', 'name' => '版主子帐号-汇出', 'allow' => 15],
            ['code' => 'webmaster_sub.recycle', 'name' => '版主子帐号-回收站', 'allow' => 15],
            ['code' => 'webmaster_sub.recycle_operate', 'name' => '版主子帐号-回收站-还原', 'allow' => 15],
            ['code' => 'member.view', 'name' => '会员帐号', 'allow' => 15],
            ['code' => 'member.create', 'name' => '会员帐号-新增', 'allow' => 11],
            ['code' => 'member.update', 'name' => '会员帐号-编辑', 'allow' => 11],
            ['code' => 'member.delete', 'name' => '会员帐号-删除', 'allow' => 11],
            ['code' => 'member.export', 'name' => '会员帐号-汇出', 'allow' => 15],
            ['code' => 'member.recycle', 'name' => '会员帐号-回收站', 'allow' => 15],
            ['code' => 'member.recycle_operate', 'name' => '会员帐号-回收站-还原', 'allow' => 11],
        ];

        $this->table('permissions')->insert($data)->save();
    }
}
