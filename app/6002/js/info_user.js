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
    i_read_js('lib_idcard', 0);
    m.check = '0';
//    m.loginid_check = 'ok';
//    alert(m.xid);
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#d_login_id').change(function(){
        m_act_login_id();
    });

    $('#d_login_pw').focus(function(){
        i_obj_set('d_loginpw', '');
    });

    $('#d_login_pw').blur(function(){
        if ('' == i_obj_val('d_login_pw')) {
            i_obj_set('d_login_pw', m.info['login_pw']);
        }
    });

    $('#d_idcard').change(function(){
        m_act_idcard();
    });

    $('#d_org').click(function(){
        if ('查看' == i_obj_val('sys_state')) {
            return;
        }
        i_box_open({
            content: '../../3400/htm/x_org_choose.htm',
            player: 'iframe',
            title: '',
            width: '700px',
            height: '300px'
        });
    });
}

//function m_info_set_plug() {
//   alert(m.xid);
//}

//function m_info_add_plug() {
//    $('#d_name').addClass('info_must');
//    $('#d_loginid').addClass('info_must');
//    $('#d_loginpw').addClass('info_must');
//}
//
//function m_info_edit_plug() {
//    $('#d_name').addClass('info_must');
//    $('#d_loginid').addClass('info_must');
//    $('#d_loginpw').addClass('info_must');
//}
//
//function m_info_view_plug() {
//    $('#d_name').removeClass('info_must');
//    $('#d_loginid').removeClass('info_must');
//    $('#d_loginpw').removeClass('info_must');
//}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    if ('0' != m.check) {
        alert('对不起：数据库已有重复记录，请重新输入。');
        return false;
    }

    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入用户姓名！');
        return false;
    }
    if ('' == i_obj_val('d_login_id')) {
        alert('对不起，请输入登录账号！');
        return false;
    }
    if ('' == i_obj_val('d_login_pw')) {
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

function m_act_login_id() {
    m.arr = i_obj_val('d_login_id');
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_check_login_id&x=' + m.xid,
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                m.check = '0';
                if (0 < m.arr) {
                    m.check = '1';
                    alert('对不起：已有相同登录账号，请重新输入。');
                }
            }
        });
    }
}

function m_act_idcard() {
    m.idcard = i_obj_val('d_idcard');
    if (!m.idcard || '' == m.idcard) {
        return;
    }

    m.tmp = i_idcard_check(m.idcard);
    if ("ok" != m.tmp) {
        alert(m.tmp);
        return;
    }
    
    m.tmp = i_idcard_sex(m.idcard);
    i_obj_set('d_sex', m.tmp);
}

function m_box_close_plug(arr) {
    if (!arr || '' == arr) {
        return;
    }

    i_obj_set('d_org', arr['name']);
    i_obj_set('d_org_id', arr['id']);
}