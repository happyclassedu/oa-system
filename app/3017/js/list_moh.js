/**
 * 文件名称：list_moh.js
 * 功能描述：参保人员信息列表的前台程序。
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
        i_mdi_open('./info_medi.htm?a=view&x=' +  m.arr[m.xid]['pid']);
    });
}

function m_btn_load_plug() {
    
    $('#btn_add_medi').click(function(){
        i_mdi_open('./info_medi.htm?a=add');
    });

    $('#btn_bill').click(function(){
        i_mdi_open('./list_bill.htm?a=list');
    });

    $('#btn_report').click(function(){
        i_mdi_open('./list_report.htm?a=list');
    });

    $('#btn_stat').click(function(){
        i_mdi_open('./list_stat.htm?a=list');
    });

    $('#btn_reset').click(function(){
        $('#search_tb input, #search_tb  select').each(function() {
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

//     $('#btn_search').click(function(){
//
//    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['pname']);
    m.xtr.children(':eq(2)').html(m.arr[i]['medi_code']);
    m.xtr.children(':eq(3)').html(m.arr[i]['medi_state']);
    m.xtr.children(':eq(4)').html(m.arr[i]['idcard']);
    m.xtr.children(':eq(5)').html(m.arr[i]['yname']);
    m.xtr.children(':eq(6)').html(m.arr[i]['ytext']);
}

//function m_search_plug() {    
//}

function m_search_act_plug(arr) {
    var tmp;
    $('#list_tb tbody td').each(function(i){
        tmp = '';
        if(i%7 == 1){
            tmp = arr['pname'];
        } else if(i%7 == 2){
            tmp = arr['medi_code'];
        } else if(i%7 == 3){
            tmp = arr['medi_state'];
        } else if(i%7 == 4){
            tmp = arr['idcard'];
        } else if(i%7 == 5){
            tmp = arr['yname'];
        }

        if('' != tmp && undefined != tmp){
            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
        }
    });
}