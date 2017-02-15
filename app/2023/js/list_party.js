/**
 * 文件名称：list_party.js
 * 功能描述：党员信息登记列表的前台程序。
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
        m.xtr.children(':eq(1)').dblclick(function(){
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
         i_mdi_open('./list_pbill.htm?a=list');
    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_search').click();
        }
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(3)').html(m.arr[i]['cardid']);
    m.xtr.children(':eq(4)').html(m.arr[i]['birth']);
    m.xtr.children(':eq(5)').html(m.arr[i]['nation']);
    m.xtr.children(':eq(6)').html(m.arr[i]['native_place']);
    m.xtr.children(':eq(7)').html(m.arr[i]['degree']);
    m.xtr.children(':eq(8)').html(m.arr[i]['univ']);
    m.xtr.children(':eq(9)').html(m.arr[i]['party_type']);
    m.xtr.children(':eq(10)').html(m.arr[i]['join_party_time']);
    m.xtr.children(':eq(11)').html(m.arr[i]['party_state']);
    m.xtr.children(':eq(12)').html(m.arr[i]['addr']);
    m.xtr.children(':eq(13)').html(m.arr[i]['tel_0']);
    m.xtr.children(':eq(14)').html(m.arr[i]['remark']);
}

function m_search_act_plug(arr) {
    var tmp;
    $('#list_tb tbody td').each(function(i){
        tmp = '';
        if(i%15 == 1){
            tmp = arr['name'];
        } else if(i%15 == 2){
            tmp = arr['sex'];
        } else if(i%15 == 3){
            tmp = arr['cardid'];
        } else if(i%15 == 4){
            tmp = arr['birth'];
        } else if(i%15 == 8){
            tmp = arr['univ'];
        } else if(i%15 == 9){
            tmp = arr['party_type'];
        } else if(i%15 == 10){
            tmp = arr['join_party_time'];
        } else if(i%15 == 12){
            tmp = arr['addr'];
        } else if(i%15 == 13){
            tmp = arr['tel_0'];
        }

        if('' != tmp && undefined != tmp){
            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
        }
    });
}