$('#btn_search_news').click(function(){
    var txt_search = encodeURIComponent(i_obj_val('txt_search'));
    i_mdi_open('./list_news.htm?a=search&val=' + txt_search);
});

//加载jMenu插件
i_load_jmenu();

$("#jMenu").jMenu({
      ulWidth : '150',
      effects : {
        effectSpeedOpen : 300,
        effectSpeedClose : 300,
        effectTypeOpen : 'slide',
        effectTypeClose : 'slide',
        effectOpen : 'linear',
        effectClose : 'linear'
      },
      TimeBeforeOpening : 100,
      TimeBeforeClosing : 400,
      animatedText : false,
      paddingLeft: 1
    });