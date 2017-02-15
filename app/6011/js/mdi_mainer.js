$(document).ready(function() {
    base_load();
    saying_load();
    news_load();
    refresh_load();
//    setInterval("news_load();",30000);
});

var saying;

var now_m = 0;
var now_d = 0;
now_m = new Date().getMonth() + 1;
now_d = new Date().getDate() + 1;

function saying_load() {
    $.ajax({
        url : i_act + 'a=read_saying',
        success: function(txt){
            if (txt == '') {
                return false;
            }
            var arr = i_json2js(txt);
            i_obj_set('saying_content', arr.saying);
            i_obj_set('saying_source', '&mdash;&mdash;'+ arr.source);
        }
    });
}


function news_load() {
    var obj_arr, obj_tmp, xid_tmp;
    obj_arr = $('.list_box');
    obj_tmp = $('.list_box LI');
    
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

    for (var j=0; j<obj_arr.length; j++) {
        xid_tmp = obj_arr.eq(j)[0].id;
        info_get(xid_tmp);
        $('.list_title').eq(j).click(function(){
            if(this.parentNode.id != 0 && this.parentNode.id != 1){
                parent.mdi_open('/sys_app_0/2030/htm/list_' + this.parentNode.id + '.htm', this.innerText, '-2');
            }
        });

    }
}

function info_get(xid) {
    $.ajax({
        url : '/sys_act_0/2030/act/list_' + xid + '.php?a=list_read4desk',
        success: function(txt){
            var arr = i_json2js(txt);
            info_set(xid, arr);
        }
    });
}

function info_set(xid, infos) {
    var obj_arr, obj_tmp;
    obj_arr = $('#'+ xid +' LI');
    for (var j=0; j<infos.length; j++) {
        obj_tmp = obj_arr.eq(j);
        var info_atime_m = infos[j].atime.substr(5, 2);
        var info_atime_d = infos[j].atime.substr(8, 2);
        obj_tmp[0].innerHTML = '<span>'+ info_atime_m + '-' + info_atime_d +'</span>'+ infos[j].name;
        obj_tmp[0].id = infos[j].id;
        obj_tmp[0].title = infos[j].name;
        obj_tmp[0].url = '/sys_app_0/2030/htm/info_' + xid + '.htm?a=view&x=' + infos[j].id;

        obj_tmp.click(function(){
            info_open(this.url, this.title);
        });
    
        if (info_atime_m == now_m) {
            if ((now_d - info_atime_d) < 4) {
                obj_tmp.children('span').addClass('news_new');
            }
        } else {
            if ((now_d + 30 - info_atime_d) < 4) {
                obj_tmp.children('span').addClass('news_new');
            }
        }
    }
}

function info_open(url, title) {
    parent.mdi_open(url, title, '-2');
}

function base_load() {
    $('#saying_box_title').click(function(){
        saying_load();
    });
}

function refresh_load() {
    $('#refresh').click(function(){
        location.reload();
    });
}
