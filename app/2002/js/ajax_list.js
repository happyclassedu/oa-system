//apply_event();
function apply_event() {
    var obj_arr = $('#num_form INPUT');
    var g_arr = new Array();
    for (var j=0; j<obj_arr.length; j++) {
        g_arr[j] = obj_arr.eq(j)[0].value;
    }
    //    alert(obj_arr.eq(0)[0].value);
    //    var g_arr = new Array();
    //    g_arr[0] =  i_obj_val('num0');
    //    g_arr[1] =  i_obj_val('num1');
    //    g_arr[2] =  i_obj_val('num2');
    //    g_arr[3] =  i_obj_val('num3');
    //    g_arr[4] =  i_obj_val('num4');
    //    g_arr[5] =  i_obj_val('num5');
    //    g_arr[6] =  i_obj_val('num6');
    //    g_arr[7] =  i_obj_val('num7');
    //    g_arr[8] =  i_obj_val('num8');
    //    g_arr[9] =  i_obj_val('num9');
    var arr =  i_js2json(g_arr);
    alert(arr);
    
    $.ajax({
        url : i_act ,
        data : 'arr=' + arr ,
        success : function(text){
            alert(text);
            var arr = i_json2js(text);

            for (var j=0; j<arr.length; j++) {
                obj_arr.eq(j)[0].value = arr[j];
            }
        //            i_obj_set('num0', arr[0]);
        //            i_obj_set('num1', arr[1]);
        //            i_obj_set('num2', arr[2]);
        //            i_obj_set('num3', arr[3]);
        //            i_obj_set('num4', arr[4]);
        //            i_obj_set('num5', arr[5]);
        //            i_obj_set('num6', arr[6]);
        //            i_obj_set('num7', arr[7]);
        //            i_obj_set('num8', arr[8]);
        //            i_obj_set('num9', arr[9]);
        }
    });
}