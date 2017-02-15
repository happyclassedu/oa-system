/**
* 文件名称：jquery.c.js
* 功能描述：自定义的公用js函数隐藏版。
* 代码作者：孙振强
* 创建日期：2010-01-28
* 修改日期：2011-04-05
* 当前版本：V2.0
*/


/**
* get url key's value.
* @param key : url's key.
* @return value
*/
function i_get(key) {
    if ('' == key) {
        return '';
    } else {
        return $.query.get(key);
    }
}

/**
* Get DOM object by object's id.
* @param obj_id : object's id.
* @return DOM object
*/
function i_obj_get(obj_id) {
    return document.getElementById(obj_id);
}

/**
* Hide DOM object use css's display.
* @param obj_id : object's id.
*/
function i_obj_hide(obj_id) {
    var obj = i_obj_get(obj_id);
    if (typeof(obj) == 'object' && obj != null) {
        obj.style.display = 'none';
    }
}

/**
* Show DOM object use css's display.
* @param obj_id : object's id.
*/
function i_obj_show(obj_id) {
    var obj = i_obj_get(obj_id);
    if (typeof(obj) == 'object' && obj != null) {
        obj.style.display = 'block';
    }
}

/**
* Get DOM object's value.
* @param obj_id : object's id.
* @return string
*/
function i_obj_val(obj_id) {
    var obj = i_obj_get(obj_id);
    if (typeof(obj) == 'object' && obj != null) {
        if (/TD|TR|DIV|SPAN|UL|LI|H1|H2/.test(obj.nodeName)) {
            return obj.innerHTML;
        } else if(/text|select-one|hidden|button|password|checkbox|file/.test(obj.type)) {
            return obj.value;
        } else if (obj.type == 'radio') {
            obj = document.getElementsByName(obj_id);
            var i;
            for (i=0; i<obj.length; i++) {
                if(obj[i].checked == true) {
                    return  obj[i].value;
                }
            }
            return  '';
        } else {
            return  '';
        }
    } else {
        return  '';
    }
}

/**
* Set DOM object's value.
* @param obj_id : object's id.
* @param val : object's value.
* @return true or false
*/
function i_obj_set(obj_id, val) {
    var obj = i_obj_get(obj_id);
    if (typeof(obj) == 'object' && obj != null) {
        if (obj.type == 'radio') {
            obj = document.getElementsByName(obj_id);
            for (var i=0; i<obj.length; i++) {
                if(obj[i].value == val) obj[i].checked = true;
            }
        }
        else if(/text|select-one|hidden|button|password|checkbox|file/.test(obj.type)) {
            obj.value = val;
        } else {
            obj.innerHTML = val;
        }
        return true;
    } else {
        return false;
    }
}

// ---- 禁用object
function i_obj_disable(obj_id){
    var obj = i_obj_get(obj_id);
    if (typeof(obj) == 'object' && obj != null) {
        obj.disabled = true;
    }
}

// ---- 启用object
function i_obj_enable(obj_id){
    var obj = i_obj_get(obj_id);
    if (typeof(obj) == 'object' && obj != null) {
        obj.disabled = false;
    }
}

/**
* Delete sting's "space character". SBC/DBC case.
* @param str : sting.
* @return string
*/
function i_str_replace_space(str) {
    if (str != '') {
        return str.replace(/(\u3000)|(\s*)/g,"");
    } else {
        return '';
    }
}

/**
* AJAX GET
* @param obj_id : JavaScript's Array.
* @param url : get url.
* @param ajax_ok_func : ajax success function.
* @return array
*/
function i_ajax_get(obj_id, url, ajax_ok_func){
    var obj = i_obj_get(obj_id);
    if (!obj) {
        obj = document.createElement('div');  //创建一个DIV
        obj.id = obj_id;
        obj.className = 'hide';
        document.body.appendChild(obj); //把新建的DIV加到页面上
    }
    var xmlhttp;
    try{
        xmlhttp = new ActiveXObject('Msxml2.XMLHTTP');
    }catch(e){
        try{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }catch(e){
            try{
                xmlhttp = new XMLHttpRequest();
            }catch(e){}
        }
    }
    xmlhttp.open('GET', url, true);
    xmlhttp.setRequestHeader('If-Modified-Since', '0');
    xmlhttp.send(null);
    xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4){
            if(/200|304/.test(xmlhttp.status)) {
                i_obj_set(obj_id, xmlhttp.responseText);
                if ('' != ajax_ok_func) {
                    setTimeout(ajax_ok_func, 0);
                }
            }
        }
    }
}

