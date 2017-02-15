/**
 * 文件名称：info_a.js
 * 功能描述：回复信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */
var t = {};

$(document).ready(function(){
    t.app_code = i_cookie_get('app_code');
    if (null != t.app_code &&  '' != t.app_code) {
        document.location.href = '/sys_app_0/' + t.app_code + '/htm/www_mk.htm';
    }
});