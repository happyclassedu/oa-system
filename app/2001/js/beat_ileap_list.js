/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var act;
var xid;

$(document).ready(function(){
    act = i_get('a');
    xid = i_get('x');
    if("eidt"==act){
        i_obj_set('i_save_info', '修改');
        i_obj_hide('hidetable');
        i_beat_ileap_info(xid);

    }
});

function i_beat_ileap_info(xid){
    $.ajax({
        url:i_act+'a=beat_ileap_list&='+xid,
        success:function(text){
            g_arr = i_php_js(text);

            i_obj_set('i_ileap_code',g_arr['ileap_code']);
            i_obj_set('i_ileap_name',g_arr['ileap_name']);
            i_obj_set('i_sxe',g_arr['sxe']);
            i_obj_set('i_minzu',g_arr['minzu']);
            i_obj_set('i_birth',g_arr['birth']);
            i_obj_set('i_cardid',g_arr['cardid']);
            i_obj_set('i_degree',g_arr['degree']);
            i_obj_set('i_univ',g_arr['univ']);
            i_obj_set('i_major',g_arr['major']);
            i_obj_set('i_job_name',g_arr['job_name']);
            i_obj_set('i_job_type',g_arr['job_type']);
            i_obj_set('i_job_addr',g_arr['job_addr']);
        }
    });
}

function i_beat_ileap_eidt(){
    xid=i_get('x');
    var g_arr = new array();

     g_arr['0'] =  i_obj_val('i_ileap_code');
    g_arr['1'] =  i_obj_val('i_ileap_name');
    g_arr['2'] =  i_obj_val('i_sex');
    g_arr['3'] =  i_obj_val('i_minzu');
    g_arr['4'] =  i_obj_val('i_birth');
    g_arr['5'] =  i_obj_val('i_cardid');
    g_arr['6'] =  i_obj_val('i_degree');
    g_arr['7'] =  i_obj_val('i_univ');
    g_arr['8'] =  i_obj_val('i_major');
    g_arr['9'] =  i_obj_val('i_job_name');
    g_arr['10'] =  i_obj_val('i_job_type');
    g_arr['11'] =  i_obj_val('i_job_addr');
    g_arr['12'] =  i_obj_val('i_age');
    g_arr['13'] =  i_obj_val('i_jcard_addr');
    g_arr['14'] =  i_obj_val('i_remark');
    g_arr['15'] =  i_obj_val('i_file');
    g_arr['16'] =  i_obj_val('i_tel');
    g_arr['17'] =  i_obj_val('i_mobil');
    g_arr['18'] =  i_obj_val('i_qq');
    g_arr['19'] =  i_obj_val('i_email');
    g_arr['20'] =  i_obj_val('i_addr');
    g_arr['21'] =  i_obj_val('i_postal');

    g_arr = i_json2js( g_arr);

    $.ajax({
        url:i_act+'a=beat_ileap_eidt&x='+xid ,
        data:'g_arr='+g_arr,
        success:function (text){
            alert(text);
        }
    });
}