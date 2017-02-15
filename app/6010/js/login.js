i_ajax_box_show('系统提醒：', '正在打开，请稍等……');

var t = {};
t.arr_login = {};
t.arr_logon = {};

$(document).ready(function() {
    $('#btn_login').click(function() {
        btn_login();
    });

    $('INPUT').focus(function() {
        $(this).addClass("input_focus");
    });

    $('INPUT').blur(function() {
        $(this).removeClass("input_focus");
    });

    $('#login_ws').keypress(function() {
        if ('13' == window.event.keyCode) {
            $('#login_id').focus();
        }
    });

    $('#login_id').keypress(function() {
        if ('13' == window.event.keyCode) {
            $('#login_pw').focus();
        }
    });

    $('#login_pw').keypress(function() {
        if ('13' == window.event.keyCode) {
            $('#btn_login').click();
        }
    });
});

window.onload=function(){
    t.arr_login.login_ws = i_cookie_get('login_ws');
    i_obj_set('login_ws', t.arr_login.login_ws);
    t.arr_login.login_id = i_cookie_get('login_id');
    i_obj_set('login_id', t.arr_login.login_id);
    if (!t.arr_login.login_ws) {
        $('#login_ws').focus();
    } else if (!t.arr_login.login_id) {
        $('#login_id').focus();
    } else {
        $('#login_pw').focus();
    }
    i_ajax_box_hide();
}

////=============================================
function btn_login() {
    t.arr_login.login_ws = i_obj_val('login_ws');
    if ('' == t.arr_login.login_ws) {
        alert('错误100：对不起，请输入“网站网址”！');
        $('#login_ws').focus();
        return;
    }

    t.arr_login.login_id = i_obj_val('login_id');
    if ('' == t.arr_login.login_id) {
        alert('错误101：对不起，请输入“登陆账号”！');
        $('#login_id').focus();
        return;
    }

    t.arr_login.login_pw = i_obj_val('login_pw');
    if ('' == t.arr_login.login_pw) {
        alert('错误102：对不起，请输入“登陆密码”！');
        $('#login_pw').focus();
        return;
    }

    login_act();
}

function login_act() {
    i_ajax_box_show('系统提醒：正在登录！','正在登录，请稍等……');
    $.ajax({
        url : i_act + 'a=login',
        data : 'arr_login=' + i_js2json(t.arr_login),
        success : function(txt){
            t.arr_logon = i_json2js(txt);
            logon_act();
        },
        error : function(){
            i_ajax_box_show('系统提醒：登陆失败2！','对不起，登陆失败，请联系网络管理员。');
            return false;
        }
    });
}

function logon_act() {
    switch(t.arr_logon['act']) {
        case 'error':
            alert(t.arr_logon['msg']);
            t.tmp = t.arr_logon['msg'].substr(0, 5);
            if('错误103' == t.tmp) {
                $('#login_id').focus();
            } else if('错误104' == t.tmp) {
                $('#login_pw').val('');
                $('#login_pw').focus();
            }
            i_ajax_box_hide();
            break;
        case 'ok':
            i_ajax_box_show('系统提醒：登陆成功！', '正在进入系统，请稍等……');
            i_cookie_set('login_ws', t.arr_login.login_ws, '365', '/');
            i_cookie_set('login_id', t.arr_login.login_id, '365', '/');
            i_cookie_set('ws_id', t.arr_logon['ws_id'], '365', '/');
            i_cookie_set('app_code', t.arr_logon['app_code'], '365', '/');
            setTimeout('self.location.href = "' + t.arr_logon['msg'] + '";', 1300);
            break;
        default:
            i_ajax_box_show('系统提醒：登陆失败！','对不起，登陆失败，请联系网络管理员。');
            break;
    }
}