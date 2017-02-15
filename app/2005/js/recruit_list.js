/**
 * 文件名称：ileap_list.js
 * 功能描述：招聘会信息列表的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-06-04
 * 修改日期：2010-06-07
 * 当前版本：V2.0
 */

var xid;
var tmp;
var arr;
var xtr;
var i;
var val_search;
var  fid;

$(document).ready(function(){
    fid = i_get('fid');
    xtr = $('#list_table tbody tr:eq(0)').clone(true);
    i_tr_css($('#list_table tbody tr'));
    i_recruit_jpage_load(0);
    i_recruit_btn_load();
    i_recruit_info_num();
});

function i_recruit_btn_load() {
    $('#btn_add').click(function(){
        i_mdi_open('recruit_info.htm?a=add&fid=' + fid, '新增单位');
    });

    $('#btn_refresh').click(function(){
        i_recruit_info_num();
    });

    $('#btn_search').click(function(){
        val_search = i_obj_val('val_search');
        val_search = i_js2json(val_search);
        i_recruit_info_num();
    });
    $('#val_search').keypress(function() {
        if(event.keyCode==13){
            $('#btn_search').click();
        }
    });
}

function i_recruit_info_del() {
    if (confirm('确定要删除“' + tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=del_info&x=' + xid ,
            success : function(text){ 
                if(text > 0) {
                    i_recruit_info_num();
                } else {
                     alert('删除' +  tmp + '失败！');
                }
            }
        });
    }
}

function i_recruit_info_num() {
    $.ajax({
        url : i_act + 'a=read_num&fid=' + fid,
        data : 'val_search=' + val_search,
        success : function(text){
            i_recruit_jpage_load(text);
        }
    });
}

function i_recruit_jpage_load(info_num) {
    $('#jpage_box').jpage({
        info_all : info_num,
        show_num : '10',
        page_skin : 'blue',
        page_act : i_recruit_read_list
    });
}

i_recruit_read_list = function(show_num, page_now) {
    $.ajax({
        url : i_act + 'a=read_list&show_num=' + show_num + '&page_now=' + page_now+ '&fid=' + fid,
        data : 'val_search=' + val_search,
        success : function(text){
            arr = i_json2js(text);  //将php文件进行解密，并返回到js
            i_recruit_read_list_val();
            i_tr_css($('#list_table tbody tr'));
            i_recruit_read_list_btn();
            i_recruit_search_act();
        }
    });
}

function i_recruit_read_list_val() {
    tmp = '';
    for(i=0 ; i<arr.length; i++) {
        xtr.attr('id', i);
        xtr.children(':eq(0)').html(i + 1);
        xtr.children(':eq(1)').html(arr[i]['com_name']);
        xtr.children(':eq(2)').html(arr[i]['job_a']);
        xtr.children(':eq(3)').html(arr[i]['job_b']);
        xtr.children(':eq(4)').html(arr[i]['job_c']);
        xtr.children(':eq(5)').html(arr[i]['job_num']);
        xtr.children(':eq(6)').html(arr[i]['recruit_num']);
        if('1' ==arr[i]['state'])
        {
            xtr.children(':eq(7)').html('公开');
        }else{
            xtr.children(':eq(7)').html('不公开');
        }
        tmp += xtr.parents().html();
    }
    $('#list_table tbody').html(tmp);
}

function i_recruit_read_list_btn() {
    $('.btn_view').click(function(){
        xid = this.parentNode.parentNode.id;
        xid = arr[xid]['id'];
        i_mdi_open('recruit_info.htm?a=view&x=' + xid + '&fid=' + fid, '查看单位');
    });
    $('.btn_edit').click(function(){
        xid = this.parentNode.parentNode.id;
        xid = arr[xid]['id'];
        i_mdi_open('recruit_info.htm?a=edit&x=' + xid+ '&fid=' + fid, '修改单位');
    });
    $('.btn_del').click(function(){
        xid = this.parentNode.parentNode.id;
        tmp = arr[xid]['com_name'];
        xid = arr[xid]['id'];
        i_recruit_info_del();
    });
}

function i_recruit_search_act() {
    tmp = i_obj_val('val_search');
    if ('' == tmp) {
        return;
    }
    $('#list_table tbody td[class!="btn_box"]').each(function() {
        this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
    });
}

