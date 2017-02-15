/**
 * 文件名称：session.js
 * 功能描述：测试session是否存在的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */

$(document).ready(function(){
    m_session();
});


function m_session(){
    $.ajax({
        url : i_act + 'a=info_issession',
        success : function(txt){
            if('1' == txt){
                i_mdi_open('info_com_login.htm?a=add');
            }
        }
    });
}

