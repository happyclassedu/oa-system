/**
 * 文件名称：info_register.js
 * 功能描述：注册信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

var ws_id = '10';
var ws_name = '莲湖区人力资源服务中心流动党员之家';
var menu_id = '1507';
var menu_name = '思想汇报';

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    i_read_js('common_func');
}

function m_btn_load_plug() {
     $('#btn_isuser').click(function(){
       m.tmp = i_obj_val('d_loginid');
       m_isuser(m.tmp);
    });


    $('#d_birth').jdate({
        //                    showButtonPanel: false,
        //                    changeMonth: false,
        //                    changeYear: false,
        //                    numberOfMonths: 2,
        dateFormat: 'yy-mm-dd'
    });

    $('#d_jparty_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_idcard').change(function(){
       i_check_cardid('d_idcard', 'd_error_idcard', 'd_sex' , 'd_birth')
    });

    $('#btn_reset').click(function(){
        i_obj_set('d_name', '');
        i_obj_set('d_u_name', '');
        i_obj_set('d_source', '');
        i_obj_set('d_remark', '');
     });
}

function m_info_set_plug() {

}

function m_info_add_plug() {
    //留言板模块的信息配置
    i_obj_set('d_ws_id', ws_id);  //配置信息的网站地址
    i_obj_set('d_ws_name',ws_name);  //配置信息的网站名称
    i_obj_set('d_menu_id', menu_id);  //配置信息的菜单id
    i_obj_set('d_menu_name',menu_name);  //配置信息的菜单名称
    
    $('#d_name').addClass('info_must');
}

//function m_info_edit_plug() {
//    $('#d_name').addClass('info_must');
//}

//function m_info_view_plug() {
//    $('#d_name').removeClass('info_must');
//}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_name', '标题不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_u_name');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_u_name', '作者不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_u_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_source');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_source', '所属支部不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_source', '通过', '2');
    }

    m.tmp = i_obj_val('d_remark');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_remark', '内容不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_remark', '通过', '2');
    }

    return true;
}

//function m_act_url_plug() {
//    return false;
//}
