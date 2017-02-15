/**
 * 文件名称：list_job.js
 * 功能描述：职位管理的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

var t = {};

$(document).ready(function(){
//    i_read_js('arr_org');
    i_read_css('common', 0);
    i_read_css('x_common');
    m_btn_load();
    m_data_get();
});

function m_btn_load() {
    $('#btn_close').click(function(){
        parent.i_box_close();
    });

    if (this.m_btn_load_plug) {
        m_btn_load_plug();
    }
}

function m_data_set_plug() {
    t.obj = $('#box_middle ul li:eq(0)').clone(true);
    $('#box_middle ul').html('');

    t.obj.mouseover(function(){
        $(this).addClass('li_over');
    });
    t.obj.mouseout(function(){
        $(this).removeClass('li_over');
    });
}

//function m_btn_load_plug() {
//}

function m_data_get() {
    t.arr = arr_org;
    m_data_set();
}

function m_data_set() {
    t.obj_1 = $('#box_middle h2 span:eq(0)').clone(true);
    $('#box_middle h2').html('');

    t.obj_2 = $('#box_middle ul li:eq(0)').clone(true);
    $('#box_middle ul').html('');

    t.obj_3 = $('#box_middle ul:eq(0)').clone(true);
    $('#box_middle ul').remove();

    t.obj_1.click(function(){
        parent.i_box_close(t.arr[this.arr_id]);
    });

    t.obj_2.mouseover(function(){
        $(this).addClass('li_over');
    });
    t.obj_2.mouseout(function(){
        $(this).removeClass('li_over');
    });
    t.obj_2.click(function(){
        parent.i_box_close(t.arr[this.arr_id]);
    });

    for(var i=0 ; i<t.arr.length; i++) {
        if ('2' == t.arr[i]['type']) {
            t.obj_1.html(t.arr[i]['name']);
            t.obj_1.attr("org_id", t.arr[i]['id']);
            t.obj_1.attr("arr_id", i);
            $('#box_middle h2').append(t.obj_1.clone(true));
            t.obj_3.attr("id", t.arr[i]['id']);
            $('#box_middle').append(t.obj_3.clone(true));
        } else {
            t.obj_2.html(t.arr[i]['name']);
            t.obj_2.attr("arr_id", i);
            $('#' + t.arr[i]['f_id']).append(t.obj_2.clone(true));
        }
    }

    new i_tab_show('org_title', 'box_middle', 0, 'span', 'ul');
}