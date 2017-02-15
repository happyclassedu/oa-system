/**
* 文件名称：list_stat.js
* 功能描述： 医疗缴费统计表的前台程序。
* 代码作者：王争强（优化）
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/

//$(document).ready(function(){
//
//});

function m_load() {
    m_list_stat_read();
     //给td添加事件
    m.xtr.children(':eq(2)').dblclick(function(){
        m.xid  = this.parentNode.id;
        i_mdi_open('./info_medi.htm?a=view&x=' +  m.arr[m.xid]['pid']);
    });
}

function m_btn_load_plug() {

     $('#btn_search').click(function(){
          m_list_stat_read();
    });

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
    m.xtr.children(':eq(1)').html(m.arr[i]['time']);
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['idcard']);
    m.xtr.children(':eq(4)').html(m.arr[i]['medi_code']);
    m.xtr.children(':eq(5)').html(m.arr[i]['fee_num']);
    m.xtr.children(':eq(6)').html((m.arr[i]['fee_begin']).substr(0, 4)+ '年' + (m.arr[i]['fee_begin']).substr(5, 2) + '月' + '-' + (m.arr[i]['fee_end']).substr(0, 4)+ '年' + (m.arr[i]['fee_end']).substr(5, 2) + '月');
    m.xtr.children(':eq(7)').html(m.arr[i]['fee_months']);
}

function m_list_stat_read(){
    $.ajax({
        url : i_act + 'a=info_stat',
        data : 'val_search=' + m.val_search,
        success : function(text){
            m.arr  = i_json2js(text);
            m_list_set_val();
        }
    });
}

function m_list_set_val(){
     $.each(m.arr, function(key){
        i_obj_set('d_' + key, m.arr[key]);
    });
}
