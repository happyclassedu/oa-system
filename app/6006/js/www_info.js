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
    new i_tab_show('lefter_news_title', 'lefter_news', 1, 'a', 'ul');
    m.xid = $('#xid').html();
    read_hits(m.xid, 'hits');
});

function read_hits(xid, obj) {
    $.ajax({
        url : '../act?a=read_hits&x=' + xid,
        success : function(txt){
            if ('' != obj || '' != txt) {
                $('#' + obj).html(txt);
            }
        }
    });
}