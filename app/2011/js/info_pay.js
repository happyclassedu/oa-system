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
});

function m_btn_load_plug() {
    $('#btn_pay_make').click(function(){
        i_mdi_open('./stat_pay_i.htm?x=' + m.xid, '列表管理--工资体系设置管理');
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    m_list_read_zt();
    i_obj_hide('d_zt_name');
    i_obj_show('d_zt_id');
}

function m_info_edit_plug() {
    m_list_read_zt();
    i_obj_hide('d_zt_name');
    i_obj_show('d_zt_id');
}

function m_info_view_plug() {
    i_obj_hide('d_zt_id');
    i_obj_show('d_zt_name');
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
                $('#d_zt_id').change(function(){
                    i = this.selectedIndex - 1;
                    if (0 > i) {
                        i_obj_set('d_zt_name', '');
                    } else {
                        i_obj_set('d_zt_name', m.list_zt[i]['name']);
                    }
                });
            }
        });
    }
}