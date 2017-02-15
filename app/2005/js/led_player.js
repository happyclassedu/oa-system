/**
 * 文件名称：phase_list.js
 * 功能描述：招聘会信息管理系统
 * 代码作者：钱宝伟（创建）, 王争强（优化）
 * 创建日期：2010-06-07
 * 修改日期：2010-06-12
 * 当前版本：V2.0
 */

var xid;
var tmp;
var arr;
var xtr;
var i;

$(document).ready(function(){
    xtr = $('#info_box tbody tr:eq(0)').clone(true);
    i_phase_btn_load();
    i_read_phase_led();
});

function i_phase_btn_load() {
    $('#btn_back').click(function(){
        window.history.back(-1);
    });

    $('#btn_refresh').click(function(){
        window.location.reload();
    });

    $('#btn_enter').click(function(){
        i_read_recruit_led();
    });

    $('#btn_notice').click(function(){
        if ('隐藏蓝条' == this.value) {
            i_obj_hide('notice_box');
            this.value = '显示蓝条';
        } else {
            i_obj_show('notice_box');
            this.value = '隐藏蓝条';
        }
    });
}

function i_read_phase_led() {
    $.ajax({
        url : i_act + 'a=read_phase_led',
        success : function(text) {
            arr = i_json2js(text);
            for(i=0; i<arr.length; i++) {
                tmp = $("<option>").text(arr[i].phase_name).val(arr[i].id);
                $("#i_phase").append(tmp);
            }
        }
    });
}

function i_read_recruit_led() {
    xid = $("#i_phase").val();
    if ('' == xid) {
        alert('请选择期次！');
        return;
    }
    $.ajax({
        url : i_act + 'a=read_recruit_led&x=' + xid,
        success : function(text){
            arr = i_json2js(text);
            tmp = '';
            for(i=0; i<arr.length; i++) {
                xtr.children(':eq(0)').html(i + 1);
                xtr.children(':eq(1)').html(arr[i]['com_name']);
                xtr.children(':eq(2)').html(arr[i]['job_a']);
                xtr.children(':eq(3)').html(arr[i]['job_b']);
                xtr.children(':eq(4)').html(arr[i]['job_c']);
                tmp += xtr.parents().html();
            }
            $('#info_box tbody').html(tmp);
        }
    });
}
