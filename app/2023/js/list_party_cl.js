/**
 * 文件名称：list_party_cl.js
 * 功能描述：党员材料管理的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */
m.arr = '';

//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    //给td添加事件
        m.xtr.children(':eq(3)').dblclick(function(){
        m.xid  = this.parentNode.id;
        i_mdi_open('./info_party.htm?a=view&x=' +  m.arr[m.xid]['id'], m.arr[m.xid]['name'] + ' | 党员管理');
    });
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_oh').click(function(){
       i_mdi_open('./list_poh.htm?a=list');
    });

     $('#btn_bill').click(function(){
         i_mdi_open('./list_bill.htm?a=list');
    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_search').click();
        }
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['atime']);
    m.xtr.children(':eq(2)').html(m.arr[i]['party_code'])
    m.xtr.children(':eq(3)').html(m.arr[i]['name']);
    m.xtr.children(':eq(4)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(5)').html(m.arr[i]['univ']);
    m.xtr.children(':eq(6)').html(m.arr[i]['party_type']);
    m.xtr.children(':eq(7)').html(m.arr[i]['join_party_time']);
    m.xtr.children(':eq(8)').html(m.arr[i]['party_state']);
    m.xtr.children(':eq(9)').html(m.arr[i]['remark']);
}
