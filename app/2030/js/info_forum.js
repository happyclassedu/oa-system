/**
 * 文件名称：info_forum.js
 * 功能描述：论坛信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.arr_menu = '';  //栏目信息数组
    m.arr_file = '';  //栏目信息数组
    m.ws_id = '';
    m.fid = '';
    m.atr = $('#list_answer tbody tr:eq(0)').clone(true);
    m.file_img = ', gif, jpg, jpeg, png, bmp, ';
    if ('' == m.xid) {
        m.xid = parseInt(Math.random()/3.1415926*10000000000);
    }
    m.file_update = m.xid;

    i_obj_disable('d_atime');
    i_obj_disable('d_etime');
    i_obj_disable('d_hits');
    i_obj_disable('d_id');
    i_obj_disable('d_fid');
    i_obj_hide('info_answer');
    i_obj_hide('list_answer');
    i_obj_hide('tb_1');
    
    $('#d_content').ckeditor();

    m_file_act();
    m_list_read_file();
}

function m_file_act() {
    m.xtr = $('#list_tb_file tbody tr:eq(0)').clone(true);
    $('#list_tb_file tbody').html('');
    m.file_up_haha = i_upload({
        'obj_id' : 't_upload',
        'obj_id_progress' : 't_upload_progress',
        'obj_id_cancel' : 't_upload_cancel',
        'file_size' : '204800', //20M
        'file_type' : '*.jpg;*.gif;*.png;*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.pdf;*.rar;*.zip;*.swf;*.txt;*.js;*.css;*.flv;',
        'file_type_desc' : '附件文件',
        'data' : {
            'd_xid' : m.xid,
            'd_xtb' : 'news'
        },
        upload_start : function () {
            i_obj_show('t_upload_progress');
        },
        upload_success : function (file_obj, txt) {
            i_obj_hide('t_upload_progress');
            m.arr = i_json2js(txt);
            i = m.arr_file.length;
            m.arr_file[i] = m.arr;
            m.arr.list_id = i;
            m_list_read_file_set();
        }

    });
}

function m_btn_load_plug() {
    $('#btn_add_forum').click(function(){
        i_mdi_open( './info_forum.htm?a=add&ws_id=' + m.ws_id, '论坛信息--新增');
    });
    
    $('#btn_add_answer').click(function(){
        i_mdi_open( './info_forum.htm?a=add&ws_id=' + m.ws_id + '&fid=' + m.xid, '论坛信息--回复');
    });

    $('#d_menu_id').change(function(){
        i_obj_set('d_menu_name', this.options[this.selectedIndex].text);
    });

    $('.btn_insert_img').click(function(){
        i = this.parentNode.parentNode.id;
        if (0 < m.file_img.indexOf(m.arr_file[i].file_type)) {
            m.tmp = '<p class="doc_img"><img src="' + g.img + m.arr_file[i].img + '" /></p>';
            $('#d_content').ckeditorGet().insertHtml(m.tmp);
        } else if ('js' == m.arr_file[i].file_type) {
            alert(m.arr_file[i].file_type + '123');
            m.tmp = '<script type="text/javascript" src="' + g.img + m.arr_file[i].img + '"></' + 'script>';
            $('#d_content').ckeditorGet().insertHtml('<p script type="text/javascript" src=">123</p>');
            alert('对不起，');
        } else if ('css' == m.arr_file[i].file_type) {
            m.tmp = '<link type="text/css" rel="stylesheet" href="' + g.img + m.arr_file[i].img + '" />';
            $('#d_content').ckeditorGet().insertHtml(m.tmp);
        } else if ('swf' == m.arr_file[i].file_type) {
            m.tmp = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"><param name="quality" value="high" /><param name="movie" value="' + g.img + m.arr_file[i].img + '" /><embed pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="' + g.img + m.arr_file[i].img + '" type="application/x-shockwave-flash"></embed></object>';
            $('#d_content').ckeditorGet().insertHtml(m.tmp);
        } else if ('flv' == m.arr_file[i].file_type) {
            var flv = {};
            flv.width = '268';
            flv.height = '177';
            flv.player_path = '/app/img/player_flv.swf';
            flv.texts='';
            flv.files = g.img + m.arr_file[i].img;
            flv.cfg = '0:自动播放|1:连续播放|100:默认音量|0:控制栏位置|2:控制栏显示|0x000033:主体颜色|60:主体透明度|0x66ff00:光晕颜色|0xffffff:图标颜色|0xffffff:文字颜色|:logo文字|:logo地址|:结束swf地址';
            m.tmp = '';
            m.tmp += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ flv.width +'" height="'+ flv.height +'">';
            m.tmp += '<param name="movie" value="' + flv.player_path + '"><param name="quality" value="high">';
            m.tmp += '<param name="menu" value="false"><param name=wmode value="opaque">';
            m.tmp += '<param name="FlashVars" value="vcastr_file=' + flv.files + '&vcastr_title=' + flv.texts + '&vcastr_config=' + flv.cfg + '">';
            m.tmp += '<embed src="' + flv.player_path + '" wmode="opaque" FlashVars="vcastr_file=' + flv.files + '&vcastr_title=' + flv.texts + '&vcastr_config=' + flv.cfg + '" menu="false" quality="high" width="' + flv.width + '" height="' + flv.height + '" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';
            m.tmp += '</object>';
            $('#d_content').ckeditorGet().insertHtml(m.tmp);
        } else {
            alert('对不起，该附件不属于可应用文件。');
        }
    });
    
    $('.btn_insert_doc').click(function(){
        i = this.parentNode.parentNode.id;
        m.tmp = '<p class="doc_down_box"><a class="doc_down" href="' + m.arr_file[i].doc_id + '" name="' + m.arr_file[i].file_type + '"><img src="../img/down.gif" />附件下载：' + m.arr_file[i].name + '.' + m.arr_file[i].file_type + '</a></p>';
        $('#d_content').ckeditorGet().insertHtml(m.tmp);
    });

    $('.btn_del').click(function(){
        i = this.parentNode.parentNode.id;
        if (true != confirm('确定要删除“' + m.arr_file[i].name + '.' + m.arr_file[i].file_type + '”吗？')) {
            return;
        }

        $.ajax({
            url : g.act_doc + 'a=file_del4news&x=' + m.arr_file[i].doc_id + '&p_j=arr',
            success : function(txt){
                if (txt > 0) {
                    $('.doc_id_' + txt).remove();
                } else {
                    alert('对不起，删除失败！');
                }

            }
        });
    });

    $('.btn_down').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open(g.act_doc + 'a=file_down&x=' + m.arr_file[i].doc_id + '', '', 1);
    });
    
}

function m_info_set_plug() {
    m.ws_id = m.info['ws_id'];
    if ('edit' == m.act) {
        m_menu_read();
    }

    if('0'!=m.fid){
        i_obj_hide('tr_2');
//        i_obj_hide('info_answer');
        i_obj_disable('btn_add_answer');
    }
    m.tmp = i_json2js(m.info['content']);
    $('#d_content').ckeditorGet().setData(m.tmp);
}

function m_info_add_plug() {
    m.ws_id = i_get('ws_id');
    m.fid = i_get('fid');
    if('' != m.fid){
        m_info_num();
        i_obj_show('info_answer');
        i_obj_show('list_answer');
        i_obj_show('tb_1');
        i_obj_set('d_fid', m.fid);
        i_obj_hide('tr_2');
        m_info_answer(m.fid);
    }
    
    if ('' === m.ws_id || isNaN(m.ws_id)) {
        alert('操作错误，正在关闭！');
        i_mdi_close();
    }
    m_menu_read();
    $('#tr_atime').hide();
    $('#tr_1').hide();
    i_obj_show('t_upload_box');
    i_obj_disable('btn_add_answer');
    i_obj_set('d_u_id', '0');  //用例测试
    i_obj_set('d_u_name', '管理员');  //用例测试
    i_obj_hide('d_menu_name');
    i_obj_show('d_menu_id');
    $('#d_name').addClass('info_must');
}

function m_info_edit_plug() {
    $('.btn_del, .btn_insert_thumb, .btn_insert_img, .btn_insert_doc').show();
    m_menu_read();
    $('#tr_atime').hide();
    i_obj_show('t_upload_box');
    i_obj_hide('d_menu_name');
    i_obj_show('d_menu_id');
    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    $('.btn_del, .btn_insert_thumb, .btn_insert_img, .btn_insert_doc').hide();
    $('#tr_atime').show();
    i_obj_hide('t_upload_box');
    i_obj_hide('d_menu_id');
    i_obj_show('d_menu_name');
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_menu_id')) {
        alert('对不起，所属栏目必须选择！');
        $("#d_menu_id").focus();
        return false;
    }

//    if ('' == i_obj_val('d_name')) {
//        alert('对不起，请输入主题！');
//        return false;
//    }

    m.tmp = $('#d_content').ckeditorGet().getData();
//    m.tmp = i_js2json(m.tmp);
    i_obj_set('d_content', m.tmp);
    i_obj_set('d_ws_id', m.ws_id);
    return true;
}

function m_info_del_fail(arr) {
    if (0 == arr) {
        alert('删除：“' + m.info['name'] + '”失败！');
    }
}

function m_list_read_file() {
    if ('' != m.arr_file || 'add' == m.act) {
        if ('add' == m.act) {
            m.arr_file = new Array();
        }
        return false;
    }

    $.ajax({
        url : g.act_doc + 'a=list_read_file&x=' + m.xid,
        success : function(txt){
            m.arr_file = i_json2js(txt);
            for(i=0; i<m.arr_file.length; i++) {
                m.arr = m.arr_file[i];
                m.arr.list_id = i;
                m_list_read_file_set();
            }
            if ('view' == m.act) {
                $('.btn_del, .btn_insert_thumb, .btn_insert_img, .btn_insert_doc').hide();
            }
        }
    });
}

function m_list_read_file_set() {
    m.xtr.attr('id',  m.arr.list_id);
    m.xtr.attr('class',  'doc_id_' + m.arr.id);
    m.xtr.attr('scr', m.arr.scr);
    m.xtr.attr('img', m.arr.img);
    m.xtr.children(':eq(0)').html(m.arr.file_type);
    m.xtr.children(':eq(1)').html(m.arr.name + '.' + m.arr.file_type);
    m.xtr.children(':eq(2)').html(i_file_size(m.arr.file_size));
    m.xtr.children(':eq(3)').html(m.arr.img);
    $('#list_tb_file tbody').append(m.xtr.clone(true));
}


/*
 * 栏目数据获取函数：m_menu_read
 * 相关变量：m.ws_id
 * 相关变量：m.arr_menu
 */
