/**
* 文件名称：info_moh_print.js
* 功能描述：参保人员管理增加,修改，查看功能的前台程序。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改时间：2010-07-13
* 当前版本：v1.0
*/
//
//$(document).ready(function(){
//
//});

function m_load() {
    m_init_info_read();
//    return false;  //可以终止初始化
}

function m_btn_load_plug() {

    $('#btn_save').click(function(){
        m.arr = new Object();
        m.arr['time'] = i_obj_val('d_time');
        m.arr['pname'] = i_obj_val('d_pname');
        m.arr['fee_num'] = i_obj_val('d_fee_num');
        window.parent.location.reload();
        i_mdi_open('./info_moh_print_c.htm?a=add&arr=' + i_js2json(m.arr));
    });

    $('#btn_cancels').click(function(){
        parent.$('#iframe').hide();
    });

    $('#d_base_rate').change(function() {
        $('#d_fee_end').change();
    });

     $('#d_fee_end').change(function() {
        m_info_fee_formula_set();
    });

    $('#d_fee_type').change(function() {
        $('#d_fee_end').change();
    });

    $('#d_fee_rate').change(function() {
        $('#d_fee_end').change();
    });

    $('#d_interest').change(function() {
        $('#d_fee_end').change();
    });

    $('#d_reckon_rate').change(function() {
        $('#d_fee_end').change();
    });

    $('#d_fee_begin').jdate({
        dateFormat: 'yy-mm-dd'
    });

    $('#d_fee_end').jdate({
        dateFormat: 'yy-mm-dd'
    });

     $(document).keypress(function(){
        if(event.keyCode == 13 ){
            $('#btn_save').click();
        }
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

function m_info_save_plug() {
    m.tmp = i_obj_val('d_yname');
    if ('' == m.tmp) {
        alert('业务名称不能为空！');
        return false;
    }

//    m.tmp = i_obj_val('d_base_rate');
//    if ('' == m.tmp) {
//        alert('基数比率不能为空！');
//        return false;
//    }

    m_init_info_ytext_set();
    return true;
}

function m_init_info_read() {
    $.ajax({
        url : i_act + 'a=info_init&x=' + m.xid,
        success : function(text){
            m.info = i_json2js(text);
            i_obj_set('d_pid', m.info['pid']);
            i_obj_set('d_pname', m.info['pname']);
            i_obj_set('d_uid', m.info['uid']);
            i_obj_set('d_uname', m.info['uname']);
            i_obj_set('d_ytype', m.info['ytype']);
            i_obj_set('d_time', m.info['time']);
            i_obj_set('d_yname', '医保缴费');
            i_obj_set('d_fee_begin', '2010-07-01');
            i_obj_set('d_fee_end', '2010-12-01');
            i_obj_set('d_ill_insurance', '8');
            //            i_obj_disable('d_reckon_rate');
            if('退休' == m.info['medi_type']){
                i_obj_set('d_base_rate', '');
                i_obj_set('d_now_base', '');
                i_obj_set('d_fee_rate', '0.00');
                i_obj_set('d_fee_num', '8');
                i_obj_set('d_interest', '');
                i_obj_set('d_reckon_num', '');
                i_obj_set('d_reckon_rate', '0.050'); //退休，按5.0计入
                i_obj_disable('d_base_rate');
                i_obj_disable('d_now_base');
                i_obj_disable('d_base_rate');
                i_obj_disable('d_fee_rate');
                i_obj_disable('d_fee_num');
                i_obj_disable('d_interest');
                i_obj_disable('d_reckon_num');
                i_obj_disable('d_reckon_rate');
                i_obj_disable('d_fee_type');

            }else if('在职' == m.info['medi_type']){
                i_obj_set('d_fee_rate', '0.09');
                if(m.info['age'] <= 40){
                    //40岁以下, 按2.7%计入
                    i_obj_set('d_reckon_rate', '0.027');
                }else if(m.info['age'] >=41 && m.info['age'] <=50){
                    //41岁至50岁, 按3.0%计入
                    i_obj_set('d_reckon_rate', '0.030');
                }else if(m.info['age'] >51){
                    //51岁以上, 按3.6%计入
                    i_obj_set('d_reckon_rate', '0.050');
                }
            } else if('军转' == m.info['medi_type']){
                i_obj_set('d_fee_rate', '0.02');
                if(m.info['age'] <= 40){
                    //40岁以下, 按2.7%计入
                    i_obj_set('d_reckon_rate', '0.027');
                }else if(m.info['age'] >=41 && m.info['age'] <=50){
                    //41岁至50岁, 按3.0%计入
                    i_obj_set('d_reckon_rate', '0.030');
                }else if(m.info['age'] >51){
                    //51岁以上, 按3.6%计入
                    i_obj_set('d_reckon_rate', '0.050');
                }
            }
        }
    });
}

function m_init_info_ytext_set(){
    var ytext = '';
    ytext += '缴费时间段：' + i_obj_val('d_fee_begin') + '-' + i_obj_val('d_fee_end')+ '；<br>';
    ytext += '基数比率：' + i_obj_val('d_base_rate') + '；当年基数：' + i_obj_val('d_now_base') + '；<br>';
    ytext += '缴费类型：' + i_obj_val('d_fee_type') + '；缴费比率：' + i_obj_val('d_fee_rate') + '；<br>';
    ytext += '大病保险：' + i_obj_val('d_ill_insurance') + '；利息：' + i_obj_val('d_interest') + '；<br>';
    ytext += '缴费金额：' + i_obj_val('d_fee_num') + '；计入比例：' + i_obj_val('d_reckon_num') + '；';
    i_obj_set('d_ytext', ytext);
}

function m_info_fee_formula_set(){

    var fee_begin = i_obj_val('d_fee_begin'); //起始日期
    var fee_end = i_obj_val('d_fee_end');  //截止日期

    fee_begin = fee_begin.replace(new RegExp('-', "gm"), '/');
    fee_begin = new Date(fee_begin);

    fee_end = fee_end.replace(new RegExp('-', "gm"), '/');
    fee_end = new Date(fee_end);
    var months = fee_end.getMonth() + (fee_end.getFullYear()-fee_begin.getFullYear())*12 - fee_begin.getMonth() + 1; //月数

    var fee_rate = i_obj_val('d_fee_rate'); //缴纳比例

    if('0.6' == i_obj_val('d_base_rate'))
    {
        i_obj_set('d_now_base', '1702');
    }else if('1' == i_obj_val('d_base_rate')){
        i_obj_set('d_now_base', '2836');
    } else {
        i_obj_set('d_now_base', '');
    }

    var now_base = i_obj_val('d_now_base'); //当天基数

    if('补缴' == i_obj_val('d_fee_type')){
        i_obj_set('d_ill_insurance', '0');
    } else {
        i_obj_set('d_ill_insurance', '8');
    }
    var ill_insurance = i_obj_val('d_ill_insurance'); //大额医疗补助
    var interest = i_obj_val('d_interest'); //利息
    var base_rate = i_obj_val('d_base_rate');

    //月数为空，则赋值为0；
    if('' == base_rate){
        base_rate = '0';
    }

    //月数为空，则赋值为0；
    if('' == months){
        months = '0';
    }

    //当年基数为空，则赋值为0；
    if('' == now_base){
        now_base = '0';
    }

    //缴费比率为空，则赋值为0；
    if('' == fee_rate){
        fee_rate = '0';
    }

    //利息为空，则赋值为0；
    if('' == interest){
        interest = '0';
    }

    var fee_num = '';
    if('补缴' == i_obj_val('d_fee_type')){
        fee_num = (parseFloat(now_base) - 2479*base_rate) * parseFloat(months);
    } else {
        fee_num = (parseFloat(now_base) * parseFloat(fee_rate) + parseFloat(ill_insurance)) * parseFloat(months) + parseFloat(interest);
    }

    i_obj_set('d_fee_num', m_round(fee_num, 2));

    var reckon_rate = i_obj_val('d_reckon_rate'); //计入比例
    if('' == reckon_rate){
        reckon_rate = '0';
    }
    var reckon_num = parseFloat(reckon_rate) * parseFloat(fee_num); //计入比例
    i_obj_set('d_reckon_num', m_round(reckon_num,2));

}


/*
* @param : v表示要转换的值.
* @param : e表示要保留的位数,e<0时，保留小数点右边多少位;e>0时，保留小数点左边多少位.
* @return : 返回四舍五入的值
*/
function m_round(v,e)
{
    var t=1;
    for(;e>0;t*=10,e--);
    for(;e<0;t/=10,e++);
    return Math.round(v*t)/t;
}