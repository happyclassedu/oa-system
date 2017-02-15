/**
* 文件名称：info_resume_c.js
* 功能描述：企业简历库的信息控制器JS
* 代码作者：王争强（创建）
* 创建时间：2010_11_18
* 修改时间：2010-11-18
* 当前版本：V1.0
*/

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = '';
    if ('' == m.xid) {
        m.xid = parseInt(Math.random()/3.1415926*10000000000);
    }
    m.file_update = m.xid;
    i_obj_disable('d_atime');
    i_obj_disable('d_etime');
    i_obj_disable('d_ws_id');

    $('#d_atime, #d_etime').addClass('info_readonly');
    i_upload({
        'obj_id' : '#d_upload',
        'file_ext' : ' *.doc;*.docx;*.xls;*.xlsx;*.zip;*.rar; ',
        onSelect : function(evt, queue_id, file_obj) {
            if('.docx' != file_obj.type && '.doc' != file_obj.type){
                alert("对不起, 这个文件格式不是.doc或.docx后缀, 系统无法上传！");
                return false;
            } else if (file_obj.size > 104857600) {
                alert("对不起, 这个文件超过100MB, 系统无法上传。");
                return false;
            }
        },
        onComplete  : function(evt, queue_id, file_obj, txt, data) {
        //            alert(file_obj.name + '文件上传成功！');
        }
    });
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_add_resume_c').click(function(){
        i_mdi_open( './info_resume_c.htm?a=add&ws_id=' + m.ws_id, '企业简历库--新增');
    });

    $('#d_birth').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_gradtime').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#btn_down').click(function(){
        m_file_down();
    });

}

//function m_info_set_plug() {
//}

function m_info_add_plug() {
    m.ws_id = i_get('ws_id');
    i_obj_hide('tr1');
    i_obj_hide('tr2');
    i_obj_disable('btn_down');
    i_obj_disable('btn_add_resume_c');
    i_obj_set('d_ws_id', m.ws_id);
    $('#d_name').addClass('info_must');

}

function m_info_edit_plug() {
    if('' == m.ws_id){
        m.ws_id = m.info['ws_id'];
    }

    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_act_url_plug() {
    $.ajax({
        url : g.act_doc + 'a=info_update&x=' + m.xid + '&old=' +  m.file_update,
        success : function(txt){
            m.file_update =  m.xid;
        }
    });
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    if ('' == i_obj_val('d_joba')) {
        alert('对不起，请输入应聘岗位！');
        $("#d_joba").focus();
        return false;
    }

    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入姓名！');
        $("#d_name").focus();
        return false;
    }

    var post_data  = {
        'd_xid' : m.xid,
        'd_xtb' : 'resume_c'
    };
    i_upload_act('d_upload', post_data);

    return true;
}

function m_file_down() {
    i_mdi_open(g.act_doc + 'a=file_down_ext1&x=' + m.xid + '&xtb=resume_c', '列表--简历下载', 1);
}