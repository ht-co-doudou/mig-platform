<?php

use Phinx\Seed\AbstractSeed;

class RequiredBankSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            ['swift_code' => 'ICBKCNBJ', 'name' => '中国工商银行', 'website' => 'http://www.icbc.com.cn'],
            ['swift_code' => 'COMMCNSH', 'name' => '交通银行', 'website' => 'http://www.bankcomm.com'],
            ['swift_code' => 'ABOCCNBJ', 'name' => '中国农业银行', 'website' => 'http://www.abchina.com'],
            ['swift_code' => 'PCBCCNBJ', 'name' => '中国建设银行', 'website' => 'http://www.ccb.com'],
            ['swift_code' => 'CMBCCNBS', 'name' => '招商银行', 'website' => 'http://www.cmbchina.com'],
            ['swift_code' => 'MSBCCNBJ', 'name' => '中国民生银行', 'website' => 'http://www.cmbc.com.cn'],
            ['swift_code' => 'SPDBCNSH', 'name' => '浦发银行', 'website' => 'http://www.spdb.com.cn'],
            ['swift_code' => 'BJCNCNBJ', 'name' => '北京银行', 'website' => 'http://www.bankofbeijing.com.cn'],
            ['swift_code' => 'FJIBCNBA', 'name' => '兴业银行', 'website' => 'https://www.cib.com.cn'],
            ['swift_code' => 'CIBKCNBJ', 'name' => '中信银行', 'website' => 'http://www.citicbank.com'],
            ['swift_code' => 'EVERCNBJ', 'name' => '中国光大银行', 'website' => 'http://www.cebbank.com'],
            ['swift_code' => 'HXBKCNBJ', 'name' => '华夏银行', 'website' => 'http://www.hxb.com.cn'],
            ['swift_code' => 'GDBKCN22', 'name' => '广发银行', 'website' => 'http://www.cgbchina.com.cn'],
            ['swift_code' => 'SZCBCNBS', 'name' => '平安银行', 'website' => 'http://bank.pingan.com'],
            ['swift_code' => 'PSBCCNBJ', 'name' => '中国邮政储蓄银行', 'website' => 'http://www.psbc.com'],
            ['swift_code' => 'BKCHCNBJ', 'name' => '中国银行', 'website' => 'http://www.boc.cn'],
            ['swift_code' => 'ZJCBCN2N', 'name' => '浙商银行', 'website' => 'http://www.czbank.com'],
            ['swift_code' => 'CHBHCNBT', 'name' => '渤海银行', 'website' => 'http://www.cbhb.com.cn'],
            ['swift_code' => 'HFBACNSD', 'name' => '恒丰银行', 'website' => 'http://www.hfbank.com.cn'],
            ['swift_code' => 'BKNBCN2N', 'name' => '宁波银行', 'website' => 'http://www.nbcb.com.cn'],
            ['swift_code' => 'HZCBCN2H', 'name' => '杭州银行', 'website' => 'http://www.hccb.com.cn'],
            ['swift_code' => 'BOSHCNSH', 'name' => '上海银行', 'website' => 'http://www.bosc.cn'],
            ['swift_code' => 'NJCBCNBN', 'name' => '南京银行', 'website' => 'http://www.njcb.com.cn'],
            ['swift_code' => 'CZCBCN2X', 'name' => '浙江稠州商业银行', 'website' => 'http://www.czcb.com.cn'],
            ['swift_code' => 'BRCBCNBJ', 'name' => '北京农商银行', 'website' => 'http://www.bjrcb.com'],
            ['swift_code' => 'SHRCCNSH', 'name' => '上海农商银行', 'website' => 'http://www.srcb.com'],
            ['swift_code' => 'ADBNCNBJ', 'name' => '中国农业发展银行', 'website' => 'http://www.adbc.com.cn'],
            ['swift_code' => 'HFCBCNSH', 'name' => '徽商银行', 'website' => 'http://www.hsbank.com.cn'],
            ['swift_code' => 'HSBCCNSH', 'name' => '汇丰银行', 'website' => 'https://www.hsbc.com.cn'],
            ['swift_code' => 'SCBLCNSX', 'name' => '渣打银行', 'website' => 'https://www.sc.com/cn'],
            ['swift_code' => 'CITICNSX', 'name' => '花旗银行', 'website' => 'https://www.citibank.com.cn'],
            ['swift_code' => 'DEUTCNSH', 'name' => '德意志银行', 'website' => 'https://china.db.com'],
            ['swift_code' => 'UBSWCNBJ', 'name' => '瑞士银行', 'website' => 'https://www.ubs.com/cn'],
            ['swift_code' => 'ABNACNSH', 'name' => '荷兰银行', 'website' => 'https://www.rabobank.com/en'],
            ['swift_code' => 'HASECNSH', 'name' => '恒生银行', 'website' => 'https://www.hangseng.com.cn'],
            ['swift_code' => 'KCCBCN2K', 'name' => '富滇银行', 'website' => 'http://www.fudian-bank.com'],
            ['swift_code' => 'BKSHCNBJ', 'name' => '河北银行', 'website' => 'http://www.hebbank.com'],
            ['swift_code' => 'PBOCCNBJ', 'name' => '中国人民银行', 'website' => 'http://www.pbc.gov.cn'],
            ['swift_code' => 'GZCBCN22', 'name' => '广州银行', 'website' => 'http://www.gzcb.com.cn'],
            ['swift_code' => 'CTGBCN22', 'name' => '重庆三峡银行', 'website' => 'http://www.ccqtgb.com'],
            ['swift_code' => 'CHCCCNSS', 'name' => '长沙银行', 'website' => 'http://www.cscb.cn'],
        ];

        $this->table('banks')->insert($data)->save();
    }
}
