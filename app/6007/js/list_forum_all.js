/**
 * 文件名称：list_forum_all.js
 * 功能描述：论坛信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_10_11
 * 修改时间：2010-11-15
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.ws_id = '8';
    m.fid = i_get('fid');
    m.xtb = $('.lt_all').clone(true);
    m_ssession_val();
    m_init(); //初始化数据
//    m_list_num_forum_all();
    m_list_num();
    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('.btn_replies').click(function(){
        i_mdi_open('./info_forum.htm?a=add', '发布主题', 1);
    });

    $('#btn_save').click(function(){
        m_info_save_add();
    });

     $('#btn_exit').click(function(){
        m_ssession_logout();
    });
}

function m_list_num() {
    $.ajax({
        url : i_act + 'a=list_num&ws_id=' + m.ws_id + '&fid=' + m.fid ,
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.info_num = txt;
//            alert( txt);
            m_jpage_forum_all_load();
        }
    });
}

function m_jpage_forum_all_load() {
    $('#jpage_box').jpage({
        info_all : m.info_num,
        show_num : m.show_num,
        page_skin : 'blue',
        page_act : function(show_num, page_now){
            m.show_num = show_num;
            m.page_now = page_now;
            m_list_read_forum_all();
        }
    });
}

function m_list_read_forum_all() {
    $.ajax({
        url : i_act + 'a=list_read&show_num=' + m.show_num + '&page_now=' + m.page_now + '&ws_id=' + m.ws_id + '&fid=' + m.fid ,
        data : 'val_search=' + m.val_search,
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_read_forum_all_set();
        }
    });
}

function m_list_read_forum_all_set() {
    $('#lt_info').html('');
    for(i=0; i<m.arr.length; i++) {
        m.xtb.find('.lt_user').html(m.arr[i]['u_name']);
        m.xtb.find('.lt_head h1').html(m.arr[i]['name']);
//        if('0' != m.arr[i]['fid']) {
//            $('.lt_head h1').hide();
//        } 
        m.xtb.find('.lt_head span').html(m.arr[i]['atime']);
        m.xtb.find('.lt_content').html(m.arr[i]['content']);
        $('#lt_info').append(m.xtb.clone(true));
    }
}


function m_info_save_add() {
    m.arr = new Object();
    
    m.tmp = i_obj_val('d_content');  
    if('' == m.tmp){
        alert('对不起，回复内容不能为空，请填写！');
        return false;
    }

//    i_obj_set('d_content', i_js2json(m.tmp));

    $('#lt_hf input, #lt_hf textarea').each(function() {
        m.tmp = i_obj_val(this.id);
        if ('' != m.tmp) {
            m.arr[this.id.substr(2)] = m.tmp;
        }
    });

    m.tmp = '';
    for (i in m.arr) {
        m.tmp = i;
        break;
    }

    $.ajax({
        url : g.act + 'info_forum.php?a=info_add',
        data : 'arr=' + i_js2json(m.arr),
        success : function(txt){
            if (txt > 0) {
                alert('保存成功！');
                m_list_num();
            } else {
                alert('保存失败！');
            }
        }
    });
    return true;
}

function m_init(){
    i_obj_set('d_fid', m.fid);  //配置信息的网站地址
    i_obj_set('d_ws_id', m.ws_id);  //配置信息的网站地址
    i_obj_set('d_ws_name','西安立丰集团');  //配置信息的网站名称
    i_obj_set('d_menu_id', '1514');  //配置信息的菜单id
    i_obj_set('d_menu_name', '业主论坛');  //配置信息的菜单名称
    i_obj_set('d_anonymous', '0');  //0：非匿名；1：匿名

    $.ajax({
        url : g.act + 'session.php?a=session_vel_arr',
        success : function(txt){
            if('' != txt){
                m.tmp = i_json2js(txt);
//                alert(m.tmp['id'] + m.tmp['loginid']);
                i_obj_set('d_u_id', m.tmp['id']);  //用户id
                i_obj_set('d_u_name',m.tmp['loginid']);  //用户账号
                return true;
            } else {
                i_mdi_open('./login.htm', '用户登录', 1);
                return false;
            }
        }
    });

    $.ajax({
        url : i_act + 'a=info_read&x=' + m.fid,
        success : function(txt){
            if('' != txt){
                m.tmp = i_json2js(txt);
                $('#lt_dh a').eq(2).html(m.tmp['name']);
            }
        }
    });
}

function m_ssession_val(){
    $.ajax({
        url : g.act + 'info_login.php?a=session_val',
        success : function(txt){
            var arr = i_json2js(txt);
            if('' != arr){
                $("#lt_search a").html(arr['ws_uname']);
            } else {
                i_mdi_open('./login.htm', '登录管理' , 1);
            }
        }
    });
}

function m_ssession_logout(){
    $.ajax({
        url : g.act + 'info_login.php?a=session_logout',
        success : function(txt){
            if('1' == txt){
                i_mdi_open('./login.htm', '登录管理' , 1);
            } else {
                alert('对不起，退出失败！');
            }
        }
    });
}