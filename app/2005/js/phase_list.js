/**
 * 文件名称：phase_list.js
 * 功能描述：招聘会信息管理系统
 * 代码作者：钱宝伟（创建）, 王争强（优化）
 * 创建日期：2010-06-07
 * 修改日期：2010-06-12
 * 当前版本：V2.0
 */

var xid;
var fid;
var tmp;
var arr;
var xtr;
var i;
var val_search;

$(document).ready(function(){
    xtr = $('#list_table tbody tr:eq(0)').clone(true);
    i_tr_css($('#list_table tbody tr'));
    i_phase_jpage_load(0);
    i_phase_btn_load();
    i_phase_info_num();
});

function i_phase_btn_load() {
    $('#btn_add').click(function(){
        i_mdi_open('phase_info.htm?a=add');
    });

    $('#btn_refresh').click(function(){
        i_phase_info_num();
    });

    $('#btn_search').click(function(){
        val_search = i_obj_val('val_search');
        val_search = i_js2json(val_search);
        i_phase_info_num();
    });
    $('#val_search').keypress(function() {
        if(event.keyCode==13){
            $('#btn_search').click();
        }
    });
}

function i_phase_info_del() {
    if (confirm('确定要删除“' + tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=del_info&x=' + xid ,
            success : function(text){
                if(text > 0)
                {
                     i_phase_info_num();
                } else {
                     alert('删除' + tmp + '失败！');
                }
            }
        });
    }
}

function i_phase_info_num() {
    $.ajax({
        url : i_act + 'a=read_num',
        data : 'val_search=' + val_search,
        success : function(text){
            i_phase_jpage_load(text);
        }
    });
}

function i_phase_jpage_load(info_num) {
    $('#jpage_box').jpage({
        info_all : info_num,
        show_num : '10',
        page_skin : 'blue',
        page_act : i_phase_read_list
    });
}

i_phase_read_list = function(show_num, page_now) {
    $.ajax({
        url : i_act + 'a=read_list&show_num=' + show_num + '&page_now=' + page_now,
        data : 'val_search=' + val_search,
        success : function(text){
            arr = i_json2js(text);  //将php文件进行解密，并返回到js
            i_phase_read_list_val();
            i_tr_css($('#list_table tbody tr'));
            i_phase_read_list_btn();
            i_phase_search_act();
        }
    });
}

function i_phase_read_list_val() {
    tmp = '';
    var g_arr = new Array();
    g_arr['0'] = '酒店、物管、商超、房产、装饰、服务类';
    g_arr['1'] = 'IT通讯、机械电子、文职营销、行政财务类';
    g_arr['2'] = '综合类招聘会';
    g_arr['3'] = '逢六招聘会';
    
    for(i=0 ; i<arr.length; i++) {
       
        xtr.attr('id', i);
        xtr.children(':eq(0)').html(i + 1);
        xtr.children(':eq(1)').html(arr[i]['phase_name']);
        xtr.children(':eq(2)').html(arr[i]['date_s']);
        xtr.children(':eq(3)').html(g_arr[arr[i]['phase_type']]);
        xtr.children(':eq(4)').html(arr[i]['com_num']);
        xtr.children(':eq(5)').html(arr[i]['job_sum']);
        xtr.children(':eq(6)').html(arr[i]['recruit_sum']);
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

function i_phase_read_list_btn() {
    $('.btn_view').click(function(){
        xid = this.parentNode.parentNode.id;
        xid = arr[xid]['id'];
        i_mdi_open('phase_info.htm?a=view&x=' + xid);
    });
    $('.btn_edit').click(function(){
        xid = this.parentNode.parentNode.id;
        xid = arr[xid]['id'];
        i_mdi_open('phase_info.htm?a=edit&x=' + xid);
    });
    $('.btn_del').click(function(){
        xid = this.parentNode.parentNode.id;
        tmp = arr[xid]['phase_name'];
        xid = arr[xid]['id'];
        i_phase_info_del();
    });
}

function i_phase_search_act() {
    tmp = i_obj_val('val_search');
    if ('' == tmp) {
        return;
    }
    $('#list_table tbody td[class!="btn_box"]').each(function() {
        this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
    });
}