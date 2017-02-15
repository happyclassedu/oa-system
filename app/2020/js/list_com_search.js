/**
* 文件名称：list_com_search.js
* 功能描述：职位列表的前台程序。
* 代码作者：王争强
* 创建日期：2010-07-29
* 修改日期：2010-07-29
* 当前版本：V1.0
*/
var cid = '';

//url参数
var job_type = '';
var type2 = '';
var degree = '';
var work_term = '';
var sex = '';
var age_1 = '';
var age_2 = '';
var pay_type = '';
var pay = '';
var big_classification = '';
var small_classification = '';
var addr1 = '';
var addr2 = '';
var trade = '';
var workplace = '';
var publishdate = '';
var key = '';

var array = ''; //转化url参数成为数组


//$(document).ready(function(){
//    alert('最先执行');
//});

function m_load() {
    m.tmp = m_ssession_verify('com');
    if (false == m.tmp) {
        return false;
    }
    
    m_check_issession();
    m.show_num = 20; //默认20条信息
    m_load_arr_plug(); //加载数组
    
    jobtype = i_get('jobtype');
    type2 = i_get('type2');
    if('null' == type2){
        type2 = '';
    }

    degree = i_get('degree');
    if('null' == degree){
        degree = '';
    }

    work_term = i_get('work_term');
    if('null' == work_term){
        work_term = '';
    }

    sex = i_get('sex');
    if('null' == sex){
        sex = '';
    }

    age_1 = i_get('age_1');
    if('0' == age_1){
        age_1 = '';
    }
    age_2 = i_get('age_2');
    if('0' == age_2){
        age_2 = '';
    }

    pay_type = i_get('pay_type');
    if('null' == pay_type){
        pay_type = '';
    }

    pay = i_get('pay');
    if('0' == pay){
        pay = '';
    }

    trade = i_get('trade');
    if('0' != trade){
        i_obj_set('d_trade', trade);
    } else {
        i_obj_set('d_trade', '');
        trade =  '';
    }


    workplace = i_get('workplace');
    publishdate = i_get('publishdate');
    if('0' != publishdate){
        i_obj_set('d_atime', publishdate);
    } else {
        i_obj_set('d_atime', '0');
        publishdate = '';
    }


    key = i_get('key');
    if('null' != key){
        i_obj_set('d_key', key);
    } else {
        i_obj_set('d_key', '');
        key = '';
    }


    var arr_jobtype = jobtype.split(',');
    big_classification = arr_jobtype[0];
    small_classification = arr_jobtype[1];



    if('0' != big_classification){
        i_obj_set('d_big_classification', big_classification);
    } else {
        i_obj_set('d_big_classification', '');
        big_classification = '';
    }

    if('0' != small_classification){
        i_obj_set('d_small_classification', small_classification);
    } else {
        i_obj_set('d_small_classification', '');
        small_classification = '';
    }

    var arr_workplace = workplace.split(',');
    addr1 = arr_workplace[0];
    addr2 = arr_workplace[1];

    if('0' != addr1){
        i_obj_set('d_addr1', addr1);
    } else {
        i_obj_set('d_addr1', '');
        addr1 = '';
    }

    if('0' != addr2){
        i_obj_set('d_addr2', addr2);
    } else {
        i_obj_set('d_addr2', '');

        addr2 = '';
    }

    array = new Object();
    array['type2'] = type2;
    array['degree'] = degree;
    array['work_term'] = work_term;
    array['age_1'] = age_1;
    array['age_2'] = age_2;
    array['pay_type'] = pay_type;
    array['pay'] = pay;
    array['trade'] = trade;
    array['big_classification'] = big_classification;
    array['small_classification'] = small_classification;
    array['addr1'] = addr1;
    array['addr2'] = addr2;
    array['atime'] = publishdate;
    array['key'] = key;

    m.val_search = i_js2json(array);




//    return false;  //可以终止初始化
}

