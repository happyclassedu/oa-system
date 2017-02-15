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
    t.xid = i_get('x');
    i_read_js('x_common');
    m_btn_load();
    m_data_set();
});

//function m_btn_load_plug() {
//}

function m_data_set() {
    m_data_set_plug();

    t.obj.click(function(){
        i = $(this).attr('id');
        t.tmp = {};
        t.tmp['type'] = 'job_title';
        t.tmp['info'] = array_job[i];
        parent.i_box_close(t.tmp);
    });

    for(var i=0 ; i<array_job.length; i++) {
        if (t.xid == array_job[i][1]) {
            t.obj.html(array_job[i][2]);
            t.obj.attr('id', i);
            $('#box_middle ul').append(t.obj.clone(true));
        }
    }
}