/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config ) {
    config.language = 'zh-cn';
    config.skin = 'office2003'; //'kama'、'office2003'、'v2'
    //    config.uiColor = '#AADC6E';
    config.width = '100%';
    config.height = 300;
    config.resize_enabled = false;
    //    config.toolbarCanCollapse = true;
    //    config.toolbarStartupExpanded = true;
    //    config.toolbarLocation = 'top';  //'top'\'bottom''
    config.font_names = 'Arial;宋体;楷体;黑体';
    config.font_defaultLabel = '宋体';
    config.fontSize_defaultLabel = '12px';
    config.toolbar = 'news_edit';
    config.toolbar_news_edit = [
    ['Source'],
    ['Undo','Redo','-','Cut','Copy','Paste','PasteText','PasteFromWord','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor','-','Find','-','SelectAll','RemoveFormat','-','Templates'],
    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar'],
    '/',
    ['Styles','Format','Font','FontSize'],
    ['TextColor','BGColor','-','Bold','Italic','Underline','Strike'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']
    ];
};

CKEDITOR.on( 'instanceReady', function( ev ){
    with (ev.editor.dataProcessor.writer) {
        setRules("p",  {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        setRules("h1", {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : false
        } );
        setRules("h2", {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        setRules("h3", {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        setRules("h4", {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : false
        } );
        setRules("h5", {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : false
        } );
        setRules("div", {
            indent : false,
            breakBeforeOpen : true,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        setRules("table", {
            indent : false,
            breakBeforeOpen : true,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        setRules("tr", {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : false
        } );
        setRules("td", {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : false
        } );
        setRules("iframe", {
            indent : false,
            breakBeforeOpen : true,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        setRules("li", {
            indent : false,
            breakBeforeOpen : true,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        setRules("ul", {
            indent : false,
            breakBeforeOpen : true,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        setRules("ol", {
            indent : false,
            breakBeforeOpen : true,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : true
        } );
        }
});

//indent  (是否加入空白 TAB)
//breakBeforeOpen (插入起始原始碼標籤之前是否斷行)
//breakAfterOpen (插入起始原始碼標籤之後是否斷行)
//breakBeforeClose (插入結尾原始碼標籤之前是否斷行)
//breakAfterClose (插入結尾原始碼標籤之後是否斷行)