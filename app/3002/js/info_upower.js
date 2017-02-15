/**
 * 文件名称：info_org.js
 * 功能描述：组织机构管理增加,修改，查看功能的前台程序。
 * 代码作者：钱宝伟（创建），王争强（优化），孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

//$(document).ready(function(){
//     alert('test');
//});

function m_load() {
    m.list_u = '';
    m.list_t = '';
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_uid').change(function(){
        i = this.selectedIndex - 1;
        if (0 > i) {
            i_obj_set('d_u_name', '');
        } else {
            i_obj_set('d_u_name', m.list_u[i]['name']);
        }
    });

    $('#d_tid').change(function(){
        i = this.selectedIndex - 1;
        if (0 > i) {
            i_obj_set('d_t_name', '');
        } else {
            i_obj_set('d_t_name', m.list_t[i]['name']);
        }
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    m_list_read_u();
    m_list_read_t();
    i_obj_hide('d_u_name');
    i_obj_show('d_uid');
    i_obj_hide('d_t_name');
    i_obj_show('d_tid');
}

function m_info_edit_plug() {
    m_info_add_plug();
}

function m_info_view_plug() {
    i_obj_hide('d_uid');
    i_obj_show('d_u_name');
    i_obj_hide('d_tid');
    i_obj_show('d_t_name');
}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    //    m.tmp = i_obj_val('d_name');
    //    if ('' == m.tmp) {
    //        alert('dzd');
    //        return false;
    //    }
    return true;
}

function m_list_read_u() {
    if ('' == m.list_u) {
        $.ajax({
            url : i_act + 'a=list_read_u',
            success : function(txt){
                m.list_u = i_json2js(txt);
                m.xtr = $('#d_uid').children(':eq(0)').clone(true);
                m.tmp = '';
                for(i=0; i<m.list_u.length; i++) {
                    m.xtr.attr('value', m.list_u[i]['id']);
                    m.xtr.attr('text',  m.list_u[i]['name']);
                    m.tmp += m.xtr.parents().html();
                }
                $('#d_uid').append(m.tmp);
                i_obj_set('d_uid', m.info['uid']);
            }
        });
    }
}

function m_list_read_t() {
    if ('' == m.list_t) {
        $.ajax({
            url : i_act + 'a=list_read_t',
            success : function(txt){
                m.list_t = i_json2js(txt);
                m.xtr = $('#d_tid').children(':eq(0)').clone(true);
                m.tmp = '';
                for(i=0; i<m.list_t.length; i++) {
                    m.xtr.attr('value', m.list_t[i]['id']);
                    m.xtr.attr('text',  m.list_t[i]['name']);
                    m.tmp += m.xtr.parents().html();
                }
                $('#d_tid').append(m.tmp);
                i_obj_set('d_tid', m.info['tid']);
            }
        });
    }
}