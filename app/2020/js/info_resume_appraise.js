/**
 * 文件名称：info_resume_appraise.js
 * 功能描述：(简历)自我评价/职业目标的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */
var pid='';

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }

//    m_error_init();
//    return false;  //可以终止初始化
}

//function m_btn_load_plug() {
//
//}

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

function m_act_url_plug() {
    i_mdi_open('./info_resume_educate.htm?a=add&rid=' + m.xid +'&x='+ m.xid, '简历--教育背景', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_selfvalue');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_selfvalue', '自我评价不能为空，请填写',  '0');
        return false;
    } else {
        if((m.tmp).length < 500){
             m_error_msg('d_error_selfvalue', '通过', '2');
        } else {
             m_error_msg('d_error_selfvalue', '自我评价描述超过了500字，请重写', '0');
             return false;
        }
    }
    
    m.tmp = i_obj_val('d_jobgoal');
    if(m.tmp != '' &&(m.tmp).length < 500){
        m_error_msg('d_error_jobgoal', '通过', '2');
    } else {
        m_error_msg('d_error_jobgoal', '自我评价描述超过了500字，请重写', '0');
    }

    return true;
}

//function m_error_init(){
//
//}

