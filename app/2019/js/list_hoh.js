/**
 * 文件名称：list_hoh.js
 * 功能描述：户籍婚姻业务信息列表的前台程序。
 * 代码作者：钱宝伟、王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
 //给td添加事件
     m.xtr.children(':eq(2)').dblclick(function(){
        m.xid  = this.parentNode.id;
        i_mdi_open('./info_hreg.htm?a=view&x=' +  m.arr[m.xid]['pid'], m.arr[m.xid]['pname'] + ' | 户籍管理');
    });
 //    return false;  //可以终止初始化
}

function m_btn_load_plug() {

    $('#btn_add_hreg').click(function(){
        i_mdi_open('./info_hreg.htm?a=add');
    });

    $('#btn_bill').click(function(){
        i_mdi_open('./list_bill.htm?a=list');
    });

    $('#btn_stat').click(function(){
        i_mdi_open('./list_stat.htm?a=list');
    });

//     $('#btn_search').click(function(){
//
//    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_search').click();
        }
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['time']);
    m.xtr.children(':eq(2)').html(m.arr[i]['pname']);
    m.xtr.children(':eq(3)').html(m.arr[i]['uname']);
    m.xtr.children(':eq(4)').html(m.arr[i]['ytype']);
    m.xtr.children(':eq(5)').html(m.arr[i]['yname']);
    m.xtr.children(':eq(6)').html(m.arr[i]['operating_record']);
}

//function m_search_plug() {
//}

function m_search_act_plug(arr) {
    var tmp;
    $('#list_tb tbody td').each(function(i){
        tmp = '';
        if(i%7 == 2){
            tmp = arr['pname'];
        } else if(i%7 == 3){
            tmp = arr['uname'];
        } else if(i%7 == 5){
            tmp = arr['yname'];
        }

        if('' != tmp && undefined != tmp){
            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
        }
    });
}