/**
 * 文件名称：info_hoh_print.js
 * 功能描述：打印计生证明功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-06
 * 修改时间：2010-08-06
 * 当前版本：v1.0
 */

$(document).ready(function(){
//    m.arr = i_get('arr');
//    m.arr= i_json2js(m.arr);
//    alert(m.arr);
});

function m_load() {
    m_init_info_read();
//   return false;  //可以终止初始化
}
//function m_info_set_plug() {
//
//}

function m_init_info_read() {
  $.ajax({
        url : i_act + 'a=info_init&x=' + m.xid,
        success : function(txt){
            m.info = i_json2js(txt);
            i_obj_set('d_cname', m.info['pname']);
            i_obj_set('d_sex', m.info['sex']);
            i_obj_set('d_minzu', m.info['minzu']);
            i_obj_set('d_cardid', m.info['cardid']);
            i_obj_set('d_getm_time', m.info['getm_time']);
            i_obj_set('d_getm_shop', m.info['getm_shop']);
            i_obj_set('d_inbreed_birth_1', m.info['inbreed_birth_1']);
            i_obj_set('d_inbreed_state', m.info['inbreed_state']);
            i_obj_set('d_time', (m.info['time']).substr(0, 10));
            i_obj_set('d_iremake',m.info['iremake']) ;

            if('未婚' == m.info['inbreed_state']){
                i_obj_hide('li_hidden_1');
                i_obj_hide('li_hidden_2');
                i_obj_hide('li_hidden_3');
            } else if('初婚未育' == m.info['inbreed_state']) {
                i_obj_hide('li_hidden_3');
            } else if('已婚已育' == m.info['inbreed_state']) {

            }

            m_print();
       }
   });
}

function m_print(){
    window.print();
    i_mdi_close();
}

