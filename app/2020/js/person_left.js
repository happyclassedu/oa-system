/**
 * 文件名称：person_left.js
 * 功能描述：菜单功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-08-09
 * 修改时间：2010-08-09
 * 当前版本：v1.0
 */
var xid = '';

$(document).ready(function(){
    m_get_session();
    m_a_load_plug();
});

function m_get_session(){
    $.ajax({
        url : i_act + 'a=info_session',
        success : function(txt){
            xid = txt;
        }
    });
}

function m_a_load_plug(){
    $('#a_person_usercenter').click(function(){
        parent.window.location.href = './info_person_usercenter.htm?a=ucenter';
     });
     
     $('#a_resume_list').click(function(){
        $('#a_resume_list').attr('href', './list_resume.htm?a=list&p_id=' + xid);
     });

     $('#a_resume_create').click(function(){
        $('#a_resume_create').attr('href', './info_resume.htm?a=add&p_id=' + xid);
     });

     $('#a_resume_letter').click(function(){
        $('#a_resume_letter').attr('href', './info_resume_letter.htm?a=add&p_id=' + xid);
     });
     
    $('#a_person_account').click(function(){
       $('#a_person_account').attr('href', './info_person_account.htm?a=view&x=' + xid);
    });

    $('#a_person_basic').click(function(){
        $('#a_person_basic').attr('href', './info_person_basic.htm?a=edit&x=' + xid);
    });

    $('#a_person_password').click(function(){
        $('#a_person_password').attr('href', './info_person_password.htm?a=edit&x=' + xid);
    });

    $('#a_person_email').click(function(){
        $('#a_person_email').attr('href', './info_person_email.htm?a=edit&x=' + xid);
    });

    $('#a_job_list').click(function(){
        $('#a_job_list').attr('href', './list_person_job.htm?a=list&p_id=' + xid);
    });

     $('#a_job_favorite').click(function(){
        $('#a_job_favorite').attr('href', './list_job_fav.htm?a=list&p_id=' + xid);
    });

     $('#a_job_applist').click(function(){
        $('#a_job_applist').attr('href', './list_job_applist.htm?a=list&p_id=' + xid);
    });

    $('#a_job_invite').click(function(){
        $('#a_job_invite').attr('href', './list_job_invite.htm?a=list&p_id=' + xid);
    });

    $('#a_info_person').click(function(){
        $('#a_info_person').attr('href', './info_person.htm?a=uhome');
    });

    $('#a_info_adsearch').click(function(){
        $('#a_info_adsearch').attr('href', './info_adsearch.htm?a=adsearch');
    });

     $('#a_info_clsearch').click(function(){
        $('#a_info_clsearch').attr('href', './info_clsearch.htm?a=clsearch');
    });

    $('#a_person_loginout').click(function(){
        m_info_loginout();
    });
}

function m_info_loginout(){
    $.ajax({
        url : i_act + 'a=info_loginout',
        success : function(txt){
            if('1'== txt){
                i_mdi_open('./info_person_login.htm?a=login', '' , 1);
            } else {
                alert('安全退出失败！');
            }
        }
    });
}

////个人和企业管理中心
function asecBoard(n)
{
    for(i=1;i<n;i++)
    {
        eval("document.getElementById('al0"+i+"').className='a102'");
        eval("abx0"+i+".style.display='none'");
    }
    eval("document.getElementById('al0"+n+"').className='a101'");
    eval("abx0"+n+".style.display='block'");
}
