/**
 * 文件名称：list_treat.js
 * 功能描述：待遇记录信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    //给td添加事件
        m.xtr.children(':eq(1)').dblclick(function(){
        m.xid  = this.parentNode.id;
//        i_mdi_open('./info_czyl.htm?a=view&x=' +  m.arr[m.xid]['id'], m.arr[m.xid]['name'] + ' | 参保信息管理');
    });
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
}

//

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m_get_ins_name(m.arr[i]['i_type']));
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(2)').attr('title', m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(4)').html(m.arr[i]['ins_code']);
    m.xtr.children(':eq(5)').html(m.arr[i]['idcard']);
    m.xtr.children(':eq(6)').html(m.arr[i]['base_fee'] + '元/年');
    m.xtr.children(':eq(7)').html(m.arr[i]['increase_fee']);
    m.xtr.children(':eq(8)').html(m.arr[i]['send_fee']);
    m.xtr.children(':eq(9)').html(m.arr[i]['i_state1']);
    m.xtr.children(':eq(10)').html(m.arr[i]['remark']);
    m.xtr.children(':eq(11)').html(m.arr[i]['atime']);
}

function m_search_act_plug(arr) {
    var tmp;
    $('#list_tb tbody td').each(function(i){
        tmp = '';
        if(i%12 == 2){
            tmp = arr['name'];
        } else if(i%12 == 4){
            tmp = arr['ins_code'];
        } else if(i%12 == 5){
            tmp = arr['idcard'];
        }

        if('' != tmp && undefined != tmp){
            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
        }
    });
}


function m_get_ins_name(i_type){
    if('3' == i_type){
        return '待遇发放确认';
    } else if('4' == i_type) {
        return '待遇发放';
    } else if('5' == i_type) {
        return '待遇停发';
    } else if('6' == i_type) {
        return '待遇续发';
    }
}