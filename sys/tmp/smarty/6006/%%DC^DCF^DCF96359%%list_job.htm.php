<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:16
         compiled from ../htm/list_job.htm */ ?>
<!--开始__基本功能区-->
<div id="box_title" class="job_title">
    <span id="sys_title">【<span id="d_cname">dfgdfg</span>】职位列表</span>
    <div id="box_tools">
        <span id="box_search">
            <input id="val_search" type="text"  style="width:100px; height:18px;"/>
            &nbsp;
            <input id="btn_search" type="button" value="搜索" style="width:70px; height:28px;"/>
        </span>
        <input id="btn_refresh" type="button"  value="刷新" style="width:70px; height:28px;"/>&nbsp;&nbsp;
        <input id="btn_close" type="button"  value="关闭" style="width:70px; height:28px;"/>&nbsp;&nbsp;｜&nbsp;&nbsp;
        <input id="btn_add_j" type="button"  value="新增" style="width:70px; height:28px;"/>
    </div>
</div>
<!--结束__基本功能区-->
<!--开始__信息列表区-->
<table class="info_com_center" width="978" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td>
            <table id="list_j" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
                <col width="50" align="center" />
                <col width="100" align="center" />
                <col width="100" align="center"/>
                <col width="150" align="center" />
                <col width="150" align="center" />
                <col width="50" align="center" />
                <col width="200" align="center" />
                <thead>
                    <tr class="list_title">
                        <td>序号</td>
                        <td>职位名称</td>
                        <td>职位状态</td>
                        <td>发布日期</td>
                        <td>有效期限</td>
                        <td>点击率</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td class="btn_box">
                            <input class="btn_view_j" type="button" value="查看"  style="width:40px; height:23px;"/>
                            <input class="btn_edit_j" type="button" value="修改"  style="width:40px; height:23px;"/>
                            <input class="btn_del_j" type="button" value="删除"  style="width:40px; height:23px;"/>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--结束__信息列表区-->
            <!--开始__列表排序区-->
            <table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td id="jpage_box"></td>
                </tr>
            </table>
        </td></tr></table>
<!--开始__结束排序区-->
<input type="hidden" id="g_id" value="list_job" />
<script type="text/javascript" src="../js/common.js"></script> 