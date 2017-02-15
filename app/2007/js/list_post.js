/**
 * 文件名称：list_post.js
 * 功能描述：职务管理模块的列表程序。
 * 代码作者：钱包伟（创建）、王争强（优化）、孙振强（重构）
 * 创建日期：2010-06-10
 * 修改日期：2010-07-18
 * 当前版本：V3.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.xtr.children(':eq(1)').addClass('cursor_p');
    m.xtr.children(':eq(1)').dblclick(function(){
        i = this.parentNode.id;
        m.xid = m.arr[i]['id'];
        i_mdi_open('./info_' + g.id_name + '.htm?a=view&x=' + m.xid, '查看信息');
    });
//    return false;  //可以终止初始化
}

//function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['intro']);
}