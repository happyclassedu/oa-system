i_ajax_box_show('系统提醒：', '正在打开，请稍等……');
var u = {};
var t = {};
t.arrow_w = 1;
t.arrow_h = 1;

$(document).ready(function() {
    m_mdi_css_act();
    m_btn_load();
    m_mdi_load();
});

function m_btn_load() {
    $(window).bind("resize", function(){
        m_mdi_css_act();
    });

    $('#mdi_splitter_arrow').click(function(){
        m_mdi_splitter_arrow();
    });

    $('#mdi_menuer_arrow').click(function(){
        m_mdi_arrow_h();
    });
}

function m_mdi_css_act() {
    if (t.win_h != $(window).height()) {
        t.win_h = $(window).height();
        m_mdi_css_h();
    }
    
    if (t.win_w != $(window).width()) {
        t.win_w = $(window).width();
        m_mdi_css_w();
    }
}

function m_mdi_css_w() {
    $('#mdi_mainer').css({
        'width': (t.win_w - 180 * t.arrow_w - 7) + 'px'
    });
}

function m_mdi_css_h() {
    $('#mdi_middle').css({
        'top': (64 * t.arrow_h + 32) + 'px',
        'height': (t.win_h - 64 * t.arrow_h - 64) + 'px'
    });
    
    $('#tab_con').css({
        'height': (t.win_h - 64 * t.arrow_h - 64 - 29) + 'px'
    });
}

function m_mdi_splitter_arrow() {
    if(0 == t.arrow_w) {
        t.arrow_w = 1;
        i_obj_show('mdi_lefter');
    } else {
        t.arrow_w = 0;
        i_obj_hide('mdi_lefter');
    }
    m_mdi_splitter_arrow_css();
    m_mdi_css_w();
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
    m_mdi_css_h();
}

function m_mdi_arrow_h_css() {
    $('#mdi_menuer').css({
        'top': 64 * t.arrow_h + 'px'
    });
    $('#mdi_menuer_arrow').css({
        'background-image': 'url(../img/mdi_menuer_arrow_'+ t.arrow_h +'.gif)'
    });
}

function m_mdi_load() {
    $.ajax({
        url : i_act + 'a=mdi_load',
        success: function(txt){
            if ('' == txt || undefined == txt) {
                return;
            } else {
                t.arr = i_json2js(txt);
                u = t.arr['user'];
                t.date = t.arr['date'];
                t.menu = t.arr['menu'];
                t.arr = '';
                m_menu_load();
                m_data_load();
                m_welcome_load();
                menu_set();
            }
        }
    });
}

function m_menu_load() {
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

function m_welcome_load() {
    t.welcome = u['name'];
    
    if ('男' == u['sex']) {
        t.welcome += ' 先生， ';
    }else if ('女' == u['sex']) {
        t.welcome += ' 女士， ';
    }

    t.tmp = t.date['time'];
    t.tmp = t.tmp.substr(11, 2);

    if (11 > t.tmp) {
        t.welcome += '早上好';
    }else if (11 <= t.tmp && 15 > t.tmp) {
        t.welcome += '中午好';
    }else if (15 <= t.tmp && 18 > t.tmp) {
        t.welcome += '下午好';
    }else if (18 <= t.tmp) {
        t.welcome += '晚上好';
    }else {
        t.welcome += '您好';
    }
    t.welcome += '!';

    i_obj_set('welcome_box', t.welcome);
            
}

function m_data_load() {
    i_obj_get('calendar_box').firstChild.innerHTML = t.date['date_chinese'];
    setInterval("i_obj_get('calendar_box').lastChild.innerHTML = new Date().toLocaleTimeString();",1000);
}

function menu_bar_0() {
    mdi_open('mdi_mainer.htm', '我的桌面');
}

function menu_bar_1() {
    parent.location.href = '/sys_app_0/3010/htm/login.htm?a=logout';
}
// mdi_header e

function menu_set() {
    var i;
    t.obj_m0 = $('.level0').clone(true);
    t.obj_m0.click(function(){
        t.tmp = $(this.nextSibling).css('display');
        if ('none' == t.tmp) {
            t.tmp = 'block';
        } else {
            t.tmp = 'none';
        }

        $(this.nextSibling).css({
            'display': t.tmp
        });
    });
    
    t.obj_m1 = $('.level1').clone(true);
    t.obj_m2 = $('.level1 li').clone(true);
    t.obj_m2.click(function(){
        mdi_open(this.url, this.innerText, '-1');
    });

    t.obj_m2.mouseover(function(){
        $(this).css({
            'background-color':'#BBE9FF'
        });
    });

    t.obj_m2.mouseout(function(){
        $(this).css({
            'background-color':'#FFFFFF'
        });
    });
    
    $('#left_menu').html('');
    for (i in t.menu) {
        t.tmp = t.menu[i];
        if ('1' == t.tmp['f_id']) {
            t.obj_m0.html(t.tmp['name']);
            $('#left_menu').append(t.obj_m0.clone(true));
            t.obj_m1.attr('id', 'f_' + t.tmp['id']);
            t.obj_m1.html('');
            $('#left_menu').append(t.obj_m1.clone(true));
        } else {
            t.obj_m2.attr('url', t.tmp['url']);
            t.obj_m2.html(t.tmp['name']);
            $('#f_' + t.tmp['f_id']).append(t.obj_m2.clone(true));
        }
    }
}
// mdi_lefter e

i_read_js('mdi_tab');