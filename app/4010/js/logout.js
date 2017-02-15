var ajax_loading = i_ajax_msg('系统提醒：', '正在退出登录，请稍等……');
i_ajax_box_show(ajax_loading);
////=============================================
$(document).ready(function() {
    logout_act();
});

function logout_act() {
    $.ajax({
        url : i_act + 'a=logout',
        success : function(txt){
            setTimeout('window.location.href = "login.htm";', 1300);
        },
        error : function(){
            ajax_loading = i_ajax_msg('系统提醒：登陆失败2！','对不起，登陆失败，请联系网络管理员。');
            i_ajax_box_show(ajax_loading);
            return false;
        }
    });
}