/**
 * 文件名称：list_job_applist.js
 * 功能描述：申请记录的前台程序。
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
    m.tmp = m_ssession_verify('person');
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

    $('#a_job_invite').click(function(){
       $('#a_job_invite').attr('href', './list_job_invite.htm?a=list&p_id=' + pid);
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html(i + 1);
    m.xtr.children(':eq(1)').html(m.arr[i]['j_name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['c_name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['i_time']);
    m.xtr.children(':eq(4)').html(m.arr[i]['begin'] + '至' + m.arr[i]['end']);
}

function m_list_read_btn_plug() {

    $('.btn_veiw_jobs').click(function(){
         m.xid = this.parentNode.parentNode.id;
         jid = m.arr[m.xid]['j_id'];
         cid = m.arr[m.xid]['c_id'];
         m_pv_plug(jid, cid);
    });

   $('.btn_app_jobs').click(function(){
        var array = new Array();
        m.xid = this.parentNode.parentNode.id;
        array['0'] = m.arr[m.xid]['j_id'];
        i_mdi_open('./info_job_eavoritd.htm?a=add&p_id=' + pid + '&arr=' + i_js2json(array), '申请职位', 1);
    });

//    $('.btn_del_r').click(function(){
//        m.tmp = '';
//        m.xid = this.parentNode.parentNode.id;
//        m.tmp = m.arr[m.xid]['rname'];
//        m.xid = m.arr[m.xid]['id'];
//        m_info_del_r();
//    });
}

//function m_info_del_r() {
//    if (confirm('确定要删除“' + m.tmp + '”吗？')) {
//        $.ajax({
//            url : i_act + 'a=info_del&x=' + m.xid ,
//            success : function(text){
//                if(text > 0)
//                {
//                     window.location.reload();
//                } else {
//                     alert('删除' + m.tmp + '失败！');
//                }
//            }
//        });
//    }
//}

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