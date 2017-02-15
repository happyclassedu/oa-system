/**
 * 文件名称：common.js
 * 功能描述：自定义的公用js函数。
 * 代码作者：孙振强
 * 创建日期：2010-01-28
 * 修改日期：2011-04-07
 * 当前版本：V1.0
*/

var g = {};
g.src_list = [];
if (!sys_type) {
    var sys_type = 'oa';
}

//if(!g.src_app){
//    g.src_app = 'http://app.opensmarty.com/'
//}

if ('www' == sys_type) {
    g.src_base = '../app/';
//    g.src_base = g.src_app;
} else if ('oa' == sys_type) {
    g.src_base = '../../1000/';
//    g.src_base = g.src_app + '1000/';
} else {
    g.src_base = '../../1000/';
//    g.src_base = g.src_app + '1000/';
}

/**
 * Read JS file for DOM.
 * @param src : JavaScript file's src.
 * @param dir : JavaScript file's dir.
 * @param way : JavaScript file's read type.
 */
function i_read_js(src, dir, way) {
    if (0 == dir) {
        src = g.src_base + 'js/' + src + '.js';
    } else if (1 == dir) {
        src = g.src_base + src + '.js';
    } else {
        src = '../js/' + src + '.js';
    }

    if(g.src_list[src]) {
        return;
    }


    if('0' == way) {
        document.write('<script src="' + src + '"><\/script>');
        g.src_list[src] = true;
    } else {
        try {
            if (!g.axo) {
                g.axo = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest();
            }
            g.axo.open('GET', src, false);
            g.axo.send(null);
            if(200 == g.axo.status || 0 == g.axo.status){
                if (window.execScript) {
                    window.execScript(g.axo.responseText);
                } else {
                    window.eval.call(window, g.axo.responseText);
                }
            }
            g.src_list[src] = true;
        } catch(e) {
            return;
        }
    }
}

/**
 * Read CSS file for DOM.
 * @param src : CSS file's src.
 * @param dir : CSS file's dir.
 */
function i_read_css(src, dir) {
    if (0 == dir) {
        src =g.src_base + 'css/' + src + '.css';
    } else if (1 == dir) {
        src = g.src_base + src + '.css';
    } else {
        src = '../css/' + src + '.css';
    }

    if(g.src_list[src]) {
        return;
    }

    if (!g.css_obj) {
        g.css_obj = document.createElement('link');
        g.css_obj.setAttribute('rel', 'stylesheet');
        g.css_obj.setAttribute('type', 'text/css');
    }

    g.css_obj.setAttribute('href', src);
    document.getElementsByTagName('head')[0].appendChild(g.css_obj.cloneNode(true));
    g.src_list[src] = true;
}

function i_error_kill() {
        return true;
}

window.onerror = i_error_kill;
////====下位自定义信息====/////====
i_read_js('jquery', 0, 0);  //jquery主框架js
i_read_js('jquery.php', 0, 0);  //php同js交互
i_read_js('jquery.query', 0, 0);  //jquery插件，获取get参数

i_read_css('common');  //当前模块公共css


switch (sys_type) {
    case 'base':
        i_read_js('jquery.b', 0, 0);  //自定义框架函数js
        i_read_js('jquery.c', 0, 0);  //自定义的一些初始化参数
        i_read_js('swfobject', 0, 0);  //swf播放js
        i_read_js('jquery.cookie', 0, 0);  //jquery插件，操作cookie
        i_read_js('jquery.uploadify', 0, 0);  //jquery插件，分页控件，自己修改
        i_read_js('jquery.jpage', 0, 0);  //jquery插件，分页控件，自己修改
        i_read_js('shadowbox', 0, 0);  //shadowbox，当前页面弹出框
        i_read_css('shadowbox', 0);  //框架shadowbox的css
        break;
    case 'jmyl':
        i_read_js('jquery.b', 0, 0);  //自定义框架函数js
        i_read_js('jquery.c', 0, 0);  //自定义的一些初始化参数
        i_read_js('jquery.cookie', 0, 0);  //jquery插件，操作cookie
        i_read_js('jquery.jpage', 0, 0);  //jquery插件，分页控件，自己修改
        i_read_js('shadowbox', 0, 0);  //shadowbox，当前页面弹出框
        i_read_css('shadowbox', 0);  //框架shadowbox的css
        break;
    case 'www':
        i_read_js('jquery.b', 0, 0);  //自定义框架函数js
        i_read_js('jquery.c', 0, 0);  //自定义的一些初始化参数
        i_read_js('swfobject', 0, 0);  //swf播放js
        i_read_js('jquery.cookie', 0, 0);  //jquery插件，操作cookie
        i_read_js('jquery.jdate', 0, 0);  //jquery插件，日历
        i_read_js('jquery.jpage', 0, 0);  //jquery插件，分页控件，自己修改
        i_read_js('jquery.pics', 0, 0);  //基于jquery的自定义函数，i_pics_player，用于图片幻灯播放
        i_read_js('jquery.uploadify', 0, 0);  //jquery插件，分页控件，自己修改
        i_read_js('shadowbox', 0, 0);  //shadowbox，当前页面弹出框
        i_read_css('shadowbox', 0);  //框架shadowbox的css
        break;
    case 'mdi':
        i_read_js('jquery.b', 0, 0);  //自定义框架函数js
        i_read_js('jquery.c', 0, 0);  //自定义的一些初始化参数
        break;
    case 'login':
        i_read_js('jquery.b', 0, 0);  //自定义框架函数js
        i_read_js('jquery.c', 0, 0);  //自定义的一些初始化参数
        break;
    default: case 'oa':
        i_read_js('jquery.b', 0, 0);  //自定义框架函数js
        i_read_js('jquery.c', 0, 0);  //自定义的一些初始化参数
        i_read_js('swfobject', 0, 0);  //swf播放js
        i_read_js('jquery.cookie', 0, 0);  //jquery插件，操作cookie
        i_read_js('jquery.ui', 0, 0);  //jquery插件，ui
        i_read_js('jquery.jdate', 0, 0);  //jquery插件，日历
        i_read_js('jquery.jpage', 0, 0);  //jquery插件，分页控件，自己修改
        i_read_js('jquery.uploadify', 0, 0);  //jquery插件，分页控件，自己修改
        i_read_js('ckeditor/ckeditor', 1, 0);  //ckeditor，编辑器控件，功能很强大
        i_read_js('jquery.ckeditor', 0, 0);  //jquery插件，调用ckeditor
        i_read_js('swfupload', 0, 0);  //swfupload，文件上传控件
        i_read_js('swfupload.queue', 0, 0);  //swfupload，文件上传控件
        i_read_js('swfupload.fileprogress', 0, 0);  //swfupload，文件上传控件
        i_read_js('swfupload.handlers', 0, 0);  //swfupload，文件上传控件
        i_read_css('jquery.ui', 0);  //框架jquery.ui的css
        i_read_js('shadowbox', 0, 0);  //shadowbox，当前页面弹出框
        i_read_css('shadowbox', 0);  //框架shadowbox的css
        break;
}