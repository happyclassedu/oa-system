<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:16
         compiled from ../htm/info_com_detail.htm */ ?>
<!--开始__基本功能区-->
        <div id="box_title">
            <span id="sys_title">修改公司信息</span>        </div>
        <!--结束__基本功能区-->
		<table class="info_com_center" width="978" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td>
        <table id="info_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
            <col width="30%" align="center" />
            <col width="70%" />
            <tbody>
                <tr class="tb_title0 com_title_bg">
                    <td colspan="2">公司信息</td>
                </tr>
                <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 公司名称：</td>
                    <td>
                        <input id="d_fname" style="width: 230px" type="text" />
                        <span id="d_error_fname"></span>
                    </td>
                </tr>
                <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 公司简称：</td>
                    <td>
                        <input id="d_sname" style="width: 230px" type="text" />
                        <span id="d_error_sname"></span>
                    </td>
                </tr>
                <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 营业执照(编号)：</td>
                    <td>
                        <input id="d_regid" type="text" style="width: 230px"/>
                        <span id="d_error_regid"></span>
                    </td>
               </tr>
               <tr class="tr_1">
                    <td class="tb_align">营业执照(注册时间)：</td>
                    <td>
                        <input id="d_regid" type="text" style="width: 230px"/>
                        <span id="d_error_regid"></span>
                    </td>
               </tr>
                <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 企业法人：</td>
                    <td>
                        <input id="d_legal" type="text" style="width: 230px"/>
                        <span id="d_error_legal"></span>
                    </td>
               </tr>
                <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 法人身份证：</td>
                    <td>
                        <input id="d_legalid" type="text" style="width: 230px"/>
                        <span id="d_error_legalid"></span>
                    </td>
               </tr>
                <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 组织机构代码：</td>
                    <td>
                        <input id="d_orgid" type="text" style="width: 230px"/>
                        <span id="d_error_orgid"></span>
                    </td>
               </tr>
                <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 所属行业：</td>
                    <td>
                        <select id="d_trade" style="width: 230px">
                            <option value="" selected>行业不限</option>
                        </select>
                        <span id="d_error_trade"></span>
                    </td>
                </tr>
                <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 公司性质：</td>
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
               <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 公司规模：</td>
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
                    <td class="tb_align"><font color=#ff0000>*</font> 所在地区：</td>
                    <td>
                        <input id="d_address" type="text" style="width: 230px"/>
                        <span id="d_error_address"></span>
                    </td>
              </tr>
                 <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 注册资金：</td>
                    <td>
                        <input id="d_reg_capital"  type="text" style="width: 230px"/>
                        <span id="d_error_reg_capital"></span>
                    </td>
                </tr>
                 <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 企业注册地点：</td>
                    <td>
                        <input id="d_addrcity"  type="text" style="width: 230px"/>
                        <span id="d_error_addrcity"></span>
                    </td>
                </tr>
                 <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 成立日期：</td>
                    <td>
                        <input id="d_com_time"  type="text" style="width: 230px"/>
                        <span id="d_error_com_time"></span>
                    </td>
                </tr>
                 <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 营业期限：</td>
                    <td>
                        <input id="d_operat_time"  type="text" style="width: 230px"/>
                        <span id="d_error_operat_time"></span>
                    </td>
                </tr>
                 <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 审查机关：</td>
                    <td>
                        <input id="d_app_authority"  type="text" style="width: 230px"/>
                        <span id="d_error_app_authority"></span>
                    </td>
                </tr>
                <tr class="tr_0">
                    <td valign="top" height="100" class="tb_align"><font color=#ff0000>*</font> 公司介绍：</td>
                    <td>
                        <TEXTAREA id="d_intro" style="width: 450px" rows=6></TEXTAREA>
                        <span id="d_error_intro"></span>
                    </td>
                </tr>
                <tr class="tb_title0 com_title_bg">
                    <td colspan="2">联系方式</td>
                </tr>
                <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 联 系 人：</td>
                    <td>
                        <input id="d_linkman" type="text" style="width: 230px"/>
                        <span id="d_error_linkman"></span>
                    </td>
                </tr>
                <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 联系电话：</td>
                    <td>
                        <input id="d_tel" type="text" style="width: 230px"/>
                        <span id="d_error_tel"></span>
                    </td>
                </tr>
                 <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 联系手机：</td>
                    <td>
                        <input id="d_tel2" type="text" style="width: 230px"/>
                        <span id="d_error_tel2"></span>
                    </td>
                </tr>
                <tr class="tr_1">
                    <td class="tb_align">传真号码：</td>
                    <td>
                        <input id="d_fax" type="text" style="width: 230px"/>
                        <span id="d_error_fax"></span>
                    </td>
                </tr>
                 <tr class="tr_0">
                    <td class="tb_align">QQ：</td>
                    <td>
                        <input id="d_qq" type="text" style="width: 230px"/>
                        <span id="d_error_qq"></span>
                    </td>
                </tr>
                <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font>电子邮箱：</td>
                    <td>
                        <input id="d_email" type="text" style="width: 230px"/>
                        <span id="d_error_email"></span>
                    </td>
                </tr>
                <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 公司网站：</td>
                    <td>
                        <input id="d_web" type="text" style="width: 230px"/>
                        <span id="d_error_web"></span>
                    </td>
                </tr>
                <tr class="tr_1">
                    <td class="tb_align"><font color=#ff0000>*</font> 邮政编码：</td>
                    <td>
                        <input id="d_postid"  type="text" style="width: 230px" maxLength=6>
                        <span id="d_error_postid"></span>
                    </td>
                </tr>
                <tr class="tr_0">
                    <td class="tb_align"><font color=#ff0000>*</font> 通讯地址：</td>
                    <td>
                        <input id="d_post_addr"  type="text" style="width: 230px"/>
                        <span id="d_error_post_addr"></span>
                    </td>
                </tr>

            </tbody>
        </table>
        <table id="act_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
            <col align="center" />
            <tr class="tb_title0 com_botton">
                <td>
                    <input id="btn_save" type="button" value="保存" style="width:100px; height:30px;">
                </td>
            </tr>
        </table>
		</td></tr>
</table>
<input type="hidden" id="g_id" value="info_com_detail" />
<script type="text/javascript" src="../js/common.js"></script> 