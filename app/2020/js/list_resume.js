/**
 * 文件名称：list_resume.js
 * 功能描述：简历列表的前台程序。
 * 代码作者：王争强、钱宝伟
 * 创建日期：2010-07-29
 * 修改日期：2010-07-29
 * 当前版本：V1.0
 */

//$(document).ready(function(){
//    alert('最先执行');
//});
var pid = '';
var xid = '';
var rid ='' ;

function m_load() {
    m.tmp = m_ssession_verify('person');
    if (false == m.tmp) {
        return false;
    }
    pid= i_get('p_id');
    i_obj_hide('jpage_box');
    m_init_plug();
//    return false;  //可以终止初始化
}

//function m_list_num_load(){
//    i_obj_set('d_info_num', m.info_num);
//}

function m_btn_load_plug() {
    
    $('#a_resume_create').click(function(){
       $('#a_resume_create').attr('href', './info_resume.htm?a=add&p_id=' + pid);
    });

     $('#a_resume_letter').click(function(){
       $('#a_resume_letter').attr('href', './info_resume_letter.htm?a=add&p_id=' + pid);
    });

     $('#a_resume_c').click(function(){
        $('#a_resume_c').attr('href', './info_resume.htm?a=add&p_id=' + pid);
     });

 
}

function m_list_read_set_plug() {
    m.xtr.children(':eq(1)').html(m.arr[i]['rptype']);
    m.xtr.children(':eq(2)').html(m.arr[i]['rname']);
    if('1' == m.arr[i]['resume_def_state']){
        m.xtr.children(':eq(3)').html('是');
    } else {
        m.xtr.children(':eq(3)').html('否');
    }
    m.xtr.children(':eq(4)').html(m.arr[i]['browse_num']);
    if('cn' == m.arr[i]['rgift']){
        m.xtr.children(':eq(5)').html('中文');
    } else {
        m.xtr.children(':eq(5)').html('英文');
    }

//    var star_num = 0;
//
//    if(('' != m.arr[i]['name']) && ('' != m.arr[i]['sex']) && ('' != m.arr[i]['birth'])
//        && ('' != m.arr[i]['hukou']) && ('' != m.arr[i]['card_type']) && ('' != m.arr[i]['idcard'])
//        && ('' != m.arr[i]['degree']) && ('' != m.arr[i]['email']) && ('' != m.arr[i]['mobile'])){
//        star_num = star_num + 1;//完善【个人信息】的必填信息时,简历等级增加一颗星
//    }
//
//    if(('' != m.arr[i]['curr_trade']) && ('' != m.arr[i]['curr_big_classification']) && ('' != m.arr[i]['curr_small_classification'])
//        && ('' != m.arr[i]['curr_joblevel']) && ('' != m.arr[i]['trade']) && ('' != m.arr[i]['big_classification'])
//        && ('' != m.arr[i]['small_classification']) && ('' != m.arr[i]['addr1']) && ('' != m.arr[i]['addr2']) && ('' != m.arr[i]['post_time'])){
//        star_num = star_num + 1;//完善【职业概况/求职意向】的必填信息时，简历等级增加一颗星
//    }
//
//    if('' != m.arr[i]['selfvalue']){
//        star_num = star_num + 1;//完善【自我评价/职业目标】的必填信息时，简历等级增加一颗星
//    }
//
//    if(m.arr[i]['edu_num'] > 0){
//        star_num = star_num + 1;//增加【教育背景】时，简历等级增加一颗星
//    }
//
//    if(m.arr[i]['work_num'] > 0){
//        star_num = star_num + 1;//增加【工作经验】时，简历等级增加一颗星
//    }
//    var star_alt = '';
//    switch (star_num){
//        case 1:
//            star_alt = '一星';
//        break;
//        case 2:
//            star_alt = '二星';
//        break;
//        case 3:
//            star_alt = '三星';
//        break;
//        case 4:
//            star_alt = '四星';
//        break;
//            star_alt = '五星';
//        case 5:
//            star_alt = '六星';
//        break;
//        default:
//            star_alt = '零星';
//        break;
//    }
//    m.xtr.children(':eq(6)').html('<img src="../img/star_l' + star_num + '.jpg" width=55 height=10 alt="简历完整度：' + star_alt + '">');
    m.xtr.children(':eq(6)').html(m_star_level());
}

function m_list_read_btn_plug() {

    $('.btn_preview').click(function(){
         m.xid = this.parentNode.parentNode.id;
         m.xid = m.arr[m.xid]['id'];
         i_mdi_open('./info_resume_look.htm?a=view&x=' + m.xid);
    });

   $('.btn_fill').click(function(){
        m.xid = this.parentNode.parentNode.id;
        m.xid = m.arr[m.xid]['id'];
        i_mdi_open('./info_resume_home.htm?a=view&x=' + m.xid + '&rid=' + m.xid);
    });

    $('.btn_del_r').click(function(){
        m.tmp = '';
        m.xid = this.parentNode.parentNode.id;
        m.tmp = m.arr[m.xid]['rname'];
        m.xid = m.arr[m.xid]['id'];
        m_info_del_r();
    });
}

function m_info_del_r() {
    if (confirm('确定要删除“' + m.tmp + '”吗？')) {
        $.ajax({
            url : i_act + 'a=info_del&x=' + m.xid ,
            success : function(txt){
                if(txt > 0)
                {
                     window.location.reload();
                } else {
                     alert('删除' + m.tmp + '失败！');
                }
            }
        });
    }
}

function m_init_plug() {
    $.ajax({
        url : i_act + 'a=info_init' ,
        success : function(txt){
           m.info = i_json2js(txt);
           i_obj_set('d_loginid', m.info['loginid']);
           i_obj_set('d_info_num', m.info['info_num']);
        }
    });
}

function m_star_level() {
    var star_num = 0;

    if(('' != m.arr[i]['name']) && ('' != m.arr[i]['sex']) && ('' != m.arr[i]['birth'])
        && ('' != m.arr[i]['hukou']) && ('' != m.arr[i]['card_type']) && ('' != m.arr[i]['idcard'])
        && ('' != m.arr[i]['degree']) && ('' != m.arr[i]['email']) && ('' != m.arr[i]['mobile'])){
        star_num = star_num + 1;//完善【个人信息】的必填信息时,简历等级增加一颗星
    }

    if(('' != m.arr[i]['curr_trade']) && ('' != m.arr[i]['curr_big_classification']) && ('' != m.arr[i]['curr_small_classification'])
        && ('' != m.arr[i]['curr_joblevel']) && ('' != m.arr[i]['trade']) && ('' != m.arr[i]['big_classification'])
        && ('' != m.arr[i]['small_classification']) && ('' != m.arr[i]['addr1']) && ('' != m.arr[i]['addr2']) && ('' != m.arr[i]['post_time'])){
        star_num = star_num + 1;//完善【职业概况/求职意向】的必填信息时，简历等级增加一颗星
    }

    if('' != m.arr[i]['selfvalue']){
        star_num = star_num + 1;//完善【自我评价/职业目标】的必填信息时，简历等级增加一颗星
    }

    if(m.arr[i]['edu_num'] > 0){
        star_num = star_num + 1;//增加【教育背景】时，简历等级增加一颗星
    }

    if(m.arr[i]['work_num'] > 0){
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

