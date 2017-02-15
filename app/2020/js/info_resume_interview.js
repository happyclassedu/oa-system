/**
 * 文件名称：info_resume_interview.js
 * 功能描述：面试管理夹的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */
var xid = '';

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }

    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    m_info_num();
//    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
//    $('#d_i_time').jdate({
//        dateFormat: 'yy-mm-dd HH:mm:ss'
//    });

}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    i_obj_hide('info_tilte');
    i_obj_hide('info_tb');
    i_obj_hide('act_tb');
}


function m_info_edit_plug() {
    i_obj_set('d_i_txt1', '0');
    i_obj_set('d_i_txt2', '0');
//    i_obj_disable('d_p_name');
//    i_obj_disable('d_j_name');
}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
    window.location.reload();
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    return true;
}

//function m_error_init(){
//
//}


function m_info_num() {
    $.ajax({
        url : i_act + 'a=list_num',
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
        url : i_act + 'a=list_read&show_num=' + show_num + '&page_now=' + page_now,
        success : function(text){
            m.arr = i_json2js(text);  //将php文件进行解密，并返回到js
            m_read_list_val();
            m_read_list_btn();
            i_tr_css($('#list_tb tbody tr'));
        }
    });
}

function m_read_list_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html(i + 1);
        m.xtr.children(':eq(1)').html(m.arr[i]['name']);
        m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
        m.xtr.children(':eq(3)').html(m.arr[i]['degree']);
        m.xtr.children(':eq(4)').html(m.arr[i]['j_name']);
        m.xtr.children(':eq(5)').html(m.arr[i]['i_time']);
        m.xtr.children(':eq(6)').html(m.arr[i]['i_txt0']);
        if('1' == m.arr[i]['i_txt1']){
            m.xtr.children(':eq(7)').html('已参加');
        } else {
            m.xtr.children(':eq(7)').html('未参加');
        }
        if('1' == m.arr[i]['i_txt2']){
            m.xtr.children(':eq(8)').html('<FONT color=#009900>√</FONT>');
        } else {
            m.xtr.children(':eq(8)').html('<FONT color=#ff0000>×</FONT>');
        }
        m.xtr.children(':eq(9)').html(m.arr[i]['atime']);
        m.tmp += m.xtr.parents().html();
    }
    $('#list_tb tbody').html(m.tmp);
}

function m_read_list_btn() {
    
    $('.btn_view').click(function(){
        xid = this.parentNode.parentNode.id;
        i_mdi_open('./info_resume_look.htm?a=view&x=' + m.arr[xid]['r_id'] ,'英才网--查看简历', 1);
    });

    $('.btn_edit').click(function(){
        xid = this.parentNode.parentNode.id;
        xid = m.arr[xid]['id'];
        i_mdi_open('./info_resume_interview.htm?a=edit&x=' + xid ,'英才网--面试管理夹', 1);
    });
    
    $('.btn_del').click(function(){
        m.tmp = '';
        xid = this.parentNode.parentNode.id;
        m.tmp = m.arr[xid]['p_name'];
        xid = m.arr[xid]['id'];
        m_info_del_interview();
    });
}

function m_info_del_interview() {
    if (confirm('确定要删除“' + m.tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + xid ,
            success : function(txt){
                if(txt > 0)
                {
                     m_info_num();
                } else {
                     alert('删除' + m.tmp + '失败！');
                }
            }
        });
    }
}