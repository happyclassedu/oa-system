/**
* 文件名称：list_stat.js
* 功能描述： 户籍信息统计表的前台程序。
* 代码作者：钱宝伟、王争强
* 创建日期：2010-07-29
* 修改日期：2010-07-29
* 当前版本：V1.0
*/

//$(document).ready(function(){
//
//});

function m_load() {
    m.info = '';
    m_list_stat_read();
    return false;
}

function m_btn_load_plug() {

//     $('#btn_search').click(function(){
//          m_list_stat_read();
//    });
//
//    $('#d_fee_s').jdate({
//        dateFormat: 'yy-mm-dd'
//    });
//
//    $('#d_fee_e').jdate({
//        dateFormat: 'yy-mm-dd'
//    });
}

//function m_list_read_set_plug() {
//
//}

function m_list_stat_read(){
    $.ajax({
        url : i_act + 'a=info_stat',
        success : function(text){
            m.info  = i_json2js(text);
            m_list_set_val();
        i_obj_show('list_tb');
        }
    });
}

function m_list_set_val(){
    for(i = 0 ; i< 12 ; i++){
        for(j = 0 ;j < 3 ; j++){
            i_obj_set('d_' + i + '_' + j, m.info[i][j]);
        }
    }
}
