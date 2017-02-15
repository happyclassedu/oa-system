/**
 * 文件名称：list_street.js
 * 功能描述：街办信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.list_act_get = 'i_type=0'; //1代表缴费档次管理
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
}

function m_list_read_btn_plug() {
    $('.btn_list_community').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./list_community.htm?a=list&street_id=' + m.arr[i]['id'], '查看列表--社区信息');
    });

    $('.btn_add_community').click(function(){
        i = this.parentNode.parentNode.id;
        i_mdi_open('./info_community.htm?a=add&street_id=' + m.arr[i]['id'], '新增--社区信息');
    });
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['street']);
    m.xtr.children(':eq(1)').attr('title', m.arr[i]['street']);
    m.xtr.children(':eq(2)').html(m.arr[i]['street_code']);
    m.xtr.children(':eq(3)').html(m.arr[i]['remark']);
    m.xtr.children(':eq(4)').html(m.arr[i]['atime']);
}
