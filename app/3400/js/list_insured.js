/**
 * 文件名称：list_insured.js
 * 功能描述：参保人员管理的列表程序。
 * 代码作者：孙振强（创建）
 * 创建日期：2011-05-08
 * 修改日期：2011-05-08
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//});

function m_load() {
    m.g_tmp = i_obj_val('g_tmp');
    m.ii = 0;
//    return false;  //可以终止初始化
}

function m_list_read_btn_plug() {
    $('.btn_choose').click(function(){
        parent.i_box_close(m.arr[this.parentNode.parentNode.id]);
    });
}

function m_list_read_set_plug() {
    if ('shenghe' == m.g_tmp) {
        m.xtr.children(':eq(1)').html(m.arr[i]['name']);
        m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
        m.xtr.children(':eq(3)').html(m.arr[i]['idcard']);
        m.xtr.children(':eq(4)').html(m.arr[i]['ins_code']);
        m.xtr.children(':eq(5)').html(m.arr[i]['ins_base']);
        m.xtr.children(':eq(6)').html(m.arr[i]['org_2']);
        m.xtr.children(':eq(7)').html(m.arr[i]['org_1']);
    } else if ('ins_pay' == m.g_tmp) {
        if ('' == m.arr[i]['bankcard_code']) {
            return false;
        }
        m.ii++;
        m.xtr.children(':eq(0)').html(m.ii);
        m.xtr.children(':eq(1)').html(m.arr[i]['name']);
        m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
        m.xtr.children(':eq(3)').html(m.arr[i]['idcard']);
        m.xtr.children(':eq(4)').html(m.arr[i]['ins_code']);
        m.xtr.children(':eq(5)').html(m.arr[i]['bankcard_code']);
        m.xtr.children(':eq(6)').html(m.arr[i]['tel_1']);
    } else {
        m.xtr.children(':eq(1)').html(m.arr[i]['name']);
        m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
        m.xtr.children(':eq(3)').html(m.arr[i]['idcard']);
        m.xtr.children(':eq(4)').html(m.arr[i]['ins_code']);
        m.xtr.children(':eq(5)').html(m.arr[i]['ins_base']);
        m.xtr.children(':eq(6)').html(m.arr[i]['org_2']);
        m.xtr.children(':eq(7)').html(m.arr[i]['org_1']);
        m.xtr.children(':eq(8)').html(m.arr[i]['disability']);
        m.xtr.children(':eq(9)').html(m.arr[i]['tel_1']);
    }
}