/**
* AJAX POST
* @param obj_id : JavaScript's Array.
* @param url : get url.
* @param ajax_ok_func : ajax success function.
* @param post_val : post value.
* @return array
*/
function i_ajax_post(obj_id, url, ajax_ok_func, post_val){
    var obj = i_obj_get(obj_id);
    if (!obj) {
        obj = document.createElement('div');  //创建一个DIV
        obj.id = obj_id;
        obj.className = 'hide';
        document.body.appendChild(obj); //把新建的DIV加到页面上
    }
    var xmlhttp;
    try{
        xmlhttp = new ActiveXObject('Msxml2.XMLHTTP');
    }catch(e){
        try{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }catch(e){
            try{
                xmlhttp = new XMLHttpRequest();
            }catch(e){}
        }
    }
    xmlhttp.open('POST', url, true);
    xmlhttp.setRequestHeader('If-Modified-Since', '0');
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(post_val);
    xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4){
            if(/200|304/.test(xmlhttp.status)) {
                i_obj_set(obj_id, xmlhttp.responseText);
                if ('' != ajax_ok_func) {
                    setTimeout(ajax_ok_func, 0);
                }
            }
        }
    }
}

//禁止鼠标右键功能
function i_contextmenu_disable() {
    $(document).bind("contextmenu", function(e){
        return false;
    });
}

/**
* Transform JavaScript's String for strrev.
* @param str : JavaScript's String.
* @return str
*/
function i_strrev (str) {
    str = str+'';
    var grapheme_extend = /(.)([\uDC00-\uDFFF\u0300-\u036F\u0483-\u0489\u0591-\u05BD\u05BF\u05C1\u05C2\u05C4\u05C5\u05C7\u0610-\u061A\u064B-\u065E\u0670\u06D6-\u06DC\u06DE-\u06E4\u06E7\u06E8\u06EA-\u06ED\u0711\u0730-\u074A\u07A6-\u07B0\u07EB-\u07F3\u0901-\u0903\u093C\u093E-\u094D\u0951-\u0954\u0962\u0963\u0981-\u0983\u09BC\u09BE-\u09C4\u09C7\u09C8\u09CB-\u09CD\u09D7\u09E2\u09E3\u0A01-\u0A03\u0A3C\u0A3E-\u0A42\u0A47\u0A48\u0A4B-\u0A4D\u0A51\u0A70\u0A71\u0A75\u0A81-\u0A83\u0ABC\u0ABE-\u0AC5\u0AC7-\u0AC9\u0ACB-\u0ACD\u0AE2\u0AE3\u0B01-\u0B03\u0B3C\u0B3E-\u0B44\u0B47\u0B48\u0B4B-\u0B4D\u0B56\u0B57\u0B62\u0B63\u0B82\u0BBE-\u0BC2\u0BC6-\u0BC8\u0BCA-\u0BCD\u0BD7\u0C01-\u0C03\u0C3E-\u0C44\u0C46-\u0C48\u0C4A-\u0C4D\u0C55\u0C56\u0C62\u0C63\u0C82\u0C83\u0CBC\u0CBE-\u0CC4\u0CC6-\u0CC8\u0CCA-\u0CCD\u0CD5\u0CD6\u0CE2\u0CE3\u0D02\u0D03\u0D3E-\u0D44\u0D46-\u0D48\u0D4A-\u0D4D\u0D57\u0D62\u0D63\u0D82\u0D83\u0DCA\u0DCF-\u0DD4\u0DD6\u0DD8-\u0DDF\u0DF2\u0DF3\u0E31\u0E34-\u0E3A\u0E47-\u0E4E\u0EB1\u0EB4-\u0EB9\u0EBB\u0EBC\u0EC8-\u0ECD\u0F18\u0F19\u0F35\u0F37\u0F39\u0F3E\u0F3F\u0F71-\u0F84\u0F86\u0F87\u0F90-\u0F97\u0F99-\u0FBC\u0FC6\u102B-\u103E\u1056-\u1059\u105E-\u1060\u1062-\u1064\u1067-\u106D\u1071-\u1074\u1082-\u108D\u108F\u135F\u1712-\u1714\u1732-\u1734\u1752\u1753\u1772\u1773\u17B6-\u17D3\u17DD\u180B-\u180D\u18A9\u1920-\u192B\u1930-\u193B\u19B0-\u19C0\u19C8\u19C9\u1A17-\u1A1B\u1B00-\u1B04\u1B34-\u1B44\u1B6B-\u1B73\u1B80-\u1B82\u1BA1-\u1BAA\u1C24-\u1C37\u1DC0-\u1DE6\u1DFE\u1DFF\u20D0-\u20F0\u2DE0-\u2DFF\u302A-\u302F\u3099\u309A\uA66F-\uA672\uA67C\uA67D\uA802\uA806\uA80B\uA823-\uA827\uA880\uA881\uA8B4-\uA8C4\uA926-\uA92D\uA947-\uA953\uAA29-\uAA36\uAA43\uAA4C\uAA4D\uFB1E\uFE00-\uFE0F\uFE20-\uFE26])/g;
    str = str.replace(grapheme_extend, '$2$1');
    return str.split('').reverse().join('');
}


