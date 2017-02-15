<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:16
         compiled from ../htm/info_pregister_ok.htm */ ?>
<!--开始__基本功能区-->
<div id="box_title">
    <span id="sys_title">个人简历填写</span>
</div>
<!--结束__基本功能区-->
<table id="info_tb" class="resume_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <col width="13%" align="center" />
    <col width="20%" align="center" />
    <col width="13%" align="center" />
    <col width="20%" align="center" />
    <col width="13%" align="center" />
    <col width="20%" align="center" />
    <tbody>
        <tr class="tb_title0 com_title_bg">
            <td colspan="6">个　人　基　本　信　息</td>
        </tr>
        <tr class="tr_0">
            <td class="tb_align"><font color=#ff0000>*</font> 姓　名：</td>
            <td>
                <input id="d_name"  type="text" />
            </td>
            <td class="tb_align"><font color=#ff0000>*</font> 性　别：</td>
            <td>
                <select id="d_sex">
                    <option value="">性别类别</option>
                    <option value="男">男</option>
                    <option value="女">女</option>
                    <option value="保密">保密</option>
                </select>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr class="tr_1">
            <td class="tb_align"> 民　族：</td>
            <td>
                <input id="d_minzu"  type="text"/>
            </td>
            <td class="tb_align"> 户　口：</td>
            <td>
                <input id="d_hukou" type="text"/>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr class="tr_0">
            <td class="tb_align"><font color=#ff0000>*</font> 出生年月：</td>
            <td>
                <input id="d_birth" type="text" />
            </td>
            <td class="tb_align"><font color=#ff0000>*</font> 身份证号：</td>
            <td>
                <input id="d_cardid"type="text"/>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr class="tr_1">
            <td class="tb_align">政治面貌：</td>
            <td>
                <select id="d_political">
                    <option value="">政治类别</option>
                    <option value="普通群众">普通群众</option>
                    <option value="共产党员">共产党员</option>
                    <option value="共青团员">共青团员</option>
                    <option value="民主党派">民主党派</option>
                    <option value="其他">其他</option>
                </select>
            </td>
            <td class="tb_align">婚姻状况：</td>
            <td>
                <select id="d_marry">
                    <option value="">婚姻类别</option>
                    <option value="已婚">已婚</option>
                    <option value="未婚">未婚</option>
                    <option value="保密">保密</option>
                </select>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr class="tr_0">
            <td class="tb_align"><font color=#ff0000>*</font> 所属社区：</td>
            <td>
                <input id="d_shequ"  type="text" />
            </td>
            <td class="tb_align">健康情况：</td>
            <td>
                <input id="d_health" type="text"/>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr class="tr_1">
            <td class="tb_align"><font color=#ff0000>*</font> 文化程度：</td>
            <td><input id="d_degree"  type="text" /></td>
            <td class="tb_align"><font color=#ff0000>*</font> 毕业学校：</td>
            <td><input id="d_univ" type="text"/></td>
            <td class="tb_align"><font color=#ff0000>*</font> 毕业专业</td>
            <td><input id="d_major" type="text"/></td>
        </tr>
        <tr class="tr_0">
            <td class="tb_align">个人特长：</td>
            <td colspan="5">
                <textarea id="d_goodat" rows="2"></textarea>
            </td>
        </tr>
        <tr class="tb_title0 com_title_bg">
            <td colspan="6">教　育　背　景</td>
        </tr>
        <tr class="tr_0 resume_title">
            <td>开始时间</td>
            <td>结束时间</td>
            <td>教育(或培训)机构</td>
            <td>专业/方向/内容</td>
            <td>成绩/证书/荣誉</td>
            <td>备注</td>
        </tr>
        <tr class="tr_1 resume_title">
            <td><input id="d_ebegina" type="text"/></td>
            <td><input id="d_eenda" type="text"/></td>
            <td><input id="d_ecoma" type="text"/></td>
            <td><input id="d_emajora" type="text"/></td>
            <td><input id="d_ehonora" type="text"/></td>
            <td><input id="d_eremarka" type="text"/></td>
        </tr>
        <tr class="tr_1 resume_title">
            <td><input id="d_ebeginb" type="text"/></td>
            <td><input id="d_eendb" type="text"/></td>
            <td><input id="d_ecomb" type="text"/></td>
            <td><input id="d_emajorb" type="text"/></td>
            <td><input id="d_ehonorb" type="text"/></td>
            <td><input id="d_eremarkb" type="text"/></td>
        </tr>
        <tr class="tr_1 resume_title">
            <td><input id="d_ebeginc" type="text"/></td>
            <td><input id="d_eendc" type="text"/></td>
            <td><input id="d_ecomc" type="text"/></td>
            <td><input id="d_emajorc" type="text"/></td>
            <td><input id="d_ehonorc" type="text"/></td>
            <td><input id="d_eremarkc" type="text"/></td>
        </tr>
        <tr class="tb_title0 com_title_bg">
            <td colspan="6">联　系　方　式</td>
        </tr>
        <tr class="tr_0">
            <td class="tb_align"><font color=#ff0000>*</font> 手　机：</td>
            <td>
                <input id="d_mobile" type="text"/>
            </td>
            <td class="tb_align">固定电话：</td>
            <td>
                <input id="d_tel" type="text"/>
            </td>
            <td class="tb_align"><font color=#ff0000>*</font> 住　址：</td>
            <td>
                <input id="d_addr" type="text"/>
            </td>
        </tr>
        <tr class="tb_title0 com_title_bg">
            <td colspan="6">求　职　意　向</td>
        </tr>
        <tr class="tr_0">
            <td class="tb_align"><font color=#ff0000>*</font> 应聘职位A：</td>
            <td>
                <input id="d_joba" type="text"/>
            </td>
            <td class="tb_align">应聘职位B：</td>
            <td>
                <input id="d_jobb" type="text"/>
            </td>
            <td class="tb_align">应聘职位C：</td>
            <td>
                <input id="d_jobc" type="text"/>
            </td>
        </tr>
        <tr class="tr_0">
            <td class="tb_align">目前薪资：</td>
            <td>
                <input id="d_npay" type="text"/>
            </td>
            <td class="tb_align">期望薪资：</td>
            <td>
                <input id="d_wpay" type="text" style="width: 110px;"/>元/面议
            </td>
            <td class="tb_align"><font color=#ff0000>*</font> 工作地点：</td>
            <td>
                <input id="d_waddr" type="text"/>
            </td>
        </tr>
        <tr class="tb_title0 com_title_bg">
            <td colspan="6">工　作　经　历</td>
        </tr>
        <tr class="tr_0 resume_title">
            <td>开始时间</td>
            <td>结束时间</td>
            <td>单位名称</td>
            <td>担任职位</td>
            <td>担任职位</td>
            <td>离职原因</td>
        </tr>
        <tr class="tr_1 resume_title">
            <td><input id="d_fbegina" type="text"/></td>
            <td><input id="d_fenda" type="text"/></td>
            <td><input id="d_fcoma" type="text"/></td>
            <td><input id="d_fmajora" type="text"/></td>
            <td><input id="d_fhonora" type="text"/></td>
            <td><input id="d_fremarka" type="text"/></td>
        </tr>
        <tr class="tr_1 resume_title">
            <td><input id="d_fbegina" type="text"/></td>
            <td><input id="d_fenda" type="text"/></td>
            <td><input id="d_fcoma" type="text"/></td>
            <td><input id="d_fmajora" type="text"/></td>
            <td><input id="d_fhonora" type="text"/></td>
            <td><input id="d_fremarka" type="text"/></td>
        </tr>
        <tr class="tr_1 resume_title">
            <td><input id="d_fbegina" type="text"/></td>
            <td><input id="d_fenda" type="text"/></td>
            <td><input id="d_fcoma" type="text"/></td>
            <td><input id="d_fmajora" type="text"/></td>
            <td><input id="d_fhonora" type="text"/></td>
            <td><input id="d_fremarka" type="text"/></td>
        </tr>
    </tbody>
</table>
<table id="act_tb" width="800" border="0" cellspacing="0" cellpadding="0" align="center">
    <col align="center" />
    <tr class="tb_title0 com_botton">
        <td>
            <input id="btn_save" type="button" value="保存，下一步" style="width:130px; height:30px;">&nbsp;<div id="d_error"></div>
        </td>
    </tr>
</table>
<input type="hidden" id="g_id" value="info_pregister_ok" />
<script type="text/javascript" src="../js/common.js"></script> 