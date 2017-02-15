    /**
 * 文件名称：www_index.js
 * 功能描述：www_index页面控制器。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */
var tmp = '';

$(document).ready(function(){
    tmp = m_ssession_verify();
    if (false == tmp) {
        return false;
    }
});

function m_ssession_verify(){
    $.ajax({
        url : g.act + 'session.php?a=ssession_verify',
        success : function(txt){
            if('0' == txt || '' == txt){
                i_mdi_open('./login.htm?a=login', '用户登录', 1);
                return false;
            } else {
                return true;
            }
        }
    });
}