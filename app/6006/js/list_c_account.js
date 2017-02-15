/**
 * 文件名称：list_c_account.js
 * 功能描述：企业账号信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

//function m_load() {
////    return false;  //可以终止初始化
//}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
}

function m_list_read_btn_plug() {
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['fname']);
    m.xtr.children(':eq(1)').attr('title', m.arr[i]['fname']);
    m.xtr.children(':eq(2)').html(m.arr[i]['loginid']);
    m.xtr.children(':eq(3)').html(m.arr[i]['user_tate']);
    m.xtr.children(':eq(4)').html(m.arr[i]['atime']);
    m.xtr.children(':eq(5)').html(m.arr[i]['login_hits']);
    m.xtr.children(':eq(6)').html(m.arr[i]['login_time']);
    m.xtr.children(':eq(7)').html(m.arr[i]['user_desc']);
}