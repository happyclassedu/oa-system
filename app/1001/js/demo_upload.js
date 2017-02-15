$(document).ready(function(){
    i_upload({
        'obj_id' : '#test_file0',
        'auto' : false,
        'more' : false,
        'width'  : '100',
        'height' : '140',
        'btn_img' : '../img/photo.jpg',
        'file_ext' : '*.jpg',
        'file_txt' : '请选择 .ini 文件,请选择 .jpg 文件',
        onSelect : function(evt, queue_id, file_obj) {
            if (file_obj.size > 1000000) {
                alert("Sorry, the file size exceeds 100k, is unusual.");
                return false;
            } else {
                alert('123456');
//                $(evt.currentTarget).uploadifyUpload();
                return true;
            }
        },
        onComplete : function (evt, queue_id, file_obj, response, data) {
                alert(response);
            i_obj_set('ajax_result', 'Successfully uploaded: '+ response);
        }
    });

    i_upload({
        'obj_id' : '#test_file1',
        'auto' : false,
        'more' : false,
        'width'  : '80',
        'height' : '112',
        'btn_img' : '../img/photo_demo.jpg',
        'file_ext' : '*.jpg',
        'file_txt' : '请选择 .ini 文件,请选择 .jpg 文件',
        'data' : {'i_name' : 'i_name'},
        onSelect : function(evt, queue_id, file_obj) {
            if (file_obj.size > 10000000) {
                alert("Sorry, the file size exceeds 100k, is unusual.");
                return false;
            } else {
                alert('123456');
                $(evt.currentTarget).uploadifyUpload();
                return true;
            }
        },
        onComplete : function (evt, queue_id, file_obj, response, data) {
                alert(response);
            i_obj_set('ajax_result', 'Successfully uploaded: '+ response);
        }
    });
});
