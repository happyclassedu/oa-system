i_ajax_box_show('系统提醒：', '正在退出登录，请稍等……');
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
            i_ajax_box_show('系统提醒：退出失败2', '正在退出登录，请稍等……');
            return false;
        }
    });
}