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
    m.ws_id = i_get('ws_id');
    m.list_act_get = 'ws_id=' + m.ws_id;
    m.arr_position = new Array('主 菜 单', '顶部栏目', '底部栏目', '左侧栏目', '右侧栏目', '其他位置');
    m.arr_type_mod = new Array(
        '模型：新闻信息',
        '站内跳转列表',
        '站内跳转信息',
        '站内自定义',
        '外部链接',
        '模型：链接信息',
        '模型：问答信息',
        '模型：多列表'
        );
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_add_menu').click(function(){
        i_mdi_open( './info_menu.htm?a=add&ws_id=' + m.ws_id, '网站栏目--新增');
    });
}

//function m_list_read_btn_plug() {
//}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['fname']);
    m.xtr.children(':eq(3)').html(m.arr_position[m.arr[i]['position']]);
    m.xtr.children(':eq(4)').html(m.arr[i]['oid']);
    m.xtr.children(':eq(5)').html(m.arr_type_mod[m.arr[i]['type_mod']]);
}