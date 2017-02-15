/**
 * 文件名称：lianhuren_admin.js
 * 功能描述：“莲湖英才网”--管理主页。
 * 代码作者：孙振强（创建）
 * 创建日期：2010-06-30
 * 修改日期：2010-06-30
 * 当前版本：V1.0
 */

var act;
var i_arr;
var i_tmp;

$(document).ready(function(){
    tools_btn_load();
});

function tools_btn_load() {
    $('#btn_svn_update').click(function(){
        svn_update();
    });
}

function svn_update() {
    i_obj_set('result_title', '正在执行……');
    i_obj_set('result_content', '');
    $.ajax({
        url : i_act + 'a=svn_update',
        success : function(text){
            i_arr = i_json2js(text);
            i_obj_set('result_content', i_arr.return_str);
            if (i_arr.result_val == '') {
                i_obj_set('result_title', '执行成功');
            }
        }
    });
}
