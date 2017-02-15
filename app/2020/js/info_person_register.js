/**
 * 文件名称：info_person_register.js
 * 功能描述：个人注册功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {
    m_info_time();
    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_loginid').change(function() {
        m_info_isRegister();
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
    i_mdi_open('../htm/info_person_login.htm?a=add', '个人登录', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_loginid');
    if ('' == m.tmp) {
        m_error_msg('d_error_loginid', '账号不能为空，请填写', '0');
        return false;
    }

    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
        m_error_msg('d_error_name', '姓名不能为空，请填写', '0');
        return false;
    } else {
        m_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_loginpw');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_loginpw', '密码不能为空，请填写', '0');
        return false;
    } else {
        if (!m_isPasswd(m.tmp)) {
            m_error_msg('d_error_loginpw', '密码由6-20个字符（字母、数字、下划线）组成', '0');
            return false;
        }else {
            m_error_msg('d_error_loginpw', '通过', '2');
        }
    }

    var loginpw = i_obj_val('d_loginpw');
    var loginpw_qr = i_obj_val('d_loginpw_qr');
    if (loginpw !=loginpw_qr) {
        m_error_msg('d_error_loginpw_qr', '新密码与确认密码不一致',  '0');
        return false;
    } else {
            m_error_msg('d_error_loginpw_qr', '通过', '2');
    }

    m.tmp = i_obj_val('d_tel');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_tel', '联系电话不能为空，请填写',  '0');
        return false;
    } else {
        if (!m_checkTelephone(m.tmp)) {
            m_error_msg('d_error_tel', '联系电话格式不正确，请重新填写',  '0');
            return false;
        } else {
            m_error_msg('d_error_tel', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_email');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_email', '邮箱不能为空，请填写',  '0');
        return false;
    } else {
        if (!m_checkEmail(m.tmp)) {
            m_error_msg('d_error_email', '邮箱格式不正确，请重新填写',  '0');
            return false;
        } else {
            m_error_msg('d_error_email', '通过', '2');
        }
    }

    if ($("#d_agree").attr("checked")==false) {
        alert('用户协议是否同意，请选择！');
        return false;
    }


    return true;
}

function m_info_time(){
    $.ajax({
        url : i_act + 'a=info_time',
        success : function(txt){
            i_obj_set('d_reg_time', txt);
        }
    });
}
/**
 *用户是否注册
 */
function m_info_isRegister(){
    m.tmp = i_obj_val('d_loginid');
    $.ajax({
        url : i_act + 'a=info_isRegister',
        data : 'arr=' +  i_js2json(m.tmp),
        success : function(txt){
            m.info = i_json2js(txt);
            if('' == m.tmp){
                 m_error_msg('d_error_loginid', '用户名不能为空', '0');
            }else{
                if(m.tmp == m.info['loginid']){
                    m_error_msg('d_error_loginid', '用户：' + m.tmp + '已存在，请重新注册', '0');
                } else {
                    m_error_msg('d_error_loginid', '恭喜您，该用户：' +  m.tmp + '可以使用', '2');
                }
            }
        }
    });
}

function m_error_init(){
    m_error_msg('d_error_loginid', '可由4-20位英文字母、数字或下划线组成', '1');
    m_error_msg('d_error_name', '请输入姓名', '1');
    m_error_msg('d_error_loginpw', '可由6-20个字符（字母、数字、下划线）组成', '1');
    m_error_msg('d_error_email', '请填写有效且常用的E-mail地址', '1');
}