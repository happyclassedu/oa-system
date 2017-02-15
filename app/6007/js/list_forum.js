/**
 * 文件名称：list_forum.js
 * 功能描述：论坛信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = '8';
    m.menu_id = '1514';
    m.list_act_get = 'ws_id=' + m.ws_id + '&menu_id=' + m.menu_id;
    m_ssession_val();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('.btn_replies').click(function(){
        i_mdi_open('./info_forum.htm?a=add', '发布主题', 1);
    });

    $('#btn_exit').click(function(){
        m_ssession_logout();
    });

}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html('<a href="./list_forum_all.htm?fid=' + m.arr[i]['id'] + '">'+m.arr[i]['name']+'</a>');
    if('0' == m.arr[i]['istop']){
        m.xtr.children(':eq(0)').addClass('lt_title');
    } else {
        m.xtr.children(':eq(0)').addClass('lt_title_top');
    }
    m.xtr.children(':eq(1)').html(m.arr[i]['u_name'] + '<br />' + m.arr[i]['atime']);
    m.xtr.children(':eq(2)').html('花花妈妈<br />1个月前 ');
}

function m_ssession_val(){
    $.ajax({
        url : g.act + 'info_login.php?a=session_val',
        success : function(txt){
            var arr = i_json2js(txt);
            if('' != arr){
                $("#lt_search a").html(arr['ws_uname']);
            } else {
                i_mdi_open('./login.htm', '登录管理' , 1);
            }
        }
    });
}

function m_ssession_logout(){
    $.ajax({
        url : g.act + 'info_login.php?a=session_logout',
        success : function(txt){
            if('1' == txt){
                i_mdi_open('./login.htm', '登录管理' , 1);
            } else {
                alert('对不起，退出失败！');
            }
        }
    });
}