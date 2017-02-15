/**
 * 文件名称：list_disability.js
 * 功能描述：残疾人补贴标准设置的列表程序。
 * 代码作者：孙振强（创建）
 * 创建日期：2011-05-08
 * 修改日期：2011-05-08
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

//function m_load() {
//    return false;  //可以终止初始化
//}

//function m_btn_load_plug() {
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['year']);
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['org_rate']);
    m.xtr.children(':eq(4)').html(m.arr[i]['org_5_rate']);
    m.xtr.children(':eq(5)').html(m.arr[i]['org_4_rate']);
    m.xtr.children(':eq(6)').html(m.arr[i]['org_3_rate']);
}