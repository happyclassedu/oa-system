/**
 * 文件名称：info_resume.js
 * 功能描述：简历信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
var ws_id = '8';
var ws_name = '西安立丰集团';

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    if ('' == m.xid) {
        m.xid = parseInt(Math.random()/3.1415926*10000000000);
    }
    m.file_update = m.xid;
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
    $('#d_birth').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_gradtime').jdate({
        dateFormat: 'yy-mm-dd'
    });
}

function m_info_set_plug() {

}

function m_info_add_plug() {
    //留言板模块的信息配置
    i_obj_set('d_ws_id', ws_id);  //配置信息的网站地址
    i_obj_set('d_ws_name', ws_name);  //配置信息的网站名称
}

function m_info_edit_plug() {
}

function m_info_view_plug() {
}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_joba');
    if ('' == m.tmp || (m.tmp).length == 0) {
        alert('应聘职位不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp || (m.tmp).length == 0) {
        alert('姓名不能为空，请填写！');
        return false;
    }

     var post_data  = {
        'd_xid' : m.xid,
        'd_xtb' : 'resume_c'
    };
    i_upload_act('d_upload', post_data);

    return true;
}

function m_act_url_plug() {
    $.ajax({
        url : g.act_doc + 'a=info_update&x=' + m.xid + '&old=' +  m.file_update,
        success : function(txt){
            m.file_update =  m.xid;
        }
    });
    return false;
}