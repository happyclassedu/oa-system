/**
 * 文件名称：ileap_list.js
 * 功能描述：劳动协管员模块信息列表的前台程序。
 * 代码作者：钱宝伟（创建）、王争强（修改）、孙振强（优化）
 * 创建日期：2010-06-04
 * 修改日期：2010-06-07
 * 当前版本：V3.0
 */

var xid;
var i;
var m = {
    tmp : '',
    arr : '',
    xtr : '',
    val_search : '',
    info_num : 0,
    show_num : 10,
    page_now : 1
};

$(document).ready(function(){
    m.xtr = $('#list_table tbody tr:eq(0)').clone(true);
    i_tr_css($('#list_table tbody tr'));
    m_jpage_load();
    m_btn_load();
    m_info_num();
});

function m_btn_load() {
    $('#btn_add').click(function(){
        i_mdi_open('./ileap_info.htm?a=add', '新增--劳动协理员');
    });

    $('#btn_refresh').click(function(){
        m_list_num();
    });

    $('#btn_search').click(function(){
        m.val_search = i_obj_val('val_search');
        m.val_search = i_js2json(m.val_search);
        m_list_num();
    });
    $('#val_search').keypress(function() {
        if(event.keyCode==13){
            $('#btn_search').click();
        }
    });
}

function m_info_del() {
    m.tmp = confirm('确定要删除“' + m.tmp + '”吗？');
    if (true == m.tmp) {
        $.ajax({
            url : i_act + 'a=del_info&x=' + xid ,
            success : function(txt){
                alert(txt);
                m_list_num();
            }
        });
    }
}

function m_list_num() {
    $.ajax({
        url : i_act + 'a=list_num',
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.info_num = txt;
            m_jpage_load();
        }
    });
}

function m_jpage_load() {
    $('#jpage_box').jpage({
        info_all : m.info_num,
        show_num : m.show_num,
        page_skin : 'blue',
        page_act : function(show_num, page_now){
            m.show_num = show_num;
            m.page_now = page_now;
            m_read_list();
        }
    });
}

function m_list_read() {
    $.ajax({
        url : i_act + 'a=read_list&show_num=' + m.show_num + '&page_now=' + m.page_now,
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_read_set();
            i_tr_css($('#list_table tbody tr'));
            m_list_read_btn();
            m_search_act();
        }
    });
}

function m_list_read_set() {
    m.tmp = '';
    for(i=0; i<m.arr.length; i++) {
        xtr.attr('id', i);
        xtr.children(':eq(0)').html(m.show_num * m.page_now - m.show_num + i + 1);
        xtr.children(':eq(1)').html(arr[i]['ileap_code']);
        xtr.children(':eq(2)').html(arr[i]['ileap_name']);
        xtr.children(':eq(3)').html(arr[i]['degree']);
        xtr.children(':eq(4)').html(arr[i]['job_type']);
        xtr.children(':eq(5)').html(arr[i]['job_addr_0_name']);
        xtr.children(':eq(6)').html(arr[i]['job_addr_1_name']);
        tmp += xtr.parents().html();
    }
    $('#list_table tbody').html(tmp);
}

function m_list_read_btn() {
    $('.btn_view').click(function(){
        xid = this.parentNode.parentNode.id;
        tmp = arr[xid]['ileap_name'];
        xid = arr[xid]['id'];
        i_mdi_open('./ileap_info.htm?a=view&x=' + xid, tmp + '--劳动协理员管理');
    });
    $('.btn_edit').click(function(){
        xid = this.parentNode.parentNode.id;
        tmp = arr[xid]['ileap_name'];
        xid = arr[xid]['id'];
        i_mdi_open('./ileap_info.htm?a=edit&x=' + xid, tmp + '--劳动协理员管理');
    });
    $('.btn_del').click(function(){
        xid = this.parentNode.parentNode.id;
        tmp = arr[xid]['ileap_name'];
        xid = arr[xid]['id'];
        i_ileap_info_del();
    });
}

function m_search_act() {
    tmp = i_obj_val('val_search');
    if ('' == tmp) {
        return;
    }
    $('#list_table tbody td[class!="btn_box"]').each(function() {
        this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
    });
}