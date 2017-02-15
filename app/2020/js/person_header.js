/**
 * 文件名称：person_header.js
 * 功能描述：菜单功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */
var xid = '';

$(document).ready(function(){
    m_get_session();
    m_a_load_plug();
});

function m_get_session(){
    $.ajax({
        url : i_act + 'a=info_session',
        success : function(txt){
            xid = txt;
        }
    });
}

function m_a_load_plug(){
    
    $('#a_person_loginout').click(function(){
        m_info_loginout();
    });
    
}

function m_info_loginout(){
    $.ajax({
        url : i_act + 'a=info_loginout',
        success : function(txt){
            if('1'== txt){
                i_mdi_open('./info_person_login.htm?a=login', '' ,1);
            } else {
                alert('安全退出失败！');
            }
        }
    });
}

