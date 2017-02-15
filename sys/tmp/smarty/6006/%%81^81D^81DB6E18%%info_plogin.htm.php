<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:16
         compiled from ../htm/info_plogin.htm */ ?>
<table id="info_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <col width="35%" align="center" />
    <col width="65%" />
    <tbody>
        <tr class="tb_title0 login_title">
            <td colspan="2">个人会员登录</td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 用户名：</td>
            <td>
                <input id="d_loginid" style="width: 200px" type="text" />
                <span id="d_error_loginid"></span>
            </td>
        </tr>
        <tr class="tr_1">
            <td align="right"><font color=#ff0000>*</font> 密&nbsp;&nbsp;&nbsp;&nbsp;码：</td>
            <td>
                <input id="d_loginpw" style="width: 200px"  type="password"/>
                <span id="d_error_loginpw"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td></td>
            <td>
                <A href="info_pregister.htm?a=add"><U>新用户注册</U></A>&nbsp;&nbsp;
                <A href="info_cforget.htm?a=edit"><U>忘记密码</U></A>
            </td>
        </tr>
    </tbody>
</table>
<table id="act_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <col align="center" />
    <tr id="tr_act" class="tb_title0">
        <td>
            <input id="btn_login" type="button" value="个人会员登录">
        </td>
    </tr>
</table>
<input type="hidden" id="g_id" value="info_plogin" />
<script type="text/javascript" src="../js/common.js"></script>      