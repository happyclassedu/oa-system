/**
 * 文件名称：info_forum.js
 * 功能描述：留言信息的信息控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
var ws_id = '8';
var ws_name = '西安立丰集团';
var menu_id = '1514';
var menu_name = '业主论坛';
var anonymous = '0'; //0：非匿名；1：匿名

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
}

//function m_btn_load_plug() {
//}

function m_info_set_plug() {

}

function m_info_add_plug() {
    m_session_init();
//    m_creat_token();
    //留言板模块的信息配置
    i_obj_set('d_ws_id', ws_id);  //配置信息的网站地址
    i_obj_set('d_ws_name',ws_name);  //配置信息的网站名称
    i_obj_set('d_menu_id', menu_id);  //配置信息的菜单id
    i_obj_set('d_menu_name',menu_name);  //配置信息的菜单名称
    i_obj_set('d_anonymous', anonymous);  //是否匿名
}

//function m_info_edit_plug() {
//}

//function m_info_view_plug() {
//}

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


    m.tmp = i_obj_val('d_content');
    if ('' == m.tmp || (m.tmp).length == 0) {
        i_error_msg('d_error_content', '留言内容不能为空，请填写！', '0');
        return false;
    } else {
        i_error_msg('d_error_content', '通过', '2');
    }

    
    return true;
}

function m_act_url_plug() {
    return false;
}

function m_session_init(){
    $.ajax({
        url : g.act + 'session.php?a=session_vel_arr',
        success : function(txt){
            if('' != txt){
                m.tmp = i_json2js(txt);
                i_obj_set('d_u_id', m.tmp['id']);  //用户id
                i_obj_set('d_u_name',m.tmp['loginid']);  //用户账号
                return true;
            } else {
                i_mdi_open('./login.htm', '用户登录', 1);
                return false;
            }
        }
    });
}

//function m_creat_token() {
//    $.ajax({
//        url : i_act + 'a=creat_token',
//        success : function(txt){
//            if('' != txt){
//                i_obj_set('d_token', txt);  //唯一标签
//            } else {
//                alert('token标签生成错误：为空！');
//            }
//        }
//    });
//}