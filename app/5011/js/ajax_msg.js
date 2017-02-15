document.createStyleSheet("../css/ajax_msg.css");
function ajax_msg(ajax_msg_title, ajax_msg_content) {
    var ajax_msg;
    ajax_msg = '<div class="ajax_msg_box"><div class="ajax_msg_title_box"><span class="ajax_msg_title_box_left"></span><span class="ajax_msg_title">' + ajax_msg_title + '</span><span class="ajax_msg_title_box_right"></span></div><div class="ajax_msg_content"><span>' + ajax_msg_content + '</span></div><div class="ajax_msg_footer"></div></div>';
    return ajax_msg;
}