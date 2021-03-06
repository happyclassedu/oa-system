<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:16
         compiled from ../htm/info_cregister_ok.htm */ ?>
<table id="info_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <col width="30%" align="center" />
    <col width="70%" />
    <tbody>
        <tr class="tb_title0 login_title">
            <td colspan="2">确认企业信息</td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 公司名称：</td>
            <td>
                <input id="d_fname" style="width: 230px" type="text" />
                <span id="d_error_fname"></span>
            </td>
        </tr>
        <tr class="tr_1">
            <td align="right"><font color=#ff0000>*</font> 营业执照(编号)：</td>
            <td>
                <input id="d_regid" type="text" style="width: 230px"/>
                <span id="d_error_regid"></span>
            </td>
        </tr>
        <tr class="tr_1">
            <td align="right"><font color=#ff0000>*</font> 所属行业：</td>
            <td>
                <select id="d_trade" style="width: 230px">
                    <option value="" selected>行业不限</option>
                </select>
                <span id="d_error_trade"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 公司性质：</td>
            <td>
                <select id="d_type" style="width: 230px">
                    <option value="" selected>性质不限</option>
                    <option value="国有企业">国有企业</option>
                    <option value="外商独资">外商独资．外企办事处</option>
                    <option value="中外合营">中外合营(合资．合作)</option>
                    <option value="私营">私营．民营企业</option>
                    <option value="上市公司">上市公司</option>
                    <option value="股份制企业">股份制企业</option>
                    <option value="集体企业">集体企业</option>
                    <option value="乡镇企业">乡镇企业</option>
                    <option value="行政机关">行政机关</option>
                    <option value="社会团体．非盈利机构">社会团体．非盈利机构</option>
                    <option value="事业单位">事业单位</option>
                    <option value="跨国企业">跨国企业(集团)</option>
                    <option value="其他">其他</option>
                </select>
                <span id="d_error_type"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 公司规模：</td>
            <td>
                <select id="d_pnum" style="width: 230px">
                    <option value="" selected>规模不限</option>
                    <option value="10人以下">10人以下</option>
                    <option value="10～50人">10～50人</option>
                    <option value="50～200人">50～200人</option>
                    <option value="200～500人">200～500人</option>
                    <option value="500～1000人">500～1000人</option>
                    <option value="1000人以上">1000人以上</option>
                </select>
                <span id="d_error_pnum"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 所在地区：</td>
            <td>
                <input id="d_address" type="text" style="width: 230px"/>
                <span id="d_error_address"></span>
            </td>
        </tr>
        <tr class="tr_0" height="100">
            <td valign="top" align="right"><font color=#ff0000>*</font> 公司介绍：</td>
            <td>
                <TEXTAREA id="d_intro" style="width: 450px" rows=6></TEXTAREA>
                <span id="d_error_intro"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 联 系 人：</td>
            <td>
                <input id="d_linkman" type="text" style="width: 230px"/>
                <span id="d_error_linkman"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 联系电话：</td>
            <td>
                <input id="d_tel" type="text" style="width: 230px"/>
                <span id="d_error_tel"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right">传真号码：</td>
            <td>
                <input id="d_fax" type="text" style="width: 230px"/>
                <span id="d_error_fax"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font>电子邮箱：</td>
            <td>
                <input id="d_email" type="text" style="width: 230px"/>
                <span id="d_error_email"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 公司网站：</td>
            <td>
                <input id="d_web" type="text" style="width: 230px"/>
                <span id="d_error_web"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 邮政编码：</td>
            <td>
                <input id="d_postid"  type="text" style="width: 230px" maxLength=6>
                <span id="d_error_postid"></span>
            </td>
        </tr>
        <tr class="tr_0">
            <td align="right"><font color=#ff0000>*</font> 通讯地址：</td>
            <td>
                <input id="d_addrcity"  type="text" style="width: 230px"/>
                <span id="d_error_addrcity"></span>
            </td>
        </tr>
    </tbody>
</table>
<table id="act_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <col align="center" />
    <tr class="tb_title0">
        <td>
            <input id="btn_save" type="button" value="接守协议并注册">
        </td>
    </tr>
</table>
<input type="hidden" id="g_id" value="info_cregister_ok" />
<script type="text/javascript" src="../js/common.js"></script>   