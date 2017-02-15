/**
 * 文件名称：info_job.js
 * 功能描述：岗位管理模块的信息程序。
 * 代码作者：钱包伟（创建）、王争强（优化）、孙振强（重构）
 * 创建日期：2010-06-10
 * 修改日期：2010-07-18
 * 当前版本：V3.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.loginid_check = 'ok';
//    alert(m.xid);
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#d_loginid').change(function(){
        m_info_loginid_check();
    });

    $('#d_loginpw').focus(function(){
        i_obj_set('d_loginpw', '');
    });

    $('#d_loginpw').blur(function(){
        if ('' == i_obj_val('d_loginpw')) {
            i_obj_set('d_loginpw', m.info['loginpw']);
        }
    });
}

//function m_info_set_plug() {
//   alert(m.xid);
//}

function m_info_add_plug() {
    $('#d_name').addClass('info_must');
    $('#d_loginid').addClass('info_must');
    $('#d_loginpw').addClass('info_must');
}

function m_info_edit_plug() {
    $('#d_name').addClass('info_must');
    $('#d_loginid').addClass('info_must');
    $('#d_loginpw').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_name').removeClass('info_must');
    $('#d_loginid').removeClass('info_must');
    $('#d_loginpw').removeClass('info_must');
}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    if ('ok' != m.loginid_check) {
        alert('对不起：已有相同登录账号，请重新输入。');
        return false;
    }

    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入用户姓名！');
        return false;
    }
    if ('' == i_obj_val('d_loginid')) {
        alert('对不起，请输入登录账号！');
        return false;
    }
    if ('' == i_obj_val('d_loginpw')) {
        alert('对不起，请输入登录密码！');
        return false;
    }
    return true;
}

//function m_info_del_ok() {
//    i_mdi_open('./list_' + g.id_name + '.htm?a=list' , '列表管理', 1);
//}

//function m_info_del_fail(arr) {
//    if (0 > arr) {
//        alert('删除用户：“' + m.info['name'] + '”失败！\n\n该岗位尚有员工，请先解除关系。');
//    } else if (0 == arr) {
//        alert('删除岗位：“' + m.info['name'] + '”失败！');
//    }
//}

function m_info_loginid_check() {
    m.arr = i_obj_val('d_loginid');
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_loginid_check&x=' + m.xid,
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                m.loginid_check = 'ok';
                if (0 < m.arr) {
                    m.loginid_check = 'false';
                    alert('对不起：已有相同登录账号，请重新输入。');
                }
            }
        });
    }
}