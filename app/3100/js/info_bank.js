/**
 * 文件名称：info_bank.js
 * 功能描述：银行利率信息的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_year_term').blur(function(){
         m_info_name_check(this.id);
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
//    i_obj_disable('d_i_state0');
    i_obj_set('d_i_type', '3'); //2代表年度银行利率
    $('#d_year_term').addClass('info_must');
}


function m_info_edit_plug() {
    $('#d_year_term').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_year_term').removeClass('info_must');
}

//function m_info_input_plug(state) {
//
//}

//function m_act_url_plug() {
//    return false;  //可以终止跳转
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_year_term');
    if ('' == m.tmp) {
         alert('年限不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_intrest_rate');
    if ('' == m.tmp) {
         alert('利率不能为空，请填写！');
        return false;
    }

    return true;


}

function m_info_name_check(obj_id) {
    m.arr = i_obj_val(obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&i_type=3x=' + m.xid + '&obj_id=' + obj_id.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check = '1';
                    alert( '对不起：数据库中已存在相同值！');
                    $('#' + obj_id).focus();
                } else {
                    m.check = '0';
                }
            }
        });
    }
}


