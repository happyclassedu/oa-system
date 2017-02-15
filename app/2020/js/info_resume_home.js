/**
 * 文件名称：info_resume_home.js
 * 功能描述：修改简历的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */
var rid = '';

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
    rid = i_get('rid');
    m.xtr = $('#list_itskill tbody tr:eq(0)').clone(true);
    m_list_itskill();
    m.atr = $('#list_train tbody tr:eq(0)').clone(true);
    m_list_train();
    m.btr = $('#list_educate tbody tr:eq(0)').clone(true);
    m_list_educate();
    m.ctr = $('#list_work tbody tr:eq(0)').clone(true);
    m_list_work();
    m.dtr = $('#list_item tbody tr:eq(0)').clone(true);
    m_list_item();
    m.etr = $('#list_cert tbody tr:eq(0)').clone(true);
    m_list_cert();
    m.ftr = $('#list_language tbody tr:eq(0)').clone(true);
    m_list_language();
//    m.xtr = $('#list_tb tbody tr:eq(0)').clone(true);
//    m_error_init();
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {
    $('#a_info_resume').click(function(){
       $('#a_info_resume').attr('href', './info_resume.htm?a=edit&x=' + rid + '&rid='+ rid);
    });

     $('#a_info_resume_basic').click(function(){
       $('#a_info_resume_basic').attr('href', './info_resume_basic.htm?a=edit&x=' + rid +'&rid='+ rid);
    });

      $('#a_info_resume_appraise').click(function(){
       $('#a_info_resume_appraise').attr('href', './info_resume_appraise.htm?a=edit&x=' + rid +'&rid='+ rid);
    });

    $('#a_info_resume_wish').click(function(){
       $('#a_info_resume_wish').attr('href', './info_resume_wish.htm?a=edit&x=' + rid +'&rid='+ rid);
    });

     $('#a_info_resume_educate').click(function(){
       $('#a_info_resume_educate').attr('href', './info_resume_educate.htm?a=add&x' + rid + '&rid=' + rid);
    });

     $('#a_info_resume_skill').click(function(){
       $('#a_info_resume_skill').attr('href', './info_resume_skill.htm?a=edit&x=' + rid);
    });

     $('#a_info_resume_train').click(function(){
       $('#a_info_resume_train').attr('href', './info_resume_train.htm?a=add&rid=' + rid + '&x=' + rid);
    });

      $('#a_info_resume_work').click(function(){
       $('#a_info_resume_work').attr('href', './info_resume_work.htm?a=add&rid=' + rid + '&x=' + rid);
    });

    $('#a_info_resume_item').click(function(){
       $('#a_info_resume_item').attr('href', './info_resume_item.htm?a=add&x=' + rid + '&rid=' + rid);
    });

      $('#a_info_resume_itskill').click(function(){
       $('#a_info_resume_itskill').attr('href', './info_resume_itskill.htm?a=add&x=' + rid + '&rid=' + rid);
    });

      $('#a_info_resume_cert').click(function(){
       $('#a_info_resume_cert').attr('href', './info_resume_cert.htm?a=add&x=' + rid + '&rid=' + rid);
    });

     $('#a_info_resume_language').click(function(){
       $('#a_info_resume_language').attr('href', './info_resume_language.htm?a=add&x=' + rid + '&rid=' + rid);
    });

       $('#a_info_resume_other').click(function(){
       $('#a_info_resume_other').attr('href', './info_resume_other.htm?a=edit&x=' + rid + '&rid=' + rid);
    });

}

function m_info_set_plug() {
    m_info_basic();
}

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
//    window.location.reload();
//    return false;  //可以终止跳转
//}

//function m_info_save_plug() {
//    return true;
//}

//function m_error_init(){
//
//}

function m_info_basic() {
    $.ajax({
        url : i_act + 'a=info_read&x=' + rid,
        success : function(txt){
            m.arr = i_json2js(txt);
            i_obj_set('d_rname', m.arr['rname']);
            if('cn' == m.arr['rgift']){
                i_obj_set('d_rgift', '中文');
            } else if('en' == m.arr['rgift']){
                i_obj_set('d_rgift', '英文');
            }
            if('1' == m.arr['resume_def_state']){
                i_obj_set('d_resume_def_state', '是');
            } else if('0' == m.arr['resume_def_state']){
                i_obj_set('d_resume_def_state', '否');
            }
            i_obj_set('d_etime', (m.arr['etime']).substring(0, 10));
            i_obj_set('d_addr1', m_arr2show(0, 1, m.arr['addr1'], array_province));
            i_obj_set('d_addr2', m_arr2show(0, 2, m.arr['addr2'], array_city));
            i_obj_set('d_curr_trade', m_arr2show(0, 1, m.arr['curr_trade'], array_industry));
            i_obj_set('d_curr_big_classification', m_arr2show(0, 1, m.arr['curr_big_classification'], array_occupation));
            i_obj_set('d_curr_small_classification', m_arr2show(0, 2, m.arr['curr_small_classification'], array_job));
            i_obj_set('d_trade', m_arr2show(0, 1, m.arr['trade'], array_industry));
            i_obj_set('d_big_classification', m_arr2show(0, 1, m.arr['big_classification'], array_occupation));
            i_obj_set('d_small_classification', m_arr2show(0, 2, m.arr['small_classification'], array_job));
            i_obj_set('d_star_img', m_star_level());
        }
    });
}

