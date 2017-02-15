

/**
 * 文件名称：info_hoh_hjcard.js
 * 功能描述：独生证明功能的前台程序。
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
//    $('#btn_save').click(function(){
//
//    });

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

function m_act_url_plug() {
    window.parent.location.reload();
    return false;  //可以终止跳转
}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_yname');
    if ('' == m.tmp) {
        alert('请返回户籍婚育管理，设置户籍证状态!');
        return false;
    }

    m.tmp = i_obj_val('d_hj_lend_state');
    if ('' == m.tmp) {
        alert('业务事项不能为空，请选择!');
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
            if('在库' == m.info['hjstate'] || '' == m.info['hjstate']) {
                i_obj_set('d_yname', '借出户籍卡');
            } else if('借出' == m.info['hjstate']) {
                i_obj_set('d_yname', '归还户籍卡');
            }
        }
    });
}

function m_init_info_ytext_set(){
    var ytext = '';
    ytext +=  '操作员：' + i_obj_val('d_uname') + '；经办人：' + i_obj_val('d_bname')+ '；<br>';
    ytext +=  '经办人电话：' + i_obj_val('d_btel') + '；业务事项：' + i_obj_val('d_hj_lend_state') + '；<br>';
    ytext += '办理时间：' + i_obj_val('d_time')+ '；备注：' + i_obj_val('d_remark')+ '；<br>';
    i_obj_set('d_operating_record', ytext);
}