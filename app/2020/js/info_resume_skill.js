/**
 * 文件名称：info_resume_skill.js
 * 功能描述：修改专业技能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

var rid = '';

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
    rid = i_get('rid');
//    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {


}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
}


//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
//    window.location.reload();
//    i_mdi_open('./info_resume_train.htm?a=add&x=' + rid +'&rid='+ rid, '简历--培训经历', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_skilldesc');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_skilldesc', '职业技能不能为空，请填写！',  '0');
        return false;
    } else {
        m_error_msg('d_error_skilldesc', '通过', '2');
    }
    return true;
}

