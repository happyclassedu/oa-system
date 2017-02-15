
/**
 * 文件名称：info_party_blog.js
 * 功能描述：党员票据管理功能的前台程序。
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
    m_load_disable();
    m_init();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#btn_save').click(function(){
       window.parent.location.reload();
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
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
        alert('业务名称不能为空！');
        return false;
    }

    m_init_info_ytext_set();
    return true;
}

function m_init(){
    i_obj_set('d_name', '党员票据管理');
    $.ajax({
        url : g.act + 'info_party.php?a=info_init',
        success : function(txt){
            m.info = i_json2js(txt);
            i_obj_set('d_uid', m.info['uid']);
            i_obj_set('d_uname', m.info['uname']);
            i_obj_set('d_i_type', m.info['i_type']);
        }
    });
}

function m_init_info_ytext_set(){
    var ytext = '';
    ytext +=  '票本编号：' + i_obj_val('d_i_txt0') + '；票据编号：' + i_obj_val('d_i_txt1') +  '；<br>';
    ytext +=  '总计：' + i_obj_val('d_i_txt2') + '；票本起止日期：' + i_obj_val('d_i_date0') + '至'+ i_obj_val('d_i_date1') + '；<br>';
     ytext +=  '备注：' + i_obj_val('d_remark') + '；<br>';
    i_obj_set('d_operating_record', ytext);
}

function m_load_disable(){
    i_obj_disable('d_name');
    i_obj_disable('d_uname');
    i_obj_disable('d_atime');
}