/**
* Transform JavaScript's Array for encodeURI.
* @param arr : JavaScript's Array.
* @return arr
*/
function i_arr4encode(arr) {
    if (typeof(arr) == 'underfined' || arr== null) {
        return '';
    } else if (typeof(arr) == 'string') {
        arr = encodeURIComponent(arr);
        return arr;
    }
    var key, val;
    for (key in arr) {
        val = arr[key];
        if (val == null) {
            arr[key] = '';
        }else if (typeof(val) == 'object') {
            arr[key] = i_arr4encode(val);
        } else {
            //            arr[key] = encodeURIComponent(encodeURIComponent(val));
            arr[key] = encodeURIComponent(val);
        }
    }
    return arr;
}

/**
* Transform JavaScript's Array for decode.
* @param arr : JavaScript's Array.
* @return arr
*/
function i_arr4decode(arr) {
    if (typeof(arr) == 'underfined' || arr== null) {
        return '';
    } else if (typeof(arr) == 'string') {
        arr = decodeURIComponent(arr);
        return arr;
    }
    var key, val;
    for (key in arr) {
        val = arr[key];
        if (val == null) {
            arr[key] = '';
        }else if (typeof(val) == 'object') {
            arr[key] = i_arr4decode(val);
        } else {
            arr[key] = decodeURIComponent(val);
        }
    }
    return arr;
}


/**
* Transform php's arr to js's arr.
* @param arr : php's arr.
* @return arr
*/
function i_json2js(arr) {
    if ('<hr>DB' == arr.substr(0, 6) || '<br />' == arr.substr(0, 6)) {
        alert(arr);
        return '';
    }

    if ('' == arr || null == arr) {
        return '';
    }
    arr = arr.replace(new RegExp('﻿'), '');
    //    arr = decodeURIComponent(arr);
    arr = php.parse(arr);
    return arr;
}


/**
* Transform js's arr to php's arr.
* @param arr : js's arr.
* @return str
*/
function i_js2json(arr) {
    if ('' == arr || null == arr) {
        return '';
    }
    arr = php.stringify(arr);
    //    arr = encodeURIComponent(arr);
    //    arr = encodeURIComponent(arr);
    return arr;
}


/**
* table's tr color.
* @param obj_arr : jquery's obj.
* @return none
*/
function i_tr_css(obj_arr) {
    var obj_tmp;
    for (var i=0; i<obj_arr.length; i++) {
        obj_tmp = obj_arr.eq(i);
        obj_tmp.addClass('tr_' + i%2);
        obj_tmp.mouseover(function(){
            $(this).addClass('tr_over');
        });
        obj_tmp.mouseout(function(){
            $(this).removeClass('tr_over');
        });
    }
    return true;
}


function i_mdi_open(url, title, type) {
    if (1 == type) {
        if (parent.mdi_open) {
            if ('' == title || 'undefined' == title || null == title) {
                title = 'title';
            }
            i_mdi_title(title);
        }
        window.location.href = url;
    } else {
        if (parent.mdi_open) {
            if ('' == title || 'undefined' == title || null == title) {
                title = 'title';
            }
            var url_pre;
            url_pre = window.location.href;
            url_pre = url_pre.substr(0, url_pre.lastIndexOf('/'));
            url = url_pre +'/'+ url;
            parent.mdi_open(url, title, '-2');
        } else {
            window.open(url);
        }
    }
}

