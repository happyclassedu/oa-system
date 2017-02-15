$(document).ready(function() {
    base_load();
    saying_load();
    news_load();
    refresh_load();
//    setInterval("news_load();",30000);
});

var saying;
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
    var obj_arr, obj_tmp;
    obj_arr = $('.list_box');
    for (var j=0; j<obj_arr.length; j++) {
        obj_tmp = obj_arr.eq(j);
        news_get(obj_tmp[0].id);
        $('.list_title').eq(j).click(function(){
            if(this.parentNode.id != 0 && this.parentNode.id != 1){
                parent.mdi_open('/act/n_list.php?tid='+ this.parentNode.id, this.innerText, '-1');
            }
        });
    }
}

function news_get(xid) {
    $.ajax({
        url : i_act + 'a=read_all_news&x='+ xid,
        success: function(txt){
            var infos = i_json2js(txt);
            var obj_arr, obj_tmp;
            obj_arr = $('#'+ xid +' LI');
            for (var j=0; j<infos.length; j++) {
                obj_tmp = obj_arr.eq(j);
                obj_tmp[0].innerHTML = '<span>'+ infos[j].stime +'</span>'+ infos[j].title;
                obj_tmp[0].id = infos[j].id;
                obj_tmp[0].title = infos[j].title;
                obj_tmp.click(function(){
                    news_open(this.id, this.title);
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

                var news_stime;
                news_stime = infos[j].stime;
                if (news_stime) {
                    var news_time_m = news_time_d = 0;
                    news_time_m = news_stime.substr(0, 2);
                    news_time_d = news_stime.substr(3, 2);

                    var now_m = now_d = 0;
                    now_m = new Date().getMonth() + 1;
                    now_d = new Date().getDate() + 1;

                    if (news_time_m == now_m) {
                        if ((now_d - news_time_d) < 4) {
                            obj_tmp.children('span').addClass('news_new');
                        }
                    } else {
                        if ((now_d + 30 - news_time_d) < 4) {
                            obj_tmp.children('span').addClass('news_new');
                        }
                    }
                }
            }
        }
    });
}

function news_open(xid, title) {
    url = '/act/news.php?act=show&xid='+ xid;
    parent.mdi_open(url, title, '-1');
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