function m_menu_read() {
    if ('' != m.arr_menu || '' === m.ws_id) {
        return false;
    }

    i_obj_set('d_menu_id', '');

    $.ajax({
        url : g.act + 'list_menu.php?a=list_read4forum&ws_id=' + m.ws_id,
        success : function(txt){
            m.arr_menu = i_json2js(txt);
            m_menu_set();
        }
    });
}


function m_menu_set(){
    m.tmp = '';
    m.tmp += '<option value="" selected="selected">请选择--栏目分类</option>';
    for(i=0; i<m.arr_menu.length; i++) {
        m.tmp += '<option value="'+ m.arr_menu[i]['id'] +'">'+ m.arr_menu[i]['name'] + '</option>';
    }
    $('#d_menu_id').html('');
    $('#d_menu_id').append(m.tmp);

    if ('' != m.info) {
        i_obj_set('d_menu_id', m.info['menu_id']);
    }
}

function m_act_url_plug() {
    if (m.file_update == m.xid || '' == $('#list_tb_file tbody').html()) {
        m.act_url = i_obj_val('act_url');
        switch (m.act_url) {
            case 'add':
                i_mdi_open('./info_forum.htm?a=add&ws_id=' + m.ws_id , '论坛信息--新增', 1);
                return false;  //可以终止跳转
                break;
        }
        return true;
    }

    $.ajax({
        url : g.act_doc + 'a=info_update&x=' + m.xid + '&old=' +  m.file_update,
        success : function(txt){
            m.file_update =  m.xid;
            m_act_url();
        }
    });

    return false;
}

