/**
 * 文件名称：info_a.js
 * 功能描述：回复信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
//    i_obj_set('d_drwx', '2'); //已回复
    i_obj_disable('d_atime');
    i_obj_disable('d_name');
}


function m_btn_load_plug() {
//    $('#btn_add_link').click(function(){
//        i_mdi_open( './info_link.htm?a=add&ws_id=' + m.ws_id, '链接信息--新增');
//    });
}

function m_info_set_plug() {
    m.ws_id = m.info['ws_id'];
}

//function m_info_add_plug() {
//    i_obj_set('d_u_id', '0');  //用例测试
//    i_obj_set('d_u_name', '管理员');  //用例测试
//    $('#d_name').addClass('info_must');
//}

function m_info_edit_plug() {
    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
//    m.tmp = i_obj_val('d_a_intro');
//    if ('' == m.tmp || (m.tmp).length == 0) {
//        alert('回复内容不能为空，请填写！');
//        return false;
//    }
//
//    m.tmp = i_obj_val('d_u_name');
//    if ('' == m.tmp || (m.tmp).length == 0) {
//        alert('回复者不能为空，请填写！');
//        return false;
//    }
//
//    m.tmp = i_obj_val('d_org');
//    if ('' == m.tmp || (m.tmp).length == 0) {
//        alert('回复部门不能为空，请填写！');
//        return false;
//    }
//
//    m.tmp = i_obj_val('d_drwx');
//    if ('1' == m.tmp) {
//        alert('请重新设置留言状态！');
//        return false;
//    }
    
    return true;
}

//function m_act_url_plug() {
//    return false;
//}
