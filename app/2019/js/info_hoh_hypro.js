


/**
 * 文件名称：info_hoh_hjpro.js
 * 功能描述：办理婚育证明功能的前台程序。
 * 代码作者：王争强、钱宝伟
 * 创建日期：2010-07-29
 * 修改时间：2010-07-29
 * 当前版本：v1.0
 */
//
//$(document).ready(function(){
//
//});

function m_load() {
    m_init_info_read();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_save').click(function(){
       window.parent.location.reload();
    });

     $('#btn_cancels').click(function(){
        parent.$('#iframe').hide();
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

function m_info_save_plug() {
    m.tmp = i_obj_val('d_yname');
    if ('' == m.tmp) {
        alert('业务名称不能为空！');
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
            i_obj_set('d_yname', '办理婚育证明');
        }
    });
}

function m_init_info_ytext_set(){
    var ytext = '';
    ytext +=  '操作员：' + i_obj_val('d_uname') + '；经办人：' + i_obj_val('d_bname')+ '；<br>';
    ytext +=  '经办人电话：' + i_obj_val('d_btel') + '；备注：' + i_obj_val('d_remark') + '；<br>';
    ytext += '办理时间：' + i_obj_val('d_time')+ '；<br>';
    i_obj_set('d_operating_record', ytext);
}