/**
* 文件名称：info_com.js
* 功能描述：企业中心的前台程序。
* 代码作者：王争强
* 创建日期：2010-08-09
* 修改时间：2010-08-09
* 当前版本：v1.0
*/

$(document).ready(function(){
    m.xid = i_get('x');
    m_btn_load();
});

function m_btn_load() {
    $('#btn_edit_com').click(function(){
        i_mdi_open('./info_c_detail.htm?a=edit&x=' + m.xid, '修改公司信息--企业中心', 1);
    });

    $('#btn_edit_pwd').click(function(){
        i_mdi_open('./info_c_pdw.htm?a=edit&x=' + m.xid, '修改密码', 1);
    });

    $('#btn_add_job').click(function(){
        i_mdi_open('./info_job.htm?a=add&c_id=' + m.xid, '发布职位', 1);
    });

    $('#btn_view_job').click(function(){
        i_mdi_open('./list_job.htm?a=list&c_id=' + m.xid, '职位列表', 1);
    });
}


