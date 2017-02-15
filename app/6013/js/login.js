/**
 * 文件名称：index.js
 * 功能描述：index_i页面控制器。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

var t = {};

$(document).ready(function(){
    t.ws_id = '2';
    m_index_act();
    m_btn_load();
    m_login_check();
});

function m_btn_load() {
    $('#btn_login').click(function(){
        t.arr_login = {};
        t.arr_login['loginid'] = i_obj_val('txt_username');
        t.arr_login['loginpw'] = i_obj_val('txt_password');
        t.arr_login['loginpc'] = i_obj_val('btn_r_login');
        if('p' == t.arr_login['loginpc']){
            m_login_p();
        } else if('c' == t.arr_login['loginpc']) {
            m_login_c();
        }
    });

     $('#btn_reg').click(function(){
        t.arr_login = {};
        t.arr_login['loginpc'] = i_obj_val('btn_r_login');
        if('p' == t.arr_login['loginpc']){
            i_mdi_open('./info_pregister.htm?a=add');
        } else if('c' == t.arr_login['loginpc']) {
            i_mdi_open('./info_cregister.htm?a=add');
        }
    });
}

function m_login_p(){
    $.ajax({
        url : g.act + 'info_plogin.php?a=info_login&ws_id=' + t.ws_id,
        data : 'arr=' +  i_js2json(t.arr_login),
        success : function(txt){
            t.arr = i_json2js(txt);
            m_login_act();
        }
    });
}

function m_login_c(){
    $.ajax({
        url : g.act + 'info_clogin.php?a=info_login&ws_id=' + t.ws_id,
        data : 'arr=' +  i_js2json(t.arr_login),
        success : function(txt){
            t.arr = i_json2js(txt);
            m_login_act();
        }
    });
}

function m_login_act(){
    switch (t.arr.err) {
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
        case 'err_longin' :
            $.cookie('loginid', t.arr.info.loginid);
            $.cookie('xid', t.arr.info.id);
            $.cookie('name', t.arr.info.name);
            if ('p' == t.arr_login['loginpc']) {
                if ('男' == t.arr.info.sex) {
                    t.arr.info.sex = '先生';
                } else if ('女' == t.arr.info.sex) {
                    t.arr.info.sex = '女士';
                } else {
                    t.arr.info.sex = '';
                }
                $.cookie('sex', t.arr.info.sex);
                $.cookie('loginpc', 'p');
            } else if ('c' == t.arr_login['loginpc']) {
                $.cookie('loginpc', 'c');
            }
            $.cookie('loginstate', 'login');
            alert('登陆成功');
            i_obj_set('txt_password', '');
             m_login_check();
            break;
        default :
            break;
    }
}

function m_login_check(){
    if ('login' != $.cookie('loginstate')) {
        return;
    }

//    i_obj_hide('box_login');
    if ('p' == $.cookie('loginpc')) {
//        i_obj_show('box_login_p');
//        i_obj_set('user_title', $.cookie('name') + ' '+ $.cookie('sex') + '，');

    }

    if ('c' == $.cookie('loginpc')) {
//        i_obj_show('box_login_c');
    }
}

function m_index_act() {
    
}