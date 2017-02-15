var t = {};
t.arrow_w = 1;
t.arrow_h = 1;

$(document).ready(function() {
    m_mdi_css_act();
    welcome_load();
    calendar_load();
    menu_load();
    read_type_list();

    $(window).bind("resize", function(){
        m_mdi_css_act();
    });    
    
    $('#mdi_splitter_arrow').click(function(){
        m_mdi_splitter_arrow();
    });

    $('#mdi_menuer_arrow').click(function(){
        m_mdi_arrow_h();
    });
});

function m_mdi_css_act() {
    if (t.win_height != $(window).height()) {
        t.win_height = $(window).height();
        m_mdi_middle_css_h();
    }
    
    if (t.win_width != $(window).width()) {
        t.win_width = $(window).width();
        m_mdi_middle_css_w();
    }
}

function m_mdi_middle_css_w() {
    $('#mdi_mainer').css({
        'width': (t.win_width - 180 * t.arrow_w - 7) + 'px'
    });
}

function m_mdi_middle_css_h() {
    $('#mdi_middle').css({
        'top': (64 * t.arrow_h + 32) + 'px',
        'height': (t.win_height - 64 * t.arrow_h - 64) + 'px'
    });
    $('#tab_con').css({
        'height': (t.win_height - 64 * t.arrow_h - 64 - 29) + 'px'
    });
}

function menu_load() {
    t.arr = $('#menu_bar SPAN');
    for (t.i=0; t.i<t.arr.length; t.i++) {
        t.tmp = t.arr.eq(t.i);
        t.tmp.css({
            'background-image':'url(../img/mdi_header_ico_'+ t.i +'.gif)'
        });
        t.tmp[0].id = t.i;
        t.tmp.click(function() {
            eval('menu_bar_'+ this.id +'()');
        });
    }
}

function welcome_load() {
    t.ws_id = i_cookie_get('ws_id');
    if (null != t.ws_id &&  '' != t.ws_id) {
        i_obj_get('img_sys_name').src = '../img/mdi_header_sys_name' + t.ws_id + '.gif';
    }
    $.ajax({
        url : g.act + 'mdi_header.php?' + 'a=read_user_info',
        success: function(text){
            if (text == '') {
                return;
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
                return;
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
    window.open('http://' + i_cookie_get('login_ws'));
}

function menu_bar_2() {
    parent.location.href = '/sys_app_0/6010/htm/logout.htm';
}
// mdi_header e


function m_mdi_splitter_arrow() {
    if(0 == t.arrow_w) {
        t.arrow_w = 1;
        i_obj_show('mdi_lefter');
    } else {
        t.arrow_w = 0;
        i_obj_hide('mdi_lefter');
    }
    m_mdi_splitter_arrow_css();
    m_mdi_middle_css_w();
}

function m_mdi_splitter_arrow_css() {
    $('#mdi_splitter').css({
        'left': 180 * t.arrow_w + 'px'
    });
    $('#mdi_splitter_arrow').css({
        'background-image': 'url(../img/mdi_splitter_arrow_'+ t.arrow_w +'.gif)'
    });
}
// mdi_splitter e

function m_mdi_arrow_h() {
    if(0 == t.arrow_h) {
        t.arrow_h = 1;
        i_obj_show('mdi_header');
    } else {
        t.arrow_h = 0;
        i_obj_hide('mdi_header');
    }
    m_mdi_arrow_h_css();
    m_mdi_middle_css_h();
}

function m_mdi_arrow_h_css() {
    $('#mdi_menuer').css({
        'top': 64 * t.arrow_h + 'px'
    });
    $('#mdi_menuer_arrow').css({
        'background-image': 'url(../img/mdi_menuer_arrow_'+ t.arrow_h +'.gif)'
    });
}

// mdi_lefter s
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
