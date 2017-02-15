/**
* 文件名称：www_index.js
* 功能描述：www_index页面控制器。
* 代码作者：孙振强（创建）
* 创建日期：2010-06-10
* 修改日期：2010-06-18
* 当前版本：V2.0
*/
var ws_id = '10';
var ws_name = '莲湖区人力资源服务中心流动党员之家';

$(document).ready(function(){
    m_ssession_val();
    m_index_act();
});

function m_index_act() {
    new i_pics_player("#index_pics",{
        width:"300px",
        height:"218px",
        fontsize:"12px",
        time:"5000"
    });

    $('#btn_login').click(function(){
        m_login();
    });

    $('#btn_reg').click(function(){
        i_mdi_open('./info_register.htm?a=add');
    });
}

function m_login(){
    var arr = new Object();
    arr['loginid'] = i_obj_val('d_loginid');
    arr['loginpw'] = i_obj_val('d_loginpw');
    $.ajax({
        url : g.act + 'info_login.php?a=info_login&ws_id=' + ws_id,
        data : 'arr=' +  i_js2json(arr),
        success : function(txt){
            switch (txt) {
                case '0' :
                    var login_html = '<h1>用户登录</h1><ul>' +
                    '<li>' + i_obj_val('d_loginid') + ' 欢迎登陆党员活动室</li>' +
                    '<li>您的党费已交至2010年12月</li>' +
                    '<li>' +
                    '<a href="#"><img src="../img/sxhb.jpg" width="48" /></a>' +
                    '<a href="#"><img src="../img/dygl.jpg" width="48" /></a>' +
                    '<a href="#"><img src="../img/zxly.jpg" width="48" /></a>' +
                    '</li></ul>';
                    $("#dy_login").html(login_html);
                    break;
                case '1' :
                    alert('$_SESSION失效，请重新登录！');
                    break;
                case '2' :
                    alert('密码不正确，请重新填写！');
                    break;
                case '3' :
                    alert('密码不能为空，请填写！');
                    break;
                case '4' :
                    alert('用户不存在，请注册！');
                    break;
                case '5' :
                    alert('用户名不能为空，请填写！');
                    break;
                default :
                    break;
            }
        }
    });
}

function m_ssession_val(){
    $.ajax({
        url : g.act + 'info_login.php?a=session_val',
        success : function(txt){
            if(txt){
                var arr = i_json2js(txt);
                if('' != arr){
                    var login_html = '<h1>用户登录</h1><ul>' +
                    '<li>' + arr['ws_uname'] + ' 欢迎登陆党员活动室</li>' +
                    '<li>您的党费已交至2010年12月</li>' +
                    '<li>' +
                    '<a href="#"><img src="../img/sxhb.jpg" width="48" /></a>' +
                    '<a href="#"><img src="../img/dygl.jpg" width="48" /></a>' +
                    '<a href="#"><img src="../img/zxly.jpg" width="48" /></a>' +
                    '</li></ul>';
                    $("#dy_login").html(login_html);
                }
            }
        }
    });
}

