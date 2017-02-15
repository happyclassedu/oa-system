/**
 * 文件名称：list_job.js
 * 功能描述：职位列表的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */
var cid = '';

//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    
//    m_get_session();
//    alert($.cookie('c_id'));
    m.list_act_get = 'cid=' + $.cookie('c_id');
    
//    m.list_skin = 'diy_zpw'; //皮肤
//    return false;  //可以终止初始化
}

//function m_get_session(){
//    $.ajax({
//        url : g.act + 'index_com.php?a=info_session',
//        success : function(txt){
//            $.cookie('cid', txt);
//        }
//    });
//}

function m_list_num_act_plug() {
    var page_num = Math.ceil(m.info_num/m.show_num); //显示页码
    i_obj_set('d_info_num', m.info_num);
    i_obj_set('d_page_num', page_num);
}

function m_btn_load_plug() {

    $('#a_info_job').click(function(){
        $('#a_info_job').attr('href', './info_job.htm?a=add');
    });
    
    $('#a_list_job').click(function(){
        $('#a_list_job').attr('href', './list_job.htm?a=list');
    });
    
    $('#d_checkbox_all').click(function(){
        if ($(this).attr("checked") == true) { // 全选
            $("#list_tb :checkbox").each(function() {
                $(this).attr("checked", true);
            });
        } else { // 取消全选
            $("#list_tb :checkbox").each(function() {
                $(this).attr("checked", false);
            });
        }
    });

    $('#btn_refresh_job').click(function(){
        m_list_batch_manage('info_refresh', '确定要“刷新职位”吗？','请选择刷新的职位！');
    });

    $('#btn_publish_job').click(function(){
        m_list_batch_manage('info_release', '确定要“重新发布”吗？', '请选择重新发布的职位！');
    });

    $('#btn_open_job').click(function(){
        m_list_batch_manage('info_open', '确定要“激活职位”吗？', '请选择激活的职位！');
    });

    $('#btn_close_job').click(function(){
        m_list_batch_manage('info_close', '确定要“屏蔽职位”吗？', '请选择屏蔽的职位！');
    });

    $('#btn_delete_job').click(function(){
        m_list_batch_manage('info_delete', '确定要“批量删除”吗？', '请选择删除的职位！');
    });

    
}
function m_list_batch_manage(act,conf_msg, msg) {
    var array = new Array();
    $(".d_checkbox:checked").each(function(i) {
        array[i] = $(this).val();
    });
    //        $('#error_test').html(); //报错测试
    if('' != array){
        if(confirm(conf_msg)){
            $.ajax({
                url : i_act + 'a=' + act,
                data : 'arr='+ i_js2json(array),
                success : function(txt){
                    if('1' == txt){
                        m_list_num();
                    }
                }
            });
        }
    } else{
        alert(msg);
    }

}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html( '<input class="d_checkbox" name="d_checkbox" type="checkbox" value="' + m.arr[i]['id'] + '"/>');
    m.xtr.children(':eq(1)').html(i + 1);
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['zwstate']);
    m.xtr.children(':eq(4)').html(m.arr[i]['atime']);
    m.xtr.children(':eq(5)').html(m.arr[i]['begin'] + '至' + m.arr[i]['end']);
    m.xtr.children(':eq(6)').html(m.arr[i]['browse_num']);
    m.xtr.children(':eq(7)').html(m.arr[i]['apply_num']);
}

