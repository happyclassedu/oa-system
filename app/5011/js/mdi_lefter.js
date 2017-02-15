$(document).ready(function() {
    read_type_list();
});

function menu_mouse_load() {
    var obj_arr, obj_tmp;
    obj_arr = $('.level1');
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
            var arr_list = arr['list'];
            var arr_info = arr['info'];
            var menu_text = '';


            var key, val;
            for (key in arr_list) {
                menu_text += '<div class="level0"><span></span>'+ arr_list[key].cname +'</div><ul id="menu_'+ key +'">';
                arr = arr_info[key];
                for (key in arr) {
                    menu_text += '<li class="level1" title="'+ arr[key].intro +'" id="'+ arr[key].url +'">'+ arr[key].cname +'</li>';
                }
                menu_text += '</ul>';
            }
            i_obj_set('left_menu', menu_text);

            menu_show_load();
            menu_mouse_load();
        }
    });
}