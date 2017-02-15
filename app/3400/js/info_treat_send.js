/**
 * 文件名称：info_treat_sead.js
 * 功能描述：待遇发放的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m.check = '';
    m_user_act();
    m_init();
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

//    $('#d_send_date').jdate({
//        dateFormat: 'yy-mm-dd'
//    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    i_obj_disable('d_state_2');
    i_obj_set('d_state_2', '正常');
    i_obj_set('d_type_1', '0'); //0代表待遇起发
    $('#d_idcard').addClass('info_must');
}


function m_info_edit_plug() {
    i_obj_disable('d_state_2');
   $('#d_idcard').addClass('info_must');
}

function m_info_view_plug() {
    $('#d_idcard').removeClass('info_must');
}

//function m_info_input_plug(state) {
//
//}

//function m_act_url_plug() {
//    return false;  //可以终止跳转
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('t_idcard');
//    if ('' == m.tmp) {
//         alert('公民身份证号码不能为空，请填写！');
//        return false;
//    }
    
    i_obj_set('d_name', i_obj_val('t_name'));
    i_obj_set('d_idcard', i_obj_val('t_idcard'));

    return true;


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
    i_obj_set('t_org_1', arr.org_1);
    i_obj_set('t_org_2', arr.org_2);
    i_obj_set('t_ins_code', arr.ins_code);
    i_obj_set('t_tel_1', arr.tel_1);
    i_obj_set('t_bankcard_code', arr.bankcard_code);
    i_obj_set('t_disability', arr.disability);
}

function m_init() {
    m_info_ins_pay_read();
}

function m_info_ins_pay_read() {
    $.ajax({
        url : g.act + 'list_ins_pay.php?a=list_read',
        success : function(txt){
            m.arr = i_json2js(txt);       
            m_info_ins_pay_plug();
        }
    });
}

function m_info_ins_pay_plug(){
    $('#d_std_year').html('');  //清空tbody里面的内容
    var option_txt = '';
    option_txt += '<option value="">请选择</option>';
    for(var i=0 ; i<m.arr.length; i++) {
        option_txt += '<option value="'+ m.arr[i]['year'] +'">'+ m.arr[i]['year']+ '</option>';
    }
    $('#d_std_year').append(option_txt);

    $('#d_std_year').change( function() {
        var i =  $("#d_std_year").get(0).selectedIndex - 1;
        i_obj_set('d_std_money', m.arr[i]['ins_pay']);
    });
}