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
            ['code' => 'campaign.view', 'name' => '广告内容管理', 'allow' => 15],
            ['code' => 'campaign.create', 'name' => '广告内容管理-新增', 'allow' => 15],
            ['code' => 'campaign.update', 'name' => '广告内容管理-编辑', 'allow' => 15],
            ['code' => 'campaign.delete', 'name' => '广告内容管理-删除', 'allow' => 15],
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
            ['code' => 'video_tag_group.view', 'name' => '标签分类管理', 'allow' => 15],
            ['code' => 'video_tag_group.create', 'name' => '标签分类管理-新增', 'allow' => 15],
            ['code' => 'video_tag_group.update', 'name' => '标签分类管理-编辑', 'allow' => 15],
            ['code' => 'video_tag_group.delete', 'name' => '标签分类管理-删除', 'allow' => 15],
            ['code' => 'csv_import.token_ticket', 'name' => '批量汇入-豆豆币、观影天数、观影券', 'allow' => 15],
            ['code' => 'official_site.view', 'name' => '官方网站管理', 'allow' => 15],
            ['code' => 'official_site.create', 'name' => '官方网站管理-新增', 'allow' => 15],
            ['code' => 'official_site.update', 'name' => '官方网站管理-编辑', 'allow' => 15],
            ['code' => 'official_site.delete', 'name' => '官方网站管理-删除', 'allow' => 15],
            ['code' => 'sms_vendor.view', 'name' => '简讯商管理', 'allow' => 15],
            ['code' => 'sms_vendor.create', 'name' => '简讯商管理-新增', 'allow' => 15],
            ['code' => 'sms_vendor.update', 'name' => '简讯商管理-编辑', 'allow' => 15],
            ['code' => 'sms_vendor.delete', 'name' => '简讯商管理-删除', 'allow' => 15],
            ['code' => 'video_order.view', 'name' => '购片纪录', 'allow' => 15],
            ['code' => 'video_order.export', 'name' => '购片纪录-汇出', 'allow' => 15],
            ['code' => 'promotion_order.view', 'name' => '兑换纪录', 'allow' => 15],
            ['code' => 'feature_config.view', 'name' => '功能开关设定', 'allow' => 15],
            ['code' => 'feature_config.create', 'name' => '功能开关设定-新增', 'allow' => 15],
            ['code' => 'feature_config.update', 'name' => '功能开关设定-编辑', 'allow' => 15],
            ['code' => 'feature_config.delete', 'name' => '功能开关设定-删除', 'allow' => 15],
            ['code' => 'video_plan.view', 'name' => '观影方案管理', 'allow' => 15],
            ['code' => 'video_plan.create', 'name' => '观影方案管理-新增', 'allow' => 15],
            ['code' => 'video_plan.update', 'name' => '观影方案管理-编辑', 'allow' => 15],
            ['code' => 'video_plan.delete', 'name' => '观影方案管理-删除', 'allow' => 15],
            ['code' => 'video_plan_order.view', 'name' => '购买观影方案纪录', 'allow' => 15],
            ['code' => 'fourth_party.view', 'name' => '线上支付商户', 'allow' => 15],
            ['code' => 'fourth_party.create', 'name' => '线上支付商户-新增', 'allow' => 15],
            ['code' => 'fourth_party.update', 'name' => '线上支付商户-编辑', 'allow' => 15],
            ['code' => 'fourth_party.delete', 'name' => '线上支付商户-删除', 'allow' => 15],
            ['code' => 'site_account.view', 'name' => '公司入款帐户', 'allow' => 15],
            ['code' => 'site_account.create', 'name' => '公司入款帐户-新增', 'allow' => 15],
            ['code' => 'site_account.update', 'name' => '公司入款帐户-编辑', 'allow' => 15],
            ['code' => 'site_account.delete', 'name' => '公司入款帐户-删除', 'allow' => 15],
            ['code' => 'payment_rank.view', 'name' => '支付层级', 'allow' => 15],
            ['code' => 'payment_rank.create', 'name' => '支付层级-新增', 'allow' => 15],
            ['code' => 'payment_rank.update', 'name' => '支付层级-编辑', 'allow' => 15],
            ['code' => 'payment_rank.delete', 'name' => '支付层级-删除', 'allow' => 15],
            ['code' => 'deposit_audit.view', 'name' => '入款查核', 'allow' => 15],
            ['code' => 'deposit_audit.create', 'name' => '入款查核-用户充值', 'allow' => 11],
            ['code' => 'deposit_audit.update', 'name' => '入款查核-编辑', 'allow' => 11],
            ['code' => 'deposit_audit.audit', 'name' => '入款查核-稽核', 'allow' => 11],
            ['code' => 'deposit_audit.unlock', 'name' => '入款查核-解锁', 'allow' => 11],
            ['code' => 'deposit_audit.export', 'name' => '入款查核-汇出', 'allow' => 15],
            ['code' => 'commodity.view', 'name' => '豆豆币商品管理', 'allow' => 15],
            ['code' => 'commodity.create', 'name' => '豆豆币商品管理-新增', 'allow' => 15],
            ['code' => 'commodity.update', 'name' => '豆豆币商品管理-编辑', 'allow' => 15],
            ['code' => 'commodity.delete', 'name' => '豆豆币商品管理-删除', 'allow' => 15],
            ['code' => 'commodity_order.view', 'name' => '购买豆豆币纪录', 'allow' => 15],
            ['code' => 'webmaster_cash_summary.view', 'name' => '现金报表', 'allow' => 15],
            ['code' => 'webmaster_cash_summary.export', 'name' => '现金报表-汇出', 'allow' => 15],
            ['code' => 'homepage_setting.view', 'name' => '首页版面管理', 'allow' => 15],
            ['code' => 'homepage_setting.create', 'name' => '首页版面管理-新增', 'allow' => 15],
            ['code' => 'homepage_setting.update', 'name' => '首页版面管理-编辑', 'allow' => 15],
            ['code' => 'homepage_setting.delete', 'name' => '首页版面管理-删除', 'allow' => 15],
            ['code' => 'cashflow_log.view', 'name' => '账变明细', 'allow' => 15],
            ['code' => 'cashflow_log.create', 'name' => '账变明细-新增', 'allow' => 11],
            ['code' => 'cashflow_log.export', 'name' => '账变明细-汇出', 'allow' => 15],
            ['code' => 'vendor_tx_order.view', 'name' => '额度转换报表', 'allow' => 15],
            ['code' => 'vendor_tx_order.export', 'name' => '额度转换报表-汇出', 'allow' => 15],
            ['code' => 'permission_group.view', 'name' => '权限群组管理', 'allow' => 11],
            ['code' => 'permission_group.create', 'name' => '权限群组管理-新增', 'allow' => 11],
            ['code' => 'permission_group.update', 'name' => '权限群组管理-编辑', 'allow' => 11],
            ['code' => 'permission_group.delete', 'name' => '权限群组管理-删除', 'allow' => 11],
            ['code' => 'quest.view', 'name' => '任务管理', 'allow' => 15],
            ['code' => 'quest.create', 'name' => '任务管理-新增', 'allow' => 15],
            ['code' => 'quest.update', 'name' => '任务管理-编辑', 'allow' => 15],
            ['code' => 'quest.delete', 'name' => '任务管理-删除', 'allow' => 15],
            ['code' => 'member_quest_log.view', 'name' => '会员任务纪录', 'allow' => 15],
            ['code' => 'member_quest_log.export', 'name' => '会员任务纪录-汇出', 'allow' => 15],
            ['code' => 'sign_in_quest.view', 'name' => '签到任务', 'allow' => 15],
            ['code' => 'sign_in_quest.update', 'name' => '签到任务-编辑', 'allow' => 15],
        ];

        $this->table('permissions')->insert($data)->save();
    }
}
