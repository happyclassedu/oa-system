$(function(){
    var config = {
        toolbar:[
        ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
        ['UIColor']
        ]
    };
    $('.jquery_ckeditor').ckeditor(config);
//    $('.jquery_ckeditor').ckeditor();
//    alert($('.jquery_ckeditor').ckeditorGet().getData());
});