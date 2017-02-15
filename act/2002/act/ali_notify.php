<?php
/*
*功能：支付宝主动通知调用的页面（服务器异步通知页面）
*版本：3.1
*日期：2010-10-29
'说明：
'以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
'该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

*/
///////////页面功能说明///////////////
//创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
//该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
//该页面调试工具请使用写文本函数log_result，该函数已被默认关闭，见alipay_notify.php中的函数notify_verify
//TRADE_FINISHED(表示交易已经成功结束，通用即时到帐反馈的交易状态成功标志);
//TRADE_SUCCESS(表示交易已经成功结束，高级即时到帐反馈的交易状态成功标志);
//该服务器异步通知页面面主要功能是：对于返回页面（return_url.php）做补单处理。如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
/////////////////////////////////////

require_once("../mod/alipay_notify.php");
require_once("alipay_config.php");

$alipay = new alipay_notify($partner,$key,$sign_type,$_input_charset,$transport);    //构造通知函数信息
$verify_result = $alipay->notify_verify();  //计算得出通知验证结果

if($verify_result) {//验证成功
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
    $out_trade_no   =   $_POST['out_trade_no'];	//获取支付宝传递过来的订单号
    $total_fee      =   $_POST['total_fee'];	//获取支付宝传递过来的总价格
//    $alixtb_order  =   '#@__ws_order';         //商品订单表
    /*
    获取支付宝反馈过来的状态,根据不同的状态来更新数据库
    WAIT_BUYER_PAY(表示等待买家付款);
    TRADE_FINISHED(表示交易已经成功结束);
    */
    if ($_POST ['trade_status'] == 'WAIT_BUYER_PAY') {

        // 判断支付状态_等待买家付款
        update_order('等待买家付款', $out_trade_no);

    } elseif($_POST ['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {

        // 判断支付状态_买家付款成功,等待卖家发货
        update_order('买家付款成功,等待卖家发货', $out_trade_no);

    } elseif ($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {

        // 判断支付状态_卖家已发货，等待买家确认收货
        update_order('卖家已发货，等待买家确认收货', $out_trade_no);

    } elseif($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {

        //交易成功结束
        update_order('交易成功', $out_trade_no);
        echo "success";		//请不要修改或删除
        //调试用，写文本函数记录程序运行情况是否正常
        log_result('trade_status:' . $_POST['trade_status']);
    }
    else {
        update_order('交易成功', $out_trade_no);
        echo "success";		//其他状态判断。普通即时到帐中，其他状态不用判断，直接打印success。
        //log_result ("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }
}
else {
//验证失败
    echo "fail";
    //调试用，写文本函数记录程序运行情况是否正常
    log_result ('trade_status:' . $_POST['trade_status']);
}

function update_order($order_status, $out_trade_no) {
     $g_xdb->update('#@__ws_order', 'order_status="' . $order_status . '"', 'out_trade_no="' . $out_trade_no . '"');
}
?>