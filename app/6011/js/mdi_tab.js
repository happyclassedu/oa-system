var tab_index_now; //?
t.tab_all_width = document.body.clientWidth - 100;

var tab_mod = function() {
    this.tab_max = 30;  //最大tab数
    //    this.tab_now = 0;   //now tab index
    //    this.tab_verify       //验证tab方法
    //    this.tab_add          //新建tab方法
    //    this.tab_del          //移除tab方法//
    //    this.tab_active       //激活tab方法
    //    this.tab_del_all      //移除所有tab方法
    //    this.tab_chang_title  //更改当前title
    this.tab_obj = $('#tab_bar div:eq(0)').clone(true);
    $('#tab_bar').html('');

    this.tab_obj.mouseover(function(){
        if ($(this)[0].className == 'tab_hide') {
            $(this).addClass('tab_over');
        }
    });

    this.tab_obj.mouseout(function(){
        $(this).removeClass('tab_over');
    });

    this.tab_obj.click(function(){
        tab_mod.prototype.tab_active($('#tab_bar div').index(this));
    });

    //   双击关闭
    this.tab_obj.dblclick(function(){
        tab_mod.prototype.tab_del($('#tab_bar div').index(this));
    });


    t.obj_tmp = this.tab_obj.find('.close');
    t.obj_tmp.mouseover(function(){
        $(this).addClass('close_over');
    });
    t.obj_tmp.mouseout(function(){
        $(this).removeClass('close_over');
    });
    t.obj_tmp.click(function(){
        tab_mod.prototype.tab_del($('#tab_bar div').index(this.parentNode));
    });

}

tab_mod.prototype.tab_verify = function(url, title) {
    t.obj_arr = $('#tab_bar div');
    for (var i=0; i<t.obj_arr.length; i++) {
        t.obj_tmp = t.obj_arr.eq(i)[0];
        if(t.obj_tmp.url == url && t.obj_tmp.title == title) {
            return i;
        }
    }
    return -1;
}

tab_mod.prototype.tab_active = function(i) {
    $('#tab_bar div:[className="tab_show"]').attr("className","tab_hide");
    $('#tab_con iframe').css({
        'display':'none'
    });
    $('#tab_con iframe').eq(i).css({
        'display':'block'
    });
    $('#tab_bar div').eq(i).attr("className","tab_show");
    tab_index_now = i;

    t.tab_left = $('#tab_bar')[0].style.left;
    t.tab_left = t.tab_left.replace('px', '')*1;
    t.my_left = i * 140 + t.tab_left;
    t.my_right = t.my_left*1 + 140;

    if (t.my_left < 0) {
        t.move_left = t.my_left;
    } else if (t.my_right > t.all_width) {
        t.move_left = t.my_right - t.all_width;
    } else {
        return;
    }
    $('#tab_bar')[0].style.left = t.tab_left - t.move_left;
}

tab_mod.prototype.tab_index = function(obj) {
    t.obj_arr = $('#tab_bar div');
    for (var i=0; i<t.obj_arr.length; i++) {
        if (t.obj_arr.eq(i)[0] == obj) {
            return i;
        }
    }
    return -1;
}

//   关闭
tab_mod.prototype.con_del = function() {
    if (tab_index_now > -1) {
        this.tab_del(tab_index_now);
    }
};

tab_mod.prototype.tab_del = function(i) {
    if (i == 0) {
        return;
    }

    $('#tab_con iframe').eq(i).remove();
    $('#tab_bar div').eq(i).remove();
    this.tab_active(i-1);
}

tab_mod.prototype.tab_del_all = function() {
    t.obj_arr = $('#tab_bar div');
    for (i=t.obj_arr.length; i>0; i--) {
        $('#tab_con iframe').eq(i).remove();
        $('#tab_bar div').eq(i).remove();
    }
    this.tab_active(0);
    return true;
}

tab_mod.prototype.tab_add = function(url, title) {
    t.tab_xid = this.tab_verify(url, title);
    if (t.tab_xid > -1) {
        i_ajax_box_hide();
        this.tab_active(t.tab_xid);
        return;
    }

    t.tab_xid = $('#tab_bar div').length;
    if (t.tab_xid >= this.tab_max) {
        alert('超过最大窗口数量限制： ' + this.tab_max + ' 个窗口，请先关闭部分窗口！否则会导致系统响应缓慢。');
        return;
    }

    i_ajax_box_show();

    this.tab_obj.attr({
        'url': url,
        'title':title
    });
    this.tab_obj.find('.title').html(this.tab_title_sub(title, 16));

    $('#tab_bar').append(this.tab_obj.clone(true));
    $('#tab_con').append('<iframe src="'+ url +'" frameborder="0" scrolling="auto" onload="i_ajax_box_hide()">');

    this.tab_active(t.tab_xid);

    if (t.tab_xid == 0) {
        return;
    }
//    return true;
}

