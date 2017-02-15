/**
 * 文件名称：info_alipay.js
 * 功能描述：支付宝子系统的信息控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

$(document).ready(function(){
    m_init();
    m_btn_load();
});

function m_init() {
//    i_obj_disable('d_out_trade_no');
//    return false;  //可以终止初始化
}

function m_btn_load() {
     $('#btn_t').click(function(){

         i_mdi_open(g['act'] + 'alipayto.php?out_trade_no=203012123145&subject=wangzq&body=hao&total_fee=200', '' , 1);
//         window.location.href= g_act + 'alipayto.php?out_trade_no=203012123145&subject=wangzq&body=hao&total_fee=200';
//         i_mdi_open(g.act + 'alipayto.php?out_trade_no=203012123145&subject=wangzq&body=hao&total_fee=200', '' , 1);
//         var arr = new Object();
//         arr['out_trade_no'] = i_obj_val('d_out_trade_no');
//         arr['subject'] = i_obj_val('d_subject');
//         arr['body'] = i_obj_val('d_body');
//         arr['total_fee'] = i_obj_val('d_total_fee');
////         alert(g_act + 'alipayto.php?out_trade_no=' + arr['out_trade_no'] + '&subject=' + arr['subject'] + '&body=' + arr['body'] + '&total_fee=' + arr['total_fee']);
//         i_mdi_open(g_act + 'alipayto.php?out_trade_no=' + arr['out_trade_no'] + '&subject=' + arr['subject'] + '&body=' + arr['body'] + '&total_fee=' + arr['total_fee'], '' , 1);
////         $.ajax({
////            url : i_act + 'a=add',
////            data : 'arr=' + i_js2json(arr),
////            success : function(txt){
////                alert(txt);
////                if (txt > 0) {
//////                    alert('保存成功！');
////                    i_mdi(g_act + 'alipayto.php?out_trade_no=' + arr['out_trade_no'] + '&subject=' + arr['subject'] + '&body=' + arr['body'] + '&total_fee=' + arr['total_fee'], '' , 1);
////                } else {
////                    alert('保存失败！' + txt);
////                }
////            }
////        });
    });
}
