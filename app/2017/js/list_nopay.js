/**
* 文件名称：list_nopay.js
* 功能描述： 未缴费统计表的前台程序。
* 代码作者：王争强（优化）
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/

//$(document).ready(function(){
//
//});

function m_load() {
  //给td添加事件
    m.xtr.children(':eq(1)').dblclick(function(){
        m.xid  = this.parentNode.id;
        i_mdi_open('./info_medi.htm?a=view&x=' +  m.arr[m.xid]['id'], m.arr[m.xid]['name'] + ':医保管理');
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
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['medi_code']);
    m.xtr.children(':eq(3)').html(m.arr[i]['medi_state']);
    m.xtr.children(':eq(4)').html(m.arr[i]['idcard']);
    m.xtr.children(':eq(5)').html(m.arr[i]['jmedi_time']);
    m.xtr.children(':eq(6)').html((m.arr[i]['pay_deadtime']));
    m.xtr.children(':eq(7)').html(m.arr[i]['month_num'] + '个月未缴费');
}

