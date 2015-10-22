<?php
return array(
    'components'=>array(
        'mandao'=>array(
            // enable cookie-based authentication
            'class'=>'application.components.ManSenderBalance',
            'host'=>'http://sdk.entinfo.cn:8060/',
            'username'=>'SDK-WSS-010-06470',
            'password'=>'SDK-WSS-010-06470cc@9ad7@',
        ),
        'yunbei'=>array(
            // enable cookie-based authentication
            'class'=>'application.components.YunBeiSender',
            'host'=>'http://api.sms.ciaosir.com/',
            'username'=>'cg888',
            'password'=>'458756',
        ),
    ),
    'params'=>array(
        'scripts' => array(
            'user_login'     => 'user/verify.json',
            'user_log'       => 'user/login.json',
            'user_list'      => 'admin/user/list.json',
            'user_info'      => 'user/info/view/%s.json',
            'user_register'  => 'user/register.json',
            'user_modifan'   => 'user/info/update.json',
            'admin_modifan'  => 'user/admin/update',
            'user_modpass'   => 'user/update/pwd',
            'user_status'    => 'user/update/status',
            'admin_register' => 'user/admin/register.json',
            'debt_outlay'    =>'account/platform/outlay.json',
            'project_admin_init'      =>'project/admin/init',
            'coupon_template_list'    =>'promotion/query/coupon/template.json',
            'coupon_template_save'    =>'promotion/save/coupon/template.json',
            'coupon_template_print'   =>'promotion/print/coupon.json',
            'activity_query'          =>'activity/query.json',
            'activity_info'           =>'activity/info/activity.json',
            'activity_coupon_receive' =>'activity/coupon/receive.json',
            'activity_reward_receive' =>'activity/reward/receive.json',
            'reward_user_list'        => 'activity/get/reward/user/list.json',
            'coupon_user_list'        => 'activity/get/coupon/user/list.json',
            'year_coupon_save'        => 'promotion/save/coupon/template.json',
            'year_coupon_list'        => 'promotion/query/annual/template.json',
            'year_coupon_print'       => 'promotion/print/coupon.json',
            'bank_list'               => 'account/bank/list.json',
            'withdraw_list'           => 'admin/withdraw/list.json',
            'withdraw_deal'           => 'account/withdraw/settle.json',
            'withdraw_refuse'         => 'account/withdraw/refuse.json',
            'transaction_query'       => 'transaction/project/detail/query/transaction.json',
            'season_create'           => 'project/season/create.json',
            'season_list'             => 'project/season/query/list.json',
            'identity_check'          => 'account/identity/check.json', //校验身份证
            'identity_check_log'      => 'account/identity/checkIdentityLog.json', //身份证历史查询
            'identity_remainCount'    => 'account/identity/remainCount.json',
            'project_deal'            => 'project/get.json',  //项目详情
            'cgqb_balance_out'        => 'demand/redeem.json',//转出
            'debtor_recharge_out'     => 'demand/recharge/redeem/amount.json',//债权人充值完成赎回
            'redeemAmount'     => 'demand/query/surplus/redeemAmount.json',//查询冻结待赎回金额
            'preOutInterest'     => 'demand/query/pre/out/interest.json',//查询冻结待赎回金额
            'recharge_prepare'     => 'demand/recharge/prepare/amount.json',//查询冻结待赎回金额
            'unbound_lianlian'        => 'pay/lianlian/ubbind.json',
            'cgk_user_list'           => '/user/query/user/list.json',//草根客用户列表
            'cgk_user_apply'          => '/user/audit/join/apply.json',//草根客用户审核
            'cgk_user_detail'          => '/user/view/detail.json',//草根客用户审核
            'add_score'                => 'score/add/user/score.json',  //给用户增加积分
            'user_register'            => 'account/register.json',  //用户注册
            'shengpay_bank_branchs'    => 'bankBranch/select/branch.json',  //获取支行
            'bank_list'                => 'account/bank/list.json',  //获取银行列表
            'bank_bind'                => 'account/bankcard/bind.json', //银行卡绑定
            'identity_auth'            => 'user/identity/auth.json', //身份验证
            'getUserInfo'              => 'loginRest/getUserCenterInfo.json', //获取用户信息
            'bank_modify'              => 'account/bankcard/modify.json', //修改绑定银行卡
            'user_card_list'           => 'account/bankcard/list.json',
            'direct_money_lend'       => 'borrow/withdraw.json',
            'money_lend_audit_success' => 'borrow/audit/success.json',
            'money_lend_audit_failed' => 'borrow/audit/failed.json',
            'account_bankcard_confirm' => 'account/bankcard/confirm.json',
            'borrow_batch_withdraw' =>'borrow/batch/withdraw.json'

        ),
        'UpYun' => array(
            'visitUrl' => 'https://cgtzimage.b0.upaiyun.com',//images
            'httpImgUrl' => 'http://cgtzimage.b0.upaiyun.com',//images
            'cutUrl' => 'http://v0.api.upyun.com',
            'bucketname' => 'cgtzimage',
            'username' => 'caogen',
            'password' => 'caogen123',
            'bucket_file_name' => 'cgtzfiles',
            'attachUrl' => 'http://cgtzfiles.b0.upaiyun.com',//files
            'projectsUrl' => 'https://cgtzimage.b0.upaiyun.com/projectTests/',//images
        ),
        'defaultPageSize'=>20,
        'activity_type'=>array('1'=>'红包','2'=>'投资券'),
        'siterouter'=>array(
            'site/login'=>array('name'=>'用户登录'),
            // 'sysUser/logsee'=>array('name'=>'日志审计'),
            'user/index'=>array('name'=>'用户列表'),
            'user/view'=>array('name'=>'用户详情'),
            'user/freeze'=>array('name'=>'用户冻结'),
            'user/updatemobile'=>array('name'=>'修改手机号'),
            'user/update'=>array('name'=>'修改用户身份证姓名'),
            'funds/withdraw'=>array('name'=>'用户提现结算'),
            'funds/index'=>array('name'=>'资金信息统计报表'),
            'funds/dealwithdraw'=>array('name'=>'用户资金结算'),
            'funds/datasync'=>array('name'=>'用户提现数据同步'),
            'funds/projectquery'=>array('name'=>'项目付息查询情况'),
            'funds/projectinvestmentinfo'=>array('name'=>'项目已投资的奖励和已确认利息项目明细'),
            'article/index'=>array('name'=>'文章管理'),
            'article/create'=>array('name'=>'文章添加'),
            'article/update'=>array('name'=>'文章编辑'),
            'article/delete'=>array('name'=>'文章删除'),
            'sysuser/index'=>array('name'=>'系统管理员列表'),
            'sysUser/clearprivileges'=>array('name'=>'清除权限缓存'),
            'sysuser/delete'=>array('name'=>'删除管理员'),
            'sysuser/update'=>array('name'=>'更新管理员信息'),
            'sysuser/view'=>array('name'=>'查看管理员详情'),
            'activity/index'=>array('name'=>'活动列表'),
            'activity/view'=>array('name'=>'活动详情'),
            'sysuser/sendcoupon'=>array('name'=>'发送红包'),


        ),
        'project_type'=>array(
            '红木宝',
            '贸易通',
            '房产抵押',
            '汽车债权'
        ),
        'project_lx'=>array(
            4  => '有色金属',
            8 => '汽车宝',
            9 =>'房盈通',
            11 =>'增信宝',
            12 => '资产宝',
            13 => '优企贷',
            14 => '聚宝盆',
            16 => '化工类',
            18 => '矿产类',
            19 => '能源类',
            20 => '消费品',
            21 => '农产品类',
            22 => '海鲜类',
            23 => '红木类',
            93 => '其他',
            35 =>'贸易通',
            36 =>'融易通',
        ),
        'redis_key'=>array(
            array(
                'key'=>'PROJECT.LIST.PLATFORM.SUMMARY',
                'redis'=>'cache_redis8',
                'desc'=>'列表页面右侧统计数据'
            ),
            array(
                'key'=>'projectList',
                'redis'=>'cache_redis',
                'desc'=>'项目列表缓存'
            ),
        ),
        'companys'=>[
            '310000'=>'杭州总部',
            '316000'=>'舟山分公司',
            '322100'=>'东阳分公司',
            '315700'=>'象山分公司',
            '650000'=>'云南分公司',
            '100020'=>'北京分公司',
            '210000'=>'南京分公司',
            '213000'=>'常州分公司',
            '311300'=>'车到山前分公司',
            '311200'=>'直营中心',
            '315000'=>'宁波分公司',
            '223001'=>'淮安分公司',
        ],
        'preview_sign'=>md5('www.cgtz.com'),
        'iosChannels' => array(
            'domob'    => '多盟',
            'miidi'    => '米迪',
            'miidi'    => '米迪',
            'zhimeng'  => '指盟',
            'qumi'     => '趣米',
            'qumi2'    => '趣米注册',
            'aipu'     => '爱普',
            'adwo'     => '安沃',
            'dianru'   => '点入',
            'wanpu'    => '万普',
            'wanpu1'   => '万普1',
            'wanpu2'   => '万普2(钱包)',
            'dianjoy'  => '点乐',
            'ruanlie'  => '软猎',
            'youyou'   => '优友',
            'youmi'    => '有米',
            'yijifen'  => '易积分',
            'diankai'  => '点开',
            'diankai2' => '点开2',
            'cgtz'     => '自然流量',
        ),
        'apps' => array(
            '912261455' => '草根投资',
            '472885640' => '草根钱包',
        ),

    ),
);
