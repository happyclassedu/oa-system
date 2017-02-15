/**
* 文件名称：list_person_job.js
* 功能描述：职位列表的前台程序。
* 代码作者：王争强
* 创建日期：2010-07-29
* 修改日期：2010-07-29
* 当前版本：V1.0
*/
var pid = '';
var jid= '';
var cid= '';
//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }

    pid = i_get('p_id');
//    i_read_js('functiion');
//    return false;  //可以终止初始化
}

function m_list_num_act_plug() {
    var page_num = Math.ceil(m.info_num/m.show_num); //显示页码
    i_obj_set('d_info_num', m.info_num);
    i_obj_set('d_page_num', page_num);
}

function m_btn_load_plug() {

     $('#a_job_favorite').click(function(){
       $('#a_job_favorite').attr('href', './list_job_fav.htm?a=list&p_id=' + pid);
    });

     $('#a_job_applist').click(function(){
       $('#a_job_applist').attr('href', './list_job_applist.htm?a=list&p_id=' + pid);
    });

     $('#a_job_invite').click(function(){
       $('#a_job_invite').attr('href', './list_job_invite.htm?a=list&p_id=' + pid);
    });

    $('#d_checkbox_all').click(function(){
        if ($(this).attr("checked") == true) { // 全选
            $(":input[@name='d_checkbox']").each(function() {
                $(this).attr("checked", true);
            });
        } else { // 取消全选
            $(":input[@name='d_checkbox']").each(function() {
                $(this).attr("checked", false);
            });
        }
    });

    $('#btn_app_job').click(function(){
         var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
            if(confirm('确定要“申请职位”吗？')){
                m_list_batch_manage_app();
            }
        } else {
            alert('请您先选择需要申请的职位！');
        }
        
    });

    $('#btn_favorite_job').click(function(){
         var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });
        
        if('' != array){
            if(confirm('确定要“收藏职位”吗？')){
                m_list_batch_manage_fav('info_favorite');
            }
        } else {
            alert('请您先选择需要收藏的职位！');
        }
        
    });

    $('#btn_veiw_job').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
            $.ajax({
                url : i_act + 'a=info_read&x=' + array[0],
                success : function(txt){
                    m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
                    jid = m.arr['id'];
                    cid = m.arr['cid'];
                    m_pv_plug(jid, cid);
                //               i_mdi_open('./info_job_look.htm?a=view&x=' + jid + '&cid=' + cid);
                }
            });
        } else {
            alert('请选择需要浏览的职位！');
        }
             
    });
}

function m_list_batch_manage_fav(act) {
    //        $('#error_test').html(); //报错测试
    $.ajax({
        url : i_act + 'a=' + act + '&p_id=' + pid,
        data : 'arr='+ i_js2json(array),
        success : function(txt){
            if('1' == txt){
                alert('收藏成功');
            } else if('0' == txt){
                alert('对不起，职位已经收藏');
            }
        }
    });
}

function m_list_batch_manage_app() {
    //        $('#error_test').html(); //报错测试
    i_mdi_open('./info_job_eavoritd.htm?a=add&p_id=' + pid + '&arr=' + i_js2json(array));
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html( '<input class="d_checkbox" name="d_checkbox" type="checkbox" value="' + m.arr[i]['id'] + '"/>');
    m.xtr.children(':eq(1)').html(i + 1);
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['fname']);
    m.xtr.children(':eq(4)').html(m.arr[i]['address']);
    m.xtr.children(':eq(5)').html(m.arr[i]['pay'] + m.arr[i]['pay_type']);
    m.xtr.children(':eq(6)').html(m.arr[i]['job_day']);

}

function m_list_read_btn_plug() {

    $('.btn_veiw_jobs').click(function(){
         m.xid = this.parentNode.parentNode.id;
         jid = m.arr[m.xid]['id'];
         cid = m.arr[m.xid]['cid'];
         m_pv_plug(jid, cid);
//         i_mdi_open('./info_job_look.htm?a=view&x=' + jid + '&cid=' + cid);
    });

}

function m_pv_plug(jid, cid){
     $.ajax({
        url : i_act + 'a=info_pv&jid=' + jid,
        success : function(txt){
            if(txt == '1'){
                //查看职位
                i_mdi_open('./info_job_look.htm?a=view&x=' + jid + '&cid=' + cid, '浏览职位', 1);
            }
        }
    });
}

