/**
 * 文件名称：info_hoh_jspro.js
 * 功能描述：办理计生证明功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-06
 * 修改时间：2010-08-06
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m_init_info_read();
//   return false;  //可以终止初始化
}


function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//
//    });

     $('#btn_cancels').click(function(){
        parent.$('#iframe').hide();
    });

     $('#d_getm_time').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_inbreed_birth_1').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_inbreed_birth_2').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_save').click();
        }
    });
}

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

function m_act_url_plug() {
    window.parent.location.reload();
    m.tmp = './info_hoh_print.htm?a=add&x=' + i_get('x');
    i_mdi_open(m.tmp);
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_yname');
    if ('' == m.tmp) {
        alert('请返回户籍婚育管理，设置婚育状态!');
        return false;
    }

    m.tmp = i_obj_val('d_inbreed_state');
    if ('' == m.tmp) {
        alert('婚育状态不能为空，请选择!');
        return false;
    }

    m.tmp = i_obj_val('d_iaddress');
    if ('' == m.tmp) {
        alert('户籍所在地不能为空，请选择!');
        return false;
    }
    
    m_init_info_ytext_set();
    return true;
}

function m_init_info_read() {
  $.ajax({
        url : i_act + 'a=info_init&x=' + m.xid,
        success : function(text){
            m.info = i_json2js(text);  
            i_obj_set('d_pid', m.info['pid']);
            i_obj_set('d_pname', m.info['pname']);
            i_obj_set('d_uid', m.info['uid']);
            i_obj_set('d_uname', m.info['uname']);
            i_obj_set('d_ytype', m.info['ytype']);
            i_obj_set('d_time', m.info['time']);
            i_obj_set('d_bname', m.info['pname']);
            i_obj_set('d_btel', m.info['mobile']);
            i_obj_set('d_inbreed_state', m.info['inbreed_state']);
            i_obj_set('d_iaddress', m.info['iaddress']);
            i_obj_set('d_getm_time', m.info['getm_time']);
            i_obj_set('d_getm_shop', m.info['getm_shop']);
            i_obj_set('d_inbreed_birth_1', m.info['inbreed_birth_1']);
            i_obj_set('d_inbreed_birth_2', m.info['inbreed_birth_2']);
            i_obj_set('d_iremake', m.info['iremake']);
            i_obj_set('d_yname', '办理计生证明');
       }
   });
}

function m_init_info_ytext_set(){
    var ytext = '';
    ytext +=  '婚育状态：' + i_obj_val('d_inbreed_state') + '；户籍所在地：' + i_obj_val('d_iaddress')+ '；<br>';
    ytext +=  '结婚时间：' + i_obj_val('d_getm_time') + '；生育一胎时间：' + i_obj_val('d_inbreed_birth_1')+ '；<br>';
    ytext +=  '生育二胎时间：' + i_obj_val('d_inbreed_birth_2') + '；经办人：' + i_obj_val('d_bname')+ '；<br>';
    ytext +=  '经办人电话：' + i_obj_val('d_btel') + '；备注：' + i_obj_val('d_iremake') + '；<br>';
    ytext += ';办理时间' + i_obj_val('d_time')+ ';<br>';
   i_obj_set('d_operating_record', ytext);
}