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
    m.arr_menu = new Object();  //栏目数组
    m.arr_menu_id = '';  //栏目数组id
    m.ws_id = '';

    i_obj_disable('d_atime');
    i_obj_disable('d_etime');
    i_obj_disable('d_hits');
    i_obj_disable('d_id');
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_add_menu').click(function(){
        i_mdi_open( './info_menu.htm?a=add&ws_id=' + m.ws_id, '网站栏目--新增');
    });

    $('#btn_list_news').click(function(){
        i_mdi_open( './list_news.htm?a=list&ws_id=' + m.ws_id + '&menu_id=' + m.xid, m.info['name'] + '--信息管理');
    });

    $('#btn_info_news').click(function(){
        i_mdi_open( './info_news.htm?a=add&ws_id=' + m.ws_id + '&menu_id=' + m.xid, m.info['name'] + '--信息新增');
    });
    
    $('#d_position').change(function(){
        m.arr_menu_id = this.value;
        m_menu_read();
    });

    $('#d_type_mod').change(function(){
        if('0' == this.value || '1' == this.value  || '2' == this.value) {
            i_obj_enable('d_type_ext');
        } else {
            i_obj_disable('d_type_ext');
        }
    });
}

function m_info_set_plug() {
    m.ws_id = m.info['ws_id'];
    m.arr_menu_id = m.info['position'];
    if ('edit' == m.act) {
        m_menu_read();
    }

    if (0 != m.info['type_mod']) {
        i_obj_disable('btn_list_news');
        i_obj_disable('btn_info_news');
    }
}

function m_info_add_plug() {
    m.ws_id = i_get('ws_id');
    m.arr_menu_id = 0;
    if ('' === m.ws_id || isNaN(m.ws_id)) {
        alert('操作错误，正在关闭！');
        i_mdi_close();
    }
    m_menu_read();

    i_obj_hide('tr1');
    i_obj_hide('tr2');
    i_obj_disable('btn_list_news');
    i_obj_disable('btn_info_news');
    i_obj_hide('d_fname');
    i_obj_show('d_fid');

    $('#d_name, #d_fid').addClass('info_must');
}

function m_info_edit_plug() {
    m_menu_read();

    i_obj_hide('d_fname');
    i_obj_show('d_fid');

    $('#d_name, #d_fid').addClass('info_must');
}

function m_info_view_plug() {
    i_obj_hide('d_fid');
    i_obj_show('d_fname');

    $('#d_name, #d_fid').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_act_url_plug() {
    m.act_url = i_obj_val('act_url');
    switch (m.act_url) {
        case 'add':
            i_mdi_open('./info_menu.htm?a=add&ws_id=' + m.ws_id , '网站栏目--新增', 1);
            return false;  //可以终止跳转
            break;
    }
//    return false;  //可以终止跳转
}

function m_info_save_plug() {
    if ('' == i_obj_val('d_fid')) {
        alert('对不起，上级栏目必须选择！');
        $("#d_fid").focus();
        return false;
    }

    if ('' == i_obj_val('d_name')) {
        alert('对不起，栏目名称不能为空！');
        $("#d_name").focus();
        return false;
    }

    if ('1' == m.check_state) {
        alert('对不起：保存检查失败，请确认数据！');
        return false;
    }

    i = i_obj_get('d_fid').selectedIndex - 1;
    if (0 == i) {
        i_obj_set('d_fname', '无上级');
    } else {
        i_obj_set('d_fname', i_obj_get('d_fid').options[i_obj_get('d_fid').selectedIndex].title);
    }

    i_obj_set('d_ws_id', m.ws_id);

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
            url : i_act + 'a=info_name_check&x=' + m.xid +'&ws_id=' + m.ws_id +'&obj_id=' + m.check_obj_id.substr(2),
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
    if ('' === m.ws_id || '' === m.arr_menu_id || undefined == m.arr_menu_id) {
        return false;
    }

    if (m.arr_menu[m.arr_menu_id]) {
        m_menu_set();
        return false;
    }

    i_obj_set('d_fid', '0');

    $.ajax({
        url : g.act + 'list_menu.php?a=list_read4menu&x=' + m.xid +'&ws_id=' + m.ws_id +'&position=' + m.arr_menu_id,
        success : function(txt){
            m.arr_menu[m.arr_menu_id] = i_json2js(txt);
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
    m.arr = m.arr_menu[m.arr_menu_id];
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
    $('#d_fid').html('');
    $('#d_fid').append(m.tmp);

    if ('' != m.info) {
        i_obj_set('d_fid', m.info['fid']);
    }
}