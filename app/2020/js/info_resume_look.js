/**
 * 文件名称：info_resume_look.js
 * 功能描述：查看简历的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m.xtr = $('#list_itskill tbody tr:eq(0)').clone(true);
    m_list_itskill();
    m.atr = $('#list_train tbody tr:eq(0)').clone(true);
    m_list_train();
    m.btr = $('#list_educate tbody tr:eq(0)').clone(true);
    m_list_educate();
    m.ctr = $('#list_work tbody tr:eq(0)').clone(true);
    m_list_work();
    m.dtr = $('#list_item tbody tr:eq(0)').clone(true);
    m_list_item();
    m.etr = $('#list_cert tbody tr:eq(0)').clone(true);
    m_list_cert();
    m.ftr = $('#list_language tbody tr:eq(0)').clone(true);
    m_list_language();
//    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
//    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {

}

function m_info_set_plug() {
    m_info_basic();
}

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


function m_info_basic() {
    $.ajax({
        url : i_act + 'a=info_read&x=' + m.xid,
        success : function(txt){
            m.arr = i_json2js(txt);
            i_obj_set('d_trades', m_arr2show(0, 1, m.arr['trade'], array_industry));
            i_obj_set('d_work_terms', m.arr['work_term']);
            i_obj_set('d_degrees', m.arr['degree']);
            i_obj_set('d_addr2s', m_arr2show(0, 2, m.arr['addr2'], array_city));
            i_obj_set('d_curr_trades', m_arr2show(0, 1, m.arr['curr_trade'], array_industry));
            i_obj_set('d_curr_big_classifications', m_arr2show(0, 1, m.arr['curr_big_classification'], array_occupation));
            i_obj_set('d_curr_small_classifications', m_arr2show(0, 2, m.arr['curr_small_classification'], array_job));
            i_obj_set('d_tradef', m_arr2show(0, 1, m.arr['trade'], array_industry));
            i_obj_set('d_big_classificationf', m_arr2show(0, 1, m.arr['big_classification'], array_occupation));
            i_obj_set('d_small_classificationf', m_arr2show(0, 2, m.arr['small_classification'], array_job));
            i_obj_set('d_addr1f', m_arr2show(0, 1, m.arr['addr1'], array_province));
            i_obj_set('d_addr2f', m_arr2show(0, 2, m.arr['addr2'], array_city));
            i_obj_set('d_etime', (m.arr['etime']).substring(0, 10));
        }
    });
}

function m_list_itskill(){
    $.ajax({
        url : i_act + 'a=list_read_i&rid=' + m.xid + '&type=itskill',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_itskill_val();
        }
    });
}

function m_list_itskill_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html(m.arr[i]['i_txt0']);
        m.xtr.children(':eq(1)').html(m.arr[i]['name']);
        m.xtr.children(':eq(2)').html(m.arr[i]['i_txt1']);
        m.xtr.children(':eq(3)').html(m.arr[i]['i_txt2']);
        m.tmp += m.xtr.parents().html();
    }
    $('#list_itskill tbody').html(m.tmp);
}

function m_list_train(){
    $.ajax({
        url : i_act + 'a=list_read_i&rid=' + m.xid + '&type=train',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_train_val();
        }
    });
}

function m_list_train_val() {
    m.tmp = '';
    var s ="";
    for(var i=0 ; i<m.arr.length; i++) {
        s = '<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor=#EAEAEA><tr bgcolor=#f5f5f5><td width=14% bgcolor=#f3f3f3>培训机构：</td><td colspan=3 bgcolor=#f3f3f3><b>' +  m.arr[i]['name'] +
        '</b> ( ' + m.arr[i]['b_time'] + '至' + m.arr[i]['e_time'] + ' )</td></tr><tr bgcolor=#FFFFFF> <td width=14%>课程名称：</td><td width=36%>' + m.arr[i]['i_txt0'] +
        '</td><td width=14%>荣获证书：</td><td>' + m.arr[i]['i_txt1'] + '</td></tr><tr bgcolor=#FFFFFF><td>课程描述：</td><td colspan="3">' + m.arr[i]['intor'] +
        '</td></tr></table><table cellSpacing=0 cellPadding=0 width=100% border=0><TR><TD height=5></TD></TR></table>';
        m.btr.attr('id', i);
        m.btr.children(':eq(0)').html(s);
        m.tmp += m.btr.parents().html();
    }
    $('#list_train tbody').html(m.tmp);
}

function m_list_educate(){
    $.ajax({
        url : i_act + 'a=list_read_i&rid=' + m.xid + '&type=educate',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_educate_val();
        }
    });
}

function m_list_educate_val() {
    m.tmp = '';
    var s ="";
    for(var i=0 ; i<m.arr.length; i++) {
        s = '<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor=#EAEAEA><tr bgcolor=#f5f5f5><td width=14% bgcolor=#f3f3f3>学校名称：</td><td colspan=3 bgcolor=#f3f3f3><b>' +  m.arr[i]['name'] +
        '</b> ( ' + m.arr[i]['b_time'] + '至' + m.arr[i]['e_time'] + ' )</td></tr><tr bgcolor=#FFFFFF> <td width=14%>专业名称：</td><td width=36%>' + m.arr[i]['i_txt0'] +
        '</td><td width=14%>学历：</td><td>' + m.arr[i]['i_txt1'] + '</td></tr><tr bgcolor=#FFFFFF><td>专业描述：</td><td colspan="3">' + m.arr[i]['intor'] +
        '</td></tr></table><table cellSpacing=0 cellPadding=0 width=100% border=0><TR><TD height=5></TD></TR></table>';
        m.btr.attr('id', i);
        m.btr.children(':eq(0)').html(s);
        m.tmp += m.btr.parents().html();
    }
    $('#list_educate tbody').html(m.tmp);
}

function m_list_work(){
    $.ajax({
        url : i_act + 'a=list_read_i&rid=' + m.xid + '&type=work',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_work_val();
        }
    });
}

function m_list_work_val() {
    m.tmp = '';
    var s ="";
    for(var i=0 ; i<m.arr.length; i++) {
        s = '<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor=#EAEAEA><tr bgcolor=#f5f5f5><td width=14% bgcolor=#f3f3f3>公司名称：</td><td colspan=3 bgcolor=#f3f3f3><b>' +  m.arr[i]['name'] +
        '</b> ( ' + m.arr[i]['b_time'] + '至' + m.arr[i]['e_time'] + ' )</td></tr><tr bgcolor=#FFFFFF> <td width=14%>所属行业：</td><td width=36%>' + m_arr2show(0, 1, m.arr[i]['i_txt0'], array_industry) +
        '</td><td width=14%>公司规模：</td><td>' + m_arr2show(0, 1, m.arr[i]['i_txt1'], array_scale) + '</td></tr><tr bgcolor=#FFFFFF> <td width=14%>公司性质：</td><td width=36%>' + m.arr[i]['i_txt2'] +
        '</td><td width=14%>职位名称：</td><td>' + m_arr2show(0, 1, m.arr[i]['i_txt3'], array_occupation) + ' ' + m_arr2show(0, 2, m.arr[i]['i_txt4'], array_job) +'</td></tr><tr bgcolor=#FFFFFF><td>工作描述：</td><td colspan="3">' + m.arr[i]['intor'] +
        '</td></tr></table><table cellSpacing=0 cellPadding=0 width=100% border=0><TR><TD height=5></TD></TR></table>';
        m.ctr.attr('id', i);
        m.ctr.children(':eq(0)').html(s);
        m.tmp += m.ctr.parents().html();
    }
    $('#list_work tbody').html(m.tmp);
}

function m_list_item(){
    $.ajax({
        url : i_act + 'a=list_read_i&rid=' + m.xid + '&type=item',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_item_val();
        }
    });
}

function m_list_item_val() {
    m.tmp = '';
    var s ="";
    for(var i=0 ; i<m.arr.length; i++) {
        s = '<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor=#EAEAEA><tr bgcolor=#f5f5f5><td width=14% bgcolor=#f3f3f3>项目名称：</td><td width="86%" bgcolor=#f3f3f3><b>' +  m.arr[i]['name'] +
        '</b> ( ' + m.arr[i]['b_time'] + '至' + m.arr[i]['e_time'] + ' )</td></tr><tr bgcolor=#FFFFFF><td>软件环境：</td><td>' + m.arr[i]['i_txt1'] +
        '</td></tr><tr bgcolor=#FFFFFF><td>硬件环境：</td><td>' + m.arr[i]['i_txt2'] + '</td></tr><tr bgcolor=#FFFFFF><td>开发工具：</td><td>' + m.arr[i]['i_txt3'] +
        '</td></tr><tr bgcolor=#FFFFFF><td>项目描述：</td><td>' + m.arr[i]['i_txt4'] +
        '</td></tr><tr bgcolor=#FFFFFF><td>责任描述：</td><td>' + m.arr[i]['intor'] +
        '</td></tr></table><table cellSpacing=0 cellPadding=0 width=100% border=0><TR><TD height=5></TD></TR></table>';
        m.dtr.attr('id', i);
        m.dtr.children(':eq(0)').html(s);
        m.tmp += m.dtr.parents().html();
    }
    $('#list_item tbody').html(m.tmp);
}

function m_list_cert(){
    $.ajax({
        url : i_act + 'a=list_read_i&rid=' + m.xid + '&type=cert',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_cert_val();
        }
    });
}

function m_list_cert_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.etr.attr('id', i);
        m.etr.children(':eq(0)').html(m.arr[i]['b_time']);
        m.etr.children(':eq(1)').html(m.arr[i]['name']);
        m.etr.children(':eq(2)').html(m.arr[i]['i_txt0']);
        m.tmp += m.etr.parents().html();
    }
    $('#list_cert tbody').html(m.tmp);
}

function m_list_language(){
    $.ajax({
        url : i_act + 'a=list_read_i&rid=' + m.xid + '&type=language',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_language_val();
        }
    });
}

function m_list_language_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.ftr.attr('id', i);
        m.ftr.children(':eq(0)').html(m.arr[i]['name']);
        m.ftr.children(':eq(1)').html(m.arr[i]['i_txt0']);
        m.ftr.children(':eq(2)').html(m.arr[i]['i_txt1']);
        m.ftr.children(':eq(3)').html(m.arr[i]['i_txt2']);
        m.tmp += m.ftr.parents().html();
    }
    $('#list_language tbody').html(m.tmp);
}