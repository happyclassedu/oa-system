/**
 * 文件名称：info_com_look.js
 * 功能描述：查看公司简介的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */
var jid = '';

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
    jid = i_get('jid');
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    m_info_num();
    m_info_com_get();
//    m_info_job_get();
//    m_error_init();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
     $('#a_job_info').click(function(){
         i_mdi_open('./info_job_look.htm?a=view&x=' + jid + '&cid=' + m.xid, '浏览职位--招聘职位', 1);
//        $('#a_job_info').attr('href', './info_job_look.htm?a=view&x=' + j_id);
     });

}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}


//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

//function m_act_url_plug() {
//    window.location.reload();
//    return false;  //可以终止跳转
//}

//function m_info_save_plug() {
//    return true;
//}

//function m_error_init(){
//
//}

function m_info_com_get(){
    $.ajax({
        url : i_act + 'a=' + 'info_read&x=' + m.xid ,
        success : function(txt){
            m.arr = i_json2js(txt);
            i_obj_set('d_fname', m.arr['fname']);
            i_obj_set('d_pnums', m_arr2show(0, 1, m.arr['pnum'], array_scale));
            i_obj_set('d_type', m.arr['type']);
            i_obj_set('d_trades', m_arr2show(0, 1, m.arr['trade'], array_industry));
            i_obj_set('d_intro', m.arr['intro']);
        }
    });
}

//function m_info_job_get(){
//    $.ajax({
//        url : i_act + 'a=' + 'info_job&x=' + jid,
//        success : function(txt){
//            m.arr = i_json2js(txt);
//            i_obj_set('d_job_name', m.arr['name']);
//        }
//    });
//}

function m_info_num() {
    $.ajax({
        url : g.act + 'list_job.php?a=list_num&cid=' + m.xid,
        success : function(txt){
            m_jpage_load(txt);
        }
    });
}

function m_jpage_load(info_num) {
    $('#jpage_box').jpage({
        info_all : info_num,
        show_num : '10',
        page_skin : 'blue',
        page_act : m_list_read
    });
}

m_list_read = function(show_num, page_now) {
    $.ajax({
        url : g.act + 'list_job.php?a=list_read&show_num=' + show_num + '&page_now=' + page_now + '&cid=' + m.xid,
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_read_list_val();
        }
    });
}

function m_read_list_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html(i + 1);
        m.xtr.children(':eq(1)').html('<a href="./info_job_look.htm?a=view&x=' + m.arr[i]['id'] + '&cid=' + m.arr[i]['cid'] + '">' + m.arr[i]['name'] + '</a>');
        m.xtr.children(':eq(2)').html(m_arr2show(0, 1, m.arr[i]['addr1'], array_province) + m_arr2show(0, 2, m.arr[i]['addr2'], array_city));
        m.xtr.children(':eq(3)').html(m.arr[i]['begin']);
        m.xtr.children(':eq(4)').html(m.arr[i]['end']);
        if('0' == m.arr[i]['num']){
            m.xtr.children(':eq(5)').html('若干');
        } else {
            m.xtr.children(':eq(5)').html(m.arr[i]['num']);
        }
        
        m.tmp += m.xtr.parents().html();
    }
    $('#list_tb tbody').html(m.tmp);
}