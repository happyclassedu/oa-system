/**
 * 文件名称：test_list.php
 * 功能描述：练习查询功能
 * 代码作者：钱宝伟
 * 创建日期：2010-06-22
 * 修改日期：2010-06-22
 * 当前版本：V1.0
 */


var xid;
var tmp;
var arr;
var xtr;
var i;
var val_search;

$(document).ready(function(){
    xtr = $('#list_table tbody tr:eq(0)').clone(true);
    i_tr_css($('#list_table tbody tr'));
    i_test_jpage_load(0);
    i_test_btn_load();
    i_test_info_num();
});

function i_test_btn_load() {
//    $('#btn_add').click(function(){
//        i_mdi_open('./test_info.htm?a=add');
//    });

    $('#btn_refresh').click(function(){
        window.location.reload();
    });

    $('#btn_close').click(function(){
        i_mdi_close();
    });

    $('#btn_search').click(function(){
        val_search = i_obj_val('val1_search');
        val_search = i_js2json(val_search);
        i_test_info_num();
    });
    $('#val_search').keypress(function() {
        if(event.keyCode==13){
            $('#btn_search').click();
        }
    });
}

function i_test_info_del() {
    tmp = confirm('确定要删除“' + tmp + '”吗？');
    if (true == tmp) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + xid ,
            success : function(text){
                if(text > 0)
                {
                     i_test_info_num();
                } else {
                     alert('删除' + tmp + '失败！');
                }
            }
        });
    }
}

function i_test_info_num() {
    $.ajax({
        url : i_act + 'a=list_num',
        data : 'val_search=' + val_search,
        success : function(text){
            i_test_jpage_load(text);
        }
    });
}

function i_test_jpage_load(info_num) {
    $('#jpage_box').jpage({
        info_all : info_num,
        show_num : '10',
        page_skin : 'blue',
        page_act : i_test_read_list
    });
}

i_test_read_list = function(show_num, page_now) {
    $.ajax({
        url : i_act + 'a=list_read&show_num=' + show_num + '&page_now=' + page_now,
        data : 'val_search=' + val_search,
        success : function(text){
            arr = i_json2js(text);  //将php文件进行解密，并返回到js
            i_test_read_list_val();
            i_tr_css($('#list_table tbody tr'));
            i_test_read_list_btn();
            i_test_search_act();
        }
    });
}

function i_test_read_list_val() {
    tmp = '';
    for(i=0 ; i<arr.length; i++) {
        xtr.attr('id', i);
        xtr.children(':eq(0)').html(i + 1);
        xtr.children(':eq(1)').html(arr[i]['human_code']);
        xtr.children(':eq(2)').html(arr[i]['human_name']);
        xtr.children(':eq(3)').html(arr[i]['in_leave_time']);
        xtr.children(':eq(4)').html(arr[i]['out_leave_time']);
        xtr.children(':eq(5)').html(arr[i]['leave_day']);
        xtr.children(':eq(6)').html(arr[i]['apply_time']);
        tmp += xtr.parents().html();
    }
    $('#list_table tbody').html(tmp);
}

function i_test_read_list_btn() {
    $('.btn_view').click(function(){
        xid = this.parentNode.parentNode.id;
        xid = arr[xid]['id'];
        i_mdi_open('./test_info.htm?a=view&x=' + xid);
    });
    $('.btn_edit').click(function(){
        xid = this.parentNode.parentNode.id;
        xid = arr[xid]['id'];
        i_mdi_open('./test_info.htm?a=edit&x=' + xid);
    });
    $('.btn_del').click(function(){
        xid = this.parentNode.parentNode.id;
        tmp = arr[xid]['name'];
        xid = arr[xid]['id'];
        i_test_info_del();
    });
}

function i_test_search_act() {
    tmp = i_obj_val('val1_search');
    if ('' == tmp) {
        return;
    }
    $('#list_table tbody td[class!="btn_box"]').each(function() {
        this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
    });
}


