/**
 * 文件名称：index.js
 * 功能描述：index_i页面控制器。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

if (!m) {
    var m = {};
}

if (!tmp) {
    var tmp;
}

$(document).ready(function(){
    i_read_css('www_list');
    m_list_page_act();
    new i_tab_show('lefter_news_title', 'lefter_news', 0, 'a', 'ul');
});

function m_list_page_act() {
    m.page = {};
    $('#page_now').hide();
    tmp = $('#page_now').html();
    m.page.page_now = tmp.replace(/[^0-9]+/g, "");
    $('#page_' + m.page.page_now).addClass('page_now');
    $('#page_' + tmp).addClass('page_now');
}