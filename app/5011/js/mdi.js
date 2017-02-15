//var ajax_loading = i_ajax_msg('系统提醒：', '正在打开，请稍等……');
////=============================================
//i_ajax_box_show(ajax_loading);
$(document).ready(function() {
    i_read_css('../css/mdi.css');
    i_obj_get('header').src = 'mdi_header.htm';
    i_obj_get('lefter').src = 'mdi_lefter.htm';
    i_obj_get('splitter').src = 'mdi_splitter.htm';
    i_obj_get('mainer').src = 'mdi_tab.htm';
    i_obj_get('footer').src = 'mdi_footer.htm';
//    i$ajax_box_hide();
});
////=============================================

function mdi_open(url, title, type) {
    mainer.mdi_open(url, title, type);
    return true;
}