function i_mdi_close() {
    if (parent.mdi_close) {
        parent.mdi_close();
    } else {
        window.close();
    }
}

function i_mdi_title(title) {
    if (parent.mdi_tab) {
        parent.mdi_tab.tab_chang_title(title);
    }
}

function i_upload(cfg) {
    if (!cfg.btn_img) {
        cfg.btn_img = g.src_base + 'img/uploadify.gif';
    }
    if (!cfg.auto) {
        cfg.auto = false;
    }
    if (!cfg.removeCompleted) {
        cfg.removeCompleted = true;
    }

    $(cfg.obj_id).uploadify({
        'uploader'   : g.src_base + 'img/uploadify.swf',
        'script'     : '../../../sys_act_' + g.dev + '/2031/act/info_file.php?a=info_add',
        'cancelImg'  : g.src_base + 'img/cancel.png',
        'scriptData' : cfg.data,
        'buttonImg'  : cfg.btn_img,
        'width'      : cfg.width,
        'height'     : cfg.height,
        'wmode'      : 'transparent',
        //        'auto'       : true,
        'multi'      : cfg.more,
        'fileExt'    : cfg.file_ext,
        'fileDesc'   : cfg.file_txt,
        'fileDataName' : 'file_data',
        'removeCompleted' : cfg.removeCompleted,
        onSelect : cfg.onSelect,
        onComplete : cfg.onComplete,
        onAllComplete : cfg.onAllComplete
    });
}

function i_upload_2(cfg) {
    return new SWFUpload({
        // act Settings
        upload_url: '../../../sys_act_' + g.dev + '/2031/act/info_file.php?a=info_add',

        // File Upload Settings
        file_post_name : "file_data",
        file_size_limit : cfg.file_size,  // 200 kb
        //        file_types : '*.*',
        //        file_types_description : 'All Files',
        file_types : cfg.file_type,
        file_types_description : cfg.file_type_desc,
        //file_types : "*.jpg;*.gif;*.png",
        //file_types_description : "Image Files",
        file_upload_limit : 200,
        file_queue_limit : 0,

        post_params : cfg.data,

        custom_settings : {
            progressTarget : cfg.obj_id_progress,
            cancelButtonId : cfg.obj_id_cancel
        },

        // Button Settings
        button_image_url : g.src_base + 'img/swfupload_btn_select.png',
        button_placeholder_id : cfg.obj_id,
        button_width: 110,
        button_height: 30,

        // Event Handler Settings (all my handlers are in the Handler.js file)
        swfupload_preload_handler : preLoad,
        swfupload_load_failed_handler : loadFailed,
        file_dialog_start_handler : fileDialogStart,
        file_queued_handler : fileQueued,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : cfg.upload_start,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : cfg.upload_success,
        upload_complete_handler : cfg.upload_complete,

        // Flash Settings
        flash_url : g.src_base + 'img/swfupload.swf',
        flash9_url : g.src_base + 'img/swfupload_fp9.swf',

        // Debug Settings
        debug: false
    });
}

function i_upload_act(obj_id, data) {
    $('#' + obj_id).uploadifySettings('scriptData', data);
    $('#' + obj_id).uploadifyUpload();
}

function i_date_now() {
    var tmp = new Date();
    return tmp.getYear() + '-' + (tmp.getMonth()*1+1) + '-' + tmp.getDate();
}

function i_file_size(tmp) {
    tmp = String(tmp)
    var lgth = tmp.length;
    if (9 < lgth) {
        tmp = Math.ceil(tmp/1024/1024/1024) + 'GB';
    }else if (6 < lgth) {
        tmp = Math.ceil(tmp/1024/1024) + 'MB';
    } else {
        tmp = Math.ceil(tmp/1024) + 'KB';
    }
    return tmp;
}

function i_box_open(cfg){
    if(Shadowbox){
        Shadowbox.init();
        Shadowbox.open({
            content: cfg.content,
            player: cfg.player||'html',
            title: cfg.title||'',
            width: cfg.width,
            height: cfg.height
        });
    }
}

