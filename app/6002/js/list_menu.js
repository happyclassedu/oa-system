/**
 * 文件名称：list_menu.js
 * 功能描述：网站栏目的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.arr_type = new Array(
        '',
        '一级模块',
        '二级模块',
        '三级模块'
        );
//    return false;  //可以终止初始化
}

//function m_btn_load_plug() {
//}

//function m_list_read_btn_plug() {
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').attr('title', m.arr[i]['id']);
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['f_name']);
    m.xtr.children(':eq(3)').html(m.arr_type[m.arr[i]['type']]);
    m.xtr.children(':eq(4)').html(m.arr[i]['oid']);
    m.xtr.children(':eq(5)').html(m.arr[i]['intro']);
}