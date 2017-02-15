var tab_index_now;
var tab_class = function() {
    this.tab_max = 30;  //最大tab数
//    this.tab_now = 0;   //now tab index
//    this.tab_verify       //验证tab方法
//    this.tab_add          //新建tab方法
//    this.tab_del          //移除tab方法//
//    this.tab_active       //激活tab方法
//    this.tab_del_all      //移除所有tab方法
//    this.tab_chang_title  //更改当前title
}

tab_class.prototype.tab_verify = function(url, title) {
    var obj_arr, obj_tmp;
    obj_arr = $('#tab_box LI');
    for (var i=0; i<obj_arr.length; i++) {
        obj_tmp = obj_arr.eq(i)[0];
        if(obj_tmp.url == url && obj_tmp.title == title) {
            return i;
        }
    }
    return -1;
}

tab_class.prototype.tab_active = function(i) {
    $('#tab_box LI:[className="tab_show"]').attr("className","tab_hide");
    $('#tab_con LI').css({
        'display':'none'
    });
    $('#tab_con LI').eq(i).css({
        'display':'block'
    });
    $('#tab_box LI').eq(i).attr("className","tab_show");
    tab_index_now = i;

    ajax_load_hide();

    var all_width = document.body.clientWidth - 100;
    var tab_left = '';
    tab_left = $('#tab_box')[0].style.left;
    tab_left = tab_left.replace('px', '')*1;
    var my_left = i * 140 + tab_left;
    var my_right = my_left*1 + 140;
    var move_left;
    if (my_left < 0) {
        move_left = my_left;
    } else if (my_right > all_width) {
        move_left = my_right - all_width;
    } else {
        return false;
    }
    $('#tab_box')[0].style.left = tab_left - move_left;
}

tab_class.prototype.tab_index = function(obj) {
    var obj_arr;
    obj_arr = $('#tab_box LI');
    for (var i=0; i<obj_arr.length; i++) {
        if (obj_arr.eq(i)[0] == obj) {
            return i;
        }
    }
    return -1;
}

//   关闭
tab_class.prototype.con_del = function() {
    if (tab_index_now > -1) {
        this.tab_del(tab_index_now);
        return true;
    }
    return false;
};

tab_class.prototype.tab_del = function(i) {
    if (i == 0) {
        return false;
    }

    ajax_load_show();

    $('#tab_con LI').eq(i).remove();
    $('#tab_box LI').eq(i).remove();
    this.tab_active(i-1);

    ajax_load_hide();
    CollectGarbage();
}

tab_class.prototype.tab_del_all = function() {
    var obj_arr;
    obj_arr = $('#tab_box LI');
    for (var i=obj_arr.length; i>0; i--) {
        $('#tab_con LI').eq(i).remove();
        $('#tab_box LI').eq(i).remove();
    }
    this.tab_active(0);
    return true;
}

tab_class.prototype.tab_add = function(url, title) {
    var xid;
    xid = this.tab_verify(url, title);
    if (xid > -1) {
        this.tab_active(xid);
        return true;
    }

    xid = $('#tab_box LI').length;
    if (xid >= this.tab_max) {
        alert('超过最大窗口数量限制： ' + this.tab_max + ' 个窗口，请先关闭部分窗口！');
        return false;
    }

    ajax_load_show();

    $('#tab_box').append('<li url="'+ url +'" title="'+ title +'"><span></span>'+ this.tab_title_sub(title, 16) +'</li>');
    $('#tab_con').append('<li><iframe src="'+ url +'" frameborder="0" scrolling="auto" onload="ajax_load_hide()"></li>');

    this.tab_active(xid);
    var obj_tmp;
    obj_tmp = $('#tab_box LI:last');

    obj_tmp.mouseover(function(){
        if ($(this)[0].className == 'tab_hide') {
            $(this).attr("className","tab_over");
        }
    });

    obj_tmp.mouseout(function(){
        if ($(this)[0].className == 'tab_over') {
            $(this).attr("className","tab_hide");
        }
    });

    obj_tmp.click(function(){
        var xid = tab_class.prototype.tab_index(this);
        if (xid > -1) {
            tab_class.prototype.tab_active(xid);
            return true;
        }
        return false;
    });

    //   双击关闭
    obj_tmp.dblclick(function(){
        var xid = tab_class.prototype.tab_index(this);
        if (xid > -1) {
            tab_class.prototype.tab_del(xid);
            return true;
        }
        return false;
    });

    if (xid == 0) {
        return false;
    }
    obj_tmp = $('#tab_box LI:last SPAN');
    obj_tmp.attr("className","tab_del");
    obj_tmp.mouseover(function(){
        $(this).attr("className","tab_del_over");
    });
    obj_tmp.mouseout(function(){
        $(this).attr("className","tab_del");
    });
    obj_tmp.click(function(){
        var xid = tab_class.prototype.tab_index(this.parentNode);
        if (xid > -1) {
            tab_class.prototype.tab_del(xid);
            return true;
        }
        return false;
    });
    return true;
}

