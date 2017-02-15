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
    i_read_js('x_common');
    m_btn_load();
    m_data_set();
});

//function m_btn_load_plug() {
//}

function m_data_set() {
    m_data_set_plug();

    t.obj.click(function(){
        i = $(this).index();
        t.tmp = {};
        t.tmp['type'] = 'job_addr';
        t.tmp['info'] = array_province[i];
        i_box_open({
            content: '../htm/x_job_addr_city.htm?x=' + t.tmp['info'][0],
            player: 'iframe',
            title: '',
            width: '410px',
            height: '280px'
        });
    });

    for(var i=0 ; i<array_province.length; i++) {
        t.obj.html(array_province[i]['1']);
        $('#box_middle ul').append(t.obj.clone(true));
    }
}

function m_box_close_plug(arr) {
    if (!arr || '' == arr) {
        return;
    }
    t.tmp['city']= arr;
    parent.i_box_close(t.tmp);
}