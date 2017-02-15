/**
 * 文件名称：info_job.js
 * 功能描述：发布职位的信息控制器JS
 * 代码作者：王争强（创建）
 * 创建时间：2010_11_18
 * 修改时间：2010-11-18
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('1最先执行');
//});

function m_load() {
//    m.check = '0';
    m.arr_info = ''; //自定义数组
    m.c_id = i_get('c_id');
    if('' == m.c_id){
        alert('对不起，传入参数出错，请检查！');
        return false
    }
     m.ws_id = i_get('ws_id');
//    m_load_arr_plug(); //加载数组

    //    alert(m.xid);
    //    return false;  //可以终止初始化
}

function m_btn_load_plug() {
//    $('#d_name, #d_name_e, #d_name_s').blur(function(){
//        m_info_name_check(this.id);
//    });btn_add_mm

    $('#btn_add_mm').click(function(){
        i_mdi_open('./info_job.htm?a=add&c_id=' + i_obj_val('d_cid'), '发布信息--职位信息');
    });

    $('#d_begin').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_end').jdate({
        dateFormat: 'yy-mm-dd'
    });
    
}

//function m_info_set_plug() {
//}

function m_info_add_plug() {
    //    $('#info_tb tbody tr:eq(2)').hide('slow');
    //    i_obj_hide('tr3h');
    i_obj_set('d_ws_id', m.ws_id);
    m_info_com();
    $('#d_name').addClass('info_must');
}

function m_info_edit_plug() {
    //    $('#d_name, #d_name_e, #d_name_s').addClass('info_must');
    $('#d_name').addClass('info_must');
}

function m_info_view_plug() {
    //    $('#d_name, #d_name_e, #d_name_s').removeClass('info_must');
    $('#d_name').removeClass('info_must');
}

//function m_info_input_plug(state) {
//}

function m_act_url_plug() {
    m.act_url = i_obj_val('act_url');
    switch (m.act_url) {
        default: case 'view':
            i_mdi_open('./' + g_id + '.htm?a=view&x=' + m.xid + '&c_id=' + m.c_id, '查看信息', 1);
            break;
        case 'add':
            i_mdi_open('./' + g_id + '.htm?a=add&c_id=' + m.c_id + '&ws_id=' + m.ws_id , '新增信息', 1);
            break;
        case 'list':
            i_mdi_open('./list_' + g.id_name + '.htm?a=list&c_id=' + m.c_id , '列表管理', 1);
            break;
    }
    return false;  //可以终止跳转
}

function m_info_save_plug() {

    if ('' == i_obj_val('d_cid')) {
        alert('对不起，网址ID的参数传入出错，请检查！');
        return false;
    }

    m.tmp = i_obj_val('d_name');
    if ('' == m.tmp) {
          i_error_msg('d_error_name', '职位名称不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_type');
    if ('' == m.tmp) {
          i_error_msg('d_error_type', '职位性质不能为空，请选择！', '0');
        return false;
    }else {
        i_error_msg('d_error_type', '通过', '2');
    }

    m.tmp = i_obj_val('d_type2');
    if ('' == m.tmp) {
          i_error_msg('d_error_type2', '岗位性质不能为空，请选择！', '0');
        return false;
    }else {
        i_error_msg('d_error_type2', '通过', '2');
    }

    m.tmp = i_obj_val('d_begin');
    if ('' == m.tmp) {
          i_error_msg('d_error_begin', '招聘开始时间不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error_begin', '通过', '2');
    }

    m.tmp = i_obj_val('d_end');
    if ('' == m.tmp) {
        i_error_msg('d_error_begin', '招聘结束时间不能为空，请填写！', '0');
        return false;
    }else {
        if(m.tmp > i_obj_val('d_begin')) {
            i_error_msg('d_error_begin', '招聘结束时间大于开始时间不能为空，请填写！', '0');
            return false;
        } else {
            i_error_msg('d_error_begin', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_num');
    if ('' == m.tmp) {
          i_error_msg('d_error_num', '招聘人数不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error_num', '通过', '2');
    }

    m.tmp = i_obj_val('d_big_classification');
    if ('' == m.tmp) {
          i_error_msg('d_error_classification', '职位大类不能为空，请选择！', '0');
        return false;
    }else {
        i_error_msg('d_error_classification', '通过', '2');
    }

    m.tmp = i_obj_val('d_small_classification');
    if ('' == m.tmp) {
        i_error_msg('d_error_classification', '职位小类不能为空，请选择！', '0');
        return false;
    }else {
        i_error_msg('d_error_classification', '通过', '2');
    }

    m.tmp = i_obj_val('d_addr');
    if ('' == m.tmp) {
          i_error_msg('d_error_addr', '工作地区不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error_addr', '通过', '2');
    }

    m.tmp = i_obj_val('d_intro');
    if ('' == m.tmp) {
          i_error_msg('d_error_intro', '职位描述不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error_intro', '通过', '2');
    }

    m.tmp = i_obj_val('d_org_name');
    if ('' == m.tmp) {
          i_error_msg('d_error_org_name', '所属部门不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error_org_name', '通过', '2');
    }

    m.tmp = i_obj_val('d_linkman');
    if ('' == m.tmp) {
          i_error_msg('d_error_linkman', '联系人不能为空，请填写！', '0');
        return false;
    }else {
        i_error_msg('d_error_linkman', '通过', '2');
    }

    m.tmp = i_obj_val('d_tel');
    if('' == m.tmp){
        i_error_msg('d_error_tel', '固定电话不能为空，请重新输入', '0');
        return false;
    } else {
        if (!i_verfy_tel(m.tmp)) {
            i_error_msg('d_error_tel', '固定电话格式不正确，请重新填写！', '0');
            return false;
        } else {
            i_error_msg('d_error_tel', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_tel2');
    if('' == m.tmp){
        i_error_msg('d_error_tel2', '联系手机不能为空，请重新输入', '0');
        return false;
    } else {
        if (!i_verfy_tel(m.tmp)) {
            i_error_msg('d_error_tel2', '联系格式不正确，请重新填写！', '0');
            return false;
        } else {
            i_error_msg('d_error_tel2', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_fax');
    if('' != m.tmp){
        if (!i_verfy_tel(m.tmp)) {
            i_error_msg('d_error_fax', '传真格式不正确，请重新填写！', '0');
            return false;
        } else {
            i_error_msg('d_error_fax', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_email');
    if('' == m.tmp){
        i_error_msg('d_error_email', '电子邮箱不能为空，请重新输入！', '0');
        return false;
    } else {
        if (!i_verfy_email(m.tmp)) {
            i_error_msg('d_error_email', '邮箱格式不正确，请重新输入！', '0');
            return false;
        } else {
            i_error_msg('d_error_email', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_postcode');
    if('' == m.tmp){
        i_error_msg('d_error_postcode', '邮政编码不能为空，请重新输入！', '0');
        return false;
    } else {
        if (!i_verfy_post(m.tmp)) {
            i_error_msg('d_error_postcode', '邮政编码格式不正确，请重新输入！', '0');
            return false;
        } else {
            i_error_msg('d_error_postcode', '通过', '2');
        }
    }

    m.tmp = i_obj_val('d_address');
    if('' == m.tmp){
        i_error_msg('d_error_address', '邮政地址不能为空，请重新输入！', '0');
        return false;
    } else {
        i_error_msg('d_error_address', '通过', '2');
    }

    m.tmp = i_obj_val('d_web');
    if('' == m.tmp){
        i_error_msg('d_error_web', '公司主页不能为空，请重新输入！', '0');
        return false;
    } else {
        i_error_msg('d_error_web', '通过', '2');
    }
//    if ('1' == m.check) {
//        alert('对不起：数据库中已存在相同值！');
//        return false;
//    }

    return true;
}

//function m_info_del_ok() {
//    i_mdi_open('./list_' + g.id_name + '.htm?a=list' , '列表管理', 1);
//}

function m_info_del_fail(arr) {
    if (0 == arr) {
        alert('删除：“' + m.info['name'] + '”失败！');
    }
}

//function m_info_name_check(obj_id) {
//    m.arr = i_obj_val(obj_id);
//    if ('' != m.arr) {
//        $.ajax({
//            url : i_act + 'a=info_name_check&x=' + m.xid + '&obj_id=' + obj_id.substr(2),
//            data : 'arr=' + i_js2json(m.arr),
//            success : function(txt){
//                m.arr = i_json2js(txt);
//                if (0 < m.arr) {
//                    m.check = '1';
//                    alert('对不起：数据库中已存在相同值！');
//                    $('#' + obj_id).focus();
//                } else {
//                    m.check = '0';
//                }
//            }
//        });
//    }
//}

function m_info_com(){
    $.ajax({
        url : i_act + 'a=info_com&c_id=' + m.c_id,
        success : function(txt){
            //            alert(txt);
            m.arr_info = i_json2js(txt);
            i_obj_set('d_cid', m.arr_info['id']);
            i_obj_set('d_cname', m.arr_info['fname']);
        }
    });
}

//function m_load_arr_plug(){
//    m.tmp = '';
//    i_info_occupation_plug('d_big_classification', 'd_small_classification');
//    i_info_job_plug('d_small_classification');
//}
