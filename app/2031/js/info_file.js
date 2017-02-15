/**
 * 文件名称：info_news.js
 * 功能描述：文件管理的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.check = '0';
//    alert(m.xid);
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_down').click(function(){
        m_file_down(m.xid);
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    i_obj_disable('btn_down');
    i_obj_hide('tr_1');
    i_obj_hide('tr_2');
    i_upload({
        'obj_id' : '#d_upload',
        'more' : true,
        onSelect : function(evt, queue_id, file_obj) {
            if (file_obj.size > 104857600) {
                alert("对不起, 这个文件超过100MB, 系统无法上传。");
                return false;
            }
        },
        onAllComplete : function (evt, data) {
            alert(data.filesUploaded + '个文件上传成功！');
            m_act_url();
        }
    });
}

function m_info_edit_plug() {
    i_obj_hide('tr_3');
    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    i_obj_hide('tr_3');
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    if ('edit' == m.act && '' == i_obj_val('d_name')) {
        alert('对不起，请输入文件名！');
        return false;
    }
    
    if ('1' == m.check) {
        alert('对不起：数据库中已存在相同值！');
        return false;
    }

    $.ajax({
        url : i_act + 'a=info_del&x=' + m.xid ,
        success : function(txt){
            m_info_del_success(txt);
        }
    });
    
    var post_data  = {
        'd_name' : i_obj_val('d_name'),
        'd_intro' : i_obj_val('d_intro')
    };
    i_upload_act('d_upload', post_data);
    return false;
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

function m_file_down() {
    i_mdi_open(i_act + 'a=file_down&x=' + m.xid + '', '列表--文件管理', 1);
}