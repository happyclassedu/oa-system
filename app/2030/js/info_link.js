/**
 * 文件名称：info_link.js
 * 功能描述：链接管理信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.check_state = '0';  //检查状态
    m.check_obj_id = '';  //检查对象id
    m.arr_menu = '';  //栏目信息数组
    m.ws_id = '';
    m.img = '';
    m.file_img = ', .gif, .jpg, .jpeg, .png, .bmp, ';
    if ('' == m.xid) {
        m.xid = parseInt(Math.random()/3.1415926*10000000000);
    }
    m.file_update = m.xid;

    i_obj_disable('d_atime');
    i_obj_disable('d_etime');
    i_obj_disable('d_hits');
    i_obj_disable('d_id');
    m_file_act();
}


function m_btn_load_plug() {
    $('#btn_add_link').click(function(){
        i_mdi_open( './info_link.htm?a=add&ws_id=' + m.ws_id, '链接信息--新增');
    });

    $('#d_menu_id').change(function(){
        i_obj_set('d_menu_name', this.options[this.selectedIndex].text);
    });

    $('#d_name').change(function(){
        if ('' != this.value && '' == i_obj_val('d_name_s')) {
            i_obj_set('d_name_s', this.value);
        }
    });

    $('#btn_upload').click(function(){
        $('#t_upload').uploadifyUpload();
    });
}

function m_info_set_plug() {
    m.ws_id = m.info['ws_id'];
    if ('edit' == m.act) {
        m_menu_read();
    }

    if ('' != m.info['img']) {
        i_obj_get('t_img_show').src = g.img + m.info['img'];
        i_obj_show('t_img_box');
    }
}

function m_info_add_plug() {
    m.ws_id = i_get('ws_id');
    if ('' === m.ws_id || isNaN(m.ws_id)) {
        alert('操作错误，正在关闭！');
        i_mdi_close();
    }
    m_menu_read();

    i_obj_hide('tr1');
    i_obj_hide('tr2');
    i_obj_set('d_u_id', '0');  //用例测试
    i_obj_set('d_u_name', '管理员');  //用例测试
    i_obj_hide('d_menu_name');
    i_obj_show('d_menu_id');
    $('#d_name').addClass('info_must');
}

function m_info_edit_plug() {
    m_menu_read();
    i_obj_show('t_upload_box');
    i_obj_hide('d_menu_name');
    i_obj_show('d_menu_id');
    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    i_obj_hide('t_upload_box');
    i_obj_hide('d_menu_id');
    i_obj_show('d_menu_name');
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_menu_id')) {
        alert('对不起，所属栏目必须选择！');
        $("#d_menu_id").focus();
        return false;
    }

    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入文章标题！');
        return false;
    }

    if ('1' == m.check_state) {
        alert('对不起：数据库中已存在相同值！');
        return false;
    }
    
    i_obj_set('d_ws_id', m.ws_id);
    return true;
}

function m_info_del_fail(arr) {
    if (0 == arr) {
        alert('删除：“' + m.info['name'] + '”失败！');
    }
}

function m_info_name_check() {
    m.arr = i_obj_val(m.check_obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&x=' + m.xid + '&obj_id=' + m.check_obj_id.substr(2),
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
    if ('' != m.arr_menu || '' === m.ws_id) {
        return false;
    }
    
    i_obj_set('d_menu_id', '');

    $.ajax({
        url : g.act + 'list_menu.php?a=list_read4link&ws_id=' + m.ws_id,
        success : function(txt){
            m.arr_menu = i_json2js(txt);
            m_menu_set();
        }
    });
}


function m_menu_set(){
    m.tmp = '';
    m.tmp += '<option value="" selected="selected">请选择--栏目分类</option>';
    for(i=0; i<m.arr_menu.length; i++) {
        m.tmp += '<option value="'+ m.arr_menu[i]['id'] +'">'+ m.arr_menu[i]['name'] + '</option>';
    }
    $('#d_menu_id').html('');
    $('#d_menu_id').append(m.tmp);

    if ('' != m.info) {
        i_obj_set('d_menu_id', m.info['menu_id']);
    }
}

function m_act_url_plug() {
    if (m.file_update == m.xid || '' == $('#list_tb_file tbody').html()) {
        m.act_url = i_obj_val('act_url');
        switch (m.act_url) {
            case 'add':
                i_mdi_open('./info_news.htm?a=add&ws_id=' + m.ws_id , '发布信息--新增', 1);
                return false;  //可以终止跳转
                break;
        }
        return true;
    }

    $.ajax({
        url : g.act_doc + 'a=info_update&x=' + m.xid + '&old=' +  m.file_update,
        success : function(txt){
            m.file_update =  m.xid;
            m_act_url();
        }
    });

    return false;
}

function m_file_act() {
    m.file_up_haha = i_upload_2({
        'obj_id' : 't_upload',
        'obj_id_progress' : 't_upload_progress',
        'obj_id_cancel' : 't_upload_cancel',
        'file_size' : '200', //200k
        'file_type' : '*.jpg;*.gif;*.png',
        'file_type_desc' : '图片文件',
        'data' : {
            'd_xid' : m.xid,
            'd_xtb' : 'link'
        },
        upload_start : function () {
            i_obj_show('t_upload_progress');
        },
        upload_success : function (file_obj, txt) {
            i_obj_hide('t_upload_progress');
            m.img = i_json2js(txt);
            m_file_act_ok();
        }
        
    });
//    m.file_up_haha.setPostParams({
//            'd_xid' : '456',
//            'd_xtb' : 'lisnk'
//    });
}

function m_file_act_bak() {
    i_upload({
        'obj_id' : '#t_upload',
        'data' : {
            'd_xid' : m.xid,
            'd_xtb' : 'link'
        },
        onSelect : function(evt, queue_id, file_obj) {
            if (1 > m.file_img.indexOf(file_obj.type)) {
                alert('对不起，该文件不是图片，请重新选择。');
                return false;
            }
            if (file_obj.size > 307200) {
                alert('对不起，图片太大，系统要求附件在300kb以内。');
                return false;
            }
            i_obj_show('btn_upload');
        },
        onComplete : function (evt, queue_id, file_obj, response, data) {
            i_obj_hide('btn_upload');
            m.img = i_json2js(response);
            m_file_act_ok();
        }
    });
}

function m_file_act_ok() {
    i_obj_set('d_img', m.img['img']);
    i_obj_get('t_img_show').src = g.img + m.img['img'];
    i_obj_show('t_img_box');
}
