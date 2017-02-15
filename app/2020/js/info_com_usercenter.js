/**
* 文件名称：info_com_usercenter.js
* 功能描述：企业管理中心的前台程序。
* 代码作者：王争强
* 创建日期：2010-08-09
* 修改时间：2010-08-09
* 当前版本：v1.0
*/
var cid = '';

//$(document).ready(function(){
//
//    });

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    m_get_session();
    m_init_plug();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#a_info_job').click(function(){
        $('#a_info_job').attr('href', './info_job.htm?a=add&c_id=' + cid);
    });

    $('#a_list_job').click(function(){
        $('#a_list_job').attr('href', './list_job.htm?a=list&c_id=' + cid);
    });

    $('#a_info_com_basic').click(function(){
        $('#a_info_com_basic').attr('href', './info_com_basic.htm?a=edit&x=' + cid);
    });

    $('#a_info_com_contact').click(function(){
        $('#a_info_com_contact').attr('href', './info_com_contact.htm?a=edit&x=' + cid);
    });

//    $('#a_info_com_photo').click(function(){
//    });
}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}


//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

//function m_info_save_plug() {
//    return true;
//}

function m_get_session(){
    $.ajax({
        url : i_act + 'a=info_session',
        success : function(txt){
            cid = txt;
        }
    });
}

function m_init_plug() {
    $.ajax({
        url : i_act + 'a=info_init' ,
        success : function(txt){
           m.info = i_json2js(txt);
           i_obj_set('d_fname', m.info['fname']);
           i_obj_set('d_login_time', (m.info['login_time']).substring(0, 10));
           i_obj_set('d_login_hits', m.info['login_hits']);
        }
    });
}




