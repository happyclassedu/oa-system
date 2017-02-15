/**
 * 文件名称：info_com_account.js
 * 功能描述：企业注册功能的前台程序。
 * 代码作者：王争强、钱宝伟
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {
    m_info_comm();
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
//}


function m_info_edit_plug() {
    i_obj_hide('tr_h0');
    i_obj_hide('tr_h1');
    i_obj_disable('d_loginid');
    i_obj_disable('d_email');
}

function m_info_view_plug() {
    i_obj_hide('tr_h0');
    i_obj_hide('tr_h1');
    i_obj_disable('d_loginid');
    i_obj_disable('d_email');
}

//function m_info_input_plug(state) {
//
//}

//function m_act_url_plug() {
//    return false;  //可以终止跳转
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_loginid');
    if ('' == m.tmp || (m.tmp).length == 0) {
        m_error_msg('d_error_loginid', '账号不能为空，请填写', '0');
        return false;
    }

    m.tmp = i_obj_val('d_fname');
    if ('' == m.tmp || (m.tmp).length == 0) {
        m_error_msg('d_error_fname', '公司名不能为空，请填写', '0');
        return false;
    } else {
            m_error_msg('d_error_fname', '通过', '2');
    }
    
    if ('add' == m.act) {

        m.tmp = i_obj_val('d_loginpw');
        if(m.tmp == '' || (m.tmp).length == 0){
            m_error_msg('d_error_loginpw', '密码不能为空，请填写', '0');
            return false;
        } else {
            if (!m_isPasswd(m.tmp)) {
                m_error_msg('d_error_loginpw', '密码由6-20个字符（字母、数字）组成', '0');
                return false;
            } else {
                m_error_msg('d_error_loginpw', '通过', '2');
            }
        }

        var loginpw = i_obj_val('d_loginpw');
        var loginpw_qr = i_obj_val('d_loginpw_qr');
        if (loginpw !=loginpw_qr) {
            m_error_msg('d_error_loginpw_qr', '新密码与确认密码不相符，请您重新填写',  '0');
            return false;
        } else {
            m_error_msg('d_error_loginpw_qr', '通过', '2');
        }

    }
    

    m.tmp = i_obj_val('d_email');
    if(m.tmp == '' || (m.tmp).length == 0){
        m_error_msg('d_error_email', '邮箱不能为空，请填写',  '0');
        return false;
    } else {
        if (!m_checkEmail(m.tmp)) {
            m_error_msg('d_error_email', '邮箱格式不正确，请您重新填写',  '0');
            return false;
        } else {
            if('add' == m.act){
                m_info_checkemail(m.tmp);
            }
        }
    }

    m.tmp = i_obj_val('d_address');
    if ('' == m.tmp || (m.tmp).length == 0) {
        m_error_msg('d_error_address', '地区不能为空，请填写', '0');
        return false;
    }

    m.tmp = i_obj_val('d_address');
    if ('' == m.tmp || (m.tmp).length == 0) {
        m_error_msg('d_error_address', '地区不能为空，请填写', '0');
        return false;
    }

    m.tmp = i_obj_val('d_user_state');
    if ('' == m.tmp || (m.tmp).length == 0) {
        m_error_msg('d_error_user_state', '用户状态不能为空，请填写', '0');
        return false;
    }
    
    return true;
}

function m_info_comm(){
    $.ajax({
        url : i_act + 'a=info_comm',
        success : function(txt){
            m.info = i_json2js(txt);
            i_obj_set('d_reg_time', m.info['info_time']);
            i_obj_set('d_reg_ip', m.info['info_ip']);
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
            if(m.tmp == m.info['loginid']){
                m_error_msg('d_error_loginid', '用户：' + m.tmp + '已存在，请重新注册', '0');
            } else {
                m_error_msg('d_error_loginid', '恭喜您，该用户：' +  m.tmp + '可以使用', '2');
            }
        }
    });
}

/**
 *检查邮箱是否唯一
 * 参数 param : email;
 * 参数 param ：txt；
 */
function m_info_checkemail(email){
    $.ajax({
        url : i_act + 'a=info_checkemail',
        data : 'arr=' +  i_js2json(email),
        success : function(txt){
            if(txt > 0){
                m_error_msg('d_error_email', '此邮箱已被使用，请用其他邮箱',  '0');
            } else {
                m_error_msg('d_error_email', '此邮箱可以使用',  '2');
            }
        }
    });
}

function m_error_init(){
    m_error_msg('d_error_loginid', '可由4-20位英文字母、数字或下划线组成', '1');
    m_error_msg('d_error_fname', '请填写真实的公司名称', '1');
    m_error_msg('d_error_loginpw', '可由6-20个字符（字母、数字）组成', '1');
    m_error_msg('d_error_email', '请填写有效且常用的E-mail地址', '1');
}

