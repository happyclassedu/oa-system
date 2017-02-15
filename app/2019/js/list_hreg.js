/**
 * 文件名称：list_hreg.js
 * 功能描述：户籍信息登记列表的前台程序。
 * 代码作者：钱宝伟、王争强
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
        i_mdi_open('./info_hreg.htm?a=view&x=' +  m.arr[m.xid]['id'], m.arr[m.xid]['cname'] + ' | 户籍管理');
    });
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_oh').click(function(){
       i_mdi_open('./list_hoh.htm?a=list');
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
    m.xtr.children(':eq(1)').html(m.arr[i]['cname']);
    m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(3)').html(m.arr[i]['hjid']);
    m.xtr.children(':eq(4)').html(m.arr[i]['univ']);
    m.xtr.children(':eq(5)').html(m.arr[i]['major']);
    m.xtr.children(':eq(6)').html(m.arr[i]['marry']);
    m.xtr.children(':eq(7)').html(m.arr[i]['hjstate']);
}

function m_search_act_plug(arr) {
    var tmp;
    $('#list_tb tbody td').each(function(i){
        tmp = '';
        if(i%8 == 1){
            tmp = arr['cname'];
        } else if(i%8 == 3){
            tmp = arr['hjid'];
        } else if(i%8 == 4){
            tmp = arr['univ'];
        } else if(i%8 == 5){
            tmp = arr['major'];
        } else if(i%8 == 7){
            tmp = arr['hjstate'];
        }

        if('' != tmp && undefined != tmp){
            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
        }
    });
}