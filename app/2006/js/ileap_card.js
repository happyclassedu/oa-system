/**
 * 文件名称：ileap_list.js
 * 功能描述：劳动协管员模块信息列表的前台程序。
 * 代码作者：钱宝伟（创建）、王争强（修改）、孙振强（优化）
 * 创建日期：2010-06-04
 * 修改日期：2010-06-08
 * 当前版本：V3.0
 */

var act;
var xid;
var info;
var i_arr;
var i_tmp;

$(document).ready(function(){
    act = i_get('a');
    xid = i_get('x');
    $('#i_addr_2').attr('class', 'i_addr_2_12');
    i_ileap_info_btn_load();
    i_ileap_info_load();
});

function i_ileap_info_load() {
    if ('view' == act && '' != xid) {
        i_ileap_info_read();
    } else if('print' == act && '' != xid) {
        i_obj_set('sys_state', '查看');
    } else {
        alert('操作错误，正在关闭！');
        i_mdi_close();
    }
}

function i_ileap_info_btn_load() {
    $('#btn_print').click(function(){
        i_ileap_print();
    });

    $('#btn_close').click(function(){
        i_mdi_close();
    });

    $('#btn_refresh').click(function(){
        window.location.reload();
    });
}


function i_ileap_info_read() {
    $.ajax({
        url : i_act + 'a=read_info&x=' + xid,
        success : function(text){
            info = i_json2js(text);
            i_ileap_info_set();
        }
    });
}

function i_ileap_info_set() {
    i_obj_set('i_name', info['ileap_name']);
    i_obj_set('i_sex',  info['sex']);
    i_obj_set('i_code', info['ileap_code']);
    i_obj_set('i_addr_2', info['job_addr_card']);

    if (11 == info['job_addr_card'].length) {
        $('#i_addr_2').attr('class', 'i_addr_2_11');
    } else {
        $('#i_addr_2').attr('class', 'i_addr_2_12');
    }
    
    i_tmp = i_obj_get('i_photo_img');
    if ('' == info['photo']) {
        i_tmp.src = '../img/photo.jpg';
    } else {
        i_tmp.src = '../../../sys_doc/tmp/' + xid + '.jpg';
    }
}

function i_ileap_print() {
//    i_obj_get('i_job_card_0').src = '../img/job_card_0_scr.jpg';
//    i_obj_get('i_job_card_1').src = '../img/job_card_1_scr.jpg';
    jprint('job_card_box');
//    i_obj_get('i_job_card_0').src = '../img/job_card_0.jpg';
//    i_obj_get('i_job_card_1').src = '../img/job_card_1.jpg';
}

function jprint(id_str) {
    var el = document.getElementById(id_str);
    var iframe=document.createElement('IFRAME');
    var doc=null;
    iframe.setAttribute('style','position:absolute;display:none;');
    document.body.appendChild(iframe);
    doc=iframe.contentWindow.document;
    doc.write('<link type="text/css" rel="stylesheet" href="../css/ileap_card.css">');
    doc.write(''+el.innerHTML+'');
    doc.close();
    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    if(navigator.userAgent.indexOf("MSIE")>0) {
        document.body.removeChild(iframe);
    }
}