function i_box_close(arr){
    if (this.m_box_close_plug) {
        m_box_close_plug(arr);
    }

    if(Shadowbox){
        Shadowbox.close();
    }
}

var i_tab_show = function(TagId, CntId, ShowNum, Tagtype, Cnttype){
    //TagId 标签容器ID，CntId 内容容器ID，ShowNum 初始化时显示第几个标签。
    var me = this;
    this.flag = ShowNum||0;
    Tagtype = Tagtype||'span';
    Cnttype = Cnttype||'div';
    var Tags = document.getElementById(TagId).getElementsByTagName(Tagtype);
    var TagsCnt=document.getElementById(CntId).getElementsByTagName(Cnttype);
    var Num = Tags.length;
    for (var i=0; i<Num; i++) {
        Tags[i].value = i;
        Tags[i].onmouseover = function(){
            changeNav(this.value)
        };
        Tags[i].className = '';
        TagsCnt[i].style.display = 'none';
    }
    Tags[this.flag].className='tab_show';
    TagsCnt[this.flag].style.display = 'block';
    function changeNav(v){
        Tags[me.flag].className='';
        TagsCnt[me.flag].style.display = 'none';
        me.flag = v;
        Tags[v].className = 'tab_show';
        TagsCnt[v].style.display = 'block';
    }
}

function i_verify_mobile(val) {
    var tmp = /^1[3-9]\d{9}$/.test(val);
    return tmp;
}

/**
* i_error_msg:错误提示
* param: id 表单id
* param: msg 提示内容
* param: type 类型：0代表有错误；1代表初始化表单提示内容
*/
function i_error_msg(id, msg, type){
    if('1' == type){
        i_obj_set(id, '' + msg);
        $("#" + id).css("color","#777777");
    } else if('0' == type) {
        i_obj_set(id, '<img src="../../app/img/bang.gif" align="absBottom">&nbsp;&nbsp;' + msg);
        $("#" + id).css("color","red");
    } else if('2' == type) {
        i_obj_set(id, '' + msg);
        $("#" + id).css("color","green");
    }
}

/**
* i_verify_ispwd
* 检查输入的密码格式是否正确
* 输入:str  字符串
* 返回:true 或 flase; true表示格式正确
*/
function i_verify_ispwd(str)
{
    if (str.match(/^(\w){6,20}$/) == null) {
        return false;
    }
    else {
        return true;
    }
}

/**
* 函数：i_verify_phone
* 检查输入的手机号码格式是否正确
* 输入:str  字符串
* 返回:true 或 flase; true表示格式正确
*/
function i_verify_phone(str){
    if (str.length != 11) {
        return false; //11位
    }
    else {
        return true;
    }
}

/**
* 函数：i_verify_tel
* 检查输入的固定电话号码是否正确
* 输入:str  字符串
* 返回:true 或 flase; true表示格式正确
*/
function i_verify_tel(str){
    if (str.length < 7) {
        return false;
    }
    else {
        return true;
    }
}

/**
* 函数i_verify_email：检查输入的邮箱格式是否正确
* param :str  字符串
* return:true 或 flase; true表示格式正确
*/
function i_verify_email(str){
    if (str.match(/[A-Za-z0-9_-]+[@](\S*)(net|com|cn|org|cc|tv|[0-9]{1,3})(\S*)/g) == null) {
        return false;
    }
    else {
        return true;
    }
}


/**
* 函数i_verify_qq：检查QQ的格式是否正确
* param:str  字符串
* return:true 或 flase; true表示格式正确
*/
function i_verify_qq(str){
    if (str.match(/^\d{5,10}$/) == null) {
        return false;
    }
    else {
        return true;
    }
}

/**
* 函数i_verify_post：检查输入的邮政编码格式是否正确
* param:str  字符串
* return:true 或 flase; true表示格式正确
*/
function i_verify_post(str){
    if (str.match(/^[0-9]{6,6}$/) == null) {
        return false;
    }
    else {
        return true;
    }
}

