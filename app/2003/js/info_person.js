/**
* 文件名称：info_person.js
* 功能描述：个人中心的前台程序。
* 代码作者：王争强
* 创建日期：2010-08-09
* 修改时间：2010-08-09
* 当前版本：v1.0
*/

//$(document).ready(function(){
//
//    });

function m_load() {
    m_get_session();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#btn_view_resume').click(function(){
        i_mdi_open('./info_p_resume.htm?a=view&x=' + m.xid, '查看简历--个人中心', 1);
     });

    $('#btn_edit_resume').click(function(){
        i_mdi_open('./info_p_resume.htm?a=edit&x=' + m.xid, '修改简历--个人中心', 1);
    });
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
            m.xid = txt;
        }
    });
}
