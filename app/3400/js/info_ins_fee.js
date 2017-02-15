/**
 * 文件名称：info_ins_pay.js
 * 功能描述：养老金计发标准设置的信息程序。
 * 代码作者：孙振强（创建）
 * 创建日期：2011-05-08
 * 修改日期：2011-05-08
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    m.check = '0';
    m_user_act();
    $('input[id^=t_]').attr('readonly', true);
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#t_idcard').click(function(){
        if ('新增' == i_obj_val('sys_state')) {
            i_box_open({
                content: '../htm/list_insured_choose.htm',
                player: 'iframe',
                title: '',
                width: '820px',
                height: '400px'
            });
        }
    });
}

//function m_info_set_plug() {
//   alert(m.xid);
//}

//function m_info_add_plug() {
////    $('#d_name, #d_name_e').addClass('info_must');
//}

//function m_info_edit_plug() {
////    $('#d_name, #d_name_e').addClass('info_must');
//}

//function m_info_view_plug() {
////    $('#d_name, #d_name_e').removeClass('info_must');
//}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
//    if ('' == i_obj_val('d_year')) {
//        alert('对不起，请选择标准年份！');
//        $('#d_year').focus();
//        return false;
//    }

//    if ('' == i_obj_val('d_ins_pay')) {
//        alert('对不起，请输入养老金计发标准！');
//        $('#d_ins_pay').focus();
//        return false;
//    }

    if ('1' == m.check) {
        alert('对不起：数据库中已存在相同值！');
        return false;
    }

    return true;
}

//function m_info_del_ok() {
//    i_mdi_open('./list_' + g.id_name + '.htm?a=list' , '列表管理', 1);
//}

function m_info_del_fail(arr) {
    if (0 == arr) {
        alert('删除失败！');
    }
}

function m_user_act() {
    if (parent.g.u) {
        i_obj_set('t_bname', parent.g.u.name);
        i_obj_set('t_borg', parent.g.u.org);
        i_obj_set('t_bdate', i_date_now());
    }
}

function m_box_close_plug(arr) {
    if (!arr || '' == arr) {
        return;
    }
    
    i_obj_set('t_idcard', arr.idcard);
    i_obj_set('t_name', arr.name);
    i_obj_set('t_sex', arr.sex);
}