tab_class.prototype.tab_control_load = function() {
    var obj_tmp;

    obj_tmp = $('#tab_move_left');
    obj_tmp[0].title = '标签左移';
    obj_tmp.attr("className","tab_move_left");
    obj_tmp.mouseover(function(){
        $(this).attr("className","tab_move_left_over");
    });
    obj_tmp.mouseout(function(){
        $(this).attr("className","tab_move_left");
    });
    obj_tmp.click(function(){
        var all_width = document.body.clientWidth - 100;
        var tab_num = $('#tab_box LI').length;
        var tab_left = '';
        tab_left = $('#tab_box')[0].style.left;
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
        $('#tab_box')[0].style.left = tab_left-move_left;
    });

    obj_tmp = $('#tab_move_right');
    obj_tmp[0].title = '标签右移';
    obj_tmp.attr("className","tab_move_right");
    obj_tmp.mouseover(function(){
        $(this).attr("className","tab_move_right_over");
    });
    obj_tmp.mouseout(function(){
        $(this).attr("className","tab_move_right");
    });
    obj_tmp.click(function(){
        var tab_left = '';
        tab_left = $('#tab_box')[0].style.left;
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
        $('#tab_box')[0].style.left = move_left - tab_left;
    });

    obj_tmp = $('#tab_del_all');
    obj_tmp[0].title = '关闭全部窗口';
    obj_tmp.attr("className","tab_del_all");
    obj_tmp.mouseover(function(){
        $(this).attr("className","tab_del_all_over");
    });
    obj_tmp.mouseout(function(){
        $(this).attr("className","tab_del_all");
    });
    obj_tmp.click(function(){
        tab_class.prototype.tab_del_all();
    });

}

function ajax_load_show() {
    $('#ajax_load').css({
        'display':'block'
    });
}

function ajax_load_hide() {
    $('#ajax_load').css({
        'display':'none'
    });
}

function mdi_open(url, title, type) {
    if (type == '-1') {
        mdi_tab.tab_add('/oa_2009'+url, title);
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

var mdi_tab = new tab_class();

$(document).ready(function() {
    mdi_tab.tab_control_load();
    mdi_open('mdi_mainer.htm', '我的桌面');
});

tab_class.prototype.tab_title_sub = function(str, len) {
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

tab_class.prototype.tab_chang_title = function(title) {
    var obj_tmp = $('#tab_box LI:[className="tab_show"]')[0];
    obj_tmp.title = title;
    obj_tmp.innerHTML = '<span></span>' + this.tab_title_sub(title, 16);
    obj_tmp = $('#tab_box LI:last SPAN');
    obj_tmp.attr("className","tab_del");
    obj_tmp.mouseover(function(){
        $(this).attr("className","tab_del_over");
    });
    obj_tmp.mouseout(function(){
        $(this).attr("className","tab_del");
    });
    obj_tmp.click(function(){
        var xid = tab_class.prototype.tab_index(this.parentNode);
        if (xid > -1) {
            tab_class.prototype.tab_del(xid);
            return true;
        }
        return false;
    });
    return true;
}