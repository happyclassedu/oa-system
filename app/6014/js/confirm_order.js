/**
 * 文件名称：confirm_order.js
 * 功能描述：确认订单信息的信息控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */
var tmp = '';
var xid = '';

$(document).ready(function(){
    xid = i_get('x');
    tmp = '';
    m_init_data();
    m_ali_url();
    m_btn_load();
});

function m_btn_load() {
     $('#btn_confirm').click(function(){
         i_mdi_open(tmp)
    });
}

function m_init_data() {
    $.ajax({
        url : g['act'] + 'info_order.php?a=info_read&x='+ xid,
        success : function(txt){
            var arr = i_json2js(txt);
            i_obj_set('d_out_trade_no', arr['out_trade_no']);
            i_obj_set('d_total_fee', arr['total_fee']);
        }
    });
}

function m_ali_url() {
    $.ajax({
        url : i_act + 'a=confirm_order&x='+ xid,
        success : function(txt){
            tmp = i_json2js(txt);
//            var str_url = '';
//            for( var key in arr){
//                str_url += key + '=' +arr[key] + '&';
//            }
//            str_url = str_url.substr(0 , str_url.length - 2);
//            str_url = 'https://www.alipay.com/cooperate/gateway.do?' + str_url;
//                i_mdi_open('./info_alipay.htm?a=add', '' , 1);
//                i_obj_set('d_url', tmp);
        }
    });
}
