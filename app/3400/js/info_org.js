/**
 * 文件名称：info_org.js
 * 功能描述：组织机构管理增加,修改，查看功能的前台程序。
 * 代码作者：钱宝伟（创建），王争强（优化），孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.arr_org = {};
    m.org_type = '';
    m.check = '0';
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#d_type').change(function(){
        m_list_read_org();
    });
}

//function m_info_set_plug() {
//}

function m_info_add_plug() {
    m_list_read_org();
    i_obj_hide('d_f_name');
    i_obj_show('d_f_id');
}

function m_info_edit_plug() {
    m_list_read_org();
    i_obj_hide('d_f_name');
    i_obj_show('d_f_id');
}

function m_info_view_plug() {
    i_obj_hide('d_f_id');
    i_obj_show('d_f_name');
}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_f_id')) {
        alert('对不起，请选择上级机构！');
        $('#d_f_id').focus();
        return false;
    }

    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入机构名称！');
        $('#d_name').focus();
        return false;
    }
    return true;
}

function m_list_read_org() {
    m.org_type = i_obj_val('d_type');
    if ('' === m.org_type || '0' === m.org_type) {
        return;
    }

    if (m.arr_org[m.org_type]) {
        m_org_set();
        return;
    }
    
    $.ajax({
        url : i_act + 'a=list_read4info&x=' + m.org_type,
        success : function(txt){
            m.arr_org[m.org_type] = i_json2js(txt);
            m_org_set();
        }
    });
}

function m_org_set(){    
    m.tmp = '';
    m.tmp += '<option value="" selected="selected">请选择……</option>';
    m.tmp += '<option value="0">无上级</option>';

    if (!m.arr_org[m.org_type]) {
        $('#d_f_id').html(m.tmp);
        return;
    }

    m.arr = m.arr_org[m.org_type];
    for(i=0; i<m.arr.length; i++) {
        m.tmp += '<option value="'+ m.arr[i]['id'] +'" code="'+ m.arr[i]['code'] +'">'+ m.arr[i]['name'] + '</option>';
    }
    $('#d_f_id').html(m.tmp);

    if ('' != m.info) {
        i_obj_set('d_f_id', m.info['f_id']);
    }
}