/**
 * 文件名称：info_job_look.js
 * 功能描述：查看职位的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */
var cid = '';
var pid = '';
//$(document).ready(function(){
//
//});
function m_load() {
    cid = i_get('cid');
    m_get_session();
    m_info_com_get();
    m_info_job_get();
//    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
     $('#a_com_intro').click(function(){
         i_mdi_open('./info_com_look.htm?a=view&x=' + cid + '&jid=' + m.xid, '浏览职位--公司简介', 1);
     });

     $('#a_job_app').click(function(){
        var array = new Array();
        array['0'] = m.xid;
        $('#a_job_app').attr('href', './info_job_eavoritd.htm?a=add&p_id=' + pid + '&arr=' + i_js2json(array));
     });

     $('#a_info_resume').click(function(){
        $('#a_info_resume').attr('href', './info_resume.htm?a=add&p_id=' + pid);
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

//function m_act_url_plug() {
//    window.location.reload();
//    return false;  //可以终止跳转
//}

//function m_info_save_plug() {
//    return true;
//}

//function m_error_init(){
//
//}


function m_get_session(){
    $.ajax({
        url : g.act + 'info_person.php?a=info_session',
        success : function(txt){
            pid = txt;
            if('' != pid){
                i_obj_hide('contact_show0');
            } else {
                i_obj_hide('contact_show1');
                i_obj_hide('contact_show2');
            }
        }
    });
}

function m_info_com_get(){
    $.ajax({
        url : i_act + 'a=' + 'info_com&x=' + cid,
        success : function(txt){
            m.arr = i_json2js(txt);
            i_obj_set('d_fname', m.arr['fname']);
            i_obj_set('d_pnum', m_arr2show(0, 1, m.arr['pnum'], array_scale));
            i_obj_set('d_type', m.arr['type']);
            i_obj_set('d_trades', m_arr2show(0, 1, m.arr['trade'], array_industry));
        }
    });
}

function m_info_job_get(){
    $.ajax({
        url : i_act + 'a=info_read&x=' + m.xid,
        success : function(txt){
            m.arr = i_json2js(txt);
            i_obj_set('d_name', m.arr['name']);
            i_obj_set('d_job_name', m.arr['name']);
            i_obj_set('d_type2', m.arr['type2']);
            i_obj_set('d_pay', m.arr['pay']);
            i_obj_set('d_begin', m.arr['begin']);
            i_obj_set('d_end', m.arr['end']);
            i_obj_set('d_degree', m.arr['degree']);
            i_obj_set('d_history', m.arr['history']);
            i_obj_set('d_age_1', m.arr['age_1']);
            i_obj_set('d_sex', m.arr['sex']);
            i_obj_set('d_langsign', m.arr['langsign']);
            i_obj_set('d_rgift', m.arr['rgift']);
            i_obj_set('d_addr1s', m_arr2show(0, 1, m.arr['addr1'], array_province));
            i_obj_set('d_addr2s', m_arr2show(0, 2, m.arr['addr2'], array_city));
            i_obj_set('d_intro', m.arr['intro']);
            i_obj_set('d_linkman', m.arr['linkman']);
            i_obj_set('d_tel', m.arr['tel']);
            i_obj_set('d_fax', m.arr['fax']);
            i_obj_set('d_email', m.arr['email']);
            i_obj_set('d_postcode', m.arr['postcode']);
            i_obj_set('d_address', m.arr['address']);
            i_obj_set('d_testaddr', m.arr['testaddr']);
            if('0' == m.arr['num']){
                i_obj_set('d_num', '若干');
            } else {
                i_obj_set('d_num', m.arr['num']);
            }

            i_obj_set('d_big_classifications', m_arr2show(0, 1, m.arr['big_classification'], array_occupation));
            i_obj_set('d_small_classifications', m_arr2show(0, 2, m.arr['small_classification'], array_job));
        }
    });
}

