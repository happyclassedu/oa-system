/**
 * 文件名称：info_cfg.js
 * 功能描述：发布网站管理的信息控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.check = '0';
    
    i_obj_disable('d_atime');
    i_obj_disable('d_etime');
    i_obj_disable('d_hits');
    i_obj_disable('d_id');
    i_obj_hide('box_act_url');
    
    $('#d_atime, #d_etime, #d_u_name').addClass('info_readonly');
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#d_name, #d_name_e, #d_name_s').blur(function(){
        m_info_name_check(this.id);
    });

    $('#btn_www').click(function(){
        window.open(m.info['url']);
    });

    $('#btn_list_menu').click(function(){
        i_mdi_open( './list_menu.htm?a=list&ws_id=' + m.xid, m.info['name'] + '--栏目管理');
    });

    $('#btn_info_menu').click(function(){
        i_mdi_open( './info_menu.htm?a=add&ws_id=' + m.xid, m.info['name'] + '--栏目新增');
    });

    $('#btn_list_news').click(function(){
        i_mdi_open( './list_news.htm?a=list&ws_id=' + m.xid, m.info['name'] + '--新闻管理');
    });

    $('#btn_info_news').click(function(){
        i_mdi_open( './info_news.htm?a=add&ws_id=' + m.xid, m.info['name'] + '--新闻新增');
    });
}

//function m_info_set_plug() {
//}

function m_info_add_plug() {
    i_obj_hide('tr1');
    i_obj_disable('btn_www');
    i_obj_disable('btn_list_menu');
    i_obj_disable('btn_info_menu');
    i_obj_disable('btn_list_news');
    i_obj_disable('btn_info_news');
    $('#d_name, #d_name_s').addClass('info_must');
}

function m_info_edit_plug() {
    $('#d_name, #d_name_s').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_name, #d_name_s').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入网站名称！');
        $("#d_name").focus();
        return false;
    }
    
    if ('' == i_obj_val('d_name_s')) {
        alert('对不起，请输入网站简称！');
        $("#d_name_s").focus();
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