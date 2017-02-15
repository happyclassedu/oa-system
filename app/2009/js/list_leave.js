/**
 * 文件名称：list_post.js
 * 功能描述：职务管理。
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
    m.xtr.children(':eq(1)').html(m.arr[i]['hm_code']);
    m.xtr.children(':eq(2)').html(m.arr[i]['hm_name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['go_date'].substr(0, 10));
    m.xtr.children(':eq(3)').attr('title', m.arr[i]['go_date']);
    m.xtr.children(':eq(4)').html(m.arr[i]['in_date'].substr(0, 10));
    m.xtr.children(':eq(4)').attr('title', m.arr[i]['in_date']);
    m.xtr.children(':eq(5)').html(m.arr[i]['leave_day']);
//    m.xtr.children(':eq(6)').html(m.arr[i]['apply_date'].substr(0, 10));
    m.xtr.children(':eq(6)').attr('title', m.arr[i]['apply_date']);
    m.xtr.children(':eq(7)').html(m.arr[i]['leave_state']);
//    m.xtr.children(':eq(3)').html(m.arr[i]['remark']);
}

//function m_list_read_set_plug() {
//
//}