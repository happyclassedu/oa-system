/**
 * 文件名称：list_pinfo.js
 * 功能描述：简历信息管理的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = i_get('ws_id');
    m.list_act_get= 'ws_id=' + m.ws_id;
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
}

//function m_list_read_btn_plug() {
//
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(1)').attr('title', m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(3)').html(m.arr[i]['univ']);
    m.xtr.children(':eq(4)').html(m.arr[i]['major']);
    m.xtr.children(':eq(5)').html(m.arr[i]['joba'] + ' ' + m.arr[i]['jobb'] + ' ' + m.arr[i]['jobc']);
    m.xtr.children(':eq(6)').html((m.arr[i]['atime']).substring(0, 10));
}