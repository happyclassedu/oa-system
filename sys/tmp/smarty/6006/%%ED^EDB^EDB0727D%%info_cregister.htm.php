<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:16
         compiled from ../htm/info_cregister.htm */ ?>
<table id="info_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <col width="35%" align="center" />
    <col width="65%" />
    <tbody>
        <tr class="tb_title0 login_title">
            <td colspan="2">企业会员注册</td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 用户帐号：</td>
            <td>
                <input id="d_loginid" style="width: 200px" type="text" />
                <span id="d_error_loginid"></span>
            </td>
        </tr>
        <tr class="tr_1">
            <td align="right"><font color=#ff0000>*</font> 公司名称：</td>
            <td>
                <input id="d_fname" style="width: 200px"  type="text"/>
                <span id="d_error_name"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 登录密码：</td>
            <td>
                <input style="width: 200px" id="d_loginpw" type="password"/>
                <span id="d_error_loginpw"></span>
            </td>
        </tr>
        <tr class="tr_1">
            <td align="right"><font color=#ff0000>*</font> 确认密码：</td>
            <td>
                <input style="width: 200px" id="d_loginpw_qr" type="password"/>
                <span id="d_error_loginpw_qr"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 电子邮箱：</td>
            <td>
                <input style="width: 200px" id="d_email" type="text"/>
                <span id="d_error_email"></span>
            </td>
        </tr>
        <tr class="tr_1">
            <td></td>
            <td>
                <input id="d_agree" type="checkbox" checked style="width: 15px"/>&nbsp;&nbsp;同意并阅读<A href="./info_600.htm" target=_blank><U>曲江人才网用户协议</U></A>
            </td>
        </tr>
    </tbody>
</table>
<table id="act_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <col align="center" />
    <tr id="tr_act" class="tb_title0">
        <td>
            <input id="btn_save" type="button" value="同意协议条款并确认注册">
        </td>
    </tr>
</table>
<input type="hidden" id="g_id" value="info_cregister" />
<script type="text/javascript" src="../js/common.js"></script> 