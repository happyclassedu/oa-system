/**
 * 文件名称：info_org.js
 * 功能描述：组织机构管理增加,修改，查看功能的前台程序。
 * 代码作者：钱宝伟（创建），王争强（优化），孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

$(document).ready(function(){
    i_read_css('m_list', 0);
});

function m_load() {
    m.list_hm_t = '';
    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
    $('#d_join_time').jdate({
        dateFormat: 'yy-mm-dd'
    });
    $('#d_hm_code, #d_hm_name').attr('readonly', true);
}

function m_btn_load_plug() {
    $('#btn_view_hm').click(function(){
        i_mdi_open('./info_hm.htm?a=view&x=' + m.xid, '员工档案信息', 1);
    });
    
    $('#btn_add_hm_t').click(function(){
        i_mdi_open('./info_hm_t.htm?a=add&x=' + m.xid, '员工调动信息');
    });
}

function m_info_set_plug() {
    if ('' == m.info) {
        alert('对不起，该员工没有工作信息，请办理入职手续！');
        i_mdi_open('./info_hm_w.htm?a=add&x=' + m.xid, '员工入职', 1);
        return false;
    }
    m_list_read_hm_t();
}

function m_info_add_plug() {
    i_obj_set('sys_title', '办理入职手续');
    i_obj_hide('list_tb');
    $.ajax({
        url : i_act + 'a=info_read_hm_i&x=' + m.xid,
        success : function(txt){
            m.info = i_json2js(txt);
            m_info_set();
        }
    });
    i_obj_set('d_join_time', i_date_now());
}

function m_info_edit_plug() {
    i_obj_hide('list_tb');
}

function m_info_view_plug() {
    i_obj_show('list_tb');
}

function m_info_input_plug(state) {
    if (true != state) {
        state =  true;
    }
    $('#d_hm_code, #d_hm_name').attr('readonly', state);
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_post_state');
    if ('' == m.tmp) {
        alert('请输入工职状态！');
        return false;
    }
    m.arr['hm_id'] = m.xid;
    return true;
}

function m_list_read_hm_t() {
    if ('' == m.list_hm_t) {
        $.ajax({
            url : i_act + 'a=list_read_hm_t&x=' + m.xid,
            success : function(txt){
                m.list_hm_t = i_json2js(txt);
                m.arr = m.list_hm_t;
                $('#list_tb tbody').html('');
                for(i=0; i<m.arr.length; i++) {
                    m.xtr.children(':eq(1)').html(m.arr[i]['org_0_name']);
                    m.xtr.children(':eq(3)').html(m.arr[i]['org_1_name']);
                    m.xtr.children(':eq(5)').html(m.arr[i]['job_name']);
                    $('#list_tb tbody').append(m.xtr.clone(true));
                }
                i_tr_css($('#list_tb tbody tr'));
            }
        });
    }
}

function m_act_url_plug() {
    if ('add' == m.act) {
        i_mdi_open('./info_hm_w.htm?a=view&x=' + i_get('x'), '员工工作信息', 1);
        return false;  //可以终止跳转
    }
}