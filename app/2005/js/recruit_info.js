/**
 * 文件名称：recruit_info.js
 * 功能描述：招聘会信息管理内容页的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-06-12
 * 修改日期：2010-06-12
 * 当前版本：V2.0
 */

var act;
var xid;
var info;
var i_arr;
var i_tmp;
var fid;
$(document).ready(function(){
    act = i_get('a');
    xid = i_get('x');
    fid = i_get('fid');
    i_recruit_info_btn_load();
//    i_recruit_info_input(true);
    i_recruit_phase();
    i_recruit_info_load();
});

function i_recruit_info_load() {

    if ('edit' == act && '' != xid) { 
        i_recruit_info_read();
        i_recruit_info_edit();
    } else if('view' == act && '' != xid) {
        i_recruit_info_read();
        i_recruit_info_view();
    } else if('add' == act) {
        if('' != xid){
             i_recruit_info_copy();
        }
        i_recruit_info_add();
    } else {
        alert('操作错误，正在关闭！');
        i_mdi_close();
    }
}

function i_recruit_info_btn_load() {
    $('#btn_save, #btn_cancel').attr('disabled', true);


    $('#btn_refresh').click(function(){
        window.location.reload();
    });

    $('#btn_add').click(function(){
        i_mdi_open('recruit_info.htm?a=add&fid=' + fid);
    });

    $('#btn_copy').click(function(){
        i_mdi_open('list_job.htm?a=list&fid=' + fid);
    });


    $('#btn_edit').click(function(){
        i_recruit_info_edit();
    });

    $('#btn_save').click(function(){
        i_recruit_info_save();
    });

    $('#btn_cancel').click(function(){
        i_recruit_info_cancel();
    });

    $('#btn_del').click(function(){
        i_recruit_info_del();
    });

    $('#btn_close').click(function(){
        i_mdi_close();
    });

    $('#btn_list').click(function(){
        i_mdi_open('recruit_list.htm?fid=' + fid);
    });

     $('#i_com_name').change(function() {
        i_obj_set('i_com_name_s', i_obj_val('i_com_name'));
    });
}


function i_recruit_info_read() {
    $.ajax({
        url : i_act + 'a=read_info&x=' + xid,
        success : function(text){
            info = i_json2js(text);
            i_recruit_info_set();
        }
    });
}

function i_recruit_info_set() {
    $.each(info, function(key){
//        alert('key:'+key+'info[key]'+info[key]);
        i_obj_set('i_' + key, info[key]);
    });
}

function i_recruit_info_input(state) {
    $('#info_table tbody input, #info_table tbody select, #info_table tbody textarea').attr('disabled', true==state?true:false);
    if (true != state) {
}
}

function i_recruit_info_add() {
    i_recruit_info_input(false);
    $('#btn_edit, #btn_cancel, #btn_del,#btn_recruit').attr('disabled', true);
    $('#btn_save').attr('disabled', false);
    i_obj_set('sys_state', '新增');
    i_obj_set('i_state', 1);   //默认为公开
}

function i_recruit_info_edit() {
    i_recruit_info_input(false);
    $('#btn_edit, #btn_copy').attr('disabled', true);
    $('#btn_save, #btn_cancel').attr('disabled', false);
    i_obj_set('sys_state', '修改');
}

function i_recruit_info_view() {
    i_recruit_info_input(true);
    $('#btn_edit, #btn_save,  #btn_copy, #btn_cancel').attr('disabled', true);
    $('#btn_cancel, #btn_del, #btn_recruit').attr('disabled', false);
    i_obj_set('sys_state', '查看');
}

function i_recruit_info_save() {
    if ('edit' == act || 'view' == act ) {
        i_recruit_info_save_edit();
    } else if ('add' == act) {
        i_recruit_info_save_add();
    }
}

