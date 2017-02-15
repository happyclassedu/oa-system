/**
 * 文件名称：list_post.js
 * 功能描述：职务管理。
 * 代码作者：钱包伟（创建） , 王争强（优化）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

$(document).ready(function(){
    m.val_search = i_get('val_search');
    i_obj_set('val_search', m.val_search);
    m.val_search = i_js2json(m.val_search);
});

//function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['zt_name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['money']);
}

//function m_list_read_set_plug() {
//
//}