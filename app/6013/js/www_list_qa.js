/**
 * 文件名称：index.js
 * 功能描述：index_i页面控制器。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

$(document).ready(function(){
    m_btn_load();
});

function m_btn_load() {
    $('#btn_qa').click(function(){
        i_mdi_open('../www/info_q.htm?a=add', '留言回复管理--留言板', 1);
    });
}