/**
* 文件名称：list_bill.js
* 功能描述：工作日结清单功能的前台程序。
* 代码作者：王争强（优化）
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/


$(document).ready(function(){

    m.ytr = $('#list_bill tbody tr:eq(0)').clone(true);
    m.yname_id = '';
    m.z_pid = '';
    m.f_pid = '';
    m.info = '';
    m.td_act = '';
    
    m.oh = new Array(
        '转入医疗保险',
        '转出医疗保险',
        '打印缴费单',
        '医保缴费',
        '领取医保卡',
        '办理医保卡',
        '医疗报销',
        '退休' );

    i_tr_css($('#list_bill tbody tr'));
});

function m_load() {
//    m_info_time();
    m_list_bill_read();
}

function m_btn_load_plug() {

    $('#btn_search').click(function(){
       m_list_bill_read();
    });

    $('#d_fee_s').jdate({
        dateFormat: 'yy-mm-dd'
    });
    
    $('#d_fee_e').jdate({
        dateFormat: 'yy-mm-dd'
    });

    m.xtr.children(':eq(4)').click(function(){
         m.xid = this.parentNode.id;
         m.tmp = m.arr[m.xid]['pid'];
         i_mdi_open('./info_medi.htm?a=view&x=' + m.tmp);
    });

    m.ytr.children(':eq(1)').dblclick(function(){
        m.td_act = 'e1';
        m.yname_id = this.parentNode.id;
        $('#btn_search').click();
    });

    m.ytr.children(':eq(2)').dblclick(function(){
        m.td_act = 'e2';
        m.yname_id  = this.parentNode.id;
        m.z_id = m.info[m.yname_id]['shift_zid'];
        $('#btn_search').click();

    });

    m.ytr.children(':eq(3)').dblclick(function(){
        m.td_act = 'e3';
        m.yname_id  = this.parentNode.id;
        m.z_id = m.info[m.yname_id]['shift_zid'];
        m.y_id = m.info[m.yname_id]['shift_yid'];
        $('#btn_search').click();
    });

    m.ytr.children(':eq(4)').dblclick(function(){
        m.td_act = 'e4';
        m.yname_id  = this.parentNode.id;
        m.z_id = m.info[m.yname_id]['shift_zid'];
        m.y_id = m.info[m.yname_id]['shift_yid'];
        $('#btn_search').click();
    });

     m.ytr.children(':eq(5)').dblclick(function(){
        m.td_act = 'e5';
        m.yname_id  = this.parentNode.id;
        m.z_id = m.info[m.yname_id]['shift_zid'];
        m.y_id = m.info[m.yname_id]['shift_yid'];
        $('#btn_search').click();
    });

     m.ytr.children(':eq(6)').dblclick(function(){
        m.td_act = 'e6';
        m.yname_id  = this.parentNode.id;
        $('#btn_search').click();
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

function m_search_plug(){
    if('e1' == m.td_act){
        m.val_search['td_act'] = 'e1';
        m.val_search['yname_id'] = m.yname_id;
    }else if('e2' == m.td_act){
        m.val_search['td_act'] = 'e2';
        m.val_search['yname_id'] = m.yname_id;
        m.val_search['z_id'] = m.z_id;
    }else if('e3' == m.td_act){
        m.val_search['td_act'] = 'e3';
        m.val_search['yname_id'] = m.yname_id;
        m.val_search['y_id'] = m.y_id;
    }else if('e4' == m.td_act){
        m.val_search['td_act'] = 'e4';
        m.val_search['yname_id'] = m.yname_id;
        m.val_search['z_id'] = m.z_id;
        m.val_search['y_id'] = m.y_id;
    }else if('e5' == m.td_act){
        m.val_search['td_act'] = 'e5';
        m.val_search['yname_id'] = m.yname_id;
        m.val_search['z_id'] = m.z_id;
        m.val_search['y_id'] = m.y_id;
    }else if('e6' == m.td_act){
        m.val_search['td_act'] = 'e6';
        m.val_search['yname_id'] = m.yname_id;
    }
}

function m_list_read_set_plug() {

//       m.xtr.children(':eq(1)').html(m.arr);
    m.xtr.children(':eq(1)').html(m.arr[i]['time']);
    m.xtr.children(':eq(2)').html(m.arr[i]['uname']);
    m.xtr.children(':eq(3)').html(m.arr[i]['yname']);
    m.xtr.children(':eq(4)').html(m.arr[i]['pname']);
    m.xtr.children(':eq(5)').html(m.arr[i]['ytext']);
}

//function m_list_read_btn_plug() {
//
//}

function m_list_bill_read(){
    $.ajax({
        url : i_act + 'a=info_stat', 
        data : 'val_search=' + m.val_search,
        success : function(txt){ 
            m.info  = i_json2js(txt);
            m_list_bill_val();
            i_tr_css($('#list_bill tbody tr'));
        }
    });
}
//可以添加click事件
function m_list_bill_val(){
    $('#list_bill tbody').html('');
    for(i=0 ; i < m.info.length; i++){
        m.ytr.attr('id', i);
        m.ytr.children(':eq(0)').html(i + 1);
        m.ytr.children(':eq(1)').html(m.oh[i]);
        m.ytr.children(':eq(2)').html(m.info[i]['shift_i_z']);
        m.ytr.children(':eq(3)').html(m.info[i]['shift_i_y']);
        m.ytr.children(':eq(4)').html(m.info[i]['sub_total']);
        m.ytr.children(':eq(5)').html(m.info[i]['other_total']);
        m.ytr.children(':eq(6)').html(m.info[i]['sum_total']);
        $('#list_bill tbody').append(m.ytr.clone(true));
    }
}

function m_info_time(){
    $.ajax({
        url : i_act + 'a=info_time',
        success : function(txt){
            i_obj_set('d_fee_s', txt);
            i_obj_set('d_fee_e', txt);
        }
    });
}

