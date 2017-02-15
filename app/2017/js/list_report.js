/**
 * 文件名称：list_report.js
 * 功能描述：医疗缴费统计表的前台程序。
 * 代码作者：王争强（优化）
 * 创建日期：2010-07-13
 * 修改日期：2010-07-13
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
     //给td添加事件
        m.xtr.children(':eq(4)').dblclick(function(){
        m.xid  = this.parentNode.id;
        i_mdi_open('./info_medi.htm?a=view&x=' +  m.arr[m.xid]['pid']);
    });
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#d_fee_s').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_fee_e').jdate({
        dateFormat: 'yy-mm-dd'
    });

      $('#btn_reset').click(function(){
        $('#box_search input, #box_search  select').each(function() {
            if('btn_search' != this.id && 'btn_reset' != this.id){
                i_obj_set(this.id, '');
            }
        });
    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_search').click();
        }
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['jmedi_time']);
    if('0000-00-00' == m.arr[i]['ori_pay_deadtime']){
        m.arr[i]['ori_pay_deadtime'] = '';
    }
    m.xtr.children(':eq(2)').html(m.arr[i]['ori_pay_deadtime']);
    m.xtr.children(':eq(3)').html(m.arr[i]['medi_code']);
    m.xtr.children(':eq(4)').html(m.arr[i]['pname']);
    m.xtr.children(':eq(5)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(6)').html(m.arr[i]['medi_type']);
    m.xtr.children(':eq(7)').html(m.arr[i]['idcard']);
    m.xtr.children(':eq(8)').html((m.arr[i]['fee_begin']).substr(0, 4)+ '年');
    m.xtr.children(':eq(9)').html(m.arr[i]['fee_num']);
    if('新增' != m.arr[i]['fee_type']){
        m.xtr.children(':eq(10)').html((m.arr[i]['zfee_end']).substr(0, 4)+ '年' + (m.arr[i]['zfee_end']).substr(5, 2) + '月');
    }else {
        m.xtr.children(':eq(10)').html('');
    }
    m.xtr.children(':eq(11)').html((m.arr[i]['fee_begin']).substr(0, 4)+ '年' + (m.arr[i]['fee_begin']).substr(5, 2) + '月');
    m.xtr.children(':eq(12)').html((m.arr[i]['fee_end']).substr(0, 4)+ '年'+ (m.arr[i]['fee_end']).substr(5, 2) + '月');
    m.xtr.children(':eq(13)').html(m.arr[i]['fee_type']);
}