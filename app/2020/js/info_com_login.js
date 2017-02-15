/**
 * 文件名称：info_com_login.js
 * 功能描述：企业登录功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
     $('#btn_login').click(function(){
       m_info_login();
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

//function m_info_save_plug() {
//    return true;
//}
/*******登录函数*******/
function m_info_login(){

    m.arr = new Object();
    m.arr['loginid'] = i_obj_val('d_username');
    m.arr['loginpw'] = i_obj_val('d_password');
    //        m_islogin();
    $.ajax({
        url : i_act + 'a=info_login',
        data : 'arr=' +  i_js2json(m.arr),
        success : function(txt){
            switch (txt) {
                case 'err_u_null' :
                    m_error_msg('d_error_username', '用户名不能为空，请选择！', '0');
                    break;
                case 'err_u_nexist' :
                    m_error_msg('d_error_username', '用户不存在，请注册！', '0');
                    break;
                case 'err_pwd_null' :
                    m_error_msg('d_error_username', '', '2');
                    m_error_msg('d_error_password', '密码不能为空，请选择！', '0');
                    break;
                case 'err_pwd_no' :
                    m_error_msg('d_error_password', '密码不正确，请重新填写！', '0');
                    break;
                case 'err_session_inval' :
                    m_error_msg('d_error_password', 'session失效，请检查！', '0');
                    break;
                case txt :
                    $.cookie('c_id', txt);
                    i_mdi_open('./info_com_usercenter.htm?a=ucenter', '', 1);
                    break;
                default :
                    alert('操作错误，正在关闭！');
                    i_mdi_close();
                    break;
            }
        }
    });
}
