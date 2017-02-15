/**
 * 文件名称：info_community.js
 * 功能描述：社区信息的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m.street_id = i_get('street_id');
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_community').blur(function(){
         m_info_name_check(this.id);
    });

    $('#btn_add_community').click(function(){
        i_mdi_open( './info_community.htm?a=add&street_id=' + m.street_id, m.info['community'] + '--信息新增');
    });

    $('#btn_edit_community').click(function(){
        i_mdi_open( './info_community.htm?a=edit&x=' + m.info['id'] + '&street_id=' + m.street_id, m.info['community'] + '--信息管理');
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    i_obj_disable('d_fname');
    i_obj_disable('btn_add_community');
    i_obj_disable('btn_edit_community');
    i_obj_set('d_i_type', '1');
    $('#d_community').addClass('info_must');
    m_init();
}


function m_info_edit_plug() {
    i_obj_disable('d_fname');
    i_obj_disable('btn_edit_community');
    $('#d_community').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_community').removeClass('info_must');
}

//function m_info_input_plug(state) {
//
//}

//function m_act_url_plug() {
//    return false;  //可以终止跳转
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_community');
    if ('' == m.tmp) {
         alert('社区名称不能为空，请填写！');
        return false;
    }

//    m.tmp = i_obj_val('d_community_code');
//    if ((m.tmp).length >9) {
//         alert('社区编码没有补全，请填写！');
//        return false;
//    }

    return true;


}

function m_info_name_check(obj_id) {
    m.arr = i_obj_val(obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&i_type=1x=' + m.xid + '&obj_id=' + obj_id.substr(2),
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

function m_init() {
    $.ajax({
        url : i_act + 'a=info_read&x=' + m.street_id,
        success : function(txt){
            m.arr_info = i_json2js(txt);
            i_obj_set('d_fid', m.arr_info['id']);
            i_obj_set('d_fname', m.arr_info['street']);
            i_obj_set('d_community_code', m.arr_info['street_code']);
        }
    });
}

