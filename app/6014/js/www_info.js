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
    m.xid = $('#xid').html();
    read_hits(m.xid, 'hits');
});

function read_hits(xid, obj) {
    $.ajax({
        url : g.act + 'www_read_hits.php?a=read_hits&x=' + xid,
        success : function(txt){
            if ('' != obj || '' != txt) {
                $('#' + obj).html(txt);
            }
        }
    });
}