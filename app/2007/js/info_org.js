/**
 * 文件名称：info_org.js
 * 功能描述：组织机构管理增加,修改，查看功能的前台程序。
 * 代码作者：钱宝伟（创建），王争强（优化），孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

$(document).ready(function(){
    m.list_fid = '';
});

//function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
//}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    m_list_read_fid();
    i_obj_hide('d_fname');
    i_obj_show('d_fid');
}

function m_info_edit_plug() {
    m_list_read_fid();
    i_obj_hide('d_fname');
    i_obj_show('d_fid');
}

function m_info_view_plug() {
    i_obj_hide('d_fid');
    i_obj_show('d_fname');
}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
        return false;
    }
    return true;
}

function m_list_read_fid() {
    if ('' == m.list_fid) {
        $.ajax({
            url : i_act + 'a=list_read_fid',
            success : function(txt){
                m.list_fid = i_json2js(txt);
                m.xtr = $('#d_fid').children(':eq(0)').clone(true);
                m.tmp = '';
                for(i=0; i<m.list_fid.length; i++) {
                    m.xtr.attr('value', m.list_fid[i]['id']);
                    m.xtr.attr('text',  m.list_fid[i]['name']);
                    m.tmp += m.xtr.parents().html();
                }
                $('#d_fid').append(m.tmp);
                i_obj_set('d_fid', m.info['fid']);
                $('#d_fid').change(function(){
                    i = this.selectedIndex - 1;
                    if (0 > i) {
                        i_obj_set('d_fname', '');
                    } else {
                        i_obj_set('d_fname', m.list_fid[i]['name']);
                    }
                });
            }
        });
    }
}