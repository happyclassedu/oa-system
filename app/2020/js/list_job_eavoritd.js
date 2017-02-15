/**
* 文件名称：list_job_eavoritd.js
* 功能描述：申请职位的前台程序。
* 代码作者：王争强
* 创建日期：2010-07-29
* 修改日期：2010-07-29
* 当前版本：V1.0
*/

var jid = '';
var cid = '';
var arr = '';
var str_atr = '';
//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
//    arr = i_json2js(i_get('arr'));

    m.xtr = $('#list_job tbody tr:eq(0)').clone(true);
    m_list_job();

    m.atr = $('#list_resume tbody tr:eq(0)').clone(true);
    m_list_resume();
    
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_checkbox_all').click(function(){
        if ($(this).attr('checked') == true) { // 全选
            $('#list_job :checkbox').each(function() {
                $(this).attr('checked', true);
            });
        } else { // 取消全选
            $('#list_job :checkbox').each(function() {
                $(this).attr('checked', false);
            });
        }
    });

    $('#d_checbox_letter').click(function(){
        if ($(this).attr('checked') == true) { //可用
            i_obj_enable('d_sel_letter');
            i_obj_enable('d_intor');
            m_list_sel_letter();
        } else { // 禁用
            i_obj_disable('d_sel_letter');
            i_obj_disable('d_intor');
        }
    });

    $('#btn_app_job').click(function(){
        
        var r_id = $('#list_resume input[name="d_radio"]:checked').val();
        var l_id = i_obj_val('d_l_id');
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });
        //        alert('r_id:' + r_id + ';p_id:' + p_id + ';l_id:' + l_id + ';array:' + array);
        $.ajax({
            url : i_act + 'a=info_eavoritd&r_id=' + r_id + '&l_id=' + l_id,
            data: 'arr=' + i_js2json(array),
            success : function(txt){
                switch (txt){
                    case '1':
                        alert('申请成功！');
                        break;
                    case '2':
                        alert('24小时之外，修改申请信息！');
                        break;
                    case '3':
                        alert('24小时之内，不能继续申请同一职位，请稍后！');
                         break;
                    case '0':
                        alert('申请出错！');
                        break;
                }
            }
        });

    });

   
}

//function m_info_set_plug() {
//
//}

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

//function m_act_url_plug() {
//    window.location.reload();
//    return false;  //可以终止跳转
//}

//function m_info_save_plug() {
//    return true;
//}

//function m_error_init(){
//
//}

function m_list_job(){
     $.ajax({
        url : i_act + 'a=list_read_arr&arr=' + i_get('arr'),
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_job_val();
//            m_list_job_btn();
        }
    });
}

function m_list_job_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html( '<input class="d_checkbox" name="d_checkbox" type="checkbox" value="' + m.arr[i]['id'] + '" />');
        m.xtr.children(':eq(1)').html(i + 1);
        m.xtr.children(':eq(2)').html(m.arr[i]['name']);
        m.xtr.children(':eq(3)').html(m.arr[i]['fname']);
        m.xtr.children(':eq(4)').html(m_arr2show(0, 1, m.arr[i]['addr1'], array_province) + ' ' + m_arr2show(0, 2, m.arr[i]['addr2'], array_city));
        m.xtr.children(':eq(5)').html('<a href="../htm/info_job_look.htm?a=view&x=' + m.arr[i]['id'] + '&cid=' + m.arr[i]['cid'] + '" class="uline">预览</a>');
        m.tmp += m.xtr.parents().html();
    }
    $('#list_job tbody').html(m.tmp);
}

function m_list_resume(){
     $.ajax({
        url : i_act + 'a=list_read_resume',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_resume_val();
//            m_list_resume_btn();
        }
    });
}

function m_list_resume_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.atr.attr('id', i);
        if(m.arr[i]['resume_def_state'] == '1'){ str_atr = ' checked="checked" ';}
        m.atr.children(':eq(0)').html( '<input class="d_radio" name="d_radio" type="radio" value="' + m.arr[i]['id'] + '" ' + str_atr + ' />');
        m.atr.children(':eq(1)').html(i + 1);
        m.atr.children(':eq(2)').html(m.arr[i]['rname']);
        if('cn' == m.arr[i]['rgift']){
            m.atr.children(':eq(3)').html('中文');
        } else if('en' == m.arr[i]['rgift']){
            m.atr.children(':eq(3)').html('英文');
        } else {
           m.atr.children(':eq(3)').html('');
        }
        m.atr.children(':eq(4)').html('<a href="../htm/info_resume_look.htm?a=view&x=' + m.arr[i]['id'] + '" class="uline">预览</a>');
        m.tmp += m.atr.parents().html();
    }
    $('#list_resume tbody').html(m.tmp);
}

function m_list_sel_letter(){
    $.ajax({
        url : i_act + 'a=list_read_letter' + '&type=letter',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
//            alert(m.arr[0]['name']);
            m_list_sel_letter_val();
        }
    });
}

function m_list_sel_letter_val(){
    $('#d_sel_letter').html('');  //清空tbody里面的内容
    var option_txt = '';
    option_txt += '<option value="" selected="selected">请选择</option>';
    for(var i=0 ; i<m.arr.length; i++) {
        option_txt += '<option value="'+ m.arr[i]['id'] + 'i_s_v' + m.arr[i]['intor'] +'">'+ m.arr[i]['name'] + '</option>';
    }
    $('#d_sel_letter').append(option_txt);

    $('#d_sel_letter').change( function() {
          var letter_val  = i_obj_val('d_sel_letter');
          letter_val = letter_val.split('i_s_v');
          i_obj_set('d_l_id', letter_val[0]);
          i_obj_set('d_intor', letter_val[1]);
    });
}
