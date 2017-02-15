/**
 * 文件名称：www_mk.js
 * 功能描述：www_mk页面控制器。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-10
 * 修改日期：2010-06-18
 * 当前版本：V2.0
 */

$(document).ready(function(){
    var xid = '';
    i_tr_css($('#info_tb tbody tr'));
    m_btn_load();
});

function m_btn_load() {
    $('#btn_onekey').click(function(){
        onekey_arr = onekey_arr_all;
        m_btn_onekey_act();
    });

    $('#btn_onekey_part').click(function(){
        onekey_arr = onekey_arr_part;
        m_btn_onekey_act();
    });

    $('#btn_onekey_link').click(function(){
        onekey_arr = onekey_arr_link;
        m_btn_onekey_act();
    });

    $('input[id^="btn_mk_"]').click(function(){
        xid = this.id.substr(7);
        m_btn_act();
    });
}

function m_btn_act() {
    if ('' == xid) {
        return;
    }

    $.ajax({
        url : i_act + 'a=mk&x=' + xid,
        success : function(txt){
            if ('mk_ok' == txt) {
                m_btn_act_ok();
            } else {
                alert(xid + '生成失败！');
                alert(txt);
            }
        }
    });
}

var onekey_arr;
var onekey_arr_all = new Array(
    'ws_url_bat',
    'header',
    'footer',
    'lefter',
    'lefter0',
    'banner1',
    'banner2',
    'banner3',
    'banner4',
    'banner5',
    'link0',
    'index',
    'info_all',
    'list_all',
    'list_m_all',
    'list_qa_all',
    'qa_all',
    'htm2www'
    );
var onekey_arr_part = new Array(
    'ws_url_bat',
    'header',
    'footer',
    'lefter',
    'lefter0',
    'banner1',
    'banner2',
    'banner3',
    'banner4',
    'banner5',
    'link0'
    );

var onekey_act = '0';
var onekey_xid = '0';

function m_btn_onekey_act() {
    onekey_act = '1';
    xid = onekey_arr[onekey_xid];
    onekey_xid = '1';
    m_btn_act();
}

function m_btn_act_ok() {
    if ('1' == onekey_act && onekey_xid < onekey_arr.length) {
        xid = onekey_arr[onekey_xid];
        onekey_xid++;
        m_btn_act();
    } else if ('1' == onekey_act && onekey_xid == onekey_arr.length) {
        alert('全部完成！');
    } else {
        alert(xid + '生成成功！');
    }
}