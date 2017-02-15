/**
 * 文件名称：info_job.js
 * 功能描述：岗位管理模块的信息程序。
 * 代码作者：钱包伟（创建）、王争强（优化）、孙振强（重构）
 * 创建日期：2010-06-10
 * 修改日期：2010-07-18
 * 当前版本：V3.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.check = '0';
//    alert(m.xid);
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#d_name, #d_name_e, #d_name_s').blur(function(){
        m_info_name_check(this.id);
    });
}

//function m_info_set_plug() {
//   alert(m.xid);
//}

function m_info_add_plug() {
//    $('#d_name, #d_name_e, #d_name_s').addClass('info_must');
    $('#d_name, #d_name_e').addClass('info_must');
}

function m_info_edit_plug() {
//    $('#d_name, #d_name_e, #d_name_s').addClass('info_must');
    $('#d_name, #d_name_e').addClass('info_must');
}

function m_info_view_plug() {
//    $('#d_name, #d_name_e, #d_name_s').removeClass('info_must');
    $('#d_name, #d_name_e').removeClass('info_must');
}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入中文名称！');
        return false;
    }

    if ('' == i_obj_val('d_name_e')) {
        alert('对不起，请输入英文名称！');
        return false;
    }

//    if ('' == i_obj_val('d_name_s')) {
//        alert('对不起，请输入英文缩写！');
//        return false;
//    }

    if ('1' == m.check) {
        alert('对不起：数据库中已存在相同值！');
        return false;
    }

    return true;
}

//function m_info_del_ok() {
//    i_mdi_open('./list_' + g.id_name + '.htm?a=list' , '列表管理', 1);
//}

function m_info_del_fail(arr) {
    if (0 == arr) {
        alert('删除：“' + m.info['name'] + '”失败！');
    }
}

function m_info_name_check(obj_id) {
    m.arr = i_obj_val(obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&x=' + m.xid + '&obj_id=' + obj_id.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check = '1';
                    alert('对不起：数据库中已存在相同值！');
                    $('#' + obj_id).focus();
                } else {
                    m.check = '0';
                }
            }
        });
    }
}