function m_star_level() {
    var star_num = 0;

    if(('' != m.arr['name']) && ('' != m.arr['sex']) && ('' != m.arr['birth'])
        && ('' != m.arr['hukou']) && ('' != m.arr['card_type']) && ('' != m.arr['idcard'])
        && ('' != m.arr['degree']) && ('' != m.arr['email']) && ('' != m.arr['mobile'])){
        star_num = star_num + 1;//完善【个人信息】的必填信息时,简历等级增加一颗星
    }

    if(('' != m.arr['curr_trade']) && ('' != m.arr['curr_big_classification']) && ('' != m.arr['curr_small_classification'])
        && ('' != m.arr['curr_joblevel']) && ('' != m.arr['trade']) && ('' != m.arr['big_classification'])
        && ('' != m.arr['small_classification']) && ('' != m.arr['addr1']) && ('' != m.arr['addr2']) && ('' != m.arr['post_time'])){
        star_num = star_num + 1;//完善【职业概况/求职意向】的必填信息时，简历等级增加一颗星
    }

    if('' != m.arr['selfvalue']){
        star_num = star_num + 1;//完善【自我评价/职业目标】的必填信息时，简历等级增加一颗星
    }

    if(m.arr['edu_num'] > 0){
        star_num = star_num + 1;//增加【教育背景】时，简历等级增加一颗星
    }

    if(m.arr['work_num'] > 0){
        star_num = star_num + 1;//增加【工作经验】时，简历等级增加一颗星
    }
    var star_alt = '';
    switch (star_num){
        case 1:
            star_alt = '一星';
        break;
        case 2:
            star_alt = '二星';
        break;
        case 3:
            star_alt = '三星';
        break;
        case 4:
            star_alt = '四星';
        case 5:
            star_alt = '五星';
        break;
        default:
            star_alt = '零星';
        break;
    }

    var star_img = '<img src="../img/star_l' + star_num + '.jpg" width=55 height=10 alt="简历完整度：' + star_alt + '">';
    return star_img;
}

function m_list_itskill(){
     $.ajax({
        url : i_act + 'a=list_read_i&rid=' + rid + '&type=itskill',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_itskill_val();
        }
    });
}

function m_list_itskill_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.xtr.attr('id', i);
        m.xtr.children(':eq(0)').html(m.arr[i]['i_txt0']);
        m.xtr.children(':eq(1)').html(m.arr[i]['name']);
        m.xtr.children(':eq(2)').html(m.arr[i]['i_txt1'] + '个月');
        m.xtr.children(':eq(3)').html(m.arr[i]['i_txt2']);
        m.tmp += m.xtr.parents().html();
    }
    $('#list_itskill tbody').html(m.tmp);
}

function m_list_train(){
     $.ajax({
        url : i_act + 'a=list_read_i&rid=' + rid + '&type=train',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_train_val();
        }
    });
}

function m_list_train_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.atr.attr('id', i);
        m.atr.children(':eq(0)').html(m.arr[i]['b_time'] + '至' + m.arr[i]['e_time']);
        m.atr.children(':eq(1)').html(m.arr[i]['name']);
        m.atr.children(':eq(2)').html(m.arr[i]['i_txt0']);
        m.atr.children(':eq(3)').html(m.arr[i]['i_txt1']);
        m.tmp += m.atr.parents().html();
    }
    $('#list_train tbody').html(m.tmp);
}

function m_list_educate(){
     $.ajax({
        url : i_act + 'a=list_read_i&rid=' + rid + '&type=educate',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_educate_val();
        }
    });
}

function m_list_educate_val() {
    m.tmp = '';
    var s ="";
   
    for(var i=0 ; i<m.arr.length; i++) {
        s = '<table width=100% border=0 cellpadding=4><tr ><td width="13%">学校名称：</td><td width="37%">' +  m.arr[i]['name'] +
            '</td><td width="13%">起止时间：</td><td width="37%">' + m.arr[i]['b_time'] + '至' + m.arr[i]['e_time'] +
            '</td></tr><tr ><td width="13%">专业名称：</td><td width="37%">' + m.arr[i]['i_txt0'] +
            '</td><td>学历：</td><td>' + m.arr[i]['i_txt1'] + '</td></tr><tr><td width="13%">专业描述：</td><td colspan="3">' + m.arr[i]['intor'] +
            '</td></tr></table>';
        m.btr.attr('id', i);
        m.btr.children(':eq(0)').html(s);
        m.tmp += m.btr.parents().html();
    }
    $('#list_educate tbody').html(m.tmp);
}

