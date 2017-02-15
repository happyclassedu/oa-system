//$.each( { name: "John", lang: "JS" }, function(i, n){
//  alert( "Name: " + i + ", Value: " + n );
//});

$(document).ready(function(){
    i_date_format('2011-03-31 09:26:41', 'yy');
    i_date_format('2011-03-31 09:26:41', 'yyyy-mm');
    i_date_format('2011-03-31 09:26:41', 'mm-dd');
});

/**
* 函数i_date_format：格式化函数；
* @param: str  当前日期；
* @param: fmt 格式化，例如："YY-mm-dd"等；
* @return: str;  2011-03-31 09:26:41
*/
function i_date_format(str, fmt){
    var arr = str.split(' ')
    var arr0 = arr[0].split('-');
    var arr1 = arr[1].split(':');
    str = '';
    switch (fmt) {
        case 'yyyy' :
            str = arr0[0];
            break;
        case 'yy' :
            str = arr0[0].substring(2, 4);
            break;
        case 'mm' :
            str = arr0[1];
            break;
        case 'dd' :
            str = arr0[2];
            break;
        case 'hh' :
            str = arr1[0];
            break;
        case 'ii' :
            str = arr1[1];
            break;
        case 'yyyy-mm-dd' :
            str = arr[0];
            break;
        case 'yyyy-mm' :
            str = arr[0].substring(0, 7);
            break;
        case 'mm-dd' :
            str = arr[0].substring(5, 10);
            break;
        case 'hh-ii-ss' :
            str = arr[1];
            break;
        default :
            alert('对不起，日期格式有误！');
            break;
    }
    alert(str);
    return str;
}