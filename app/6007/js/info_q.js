/**
 * 文件名称：info_q.js
 * 功能描述：留言信息的信息控制器JS
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

}

function m_btn_load_plug() {
    $('#btn_reset').click(function(){
        i_obj_set('d_name', '');
        i_obj_set('d_q_name', '');
        i_obj_set('d_tel', '');
        i_obj_set('d_email', '');
        i_obj_set('d_addr', '');
        i_obj_set('d_q_intro', '');
     });
}

function m_info_set_plug() {

}

function m_info_add_plug() {
    //留言板模块的信息配置
    i_obj_set('d_ws_id', ws_id);  //配置信息的网站地址
    i_obj_set('d_ws_name', ws_name);  //配置信息的网站名称
    i_obj_set('d_drwx', '1');  //配置信息的回复状态drwx：留言/回复/隐藏状态：1, 2, 3

    i_obj_disable('d_atime');
    $('#d_name').addClass('info_must');
}

function m_info_edit_plug() {
    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_name', '留言标题不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_q_name');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_q_name', '留言者不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_q_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_email');
    if(m.tmp == '' || (m.tmp).length == 0){
        i_error_msg('d_error_email', '邮箱不能为空，请填写！',  '0');
        return false;
    } else {
        if (!i_verify_email(m.tmp)) {
            i_error_msg('d_error_email', '邮箱格式不正确，请您重新填写！',  '0');
            return false;
        } else {
            i_error_msg('d_error_email', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_q_intro');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_q_intro', '留言内容不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_q_intro', '通过', '2');
    }

    return true;
}

function m_act_url_plug() {
//    //触发生成留言列表
//    m_mk_msg_list('list_qa_all');
//    m_mk_msg_list('qa_all');
//    i_mdi_open('./list_qa_43_1.htm', '在线留言--列表', 1);
    return false;
}

//function m_mk_msg_list(param){
//    $.ajax({
//        url : g.act + 'www_mk.php?x=' + param,
//        success : function(txt){
//            if ('' == txt) {
//                alert(param + '完成！');
//            } else {
//                alert(param + '生成失败！');
//            }
//        }
//    });
//}
