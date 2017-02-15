/**
 * 文件名称：list_community.js
 * 功能描述：社区信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.street_id = i_get('street_id');
    m.list_act_get = 'i_type=1&street_id=' + m.street_id; //1代表缴费档次管理
    m_init();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
    $('#btn_add_community').click(function(){
        i_mdi_open( './info_community.htm?a=add&street_id=' + m.street_id, '新增--社区信息');
    });
}

function m_list_read_btn_plug() {
    $('.btn_view_community').click(function(){
        i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        i_mdi_open( './info_community.htm?a=view&x=' + m.xid + '&street_id=' + m.street_id, '查看信息--社区信息');
    });

    $('.btn_edit_community').click(function(){
        i = this.parentNode.parentNode.id;
        m.xid = m.arr[i]['id'];
        i_mdi_open( './info_community.htm?a=edit&x=' + m.xid + '&street_id=' + m.street_id, '新增信息--社区信息');
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['community']);
    m.xtr.children(':eq(1)').attr('title', m.arr[i]['community']);
    m.xtr.children(':eq(2)').html(m.arr[i]['community_code']);
    m.xtr.children(':eq(3)').html(m.arr[i]['remark']);
    m.xtr.children(':eq(4)').html(m.arr[i]['atime']);
}

function m_init() {
    $.ajax({
        url : g.act + 'info_community.php?a=info_read&x=' + m.street_id,
        success : function(txt){
            m.arr_info = i_json2js(txt);
            i_obj_set('d_street', m.arr_info['street']);
        }
    });
}