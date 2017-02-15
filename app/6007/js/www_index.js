/**
* 文件名称：www_index.js
* 功能描述：页面控制器。
* 代码作者：孙振强（创建）
* 创建日期：2010-06-10
* 修改日期：2010-06-18
* 当前版本：V2.0
*/
var ws_id = '8';
var ws_name = '西安立丰集团';

$(document).ready(function(){
    //    m_btn_load_plug();
    m_ssession_val();
    m_index_act();
});

function m_index_act() {
    new i_pics_player('#index_pics',{
        width:'268px',
        height:'192px',
        fontsize:'12px',
        time:'4000'
    });

    swfobject.embedSWF('../img/banner/banner_254.swf', 'index_banner_swf', '980', '276', '9.0.0', null, false, {
        wmode:'transparent'
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
                    var login_html = '<h2>用户登录</h2><ul>' +
                    '<li class="user">欢迎' + i_obj_val('d_loginid') + '登录立丰房地产网</li><li class="lf_bt"><input class="zxly" type="button" onclick="m_qa()"/><input class="yzgg" type="button" onclick="m_forum()"/><input class="tcdl" type="button" onclick="m_ssession_logout()"/></li></ul>';
                    $("#index_login_box").html(login_html);
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
            var arr = i_json2js(txt);
            if('' != arr){
                var login_html = '<h2>用户登录</h2><ul>' +
                '<li class="user">欢迎' + arr['ws_uname'] + '登录立丰房地产网</li><li class="lf_bt"><input class="zxly" type="button" onclick="m_qa()"/><input class="yzgg" type="button" onclick="m_forum()"/><input class="tcdl" type="button" onclick="m_ssession_logout()"/></li></ul>';
                $("#index_login_box").html(login_html);
            }
        }
    });
}

function m_ssession_logout(){
    $.ajax({
        url : g.act + 'info_login.php?a=session_logout',
        success : function(txt){
            if('1' == txt){
                i_mdi_open('./login.htm', '登录管理' , 1);
            } else {
                alert('对不起，退出失败！');
            }
        }
    });
}

function  m_qa() {
    i_mdi_open('./list_qa_269_1.htm');
}

function m_forum() {
    i_mdi_open('./list_forum.htm');
}
