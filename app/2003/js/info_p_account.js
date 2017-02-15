/**
 * 文件名称：info_p_account.js
 * 功能描述：新增个人账号的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {

    m.check = '0';
    m.ws_id = i_get('ws_id');
    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_loginid').blur(function(){
        m_info_name_check(this.id);
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    i_obj_set('d_ws_id', m.ws_id);
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

//function m_act_url_plug() {
//    return false;  //可以终止跳转
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_loginid');
    if ('' == m.tmp) {
        i_error_msg('d_error_loginid', '账号不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_loginid', '通过', '2');
    }

    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
        i_error_msg('d_error_name', '姓名不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_loginpw');
    if(m.tmp == '' && (m.tmp).length == 0){
        i_error_msg('d_error_loginpw', '密码不能为空，请填写！', '0');
        return false;
    } else {
        if (!i_verify_ispwd(m.tmp)) {
            i_error_msg('d_error_loginpw', '密码由6-20个字符（字母、数字、下划线）组成！', '0');
            return false;
        }else {
            i_error_msg('d_error_loginpw', '通过', '2');
        }
    }

    var loginpw = i_obj_val('d_loginpw');
    var loginpw_qr = i_obj_val('d_loginpw_qr');
    if (loginpw !=loginpw_qr) {
        i_error_msg('d_error_loginpw_qr', '新密码与确认密码不一致！',  '0');
        return false;
    } else {
            i_error_msg('d_error_loginpw_qr', '通过', '2');
    }

    m.tmp = i_obj_val('d_tel');
    if(m.tmp == '' && (m.tmp).length == 0){
        i_error_msg('d_error_tel', '联系电话不能为空，请填写！',  '0');
        return false;
    } else {
        if (!i_verify_tel(m.tmp)) {
            i_error_msg('d_error_tel', '联系电话格式不正确，请重新填写！',  '0');
            return false;
        } else {
            i_error_msg('d_error_tel', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_email');
    if(m.tmp == '' && (m.tmp).length == 0){
        i_error_msg('d_error_email', '邮箱不能为空，请填写！',  '0');
        return false;
    } else {
        if (!i_verify_email(m.tmp)) {
            i_error_msg('d_error_email', '邮箱格式不正确，请重新填写！',  '0');
            return false;
        } else {
            i_error_msg('d_error_email', '通过', '2');
        }
    }

    return true;
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
                 i_error_msg('d_error_loginid', '用户名不能为空', '0');
            }else{
                if(m.tmp == m.info['loginid']){
                    i_error_msg('d_error_loginid', '用户：' + m.tmp + '已存在，请重新注册', '0');
                } else {
                    i_error_msg('d_error_loginid', '恭喜您，该用户：' +  m.tmp + '可以使用', '2');
                }
            }
        }
    });
}

function m_error_init(){
    i_error_msg('d_error_loginid', '可由4-20位英文字母、数字或下划线组成', '1');
    i_error_msg('d_error_name', '请输入姓名', '1');
    i_error_msg('d_error_loginpw', '可由6-20个字符（字母、数字、下划线）组成', '1');
    i_error_msg('d_error_email', '请填写有效且常用的E-mail地址', '1');
}

function m_info_name_check(obj_id) {
    m.arr = i_obj_val(obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&x=' + m.xid + '&obj_id=' + obj_id.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check = '1';
                    i_error_msg('d_error_loginid', '对不起：数据库中已存在相同值！', '0');
                    $('#' + obj_id).focus();
                } else {
                    m.check = '0';
                }
            }
        });
    }
}