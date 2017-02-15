/**
 * 文件名称：info_org.js
 * 功能描述：组织机构管理增加,修改，查看功能的前台程序。
 * 代码作者：钱宝伟（创建），王争强（优化），孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

$(document).ready(function(){
    m.list_zt = '';
    m.list_hm = '';
});

function m_btn_load_plug() {
    $('#d_zt_id').change(function(){
        i = this.selectedIndex - 1;
        if (0 > i) {
            i_obj_set('d_zt_name', '');
        } else {
            i_obj_set('d_zt_name', m.list_zt[i]['name']);
        }
    });

    $('#d_hm_id').change(function(){
        i = this.selectedIndex - 1;
        if (0 > i) {
            i_obj_set('d_hm_name', '');
        } else {
            i_obj_set('d_hm_name', m.list_hm[i]['name']);
        }
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    m_list_read_zt();
    m_list_read_hm();
    i_obj_hide('d_zt_name');
    i_obj_show('d_zt_id');
    i_obj_hide('d_hm_name');
    i_obj_show('d_hm_id');
}

function m_info_edit_plug() {
    m_info_add_plug();
}

function m_info_view_plug() {
    i_obj_hide('d_zt_id');
    i_obj_show('d_zt_name');
    i_obj_hide('d_hm_id');
    i_obj_show('d_hm_name');
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

function m_list_read_zt() {
    if ('' == m.list_zt) {
        $.ajax({
            url : i_act + 'a=list_read_zt',
            success : function(txt){
                m.list_zt = i_json2js(txt);
                m.xtr = $('#d_zt_id').children(':eq(0)').clone(true);
                m.tmp = '';
                for(i=0; i<m.list_zt.length; i++) {
                    m.xtr.attr('value', m.list_zt[i]['id']);
                    m.xtr.attr('text',  m.list_zt[i]['name']);
                    m.tmp += m.xtr.parents().html();
                }
                $('#d_zt_id').append(m.tmp);
                i_obj_set('d_zt_id', m.info['zt_id']);
            }
        });
    }
}

function m_list_read_hm() {
    if ('' == m.list_hm) {
        $.ajax({
            url : i_act + 'a=list_read_hm',
            success : function(txt){
                m.list_hm = i_json2js(txt);
                m.xtr = $('#d_hm_id').children(':eq(0)').clone(true);
                m.tmp = '';
                for(i=0; i<m.list_hm.length; i++) {
                    m.xtr.attr('value', m.list_hm[i]['id']);
                    m.xtr.attr('text',  m.list_hm[i]['name']);
                    m.tmp += m.xtr.parents().html();
                }
                $('#d_hm_id').append(m.tmp);
                i_obj_set('d_hm_id', m.info['hm_id']);
            }
        });
    }
}