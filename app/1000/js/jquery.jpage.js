jQuery.fn.jpage=function(a){b("#"+this.attr("id"),a);function b(j,H){if("#"==j){return}var u=H.info_all>0?H.info_all:0;var m=H.use_cookie!=null?H.use_cookie:true;var C=H.show_num>0?H.show_num:10;C=!m||$.cookie(j+"_show_num")==null?C:parseInt($.cookie(j+"_show_num"));var f=H.page_mode==null||H.page_mode==""?"full":H.page_mode;var l=H.page_skin==null||H.page_skin==""?"default":H.page_skin;var e=H.page_act;var n=Math.ceil(u/C);var k=1;var k=!m||$.cookie(j+"_page_now")==null?1:parseInt($.cookie(j+"_page_now"));i_read_css("jpage/"+l+"/css/jpage",1);var d='<table class="jpage_page_box" width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td><table class="jpage_page_panel" border="0" cellspadding="0" cellspacing="0"><tr valign="middle"><td><select class="jpage_val_show_num" title="\u6bcf\u9875\u663e\u793a\u6761\u6570"><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">30</option><option value="40">50</option></select></td><td><div class="jpage_separator"></div></td><td><div class="jpage_btn jpage_btn_no_1" title="\u7b2c\u4e00\u9875"></div></td><td><div class="jpage_btn jpage_btn_prev" title="\u4e0a\u4e00\u9875"></div></td><td><div class="jpage_separator"></div></td><td>\u7b2c&nbsp;<input class="jpage_val_page_now" type="text" title="\u5f53\u524d\u663e\u793a\u7684\u9875\u7801" />&nbsp;\u9875 / \u5171&nbsp;<span class="jpage_val_page_all"></span>&nbsp;\u9875</td><td><div class="jpage_separator"></div></td><td><div class="jpage_btn jpage_btn_next" title="\u4e0b\u4e00\u9875"></div></td><td><div class="jpage_btn jpage_btn_last" title="\u6700\u672b\u9875"></div></td><td><div class="jpage_separator"></div></td><td><div class="jpage_btn jpage_btn_refresh" title="\u5237\u65b0 \u5f53\u524d\u9875"></div></td><td><div class="jpage_separator"></div></td><td>\u5171\u6709&nbsp;<span class="jpage_val_info_all"></span>&nbsp;\u6761\u8bb0\u5f55\uff0c\u663e\u793a\u7b2c&nbsp;<span class="jpage_val_info_s"></span>&nbsp;\u6761&nbsp;-&nbsp;\u7b2c&nbsp;<span class="jpage_val_info_e"></span>&nbsp;\u6761\u8bb0\u5f55</td></tr></table></td></tr></table>';var q=$(j).html()==""?d:$(j).html();q=q.replace(new RegExp("jpage","gm"),l);$(j).html(q);var A=$(j+" ."+l+"_btn_next");var z=$(j+" ."+l+"_btn_prev");var g=$(j+" ."+l+"_btn_no_1");var r=$(j+" ."+l+"_btn_last");var o=$(j+" ."+l+"_btn_refresh");var t=$(j+" ."+l+"_btn_no_1, "+j+" ."+l+"_btn_prev, "+j+" ."+l+"_btn_next, "+j+" ."+l+"_btn_last, "+j+" ."+l+"_btn_refresh");var w=$(j+" ."+l+"_val_page_now");var c=$(j+" ."+l+"_val_show_num");var x=$(j+" ."+l+"_val_page_all");var p=$(j+" ."+l+"_val_info_s");var B=$(j+" ."+l+"_val_info_e");var D=$(j+" ."+l+"_val_info_all");G();A.click(function(){if(k<n){k+=1;y()}});z.click(function(){if(k>1){k-=1;y()}});g.click(function(){if(k>1){k=1;y()}});r.click(function(){if(k<n){k=n;y()}});o.click(function(){y()});w.keypress(function(J){var I=parseInt($(this).val());if(J.keyCode==13&&I>=1&&I<=n){k=I;y()}});c.change(function(){C=parseInt($(this).val());k=1;n=Math.ceil(u/C);G()});c.attr("value",C);if(null==c.val()){c.append('<option value="'+C+'">'+C+"</option>");c.attr("value",C)}t.bind("mousedown",h);t.bind("mouseout",i);t.bind("mouseup",i);function G(){if(m){$.cookie(j+"_show_num",C)}if(k>n){k=n*1-1}if(1==n||1>k){k=1}x.html(n);D.html(u);y()}function y(){if(e){e(C,k)}if(m){$.cookie(j+"_page_now",k)}w.val(k);p.html(C*k-C+1);if(C*k>u){B.html(u)}else{B.html(C*k)}if(0==n){E();v()}else{if(1==k&&1!=n){E();F()}else{if(1==k&&1==n){E();v()}else{if(1!=k&&n==k){s();v()}else{s();F()}}}}}function F(){A.removeClass(l+"_btn_next_disable");r.removeClass(l+"_btn_last_disable")}function s(){g.removeClass(l+"_btn_no_1_disable");z.removeClass(l+"_btn_prev_disable")}function v(){A.addClass(l+"_btn_next_disable");r.addClass(l+"_btn_last_disable")}function E(){g.addClass(l+"_btn_no_1_disable");z.addClass(l+"_btn_prev_disable")}function h(){$(this).addClass(l+"_btn_press_un")}function i(){$(this).removeClass(l+"_btn_press_un")}}};