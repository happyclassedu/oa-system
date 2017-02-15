/**
 * 文件名称：info_register.js
 * 功能描述：注册信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */


var ws_id = '8';
var ws_name = '西安立丰集团';

//$(document).ready(function(){
//    alert('1最先执行');
//});

//function m_load() {
//}

function m_btn_load_plug() {
     $('#btn_isuser').click(function(){
       m.tmp = i_obj_val('d_loginid');
       m_isuser(m.tmp);
    });


    $('#d_birth').jdate({
        //                    showButtonPanel: false,
        //                    changeMonth: false,
        //                    changeYear: false,
        //                    numberOfMonths: 2,
        dateFormat: 'yy-mm-dd'
    });

    $('#d_jparty_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_idcard').change(function(){
       i_check_cardid('d_idcard', 'd_error_idcard', 'd_sex' , 'd_birth')
    });

    $('#btn_reset').click(function(){
        i_obj_set('d_loginid', '');
        i_obj_set('d_loginpw', '');
        i_obj_set('d_loginpw_r', '');
        i_obj_set('d_sex', '');
        i_obj_set('d_tel0', '');
        i_obj_set('d_tel1', '');
        i_obj_set('d_email', '');
        i_obj_set('d_qq', '');
     });
}

function m_info_set_plug() {

}

function m_info_add_plug() {
    //留言板模块的信息配置
    i_obj_set('d_ws_id', ws_id);  //配置信息的网站地址
    i_obj_set('d_ws_name',ws_name);  //配置信息的网站名称
}

//function m_info_edit_plug() {
//}

//function m_info_view_plug() {
//}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_loginid');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_loginid', '用户名不能为空，请填写！', '0');
        return false;
    } else {
        m_isuser(m.tmp);
    }

    m.tmp = i_obj_val('d_loginpw');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_loginpw', '密码不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_loginpw', '通过', '2');
    }

    m.tmp = i_obj_val('d_loginpw_r');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_loginpw_r', '确认密码不能为空，请填写！', '0');
        return false;
    } else {
        if( m.tmp != i_obj_val('d_loginpw')){
            i_error_msg('d_error_loginpw_r', '确认密码与密码不一致，请填写！', '0');
        }else {
            i_error_msg('d_error_loginpw_r', '通过', '2');
        }
    }
    
    m.tmp = i_obj_val('d_tel0');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_tel0', '固有电话不能为空，请填写！', '0');
        return false;
    } else {
         if (!i_verify_tel(m.tmp)) {
            i_error_msg('d_error_tel0', '固有电话格式不正确，请您重新填写！',  '0');
            return false;
        } else {
            i_error_msg('d_error_tel0', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_tel1');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_tel1', '手机不能为空，请填写！', '0');
        return false;
    } else {
         if (!i_verify_phone(m.tmp)) {
            i_error_msg('d_error_tel1', '手机格式不正确，请您重新填写！',  '0');
            return false;
        } else {
            i_error_msg('d_error_tel1', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_email');
    if(m.tmp == '' || (m.tmp).length == 0){
        i_error_msg('d_error_email', '邮箱不能为空，请填写！',  '0');
        return false;
    } else {
        if (!i_verify_email(m.tmp)) {
            i_error_msg('d_error_email', '邮箱格式不正确，请您重新填写！',  '0');
            return false;
        } else {
            i_error_msg('d_error_email', '通过', '2');
        }
    }


    return true;
}

function m_act_url_plug() {
    return false;
}

function m_isuser(arr){
    if(!arr){
        i_error_msg('d_error_loginid', '用户名不能空，请填写！',  '0');
        return false;
    }

    $.ajax({
        url : g.act + 'info_login.php?a=is_user&ws_id=' + ws_id,
        data : 'arr=' +  i_js2json(arr),
        success : function(txt){
            if('1'== txt){
               i_error_msg('d_error_loginid', '用户名已存在，请重新注册！',  '0');
               return false;
            } else if('0' == txt){
               i_error_msg('d_error_loginid', '恭喜你，用户名' + arr + '可以使用！',  '2');
            }
        }
    });
}
