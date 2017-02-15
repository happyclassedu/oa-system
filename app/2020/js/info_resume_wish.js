/**
 * 文件名称：info_resume_wish.js
 * 功能描述：修改求职意向的前台程序。
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
    m_load_arr_plug(); //加载数组
    
//    m_error_init();
//    return false;  //可以终止初始化
}


//function m_btn_load_plug() {
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
    i_mdi_open('./info_resume_appraise.htm?a=edit&x=' + rid + '&rid='+ rid, '简历--自我评价/职业目标', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_curr_trade');
    if ('' == m.tmp) {
          m_error_msg('d_error_curr_trade', '现从事行业不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_curr_trade', '通过', '2');
    }

    m.tmp = i_obj_val('d_curr_big_classification');
    if ('' == m.tmp) {
          m_error_msg('d_error_curr_classification', '现从事职业大类不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_curr_classification', '通过', '2');
    }

    m.tmp = i_obj_val('d_curr_small_classification');
    if ('' == m.tmp) {
          m_error_msg('d_error_curr_classification', '现从事职业小类不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_curr_classification', '通过', '2');
    }

    m.tmp = i_obj_val('d_curr_joblevel');
    if ('' == m.tmp) {
          m_error_msg('d_error_curr_joblevel', '现职位级别不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_curr_joblevel', '通过', '2');
    }

    m.tmp = i_obj_val('d_trade');
    if ('' == m.tmp) {
          m_error_msg('d_error_trade', '期望从事行业不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_trade', '通过', '2');
    }

    m.tmp = i_obj_val('d_big_classification');
    if ('' == m.tmp) {
          m_error_msg('d_error_classification', '期望从事职业大类不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_classification', '通过', '2');
    }

    m.tmp = i_obj_val('d_small_classification');
    if ('' == m.tmp) {
          m_error_msg('d_error_classification', '期望从事职业小类不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_classification', '通过', '2');
    }

    m.tmp = i_obj_val('d_addr1');
    if ('' == m.tmp) {
          m_error_msg('d_error_addr', '期望工作地区省份不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_addr', '通过', '2');
    }

    m.tmp = i_obj_val('d_addr2');
    if ('' == m.tmp) {
          m_error_msg('d_error_addr', '期望工作地区市份不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_addr', '通过', '2');
    }

    m.tmp = i_obj_val('d_post_time');
    if ('' == m.tmp) {
          m_error_msg('d_error_post_time', '到岗时间不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_post_time', '通过', '2');
    }

    
    return true;
}

//function m_error_init(){
//
//}


function m_load_arr_plug(){
    m.tmp = '';
    m_info_industry_plug('d_curr_trade');
    m_info_occupation_plug('d_curr_big_classification', 'd_curr_small_classification');
    m_info_job_plug('d_curr_small_classification');
    m_info_industry_plug('d_trade');
    m_info_occupation_plug('d_big_classification', 'd_small_classification');
    m_info_job_plug('d_small_classification');
    m_info_province_plug('d_addr1', 'd_addr2');
    m_info_city_plug('d_addr2');
}