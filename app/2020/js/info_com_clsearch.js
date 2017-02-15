var cid = '';

$(document).ready(function(){
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    
    m_check_issession();
});


function m_check_issession(){
    $.ajax({
        url : g.act + 'index_com.php?a=info_init',
        success : function(txt){
            m.arr = i_json2js(txt);
            cid = m.arr['id'];
            var str = '';
            if('' != cid){
                str = '<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">';
                str += '<TR><TD align="center" height="27">欢迎您『 <span style="color:Red;">' + m.arr['fname'] + '</span> 』</TD></TR>';
                str += '<TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A href="./list_job.htm?a=list">职位管理</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A href="./list_resume_accept.htm?a=list">招聘管理</A></TD></TR>';
                str += '<TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A href="./info_search.htm?a=search">简历搜索</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A href="info_com_basic.htm?a=edit&x=' + cid + '">帐号管理</A></TD></TR>';
                str += '<TR><TD align="center" height="27"><IMG height="7" src="../img/Icon3.gif" width="7"><A href="">视频招聘</A>&nbsp;&nbsp;&nbsp;<IMG height="7" src="../img/Icon3.gif" width="7"><A href="" onclick="m_info_loginout()">安全退出</A></TD></TR>';
                str += '</TABLE>';
                i_obj_set('d_pan_login', str);
            }
        }
    });
}

/******安全退出*******/
function m_info_loginout(){
    $.ajax({
        url : g.act + 'index_com.php?a=info_loginout',
        success : function(txt){
            if('1'== txt){
                i_mdi_open('./info_com.htm?a=chome', '企业服务' , 1);
            } else {
                alert('安全退出失败！');
            }
        }
    });
}

function asecBoard(n)
{
    for(i=1;i<4;i++)
    {
        eval("document.getElementById('al0"+i+"').className='a102'");
        eval("abx0"+i+".style.display='none'");
    }
    eval("document.getElementById('al0"+n+"').className='a101'");
    eval("abx0"+n+".style.display='block'");
}