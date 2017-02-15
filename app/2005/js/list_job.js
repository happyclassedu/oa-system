/**
 * 文件名称：list_job.js
 * 功能描述：招聘会职位列表的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-09-10
 * 修改日期：2010-09-10
 * 当前版本：V1.0
 */

var fid = '';
var arr_type = new Array();
arr_type['0'] = '酒店、物管、商超、房产、装饰、服务类';
arr_type['1'] = 'IT通讯、机械电子、文职营销、行政财务类';
arr_type['2'] = '综合类招聘会';
arr_type['3'] = '逢六招聘会';

//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    fid = i_get('fid');
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {

//     $('#btn_search').click(function(){
//          m_list_test();
//     });


}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html(i + 1);
    m.xtr.children(':eq(1)').html(m.arr[i]['phase_name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['date_s']);
    m.xtr.children(':eq(3)').html(arr_type[m.arr[i]['phase_type']]);
    m.xtr.children(':eq(4)').html(m.arr[i]['com_name']);
    m.xtr.children(':eq(5)').html(m.arr[i]['job_a']);
    m.xtr.children(':eq(6)').html(m.arr[i]['job_b']);
    m.xtr.children(':eq(7)').html(m.arr[i]['job_c']);
}

function m_list_read_btn_plug() {

    $('.btn_view_job').click(function(){
        m.tmp = '';
        m.tmp = this.parentNode.parentNode.id;
        m.xid = m.arr[m.tmp]['id'];
        i_mdi_open('./recruit_info.htm?a=add&fid=' + fid +'&x=' + m.xid);
    });
    
}


function m_search_act_plug(arr) {
    var tmp;
    $('#list_tb tbody td').each(function(i){
        tmp = '';
        if(i%8 == 1){
            tmp = arr['val_search'];
        } else if(i%8 == 3){
            tmp = arr['val_search'];
        } else if(i%8 == 4){
            tmp = arr['val_search'];
        } else if(i%8 == 5){
            tmp = arr['val_search'];
        } else if(i%8 == 6){
            tmp = arr['val_search'];
        } else if(i%8 == 7){
            tmp = arr['val_search'];
        }

        if('' != tmp && undefined != tmp){
            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
        }
    });
    return false;
}

//function m_list_test(){
//     $.ajax({
//        url : i_act + 'a=info_test',
//        data : 'val_search=' + m.val_search,
//        success : function(txt){
//            alert(txt);
//        }
//    });
//}