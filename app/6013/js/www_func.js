$('#btn_txt_search').click(function(){
    var txt_search = encodeURIComponent(i_obj_val('txt_search'));
    i_mdi_open('./list_search.htm?val=' + txt_search);
});