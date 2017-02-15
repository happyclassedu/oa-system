/**
 * 文件名称：info_resume_educate.js
 * 功能描述：修改教育经历的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */
var xid = '';
var rid = '';

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }

    rid = i_get('rid');
    i_obj_hide('jpage_box');
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
//    i_tr_css($('#list_tb tbody tr'));
    m_info_num();
    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_b_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_e_time').jdate({
        dateFormat: 'yy-mm-dd'
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    i_obj_set('d_r_id' , rid);
    i_obj_set('d_i_type' , 'educate');
    i_obj_set('d_open' , 1);
}


//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
//    window.location.reload();
    i_mdi_open('./info_resume_work.htm?a=add&x=' + rid +'&rid='+ rid, '简历--工作经验', 1);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_b_time');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_time', '开始日期不能为空，请填写！',  '0');
        return false;
    } else {
        m_error_msg('d_error_time', '通过', '2');
    }

    m.tmp = i_obj_val('d_e_time');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_time', '截止日期不能为空，请填写！',  '0');
        return false;
    } else {
        var begin = i_obj_val('d_b_time');
        if(begin > m.tmp){
            m_error_msg('d_error_time', '开始日期不能大于截止日期，请重选！',  '0');
            return false;
        } else {
             m_error_msg('d_error_time', '通过', '2');
        }
    }
    
    m.tmp = i_obj_val('d_name');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_name', '学校名称不能为空，请填写！',  '0');
        return false;
    } else {
        m_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_i_txt0');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_i_txt0', '专业名称不能为空，请填写！',  '0');
        return false;
    } else {
        m_error_msg('d_error_i_txt0', '通过', '2');
    }

    m.tmp = i_obj_val('d_i_txt1');
    if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_i_txt1', '学历不能为空，请选择！',  '0');
        return false;
    } else {
        m_error_msg('d_error_i_txt1', '通过', '2');
    }
    
     m.tmp = i_obj_val('intor');
     if(m.tmp == '' && (m.tmp).length == 0){
        m_error_msg('d_error_intor', '专业描述不能为空，请填写！', '0');
        return false;
     } else {
        if((m.tmp).length < 300){
            m_error_msg('d_error_intor', '通过', '2');
        } else {
            m_error_msg('d_error_intor', '专业描述超过了300字，请重写！', '0');
            return false;
        }
     }
   
    return true;
}

function m_error_init(){
    m_error_msg('d_error_time', '(后两项不填表示至今)', '1');
}

function m_info_num() {
    $.ajax({
        url : i_act + 'a=list_num&rid=' + rid + '&type=educate',
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
        url : i_act + 'a=list_read&show_num=' + show_num + '&page_now=' + page_now + '&rid=' + rid + '&type=educate',
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
        m.xtr.children(':eq(1)').html(m.arr[i]['b_time'] + '至' + m.arr[i]['e_time']);
        m.xtr.children(':eq(2)').html(m.arr[i]['name']);
        m.xtr.children(':eq(3)').html(m.arr[i]['i_txt0']);
        m.tmp += m.xtr.parents().html();
    }
    $('#list_tb tbody').html(m.tmp);
}

function m_read_list_btn() {
    $('.btn_edit').click(function(){
        xid = this.parentNode.parentNode.id;
        xid = m.arr[xid]['id'];
        i_mdi_open('./info_resume_educate.htm?a=edit&x=' + xid + '&rid=' + rid,'英才网--教育经历', 1);
    });
    $('.btn_del').click(function(){
        m.tmp = '';
        xid = this.parentNode.parentNode.id;
        m.tmp = m.arr[xid]['name'];
        xid = m.arr[xid]['id'];
        m_info_del();
    });
}

function m_info_del() {
    if (confirm('确定要删除“' + m.tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + xid ,
            success : function(text){
                if(text > 0)
                {
                     m_info_num();
                } else {
                     alert('删除' + m.tmp + '失败！');
                }
            }
        });
    }
}