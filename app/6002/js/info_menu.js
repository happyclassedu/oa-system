/**
 * 文件名称：info_menu.js
 * 功能描述：栏目管理的信息控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.check_state = '0';  //检查状态
    m.check_obj_id = '';  //检查对象id
    m.arr_menu = '';  //栏目数组
//    return false;  //可以终止初始化
}

//function m_btn_load_plug() {
//}

function m_info_set_plug() {
    if ('edit' == m.act) {
        m_menu_read();
    }
}

function m_info_add_plug() {
    m_menu_read();
    
    i_obj_hide('d_f_name');
    i_obj_show('d_f_id');
}

function m_info_edit_plug() {
    m_menu_read();

    i_obj_hide('d_f_name');
    i_obj_show('d_f_id');
}

function m_info_view_plug() {
    i_obj_hide('d_f_id');
    i_obj_show('d_f_name');
}

//function m_info_input_plug(state) {
//}

//function m_act_url_plug() {
////    return false;  //可以终止跳转
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_f_id')) {
        alert('对不起，上级模块必须选择！');
        $("#d_f_id").focus();
        return false;
    }

    if ('' == i_obj_val('d_name')) {
        alert('对不起，模块名称不能为空！');
        $("#d_name").focus();
        return false;
    }

    if ('1' == m.check_state) {
        alert('对不起：保存检查失败，请确认数据！');
        return false;
    }

    i = i_obj_get('d_f_id').selectedIndex - 1;
    if (0 == i) {
        i_obj_set('d_f_name', '无上级');
    } else {
        i_obj_set('d_f_name', i_obj_get('d_f_id').options[i_obj_get('d_f_id').selectedIndex].title);
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

function m_info_name_check() {
    m.arr = i_obj_val(m.check_obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&x=' + m.xid +'&obj_id=' + m.check_obj_id.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check_state = '1';
                    alert('对不起：数据库中已存在相同值！');
                    $('#' + m.check_obj_id).focus();
                } else {
                    m.check_state = '0';
                }
            }
        });
    }
}

/*
 * 栏目数据获取函数：m_menu_read
 * 相关变量：m.ws_id
 * 相关变量：m.arr_menu
 */
function m_menu_read() {
    if ('' != m.arr_menu) {
        m_menu_set();
        return;
    }

    i_obj_set('d_f_id', '0');

    $.ajax({
        url : g.act + 'list_menu.php?a=list_read4menu&x=' + m.xid,
        success : function(txt){
            m.arr_menu = i_json2js(txt);
            m_menu_set();
        }
    });
}

/*
 * 栏目数据赋值函数：m_menu_set
 * 相关变量：m.arr_menu
 */
function m_menu_set(){
    m.tmp = '';
    m.tmp += '<option value="" selected="selected">请选择--上级栏目</option>';
    m.tmp += '<option value="0">无上级栏目</option>';
    var menu_layer = 0;
    m.arr = m.arr_menu;
    for(i=0; i<m.arr.length; i++) {
        if (m.arr[i]['layer'] == menu_layer) {
            menu_layer = 0;
        }

        if (m.arr[i]['id'] != m.xid && 0 == menu_layer) {
            m.tmp += '<option value="'+ m.arr[i]['id'] +'" title="'+ m.arr[i]['name'] +'">'+ m.arr[i]['fix'] + m.arr[i]['name'] + '</option>';
        } else if (m.arr[i]['layer'] > menu_layer && 0 < menu_layer) {
            m.tmp += '<optgroup label="'+ m.arr[i]['fix'] + m.arr[i]['name'] + '" style="font-style:normal; font-weight:normal;"></optgroup>';
        } else {
            menu_layer = m.arr[i]['layer'];
            m.tmp += '<optgroup label="'+ m.arr[i]['fix'] + m.arr[i]['name'] + '" style="font-style:normal; font-weight:normal; color:#F00"></optgroup>';
        }
    }
    $('#d_f_id').html('');
    $('#d_f_id').append(m.tmp);

    if ('' != m.info) {
        i_obj_set('d_f_id', m.info['f_id']);
    }
}