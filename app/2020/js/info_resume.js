/**
 * 文件名称：info_resume.js
 * 功能描述：创建简历及修改设置的前台程序。
 * 代码作者：王争强、钱宝伟
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */
var pid = '';
var num = ''; //简历条数

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
    pid = i_get('p_id');
    i_obj_set('d_p_id', pid);
    m_resume_limit_num();
//    m_info_test(); 测试函数
//    m_error_init();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    
     $('#a_resume_list').click(function(){
       $('#a_resume_list').attr('href', './list_resume.htm?a=list&p_id=' + pid);
    });
    
     $('#a_resume_letter').click(function(){
       $('#a_resume_letter').attr('href', './info_resume_letter.htm?a=add&p_id=' + pid);
    });

}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    i_obj_set('d_rgift', 'cn');
    i_obj_set('d_rptype', '对所有公开');
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
    i_mdi_open('./info_resume_basic.htm?a=edit&x=' + m.xid + '&rid=' + m.xid, '简历--个人信息', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_rname');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_rname', '简历名称不能为空，请填写',  '0');
        return false;
    } else {
        m_error_msg('d_error_rname', '通过', '2');
    }

    m.tmp = i_obj_val('d_rgift');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_rgift', '联系电话不能为空，请填写',  '0');
        return false;
    } else {  
        m_error_msg('d_error_rgift', '通过', '2');
    }

    if(num > 5){
        alert('对不起，您的简历超过了5份！');
        return false;
    }
    
    return true;
}

//function m_error_init(){
//
//}

function m_resume_limit_num(){
    $.ajax({
        url : i_act + 'a=list_num',
        success : function(txt){
            num = txt;
        }
    });
}