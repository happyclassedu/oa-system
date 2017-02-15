$(document).ready(function(){
    //加载jquery.caroufredsel.js库.
   i_load_caroufredsel();
   $(function() {
//        $('ul#basic_config').carouFredSel();
        $('ul#basic_config').carouFredSel({
            items               : 5,
            scroll : {
                items           : 1,
                effect          : "easeOutBounce",
                duration        : 500,
                pauseOnHover    : true
            }

        });

        $('ul#user_interaction').carouFredSel({
            auto: false,
            prev: "#prev1",
            next: "#next1"
        });
        $('#vnoviwvw').carouFredSel({
            items: 'variable',
            next: '#next2',
            prev: '#prev2'
        });
    });
});