/**
* 函数i_verify_cardid：检查输入的身份证格式是否正确
* param:cardid 身份证号码；
* param:errorid 报错id；
* param:sex 性别表单id；
* param:birthid 生日表单id;
* return:true 或 flase; true表示格式正确
*/
function i_verify_cardid(cardid, errorid, sexid , birthid) {
    //	var cardid = "61052819840504062X";  //测试用例
    var check_result = i_verify_cid(i_obj_val(cardid));
    if (check_result!="ok") {
        i_error_msg(errorid, check_result, '0');
        return false;
    } else {

        i_error_msg(errorid, '通过', '2');
        if('' != sexid){
            i_cid_show_sex(i_obj_val(cardid), sexid);
        }

        if('' != birthid){
            i_cid_show_birthday(i_obj_val(cardid), birthid);
        }
    }
}


/**
* 函数i_verify_cid：检测身份证号码是否合法
* param:cardid  身份证号码；
* reutrn:errors 错误数组值。
*/
function i_verify_cid(cardid){  //检测身份证号码是否合法
    var errors= new Array(
        "ok",
        "身份证号码位数不对",
        "身份证号码出生日期超出范围或含有非法字符",
        "身份证号码校验错误",
        "身份证地区非法"
        );
    var area={
        11:"北京",
        12:"天津",
        13:"河北",
        14:"山西",
        15:"内蒙古",
        21:"辽宁",
        22:"吉林",
        23:"黑龙江",
        31:"上海",
        32:"江苏",
        33:"浙江",
        34:"安徽",
        35:"福建",
        36:"江西",
        37:"山东",
        41:"河南",
        42:"湖北",
        43:"湖南",
        44:"广东",
        45:"广西",
        46:"海南",
        50:"重庆",
        51:"四川",
        52:"贵州",
        53:"云南",
        54:"西藏",
        61:"陕西",
        62:"甘肃",
        63:"青海",
        64:"宁夏",
        65:"新疆",
        71:"台湾",
        81:"香港",
        82:"澳门",
        91:"国外"
    }

    var cardid,Y,JYM;
    var S,M;
    var cardid_array = new Array();
    cardid_array = cardid.split("");

    //地区检验
    if(area[parseInt(cardid.substr(0,2))]==null) return errors[4];

    //身份号码位数及格式检验
    switch(cardid.length){
        case 15:  //15位身份号码检测
            if ( (parseInt(cardid.substr(6,2))+1900) % 4 == 0 || ((parseInt(cardid.substr(6,2))+1900) % 100 == 0 && (parseInt(cardid.substr(6,2))+1900) % 4 == 0 )){
                ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/;//测试出生日期的合法性
            } else {
                ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/;//测试出生日期的合法性
            }

            if(ereg.test(cardid)) return errors[0];
            else return errors[2];
            break;
        case 18:  //18位身份号码检测
            if ( parseInt(cardid.substr(6,4)) % 4 == 0 || (parseInt(cardid.substr(6,4)) % 100 == 0 && parseInt(cardid.substr(6,4))%4 == 0 )){
                ereg=/^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/;//闰年出生日期的合法性正则表达式
            } else {
                ereg=/^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/;//平年出生日期的合法性正则表达式
            }

            if(ereg.test(cardid)){  //测试出生日期的合法性
                //计算校验位
                S = (parseInt(cardid_array[0]) + parseInt(cardid_array[10])) * 7
                + (parseInt(cardid_array[1]) + parseInt(cardid_array[11])) * 9
                + (parseInt(cardid_array[2]) + parseInt(cardid_array[12])) * 10
                + (parseInt(cardid_array[3]) + parseInt(cardid_array[13])) * 5
                + (parseInt(cardid_array[4]) + parseInt(cardid_array[14])) * 8
                + (parseInt(cardid_array[5]) + parseInt(cardid_array[15])) * 4
                + (parseInt(cardid_array[6]) + parseInt(cardid_array[16])) * 2
                + parseInt(cardid_array[7]) * 1
                + parseInt(cardid_array[8]) * 6
                + parseInt(cardid_array[9]) * 3 ;
                Y = S % 11;
                M = "F";
                JYM = "10X98765432";
                M = JYM.substr(Y,1);//判断校验位
                var cardid17 = cardid_array[17];
                if (cardid17=="x") cardid17="X";
                if(M == cardid17) return errors[0]; //检测ID的校验位
                else return errors[3];
            }
            else return errors[2];
            break;
        default:
            return errors[1];
            break;
    }
}

