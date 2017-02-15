i_ajax_box_show('系统提醒：', '正在打开，请稍等……');
////=============================================
$(document).ready(function() {
    $('#btn_login').click(function() {
        btn_login();
    });

    $('#btn_cancel').click(function() {
        btn_cancel();
    });

    $('INPUT').focus(function() {
        $(this).addClass("input_focus");
    });

    $('INPUT').blur(function() {
        $(this).removeClass("input_focus");
    });

    $('#user_name').keypress(function() {
        if( window.event.keyCode==13){
            $('#user_pass').focus();
        }
    });

    $('#user_pass').keypress(function() {
        if( window.event.keyCode==13){
            $('#btn_login').click();
        }
    });
});

window.onload=function(){
    i_obj_show('login_content');
    i_ajax_box_hide();
}

////=============================================
function btn_login() {
    var user_name;
    user_name = i_obj_val('user_name');
    if (user_name == '') {
        alert('对不起，请输入“用户账号”！');
        return false;
    }
    var user_pass;
    user_pass = i_obj_val('user_pass');
    if (user_pass == '') {
        alert('对不起，请输入“用户密码”！');
        return false;
    }
    var arr = new Object();
    arr['user_name'] = user_name;
    arr['user_pass'] = user_pass;
    btn_login_act(arr);
}

function btn_cancel() {
    i_obj_set('user_name', '');
    i_obj_set('user_pass', '');
}

function btn_login_act(arr) {
    i_ajax_box_show('系统提醒：', '正在打开，请稍等……');
    $.ajax({
        url : i_act + 'a=login',
        data : 'arr_login=' + i_js2json(arr),
        success : function(txt){
            var arr = i_json2js(txt);
            switch(arr['act']) {
                case 'error':
                    alert(arr['msg']);
                    var tmp = arr['msg'].substr(0, 5);
                    if('错误103' == tmp) {
                        $('#user_name').focus();
                    }
                    if('错误104' == tmp) {
                        $('#user_pass').val('');
                        $('#user_pass').focus();
                    }
                    i_ajax_box_hide();
                    break;
                case 'ok':
                    i_ajax_box_show('系统提醒：登陆成功！', '正在进入系统，请稍等……');
                    setTimeout('window.location.href = "' + arr['msg'] + '";', 1300);
                    break;
                default:
                    i_ajax_box_show('系统提醒：登陆失败！', '对不起，登陆失败，请联系网络管理员。');
                    return false;
            }
        },
        error : function(){
            i_ajax_box_show('系统提醒：登陆失败2！', '对不起，登陆失败，请联系网络管理员。');
            return false;
        }
    });
}