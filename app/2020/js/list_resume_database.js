/**
 * 文件名称：list_resume_database.js
 * 功能描述：企业人才库   的前台程序。
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
                //              i_mdi_open('../../2021/htm/info_resume_look.htm?a=view&x=' + m.arr['r_id']);
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

    $('#btn_reload').click(function(){
        window.location.reload();
    });


}


function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html( '<input class="d_checkbox" name="d_checkbox" type="checkbox" value="' + m.arr[i]['id'] + '"/>');
    m.xtr.children(':eq(1)').html(i + 1);
    m.xtr.children(':eq(2)').html(m.arr[i]['name']);
    m.xtr.children(':eq(3)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(4)').html(m.arr[i]['degree']);
    m.xtr.children(':eq(5)').html(m_arr2show(0, 1, m.arr[i]['big_classification'], array_occupation) + ' ' + m_arr2show(0, 2, m.arr[i]['small_classification'], array_job));
    m.xtr.children(':eq(6)').html(m.arr[i]['addr']);
    m.xtr.children(':eq(7)').html(m.arr[i]['work_term']);
    m.xtr.children(':eq(8)').html(m.arr[i]['i_time']);
}


//function m_list_read_btn_plug() {
//
//}

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