/**
 * 文件名称：resume_left.js
 * 功能描述：菜单功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */
var rid = '';
var arr = '';
var Request = new Object();

$(document).ready(function(){
    Request = GetRequest();
    rid = Request['rid'];
    m_a_load_plug();
    m_get_resume();
});

function m_a_load_plug(){
     $('#a_resume_basic').click(function(){
         parent.window.location.href = './info_resume_basic.htm?a=edit&x=' + rid + '&rid='+ rid;
//         i_mdi_open('./info_resume_basic.htm?a=edit&x=' + xid);
     });

     $('#a_resume_educate').click(function(){
         parent.window.location.href = './info_resume_educate.htm?a=add&x=' + rid + '&rid=' + rid;
//         i_mdi_open('./info_resume_educate.htm?a=add&rid=' + xid);
     });

     $('#a_resume_wish').click(function(){
         parent.window.location.href = './info_resume_wish.htm?a=edit&x=' + rid + '&rid='+ rid;
//         i_mdi_open('./info_resume_wish.htm?a=edit&x=' + xid);
     });

     $('#a_resume_appraise').click(function(){
         parent.window.location.href = './info_resume_appraise.htm?a=edit&x=' + rid + '&rid='+ rid;
//         i_mdi_open('./info_resume_wish.htm?a=edit&x=' + xid);
     });

     $('#a_resume_work').click(function(){
         parent.window.location.href = './info_resume_work.htm?a=add&x=' + rid + '&rid=' + rid;
//         i_mdi_open('./info_resume_work.htm?a=add&rid=' + xid);
     });

     $('#a_resume_language').click(function(){
          parent.window.location.href = './info_resume_language.htm?a=add&x=' + rid + '&rid=' + rid;
//         i_mdi_open('./info_resume_language.htm?a=add&rid=' + xid);
     });

     $('#a_resume_train').click(function(){
         parent.window.location.href = './info_resume_train.htm?a=add&x=' + rid + '&rid=' + rid;
//         i_mdi_open('./info_resume_train.htm?a=add&rid=' + xid);
     });

     $('#a_resume_skill').click(function(){
         parent.window.location.href = './info_resume_skill.htm?a=edit&x=' + rid + '&rid='+ rid;
//         i_mdi_open('./info_resume_skill.htm?a=add&rid=' + xid);
     });

      $('#a_resume_itskill').click(function(){
         parent.window.location.href = './info_resume_itskill.htm?a=add&x=' + rid + '&rid=' + rid;
//         i_mdi_open('./info_resume_skill.htm?a=add&rid=' + xid);
     });
     
     $('#a_resume_item').click(function(){
         parent.window.location.href = './info_resume_item.htm?a=add&x=' + rid + '&rid=' + rid;
//         i_mdi_open('./info_resume_item.htm?a=add&rid=' + xid);
     });

     $('#a_resume_cert').click(function(){
         parent.window.location.href = './info_resume_cert.htm?a=add&x=' + rid +'&rid=' + rid;
//         i_mdi_open('./info_resume_cert.htm?a=add&rid=' + xid);
     });

      $('#a_resume_other').click(function(){
         parent.window.location.href = './info_resume_other.htm?a=edit&x=' + rid + '&rid='+ rid;
//         i_mdi_open('./info_resume_other.htm?a=edit&x=' + xid);
     });

     $('#a_resume_look').click(function(){
         i_mdi_open('./info_resume_look.htm?a=view&x=' + rid);
     });

     $('#a_resume_home').click(function(){
         parent.window.location.href = './info_resume_home.htm?a=view&x=' + rid + '&rid=' + rid;
     });
}

function GetRequest() {
   var url = parent.location.href; //获取url中"?"符后的字串
   var theRequest = new Object();
   if (url.indexOf("?") != -1) {
      var str = url.substr(1);
      strs = str.split("&");
      for(var i = 0; i < strs.length; i ++) {
         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
      }
   }
   return theRequest;
}

function m_get_resume(){
     $.ajax({
            url : i_act + 'a=info_read&x=' + rid ,
            success : function(txt){
                arr = i_json2js(txt);
                i_obj_set('d_rname', arr['rname']);
                m_img_sign();
            }
        });
}

//【左侧栏图标】函数：填写完成时，显示对号图片；必填项未填时，显示星号图片。
function m_img_sign() {
    var img_fit = '<IMG height=12 src="../img/Icon4_2.gif" width=12>'; // 显示对号图标
    var img_asterisk = '<IMG height=12   src="../img/Icon4_3.gif" width=12>'; //显示星号图标

    if(('' != arr['name']) && ('' != arr['sex']) && ('' != arr['birth'])
        && ('' != arr['hukou']) && ('' != arr['card_type']) && ('' != arr['idcard'])
        && ('' != arr['degree']) && ('' != arr['email']) && ('' != arr['mobile'])){
        i_obj_set('d_img_basc', img_fit); //完善【个人信息】的必填信息时, 显示对号图标。
    } else {
        i_obj_set('d_img_basc', img_asterisk); //未填写【个人信息】的必填信息时, 显示星号图标。
    }

    if(('' != arr['curr_trade']) && ('' != arr['curr_big_classification']) && ('' != arr['curr_small_classification'])
        && ('' != arr['curr_joblevel']) && ('' != arr['trade']) && ('' != arr['big_classification'])
        && ('' != arr['small_classification']) && ('' != arr['addr1']) && ('' != arr['addr2']) && ('' != arr['post_time'])){
        i_obj_set('d_img_wish', img_fit); //完善【职业概况/求职意向】的必填信息时，显示对号图标。
    } else {
        i_obj_set('d_img_wish', img_asterisk); //未填写【职业概况/求职意向】的必填信息时, 显示星号图标。
    }

    if('' != arr['selfvalue']){
        i_obj_set('d_img_appraise', img_fit); //完善【自我评价/职业目标】的必填信息时，显示对号图标。
    } else {
        i_obj_set('d_img_appraise', img_asterisk); //未填写【自我评价/职业目标】的必填信息时，显示星号图标。
    }

    if(arr['edu_num'] > 0){
        i_obj_set('d_img_educate', img_fit); //【教育背景】的数据条数大于1时，显示对号图标。
    } else {
        i_obj_set('d_img_educate', img_asterisk); //【教育背景】的数据条数小于1时，显示星号图标。
    }

    if(arr['work_num'] > 0){
        i_obj_set('d_img_work', img_fit); //【工作经验】的数据条数大于1时，显示对号图标。
    } else {
        i_obj_set('d_img_work', img_asterisk); //【工作经验】的数据条数小于1时，显示星号图标。
    }
}
