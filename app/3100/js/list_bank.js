/**
 * 文件名称：list_bank.js
 * 功能描述：银行利率信息的列表控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.list_act_get = 'i_type=3'; //3代表银行利率管理
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
//    $('#btn_save').click(function(){
//        m_info_save();
//    });
}

//

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['year_term']);
    m.xtr.children(':eq(1)').attr('title', m.arr[i]['year_term']);
    m.xtr.children(':eq(2)').html(m.arr[i]['intrest_rate']);
    m.xtr.children(':eq(3)').html(m.arr[i]['remark']);
    m.xtr.children(':eq(4)').html(m.arr[i]['atime']);
}
