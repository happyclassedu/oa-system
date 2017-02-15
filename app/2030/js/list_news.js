/**
 * 文件名称：list_news.js
 * 功能描述：新闻信息的列表控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = i_get('ws_id');
    m.list_act_get = 'ws_id=' + m.ws_id;
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_add_news').click(function(){
        i_mdi_open( './info_news.htm?a=add&ws_id=' + m.ws_id, '新闻信息--新增');
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html((m.arr[i]['atime']).substring(0, 10));
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['hits']);
    m.xtr.children(':eq(4)').html(m.arr[i]['u_name']);
    m.xtr.children(':eq(5)').html(m.arr[i]['menu_name']);
}