function m_btn_load_plug() {
    $('#a_info_adsearch').click(function(){
       $('#a_info_adsearch').attr('href', './info_com_adsearch.htm?a=adsearch');
    });

    $('#d_checkbox_all').click(function(){
        if ($(this).attr("checked") == true) { // 全选
            $("#list_tb :checkbox").each(function() {
                $(this).attr("checked", true);
            });
        } else { // 取消全选
            $("#list_tb :checkbox").each(function() {
                $(this).attr("checked", false);
            });
        }
    });

    $('#btn_browse').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
            m_pv_plug(array[0]);
        } else {
            alert('请选择简历！');
        } 
    });

    $('#btn_resume_interview').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });
            
        if('' !=  array){
            $.ajax({
                url : g.act + 'list_job.php?a=list_read&cid=' + $.cookie('c_id'),
                success : function(txt){
                    var txt = i_json2js(txt);
                    if('' != txt){
                         if(confirm('确定要“邀请面试”吗？')){
                            i_mdi_open('./info_resume_tointerview.htm?a=add&arr=' + i_js2json(array), '邀请面试', 1);
                        }
                    } else {
                        alert('您暂时没发布职位，请您先发布职位！');
                    }
                }
            });
        } else {
            alert('请选择简历！');
        }
        
    });

    $('#btn_resume_fav').click(function(){
        var array = new Array();
        $(".d_checkbox:checked").each(function(i) {
            array[i] = $(this).val();
        });

        if('' != array){
            if(confirm('确定要“收藏简历”吗？')){
                $.ajax({
                    url : i_act + 'a=info_fav',
                    data : 'arr='+ i_js2json(array),
                    success : function(txt){
                        if('1' == txt){
                            alert('收藏成功！');
                        } else if('0' == txt){
                            alert('对不起，此简历已经收藏！');
                        }
                    }
                });
            }
        } else {
            alert('请选择简历！');
        }  
    });

    $('#a_list_search').click(function(){
        key = i_obj_val('d_key');
        if('' == key){
            key = 'null';
        }

        big_classification = i_obj_val('d_big_classification');
        if('' == big_classification){
            big_classification = '0';
        }

        small_classification = i_obj_val('d_small_classification');
        if('' == small_classification){
            small_classification = '0';
        }

        addr1 = i_obj_val('d_addr1');
        if('' == addr1){
            addr1 = '0';
        }

        addr2 = i_obj_val('d_addr2');
        if('' == addr2){
            addr2 = '0';
        }

        trade = i_obj_val('d_trade');
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
            i_mdi_open('./list_com_search.htm?a=search&jobtype=' + big_classification +',' + small_classification +  '&trade=' + trade + '&workplace=' + addr1 +',' + addr2 + '&publishdate=' + atime + '&key=' + key, '简历搜索', 1);
        }

    });
}


function m_list_read_set_plug() {
    m.xtr.children(':eq(0)').html('<input class="d_checkbox" name="d_checkbox" type="checkbox" value="' + m.arr[i]['id'] + '"/>');
    m.xtr.children(':eq(1)').html('<a class="a_info_pv">' + m.arr[i]['name'] + '</a>');
    m.xtr.children(':eq(2)').html(m.arr[i]['sex']);
    m.xtr.children(':eq(3)').html(m.arr[i]['degree']);
    m.xtr.children(':eq(4)').html(m_arr2show(0, 1, m.arr[i]['big_classification'], array_occupation) + ' ' + m_arr2show(0, 2, m.arr[i]['small_classification'], array_job));
    m.xtr.children(':eq(5)').html(m.arr[i]['addr']);
    m.xtr.children(':eq(6)').html(m.arr[i]['work_term']);
    m.xtr.children(':eq(7)').html((m.arr[i]['atime']).substring(0, 10));
}

function m_list_read_btn_plug() {

    $('.a_info_pv').click(function(){
         m.xid = this.parentNode.parentNode.id;
         var rid = m.arr[m.xid]['id'];
         m_pv_plug(rid);
    });
}

function m_pv_plug(rid){
     $.ajax({
        url : i_act + 'a=info_pv&rid=' + rid,
        success : function(txt){
            if(txt == '1'){
                //查看简历
                i_mdi_open('./info_resume_look.htm?a=view&x=' + rid, '浏览简历', 1);
            }
        }
    });
}

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
        url : i_act + 'a=info_init',
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
        url : i_act + 'a=info_loginout',
        success : function(txt){
            if('1'== txt){
                i_mdi_open('./info_index_com.htm?a=chome', '企业服务' , 1);
            } else {
                alert('安全退出失败！');
            }
        }
    });
}