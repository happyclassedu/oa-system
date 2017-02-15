/**
 * 文件名称：info_person_pwd.js
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
    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
     $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_edit_pwd').click();
        }
    });

     $('#btn_add_person').click(function(){
        i_mdi_open('./info_person_account.htm?a=add', '新增信息');
    });

    $('#btn_edit_pwd').click(function(){
       if(m_info_validate_plug()){
            var loginpw_x =  i_obj_val("d_loginpw_x");
            var loginpw_qr= i_obj_val('d_loginpw_qr');
            if('' != loginpw_x && '' != loginpw_qr && loginpw_x==loginpw_qr){
                   m_info_edit_pwd_plug();
            }else{
                m_error_msg('d_error_loginpw_qr', '确认新密码与新密码不一致，请填写', '0');
            }
        }
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
//
//    return true;
//}



function m_info_validate_plug(){
    m.tmp = i_obj_val('d_loginpw');
    if ('' == m.tmp) {
        m_error_msg('d_error_loginpw', '旧密码不能为空，请填写', '0');
        return false;
    } else {
         $.ajax({
            url : i_act + 'a=' + 'info_checkpwd&x=' + m.xid,
            success : function(txt){
               m.info = i_json2js(txt);
               if( i_obj_val('d_loginpw') != m.info['loginpw']){
                   m_error_msg('d_error_loginpw', '旧密码不正确，请填写', '0');
               } else {
                   m_error_msg('d_error_loginpw', '通过', '2');
               }
            }
        });

    }

    m.tmp = i_obj_val('d_loginpw_x');
    if ('' == m.tmp) {
        m_error_msg('d_error_loginpw_x', '新密码不能为空，请填写', '0');
        return false;
    } else {
        m_error_msg('d_error_loginpw_x', '通过', '2');
    }

    m.tmp = i_obj_val('d_loginpw_qr');
    if ('' == m.tmp) {
        m_error_msg('d_error_loginpw_qr', '确认新密码不能为空，请填写', '0');
        return false;
    } else {
        m_error_msg('d_error_loginpw_qr', '通过', '2');
    }
    return true;
}


function m_info_edit_pwd_plug () {
     $.ajax({
            url : i_act + 'a=' + 'info_pwd&x=' + m.xid,
            data : 'arr='+ i_js2json(i_obj_val("d_loginpw_x")),
            success : function(txt){
               if('1' == txt){
                   alert('修改成功！');
                   m_act_url_plug();
               } else {
                   alert('修改失败！');
               }
            }
        });
}

function m_error_init(){
    m_error_msg('d_error_loginpw', '可用英文字母、数字，6-20位', '1');
    m_error_msg('d_error_loginpw_x', '可用英文字母、数字，6-20位', '1');
    m_error_msg('d_error_loginpw_qr', '可用英文字母、数字，6-20位', '1');
}

function m_act_url_plug() {
    m.act_url = i_obj_val('act_url');
    switch (m.act_url) {
        default: case 'view':
            i_mdi_open('./info_person_pwd.htm?a=view&x=' + m.xid, '查看信息', 1);
            break;
        case 'add':
            i_mdi_open('./info_person_account.htm?a=add' , '新增信息', 1);
            break;
        case 'list':
            i_mdi_open('./list_person_account.htm?a=list' , '列表管理', 1);
            break;
    }
}
