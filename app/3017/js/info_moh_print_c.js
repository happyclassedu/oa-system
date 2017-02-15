/**
* 文件名称：info_moh_print_c.js
* 功能描述：打印医保单功能的前台程序。
* 代码作者：王争强
* 创建日期：2010-07-13
* 修改时间：2010-07-13
* 当前版本：v1.0
*/
//
$(document).ready(function(){
    alert('123');
});

function m_load() {
    alert('123');
    //    alert(m.arr['time']);
    m_init_info_read();
//    return false;  //可以终止初始化
}

//function m_btn_load_plug() {
//
//}

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
    return true;
}

function m_init_info_read() {
    $.ajax({
        url : i_act + 'a=info_print&arr=' + i_get('arr'),
        success : function(txt){
            m.info = i_json2js(txt);
            i_obj_set('d_year', m.info['year']);
            i_obj_set('d_month', m.info['month']);
            i_obj_set('d_day', m.info['day']);
            i_obj_set('d_pname', m.info['pname']);
            i_obj_set('d_feenum_now', m.info['fee_num']);
            m_init_info_val();
        }
    });
}

function m_init_info_val(){
    m_fee_to_formula();
    m_get();
    m_print();
}


//数字金额转化成对应的位置数字

function  m_fee_to_formula(){
    var obj= m.info['fee_num'];
    m.tmp  = obj.split('.');
    var tmp_1 = m.tmp[0];
    var tmp_2 = m.tmp[1];
    
    if(tmp_1.length < 7) {
        i_obj_set('d_f' + (6-tmp_1.length), '￥');

        for(i=tmp_1.length-1; i>=0; i--) {
            var tmp = 7-(tmp_1.length-i);
            i_obj_set('d_f' + (tmp), tmp_1.substring(i,i+1));
        }

        for(i = 0 ; i < tmp_2.length ; i++){
            i_obj_set('d_b' + i, tmp_2.substr(i,1));
        }
    }
}