/**
* 函数i_cid_show_birthday：从身份证号码中读取出生年月日赋值到obj；
* param:cardid  字符串
* param:obj_name 出生日控件id
*/
function i_cid_show_birthday(cardid,obj_name) {  //从身份证号码中读取出生年月日赋值到obj
    var cid = cardid;
    var birthday;
    if(15==cid.length) { //15位身份证号码
        birthday = cid.charAt(6)+cid.charAt(7);
        if(parseInt(birthday)<28) {
            birthday = '20'+birthday;
        } else {
            birthday = '19'+birthday;
        }
        birthday = birthday+'-'+cid.charAt(8)+cid.charAt(9)+'-'+cid.charAt(10)+cid.charAt(11);
        i_obj_set(obj_name,birthday);   //调用外部函数

    }
    if(18==cid.length) { //18位身份证号码
        birthday = cid.charAt(6)+cid.charAt(7)+cid.charAt(8)+cid.charAt(9)+'-'+cid.charAt(10)+cid.charAt(11)+'-'+cid.charAt(12)+cid.charAt(13);
        i_obj_set(obj_name,birthday);   //调用外部函数
    }
}

/**
* 函数i_cid_show_sex：从身份证号码中读取性别赋值到obj
* param:cardid  字符串
* param：obj_name 性别控件id
*/
function i_cid_show_sex(cardid,obj_name) {  //从身份证号码中读取性别赋值到obj
    var cid = cardid;
    if(15==cid.length) { //15位身份证号码
        if(parseInt(cid.charAt(14)/2)*2!=cid.charAt(14)) {
            i_obj_set(obj_name, '男');  //调用外部函数
        } else {
            i_obj_set(obj_name, '女');  //调用外部函数
        }
    }
    if(18==cid.length) { //18位身份证号码
        if(parseInt(cid.charAt(16)/2)*2!=cid.charAt(16)) {
            i_obj_set(obj_name, '男'); //调用外部函数
        } else {
            i_obj_set(obj_name, '女');  //调用外部函数
        }
    }
}

/**
* 函数i_date_format：格式化函数；
* @param: str  当前日期；
* @param: fmt 格式化，例如："YY-mm-dd"等；
* @return: str;  2011-03-31 09:26:41
*/
function i_date_format(str, fmt){
    var arr = str.split(' ')
    var arr0 = arr[0].split('-');
    var arr1 = arr[1].split(':');
    str = '';
    switch (fmt) {
        case 'yyyy' :
            str = arr0[0];
            break;
        case 'yy' :
            str = arr0[0].substring(2, 4);
            break;
        case 'mm' :
            str = arr0[1];
            break;
        case 'dd' :
            str = arr0[2];
            break;
        case 'hh' :
            str = arr1[0];
            break;
        case 'ii' :
            str = arr1[1];
            break;
        case 'yyyy-mm-dd' :
            str = arr[0];
            break;
        case 'yyyy-mm' :
            str = arr[0].substring(0, 7);
            break;
        case 'mm-dd' :
            str = arr[0].substring(5, 10);
            break;
        case 'hh-ii-ss' :
            str = arr[1];
            break;
        default :
            alert('对不起，日期格式有误！');
            break;
    }
    return str;
}

/**
* 函数i_load_caroufredsel：图片滚动函数；
* @param: str  当前日期；
* @param: fmt 格式化，例如："YY-mm-dd"等；
* @return: str;  2011-03-31 09:26:41
*/
function i_load_caroufredsel() {
    i_read_js('jquery.caroufredsel', 0, 1);  //jquery插件，图片滚动控件，自己修改
}

/**
* 函数i_load_jcarousellite：图片滚动函数；
* @param: str  当前日期；
* @param: fmt 格式化，例如："YY-mm-dd"等；
* @return: str;  2011-03-31 09:26:41
*/
function i_load_jcarousellite() {
    i_read_js('jquery.jcarousellite', 0, 1);  //jquery插件，图片滚动控件，自己修改
}

/**
* 函数i_load_jmenu：引用菜单插件jmenu；
* @return: str;  2011-03-31 09:26:41
*/
function i_load_jmenu() {
    i_read_js('jquery.jmenu', 0, 1);  //jquery插件，图片滚动控件，自己修改
}

/**
* 函数i_sethome：设置主页函数；
* @param: obj  当前对象；
* @param: vrl  当前url；
* @return: 无返回值.
*/
function i_sethome(obj,vrl){
    try{
        obj.style.behavior='url(#default#homepage)';
        obj.setHomePage(vrl);
    }
    catch(e){
        if(window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            }
            catch (e){
                alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。");
            }
            var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
            prefs.setCharPref('browser.startup.homepage',vrl);
        }
    }
}

