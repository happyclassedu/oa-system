/**
 * 文件名称：info_post.js
 * 功能描述：职务管理模块的信息程序。
 * 代码作者：钱包伟（创建）、王争强（优化）、孙振强（重构）
 * 创建日期：2010-06-10
 * 修改日期：2010-07-18
 * 当前版本：V3.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

//function m_load() {
//    alert(m.xid);
//    return false;  //可以终止初始化
//}

function m_btn_load_plug() {
    $('#d_name').change(function(){
        m_info_name_check();
    });
}

//function m_info_set_plug() {
//   alert(m.xid);
//}

function m_info_add_plug() {
    $('#d_name').addClass('info_must');
}

function m_info_edit_plug() {
    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入职务名称！');
        return false;
    }
    return true;
}

//function m_info_del_ok() {
//    i_mdi_open('./list_' + g.id_name + '.htm?a=list' , '列表管理', 1);
//}

function m_info_del_fail(arr) {
    if (0 > arr) {
        alert('删除职务：“' + m.info['name'] + '”失败！\n\n该职务尚有员工，请先解除关系。');
    } else if (0 == arr) {
        alert('删除职务：“' + m.info['name'] + '”失败！');
    }
}

function m_info_name_check() {
    m.arr = i_obj_val('d_name');
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&x=' + m.xid,
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    alert('请注意：已有同名职务。');
                }
            }
        });
    }
}