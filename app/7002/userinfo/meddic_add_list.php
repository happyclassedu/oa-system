<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');

?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script>
<script language="javascript">
<!--
function FormCheck() 
{

  if (myform.chancename.value=="")
  {
    alert("请选择所属商机！");
    document.myform.chancename.focus();
    return false;
  }
 
	var resualt_metrics=false;
	for(var i=0;i<document.myform.metrics.length;i++)
	{
		
		if(document.myform.metrics[i].checked)
		{
		  resualt_metrics=true;
		}
	}
	if(!resualt_metrics)
	{
		alert("Metrics最少选一个");
		document.myform.metrics100.focus();
		return false;
	}     

	var resualt_Economic=false;
	for(var i=0;i<document.myform.Economic.length;i++)
	{
		
		if(document.myform.Economic[i].checked)
		{
		  resualt_Economic=true;
		}
	}
	if(!resualt_Economic)
	{
		alert("Economic最少选一个");
		document.myform.Economic1.focus();
		return false;
	}
	
	var resualt_Criteria=false;
	for(var i=0;i<document.myform.Criteria.length;i++)
	{
		
		if(document.myform.Criteria[i].checked)
		{
		  resualt_Criteria=true;
		}
	}
	if(!resualt_Criteria)
	{
		alert("Criteria最少选一个");
		document.myform.Criteria1.focus();
		return false;
	}
	
	var resualt_Process=false;
	for(var i=0;i<document.myform.Process.length;i++)
	{
		
		if(document.myform.Process[i].checked)
		{
		  resualt_Process=true;
		}
	}
	if(!resualt_Process)
	{
		alert("Process最少选一个");
		document.myform.Process1.focus();
		return false;
	}
	
	var resualt_Identify=false;
	for(var i=0;i<document.myform.Identify.length;i++)
	{
		
		if(document.myform.Identify[i].checked)
		{
		  resualt_Identify=true;
		}
	}
	if(!resualt_Identify)
	{
		alert("Identify Pain最少选一个");
		document.myform.Identify100.focus();
		return false;
	}


  if (myform.Champions.value=="")
  {
    alert("请选择champions职位信息！");
    document.myform.Champions.focus();
    return false;
  }
  
	var resualt_Championszt=false;
	for(var i=0;i<document.myform.Championszt.length;i++)
	{
		
		if(document.myform.Championszt[i].checked)
		{
		  resualt_Championszt=true;
		}
	}
	if(!resualt_Championszt)
	{
		alert("Championszt忠诚度最少选一个");
		document.myform.Championszt1.focus();
		return false;
	}
				
		    
  return true;  
}

 
  function   select_linkmans(){   
    window.open("chance_select_meddic.php","mywin",   "menubar=no,width=410,height=480,resizeable=yes");   
  } 
  
function textLimitCheck(thisArea, maxLength)
{
    if (thisArea.value.length > maxLength)
	{
      alert(maxLength + ' 个字限制. \r超出的将自动去除.');
      thisArea.value = thisArea.value.substring(0, maxLength);
      thisArea.focus();
    }
    /*回写span的值，当前填写文字的数量*/
   
  }


//-->
</script>

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
          <td>&nbsp;MEDDIC销售分析->新建分析</td>
  </tr>
</table>


