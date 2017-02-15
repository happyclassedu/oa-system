/**
 * 文件名称：info.js
 * 功能描述：info页面base程序。
 * 代码作者：孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

var m = {
    xid : '',
    act : '',
    tmp : '',
    arr : '',
    act_url : '',
    xtr : '',
    info : '',
    tb_title : 'tb_title0'
};

$(document).ready(function(){
    i_ajax_box_show();
    m.act = i_get('a');
    m.xid = i_get('x');
    m_btn_load();
    m_info_load();
});

function m_info_load() {
    if (this.m_load) {
        m.tmp = m_load();
        if (false == m.tmp) {
            return false;
        }
    }
    
    if ('edit' == m.act && '' != m.xid) {
        m_info_edit();
    } else if('view' == m.act && '' != m.xid) {
        m_info_view();
    } else if('add' == m.act) {
        m_info_add();
    } else if('' == m.act) {
        alert('操作错误，正在关闭！');
        i_mdi_close();
    }
}

function m_btn_load() {
    $('#btn_save').click(function(){
        m_info_save();
    });

    $('#btn_add').click(function(){
        i_mdi_open('./' + g_id + '.htm?a=add', '新增信息');
    });

    $('#btn_edit').click(function(){
        m_info_edit();
    });

    $('#btn_del').click(function(){
        m_info_del();
    });

    $('#btn_list').click(function(){
        i_mdi_open('./list_' + g.id_name + '.htm', '列表信息');
    });

    $('#btn_cancel').click(function(){
        if ('edit' == m.act || 'view' == m.act) {
            m_info_view();
        } else if('add' == m.act) {
            i_mdi_close();
        }
    });

    $('#btn_close').click(function(){
        i_mdi_close();
    });

    $('#btn_refresh').click(function(){
        window.location.reload();
    });
    if (this.m_btn_load_plug) {
        m_btn_load_plug();
    }
}


function m_info_read() {
    $.ajax({
        url : i_act + 'a=info_read&x=' + m.xid,
        success : function(txt){
            m.info = i_json2js(txt);
            m_info_set();
        }
    });
}

function m_info_set() {
    for (i in m.info) {
        i_obj_set('d_' + i, m.info[i]);
    }
    if (this.m_info_set_plug) {
        m_info_set_plug();
    }

    i_ajax_box_hide();
}

function m_info_add() {
    i_obj_set('sys_state', '新增');
    $('tr[class^=tb_title]').attr('className', 'tb_title1');
    i_obj_disable('btn_add');
    i_obj_disable('btn_edit');
    i_obj_disable('btn_del');
    if (this.m_info_add_plug) {
        m_info_add_plug();
    }
    i_ajax_box_hide();
}

function m_info_edit() {
    if ('' == m.info) {
        m_info_read();
    }
    i_obj_set('sys_state', '修改');
    $('tr[class^=tb_title]').attr('className', 'tb_title3');
    i_obj_disable('btn_edit');
    i_obj_show('act_tb');
    m_info_input(false);
    if (this.m_info_edit_plug) {
        m_info_edit_plug();
    }
}

function m_info_view() {
    if ('' == m.info) {
        m_info_read();
    } else {
        m_info_set();
    }
    i_obj_set('sys_state', '查看');
    $('tr[class^=tb_title]').attr('className', 'tb_title4');
    i_obj_enable('btn_edit');
    i_obj_hide('act_tb');
    m_info_input(true);
    if (this.m_info_view_plug) {
        m_info_view_plug();
    }
}

function m_info_input(state) {
    if (true != state) {
        state =  false;
    }
    $('#info_tb tbody input, #info_tb tbody textarea').attr('readonly', state);
    $('#info_tb tbody input[type="radio"], #info_tb tbody select').attr('disabled', state);
    if (this.m_info_input_plug) {
        m_info_input_plug(state);
    }
}

function m_info_save() {
    m.arr = new Object();
    if (this.m_info_save_plug) {
        m.tmp = m_info_save_plug();
        if (false == m.tmp) {
            return false;
        }
    }
    m.tmp = confirm('确定保存？');
    if (false == m.tmp) {
        return false;
    }
    if ('edit' == m.act || 'view' == m.act ) {
        m_info_save_edit();
    } else if ('add' == m.act) {
        m_info_save_add();
    }
}

function m_info_save_edit() {
    for (i in m.info) {
        m.tmp = i_obj_get('d_' + i);
        if (null != m.tmp) {
            m.tmp = i_obj_val('d_' + i);
            if (m.tmp != m.info[i]){
                m.arr[i] = m.tmp;
            }
        }
    }

    m.tmp = '';
    for (i in m.arr) {
        m.tmp = i;
        break;
    }
    if ('' == m.tmp) {
        //        alert('对不起，没有任何修改，无法保存。');
        alert('保存成功！');
        m_act_url();
        return false;
    }

    $.ajax({
        url : i_act + 'a=info_edit&x=' + m.xid,
        data : 'arr=' + i_js2json(m.arr),
        success : function(txt){
            if (txt > 0) {
                alert('保存成功！');
                m_act_url();
            } else {
                alert('保存失败！');
                alert(txt);
            }
        }
    });
}

function m_info_save_add() {
    $('#info_tb tbody input[id!=""], #info_tb tbody select[id!=""], #info_tb tbody textarea[id!=""]').each(function() {
        m.tmp = i_obj_val(this.id);
        if ('' != m.tmp) {
            m.arr[this.id.substr(2)] = m.tmp;
            if ('radio' == this.type && true == this.checked) {
                m.arr[this.name.substr(2)] = this.value;
            }
        }
    });

    m.tmp = '';
    for (i in m.arr) {
        m.tmp = i;
        break;
    }
    if ('' == m.tmp) {
        alert('对不起，没有任何修改，无法保存。');
        return false;
    }

    $.ajax({
        url : i_act + 'a=info_add',
        data : 'arr=' + i_js2json(m.arr),
        success : function(txt){
            if (txt > 0) {
                alert('保存成功！');
                m.xid = txt ;
                m_act_url();
            } else {
                alert('保存失败！');
                alert(txt);
            }
        }
    });
    return true;
}

function m_act_url() {
    if (this.m_act_url_plug) {
        m.tmp = m_act_url_plug();
        if (false == m.tmp) {
            return false;
        }
    }
    m.act_url = i_obj_val('act_url');
    switch (m.act_url) {
        default: case 'view':
            i_mdi_open('./' + g_id + '.htm?a=view&x=' + m.xid, '查看信息', 1);
            break;
        case 'add':
            i_mdi_open('./' + g_id + '.htm?a=add' , '新增信息', 1);
            break;
        //        case 'list':
        //            g_id = g_id.replace('info_', 'list_');
        //            alert(g_id);
        //            i_mdi_open('./' + g_id + '.htm' , '列表信息');
        //            i_mdi_close();
        //            break;
        case 'close':
            i_mdi_close();
            break;
    }
}

function m_info_del() {
    m.tb_title = $('tr[class^=tb_title]').attr('className');
    $('tr[class^=tb_title]').attr('className', 'tb_title2');
    m.tmp = confirm('确定要删除“' + m.info['name'] + '”吗？');
    if (true == m.tmp) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + m.xid ,
            success : function(txt){
                m_info_del_success(txt);
            }
        });
    } else {
        $('tr[class^=tb_title]').attr('className', m.tb_title);
    }
}

function m_info_del_success(txt) {
    if(txt > 0) {
        if (this.m_info_del_ok) {
            m_info_del_ok(txt);
        } else {
            i_mdi_close();
        }
    } else {
        if (this.m_info_del_fail) {
            m_info_del_fail(txt);
        } else {
            alert('删除“' + m.info['name'] + '”失败！');
        }
        $('tr[class^=tb_title]').attr('className', m.tb_title);
    }
}