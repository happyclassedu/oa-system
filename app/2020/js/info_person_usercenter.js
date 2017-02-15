/**
* 文件名称：info_person_usercenter.js
* 功能描述：个人管理中心的前台程序。
* 代码作者：王争强
* 创建日期：2010-08-09
* 修改时间：2010-08-09
* 当前版本：v1.0
*/
var pid = '';

//$(document).ready(function(){
//
//    });

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }

    m_get_session();
    m_init_plug();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#a_info_resume').click(function(){
       $('#a_info_resume').attr('href', './info_resume.htm?a=add&p_id=' + pid);
    });

     $('#a_info_person').click(function(){
       $('#a_info_person').attr('href', './list_person_job.htm?a=list&p_id=' + pid);
    });

     $('#a_job_applist').click(function(){
       $('#a_job_applist').attr('href', './list_job_applist.htm?a=list&p_id=' + pid);
    });

     $('#a_job_invite').click(function(){
       $('#a_job_invite').attr('href', './list_job_invite.htm?a=list&p_id=' + pid);
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
            pid = txt;
        }
    });
}

function m_init_plug() {
    $.ajax({
        url : i_act + 'a=info_init' ,
        success : function(txt){
           m.info = i_json2js(txt);
           i_obj_set('d_loginid', m.info['loginid']);
           i_obj_set('d_login_time', (m.info['login_time']).substring(0, 10));
           i_obj_set('d_login_hits', m.info['login_hits']);
        }
    });
}


