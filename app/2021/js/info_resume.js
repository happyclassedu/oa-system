/**
 * 文件名称：info_resume_basic.js
 * 功能描述：填写简历个人信息功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改时间：2010-07-29
 * 当前版本：v1.0
 */
//$(document).ready(function(){
//
//    });

function m_load() {
    m_load_arr_plug();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {

    $('#d_birth').jdate({
        dateFormat: 'yy-mm-dd'
    });
}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}

function m_info_add_plug() {
    i_obj_disable('d_p_id');
}

function m_info_edit_plug() {
    i_obj_disable('d_p_id');
}

//function m_info_view_plug() {
//}

//function m_info_input_plug(state) {
//
//}

//function m_act_url_plug() {
//    return false;  //可以终止跳转
//}

function m_info_save_plug() {

    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
          m_error_msg('d_error', '姓名不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_sex');
    if ('' == m.tmp) {
          m_error_msg('d_error', '性别不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_addr');
    if ('' == m.tmp) {
          m_error_msg('d_error', '现居住地不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_hukou');
    if ('' == m.tmp) {
          m_error_msg('d_error', '户口所在地不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_card_type');
    if ('' == m.tmp) {
          m_error_msg('d_error', '证件类型不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_idcard');
    if ('' == m.tmp) {
          m_error_msg('d_error', '证件号码不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_degree');
    if ('' == m.tmp) {
          m_error_msg('d_error', '教育程度不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_email');
    if('' == m.tmp){
        m_error_msg('d_error', '邮箱地址不能为空，请填写！', '0');
        return false;
    } else {
        if (!m_checkEmail(m.tmp)) {
            m_error_msg('d_error', '邮箱格式不正确，请重新输入！', '0');
            return false;
        } else {
            m_error_msg('d_error', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_qq');
    if (!m_checkQQ(m.tmp) && '' != m.tmp) {
        m_error_msg('d_error', 'QQ格式不正确，请重新输入！', '0');
        return false;
    } else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_mobile');
    if('' == m.tmp){
        m_error_msg('d_error', '移动电话不能为空，请填写！', '0');
        return false;
    } else {
        if (!m_checkMobilePhone(m.tmp)) {
            m_error_msg('d_error', '移动电话格式不正确，请重新输入！', '0');
            return false;
        } else {
            m_error_msg('d_error', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_tel');
    if (!m_checkTelephone(m.tmp) && ''!= m.tmp) {
        m_error_msg('d_error', '固定电话格式不正确，请重新填写！', '0');
        return false;
    } else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_postid');
    if (!m_checkPostCode(m.tmp) && '' != m.tmp) {
        m_error_msg('d_error', '邮政编码格式不正确，请重新输入！', '0');
        return false;
    } else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_curr_trade');
    if ('' == m.tmp) {
          m_error_msg('d_error', '现从事行业不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_curr_big_classification');
    if ('' == m.tmp) {
          m_error_msg('d_error', '现从事职业大类不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_curr_small_classification');
    if ('' == m.tmp) {
          m_error_msg('d_error', '现从事职业小类不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_curr_joblevel');
    if ('' == m.tmp) {
          m_error_msg('d_error', '现职位级别不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_trade');
    if ('' == m.tmp) {
          m_error_msg('d_error', '期望从事行业不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_big_classification');
    if ('' == m.tmp) {
          m_error_msg('d_error', '期望从事职业大类不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_small_classification');
    if ('' == m.tmp) {
          m_error_msg('d_error', '期望从事职业小类不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_addr1');
    if ('' == m.tmp) {
          m_error_msg('d_error', '期望工作地区省份不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_addr2');
    if ('' == m.tmp) {
          m_error_msg('d_error', '期望工作地区市份不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_post_time');
    if ('' == m.tmp) {
          m_error_msg('d_error', '到岗时间不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_add_topic');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error', '附加主题不能为空，请填写！',  '0');
        return false;
    } else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_add_content');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error', '附加内容不能为空，请填写！',  '0');
        return false;
    } else {
        if((m.tmp).length > 1500){
            m_error_msg('d_error', '附加内容不能超过1500字，请重写！',  '0');
            return false;
        } else {
            m_error_msg('d_error', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_rname');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error', '简历名称不能为空，请填写',  '0');
        return false;
    } else {
        m_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_rgift');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error', '联系电话不能为空，请填写',  '0');
        return false;
    } else {
        m_error_msg('d_error', '通过', '2');
    }
    
    return true;
}

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