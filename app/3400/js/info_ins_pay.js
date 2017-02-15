/**
 * 文件名称：info_ins_pay.js
 * 功能描述：养老金计发标准设置的信息程序。
 * 代码作者：孙振强（创建）
 * 创建日期：2011-05-08
 * 修改日期：2011-05-08
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.check = '0';
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#d_year').blur(function(){
        m.check_obj = this.id;
        m_info_check();
    });
}

//function m_info_set_plug() {
//   alert(m.xid);
//}

//function m_info_add_plug() {
////    $('#d_name, #d_name_e').addClass('info_must');
//}
//
//function m_info_edit_plug() {
////    $('#d_name, #d_name_e').addClass('info_must');
//}
//
//function m_info_view_plug() {
////    $('#d_name, #d_name_e').removeClass('info_must');
//}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_year')) {
        alert('对不起，请选择标准年份！');
        $('#d_year').focus();
        return false;
    }

    if ('' == i_obj_val('d_ins_pay')) {
        alert('对不起，请输入养老金计发标准！');
        $('#d_ins_pay').focus();
        return false;
    }

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
        alert('删除失败！');
    }
}

function m_info_check() {
    m.arr = i_obj_val(m.check_obj);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_check&x=' + m.xid + '&obj_id=' + m.check_obj.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check = '1';
                    if ('d_year' == m.check_obj) {
                        alert('对不起：' + i_obj_val(m.check_obj) + '年养老金标准已经设置！');
                    } else {
                        alert('对不起：数据库中已存在相同值！');
                    }
                    $('#' + m.check_obj).focus();
                } else {
                    m.check = '0';
                }
            }
        });
    }
}