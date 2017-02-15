/**
 * 文件名称：jquery.c.js
 * 功能描述：自定义的公用js函数隐藏版。
 * 代码作者：孙振强
 * 创建日期：2010-01-28
 * 修改日期：2010-01-28
 * 当前版本：V1.0
*/

g.url = window.location.pathname;

g.dev = g.url.substr(9, 1);
g.app_code = g.url.substr(11, 4);
g.img = '/doc/';
var g_id = i_obj_val('g_id');
var g_type = g_id.substr(0, g_id.indexOf('_'));
g.act = '../act/';
g.act_doc = '../../../sys_act_' + g.dev + '/2031/act/info_file.php?';
var i_act = g.act + g_id + '.php?';

if ('www' == sys_type) {
    if ('info' == g_type || 'list' == g_type) {
        i_read_js('m_' + g_type, 0, 0);
    ////    i_read_css('m_' + g_type, 0);
    }
    i_read_js('www_func', 3, 0);
    g.id_www = i_obj_val('g_id_www');
    if ('' != g.id_www) {
        i_read_js('www_' + g.id_www, 3, 0);
    }
} else {
    g.id_name = g_id.substr(g_id.indexOf('_')+1);
    g.act = '../../../sys_act_' + g.dev + '/' + g.app_code + '/act/';
    g.act_doc = '../../../sys_act_' + g.dev + '/2031/act/info_file.php?';
    i_act = g.act + g_id + '.php?';
    if ('info' == g_type || 'list' == g_type) {
        i_read_js('m_' + g_type, 0, 0);
        i_read_css('m_' + g_type, 0, 0);
    }
    i_contextmenu_disable();
    i_read_css('common', 0);  //框架公共css
}

if ('' != g_id) {
    i_read_js(g_id, 3, 0);
    i_read_css(g_id);
}