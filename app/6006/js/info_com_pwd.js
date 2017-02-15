/**
 * 文件名称：info_com_pwd.js
 * 功能描述：修改账号密码功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
//    m.tmp = m_ssession_verify();
//    if (false == m.tmp) {
//        return false;
//    }
   i_read_js('function');
    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_edit_pwd').click();
        }
    });
    
    $('#btn_edit_pwd').click(function(){
       if(m_info_validate_plug()){
            var loginpw_x =  i_obj_val("d_loginpw_x");
            var loginpw_qr= i_obj_val('d_loginpw_qr');
            m.tmp = loginpw_x;
            if('' != loginpw_x && '' != loginpw_qr && loginpw_x==loginpw_qr){
                   m_error_msg('d_error_loginpw_qr', '通过', '2');
                   return true;
            }else{
                m_error_msg('d_error_loginpw_qr', '确认新密码与新密码不一致，请填写！', '0');
                return false;
            }
        }

        m_info_edit_pwd_plug();
    });

}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}


function m_info_edit_plug() {
    i_obj_disable('d_loginid');
    i_obj_disable('d_loginpw');
}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

//function m_info_save_plug() {
//
//    return true;
//}



function m_info_validate_plug(){

    m.tmp = i_obj_val('d_loginpw_x');
    if ('' == m.tmp) {
        m_error_msg('d_error_loginpw_x', '新密码不能为空，请填写！', '0');
        return false;
    } else {
        m_error_msg('d_error_loginpw_x', '通过', '2');
    }

    m.tmp = i_obj_val('d_loginpw_qr');
    if ('' == m.tmp) {
        m_error_msg('d_error_loginpw_qr', '确认新密码不能为空，请填写！', '0');
        return false;
    } else {
        m_error_msg('d_error_loginpw_qr', '通过', '2');
    }
    return true;
}


function m_info_edit_pwd_plug () {
     $.ajax({
            url : i_act + 'a=' + 'info_pwd&x=' + m.xid,
            data : 'arr='+ i_js2json(m.tmp),
            success : function(txt){
               if(txt > 0){
                    alert('密码修改成功！');
               }else{
                   alert('密码修失败！');
               }
            }
        });
}

function m_error_init(){
    m_error_msg('d_error_loginpw_x', '可用英文字母、数字，6-20位！', '1');
    m_error_msg('d_error_loginpw_qr', '可用英文字母、数字，6-20位！', '1');
}
