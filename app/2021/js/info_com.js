/**
 * 文件名称：info_com.js
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
    m_load_arr_plug(); //加载数组
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#d_fname').blur(function(){
        m_info_name_check(this.id);
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

//function m_act_url_plug() {
//    return false;  //可以终止跳转
//}

function m_info_save_plug() {
    m.tmp = i_obj_val('d_i_tmp0');
    if ('' == m.tmp) {
          m_error_msg('d_error_i_tmp0', '网络招聘会类型不能为空，请选择！', '0');
        return false;
    }else {
        m_error_msg('d_error_i_tmp0', '通过', '2');
    }

    m.tmp = i_obj_val('d_fname');
    if ('' == m.tmp) {
          m_error_msg('d_error_fname', '公司名称不能为空，请填写！', '0');
        return false;
    }else {
        m_error_msg('d_error_fname', '通过', '2');
    }

//    m.tmp = i_obj_val('d_sname');
//    if ('' == m.tmp) {
//          m_error_msg('d_error_sname', '公司简称不能为空，请填写！', '0');
//        return false;
//    }else {
//        m_error_msg('d_error_sname', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_regid');
//    if ('' == m.tmp) {
//          m_error_msg('d_error_regid', '营业执照编码不能为空，请填写！', '0');
//        return false;
//    }else {
//        m_error_msg('d_error_regid', '通过', '2');
//    }
//
//     m.tmp = i_obj_val('d_legal');
//    if ('' == m.tmp) {
//          m_error_msg('d_error_legal', '企业法人不能为空，请填写！', '0');
//        return false;
//    }else {
//        m_error_msg('d_error_legal', '通过', '2');
//    }
//
//     m.tmp = i_obj_val('d_legalid');
//    if ('' == m.tmp) {
//          m_error_msg('d_error_legalid', '法人身份证不能为空，请填写！', '0');
//        return false;
//    }else {
//        m_error_msg('d_error_legalid', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_orgid');
//    if ('' == m.tmp) {
//          m_error_msg('d_error_orgid', '组织机构代码不能为空，请填写！', '0');
//        return false;
//    }else {
//        m_error_msg('d_error_orgid', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_trade');
//    if ('' == m.tmp) {
//          m_error_msg('d_error_trade', '所属行业不能为空，请选择！', '0');
//        return false;
//    }else {
//        m_error_msg('d_error_trade', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_type');
//    if ('' == m.tmp) {
//        m_error_msg('d_error_type','公司性质不能为空，请选择！','0');
//        return false;
//    }else {
//        m_error_msg('d_error_type', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_pnum');
//    if ('' == m.tmp) {
//         m_error_msg('d_error_pnum','公司规模不能为空，请选择！','0');
//        return false;
//    }else {
//        m_error_msg('d_error_pnum', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_address');
//    if ('' == m.tmp) {
//         m_error_msg('d_error_address','所在地区不能为空，请填写！','0');
//        return false;
//    }else {
//        m_error_msg('d_error_address', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_addrcity');
//    if('' == m.tmp){
//        m_error_msg('d_error_addrcity', '企业注册地点不能为空，请填写！', '0');
//        return false;
//    } else {
//        m_error_msg('d_error_addrcity', '通过', '2');
//    }
//
//     m.tmp = i_obj_val('d_com_time');
//    if('' == m.tmp){
//        m_error_msg('d_error_com_time', '成立日期不能为空，请填写！', '0');
//        return false;
//    } else {
//        m_error_msg('d_error_com_time', '通过', '2');
//    }
//
//     m.tmp = i_obj_val('d_operat_time');
//    if('' == m.tmp){
//        m_error_msg('d_error_operat_time', '营业期限不能为空，请填写！', '0');
//        return false;
//    } else {
//        m_error_msg('d_error_operat_time', '通过', '2');
//    }
//
//     m.tmp = i_obj_val('d_app_authority');
//    if('' == m.tmp){
//        m_error_msg('d_error_app_authority', '审查机关不能为空，请填写！', '0');
//        return false;
//    } else {
//        m_error_msg('d_error_app_authority', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_intro');
//    if ('' == m.tmp) {
//             m_error_msg('d_error_intro','公司简介不能为空，请填写！','0');
//        return false;
//    }else {
//        m_error_msg('d_error_intro', '通过', '2');
//    }
//
//     m.tmp = i_obj_val('d_linkman');
//    if ('' == m.tmp) {
//        m_error_msg('d_error_linkman', '联系人不能为空，请填写', '0');
//        return false;
//    } else {
//        m_error_msg('d_error_linkman', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_tel1');
//    if('' == m.tmp){
//        m_error_msg('d_error_tel1', '固定电话不能为空，请重新输入', '0');
//        return false;
//    } else {
//        if (!m_checkTelephone(m.tmp)) {
//            m_error_msg('d_error_tel1', '固定电话格式不正确，请重新填写！', '0');
//            return false;
//        } else {
//            m_error_msg('d_error_tel1', '通过', '2');
//        }
//    }
//
//    m.tmp = i_obj_val('d_tel2');
//    if('' == m.tmp){
//        m_error_msg('d_error_tel2', '手机不能为空，请填写！', '0');
//        return false;
//    } else {
//        if (!m_checkMobilePhone(m.tmp)) {
//            m_error_msg('d_error_tel2', '手机格式不正确，请重新输入！', '0');
//            return false;
//        } else {
//            m_error_msg('d_error_tel2', '通过', '2');
//        }
//    }
//
//    m.tmp = i_obj_val('d_fax');
//    if('' != m.tmp){
//        if (!m_checkTelephone(m.tmp)) {
//            m_error_msg('d_error_fax', '传真格式不正确，请重新填写！', '0');
//            return false;
//        } else {
//            m_error_msg('d_error_fax', '通过', '2');
//        }
//    }
//
//    m.tmp = i_obj_val('d_email');
//    if('' == m.tmp){
//        m_error_msg('d_error_email', '电子邮箱不能为空，请重新输入！', '0');
//        return false;
//    } else {
//        if (!m_checkEmail(m.tmp)) {
//            m_error_msg('d_error_email', '邮箱格式不正确，请重新输入！', '0');
//            return false;
//        } else {
//            m_error_msg('d_error_email', '通过', '2');
//        }
//    }
//
//    m.tmp = i_obj_val('d_web');
//    if('' == m.tmp){
//        m_error_msg('d_error_web', ' 公司网站不能为空，请填写！', '0');
//        return false;
//    } else {
//        m_error_msg('d_error_web', '通过', '2');
//    }
//
//    m.tmp = i_obj_val('d_postid');
//    if('' == m.tmp){
//        m_error_msg('d_error_postid', '邮政编码不能为空，请重新输入！', '0');
//        return false;
//    } else {
//        if (!m_checkPostCode(m.tmp)) {
//            m_error_msg('d_error_postid', '邮政编码格式不正确，请重新输入！', '0');
//            return false;
//        } else {
//            m_error_msg('d_error_postid', '通过', '2');
//        }
//    }
//
//    m.tmp = i_obj_val('d_postaddr');
//    if('' == m.tmp){
//        m_error_msg('d_error_postaddr', '邮政地址不能为空，请重新输入！', '0');
//        return false;
//    } else {
//        m_error_msg('d_error_postaddr', '通过', '2');
//    }

    return true;


}

function m_load_arr_plug(){
    m.tmp = '';
    m_info_industry_plug('d_trade');
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
                    m_error_msg('d_error_fname', '对不起：数据库中已存在相同值！', '0');
                    $('#' + obj_id).focus();
                } else {
                    m.check = '0';
                }
            }
        });
    }
}


