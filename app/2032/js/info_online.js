/**
 * 文件名称：info_online.js
 * 功能描述：提出问题的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {

}


function m_btn_load_plug() {

}

function m_info_set_plug() {

}

function m_info_add_plug() {
    //问题模块--提问配置信息
    i_obj_set('d_u_id', '0');  //用例测试
//    i_obj_set('d_u_name', '游客');  //用例测试
    i_obj_set('d_ws_id', '3');  //提出问题的网址
    i_obj_set('d_ws_name', '人社局门户网');  //提出问题的网址
    i_obj_set('d_menu_id', '');  //栏目id
    i_obj_set('d_menu_name', '在线咨询');  //栏目名称
    i_obj_set('d_i_type', '');  //业务类型
    i_obj_set('d_qa', '0');  //用例测试

//    i_obj_disable('d_atime');
    $('#d_name').addClass('info_must');
}

function m_info_edit_plug() {
    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {

    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入提问标题！');
        return false;
    }

    return true;
}

function m_info_del_fail(arr) {
    if (0 == arr) {
        alert('删除：“' + m.info['name'] + '”失败！');
    }
}


function m_act_url_plug() {
    return false;
}
