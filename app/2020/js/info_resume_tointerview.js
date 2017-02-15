/**
 * 文件名称：info_resume_tointerview.js
 * 功能描述：邀请面试功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */
var arr = '';

//$(document).ready(function(){
//
//    });

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    arr = i_get('arr');
    m_com_resume();
    m_info_job_getid();
    
//    arr = i_json2js(arr);
//    alert(arr);
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#btn_send').click(function(){
       m_get_val_plug();
    });
}

function m_info_set_plug() {

}

//function m_info_add_plug() {
//
//}


//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

//function m_info_save_plug() {
//    return true;
//}

function m_com_resume(){
    $.ajax({
        url : i_act + 'a=info_resume',
        data: 'arr=' + arr,
        success : function(txt){
            m.info = i_json2js(txt);
            arr = i_json2js(arr);
            var s = '<table  border="0" style="width:100%;"><tbody>';
            for(var i=0 ; i<arr.length; i++) {
//                    alert(arr[i]);
                    if((i % 5) == 0){s += '<tr>';}
                     s+= '<td><input class="d_checkbox" type="checkbox"  checked="checked" value="' + arr[i] + '" />' + m.info[arr[i]] +'</td>';
                     if(((i+1) % 5) == 0){s += '</tr>';}
            }
               s += '</tbody></table>';
               i_obj_set('d_list_resume', s);
        }
    });
}


function m_info_job_getid(){
       $.ajax({
        url : g.act + 'list_job.php?a=list_read&cid=' + $.cookie('c_id'),
        success : function(txt){
            m.arr = i_json2js(txt);
            m_info_job_plug();
        }
    });
}
function m_info_job_plug(){
    $('#d_j_id').html('');  //清空tbody里面的内容
    var option_txt = '';
    option_txt += '<option value="" selected="selected">请选择</option>';
    for(var i=0 ; i<m.arr.length; i++) {
        option_txt += '<option value="'+ m.arr[i]['id'] +'">'+ m.arr[i]['name'] + '</option>';
    }
    $('#d_j_id').append(option_txt);

     $('#d_j_id').change( function() {

        m.tmp  = $('#d_j_id').val();
        $.ajax({
            url : g.act + 'info_job.php?a=info_read&x=' + m.tmp,
            success : function(txt){
                m.arr = i_json2js(txt);
                i_obj_set('d_i_time', m.arr['testtime']);
                i_obj_set('d_i_txt3', m.arr['tel']);
                i_obj_set('d_i_txt0', m.arr['testaddr']);
                var s = '{求职者}，您好！我公司在莲湖人才招聘管理系统PHP1.0地区版(www.lianhu.com)</br>搜索到您的简历，发现您适合我公司正在招聘的{面试职位}</br>，现邀请您参加面试，以下是面试信息：</br>面试职位：{面试职位}</br>面试时间：{面试时间}</br>联 系 人：{联系人}</br>联系电话：{联系电话}</br>面试地点：{面试地点}</br>{单位}</br>{发布日期}';
                i_obj_set('d_i_txt4', s);
            }
        });
        
    //         var checkText=$('#d_big_classification').find("option:selected").text();
    });
}

function m_get_val_plug(){
    var arr_rid = new Array();
    $(".d_checkbox:checked").each(function(i) {
        arr_rid[i] = $(this).val();
    });

    var i_txt4 = ''
    if($('#chk_email').attr("checked"))
    {
        i_txt4 = i_obj_val('d_i_txt4');
    }
    else
    {
        i_txt4 = '';
    }

    var array = new Object();
    array['arr_rid'] =  arr_rid;
    array['j_id'] =  i_obj_val('d_j_id');
    array['i_time'] =  i_obj_val('d_i_time');
    array['i_txt3'] =  i_obj_val('d_i_txt3');
    array['i_txt0'] =  i_obj_val('d_i_txt0');
    array['i_txt4'] =  i_txt4;
    
    $.ajax({
        url : i_act + 'a=info_interview',
        data: 'arr=' + i_js2json(array),
        success : function(txt){
            if('1' == txt){
                alert('邀请成功！');
            } else if('0' == txt){
                alert('对不起，此简历已经邀请！');
            }
//              alert(txt);
        }
    });
    
}