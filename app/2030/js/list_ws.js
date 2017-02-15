/**
 * 文件名称：list_ws.js
 * 功能描述：网站信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

//function m_load() {
////    return false;  //可以终止初始化
//}

//function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
//}

function m_list_read_btn_plug() {
    $('.btn_www').click(function(){
        i = this.parentNode.parentNode.id;
        window.open(m.arr[i]['url']);
    });

    $('.btn_list_menu').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_menu.htm?ws_id=' + m.arr[i]['id'], '查看列表--网站栏目');
    });

    $('.btn_list_link').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_link.htm?ws_id=' + m.arr[i]['id'], '查看列表--链接信息');
    });

    $('.btn_list_qa').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_q.htm?ws_id=' + m.arr[i]['id'], '查看列表--问题信息');
    });
    
    $('.btn_list_news').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_news.htm?ws_id=' + m.arr[i]['id'], '查看列表--新闻信息');
    });

    $('.btn_info_news_add').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./info_news.htm?a=add&ws_id=' + m.arr[i]['id'], '查看信息--新闻信息');
    });

    $('.btn_list_alipay').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_alipay.htm?ws_id=' + m.arr[i]['id'], '查看列表--支付宝接口信息');
    });

    $('.btn_info_alipay').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./info_alipay.htm?a=add&ws_id=' + m.arr[i]['id'], '查看信息--支付宝接口信息');
    });

     $('.btn_list_forum').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_forum.htm?ws_id=' + m.arr[i]['id'], '查看列表--浏览帖子信息');
    });

    $('.btn_info_forum').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./info_forum.htm?a=add&ws_id=' + m.arr[i]['id'], '查看信息--发布帖子信息');
    });
    
     $('.btn_list_resume_c').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_resume_c.htm?ws_id=' + m.arr[i]['id'], '查看列表--简历库管理v1');
    });
    
     $('.btn_list_resume').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('../../2003/htm/index_i.htm?ws_id=' + m.arr[i]['id'], '查看列表--简历库管理v1');
    }); 
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['name_s']);
    m.xtr.children(':eq(1)').attr('title', m.arr[i]['name']);
    m.xtr.children(':eq(2)').html(m.arr[i]['domain']);
}