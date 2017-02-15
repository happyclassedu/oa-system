/**
* 文件名称：list_bill.js
* 功能描述：工作日结清单功能的前台程序。
* 代码作者：钱宝伟、王争强（优化）
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

    m.oh = new Array(
                '迁出户籍关系',
                '迁入户籍关系',
                '借出户籍卡',
                '归还户籍卡',
                '办理婚育证明',
                '申领独生子女证明',
//                '申领生育指标',
                '办理准生证',
                '办理计生证明',
                '填写育龄妇女登记表'
            );

    i_tr_css($('#list_bill tbody tr'));
});

function m_load() {
    m_list_bill_read();
    
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {

//    $('#btn_search').click(function(){
////        if (m.date_s > m.date_e) {
////            alert("请检查输入的日期，开始日期 大于 了 结束日期！");
////            return false;
////        }
//        info_test();
//    });
   $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_search').click();
        }
    });

    $('#d_fee_s').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_fee_e').jdate({
        dateFormat: 'yy-mm-dd'
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

    $('#btn_excel').click(function(){
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

//function m_list_read_set_plug() {
//    m.xtr.children(':eq(1)').html(m.arr[i]['time']);
//    m.xtr.children(':eq(2)').html(m.arr[i]['uname']);
//    m.xtr.children(':eq(3)').html(m.arr[i]['yname']);
//    m.xtr.children(':eq(4)').html('<a href="./info_hreg.htm?a=view&x=' + m.arr[i]['pid'] +'">' + m.arr[i]['pname'] + '</a>');
//    m.xtr.children(':eq(5)').html(m.arr[i]['operating_record']);
//}

function m_list_bill_read(){
    $.ajax({
        url : i_act + 'a=info_stat',
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.info  = i_json2js(txt);
            alert(m.info);
            alert(m.info[2]['sum_total']);
            m_list_bill_val();
            i_tr_css($('#list_bill tbody tr'));
//            i_obj_set('d_fee_s', m.info[0]['local_time']);
//            i_obj_set('d_fee_e', m.info[0]['local_time']);
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
// function info_test(){
//     var array = i_json2js(m.val_search);
//     alert(array['fee_s']+ array['fee_e']);
//     $.ajax({
//        url : i_act + 'a=info_stat',
//        data : 'val_search=' + m.val_search,
//        success : function(txt){
//             alert(txt);
//        }
//    });
// }
