/**
 * 文件名称：info_org.js
 * 功能描述：组织机构管理增加,修改，查看功能的前台程序。
 * 代码作者：钱宝伟（创建），王争强（优化），孙振强（重构）
 * 创建日期：2010-06-11
 * 修改时间：2010-07-08
 * 当前版本：v3.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
    i_read_js('lib_idcard', 0);
    m.arr_org = {};
    m.org_type = '';
    m.check = '0';
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#d_name').change(function(){
        m_act_name();
    });

    $('#d_idcard').change(function(){
        m_act_idcard();
    });

    $('#d_type').change(function(){
        m_list_read_org();
    });

    $('#d_org_2, #d_org_1').click(function(){
        if ('查看' == i_obj_val('sys_state')) {
            return;
        }
        i_box_open({
            content: '../htm/x_org_choose.htm',
            player: 'iframe',
            title: '',
            width: '700px',
            height: '300px'
        });
    });

    $('#d_bankcard_code').change(function(){
        m_act_bankcard_code();
    });
}

//function m_info_set_plug() {
//}

//function m_info_add_plug() {
//    m_list_read_org();
//    i_obj_hide('d_f_name');
//    i_obj_show('d_f_id');
//}
//
//function m_info_edit_plug() {
//    m_list_read_org();
//    i_obj_hide('d_f_name');
//    i_obj_show('d_f_id');
//}
//
//function m_info_view_plug() {
//    i_obj_hide('d_f_id');
//    i_obj_show('d_f_name');
//}

//function m_info_input_plug(state) {
//
//}

function m_info_save_plug() {
    if ('' == i_obj_val('d_name')) {
        alert('对不起，请输入参保人姓名！');
        $('#d_name').focus();
        return false;
    }
    
    if ('' == i_obj_val('d_idcard')) {
        alert('对不起，请输入参保人身份证号码！');
        $('#d_idcard').focus();
        return false;
    }

    m.tmp = i_idcard_check(i_obj_val('d_idcard'));
    if ("ok" != m.tmp) {
        alert('对不起，身份证号码存在问题，请检查！');
        $('#d_idcard').focus();
        return false;
    }

    if ('' == i_obj_val('d_org_2')) {
        alert('对不起，请选择户口所在街道、社区！');
        $('#d_org_2').click();
        return false;
    }

    if ('' == i_obj_val('d_ins_code')) {
        alert('对不起，请输入参保人养老编码！');
        $('#d_ins_code').click();
        return false;
    }

    if ('' == i_obj_val('d_tel_1')) {
        alert('对不起，请输入联系电话！');
        $('#d_tel_1').click();
        return false;
    }

//    if ('' == i_obj_val('d_ins_base')) {
//        alert('对不起，请选择缴费标准！');
//        $('#d_ins_base').click();
//        return false;
//    }

    if ('1' == m.check) {
        alert('对不起：数据库中已存在相同值！');
        return false;
    }
    
    return true;
}

function m_list_read_org() {
    m.org_type = i_obj_val('d_type');
    if ('' === m.org_type || '0' === m.org_type) {
        return;
    }

    if (m.arr_org[m.org_type]) {
        m_org_set();
        return;
    }
    
    $.ajax({
        url : i_act + 'a=list_read4info&x=' + m.org_type,
        success : function(txt){
            m.arr_org[m.org_type] = i_json2js(txt);
            m_org_set();
        }
    });
}

function m_org_set(){    
    m.tmp = '';
    m.tmp += '<option value="" selected="selected">请选择……</option>';
    m.tmp += '<option value="0">无上级</option>';

    if (!m.arr_org[m.org_type]) {
        $('#d_f_id').html(m.tmp);
        return;
    }

    m.arr = m.arr_org[m.org_type];
    for(i=0; i<m.arr.length; i++) {
        m.tmp += '<option value="'+ m.arr[i]['id'] +'" code="'+ m.arr[i]['code'] +'">'+ m.arr[i]['name'] + '</option>';
    }
    $('#d_f_id').html(m.tmp);

    if ('' != m.info) {
        i_obj_set('d_f_id', m.info['f_id']);
    }
}

function m_box_close_plug(arr) {
    if (!arr || '' == arr) {
        return;
    }
    if ('1' == arr['type']) {
        i_obj_set('d_org_1', arr['name']);
        i_obj_set('d_org_1_id', arr['id']);
        i_obj_set('d_org_2', arr['f_name']);
        i_obj_set('d_org_2_id', arr['f_id']);
    } else if ('2' == arr['type']) {
        i_obj_set('d_org_2', arr['name']);
        i_obj_set('d_org_2_id', arr['id']);
    }

    if (!i_obj_val('d_ins_code')) {
        i_obj_set('d_ins_code', arr['code']);
    }
}

function m_act_idcard() {
    m.idcard = i_obj_val('d_idcard');
    if (!m.idcard || '' == m.idcard || '610104' == m.idcard) {
        return;
    }

   i_obj_set('d_ins_code', m.idcard);

    m.tmp = i_idcard_check(m.idcard);
    if ("ok" != m.tmp) {
        alert(m.tmp);
        return;
    }

    m.tmp = i_idcard_birth(m.idcard);
    i_obj_set('d_birth', m.tmp);

    m.year = new Date();
    m.year = m.year.getYear();
    m.tmp = m.tmp.substr(0,4);
    if (16 > (parseInt(m.year) - parseInt(m.tmp))) {
        alert('提示：请核查年龄，是否年满16周岁！');
    }

    m.tmp = i_idcard_sex(m.idcard);
    i_obj_set('d_sex', m.tmp);

    m.check_obj = 'd_idcard';
    m_info_check();
}

function m_act_name() {
    m.tmp = i_obj_val('d_bankcard_name');
    if ('' != m.tmp) {
        return;
    }

    m.tmp = i_obj_val('d_name');
    if ('' != m.tmp) {
        i_obj_set('d_bankcard_name', m.tmp);
    }
}

function m_act_bankcard_code() {
    m.tmp = i_obj_val('d_bankcard_code');
    if ('' == m.tmp) {
        return;
    }

    if(19 != m.tmp.length || isNaN(m.tmp)) {
        alert('提示：银行卡号应是19位数字，请确认正确！');
    }
}


function m_info_check() {
    m.arr = i_obj_val(m.check_obj);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_check&x=' + m.xid + '&obj_id=' + m.check_obj.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check = '1';
                    if ('d_idcard' == m.check_obj) {
                        alert('对不起：身份证号“' + i_obj_val(m.check_obj) + '”在系统中已经存在，请确认输入是否正确！');
                    } else {
                        alert('对不起：数据库中已存在相同值！');
                    }
                    $('#' + m.check_obj).focus();
                } else {
                    m.check = '0';
                }
            }
        });
    }
}