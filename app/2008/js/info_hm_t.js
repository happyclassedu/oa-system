/**
 * 文件名称：info_org.js
 * 功能描述：组织机构管理增加,修改，查看功能的前台程序。
 * 代码作者：钱宝伟（创建），王争强（优化），孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

//$(document).ready(function(){
//    alert('12345');
//});

function m_load() {
    m.list_job = '';
    m.list_org = new Object();
    m.list_org_x = '';
    m.list_post = '';
    $('#d_down_time').jdate({
        dateFormat: 'yy-mm-dd'
    });
    $('#d_hm_code, #d_hm_name').attr('readonly', true);
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_view_hm').click(function(){
        i_mdi_open('./info_hm.htm?a=view&x=' + m.xid, '员工档案信息', 1);
    });

    $('#btn_view_hm_w').click(function(){
        i_mdi_open('./info_hm_w.htm?a=view&x=' + m.xid, '员工工作信息', 1);
    });
}

//function m_info_set_plug() {
//   alert(m.xid);
//}

function m_info_add_plug() {
    i_obj_hide('d_org_0_name');
    i_obj_show('d_org_0_id');
    i_obj_hide('d_org_1_name');
    i_obj_show('d_org_1_id');
    i_obj_hide('d_job_name');
    i_obj_show('d_job_id');
    i_obj_hide('d_post_name');
    i_obj_show('d_post_id');
    if ('' == m.xid) {
        alert('操作错误，正在关闭！');
        i_mdi_close();
        return false;
    }

    $.ajax({
        url : i_act + 'a=info_read_hm_i&x=' + m.xid,
        success : function(txt){
            m.info = i_json2js(txt);
            m_info_set();
        }
    });

    i_obj_set('d_down_time', i_date_now());
    m.list_org_x = '1';
    m_list_read_org();
    m_list_read_job();
    m_list_read_post();
    m_select_act('org_0');
    m_select_act('org_1');
    m_select_act('job');
    m_select_act('post');
    $('#d_org_0_id').change(function(){
        i_obj_set('d_org_0_name', $(this).find('option:selected').text());
        m.list_org_x = this.value;
        if ('' == m.list_org_x) {
            i_obj_set('d_org_1_id', '');
            i_obj_set('d_org_1_name', '');
            return false;
        }
        m_list_read_org();
    });
}

//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//    if (true != state) {
//        state =  true;
//    }
//    $('#d_hm_code, #d_hm_name').attr('readonly', state);
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_org_0_name');
    if ('' == m.tmp) {
        alert('请选择部门');
        return false;
    }
    m.arr['hm_id'] = m.xid;
    return true;
}

function m_list_read_job() {
    if ('' == m.list_job) {
        $.ajax({
            url : i_act + 'a=list_read_job',
            success : function(txt){
                m.list_job = i_json2js(txt);
                m_list_act('job_id', m.list_job);
            }
        });
    }
}

function m_list_read_post() {
    if ('' == m.list_post) {
        $.ajax({
            url : i_act + 'a=list_read_post',
            success : function(txt){
                m.list_post = i_json2js(txt);
                m_list_act('post_id', m.list_post);
            }
        });
    }
}

function m_list_read_org() {
    if ('undefined' == typeof(m.list_org[m.list_org_x])) {
        $.ajax({
            url : i_act + 'a=list_read_org&x=' + m.list_org_x,
            success : function(txt){
                m.list_org[m.list_org_x] = i_json2js(txt);
                var obj_name;
                if ('1' == m.list_org_x) {
                    obj_name = 'org_0_id';
                } else {
                    obj_name = 'org_1_id';
                }
                m_list_act(obj_name, m.list_org[m.list_org_x]);
            }
        });
    }
}

function m_list_act(obj_name, obj_arr) {
    m.xtr = $('#d_' + obj_name).children(':eq(0)').clone(true);
    for (i in obj_arr) {
        m.xtr.attr('value', obj_arr[i]['id']);
        m.xtr.attr('text',  obj_arr[i]['name']);
        $('#d_' + obj_name).append(m.xtr.clone(true));
    }
    i_obj_set('d_' + obj_name, m.info[obj_name]);
}

function m_select_act(obj_name) {
   $('#d_' + obj_name + '_id').change(function(){
        i_obj_set('d_' + obj_name + '_name', $(this).find('option:selected').text());
    });
}

function m_act_url_plug() {
    if ('add' == m.act) {
        i_mdi_open('./info_hm_w.htm?a=view&x=' + i_get('x'), '员工工作信息', 1);
        return false;  //可以终止跳转
    }
}