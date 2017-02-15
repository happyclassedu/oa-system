/**
 * 文件名称：list_q.js
 * 功能描述：留言信息的列表控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = i_get('ws_id');
    m.list_act_get = 'ws_id=' + m.ws_id;
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
     $('#btn_list_a').click(function(){
        i_mdi_open( './list_a.htm?ws_id=' + m.ws_id, '回复信息--回复列表');
    });

    $('#btn_list_q').click(function(){
        i_mdi_open( './list_q.htm?ws_id=' + m.ws_id, '留言信息--留言列表');
    });

    $('#btn_list_y').click(function(){
        i_mdi_open( './list_y.htm?ws_id=' + m.ws_id, '隐藏信息--隐藏列表');
    });

    $('#btn_list_all').click(function(){
        i_mdi_open( './list_all.htm?ws_id=' + m.ws_id, '全部信息--全部列表');
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['q_name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['atime']);
    var str_drwx = '';
   if('1' == m.arr[i]['drwx'] || '' == m.arr[i]['drwx']) {
        str_drwx = '未回复';//未回复
    } else if('2' == m.arr[i]['drwx']){
         str_drwx = '已回复';//已回复
    } else if('3' == m.arr[i]['drwx']){
         str_drwx = '已隐藏';//已隐藏
    }
    m.xtr.children(':eq(4)').html(str_drwx);
    m.xtr.children(':eq(5)').html(m.arr[i]['u_name']);
}

function m_list_read_btn_plug() {
    $('.btn_info_a').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./info_a.htm?a=edit&x=' + m.arr[i]['id'], '回复信息--留言信息管理');
    });
}