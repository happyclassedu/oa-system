<?php
/*
*功能：设置商品有关信息（确认订单支付宝在线购买入口页）
*详细：该页面是接口入口页面，生成支付时的URL
*版本：3.1
*修改日期：2010-10-29
'说明：
'以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
'该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

*/
include_once '../inc/common.php';
include_once '../../2030/mod/mod_order.php';
include_once '../../2030/inc/10_alipay_cfg.php';
include_once '../../2030/mod/lib_alipay_service.php';

/*以下参数是需要通过下单时的订单数据传入进来获得*/
//必填参数
$act = i_get_act();
$xid = i_get_xid();

$mod = new mod_order();
$arr = $mod->info_read($xid, false);

$out_trade_no = $arr['out_trade_no'];//请与贵网站订单系统中的唯一订单号匹配
$subject      = $arr['subject'];//订单名称，显示在支付宝收银台里的“商品名称”里，显示在支付宝的交易管理的“商品名称”的列表里。
$body         = $arr['body'];//订单描述、订单详细、订单备注，显示在支付宝收银台里的“商品描述”里
$total_fee    = $arr['total_fee'];//订单总金额，显示在支付宝收银台里的“应付总额”里

//扩展功能参数——默认支付方式
$paymethod    = "directPay";	//默认支付方式，四个值可选：bankPay(网银); cartoon(卡通); directPay(余额); CASH(网点支付)
$defaultbank  = "";

//扩展功能参数——防钓鱼
//请慎重选择是否开启防钓鱼功能
//exter_invoke_ip、anti_phishing_key一旦被使用过，那么它们就会成为必填参数
//开启防钓鱼功能后，服务器、本机电脑必须支持远程XML解析，请配置好该环境。
//若要使用防钓鱼功能，请打开class文件夹中alipay_function.php文件，找到该文件最下方的query_timestamp函数，根据注释对该函数进行修改
//建议使用POST方式请求数据
$anti_phishing_key  = '';			//防钓鱼时间戳
$exter_invoke_ip = '';				//获取客户端的IP地址，建议：编写获取客户端IP地址的程序
//如：
//$exter_invoke_ip = '202.1.1.1';
//$anti_phishing_key = query_timestamp($partner);		//获取防钓鱼时间戳函数

//扩展功能参数——其他
$extra_common_param = '';			//自定义参数，可存放任何内容（除=、&等特殊字符外），不会显示在页面上
$buyer_email		= '';			//默认买家支付宝账号

//扩展功能参数——分润(若要使用，请按照注释要求的格式赋值)
$royalty_type		= "";			//提成类型，该值为固定值：10，不需要修改
$royalty_parameters	= "";
//提成信息集，与需要结合商户网站自身情况动态获取每笔交易的各分润收款账号、各分润金额、各分润说明。最多只能设置10条
//各分润金额的总和须小于等于total_fee
//提成信息集格式为：收款方Email_1^金额1^备注1|收款方Email_2^金额2^备注2
//如：
//royalty_type = "10"
//royalty_parameters	= "111@126.com^0.01^分润备注一|222@126.com^0.01^分润备注二"

//构造要请求的参数数组，无需改动
$parameter = array(
        "service"		=> "create_direct_pay_by_user",	//接口名称，不需要修改
        "payment_type"		=> "1",               			//交易类型，不需要修改

//获取配置文件(alipay_config.php)中的值
        "partner"		=> $partner,
        "seller_email"		=> $seller_email,
        "return_url"		=> $return_url,
        "notify_url"		=> $notify_url,
        "_input_charset"	=> $_input_charset,
        "show_url"		=> $show_url,

//从订单数据中动态获取到的必填参数
        "out_trade_no"		=> $out_trade_no,
        "subject"		=> $subject,
        "body"			=> $body,
        "total_fee"		=> $total_fee,

//扩展功能参数——网银提前
        "paymethod"		=> $paymethod,
        "defaultbank"		=> $defaultbank,

//扩展功能参数——防钓鱼
        "anti_phishing_key"	=> $anti_phishing_key,
        "exter_invoke_ip"	=> $exter_invoke_ip,

//扩展功能参数——自定义参数
        "buyer_email"           => $buyer_email,
        "extra_common_param"    => $extra_common_param,

//扩展功能参数——分润
        "royalty_type"		=> $royalty_type,
        "royalty_parameters"    => $royalty_parameters
);

//构造请求函数
$alipay = new alipay_service($parameter, $key, $sign_type);
$param_url = array();
$gateway = '';
if(isset($alipay->parameter) && isset($alipay->mysign) && isset($alipay->gateway) && isset($alipay->sign_type)){
    $param_url = $alipay->parameter;
    $param_url['subject'] = urlencode($subject);
    $param_url['body'] = urlencode($body);
    $param_url['sign'] = $alipay->mysign;
    $param_url['sign_type'] = $alipay->sign_type;
    $gateway = $alipay->gateway ;
}

//url数组参数输出
if('confirm_order' == $act) {
//    print_r($param_url);
    $param_url = create_linkstring($param_url);
    $param_url = $gateway . $param_url;
    echo i_php2json($param_url);
} else {
    die('对不起，参数有误！');
}
?>