/**
 * 文件名称：info_q.js
 * 功能描述：留言信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    i_read_js('cfg');
}

function m_btn_load_plug() {

}

function m_info_set_plug() {

}

function m_info_add_plug() {
    //留言板模块的信息配置
    i_obj_set('d_ws_id', ws_id);  //配置信息的网站地址
    i_obj_set('d_ws_name',ws_name);  //配置信息的网站名称
    
    i_obj_disable('d_atime');
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
        alert('对不起，留言标题不能为空！');
        return false;
    }

    return true;
}

//function m_act_url_plug() {
//    return false;
//}
