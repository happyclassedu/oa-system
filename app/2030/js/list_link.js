/**
 * 文件名称：list_link.js
 * 功能描述：链接信息的列表控制器JS
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
    $('#btn_add_link').click(function(){
        i_mdi_open( './info_link.htm?a=add&ws_id=' + m.ws_id, '链接信息--新增');
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html((m.arr[i]['name']));
    m.xtr.children(':eq(2)').html(m.arr[i]['menu_name']);
    var str_drwx = '';
    if('0' == m.arr[i]['drwx']) {
        str_drwx = '完全公开';//完全公开
    } else if('1' == m.arr[i]['drwx']){
         str_drwx = '站内公开';//站内公开
    } else if('2' == m.arr[i]['drwx']) {
        str_drwx = '后台公开';//后台公开
    }  else if('3' == m.arr[i]['drwx']) {
        str_drwx = '彻底关闭';//彻底关闭
    }
    m.xtr.children(':eq(3)').html(str_drwx);
    m.xtr.children(':eq(4)').html(m.arr[i]['img']);
    m.xtr.children(':eq(5)').html(m.arr[i]['oid']);
    m.xtr.children(':eq(6)').html((m.arr[i]['atime']).substring(0, 10));
}