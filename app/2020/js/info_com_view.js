/**
 * 文件名称：info_com_view.js
 * 功能描述：查看企业简介的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-18
 * 修改时间：2010-08-18
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//    });

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    
    i_read_js('function');
    m_init_info_read();
//    return false;  //可以终止初始化
}


//function m_btn_load_plug() {
//
//
//}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}


//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

//function m_info_save_plug() {
//
//    return true;
//}

function m_init_info_read(){
     $.ajax({
        url : i_act + 'a=info_read&x=' + m.xid,
        success : function(txt){
            m.arr= i_json2js(txt);
            i_obj_set('d_trades', m_arr2show(0, 1, m.arr['trade'], array_industry));
       }
   });
}
