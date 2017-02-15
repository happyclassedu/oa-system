/**
 * 文件名称：list_job.js
 * 功能描述：岗位管理模块的列表程序。
 * 代码作者：钱包伟（创建）、王争强（优化）、孙振强（重构）
 * 创建日期：2010-06-10
 * 修改日期：2010-07-18
 * 当前版本：V3.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.arr_type = {0:'正常', 1:'审核', 2:'禁用'};
//    return false;  //可以终止初始化
}

//function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(3)').html(m.arr[i]['org']);
    m.xtr.children(':eq(4)').html(m.arr[i]['duty']);
    m.xtr.children(':eq(5)').html(m.arr[i]['tel_1']);
    m.xtr.children(':eq(6)').html(m.arr_type[m.arr[i]['drwx']]);
}