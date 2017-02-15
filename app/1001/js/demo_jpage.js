/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//alert('123');
//$.cookie('a_mytest', 'meishenme');
//alert($.cookie('a_mytest'));
//i_read_js('jquery.jpage', 0);

$(document).ready(function(){
    $('#pagetest2').jpage({
        info_all : '25',
        use_cookie : true,
        show_num : '7',
        page_mode : 'full',
        page_skin : 'black',
        page_act : ''
    });
    $('#pagetest3').jpage({
        info_all : '125',
        use_cookie : true,
        show_num : '7',
        page_mode : 'full',
        page_skin : 'blue',
        page_act : ''
    });
    $('#pagetest4').jpage({
        info_all : '68',
        show_num : '11',
        page_skin : 'blue',
        page_act : ''
    });
    $('#pagetest5').jpage({
        info_all : '68',
        show_num : '4',
        page_act : ''
    });
});