function m_info_answer(xid) {
    $.ajax({
        url : i_act + 'a=info_read&x=' + xid,
        success : function(txt){
            m.arr = i_json2js(txt);
            $("#i_name").html(m.arr['name']);
            $("#i_menu_name").html(m.arr['menu_name']);
            $("#i_content").html(m.arr['content']);
            $("#i_u_name").html(m.arr['u_name']);
            $("#i_hits").html(m.arr['hits']);
            $("#i_atime").html(m.arr['atime']);
        }
    });
}

/******************回复列表 start******************/
function m_info_num() {
    $.ajax({
        url : i_act + 'a=list_num&ws_id=' + m.ws_id + '&fid=' + m.fid,
        success : function(txt){
            m_jpage_load(txt);
        }
    });
}

function m_jpage_load(info_num) {
    $('#jpage_box').jpage({
        info_all : info_num,
        show_num : '10',
        page_skin : 'blue',
        page_act : m_list_read
    });
}

m_list_read = function(show_num, page_now) {
    $.ajax({
        url : i_act + 'a=list_read&show_num=' + show_num + '&page_now=' + page_now + '&ws_id=' + m.ws_id + '&fid=' + m.fid,
        success : function(text){
            m.arr = i_json2js(text);  //将php文件进行解密，并返回到js
            m_read_list_val();
            m_read_list_btn();
            i_tr_css($('#list_answer tbody tr'));
        }
    });
}

