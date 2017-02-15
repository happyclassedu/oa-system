/**
 * 文件名称：info_alipay.js
 * 功能描述：支付宝子系统的信息控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = '';
    i_obj_disable('d_atime');
    i_obj_disable('d_etime');
    i_obj_disable('d_hits');
    i_obj_disable('d_id');

    $('#d_atime, #d_etime, #d_u_name').addClass('info_readonly');
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_add_alipay').click(function(){
        i_mdi_open( './info_alipay.htm?a=add&ws_id=' + m.ws_id, '支付接口--新增');
    });
}

//function m_info_set_plug() {
//}

function m_info_add_plug() {
    m.ws_id = i_get('ws_id');
    i_obj_hide('tr_atime');
    i_obj_hide('tr1');
    i_obj_disable('btn_add_alipay');
    i_obj_set('d_ws_id', m.ws_id);
    $('#d_name').addClass('info_must');
}

function m_info_edit_plug() {
    if('' == m.ws_id){
        m.ws_id = m.info['ws_id'];
    }

    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_act_url_plug() {
    m.act_url = i_obj_val('act_url');
    switch (m.act_url) {
        case 'add':
            i_mdi_open('./info_alipay.htm?a=add&ws_id=' + m.ws_id , '支付接口--新增', 1);
            break;
        case 'view':
            i_mdi_open('./info_alipay.htm?a=view&x=' + m.xid, '支付接口--查看', 1);
            break;
        case 'view':
            i_mdi_close();
            break;
    }
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入配置名称！');
        $("#d_name").focus();
        return false;
    }

    return true;
}