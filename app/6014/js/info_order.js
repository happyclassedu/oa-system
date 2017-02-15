/**
 * 文件名称：info_alipay.js
 * 功能描述：支付信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
var ws_id = '10';
var ws_name = '莲湖区人力资源服务中心流动党员之家';
//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
}

function m_btn_load_plug() {
    $('#d_date_d').jdate({
        //                    showButtonPanel: false,
        //                    changeMonth: false,
        //                    changeYear: false,
        //                    numberOfMonths: 2,
        dateFormat: 'yy-mm-dd'
    });

    $('#d_date_s').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_date_e').jdate({
        dateFormat: 'yy-mm-dd'
    });
}

function m_info_set_plug() {

}

function m_info_add_plug() {
    i_obj_set('d_ws_id', ws_id);  //配置信息的网站地址
    i_obj_set('d_ws_name',ws_name);  //配置信息的网站名称
    i_obj_set('d_subject', '缴纳党费');
    i_obj_set('d_body', '党费每月一元');
}

//function m_info_edit_plug() {
//}

//function m_info_view_plug() {
//}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_name', '姓名不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_name', '通过', '2');
    }

    return true;
}

function m_act_url_plug() {
    i_mdi_open('./confirm_order.htm?x=' + m.xid, '确认订单' , 1);
    return false;
}
