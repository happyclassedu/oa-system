/**
* 文件名称：ucenter_p.js
* 功能描述：个人中心的前台程序。
* 代码作者：王争强
* 创建日期：2010-08-09
* 修改时间：2010-08-09
* 当前版本：v1.0
*/
var m = {};

$(document).ready(function(){
    m.xid = i_get('x');
    m_btn_load();
});

function m_btn_load() {
    $('#btn_view_resume').click(function(){
        i_mdi_open('./info_p_resume.htm?a=view&x=' + m.xid, '查看简历--个人中心', 1);
    });

    $('#btn_edit_resume').click(function(){
        i_mdi_open('./info_p_resume.htm?a=edit&x=' + m.xid, '修改简历--个人中心', 1);
    });
}
