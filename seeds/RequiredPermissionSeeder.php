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
            ['code' => 'site.view', 'name' => '站点设置', 'allow' => 15],
            ['code' => 'site.update', 'name' => '站点设置-编辑', 'allow' => 15],
            ['code' => 'video_tag.view', 'name' => '标签管理', 'allow' => 15],
            ['code' => 'video_tag.create', 'name' => '标签管理-新增', 'allow' => 15],
            ['code' => 'video_tag.update', 'name' => '标签管理-编辑', 'allow' => 15],
            ['code' => 'video_tag.delete', 'name' => '标签管理-删除', 'allow' => 15],
            ['code' => 'video_category.view', 'name' => '分类管理', 'allow' => 15],
            ['code' => 'video_category.create', 'name' => '分类管理-新增', 'allow' => 15],
            ['code' => 'video_category.update', 'name' => '分类管理-编辑', 'allow' => 15],
            ['code' => 'video_category.delete', 'name' => '分类管理-删除', 'allow' => 15],
            ['code' => 'actor.view', 'name' => '演员管理', 'allow' => 15],
            ['code' => 'actor.create', 'name' => '演员管理-新增', 'allow' => 15],
            ['code' => 'actor.update', 'name' => '演员管理-编辑', 'allow' => 15],
            ['code' => 'actor.delete', 'name' => '演员管理-删除', 'allow' => 15],
            ['code' => 'site_category.view', 'name' => '分类供影管理', 'allow' => 1],
            ['code' => 'site_category.create', 'name' => '分类供影管理-新增', 'allow' => 1],
            ['code' => 'site_category.update', 'name' => '分类供影管理-编辑', 'allow' => 1],
            ['code' => 'site_category.delete', 'name' => '分类供影管理-删除', 'allow' => 1],
            ['code' => 'site_video.view', 'name' => '影片供影管理', 'allow' => 1],
            ['code' => 'site_video.create', 'name' => '影片供影管理-新增', 'allow' => 1],
            ['code' => 'site_video.update', 'name' => '影片供影管理-编辑', 'allow' => 1],
            ['code' => 'site_video.delete', 'name' => '影片供影管理-删除', 'allow' => 1],
            ['code' => 'video.view', 'name' => '影片管理', 'allow' => 15],
            ['code' => 'video.create', 'name' => '影片管理-新增', 'allow' => 15],
            ['code' => 'video.update', 'name' => '影片管理-编辑', 'allow' => 15],
            ['code' => 'video.delete', 'name' => '影片管理-删除', 'allow' => 15],
            ['code' => 'bulletin.view', 'name' => '公告管理', 'allow' => 15],
            ['code' => 'bulletin.create', 'name' => '公告管理-新增', 'allow' => 15],
            ['code' => 'bulletin.update', 'name' => '公告管理-编辑', 'allow' => 15],
            ['code' => 'bulletin.delete', 'name' => '公告管理-删除', 'allow' => 15],
            ['code' => 'banner.view', 'name' => '广告管理', 'allow' => 15],
            ['code' => 'banner.create', 'name' => '广告管理-新增', 'allow' => 15],
            ['code' => 'banner.update', 'name' => '广告管理-编辑', 'allow' => 15],
            ['code' => 'banner.delete', 'name' => '广告管理-删除', 'allow' => 15],
            ['code' => 'banner_content.view', 'name' => '广告内容管理', 'allow' => 15],
            ['code' => 'banner_content.create', 'name' => '广告内容管理-新增', 'allow' => 15],
            ['code' => 'banner_content.update', 'name' => '广告内容管理-编辑', 'allow' => 15],
            ['code' => 'banner_content.delete', 'name' => '广告内容管理-删除', 'allow' => 15],
            ['code' => 'static_page.view', 'name' => '文案管理', 'allow' => 15],
            ['code' => 'static_page.create', 'name' => '文案管理-新增', 'allow' => 15],
            ['code' => 'static_page.update', 'name' => '文案管理-编辑', 'allow' => 15],
            ['code' => 'static_page.delete', 'name' => '文案管理-删除', 'allow' => 15],
            ['code' => 'csv_export.view', 'name' => '下载中心', 'allow' => 15],
            ['code' => 'message.view', 'name' => '站内信', 'allow' => 15],
            ['code' => 'message.create', 'name' => '站内信-新增', 'allow' => 15],
            ['code' => 'message.update', 'name' => '站内信-编辑', 'allow' => 15],
            ['code' => 'message.delete', 'name' => '站内信-删除', 'allow' => 15],
            ['code' => 'promotion.view', 'name' => '兑换码管理', 'allow' => 15],
            ['code' => 'promotion.create', 'name' => '兑换码管理-新增', 'allow' => 15],
            ['code' => 'promotion.update', 'name' => '兑换码管理-编辑', 'allow' => 15],
            ['code' => 'promotion.delete', 'name' => '兑换码管理-删除', 'allow' => 15],
        ];

        $this->table('permissions')->insert($data)->save();
    }
}
