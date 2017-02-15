/**
 * 文件名称：info_org.js
 * 功能描述：组织机构管理增加,修改，查看功能的前台程序。
 * 代码作者：钱宝伟（创建），王争强（优化），孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

//$(document).ready(function(){
//    alert('12345');
//});

function m_btn_load_plug() {
    $('#btn_info_hm_w').click(function(){
        i_mdi_open('./info_hm_w.htm?a=view&x=' + m.xid, '员工工作信息', 1);
    });
}

//function m_info_set_plug() {
//
//}

//function m_info_add_plug() {
//
//}

//function m_info_edit_plug() {
//
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
        alert('请输入员工姓名');
        return false;
    }
    return true;
}