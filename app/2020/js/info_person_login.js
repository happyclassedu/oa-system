/**
* 文件名称：info_person_login.js
* 功能描述：个人登录功能的前台程序。
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
        m_person_login();
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
//    m.tmp = i_obj_val('d_loginpw');
//    if(m.tmp == '' && (m.tmp).length == 0){
//        alert('密码不能为空，请填写！');
//        return false;
//    }
//    return true;
//}

function m_person_login(){

    m.arr = new Object();
    m.arr['loginid'] = i_obj_val('d_loginid');
    m.arr['loginpw'] = i_obj_val('d_loginpw');
        //        m_islogin();
    $.ajax({
        url : i_act + 'a=info_login',
        data : 'arr=' +  i_js2json(m.arr),
        success : function(txt){
             switch (txt) {
                case 'err_u_null' :
                    alert('用户名不能为空，请填写！');
                    break;
                case 'err_pwd_null' :
                    alert('密码不能为空，请填写！');
                    break;
                case 'err_pwd_no' :
                    alert('密码不正确，请重新填写！');
                    break;
                case 'err_u_nexist' :
                    alert('用户不存在，请注册！');
                    break;
                case 'err_session_inval' :
                    alert('session失效，请检查！');
                    break;
                case 'err_longin' :
                    i_mdi_open('/info_person_usercenter.htm?a=ucenter', '个人中心', 1);
                    break;
                default :
                    alert('操作错误，正在关闭！');
                    i_mdi_close();
                    break;
            }
        }
    });
}

function m_get_session(){
    $.ajax({
        url : i_act + 'a=info_session',
        success : function(txt){
            m.xid = txt;
        }
    });
}


