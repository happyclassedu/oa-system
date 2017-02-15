/**
 * 文件名称：info_p_resume.js
 * 功能描述：填写简历信息的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改时间：2010-07-29
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {
//    m.tmp = m_ssession_verify();
//    if (false == m.tmp) {
//        return false;
//    }

//    return false;  //可以终止初始化
}


function m_btn_load_plug() {

    $('#d_birth').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_ebegina').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_eenda').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_ebeginb').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_eendb').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_ebeginc').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_eendc').jdate({
        dateFormat: 'yy-mm-dd'
    });

       $('#d_fbegina').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_fenda').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_fbeginb').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_fendb').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_fbeginc').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $('#d_fendc').jdate({
        dateFormat: 'yy-mm-dd'
    });
}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//}

//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
    i_mdi_open('./ucenter_p.htm?a=center', '简历--个人中心', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
          i_error_msg('d_error', '姓名不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_sex');
    if ('' == m.tmp) {
          i_error_msg('d_error', '性别不能为空，请选择！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_birth');
    if ('' == m.tmp) {
          i_error_msg('d_error', '出生年月不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_idcard');
    if ('' == m.tmp) {
          i_error_msg('d_error', '证件号码不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

     m.tmp = i_obj_val('d_shequ');
    if ('' == m.tmp) {
          i_error_msg('d_error', '所属社区不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_degree');
    if ('' == m.tmp) {
          i_error_msg('d_error', '文化程度不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_univ');
    if ('' == m.tmp) {
          i_error_msg('d_error', '毕业学校不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_major');
    if ('' == m.tmp) {
          i_error_msg('d_error', '专业不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_email');
    if('' == m.tmp){
        i_error_msg('d_error_email', '邮箱地址不能为空，请填写！', '0');
        return false;
    } else {
        if (!i_verify_email(m.tmp)) {
            i_error_msg('d_error_email', '邮箱格式不正确，请重新输入！', '0');
            return false;
        } else {
            i_error_msg('d_error_email', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_qq');
    if (!i_verify_qq(m.tmp) && '' != m.tmp) {
        i_error_msg('d_error_qq', 'QQ格式不正确，请重新输入！', '0');
        return false;
    } else {
        i_error_msg('d_error_qq', '通过', '2');
    }

    m.tmp = i_obj_val('d_mobile');
    if('' == m.tmp){
        i_error_msg('d_error', '移动电话不能为空，请填写！', '0');
        return false;
    } else {
        if (!i_verify_phone(m.tmp)) {
            i_error_msg('d_error', '移动电话格式不正确，请重新输入！', '0');
            return false;
        } else {
            i_error_msg('d_error', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_addr');
    if ('' == m.tmp) {
          i_error_msg('d_error', '居住地址不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }

     m.tmp = i_obj_val('d_joba');
    if ('' == m.tmp) {
          i_error_msg('d_error', '应聘职位A不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error', '通过', '2');
    }


    m.tmp = i_obj_val('d_tel');
    if (!i_verify_tel(m.tmp) && ''!= m.tmp) {
        i_error_msg('d_error', '固定电话格式不正确，请重新填写！', '0');
        return false;
    } else {
        i_error_msg('d_error', '通过', '2');
    }

    m.tmp = i_obj_val('d_postid');
    if (!i_verify_post(m.tmp) && '' != m.tmp) {
        i_error_msg('d_error', '邮政编码格式不正确，请重新输入！', '0');
        return false;
    } else {
        i_error_msg('d_error', '通过', '2');
    }

    return true;
}
