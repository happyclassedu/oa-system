/**
 * 文件名称：info_job.js
 * 功能描述：发布职位功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    m_load_arr_plug(); //加载数组
   
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    
     $('#a_info_job').click(function(){
        $('#a_info_job').attr('href', './info_job.htm?a=add');
    });

    $('#a_list_job').click(function(){
        $('#a_list_job').attr('href', './list_job.htm?a=list');
    });

     $('#d_begin').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_end').jdate({
        dateFormat: 'yy-mm-dd'
    });
    
    $('#d_testtime').jdate({
        dateFormat: 'yy-mm-dd'
    });

}

function m_info_set_plug() {
    
}

function m_info_add_plug() {
    m_info_time();
    m_info_com();
}


function m_info_edit_plug() {
     m_info_time();
}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
     if(confirm('您确定是否继续发布职位?')){
         i_mdi_open('../htm/info_job.htm?a=add', '发布职位', 1);
     } else {
         i_mdi_open('../htm/info_com_search.htm?a=search', '企业服务' ,1);
     }
     
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
          m_error_msg('d_error_name', '职位名称不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_type2');
    if ('' == m.tmp) {
        m_error_msg('d_error_type2', '职位性质不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_type2', '通过', '2');
    }

    m.tmp = i_obj_val('d_begin');
    if ('' == m.tmp) {
        m_error_msg('d_error_begin', '招聘起始时间不能为空，请填写！', '0');
        return false;
    }
    
    m.tmp = i_obj_val('d_end');
    if ('' == m.tmp) {
        m_error_msg('d_error_begin', '招聘截止时间不能为空，请填写！', '0');
        return false;
    }else {
        var time_s = i_obj_val('d_begin');
        if(time_s > m.tmp){
            m_error_msg('d_error_begin', '招聘开始时间大于截止时间，请重填写！', '0');
        } else {
             m_error_msg('d_error_begin', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_end');
    if ('' == m.tmp) {
        m_error_msg('d_error_num', '招聘人数不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_num', '通过', '2');
    }

    m.tmp = i_obj_val('d_big_classification');
    if ('' == m.tmp) {
        m_error_msg('d_error_classification', '职位大类不能为空，请填写！', '0');
        return false;
    }

    m.tmp = i_obj_val('d_small_classification');
    if ('' == m.tmp) {
        m_error_msg('d_error_classification', '职位小类不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_classification', '通过', '2');
    }

    m.tmp = i_obj_val('d_addr1');
    if ('' == m.tmp) {
        m_error_msg('d_error_addr', '地区省份不能为空，请填写！', '0');
        return false;
    }

    m.tmp = i_obj_val('d_addr2');
    if ('' == m.tmp) {
        m_error_msg('d_error_addr', '地区市份不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_addr', '通过', '2');
    }

    m.tmp = i_obj_val('d_intro');
    if ('' == m.tmp) {
        m_error_msg('d_error_intro', '职位描述不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_intro', '通过', '2');
    }

    m.tmp = i_obj_val('d_pay');
    if ('' == m.tmp) {
        m_error_msg('d_error_pay', '薪资金额不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_pay', '通过', '2');
    }

    m.tmp = i_obj_val('d_pay_type');
    if ('' == m.tmp) {
        m_error_msg('d_error_pay_type', '薪资类型不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_pay_type', '通过', '2');
    }

    m.tmp = i_obj_val('d_zwstate');
    if ('' == m.tmp) {
        m_error_msg('d_error_zwstate', '职位状态不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_zwstate', '通过', '2');
    }

    m.tmp = i_obj_val('d_org_name');
    if ('' == m.tmp) {
        m_error_msg('d_error_org_name', '所属部门不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_org_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_linkman');
    if ('' == m.tmp) {
        m_error_msg('d_error_linkman', '联系人不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_linkman', '通过', '2');
    }

    m.tmp = i_obj_val('d_tel');
    if('' == m.tmp){
        m_error_msg('d_error_tel', '联系电话不能为空，请重新输入！', '0');
        return false;
    } else {
        if (!m_checkTelephone(m.tmp)) {
            m_error_msg('d_error_tel', '联系电话格式不正确，请重新填写！', '0');
            return false;
        } else {
            m_error_msg('d_error_tel', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_fax');
    if('' != m.tmp){
        if (!m_checkTelephone(m.tmp)) {
            m_error_msg('d_error_fax', '传真格式不正确，请重新填写！', '0');
            return false;
        } else {
            m_error_msg('d_error_fax', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_email');
    if('' == m.tmp){
        m_error_msg('d_error_email', '电子邮箱不能为空，请重新输入！', '0');
        return false;
    } else {
        if (!m_checkEmail(m.tmp)) {
            m_error_msg('d_error_email', '邮箱格式不正确，请重新输入！', '0');
            return false;
        } else {
            m_error_msg('d_error_email', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_postid');
    if('' != m.tmp){
       if (!m_checkPostCode(m.tmp)) {
            m_error_msg('d_error_postid', '邮政编码格式不正确，请重新输入！', '0');
            return false;
        } else {
            m_error_msg('d_error_postid', '通过', '2');
        }
    }
    
    return true;
}

function m_info_com(){
    $.ajax({
        url : i_act + 'a=info_com',
        success : function(txt){         
            m.arr = i_json2js(txt);
            i_obj_set('d_cid', m.arr['id']);
            i_obj_set('d_cname', m.arr['fname']);
        }
    });
}

function m_info_time(){
    $.ajax({
        url : i_act + 'a=info_time',
        success : function(txt){
            i_obj_set('d_job_day', txt);
        }
    });
}

function m_load_arr_plug(){
    m.tmp = '';
    m_info_occupation_plug('d_big_classification', 'd_small_classification');
    m_info_job_plug('d_small_classification');
    m_info_province_plug('d_addr1', 'd_addr2');
    m_info_city_plug('d_addr2');
}
