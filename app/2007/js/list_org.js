/**
 * 文件名称：org_list.js
 * 功能描述：机构管理模块信息列表的前台程序。
 * 代码作者：钱包伟（创建） , 王争强（优化）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

//$(document).ready(function(){
//    alert('12345');
//});

//function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['fname']);
    m.xtr.children(':eq(3)').html(m.arr[i]['intro']);
}

//function m_list_read_set_plug() {
//
//}