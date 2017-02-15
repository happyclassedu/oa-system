/**
 * 文件名称：list_thought.js
 * 功能描述：思想汇报的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = '10';
    m.menu_id = '1507';
    m.list_act_get = 'ws_id=' + m.ws_id + '&menu_id=' + m.menu_id;
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
     $('#btn_release').click(function(){
        i_mdi_open('./info_thought.htm?a=add', '填写思想汇报', 1);
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html('<a href="./info_' + m.arr[i]['id'] +'.htm">'+m.arr[i]['name']+'</a>');
    m.xtr.children(':eq(1)').html(i_date_format(m.arr[i]['atime'], 'mm-dd'));
}