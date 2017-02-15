/**
 * 文件名称：list_job.js
 * 功能描述：岗位管理模块的列表程序。
 * 代码作者：钱包伟（创建）、王争强（优化）、孙振强（重构）
 * 创建日期：2010-06-10
 * 修改日期：2010-07-18
 * 当前版本：V3.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    //给td添加事件
    m.xtr.children(':eq(2)').click(function(){
        m.xid  = this.parentNode.id;
        parent.mdi_open('/oa_2009/act/pinfo_yanglao.php?act=edit&xid=' +  m.arr[m.xid]['id'], m.arr[m.xid]['pname'] + ':养老保险管理', '-2');
    });
    m.xtr.children(':eq(2)').addClass('list_td_click');
    m.date_s = $.cookie('yanglao_date_s');
    m.date_e = $.cookie('yanglao_date_e');
    if (!m.date_s || !m.date_e) {
        var date_n = new Date();
        date_n = date_n.getYear()+"-"+(date_n.getMonth()+1)+"-"+date_n.getDate();
        m.date_s = m.date_e = date_n;
    }
    i_obj_set('d_date_s', m.date_s);
    i_obj_set('d_date_e', m.date_e);
    $('#d_date_s').jdate({
        dateFormat: 'yy-mm-dd'
    });
    $('#d_date_e').jdate({
        dateFormat: 'yy-mm-dd'
    });
    m_search();
    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_down').click(function(){
        m_list_down();
    });
}

function m_list_down() {
    m.tmp = m_search_plug();
    if (false == m.tmp) {
        return false;
    }
    i_mdi_open(i_act + 'a=list_read4excel&date_s=' + m.date_s + '&date_e=' + m.date_e, '养老保险报表下载', 1);
}

function m_search_plug() {
    m.date_s = i_obj_val('d_date_s');
    m.date_e = i_obj_val('d_date_e');
    if ('' == m.date_s) {
        alert("请输入--开始日期！");
        return false;
    }
    if ('' == m.date_e) {
        alert("请输入--结束日期！");
        return false;
    }
    if (m.date_s > m.date_e) {
        alert("请检查输入的日期，开始日期 大于 了 结束日期！");
        return false;
    }
    $.cookie('yanglao_date_s', m.date_s);
    $.cookie('yanglao_date_e', m.date_e);
}

function m_search_act_plug(arr) {
    return false;
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['yanglaoid']);
    m.xtr.children(':eq(2)').html(m.arr[i]['pname']);
    m.xtr.children(':eq(3)').html(m.arr[i]['cardid']);
    m.xtr.children(':eq(4)').html(m.arr[i]['jfjs']);
    m.xtr.children(':eq(5)').html(m.arr[i]['interest']);
    m.xtr.children(':eq(6)').html(m.arr[i]['feestate']);
    m.xtr.children(':eq(7)').html(m.arr[i]['feenum']);
    m.xtr.children(':eq(8)').html(m.arr[i]['feebegin']);
    m.xtr.children(':eq(9)').html(m.arr[i]['feeend']);
    m.xtr.children(':eq(10)').html(m.arr[i]['feeatime']);
}