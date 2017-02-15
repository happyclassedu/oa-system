$(document).ready(function() {
    welcome_load();
    calendar_load();
    menu_load();
});

function menu_load() {
    var obj_arr, obj_tmp;
    obj_arr = $('#menu_bar SPAN');
    for (var j=0; j<obj_arr.length; j++) {
        obj_tmp = obj_arr.eq(j);
        obj_tmp.css({
            'background-image':'url(../img/mdi_header_ico_'+ j +'.gif)'
        });
        obj_tmp[0].id = j;
        obj_tmp.click(function() {
            var i = this.id;
            eval('menu_bar_'+ i +'()');
        });
    }
}

function welcome_load() {
    $.ajax({
        url : i_act + 'a=read_user_info',
        success: function(text){
            if (text == '') {
                return false;
            }
            i_obj_set('welcome_box', text);
        }
    });
}

function calendar_load() {
    $.ajax({
        url : i_act + 'a=read_calendar',
        success: function(text){
            if (text == '') {
                return false;
            }
            i_obj_get('calendar_box').firstChild.innerHTML = text;
            setInterval("i_obj_get('calendar_box').lastChild.innerHTML = new Date().toLocaleTimeString();",1000);
        }
    });
}

function menu_bar_0() {
    parent.mdi_open('mdi_mainer.htm', '我的桌面');
}

function menu_bar_1() {
    parent.location.href = '/sys_app_0/4010/htm/logout.htm';
}

function menu_bar_2() {
    window.open('http://www.lianhuren.com');
}

function menu_bar_3() {
    window.open('http://www.sqwgw.com');
}

function menu_bar_4() {
    window.open('http://mail.xalhrc.com');
}

function menu_bar_5() {
    window.open('http://www.xalhrc.com');
}