function m_print(){
    window.print();
    i_mdi_close();
//	window.location.href="./info_moh_print.htm?a=add";
}
function m_get(){
    //  var obj='3859.44';
    var obj= m.info['fee_num'];
    var result="";  //返回jieguo
    var final_result="";
    var isfloat;//是不是小数
    var length=obj.length;//数字长度
    var number_float="";//数字的小数位数字
    var number="";//数字的整数位数字
    for (i=0;i<length ;i++ )
    {
        if(obj.substr(i,1)!="."&&isfloat!="1"){
            number=number+obj.substr(i,1);
        }
        else{
            isfloat="1";//是小数点位
        }
        if(isfloat=="1"){
            number_float=number_float+obj.substr(i,1);
        }
    }
    var number_length=number.length;//整数位长度
    var number_float_length=number_float.length;//小数位长度
    for (i=0;i<number_length ;i++ )
    {

        if(number.substr(i,1)=='0'){
            result=result+"零";
        }
        else if(number.substr(i,1)=='1'){
            result=result+"壹";
        }
        else if(number.substr(i,1)=='2'){
            result=result+"贰";
        }
        else if(number.substr(i,1)=='3'){
            result=result+"叁";
        }
        else if(number.substr(i,1)=='4'){
            result=result+"肆";
        }
        else if(number.substr(i,1)=='5'){
            result=result+"伍";
        }
        else if(number.substr(i,1)=='6'){
            result=result+"陆";
        }
        else if(number.substr(i,1)=='7'){
            result=result+"柒";
        }
        else if(number.substr(i,1)=='8'){
            result=result+"捌";
        }
        else if(number.substr(i,1)=='9'){
            result=result+"玖";
        }

    }
    if(number_float_length>1){//含有小数位
        if(number_float.substr(1,1)=="0"){//处理角
            result=result+"零";
        }
        else if(number_float.substr(1,1)=='1'){
            result=result+"壹";
        }
        else if(number_float.substr(1,1)=='2'){
            result=result+"贰";
        }
        else if(number_float.substr(1,1)=='3'){
            result=result+"叁";
        }
        else if(number_float.substr(1,1)=='4'){
            result=result+"肆";
        }
        else if(number_float.substr(1,1)=='5'){
            result=result+"伍";
        }
        else if(number_float.substr(1,1)=='6'){
            result=result+"陆";
        }
        else if(number_float.substr(1,1)=='7'){
            result=result+"柒";
        }
        else if(number_float.substr(1,1)=='8'){
            result=result+"捌";
        }
        else if(number_float.substr(1,1)=='9'){
            result=result+"玖";
        }

        if(number_float.substr(2,1)=="0"){//处理分
            result=result+"零";
        }
        else if(number_float.substr(2,1)=='1'){
            result=result+"壹";
        }
        else if(number_float.substr(2,1)=='2'){
            result=result+"贰";
        }
        else if(number_float.substr(2,1)=='3'){
            result=result+"叁";
        }
        else if(number_float.substr(2,1)=='4'){
            result=result+"肆";
        }
        else if(number_float.substr(2,1)=='5'){
            result=result+"伍";
        }
        else if(number_float.substr(2,1)=='6'){
            result=result+"陆";
        }
        else if(number_float.substr(2,1)=='7'){
            result=result+"柒";
        }
        else if(number_float.substr(2,1)=='8'){
            result=result+"捌";
        }
        else if(number_float.substr(2,1)=='9'){
            result=result+"玖";
        }
    }

    if(number_length==5){//整数位是万位的
        if(result.substr(0,1)!="零"){
            final_result=result.substr(0,1)+"万";
        }
        if (result.substr(1,1)!="零")//处理千位
        {
            final_result= final_result+result.substr(1,1)+"仟";
        }
        else if (result.substr(1,1)=="零"&&result.substr(2,1)!="零")
        {
            final_result= final_result+result.substr(1,1);
        }

        if (result.substr(2,1)!="零")//处理佰位
        {
            final_result= final_result+result.substr(2,1)+"佰";
        }
        else if (result.substr(2,1)=="零"&&result.substr(3,1)!="零")
        {
            final_result= final_result+result.substr(2,1);
        }

        if (result.substr(3,1)!="零")//处理十位
        {
            final_result= final_result+result.substr(3,1)+"拾";
        }
        else if (result.substr(3,1)=="零"&&result.substr(4,1)!="零")
        {
            final_result= final_result+result.substr(3,1);
        }

        if (result.substr(4,1)!="零")//处理个位
        {
            final_result= final_result+result.substr(4,1)+"元";
        }
        else if (result.substr(4,1)=="零"&&result.substr(5,1)!=""&&result.substr(5,1)!="零")
        {
            final_result= final_result+"元";
        }
        else
        {
            final_result= final_result+"元";
        }


        if ((result.substr(5,1)=="零"&&result.substr(6,1)=="零")||(result.substr(5,1)==""&&result.substr(6,1)==""))
        {
            final_result= final_result+"整";
        }

        if (result.substr(5,1)!="零"&&result.substr(5,1)!="")//处理角位
        {
            final_result= final_result+result.substr(5,1)+"角";
        }
        else if (result.substr(5,1)=="零"&&result.substr(6,1)!=""&&result.substr(6,1)!="零")
        {
            final_result= final_result+result.substr(5,1);
        }

        if (result.substr(6,1)!="零"&&result.substr(6,1)!="")//处理分位
        {
            final_result= final_result+result.substr(6,1)+"分";
        }

    }
    else if(number_length==4){//整数位是千位的
        if(result.substr(0,1)!="零"){
            final_result=result.substr(0,1)+"仟";
        }
        if (result.substr(1,1)!="零")//处理百位
        {
            final_result= final_result+result.substr(1,1)+"佰";
        }
        else if (result.substr(1,1)=="零"&&result.substr(2,1)!="零")
        {
            final_result= final_result+result.substr(1,1);
        }

        if (result.substr(2,1)!="零")//处理十位
        {
            final_result= final_result+result.substr(2,1)+"拾";
        }
        else if (result.substr(2,1)=="零"&&result.substr(3,1)!="零")
        {
            final_result= final_result+result.substr(2,1);
        }

        if (result.substr(3,1)!="零")//处理个位
        {
            final_result= final_result+result.substr(3,1)+"元";
        }
        else if (result.substr(3,1)=="零"&&result.substr(4,1)!=""&&result.substr(4,1)!="零")
        {
            final_result= final_result+"元";
        }
        else
        {
            final_result= final_result+"元";
        }


        if ((result.substr(4,1)=="零"&&result.substr(5,1)=="零")||(result.substr(4,1)==""&&result.substr(5,1)==""))
        {
            final_result= final_result+"整";
        }

        if (result.substr(4,1)!="零"&&result.substr(4,1)!="")//处理角位
        {
            final_result= final_result+result.substr(4,1)+"角";
        }
        else if (result.substr(4,1)=="零"&&result.substr(5,1)!=""&&result.substr(5,1)!="零")
        {
            final_result= final_result+result.substr(4,1);
        }

        if (result.substr(5,1)!="零"&&result.substr(5,1)!="")//处理分位
        {
            final_result= final_result+result.substr(5,1)+"分";
        }
    }
    else if(number_length==3){//整数位是百位的
        if(result.substr(0,1)!="零"){
            final_result=result.substr(0,1)+"佰";
        }
        if (result.substr(1,1)!="零")//处理十位
        {
            final_result= final_result+result.substr(1,1)+"拾";
        }
        else if (result.substr(1,1)=="零"&&result.substr(2,1)!="零")
        {
            final_result= final_result+result.substr(1,1);
        }

        if (result.substr(2,1)!="零")//处理个位
        {
            final_result= final_result+result.substr(2,1)+"元";
        }
        else if (result.substr(2,1)=="零"&&result.substr(3,1)!=""&&result.substr(3,1)!="零")
        {
            final_result= final_result+"元";
        }
        else
        {
            final_result= final_result+"元";
        }


        if ((result.substr(3,1)=="零"&&result.substr(4,1)=="零")||(result.substr(3,1)==""&&result.substr(4,1)==""))
        {
            final_result= final_result+"整";
        }

        if (result.substr(3,1)!="零"&&result.substr(3,1)!="")//处理角位
        {
            final_result= final_result+result.substr(3,1)+"角";
        }
        else if (result.substr(3,1)=="零"&&result.substr(4,1)!=""&&result.substr(4,1)!="零")
        {
            final_result= final_result+result.substr(3,1);
        }

        if (result.substr(4,1)!="零"&&result.substr(4,1)!="")//处理分位
        {
            final_result= final_result+result.substr(4,1)+"分";
        }
    }
    else if(number_length==2){//整数位是十位的
        if(result.substr(0,1)!="零"){
            final_result=result.substr(0,1)+"拾";
        }
        if (result.substr(1,1)!="零")//处理个位
        {
            final_result= final_result+result.substr(1,1)+"元";
        }
        else if (result.substr(1,1)=="零"&&result.substr(2,1)!=""&&result.substr(2,1)!="零")
        {
            final_result= final_result+"元";
        }
        else
        {
            final_result= final_result+"元";
        }


        if ((result.substr(2,1)=="零"&&result.substr(3,1)=="零")||(result.substr(2,1)==""&&result.substr(3,1)==""))
        {
            final_result= final_result+"整";
        }

        if (result.substr(2,1)!="零"&&result.substr(2,1)!="")//处理角位
        {
            final_result= final_result+result.substr(2,1)+"角";
        }
        else if (result.substr(2,1)=="零"&&result.substr(3,1)!=""&&result.substr(3,1)!="零")
        {
            final_result= final_result+result.substr(2,1);
        }

        if (result.substr(3,1)!="零"&&result.substr(3,1)!="")//处理分位
        {
            final_result= final_result+result.substr(3,1)+"分";
        }
    }
    else if(number_length==1&&number!="0"){//整数位是个位的
        final_result=result.substr(0,1)+"元";
        if ((result.substr(1,1)=="零"&&result.substr(2,1)=="零")||(result.substr(1,1)==""&&result.substr(2,1)==""))
        {
            final_result= final_result+"整";
        }

        if (result.substr(1,1)!="零"&&result.substr(1,1)!="")//处理角位
        {
            final_result= final_result+result.substr(1,1)+"角";
        }
        else if (result.substr(1,1)=="零"&&result.substr(2,1)!=""&&result.substr(2,1)!="零")
        {
            final_result= final_result+result.substr(1,1);
        }

        if (result.substr(2,1)!="零"&&result.substr(2,1)!="")//处理分位
        {
            final_result= final_result+result.substr(2,1)+"分";
        }
    }

    else if(number_length==1&&number=="0"){//整数位是空的

        if (result.substr(1,1)!="零"&&result.substr(1,1)!="")//处理角位
        {
            final_result= final_result+result.substr(1,1)+"角";
        }
        if (result.substr(2,1)!=""&&result.substr(2,1)!="零")
        {
            final_result= final_result+result.substr(2,1)+"分";
        }
    }

    //      alert(result);
    //     alert(final_result);
    i_obj_set('d_final_result' , final_result);
//    $('#d_final_result').innerHTML = final_result;
}





