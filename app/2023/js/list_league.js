/**
 * 文件名称：list_league.js
 * 功能描述：团员信息登记列表的前台程序。
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
        m.xtr.children(':eq(2)').dblclick(function(){
        m.xid  = this.parentNode.id;
        i_mdi_open('./info_league.htm?a=view&x=' +  m.arr[m.xid]['id'], m.arr[m.xid]['name'] + ' | 团员管理');
    });
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_oh').click(function(){
       i_mdi_open('./list_loh.htm?a=list');
    });

     $('#btn_bill').click(function(){
         i_mdi_open('./list_lbill.htm?a=list');
    });

    $('#d_birth').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_join_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_search').click();
        }
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['atime']);
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(4)').html(m.arr[i]['birth']);
    m.xtr.children(':eq(5)').html(m.arr[i]['nation']);
    m.xtr.children(':eq(6)').html(m.arr[i]['native_place']);
    m.xtr.children(':eq(7)').html(m.arr[i]['degree']);
    m.xtr.children(':eq(8)').html(m.arr[i]['univ']);
    m.xtr.children(':eq(9)').html(m.arr[i]['join_time']);
    m.xtr.children(':eq(10)').html(m.arr[i]['pay_deadtime']);
    m.xtr.children(':eq(11)').html(m.arr[i]['addr']);
    m.xtr.children(':eq(12)').html(m.arr[i]['tel_0']);
    m.xtr.children(':eq(13)').html(m.arr[i]['remark']);
}

function m_search_act_plug(arr) {
    var tmp;
    $('#list_tb tbody td').each(function(i){
        tmp = '';
        if(i%13 == 2){
            tmp = arr['name'];
        } else if(i%13 == 3){
            tmp = arr['sex'];
        } else if(i%13 == 4){
            tmp = arr['birth'];
        } else if(i%13 == 5){
            tmp = arr['univ'];
        } else if(i%13 == 9){
            tmp = arr['join_time'];
        } else if(i%13 == 11){
            tmp = arr['addr'];
        } else if(i%13 == 12){
            tmp = arr['tel_0'];
        }

        if('' != tmp && undefined != tmp){
            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
        }
    });
}