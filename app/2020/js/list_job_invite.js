/**
 * 文件名称：list_job_invite.js
 * 功能描述：面试通知的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('最先执行');
//});
var pid = '';

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    pid= i_get('p_id');
//    return false;  //可以终止初始化
}

function m_list_num_act_plug() {
    var page_num = Math.ceil(m.info_num/m.show_num); //显示页码
    i_obj_set('d_info_num', m.info_num);
    i_obj_set('d_page_num', page_num);
}

function m_btn_load_plug() {
     $('#a_job_list').click(function(){
       $('#a_job_list').attr('href', './list_job.htm?a=list&p_id=' + pid);
    });

    $('#a_job_favorite').click(function(){
       $('#a_job_favorite').attr('href', './list_job_fav.htm?a=list&p_id=' + pid);
    });

     $('#a_job_applist').click(function(){
       $('#a_job_applist').attr('href', './list_job_applist.htm?a=list&p_id=' + pid);
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

    $('#btn_veiw_job').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            //            array[i] = $(this).val();
            m.xid = this.parentNode.parentNode.id;
            array[i] = m.arr[m.xid];
        });

        if('' != array){
            var id = array[0]['id'];
            var jid = array[0]['j_id'];
            var cid = array[0]['c_id'];
            //        alert(id+'-----'+jid+'--------'+cid);
            m_pv_plug(jid, cid, id);
        } else{
            alert('请选择需要浏览的职位！');
        }     
    });

    $('#btn_del_job').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            m.xid = this.parentNode.parentNode.id;
            array[i] = m.arr[m.xid]['id'];
        });

        if('' != array){
            if (confirm('确定要批量删除吗？')) {
                $.ajax({
                    url : i_act + 'a=info_del_batch' ,
                    data: 'arr=' + i_js2json(array),
                    success : function(txt){
                        if(1 == txt)
                        {
                            window.location.reload();
                        } else {
                            alert('请选择后，再批量删除！');
                        }
                    }
                });
            }
        } else {
            alert('请选择需要删除的职位！');
        }
    });
}


function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html( '<input class="d_checkbox" name="d_checkbox" type="checkbox" value="' + m.arr[i]['j_id'] + '"/>');
    m.xtr.children(':eq(1)').html(i + 1);
    if('' == m.arr[i]['i_state'] || '0' == m.arr[i]['i_state']){
        m.xtr.children(':eq(2)').html('<IMG height=12 src="../img/Icon4_UnRead.gif" width=14 align=absMiddle>');
    } else {
        m.xtr.children(':eq(2)').html('<IMG height=12 src="../img/Icon4_Read.gif" width=14 align=absMiddle>');
    }
    m.xtr.children(':eq(3)').html(m.arr[i]['j_name']);
    m.xtr.children(':eq(4)').html(m.arr[i]['c_name']);
    m.xtr.children(':eq(5)').html(m.arr[i]['i_time']);
    m.xtr.children(':eq(6)').html(m.arr[i]['i_txt0']);
    m.xtr.children(':eq(7)').html(m.arr[i]['atime']);
}

function m_list_read_btn_plug() {

    $('.btn_veiw_jobs').click(function(){
        m.xid = this.parentNode.parentNode.id;
        var id = m.arr[m.xid]['id'];
        var jid = m.arr[m.xid]['j_id'];
        var cid = m.arr[m.xid]['c_id'];
        m_pv_plug(jid, cid, id);
//         m.xid = m.arr[m.xid]['j_id'];
//         i_mdi_open('./info_job_look.htm?a=view&x=' + m.xid);
    });

    $('.btn_del_jobs').click(function(){
        m.tmp = '';
        m.xid = this.parentNode.parentNode.id;
        m.tmp = m.arr[m.xid]['j_name'];
        m.xid = m.arr[m.xid]['id'];
        m_info_del_jobs();
    });
}

function m_info_del_jobs() {
    if (confirm('确定要删除“' + m.tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + m.xid ,
            success : function(txt){
                if(txt > 0)
                {
                     window.location.reload();
                } else {
                     alert('删除' + m.tmp + '失败！');
                }
            }
        });
    }
}

function m_pv_plug(jid, cid, id){
     $.ajax({
        url : i_act + 'a=info_pv&jid=' + jid + '&id=' + id,
        success : function(txt){
            if(txt == '1'){
                //查看职位
                i_mdi_open('./info_job_look.htm?a=view&x=' + jid + '&cid=' + cid, '浏览职位', 1);
            }
        }
    });
}