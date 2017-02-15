/**
 * 文件名称：info_czly.js
 * 功能描述：修改企业信息的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m.arr_info = '';
    m.arr_community = '';
    m_load_arr_plug(); //加载数组
    m_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_idcard').blur(function(){
        if(m_checkCardID(this.id, '', 'd_sex', 'd_birth')){
            m_info_name_check(this.id);
        }
    });


    $('#btn_change').click(function(){
//        i_mdi_open('./info_job.htm?a=add&c_id=' + i_obj_val('d_cid'), '发布信息--职位信息');
        alert('测试！');
    });
}

//function m_info_set_plug() {
//
//}

function m_info_add_plug() {
    i_obj_disable('d_i_state0');
    i_obj_disable('d_i_state1');
    $('#d_idcard').addClass('info_must');
}


function m_info_edit_plug() {
    i_obj_disable('d_i_state0');
    i_obj_disable('d_i_state1');
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
    m.tmp = i_obj_val('d_idcard');
    if ('' == m.tmp) {
         alert('公民身份证号码不能为空，请填写！');
        return false;
    } else {
        if(!m_checkCardID('d_idcard', '', 'd_sex', 'd_birth')){
            return false;
        }
    }

    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
         alert('姓名不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_birth');
    if ('' == m.tmp) {
         alert('出生日期不能为空，请填写！');
        return false;
    }

    m.tmp = i_obj_val('d_tel1');
    if (!m_checkTelephone(m.tmp)  && '' != m.tmp) {
        alert('固定电话不能为空，请重新输入');
        return false;
    }

    m.tmp = i_obj_val('d_tel1');
    if (!m_checkMobilePhone(m.tmp)  && '' != m.tmp) {
        alert('手机格式不正确，请重新输入！');
        return false;
    }


    m.tmp = i_obj_val('d_post_code');
    if (!m_checkPostCode(m.tmp) && '' != m.tmp) {
        alert('邮政编码格式不正确，请重新输入！');
        return false;
    }

    return true;


}

function m_load_arr_plug(){
    m.tmp = '';
}

function m_info_name_check(obj_id) {
    m.arr = i_obj_val(obj_id);
    if ('' != m.arr) {
        $.ajax({
            url : i_act + 'a=info_name_check&x=' + m.xid + '&obj_id=' + obj_id.substr(2),
            data : 'arr=' + i_js2json(m.arr),
            success : function(txt){
                m.arr = i_json2js(txt);
                if (0 < m.arr) {
                    m.check = '1';
                    alert( '对不起：数据库中已存在相同值！');
                    $('#' + obj_id).focus();
                } else {
                    m.check = '0';
                }
            }
        });
    }
}

function m_init() {   
    m_info_street_read();
    m_info_community_read();
}

function m_info_street_read() {
    $.ajax({
        url : g.act + 'info_street.php?a=list_read_street',
        success : function(txt){
            m.arr_info = i_json2js(txt);
            m_info_street_plug();
        }
    });
}

function m_info_street_plug(){
    $('#d_street').html('');  //清空tbody里面的内容
    var option_txt = '';
    option_txt += '<option value="">请选择</option>';
    for(var i=0 ; i<m.arr_info.length; i++) {
        option_txt += '<option value="'+ m.arr_info[i]['street'] +'">'+ m.arr_info[i]['street'] + '</option>';
    }
    $('#d_street').append(option_txt);

    $('#d_street').change( function() {
        var i =  $("#d_street").get(0).selectedIndex - 1;
        m_info_community_read(m.arr_info[i]['id']);
    });
}

function m_info_community_read(fid) {
//    m.arr_info[fid]['community']
     $.ajax({
        url : g.act + 'info_street.php?a=list_read_community&x=' + fid,
        success : function(txt){
            m.arr_community = i_json2js(txt);
            m_info_community_plug();
        }
    });
}
function m_info_community_plug()    {
    $('#d_community').html('');  //清空tbody里面的内容
    var option_txt = '';
    option_txt += '<option value="">请选择</option>';
    for(var i=0 ; i<m.arr_community.length; i++) {
        option_txt += '<option value="'+ m.arr_community[i]['community'] +'">'+ m.arr_community[i]['community'] + '</option>';
    }
    $('#d_community').append(option_txt);

    $('#d_community').change( function() {
        var i =  $("#d_community").get(0).selectedIndex - 1;
//        alert(m.arr_community[i]['community_code'] + m.arr_community[i]['id']);
        i_obj_set('d_community_code', m.arr_community[i]['community_code'])
        m_ins_code_set(m.arr_community[i]['community_code']);

    });
}

function m_ins_code_set(community_code) {
    var ins_code = 0;
//    alert(community_code + '00000' + m.info_num)
    ins_code = parseInt(community_code + '00000');
    i_obj_set('d_ins_code', ins_code)
}


