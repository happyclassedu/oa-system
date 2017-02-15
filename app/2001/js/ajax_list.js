/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var obj_arr = $('#sort_llist INPUT');
var g_arr = new Array();
for(var j=0; j<obj_arr.length; j++){
    g_arr[j]=obj_arr.eq(j).value;
}
//g_arr[0] =  i_obj_val('sort_txt_num1');
//g_arr[1] =  i_obj_val('sort_txt_num2');
//g_arr[2] =  i_obj_val('sort_txt_num3');
//g_arr[3] =  i_obj_val('sort_txt_num4');
//g_arr[4] =  i_obj_val('sort_txt_num5');
//g_arr[5] =  i_obj_val('sort_txt_num6');
//g_arr[6] =  i_obj_val('sort_txt_num7');
//g_arr[7] =  i_obj_val('sort_txt_num8');
//g_arr[8] =  i_obj_val('sort_txt_num9');
//g_arr[9] =  i_obj_val('sort_txt_num10');

alert(g_arr()); //遍历数组，在输出

apply_event(); //调用apply_event()函数
function apply_event(str) {
    $.ajax({
        url : i_act + 'ajax_list.php',  //处理后台程序的url
        data : 'arr=' + g_arr,          //
        success : function(text){       //成功后调用事件
            alert(text);

            var arr = i_json2js(text);
            i_obj_set('sort_txt_num1', arr[0]);
            i_obj_set('sort_txt_num2', arr[1]);
            i_obj_set('sort_txt_num3', arr[2]);
            i_obj_set('sort_txt_num4', arr[3]);
            i_obj_set('sort_txt_num5', arr[4]);
            i_obj_set('sort_txt_num6', arr[5]);
            i_obj_set('sort_txt_num7', arr[6]);
            i_obj_set('sort_txt_num8', arr[7]);
            i_obj_set('sort_txt_num9', arr[8]);
            i_obj_set('sort_txt_num10', arr[9]);
        }
    })
}


