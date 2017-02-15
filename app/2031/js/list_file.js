/**
 * 文件名称：list_news.js
 * 功能描述：文件管理的列表控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
//    return false;  //可以终止初始化
}

//function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
//}

function m_list_read_btn_plug() {
    $('.btn_down').click(function(){
        i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        m_file_down(m.xid);
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['file_type']);
    m.xtr.children(':eq(2)').html(m.arr[i]['name'] + '.' + m.arr[i]['file_type']);
    m.xtr.children(':eq(3)').html(i_file_size(m.arr[i]['file_size']));
    m.xtr.children(':eq(4)').html(m.arr[i]['hits']);
}

function m_file_down() {
    i_mdi_open(i_act + 'a=file_down&x=' + m.xid + '', '列表--文件管理', 1);
}