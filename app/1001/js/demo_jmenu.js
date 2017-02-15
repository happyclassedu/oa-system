$(document).ready(function(){
    i_load_jmenu();
//    $("#jMenu").jMenu();
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

})