function i_recruit_info_save_edit() {
    i_arr = new Object();
    $.each(info, function(key){
        i_tmp = i_obj_get('i_' + key);
        if (null != i_tmp) {
            i_tmp = i_obj_val('i_' + key);
            if (i_tmp != info[key]){
                i_arr[key] = i_tmp;
            }
        }
    });

    i_tmp = '';
    var key;
    for (key in i_arr) {
        i_tmp = key;
        break;
    }
    if ('' == i_tmp) {
        alert('对不起，没有任何修改，无法保存。');
        return false;
    }

    $.ajax({
        url : i_act + 'a=edit_info&x=' + xid,
        data : 'arr=' + i_js2json(i_arr),
        success : function(text){
            i_obj_set('sys_state', '查看');
            if(text > 0)
            {
                i_mdi_open('recruit_list.htm?fid=' + fid , '招聘会信息列表页', 1);
            } else {
                 alert('保存失败！');
            }
        }
    });
}

function i_recruit_info_save_add() {
    i_arr = new Object();
    $('#info_table tbody input, #info_table tbody select, #info_table tbody textarea').each(function() {
        i_tmp = i_obj_val(this.id);
        if ('' != i_tmp) {
            i_arr[this.id.substr(2)] = i_tmp;
        }
    });

    i_tmp = '';
    var key;
    for (key in i_arr) {
        i_tmp = key;
        break;
    }
    if ('' == i_tmp) {
        alert('对不起，没有任何修改，无法保存。');
        return false;
    }

    $.ajax({
        url : i_act + 'a=add_info',
        data : 'arr=' + i_js2json(i_arr),
        success : function(text){
            i_obj_set('sys_state', '查看');
            if(text > 0)
            {
                i_mdi_open('recruit_list.htm?fid=' + fid , '招聘会信息列表页', 1);
            } else {
                 alert('保存失败！');
            }
        }
    });
    return true;
}

function i_recruit_info_cancel() {
    i_recruit_info_input(true);
    $('#btn_edit').attr('disabled', false);
    $('#btn_save, #btn_cancel').attr('disabled', true);
    i_recruit_info_set();
}

function i_recruit_info_del() {
    i_tmp = confirm('确定要删除“' + info['com_name'] + '”吗？');
    if (true == i_tmp) {
        $.ajax({
            url : i_act + 'a=del_info&x=' + xid ,
            success : function(text){
                if(text > 0)
                {
                    i_mdi_open('recruit_list.htm?fid=' + fid , '招聘会信息列表页', 1);
                } else {
                     alert('删除' + info['com_name'] + '失败！');
                }
            }
        });
    }
}

function i_recruit_phase() {
    $.ajax({
        url : i_act + 'a=recruit_phase&fid='+fid,
        success : function(text){
            var  arr = i_json2js(text);

            $('#i_fid').html('');  //清空tbody里面的内容

            var option_txt = '';
            option_txt += '<option value="" selected="selected">请选择</option>';
            for(var i=0 ; i<arr.length; i++) {
                option_txt += '<option value="'+ arr[i]['id'] +'">'+ arr[i]['phase_name']+'</option>';
            } 
            $("#i_fid").append(option_txt);
            
            i_obj_set('i_fid', fid);
        }
    });
}


function i_recruit_info_copy() {
    $.ajax({
        url : i_act + 'a=copy_info&x=' + xid,
        success : function(text){
            info = i_json2js(text);
            //复制信息
            i_obj_set('i_com_name', info['com_name']);
            i_obj_set('i_com_name_s', info['com_name_s']);
            i_obj_set('i_com_property', info['com_property']);
            i_obj_set('i_job_a', info['job_a']);
            i_obj_set('i_job_b', info['job_b']);
            i_obj_set('i_job_c', info['job_c']);
            i_obj_set('i_job_num', info['job_num']);
            i_obj_set('i_recruit_num', info['recruit_num']);
            i_obj_set('i_state', info['state']);
        }
    });
}


