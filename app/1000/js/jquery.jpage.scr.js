/**
 * 文件名称：jquery.jpage.js
 * 功能描述：jpage for jQuery 分页插件。基于陈健的jquery.jpage.js的分页插件改写的分页控件，只负责分页栏内容的变化。config为jpage配置参数组。
 * 代码作者：陈健、孙振强
 * 创建日期：2008-07-08
 * 修改日期：2010-01-28
 * 当前版本：V2.0  beta 1
*/

jQuery.fn.jpage = function(config) {
    init('#' + this.attr('id'), config);

    /**
     * 初始化，主程序
     * @param jpage_id 容器的id，带#号。
     * @param jpage_cfg 插件配置
     */
    function init(jpage_id, jpage_cfg){
        //公有变量
        if ('#' == jpage_id) {
            return;
        }
        var info_all = jpage_cfg.info_all > 0 ? jpage_cfg.info_all : 0;  //信息总数
        var use_cookie = jpage_cfg.use_cookie != null ? jpage_cfg.use_cookie : true;  //是否使用cookie
        var show_num = jpage_cfg.show_num > 0 ? jpage_cfg.show_num : 10;  //每页显示记录数
        show_num = !use_cookie || $.cookie(jpage_id + '_show_num') == null ? show_num : parseInt($.cookie(jpage_id + '_show_num'));
        var page_mode = jpage_cfg.page_mode == null || jpage_cfg.page_mode == '' ? 'full' : jpage_cfg.page_mode;  //显示模式
        var page_skin = jpage_cfg.page_skin == null || jpage_cfg.page_skin == '' ? 'default' : jpage_cfg.page_skin;  //主题名称
        var page_act = jpage_cfg.page_act;  //点击后外围处理程序

        //私有变量
        var page_all = Math.ceil(info_all/show_num);  //总页数
        var page_now = 1;
        var page_now = !use_cookie || $.cookie(jpage_id + '_page_now') == null ? 1 : parseInt($.cookie(jpage_id + '_page_now'));  //当前页码

        //载入样式
        i_read_css('jpage/' + page_skin + '/css/jpage', 1);
        //添加工具条
        var tools_default = '<table class="jpage_page_box" width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td><table class="jpage_page_panel" border="0" cellspadding="0" cellspacing="0"><tr valign="middle"><td><select class="jpage_val_show_num" title="每页显示条数"><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">30</option><option value="40">50</option></select></td><td><div class="jpage_separator"></div></td><td><div class="jpage_btn jpage_btn_no_1" title="第一页"></div></td><td><div class="jpage_btn jpage_btn_prev" title="上一页"></div></td><td><div class="jpage_separator"></div></td><td>第&nbsp;<input class="jpage_val_page_now" type="text" title="当前显示的页码" />&nbsp;页 / 共&nbsp;<span class="jpage_val_page_all"></span>&nbsp;页</td><td><div class="jpage_separator"></div></td><td><div class="jpage_btn jpage_btn_next" title="下一页"></div></td><td><div class="jpage_btn jpage_btn_last" title="最末页"></div></td><td><div class="jpage_separator"></div></td><td><div class="jpage_btn jpage_btn_refresh" title="刷新 当前页"></div></td><td><div class="jpage_separator"></div></td><td>共有&nbsp;<span class="jpage_val_info_all"></span>&nbsp;条记录，显示第&nbsp;<span class="jpage_val_info_s"></span>&nbsp;条&nbsp;-&nbsp;第&nbsp;<span class="jpage_val_info_e"></span>&nbsp;条记录</td></tr></table></td></tr></table>';
        var toolbar = $(jpage_id).html() == ''  ? tools_default : $(jpage_id).html();  //信息总数
        toolbar = toolbar.replace(new RegExp('jpage', 'gm'), page_skin);
        //加载工具栏
        $(jpage_id).html(toolbar);

        //定义dom
        var btn_next = $(jpage_id + ' .' + page_skin + '_btn_next');  //下一页按钮
        var btn_prev = $(jpage_id + ' .' + page_skin + '_btn_prev');  //上一页按钮
        var btn_no_1 = $(jpage_id + ' .' + page_skin + '_btn_no_1');  //首页按钮
        var btn_last = $(jpage_id + ' .' + page_skin + '_btn_last');  //末页按钮
        var btn_refresh = $(jpage_id + ' .' + page_skin + '_btn_refresh');  //刷新按钮
        var btn_all = $(jpage_id + ' .' + page_skin + '_btn_no_1, ' + jpage_id+' .' + page_skin + '_btn_prev, ' + jpage_id + ' .' + page_skin + '_btn_next, ' + jpage_id + ' .' + page_skin + '_btn_last, ' + jpage_id + ' .' + page_skin + '_btn_refresh');  //所有按钮

        var val_page_now = $(jpage_id + ' .' + page_skin + '_val_page_now');  //当前页码dom
        var val_show_num = $(jpage_id + ' .' + page_skin + '_val_show_num');  //每页显示的记录数量dom
        var val_page_all = $(jpage_id + ' .' + page_skin + '_val_page_all');  //每页显示的记录数量dom
        var val_info_s = $(jpage_id + ' .' + page_skin + '_val_info_s');  //当前页显示的起始记录dom
        var val_info_e = $(jpage_id + ' .' + page_skin + '_val_info_e');  //当前页显示的起始记录dom
        var val_info_all = $(jpage_id + ' .' + page_skin + '_val_info_all');  //每页显示的记录数量dom

        //加载工具栏状态
        page_load();

        //按钮监听
        btn_next.click(function() {
            if(page_now < page_all) {
                page_now += 1;
                page_reload();
            }
        });
        btn_prev.click(function() {
            if(page_now > 1){
                page_now -= 1;
                page_reload();
            }
        });
        btn_no_1.click(function() {
            if(page_now > 1){
                page_now = 1;
                page_reload();
            }
        });
        btn_last.click(function() {
            if(page_now < page_all) {
                page_now = page_all;
                page_reload();
            }
        });
        btn_refresh.click(function() {
            page_reload();
        });

        //页码输入框监听
        val_page_now.keypress(function(event) {
            var page_goto = parseInt($(this).val());
            if(event.keyCode == 13 && page_goto >= 1 && page_goto <= page_all){
                page_now = page_goto;
                page_reload();
            }
        });

        val_show_num.change(function() {
            show_num = parseInt($(this).val());
            page_now = 1;
            page_all = Math.ceil(info_all / show_num);
            page_load();
        });

        val_show_num.attr('value', show_num);
        if (null == val_show_num.val()) {
            val_show_num.append('<option value="' + show_num + '">' + show_num + '</option>');
            val_show_num.attr('value', show_num);
        }
        //按钮鼠标事件监听
        btn_all.bind('mousedown', btn_press_on);
        btn_all.bind('mouseout', btn_press_un);
        btn_all.bind('mouseup', btn_press_un);
        /*********************************init私有函数***************************************************/
        /**
         * 初始化工具栏状态
         */
        function page_load() {
            if(use_cookie){  //当前页码写入cookie
                $.cookie(jpage_id+'_show_num', show_num);
            }
            if(page_now > page_all){
                page_now = page_all*1 - 1;
            }
            if(1 == page_all || 1 > page_now){
                page_now = 1;
            }
            val_page_all.html(page_all);
            val_info_all.html(info_all);
            page_reload();
        }

        /**
         * 重载工具栏状态
         */
        function page_reload() {
            if(page_act){
                page_act(show_num, page_now);
            }
            if(use_cookie){  //当前页码写入cookie
                $.cookie(jpage_id+'_page_now', page_now);
            }

            val_page_now.val(page_now);
            val_info_s.html(show_num * page_now -show_num + 1);
            if (show_num * page_now > info_all) {
                val_info_e.html(info_all);
            } else {
                val_info_e.html(show_num * page_now);
            }

            if(0 == page_all) {
                btn_go_prev_disable();
                btn_go_next_disable();
            } else if(1 == page_now&& 1 != page_all) {
                btn_go_prev_disable();
                btn_go_next_enable();
            } else if(1 == page_now && 1 == page_all) {
                btn_go_prev_disable();
                btn_go_next_disable();
            } else if(1 != page_now && page_all ==  page_now) {
                btn_go_prev_enable();
                btn_go_next_disable();
            } else {
                btn_go_prev_enable();
                btn_go_next_enable();
            }
        }

        /**
         * 移除按钮disabled状态样式
         */
        function btn_go_next_enable() {
            btn_next.removeClass(page_skin + '_btn_next_disable');
            btn_last.removeClass(page_skin + '_btn_last_disable');
        }
        function btn_go_prev_enable() {
            btn_no_1.removeClass(page_skin + '_btn_no_1_disable');
            btn_prev.removeClass(page_skin + '_btn_prev_disable');
        }

        /**
         * 添加按钮disabled状态样式
         */
        function btn_go_next_disable() {
            btn_next.addClass(page_skin + '_btn_next_disable');
            btn_last.addClass(page_skin + '_btn_last_disable');
        }
        function btn_go_prev_disable() {
            btn_no_1.addClass(page_skin + '_btn_no_1_disable');
            btn_prev.addClass(page_skin + '_btn_prev_disable');
        }

        /**
         * 添加按钮按下状态样式
         */
        function btn_press_on() {
            $(this).addClass(page_skin + '_btn_press_un');
        }

        /**
         * 移除按钮按下状态样式
         */
        function btn_press_un() {
            $(this).removeClass(page_skin + '_btn_press_un');
        }
    }
}
/**
skin : black\blue\default\gallery\rotundity\simple\white
js:
    $('#demo').jpage({
        info_all : '25',
        use_cookie : true,
        show_num : '7',
        page_mode : 'full',
        page_skin : 'black',
        page_act : ''
    });
htm:
    <div id="pagetest2">
        <table class="jpage_page_box" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table class="jpage_page_panel" border="0" cellspadding="0" cellspacing="0">
                        <tr valign="middle">
                            <td><select class="jpage_val_show_num" title="每页显示条数">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="40">40</option>
                                </select></td>
                            <td><div class="jpage_separator"></div></td>
                            <td><div class="jpage_btn jpage_btn_no_1" title="第一页"></div></td>
                            <td><div class="jpage_btn jpage_btn_prev" title="上一页"></div></td>
                            <td><div class="jpage_separator"></div></td>
                            <td>第&nbsp;<input class="jpage_val_page_now" type="text" title="当前显示的页码" />&nbsp;页 / 共&nbsp;<span class="jpage_val_page_all"></span>&nbsp;页</td>
                            <td><div class="jpage_separator"></div></td>
                            <td><div class="jpage_btn jpage_btn_next" title="下一页"></div></td>
                            <td><div class="jpage_btn jpage_btn_last" title="最末页"></div></td>
                            <td><div class="jpage_separator"></div></td>
                            <td><div class="jpage_btn jpage_btn_refresh" title="刷新 当前页"></div></td>
                            <td><div class="jpage_separator"></div></td>
                            <td>共有&nbsp;<span class="jpage_val_info_all"></span>&nbsp;条记录，显示第&nbsp;<span class="jpage_val_info_s"></span>&nbsp;条&nbsp;-&nbsp;第&nbsp;<span class="jpage_val_info_e"></span>&nbsp;条记录</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
*/