function m_list_work(){
     $.ajax({
        url : i_act + 'a=list_read_i&rid=' + rid + '&type=work',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_work_val();
        }
    });
}

function m_list_work_val() {
    m.tmp = '';
    var s ="";
    for(var i=0 ; i<m.arr.length; i++) {
        s = '<table width=100% border=0 cellpadding=4><tr><td width="13%">公司名称：</td><td width="37%">' +  m.arr[i]['name'] +
            '</td><td width="13%">起止时间：</td><td width="37%">' + m.arr[i]['b_time'] + '至' + m.arr[i]['e_time'] +
            '</td></tr><tr> <td width="13%">所属行业：</td><td width="37%">' + m_arr2show(0, 1, m.arr[i]['i_txt0'], array_industry) +
            '</td><td width="13%">公司规模：</td><td width="37%">' + m_arr2show(0, 1, m.arr[i]['i_txt1'], array_scale) + '</td></tr><tr> <td width="13%">公司性质：</td><td width="37%">' + m.arr[i]['i_txt2'] +
            '</td><td width="13%">职位名称：</td><td width="37%">' + m_arr2show(0, 1, m.arr[i]['i_txt3'], array_occupation) + ' ' + m_arr2show(0, 2, m.arr[i]['i_txt4'], array_job) +'</td></tr><tr><td width="13%">工作描述：</td><td colspan="3">' + m.arr[i]['intor'] +
            '</td></tr></table>';
        m.ctr.attr('id', i);
        m.ctr.children(':eq(0)').html(s);
        m.tmp += m.ctr.parents().html();
    }
    $('#list_work tbody').html(m.tmp);
}

function m_list_item(){
     $.ajax({
        url : i_act + 'a=list_read_i&rid=' + rid + '&type=item',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_item_val();
        }
    });
}

function m_list_item_val() {
    m.tmp = '';
    var s ="";
    for(var i=0 ; i<m.arr.length; i++) {
        s += '<table width=100% border=0 cellpadding=4><tr><td width="13%">项目名称：</td><td width="37%">' +  m.arr[i]['name'] +
            '</td><td width="13%">起止时间：</td><td width="37%">' + m.arr[i]['b_time'] + '至' + m.arr[i]['e_time'] +
            '</td></tr><tr><td  width="13%">软件环境：</td><td width="37%">' + m.arr[i]['i_txt1'] +
            '</td><td width="13%">硬件环境：</td><td width="37%">' + m.arr[i]['i_txt2'] + '</td></tr><tr> <td width="13%">开发工具：</td><td width="37%">' + m.arr[i]['i_txt3'] +
            '</td><td width="13%">是否是ＩＴ项目：</td><td width="37%">';
            if('0' == m.arr[i]['i_txt0'] || '' == m.arr[i]['i_txt0']){
                s += '否';
            } else {
                s += '是';
            }
            s += '</td></tr><tr><td width="13%">项目描述：</td><td colspan="3" width="37%">' + m.arr[i]['i_txt4'] +  '</td></tr><tr><td width="13%">责任描述：</td><td colspan="3" width="37%">' + m.arr[i]['intor'] +  '</td></tr></table>';
        m.dtr.attr('id', i);
        m.dtr.children(':eq(0)').html(s);
        m.tmp += m.dtr.parents().html();
    }
    $('#list_item tbody').html(m.tmp);
}

function m_list_cert(){
     $.ajax({
        url : i_act + 'a=list_read_i&rid=' + rid + '&type=cert',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_cert_val();
        }
    });
}

function m_list_cert_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.etr.attr('id', i);
        m.etr.children(':eq(0)').html(m.arr[i]['b_time']);
        m.etr.children(':eq(1)').html(m.arr[i]['name']);
        m.etr.children(':eq(2)').html(m.arr[i]['i_txt0']);
        m.tmp += m.etr.parents().html();
    }
    $('#list_cert tbody').html(m.tmp);
}

function m_list_language(){
     $.ajax({
        url : i_act + 'a=list_read_i&rid=' + rid + '&type=language',
        success : function(txt){
            m.arr = i_json2js(txt);  //将php文件进行解密，并返回到js
            m_list_language_val();
        }
    });
}

function m_list_language_val() {
    m.tmp = '';
    for(var i=0 ; i<m.arr.length; i++) {
        m.ftr.attr('id', i);
        m.ftr.children(':eq(0)').html(m.arr[i]['name']);
        m.ftr.children(':eq(1)').html(m.arr[i]['i_txt0']);
        m.ftr.children(':eq(2)').html(m.arr[i]['i_txt1']);
        m.ftr.children(':eq(3)').html(m.arr[i]['i_txt2']);
        m.tmp += m.ftr.parents().html();
    }
    $('#list_language tbody').html(m.tmp);
}
