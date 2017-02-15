/**
* 文件名称：info_com.js
* 功能描述：企业中心（曲江人才）的前台程序。
* 代码作者：王争强
* 创建日期：2010-08-09
* 修改时间：2010-08-09
* 当前版本：v1.0
*/

//$(document).ready(function(){
//
//    });

function m_load() {
    i_read_js('function');
    m_get_session();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#btn_view_com').click(function(){
        i_mdi_open('./info_com_detail.htm?a=view&x=' + m.xid, '查看公司信息--企业中心', 1);
     });

    $('#btn_edit_com').click(function(){
        i_mdi_open('./info_com_detail.htm?a=edit&x=' + m.xid, '修改公司信息--企业中心', 1);
    });

    $('#btn_edit_pwd').click(function(){
        i_mdi_open('./info_com_pdw.htm?a=edit&x=' + m.xid, '修改密码', 1);
    });

    $('#btn_add_job').click(function(){
        i_mdi_open('./info_job.htm?a=add&c_id=' + m.xid, '发布职位', 1);
    });

    $('#btn_view_job').click(function(){
        i_mdi_open('./list_job.htm?a=list&c_id=' + m.xid, '职位列表', 1);
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
