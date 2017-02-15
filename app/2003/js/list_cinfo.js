/**
 * 文件名称：list_cinfo.js
 * 功能描述：企业管理的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = i_get('ws_id');
    m.list_act_get= 'ws_id=' + m.ws_id;
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
}

function m_list_read_btn_plug() {
    $('.btn_www').click(function(){
        i = this.parentNode.parentNode.id;
        window.open(m.arr[i]['web']);
    });

    $('.btn_list_job').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_job.htm?a=list&c_id=' + m.arr[i]['id'], '查看列表--职位信息');
    });

    $('.btn_info_job_add').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./info_job.htm?a=add&c_id=' + m.arr[i]['id'], '发布信息--职位信息');
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['fname']);
    m.xtr.children(':eq(1)').attr('title', m.arr[i]['fname']);
    m.xtr.children(':eq(2)').html(m.arr[i]['web']);
}