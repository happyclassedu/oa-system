$(document).ready(function() {
    read_type_list();
});

function menu_mouse_load(xid) {
    var obj_arr, obj_tmp;
    obj_arr = $('#menu_'+ xid +' LI');
    for (var j=0; j<obj_arr.length; j++) {
        obj_tmp = obj_arr.eq(j);
        obj_tmp.click(function(){
            var url = this.id;
            if (this.id.indexOf('/') == '-1') {
                url = '/act/'+ this.id;
                parent.mdi_open(url, this.innerText, '-1');
            }else {
                parent.mdi_open(url, this.innerText, '-2');
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
//
//function menu_show_load() {
//    var obj_arr, obj_tmp;
//    obj_arr = $('.level0 SPAN');
//    for (var j=0; j<obj_arr.length; j++) {
//        obj_tmp = obj_arr.eq(j);
//        obj_tmp.click(function(){
//            var state;
//            state = $(this)[0].state;
//            if (state == 'none') {
//                state = 'block';
//            } else {
//                state = 'none';
//            }
//            $(this)[0].state = state;
//            $(this).css({
//                'background-image':'url(../img/mdi_dot_'+ state +'.gif)'
//            });
//            var tmp = this.parentNode.nextSibling;
//            $(tmp).css({
//                'display': state
//            });
//        });
//    }
//}

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
        url : i_act + 'a=read_type_list',
        success: function(txt){
            var arr = i_json2js(txt);
            var type_list = '';
            for (var j=0; j<arr.length; j++) {
                type_list += '<div class="level0"><span></span>'+ arr[j].cname +'</div><ul id="menu_'+ arr[j].id +'"></ul>';
                read_type_info(arr[j].id);
            }
            i_obj_set('left_menu', type_list);
            menu_show_load();
        }
    });
}

function read_type_info(xid) {
    $.ajax({
        url : i_act + 'a=read_type_info&x='+ xid,
        success: function(txt){
            var arr = i_json2js(txt);
            var type_info = '';
            for (var j=0; j<arr.length; j++) {
                type_info += '<li class="level1" title="'+ arr[j].intro +'" id="'+ arr[j].url +'">'+ arr[j].cname +'</li>';
            }
            i_obj_set('menu_'+ xid, type_info);
            menu_mouse_load(xid);
        }
    });
}