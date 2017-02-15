/**
 * 文件名称：list_job.js
 * 功能描述：职位管理的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

$(document).ready(function(){
    i_read_css('common', 0);
    i_read_css('x_common');
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