function m_read_list_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.atr.attr('id', i);
        m.atr.children(':eq(0)').html(i + 1);
        m.atr.children(':eq(1)').html(m.arr[i]['name'] +  '/' + m.arr[i]['menu_name'] +'/'  + i_json2js(m.arr[i]['content']));
        var str_drwx = '';
        if('0' == m.arr[i]['drwx']) {
            str_drwx = '完全公开';//完全公开
        } else if('1' == m.arr[i]['drwx']){
            str_drwx = '站内公开';//站内公开
        } else if('2' == m.arr[i]['drwx']) {
            str_drwx = '后台公开';//后台公开
        } else if('3' == m.arr[i]['drwx']) {
            str_drwx = '彻底关闭';//彻底关闭
        }
        m.atr.children(':eq(2)').html(str_drwx);
        m.atr.children(':eq(3)').html(m.arr[i]['u_name']);
        m.atr.children(':eq(4)').html(m.arr[i]['hits']);
        m.atr.children(':eq(5)').html(m.arr[i]['atime']);
        m.atr.children(':eq(6)').html('#' + (i+1));
        m.tmp += m.atr.parents().html();
    }
    $('#list_answer tbody').html(m.tmp);
}

function m_read_list_btn() {
    $('.btn_edit_answer').click(function(){
        var i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        i_mdi_open('./info_forum.htm?a=edit&x=' + m.xid,'论坛信息--修改回复', 1);
    });
    $('.btn_del_answer').click(function(){
        m.tmp = '';
        var i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        m_info_del_answer();
    });
}


function m_info_del_answer() {
    if (confirm('确定要删除“' + m.tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + m.xid ,
            success : function(text){
                if(text > 0)
                {
                    m_info_num();
                } else {
                    alert('删除' + m.xid + '失败！');
                }
            }
        });
    }
}
/************回复列表 end**************/