<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
          
    <td bgcolor="#EBEBEB" class="tishi">&nbsp;新建分析(<font color="#FF0000">*</font>必填写) 
      MEDDIC介绍请点此了解</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	<form name="myform" method="post" action="meddic_addto.php" onsubmit="return FormCheck();" style="padding:0px;margin:0px 0px 0px 0px;">
	          
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr> 
            <td bgcolor="#F3F3F3"   class="crm_td">分析所有者：</td>
            <td width="35%"   class="crm_input"><input name="userid" type="text" value="<?=$_SESSION["userdlname"];?>" id="userid" size="20" maxlength="30" readonly> 
            </td>
            <td width="40%" align="right" bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>所属商机：</td>
            <td width="40%"   class="crm_tdright"> <font color="#FF0000">&nbsp; 
              <input name="chancename" type="text" id="chancename" size="30" maxlength="40" readonly>
              <input type="hidden" name="chanceid"  id="chanceid">
              <input name="select_linkman" type="button"   class="submit" id="select_linkman2"   onClick="select_linkmans();"   value="选择" title="选择商机！">
              </font></td>
          </tr>
          <tr> 
            <td width="15%" bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Metrics：<br>
              <font color="#0000FF">10分</font> <br> </td>
            <td colspan="3"   class="crm_input"> <font color="#FF0000"> 描述可量化的效益、投入产出比（请选择投入为100时的产出比，产出比越大说明对客户越有利）</font><br>
              <input type="radio" name="metrics" id="metrics100" value="10">
               <label for="metrics100">100%</label> &nbsp;&nbsp;<input type="radio" name="metrics" id="metrics90" value="9">
               <label for="metrics90">90%</label>&nbsp;&nbsp;<input type="radio" name="metrics" id="metrics80" value="8">
               <label for="metrics80">80%</label>&nbsp;&nbsp;<input type="radio" name="metrics" id="metrics70" value="7">
               <label for="metrics70">70%</label>&nbsp;&nbsp;<input type="radio" name="metrics" id="metrics60" value="6">
               <label for="metrics60">60%</label>&nbsp;&nbsp;<input type="radio" name="metrics" id="metrics50" value="5">
               <label for="metrics50">50%</label>&nbsp;&nbsp;<input type="radio" name="metrics" id="metrics40" value="4">
               <label for="metrics40">40%</label>&nbsp;&nbsp;<input type="radio" name="metrics" id="metrics30" value="3">
               <label for="metrics30">30%</label>&nbsp;&nbsp;<input type="radio" name="metrics" id="metrics20" value="2">
               <label for="metrics20">20%</label>&nbsp;&nbsp;<input type="radio" name="metrics" id="metrics10" value="1">
               <label for="metrics10">10%</label>
               
               
               </td>
          </tr>
          <tr> 
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*&nbsp;</font>Economic 
              Buyer：<br>
              <font color="#0000FF">(有负分)20分</font> </td>
            <td colspan="3"   class="crm_input"> <font color="#FF0000"> 资金决策人（请选择与资金决策人关系）</font> 
              <br>
              <input type="radio" name="Economic" id="Economic1" value="20">
               <label for="Economic1">肯定站在我这边</label>&nbsp;&nbsp;<input type="radio" name="Economic" id="Economic2" value="0">
               <label for="Economic2">中间人，不站在任何人一边</label>&nbsp;&nbsp;<input type="radio" name="Economic" id="Economic3" value="-10">
               <label for="Economic3">站在竞争对手一边</label>
            </td>
          </tr>
          <tr id=chinaaddress1> 
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Decision 
              Criteria：<br>
              <font color="#0000FF">(有负分)10分</font> </td>
            <td colspan="3"   class="crm_input"><font color="#FF0000">了解客户标准的决策流程（包括是否了解客户的组织结构关系，能画出组织结构关系图）</font>
            	<br>
								<input  type="radio" name="Criteria" id="Criteria1" value="10"><label for="Criteria1">知道标准决策流程，并了解组织机构</label>&nbsp;&nbsp;<input type="radio" name="Criteria" id="Criteria2" value="-10">
               <label for="Criteria2">都不太清楚</label>            	
            	</td>
          </tr>
          <tr id=chinaaddress1> 
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Decision 
              Process：<br>
              <font color="#0000FF">(有负分)10分</font> </td>
            <td colspan="3"   class="crm_input"><font color="#FF0000">本次机会的评估、实施、决策流程</font>
            	<br>
								<input  type="radio" name="Process" id="Process1" value="10"><label for="Process1">清楚</label>&nbsp;&nbsp;<input type="radio" name="Process" id="Process2" value="-10">
               <label for="Process2">不清楚</label>               	
            	</td>
          </tr>
          <tr id=chinaaddress1>
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Identify 
              Pain：<br>
              <font color="#0000FF">10分</font> </td>
            <td colspan="3"   class="crm_input"><font color="#FF0000">经客户确认的客户痛处（了解客户痛处，并可以解决客户痛处百分比）<br>
              </font> 
 <input type="radio" name="Identify" id="Identify100" value="10">
               <label for="Identify100">100%</label> &nbsp;&nbsp;<input type="radio" name="Identify" id="Identify90" value="9">
               <label for="Identify90">90%</label>&nbsp;&nbsp;<input type="radio" name="Identify" id="Identify80" value="8">
               <label for="Identify80">80%</label>&nbsp;&nbsp;<input type="radio" name="Identify" id="Identify70" value="7">
               <label for="Identify70">70%</label>&nbsp;&nbsp;<input type="radio" name="Identify" id="Identify60" value="6">
               <label for="Identify60">60%</label>&nbsp;&nbsp;<input type="radio" name="Identify" id="Identify50" value="5">
               <label for="Identify50">50%</label>&nbsp;&nbsp;<input type="radio" name="Identify" id="Identify40" value="4">
               <label for="Identify40">40%</label>&nbsp;&nbsp;<input type="radio" name="Identify" id="Identify30" value="3">
               <label for="Identify30">30%</label>&nbsp;&nbsp;<input type="radio" name="Identify" id="Identify20" value="2">
               <label for="Identify20">20%</label>&nbsp;&nbsp;<input type="radio" name="Identify" id="Identify10" value="1">
               <label for="Identify10">10%</label>
              &nbsp;&nbsp; </td>
          </tr>
          <tr id=chinaaddress1> 
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Champions：<br>
              <font color="#0000FF">40分</font> </td>
            <td colspan="3"   class="crm_input"><font color="#FF0000">在组织中有权利、有影响力、愿意为你销售的人，即你的拥护者，客户内部支持你的人。
              </font><br>
              <SELECT   name=Champions size=1 id="Champions" style="background-color:#F0F0F0;">
                <OPTION value="" selected>-Champions职位-</OPTION>
                <OPTION value="30">总裁(CEO/C*O)</OPTION>
                <OPTION value="20">副总/总工/财务总监等</OPTION>
                <OPTION value="10">销售/生产/技术等部门级主管</OPTION>
                <OPTION value="1">普通职员</OPTION>
              </SELECT> 
              &nbsp;&nbsp;
              <input type="radio" name="Championszt" id="Championszt1" value="10">
               <label for="Championszt1">肯定拥护我，测试过Champions忠诚度</label>&nbsp;&nbsp;<input type="radio" name="Championszt" id="Championszt2" value="5">
               <label for="Championszt2">只有五成把握，未测试过忠诚度</label>&nbsp;&nbsp;     
              </td>
          </tr>
          <tr> 
            <td   class="crm_td">备注说明：</td>
            <td colspan="3"   class="crm_input"><textarea name="beiz" cols="85" rows="4"  id="beiz" onkeyUp="textLimitCheck(this, 500);"></textarea>
              <br>
              最多500汉字，请描述对商机的其它认识； </td>
          </tr>
          <tr align="center"> 
            <td colspan="5"   class="crm_submit"> <input type="submit" name="submit" class="submit" value="-保存-" title="保存后并返回管理日程"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="submit" class="submit" value="-保存并新建-" title="保存后并返回当前界面"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" name="Submit2" class="submit" value="-重填-"> 
              &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="-后退-" onClick="history.go(-1)" class="buttons"> 
            </td>
          </tr>
        </table>

        </form></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;line-height:22px;"><strong>说明：</strong><br>
      1、MEDDIC销售分析，是根据专业的MEDDIC销售理论来进行的商机分析，其分析结果有助于销售人员对商机的深入了解，从而发现不足，及时改正。<br>
       </td>
  </tr>
</table>
<br>