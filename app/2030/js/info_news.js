/**
 * 文件名称：info_news.js
 * 功能描述：新闻信息的信息控制器JS
 * 代码作者：孙振强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.check_state = '0';  //检查状态
    m.check_obj_id = '';  //检查对象id
    m.arr_menu = '';  //栏目信息数组
    m.arr_file = '';  //栏目信息数组
    m.ws_id = '';
    m.file_img = ', gif, jpg, jpeg, png, bmp, ';
    if ('' == m.xid) {
        m.xid = parseInt(Math.random()/3.1415926*10000000000);
    }
    m.file_update = m.xid;

    i_obj_disable('d_atime');
    i_obj_disable('d_etime');
    i_obj_disable('d_hits');
    i_obj_disable('d_id');
    $('#d_remark').ckeditor();

    m_file_act();
    m_list_read_file();
}

function m_file_act() {
    m.xtr = $('#list_tb_file tbody tr:eq(0)').clone(true);
    $('#list_tb_file tbody').html('');
    m.file_up_haha = i_upload_2({
        'obj_id' : 't_upload',
        'obj_id_progress' : 't_upload_progress',
        'obj_id_cancel' : 't_upload_cancel',
        'file_size' : '204800', //20M
        'file_type' : '*.*;',
//        'file_type' : '*.jpg;*.gif;*.png;*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.pdf;*.rar;*.zip;*.swf;*.txt;*.js;*.css;*.flv;',
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
    $('#btn_add_news').click(function(){
        i_mdi_open( './info_news.htm?a=add&ws_id=' + m.ws_id, '新闻信息--新增');
    });

    //    $('#d_name').blur(function(){
    //        m.check_obj_id = this.id;
    //        m_info_name_check();
    //    });

    $("#d_istop").click(function(){
        if($("#d_istop").attr("checked") == true){
            i_obj_set('d_istop', '1');
        } else {
            i_obj_set('d_istop', '0');
        }
    })

    $("#d_isstar").click(function(){
        if($("#d_isstar").attr("checked") == true){
            i_obj_set('d_isstar', '1');
        } else {
            i_obj_set('d_isstar', '0');
        }
    })

    $('#d_menu_id').change(function(){
        i_obj_set('d_menu_name', this.options[this.selectedIndex].text);
    });
    
    $('.btn_insert_thumb').click(function(){
        i = this.parentNode.parentNode.id;
        if (0 < m.file_img.indexOf(m.arr_file[i].file_type)) {
            i_obj_set('d_img', m.arr_file[i].img);
            i_obj_set('t_img_name', m.arr_file[i].img);
            i_obj_get('t_img_show').src = g.img + m.arr_file[i].img;

            i_obj_show('t_img_box');
        } else {
            alert('文件格式不符：' + m.arr_file[i].file_type);
        }
    });

    $('.btn_insert_img').click(function(){
        i = this.parentNode.parentNode.id;
        if (0 < m.file_img.indexOf(m.arr_file[i].file_type)) {
            m.tmp = '<p class="doc_img"><img src="' + g.img + m.arr_file[i].img + '" /></p>';
            $('#d_remark').ckeditorGet().insertHtml(m.tmp);
        } else if ('js' == m.arr_file[i].file_type) {
            alert(m.arr_file[i].file_type + '123');
            m.tmp = '<script type="text/javascript" src="' + g.img + m.arr_file[i].img + '"></' + 'script>';
            $('#d_remark').ckeditorGet().insertHtml('<p script type="text/javascript" src=">123</p>');
            alert('对不起，');
        } else if ('css' == m.arr_file[i].file_type) {
            m.tmp = '<link type="text/css" rel="stylesheet" href="' + g.img + m.arr_file[i].img + '" />';
            $('#d_remark').ckeditorGet().insertHtml(m.tmp);
        } else if ('swf' == m.arr_file[i].file_type) {
            m.tmp = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"><param name="quality" value="high" /><param name="movie" value="' + g.img + m.arr_file[i].img + '" /><embed pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="' + g.img + m.arr_file[i].img + '" type="application/x-shockwave-flash"></embed></object>';
            $('#d_remark').ckeditorGet().insertHtml(m.tmp);
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
            $('#d_remark').ckeditorGet().insertHtml(m.tmp);
        } else {
            alert('对不起，该附件不属于可应用文件。');
        }
    });
    
    $('.btn_insert_doc').click(function(){
        i = this.parentNode.parentNode.id;
        m.tmp = '<p class="doc_down_box"><a class="doc_down" href="' + m.arr_file[i].doc_id + '" name="' + m.arr_file[i].file_type + '"><img src="../img/down.gif" />附件下载：' + m.arr_file[i].name + '.' + m.arr_file[i].file_type + '</a></p>';
        $('#d_remark').ckeditorGet().insertHtml(m.tmp);
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

    $('#d_name').change(function(){
        if ('' != this.value && '' == i_obj_val('d_name_s')) {
            i_obj_set('d_name_s', this.value);
        }
    });
}

function m_info_set_plug() {
    m.ws_id = m.info['ws_id'];
    if ('edit' == m.act) {
        m_menu_read();
    }
    m.tmp = decodeURIComponent(m.info['remark']);
    $('#d_remark').ckeditorGet().setData(m.tmp);

    if ('' != m.info['img']) {
        i_obj_set('t_img_name', m.info['img']);
        i_obj_get('t_img_show').src = g.img + m.info['img'];
        i_obj_show('t_img_box');
    } else {
        i_obj_hide('t_img_box');
    }
}

function m_info_add_plug() {
    m.ws_id = i_get('ws_id');
    if ('' === m.ws_id || isNaN(m.ws_id)) {
        alert('操作错误，正在关闭！');
        i_mdi_close();
    }
    m_menu_read();
    $('#tr_atime').hide();
    i_obj_show('t_upload_box');

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

    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入文章标题！');
        return false;
    }

    if ('1' == m.check_state) {
        alert('对不起：数据库中已存在相同值！');
        return false;
    }

    m.tmp = $('#d_remark').ckeditorGet().getData();
    m.tmp = encodeURIComponent(encodeURIComponent(m.tmp));
//    alert(m.tmp);
//        return false;
    i_obj_set('d_remark', m.tmp);
    i_obj_set('d_ws_id', m.ws_id);
    return true;
}

function m_info_del_fail(arr) {
    if (0 == arr) {
        alert('删除：“' + m.info['name'] + '”失败！');
    }
}

function m_info_name_check() {
    m.arr = i_obj_val(m.check_obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&x=' + m.xid + '&obj_id=' + m.check_obj_id.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check_state = '1';
                    alert('对不起：数据库中已存在相同值！');
                    $('#' + m.check_obj_id).focus();
                } else {
                    m.check_state = '0';
                }
            }
        });
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
        url : g.act + 'list_menu.php?a=list_read4news&ws_id=' + m.ws_id,
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
                i_mdi_open('./info_news.htm?a=add&ws_id=' + m.ws_id , '发布信息--新增', 1);
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