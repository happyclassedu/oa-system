/**
 * 文件名称：info_person_basic.js
 * 功能描述：修改基本信息的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */
var p_id='';

$(document).ready(function(){
    p_id = i_get('p_id');
});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
    i_obj_set('d_p_id', p_id);
//    m_info_test(); 测试函数
//    m_error_init();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#a_resume_create').click(function(){
       i_mdi_open('./info_resume_create.htm?a=add&p_id=' + p_id);
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

function m_act_url_plug() {
//    i_mdi_open('');
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

    return true;
}

//function m_error_init(){
//
//}