tab_mod.prototype.tab_control_load = function() {
    var obj_tmp;

    obj_tmp = $('#tab_move_left');
    obj_tmp[0].title = '标签左移';
    obj_tmp.mouseover(function(){
        $(this).addClass('tab_move_left_over');
    });
    obj_tmp.mouseout(function(){
        $(this).removeClass('tab_move_left_over');
    });
    obj_tmp.click(function(){
        var all_width = document.body.clientWidth - 100;
        var tab_num = $('#tab_bar div').length;
        var tab_left = '';
        tab_left = $('#tab_bar')[0].style.left;
        tab_left = tab_left.replace('px', '')*1;
        var tab_width = tab_num * 140 + tab_left;
        var tab_right = tab_width - all_width;
        var move_left;
        if (tab_right >= 300) {
            move_left = 300;
        } else if (tab_right < 300 && tab_right >= 140) {
            move_left = 160;
        } else if (tab_right > 0 && tab_right < 140) {
            move_left = tab_right;
        } else {
            return false;
        }
        $('#tab_bar')[0].style.left = tab_left-move_left;
    });

    obj_tmp = $('#tab_move_right');
    obj_tmp[0].title = '标签右移';
    obj_tmp.mouseover(function(){
        $(this).addClass('tab_move_right_over');
    });
    obj_tmp.mouseout(function(){
        $(this).removeClass('tab_move_right_over');
    });
    obj_tmp.click(function(){
        var tab_left = '';
        tab_left = $('#tab_bar')[0].style.left;
        tab_left = -tab_left.replace('px', '')*1;
        var move_left;
        if (tab_left >= 300) {
            move_left = 300;
        } else if (tab_left < 300 && tab_left >= 140) {
            move_left = 160;
        } else if (tab_left > 0 && tab_left < 140) {
            move_left = tab_left;
        } else {
            return false;
        }
        $('#tab_bar')[0].style.left = move_left - tab_left;
    });

    obj_tmp = $('#tab_del_all');
    obj_tmp[0].title = '关闭全部窗口';
    obj_tmp.mouseover(function(){
        $(this).addClass('tab_del_all_over');
    });
    obj_tmp.mouseout(function(){
        $(this).removeClass('tab_del_all_over');
    });
    obj_tmp.click(function(){
        tab_mod.prototype.tab_del_all();
    });

    obj_tmp = $('#tab_max');
    obj_tmp[0].title = '最大/还原';
    obj_tmp.mouseover(function(){
        $(this).addClass('tab_max_over');
    });
    obj_tmp.mouseout(function(){
        $(this).removeClass('tab_max_over');
    });
    obj_tmp.click(function(){
        m_tab_max();
    });

    obj_tmp = $('#tab_list');
    obj_tmp[0].title = '窗口列表';
    obj_tmp.mouseover(function(){
        $(this).addClass('tab_list_over');
    });
    obj_tmp.mouseout(function(){
        $(this).removeClass('tab_list_over');
    });
    $('#tab_list_con a').click(function(){
        tab_mod.prototype.tab_active(this.id);
        i_obj_hide('tab_list_con');
    });
    obj_tmp.click(function(){
        t.obj_arr = $('#tab_bar div');
        t.obj_tmp = $('#tab_list_con a:first').clone(true);
        $('#tab_list_con').html('');
        for (i=0; i<t.obj_arr.length; i++) {
            t.obj_tmp.html(t.obj_arr.eq(i).attr('title'));
            t.obj_tmp.attr('id', i);
            $('#tab_list_con').append(t.obj_tmp.clone(true));
        }
        m_tab_list();
    });

}

function m_tab_max() {
    if(0 != t.arrow_w || 0 != t.arrow_h) {
        t.arrow_w = 1;
        t.arrow_h = 1;
    }
    m_mdi_splitter_arrow();
    m_mdi_arrow_h();
}

function m_tab_list() {
    i_obj_show('tab_list_con');
    setTimeout('i_obj_hide("tab_list_con")', 5000);
}

//$('#tab_list_con').mouseout(function(){
//    i_obj_hide('tab_list_con');
//});

function mdi_open(url, title, type) {
    i_ajax_box_show();
    if (type == '-1') {
        mdi_tab.tab_add('/sys_app_0/'+url, title);
    } else if (type == '-2') {
        mdi_tab.tab_add(url, title);
    } else {
        var url_pre;
        url_pre = window.location.href;
        url_pre = url_pre.substr(0, url_pre.lastIndexOf('/'));
        url = url_pre +'/'+ url;
        mdi_tab.tab_add(url, title);
    }
}

function mdi_close() {
    mdi_tab.con_del();
}

var mdi_tab = new tab_mod();

$(document).ready(function() {
    mdi_tab.tab_control_load();
    mdi_open('mdi_mainer.htm', '我的桌面');
});

tab_mod.prototype.tab_title_sub = function(str, len) {
    var str_length = 0;
    var str_new = '';
    for (var i=0; i<str.length; i++) {
        if(str.charCodeAt(i)>=1000) {
            str_length += 2;
        } else {
            str_length += 1;
        }
        if(str_length > len) {
            str_new += "...";
            break;
        } else {
            str_new += str.substr(i,1);
        }
    }
    return str_new;
}

tab_mod.prototype.tab_chang_title = function(title) {
    var obj_tmp = $('#tab_bar div:[className="tab_show"]');
    obj_tmp[0].title = title;
    obj_tmp.find('.title').html(title)
    return true;
}