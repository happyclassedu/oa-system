// mdi_header s
$(document).ready(function() {
    welcome_load();
    calendar_load();
    menu_load();
    read_type_list();
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
        url : g.act + 'mdi_header.php?' + 'a=read_user_info',
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
        url : g.act + 'mdi_header.php?' + 'a=read_calendar',
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
    mdi_open('mdi_mainer.htm', '我的桌面');
}

function menu_bar_1() {
    window.open('http://www.xalhrc.com');
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
    parent.location.href = '/sys_app_0/5010/htm/logout.htm';
}
// mdi_header e

// mdi_splitter s
var obj_arrow = document.getElementById('arrow');

obj_arrow.onclick = function(){
    mdi_splitter_arrow();
}

var mdi_splitter = 0;

function mdi_splitter_arrow() {
    if(mdi_splitter == 1) {
        mdi_splitter = 0;
        i_obj_show('mdi_lefter');
        document.getElementById('mdi_mainer').style.width = document.body.clientWidth - 187;

    } else {
        mdi_splitter = 1;
        i_obj_hide('mdi_lefter');
        document.getElementById('mdi_mainer').style.width = document.body.clientWidth - 7;
        obj_arrow.src="../img/mdi_splitter_arrow_r.gif";
    }
}
// mdi_splitter e

// mdi_lefter s

//$(document).ready(function() {
//    read_type_list();
//});

function menu_mouse_load() {
    var obj_arr, obj_tmp;
    obj_arr = $('.level1');
    for (var j=0; j<obj_arr.length; j++) {
        obj_tmp = obj_arr.eq(j);
        obj_tmp.click(function(){
            var url = this.id;
            if (this.id.indexOf('/') == '-1') {
                url = '/act/'+ this.id;
                mdi_open(url, this.innerText, '-1');
            }else {
                mdi_open(url, this.innerText, '-2');
            }
        });
        obj_tmp.mouseover(function(){
            $(this).css({
                'background-color':'#BBE9FF'
            });
        });
        obj_tmp.mouseout(function(){
            $(this).css({
                'background-color':'#FFFFFF'
            });
        });
    }
}

function menu_show_load() {
    var obj_arr, obj_tmp;
    obj_arr = $('.level0');
    for (var j=0; j<obj_arr.length; j++) {
        obj_tmp = obj_arr.eq(j);
        obj_tmp.click(function(){
            var state;
            state = $(this.firstChild)[0].state;
            if (state == 'none') {
                state = 'block';
            } else {
                state = 'none';
            }
            $(this.firstChild)[0].state = state;
            $(this.firstChild).css({
                'background-image':'url(../img/mdi_dot_'+ state +'.gif)'
            });
            $(this.nextSibling).css({
                'display': state
            });
        });
    }
}

function read_type_list() {
    $.ajax({
        url : g.act + 'mdi_lefter.php?' + 'a=read_type_list',
        success: function(txt){
            var arr = i_json2js(txt);
            var arr_list = arr['list'];
            var arr_info = arr['info'];
            var menu_text = '';


            var key, val, key2;
            for (key in arr_list) {
                menu_text += '<div class="level0"><span></span>'+ arr_list[key].cname +'</div><ul id="menu_'+ key +'">';
                arr = arr_info[key];
                for (key2 in arr) {
                    if (isNaN(key2)) continue;
                    menu_text += '<li class="level1" title="'+ arr[key2].intro +'" id="'+ arr[key2].url +'">'+ arr[key2].cname +'</li>';
                }
                menu_text += '</ul>';
            }
            i_obj_set('left_menu', menu_text);

            menu_show_load();
            menu_mouse_load();
        }
    });
}
// mdi_lefter e

i_read_js('mdi_tab');