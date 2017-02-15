/**
 * 文件名称：list_party_bill.js
 * 功能描述：党员票据管理的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */
//m.arr = '';

//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    m.src_iframe = '';
    i_obj_hide('iframe');

//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_list_party_blog').click(function(){
       i_mdi_open('./list_party_blog.htm?a=list');
    });

    $('#btn_info_party_blog').click(function(){
//       i_mdi_open('./info_party_blog.htm?a=add');
       m.tmp = './info_party_blog.htm?a=add';
       m_load_iframe_acturl();
    });

    $('#btn_list_party_ulog').click(function(){
        i_mdi_open('./list_party_ulog.htm?a=list');
    });

    $('#btn_info_party_ulog').click(function(){
//        i_mdi_open('./info_party_ulog.htm?a=add');
       m.tmp = './info_party_ulog.htm?a=add';
       m_load_iframe_acturl();
    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_search').click();
        }
    });
}

//function m_list_read_set_plug() {
//    m.xtr.children(':eq(1)').html(m.arr[i]['name']);
//    m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
//}

//function m_search_act_plug(arr) {
//    var tmp;
//    $('#list_tb tbody td').each(function(i){
//        tmp = '';
//        if(i%15 == 1){
//            tmp = arr['name'];
//        }
//
//        if('' != tmp && undefined != tmp){
//            this.innerHTML  = this.innerHTML.replace(new RegExp(tmp, "gm"), '<B class="val_search">' + tmp + '</B>');
//        }
//    });
//}

function m_load_iframe_acturl(){
    if (m.src_iframe == m.tmp) {
        $('#iframe').toggle();
    } else {
        m.src_iframe = m.tmp;
        i_obj_show('iframe');
        $("#iframe").attr("src",m.tmp);
        //iframe高度随内容自动调整
        $('#iframe').load(function(){
            $(this).height($(this).contents().find("body").attr('scrollHeight'));
        });
    }
}