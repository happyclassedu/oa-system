/**
* 文件名称：list_lbill.js
* 功能描述：工作日结清单功能的前台程序。
* 代码作者：王争强（优化）
* 创建日期：2010-07-13
* 修改日期：2010-07-13
* 当前版本：V1.0
*/


$(document).ready(function(){

    m.ytr = $('#list_bill tbody tr:eq(0)').clone(true);
    m.yname_id = '';  //业务id
    m.uid_1 = '';  //管理员1
    m.uid_2 = '';  //管理员2
    m.info = '';
    m.td_act = '';
    
    m.oh = new Array(
      '转入团关系',
      '转出团关系',
      '缴纳团费',
      '团员身份证明'
  );

    i_tr_css($('#list_bill tbody tr'));
});

function m_load() {
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
         m.tmp = m.arr[m.xid]['bid'];
         i_mdi_open('./info_league.htm?a=view&x=' + m.tmp);
    });

    m.ytr.children(':eq(1)').dblclick(function(){
        m.td_act = 'e1';
        m.yname_id = this.parentNode.id;
        $('#btn_search').click();
    });

    m.ytr.children(':eq(2)').dblclick(function(){
        m.td_act = 'e2';
        m.yname_id  = this.parentNode.id;
        m.uid_0 = m.info[m.yname_id]['uid_0'];
        $('#btn_search').click();

    });

    m.ytr.children(':eq(3)').dblclick(function(){
        m.td_act = 'e3';
        m.yname_id  = this.parentNode.id;
        m.uid_1 = m.info[m.yname_id]['uid_1'];
        $('#btn_search').click();
    });

    m.ytr.children(':eq(4)').dblclick(function(){
        m.td_act = 'e4';
        m.yname_id  = this.parentNode.id;
        m.uid_0 = m.info[m.yname_id]['uid_0'];
        m.uid_1 = m.info[m.yname_id]['uid_1'];
        $('#btn_search').click();
    });

     m.ytr.children(':eq(5)').dblclick(function(){
        m.td_act = 'e5';
        m.yname_id  = this.parentNode.id;
        m.uid_0 = m.info[m.yname_id]['uid_0'];
        m.uid_1 = m.info[m.yname_id]['uid_1'];
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

    $(document).keydown(function(){
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
        m.val_search['uid_0'] = m.uid_0;
    }else if('e3' == m.td_act){
        m.val_search['td_act'] = 'e3';
        m.val_search['yname_id'] = m.yname_id;
        m.val_search['uid_1'] = m.uid_1;
    }else if('e4' == m.td_act){
        m.val_search['td_act'] = 'e4';
        m.val_search['yname_id'] = m.yname_id;
        m.val_search['uid_0'] = m.uid_0;
        m.val_search['uid_1'] = m.uid_1;
    }else if('e5' == m.td_act){
        m.val_search['td_act'] = 'e5';
        m.val_search['yname_id'] = m.yname_id;
        m.val_search['uid_0'] = m.uid_0;
        m.val_search['uid_1'] = m.uid_1;
    }else if('e6' == m.td_act){
        m.val_search['td_act'] = 'e6';
        m.val_search['yname_id'] = m.yname_id;
    }
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['time']);
    m.xtr.children(':eq(2)').html(m.arr[i]['uname']);
    m.xtr.children(':eq(3)').html(m.arr[i]['name']);
    m.xtr.children(':eq(4)').html(m.arr[i]['bname']);
    m.xtr.children(':eq(5)').html(m.arr[i]['intro']);
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
        m.ytr.children(':eq(2)').html(m.info[i]['uname_0']);
        m.ytr.children(':eq(3)').html(m.info[i]['uname_1']);
        m.ytr.children(':eq(4)').html(m.info[i]['sub_total']);
        m.ytr.children(':eq(5)').html(m.info[i]['other_total']);
        m.ytr.children(':eq(6)').html(m.info[i]['sum_total']);
        $('#list_bill tbody').append(m.ytr.clone(true));
    }
}