/**
* 函数i_addbookmark：加入收藏；
* @param: url  当前url；
* @param: title 标题；
* @return: 无返回值.
*/
function i_addbookmark(url, title) {
    //var url=parent.location.href;
    if (window.sidebar) {
        window.sidebar.addPanel(title, url, '');
    } else if( document.all ) {
        window.external.AddFavorite( url, title);
    } else if( window.opera && window.print ) {
        return;
    }
}

/**
* 函数：i_cookie_set，设置cookie；
* @param: key，键名；
* @param: val，键值；
* @param: day，有效天数；
* @param: path，作用路径；
* @param: g.cookie，全局变量；
* @param: g.cookie_exp，全局变量；
* @return: 无返回值.
*/
function i_cookie_set(key, val, day, path) {
    if (key) {
        g.cookie = key +'='+ escape(val);
    } else {
        return;
    }

    if (day && !isNaN(day)) {
        g.cookie_exp = new Date();
        g.cookie_exp.setTime(g.cookie_exp.getTime() + day*24*60*60*1000);
        g.cookie += ';expires='+ g.cookie_exp.toGMTString();
    }

    if (path) {
        g.cookie += ';path='+ path;
    }

    document.cookie = g.cookie;
}

/**
* 函数：i_cookie_get，获取cookie；
* @param: key，键名；
* @param: g.cookie_arr，全局变量；
* @return: 返回键值或null.
*/
function i_cookie_get(key) {
    g.cookie_arr = document.cookie.match(new RegExp("(^| )" + key + "=([^;]*)(;|$)"));
    if(g.cookie_arr != null) {
        return unescape(g.cookie_arr[2]);
    } else {
        return '';
    }
}

/**
* 函数：i_cookie_del，删除cookie；
* @param: key，键名；
* @param: path，作用路径；
* @return: 无返回值.
*/
function i_cookie_del(key, path) {
    i_cookie_set(key, '', '-1', path);
}

/**
 * Hide DOM ajax's box.
 */
function i_ajax_box_hide(){
    //    alert(g.ajax_box_hide + ':hide:' + window.location.pathname);
    if (!g.ajax_box_hide) {
        g.ajax_box_hide = '0';
    }
    
    if ('mdi' == parent.sys_type && '0' == g.ajax_box_hide) {
        g.ajax_box_hide = '1';
        parent.i_ajax_box_hide();
        return;
    }

    g.ajax_box_hide = '0';
    setTimeout('i_obj_hide("ajax_box")', 700);
}

/**
 * Show DOM ajax's box.
 * @param ajax_msg_title : msg's title.
 * @param ajax_msg_content : msg's content.
 */
function i_ajax_box_show(ajax_msg_title, ajax_msg_content){
    //    alert(g.ajax_box_show + ':show:' + window.location.pathname);
    if (!g.ajax_box_show) {
        g.ajax_box_show = '0';
    }
    
    if ('mdi' == parent.sys_type && '0' == g.ajax_box_show) {
        g.ajax_box_show = '1';
        parent.i_ajax_box_show(ajax_msg_title, ajax_msg_content);
        return;
    }

    g.ajax_box_show = '0';
    
    i_read_css('ajax_box', 0);  //ajax_box的css

    if ('' == ajax_msg_title || undefined == ajax_msg_title) {
        ajax_msg_title = '系统提示：';
    }

    if ('' == ajax_msg_content || undefined == ajax_msg_content) {
        ajax_msg_content = '正在读取，请等待……';
    }

    if (null == i_obj_get('ajax_box')) {
        g.ajax_box = document.createElement("div");
        g.ajax_box.id = 'ajax_box';
        g.ajax_box.innerHTML = '<div id="ajax_loading"><div id="ajax_msg_title">' + ajax_msg_title + '</div><div id="ajax_msg_content">' + ajax_msg_content + '</div></div>';
        document.body.appendChild(g.ajax_box);
    } else {
        i_obj_show('ajax_box');
        i_obj_set('ajax_msg_title', ajax_msg_title);
        i_obj_set('ajax_msg_content', ajax_msg_content);
    }
}