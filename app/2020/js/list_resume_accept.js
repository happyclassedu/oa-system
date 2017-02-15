/**
 * 文件名称：list_resume_accept.js
 * 功能描述：应聘简历库的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */
//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }

//    return false;  //可以终止初始化
}

function m_list_num_act_plug() {
    var page_num = Math.ceil(m.info_num/m.show_num); //显示页码
    i_obj_set('d_info_num', m.info_num);
    i_obj_set('d_page_num', page_num);
}

function m_btn_load_plug() {

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

    $('#btn_browse').click(function(){
       var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

       if('' != array){
            $.ajax({
                url : i_act + 'a=info_read&x=' + array[0],
                success : function(txt){
                    m.arr = i_json2js(txt);
                    var rid = m.arr['r_id'];
                    var id = m.arr['id'];
                    m_pv_plug(rid, id);
                }
            });
       } else {
           alert('请选择简历！');
       }
        
      // i_mdi_open('../../2021/htm/info_resume_look.htm?a=view&x=' + array[0]);
    });

     $('#btn_resume_interview').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
            if(confirm('确定要“邀请面试”吗？')){
                $.ajax({
                    url : i_act + 'a=info_interview',
                    data : 'arr='+ i_js2json(array),
                    success : function(txt){
                        if('1' == txt){
                            alert('邀请成功！');
                        } else if('0' == txt){
                            alert('对不起，此简历已经邀请！');
                        }
                    }
                });
            }
        } else {
            alert('请选择简历！');
        } 
    });

    $('#btn_resume_fav').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
           if(confirm('确定要“收藏简历”吗？')){
             $.ajax({
                    url : i_act + 'a=info_fav',
                    data : 'arr='+ i_js2json(array),
                    success : function(txt){
                        if('1' == txt){
                            alert('收藏成功！');
                        } else if('0' == txt){
                            alert('对不起，此简历已经收藏！');
                        }
                    }
                });
            }
        } else {
            alert('请选择简历！');
        }
    });

    $('#btn_resume_database').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
           if(confirm('确定要“入人才库”吗？')){
                $.ajax({
                    url : i_act + 'a=info_database',
                    data : 'arr='+ i_js2json(array),
                    success : function(txt){
                        if('1' == txt){
                            alert('入库成功！');
                        } else if('0' == txt){
                            alert('对不起，此简历已经入库！');
                        }
                    }
                });
            }
        } else {
            alert('请选择简历！');
        }    
    });

    $('#btn_resume_recycle').click(function(){
         var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
            if(confirm('确定要“到回收站”吗？')){
                $.ajax({
                    url : i_act + 'a=info_recycle',
                    data : 'arr='+ i_js2json(array),
                    success : function(txt){
                        if('1' == txt){
                            m_list_num();
                        } else if('0' == txt){
                            alert('对不起，此简历已到回收站！');
                        }
                    }
                });
            }
        } else {
            alert('请选择简历！');
        } 
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html( '<input class="d_checkbox" name="d_checkbox" type="checkbox" value="' + m.arr[i]['id'] + '"/>');
    m.xtr.children(':eq(1)').html(i + 1);
    if('' == m.arr[i]['i_state']){
        m.xtr.children(':eq(2)').html('<IMG height=12 src="../img/Icon4_UnRead.gif" width=14 align=absMiddle>');
    } else {
        m.xtr.children(':eq(2)').html('<IMG height=12 src="../img/Icon4_Read.gif"  width=14 align=absMiddle>');
    }
    m.xtr.children(':eq(3)').html(m.arr[i]['name']);
    m.xtr.children(':eq(4)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(5)').html(m.arr[i]['degree']);
    m.xtr.children(':eq(6)').html(m.arr[i]['j_name']);
    m.xtr.children(':eq(7)').html(m.arr[i]['r_name']);
    m.xtr.children(':eq(8)').html(m.arr[i]['l_name']);
    m.xtr.children(':eq(9)').html(m.arr[i]['i_time']);
}

function m_pv_plug(rid,id){
     $.ajax({
        url : i_act + 'a=info_pv&rid=' + rid + '&id=' + id,
        success : function(txt){
            if('1' == txt){
                i_mdi_open('../htm/info_resume_look.htm?a=view&x=' + rid, '浏览简历', 1);
            }
        }
    });
}

function m_list_read_btn_plug() {

    $('.btn_view_resume').click(function(){
         m.xid = this.parentNode.parentNode.id;
         var rid = m.arr[m.xid]['r_id'];
         var id = m.arr[m.xid]['id'];
         m_pv_plug(rid, id);
//         i_mdi_open('../../2021/htm/info_resume_look.htm?a=view&x=' + rid);
    });
//
//   $('.btn_app_jobs').click(function(){
//        var array = new Array();
//        m.xid = this.parentNode.parentNode.id;
//        array['0'] = m.arr[m.xid]['j_id'];
//        i_mdi_open('./list_job_eavoritd.htm?a=add&p_id=' + pid + '&arr=' + i_js2json(array));
//    });

//    $('.btn_del_r').click(function(){
//        m.tmp = '';
//        m.xid = this.parentNode.parentNode.id;
//        m.tmp = m.arr[m.xid]['rname'];
//        m.xid = m.arr[m.xid]['id'];
//        m_info_del_r();
//    });
}