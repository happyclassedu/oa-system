/**
 * 文件名称：www_login.js
 * 功能描述：www_login页面控制器。
 * 代码作者：王争强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */
var ws_id = '10';
var ws_name = '莲湖区人力资源服务中心流动党员之家';

$(document).ready(function(){
    m_login_act();
});

function m_login_act() {

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
                    i_mdi_open('./index.htm', '党员活动室', 1);
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