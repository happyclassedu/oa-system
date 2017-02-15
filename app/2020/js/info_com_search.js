/**
 * 文件名称：info_com_search.js
 * 功能描述：快速搜索功能的前台程序。
 * 代码作者：王争强
 * 创建日期：2010-07-13
 * 修改时间：2010-07-13
 * 当前版本：v1.0
 */

//$(document).ready(function(){
//
//});

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }

    m_check_issession();
    m_load_arr_plug(); //加载数组
//    return false;  //可以终止初始化
}


function m_btn_load_plug() {

     $('#a_info_adsearch').click(function(){
       $('#a_info_adsearch').attr('href', './info_com_adsearch.htm?a=adsearch');
    });
    
    $('#btn_search').click(function(){
//        $('#a_list_job').attr('href', './list_job.htm?a=list&c_id=' + cid);
        var key = i_obj_val('d_key');
        if('' == key){
            key = 'null';
        }
        var big_classification = i_obj_val('d_big_classification');
        if('' == big_classification){
            big_classification = '0';
        }
        var small_classification = i_obj_val('d_small_classification');
        if('' == small_classification){
            small_classification = '0';
        }
        var addr1 = i_obj_val('d_addr1');
        if('' == addr1){
            addr1 = '0';
        }
        var addr2 = i_obj_val('d_addr2');
        if('' == addr2){
            addr2 = '0';
        }
        var trade = i_obj_val('d_trade');
        if('' == trade){
            trade = '0';
        }
        var atime = i_obj_val('d_atime');
        if('' == atime){
            atime = '0';
        }
        if('请输入关键字' == key){
            alert('请输入关键字');
        } else {
            i_mdi_open('./list_com_search.htm?a=search&jobtype=' + big_classification +',' + small_classification +  '&trade=' + trade + '&workplace=' + addr1 +',' + addr2 + '&publishdate=' + atime + '&key=' + key);
        }
    });

}

function m_info_set_plug() {

}

//function m_info_add_plug() {
//}


//function m_info_edit_plug() {
//}

//function m_info_view_plug() {
//
//}

//function m_info_input_plug(state) {
//
//}

function m_act_url_plug() {
    return false;  //可以终止跳转
}

//function m_info_save_plug() {
//    return true;
//}

function m_load_arr_plug(){
    m.tmp = '';
    m_info_industry_plug('d_trade');
    m_info_occupation_plug('d_big_classification', 'd_small_classification');
    m_info_job_plug('d_small_classification');
    m_info_province_plug('d_addr1', 'd_addr2');
    m_info_city_plug('d_addr2');
}

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
                i_mdi_open('./index_com.htm?a=chome', '企业服务' , 1);
            } else {
                alert('安全退出失败！');
            }
        }
    });
}

//切换标签
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