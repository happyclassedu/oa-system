/**
 * 文件名称：info_person_adsearch.js
 * 功能描述：(个人)快速搜索功能的前台程序。
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
     $('#a_info_person').click(function(){
       $('#a_info_person').attr('href', './info_person.htm?a=uhome');
    });

    $('#btn_search').click(function(){

        var key = i_obj_val('d_key');
        if('' == key){
            key = 'null';
        }
		var key_class = i_obj_val('d_key_class');
  
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
		
		var type2 = i_obj_val('d_type2');
		if('' == type2){
            type2 = 'null';
        }

		var degree = i_obj_val('d_degree');
		if('' == degree){
            degree = 'null';
        }

		var history = i_obj_val('d_history');
		if('' == history){
            history = 'null';
        }

		var sex = i_obj_val('d_sex');
		if('' == sex){
            sex = 'null';
        }

		var age_1 = i_obj_val('d_age_1');
		if('' == age_1){
            age_1 = '0';
        }

		var age_2 = i_obj_val('d_age_2');
		if('' == age_2){
            age_2 = '0';
        }

	   var pay_type = i_obj_val('d_pay_type');
		if('' == pay_type){
			pay_type = 'null';
		}
		
		var pay = i_obj_val('d_pay');
		if('' == pay){
			pay = '0';
		}

        var job_day = i_obj_val('d_job_day');
        if('' == job_day){
            job_day = '0';
        }
        if('请输入关键字' == key){
            alert('请输入关键字');
        } else {
            i_mdi_open('./list_person_search.htm?a=search&jobtype=' + big_classification +',' + small_classification +
				'&type2=' + type2 + '&degree=' + degree + '&history=' + history + '&sex=' + sex + '&age_1=' + age_1 + '&age_2=' + age_2 + '&pay_type=' + pay_type + '&pay=' + pay + '&trade=' + trade + '&workplace=' + addr1 +',' + addr2 + '&publishdate=' + job_day + '&key=' + key + '&key_class=' + key_class);
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
    m_info_city_plug('d_addr2')
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