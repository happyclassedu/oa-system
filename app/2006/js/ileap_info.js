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
    i_ileap_info_btn_load();
    i_ileap_info_input(true);
    i_ileap_info_load();
});

function i_ileap_info_load() {
    if ('edit' == act && '' != xid) {
        i_ileap_info_read();
        i_ileap_info_edit();
    } else if('view' == act && '' != xid) {
        i_obj_set('sys_state', '查看');
        i_ileap_info_read();
    } else if('add' == act) {
        i_ileap_info_add();
    } else {
        alert('操作错误，正在关闭！');
        i_mdi_close();
    }
}

function i_ileap_info_btn_load() {
    $('#btn_save, #btn_cancel').attr('disabled', true);
    
    $('#btn_refresh').click(function(){
        window.location.reload();
    });
    
    $('#btn_add').click(function(){
        i_mdi_open('./ileap_info.htm?a=add', '新增--劳动协理员', '1');
    });

    $('#btn_preview').click(function(){
        i_mdi_open('./ileap_card.htm?a=view&x=' + xid, info.ileap_name + '--打印工作证');
    });

    $('#btn_edit').click(function(){
        i_ileap_info_edit();
    });

    $('#btn_save').click(function(){
        i_ileap_info_save();
    });

    $('#btn_cancel').click(function(){
        i_ileap_info_cancel();
    });

    $('#btn_del').click(function(){
        i_ileap_info_del();
    });

    $('#btn_close').click(function(){
        i_mdi_close();
    });

    $('#btn_list').click(function(){
        i_mdi_open('./ileap_list.htm', '列表--劳动协理员管理');
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
    $.each(info, function(key){
        i_obj_set('i_' + key, info[key]);
    });

    i_tmp = i_obj_get('i_photo_img');
    if ('' == info['photo']) {
        i_tmp.src = '../img/photo.jpg';
    } else {
        i_tmp.src = '../../../sys_doc/tmp/' + xid + '.jpg';
    }
//    i_obj_set('i_jcard_addr', info['job_addr_0_name'] + '街道劳动保障事务所');
}

function i_ileap_info_input(state) {
    $('#info_table tbody input, #info_table tbody select, #info_table tbody textarea').attr('disabled', true==state?true:false);
    if (true != state) {
//        $('#i_job_addr, #i_jcard_addr').attr('disabled', true);
}
}

function i_ileap_info_add() {
    i_ileap_info_input(false);
    $('#btn_edit, #btn_cancel, #btn_del, #btn_preview').attr('disabled', true);
    $('#btn_save').attr('disabled', false);
    i_obj_set('sys_state', '新增');
}

function i_ileap_info_edit() {
    i_ileap_info_input(false);
    $('#btn_edit').attr('disabled', true);
    $('#btn_save, #btn_cancel').attr('disabled', false);
    i_obj_set('sys_state', '修改');
    i_ileap_photo_edit();
}

function i_ileap_info_save() {
    if ('edit' == act || 'view' == act ) {
        i_ileap_info_save_edit();
    } else if ('add' == act) {
        i_ileap_info_save_add();
    }
}

function i_ileap_info_save_edit() {
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
            alert(text);
        }
    });
}

function i_ileap_info_save_add() {
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
            alert(text);
        }
    });
}

function i_ileap_info_cancel() {
    i_ileap_info_input(true);
    $('#btn_edit').attr('disabled', false);
    $('#btn_save, #btn_cancel').attr('disabled', true);
    i_ileap_info_set();
    i_obj_set('sys_state', '查看');
    var tmp;
    i_tmp = i_obj_get('i_photo_img');
    tmp = i_tmp.src;
    i_tmp.parentNode.innerHTML = '<img id="i_photo_img" width="100" height="140" src="' + tmp + '" />';
}

function i_ileap_info_del() {
    i_tmp = confirm('确定要删除“' + info['ileap_name'] + '”吗？');
    if (true == i_tmp) {
        $.ajax({
            url : i_act + 'a=del_info&x=' + xid ,
            success : function(text){
                alert(text);
                i_mdi_close();
            }
        });
    }
}


function i_ileap_photo_edit() {
    var tmp;
    i_tmp = i_obj_get('i_photo_img');
    tmp = i_tmp.src;
    i_tmp.parentNode.innerHTML = '<input id="i_photo_img" type="file" src="'+ tmp +'" />';

    i_upload({
        'obj_id' : '#i_photo_img',
        'more' : false,
        'width'  : '100',
        'height' : '140',
        'btn_img' : tmp,
        'file_ext' : '*.jpg',
        'file_txt' : '请选择工作证的照片文件',
        'data' : {
            'i_name' : xid
        },
        onSelect : function(evt, queue_id, file_obj) {
            if (file_obj.size > 1000000) {
                alert("Sorry, the file size exceeds 1000k, is unusual.");
                return false;
            } else {
                $(evt.currentTarget).uploadifyUpload();
                return true;
            }
        },
        onComplete : function (evt, queue_id, file_obj, response, data) {
            alert(response);
            i_tmp = i_obj_get('i_photo_img');
            i_tmp.parentNode.innerHTML = '<img id="i_photo_img" width="100" height="140" src="../../../sys_doc/tmp/' + xid + '.jpg" />';
            i_ileap_photo_edit_ajax();
        }
    });
}


function i_ileap_photo_edit_ajax() {
    i_arr = new Object();
    i_arr['photo'] = '1';

    $.ajax({
        url : i_act + 'a=edit_info&x=' + xid,
        data : 'arr=' + i_js2json(i_arr),
        success : function(text){
            i_obj_set('sys_state', '查看');
        //            alert(text);
        }
    });
}