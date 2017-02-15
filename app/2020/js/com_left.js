/**
 * 文件名称：com_left.js
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
        url : g.act + 'index_com.php?a=info_session',
        success : function(txt){
            xid = txt;
        }
    });
}

function m_a_load_plug(){
    $('#a_com_usercenter').click(function(){
        $('#a_com_usercenter').attr('href', './info_com_usercenter.htm?a=ucenter');
    });

    $('#a_com_view').click(function(){
       $('#a_com_view').attr('href', './info_com_view.htm?a=view&x=' + xid);
    });

    $('#a_com_basic').click(function(){
       $('#a_com_basic').attr('href', './info_com_basic.htm?a=edit&x=' + xid);
    });

    $('#a_com_contact').click(function(){
       $('#a_com_contact').attr('href', './info_com_contact.htm?a=edit&x=' + xid);
    });

    $('#a_com_account').click(function(){
       $('#a_com_account').attr('href', './info_com_account.htm?a=view&x=' + xid);
    });

    $('#a_com_password').click(function(){
        $('#a_com_password').attr('href', './info_com_password.htm?a=edit&x=' + xid);
    });

    $('#a_info_job').click(function(){
        $('#a_info_job').attr('href', './info_job.htm?a=add');
    });

    $('#a_list_job').click(function(){
        $('#a_list_job').attr('href', './list_job.htm?a=list');
    });

      $('#a_resume_accept').click(function(){
        $('#a_resume_accept').attr('href', './list_resume_accept.htm?a=list');
    });

    $('#a_resume_fav').click(function(){
        $('#a_resume_fav').attr('href', './list_resume_fav.htm?a=list');
    });

     $('#a_resume_database').click(function(){
        $('#a_resume_database').attr('href', './list_resume_database.htm?a=list');
    });

     $('#a_resume_interview').click(function(){
        $('#a_resume_interview').attr('href', './info_resume_interview.htm?a=add');
    });

    $('#a_resume_recycle').click(function(){
        $('#a_resume_recycle').attr('href', './list_resume_recycle.htm?a=list');
    });
    
    $('#a_info_search').click(function(){
        $('#a_info_search').attr('href', './info_com_search.htm?a=search');
    });
    
       $('#a_info_adsearch').click(function(){
        $('#a_info_adsearch').attr('href', './info_com_adsearch.htm?a=adsearch');
    });
    $('#a_info_clsearch').click(function(){
        $('#a_info_clsearch').attr('href', './info_com_clsearch.htm?a=clsearch');
    });

    $('#a_com_loginout').click(function(){
        m_info_loginout();
    });
}


function m_info_loginout(){
    $.ajax({
        url : g.act + 'index_com.php?a=info_loginout',
        success : function(txt){
            if('1'== txt){
                i_mdi_open('../htm/info_com_login.htm?a=login', '' ,1);
            } else {
                alert('安全退出失败！');
            }
        }
    });
}




////个人和企业管理中心
function asecBoard(n) 
{ 
    for(i=1;i<5;i++)
    { 
        eval("document.getElementById('al0"+i+"').className='a102'"); 
        eval("abx0"+i+".style.display='none'"); 
    } 
    eval("document.getElementById('al0"+n+"').className='a101'"); 
    eval("abx0"+n+".style.display='block'"); 
}
////培训机构管理中心
function bsecBoard(n)  
{ 
    for(i=1;i<8;i++) 
    { 
        eval("document.getElementById('bl0"+i+"').className='b102'"); 
        eval("bbx0"+i+".style.display='none'"); 
    } 
    eval("document.getElementById('bl0"+n+"').className='b101'"); 
    eval("bbx0"+n+".style.display='block'"); 
}


//院校管理中心
function csecBoard(n) 
{ 
    for(i=1;i<5;i++) 
    { 
        eval("document.getElementById('cl0"+i+"').className='c102'"); 
        eval("cbx0"+i+".style.display='none'"); 
    } 
    eval("document.getElementById('cl0"+n+"').className='c101'"); 
    eval("cbx0"+n+".style.display='block'"); 
}
