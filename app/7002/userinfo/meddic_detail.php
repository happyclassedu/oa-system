<?
require_once('../lib07/auto_load.php');
require_once('../lib07/pages.inc.php');
if(!defined('dbzz_net')) {
	exit('Access Denied');
}
require_once('../lib07/islogin.php');
$id=addslashes(trim($_GET['id']));

	$sql="select * from meddic where id='".$id."'";
//	echo $sql;
	$rs=$obj->fetchrow($sql);
	$id=trim($rs->id);
					$adduser=trim($rs->userid);
					$username=trim($rs->username);
					$client_name=trim($rs->chancename);
					$chanceid=trim($rs->chanceid);
					$metrics=trim($rs->metrics);
					$economic=trim($rs->economic);
					$criteria=trim($rs->criteria);
 					$process=trim($rs->process);
          $pain=trim($rs->pain);
          $champions=trim($rs->champions);
          $Championszt=trim($rs->championszt);
//          echo $Championszt;
          $bz=trim($rs->bz);
	if ($client_name=="")
	{
			echo "<script language=javascript>alert('分析数据错误3');history.go(-1);</script>";
			exit;			
		}
?>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/inputstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/lefttoggler.js"></script>
 

<table  border="0" class="daohang" cellspacing="0" cellpadding="0">
  <tr>
          <td>&nbsp;MEDDIC销售分析->新建分析</td>
  </tr>
</table>


<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC"  class="bianmamanage" style="padding:0px;">
  <tr> 
          
    <td bgcolor="#EBEBEB" class="tishi">&nbsp;分析详细(<font color="#FF0000">*</font>必填写) 
      MEDDIC介绍请点此了解</td>
  </tr>
  <tr> 
    <td bgcolor="#FFFFFF" height="30" style="padding:0px;border-bottom:1px solid #C6CBEE;"> 
	          
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
          <tr> 
            <td bgcolor="#F3F3F3"   class="crm_td">分析所有者：</td>
            <td width="35%"   class="crm_input"><?=$username;?>
            </td>
            <td width="40%" align="right" bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>所属商机：</td>
            <td width="40%"   class="crm_tdright"> <font color="#FF0000">&nbsp; 
            	<?=$client_name;?>
              </font></td>
          </tr>
          <tr> 
            <td width="15%" bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Metrics：<br>
              10分 <br> </td>
            <td colspan="3"   class="crm_input"> <font color="#FF0000"> 描述可量化的效益、投入产出比（请选择投入为100时的产出比，产出比越大说明对客户越有利）</font><br>

    
              <input type="radio" name="metrics"  <?if ($metrics==10) echo "checked";?> id="metrics100" value="10">
               <label for="metrics100">100%</label> &nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==9) echo "checked";?> id="metrics90" value="9">
               <label for="metrics90">90%</label>&nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==8) echo "checked";?> id="metrics80" value="8">
               <label for="metrics80">80%</label>&nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==7) echo "checked";?> id="metrics70" value="7">
               <label for="metrics70">70%</label>&nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==6) echo "checked";?> id="metrics60" value="6">
               <label for="metrics60">60%</label>&nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==5) echo "checked";?> id="metrics50" value="5">
               <label for="metrics50">50%</label>&nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==4) echo "checked";?> id="metrics40" value="4">
               <label for="metrics40">40%</label>&nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==3) echo "checked";?> id="metrics30" value="3">
               <label for="metrics30">30%</label>&nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==2) echo "checked";?> id="metrics20" value="2">
               <label for="metrics20">20%</label>&nbsp;&nbsp;<input type="radio" name="metrics"  <?if ($metrics==1) echo "checked";?> id="metrics10" value="1">
               <label for="metrics10">10%</label>
               
               
               </td>
          </tr>
          <tr> 
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*&nbsp;</font>Economic 
              Buyer：<br>
              (有负分)20分 </td>
            <td colspan="3"   class="crm_input"> <font color="#FF0000"> 资金决策人（请选择与资金决策人关系）</font> 
              <br>
              <input type="radio" name="Economic" id="Economic1" <?if ($economic==20) echo "checked";?> value="20">
               <label for="Economic1">肯定站在我这边</label>&nbsp;&nbsp;<input type="radio" <?if ($economic==0) echo "checked";?> name="Economic" id="Economic2" value="0">
               <label for="Economic2">中间人，不站在任何人一边</label>&nbsp;&nbsp;<input type="radio" <?if ($economic==-10) echo "checked";?> name="Economic" id="Economic3" value="-10">
               <label for="Economic3">站在竞争对手一边</label>
            </td>
          </tr>
          <tr id=chinaaddress1> 
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Decision 
              Criteria：<br>
              (有负分)10分 </td>
            <td colspan="3"   class="crm_input"><font color="#FF0000">了解客户标准的决策流程（包括是否了解客户的组织结构关系，能画出组织结构关系图）</font>
            	<br>
								<input  type="radio" name="Criteria" id="Criteria1" <?if ($criteria==10) echo "checked";?> value="10"><label for="Criteria1">知道标准决策流程，并了解组织机构</label>&nbsp;&nbsp;<input type="radio" name="Criteria"  <?if ($criteria==-10) echo "checked";?> id="Criteria2" value="-10">
               <label for="Criteria2">都不太清楚</label>            	
            	</td>
          </tr>
          <tr id=chinaaddress1> 
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Decision 
              Process：<br>
              (有负分)10分 </td>
            <td colspan="3"   class="crm_input"><font color="#FF0000">本次机会的评估、实施、决策流程</font>
            	<br>
								<input  type="radio" name="Process" id="Process1" value="10" <?if ($process==10) echo "checked";?>><label for="Process1">清楚</label>&nbsp;&nbsp;<input type="radio" <?if ($process==-10) echo "checked";?> name="Process" id="Process2" value="-10">
               <label for="Process2">不清楚</label>               	
            	</td>
          </tr>
          <tr id=chinaaddress1>
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Identify 
              Pain：<br>
               10分  </td>
            <td colspan="3"   class="crm_input"><font color="#FF0000">经客户确认的客户痛处（了解客户痛处，并可以解决客户痛处百分比）<br>
              </font> 
 								<input type="radio" name="Identify" id="Identify100" <?if ($pain==10) echo "checked";?> value="10">
               <label for="Identify100">100%</label> &nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==9) echo "checked";?> id="Identify90" value="9">
               <label for="Identify90">90%</label>&nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==8) echo "checked";?> id="Identify80" value="8">
               <label for="Identify80">80%</label>&nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==7) echo "checked";?> id="Identify70" value="7">
               <label for="Identify70">70%</label>&nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==6) echo "checked";?> id="Identify60" value="6">
               <label for="Identify60">60%</label>&nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==5) echo "checked";?> id="Identify50" value="5">
               <label for="Identify50">50%</label>&nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==4) echo "checked";?> id="Identify40" value="4">
               <label for="Identify40">40%</label>&nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==3) echo "checked";?> id="Identify30" value="3">
               <label for="Identify30">30%</label>&nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==2) echo "checked";?> id="Identify20" value="2">
               <label for="Identify20">20%</label>&nbsp;&nbsp;<input type="radio" name="Identify" <?if ($pain==1) echo "checked";?> id="Identify10" value="1">
               <label for="Identify10">10%</label>
              &nbsp;&nbsp; </td>
          </tr>
          <tr id=chinaaddress1> 
            <td bgcolor="#F3F3F3"   class="crm_td"><font color="#FF0000">*</font>Champions：<br>
              40分 </td>
            <td colspan="3"   class="crm_input"><font color="#FF0000">在组织中有权利、有影响力、愿意为你销售的人，即你的拥护者，客户内部支持你的人。
              </font><br>
              <SELECT   name=Champions size=1 id="Champions" style="background-color:#F0F0F0;">
                <OPTION value="" selected>-Champions职位-</OPTION>
                <OPTION value="30" <?if ($champions==30) echo "selected";?>>总裁(CEO/C*O)</OPTION>
                <OPTION value="20" <?if ($champions==20) echo "selected";?>>副总/总工/财务总监等</OPTION>
                <OPTION value="10" <?if ($champions==10) echo "selected";?>>销售/生产/技术等部门级主管</OPTION>
                <OPTION value="1" <?if ($champions==1) echo "selected";?>>普通职员</OPTION>
              </SELECT> 
              &nbsp;&nbsp;
              <input type="radio" name="Championszt"  <?if ($Championszt==10) echo "checked";?> id="Championszt1" value="10">
               <label for="Championszt1">肯定拥护我，测试过Champions忠诚度</label>&nbsp;&nbsp;<input type="radio" name="Championszt" <?if ($Championszt==5) echo "checked";?> id="Championszt2" value="5">
               <label for="Championszt2">只有五成把握，未测试过忠诚度</label>&nbsp;&nbsp;     
              </td>
          </tr>
          <tr> 
            <td   class="crm_td">备注说明：</td>
            <td colspan="3"   class="crm_input"><textarea name="beiz" cols="85" rows="4"  id="beiz" onkeyUp="textLimitCheck(this, 500);"><?=$bz;?></textarea>
              <br>
              最多500汉字，请描述对商机的其它认识； </td>
          </tr>
 
        </table>

       </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="30" style="padding:3px;font-size:13px;line-height:22px;">
    	<?
          $str_cham=$champions+$championszt;
          $str_success=$metrics+$economic+$criteria+$process+$pain+$str_cham;
          $strfx="2、MEDDIC简要分析：<br>";
          if ($metrics<=2) $strfx=$strfx."&nbsp;&nbsp;&nbsp;&nbsp;Metrics：投入产出比低于20%，可能会影响成功率！<br>";
          if ($economic==-10) $strfx=$strfx."&nbsp;&nbsp;&nbsp;&nbsp;Economic：资金决策人在竞争对手一侧，肯定会影响成功率！<br>";
          if ($criteria==-10) $strfx=$strfx."&nbsp;&nbsp;&nbsp;&nbsp;Criteria：不了解客户的组织结构关系，肯定会影响决策流程的了解！<br>";
          if ($process==-10) $strfx=$strfx."&nbsp;&nbsp;&nbsp;&nbsp;Process：不了解本次商机决策流程，一定会影响项目的推动，请与各流程决策点负责人进行更好的沟通！<br>";
          if ($pain<=2) $strfx=$strfx."&nbsp;&nbsp;&nbsp;&nbsp;Pain：对客户痛的问题解决的不好，影响项目的推进！<br>";
          if ($champions<=1) $strfx=$strfx."&nbsp;&nbsp;&nbsp;&nbsp;Champions：您的支持者职位太低，肯定会影响项目的推动。<br>";
          if ($Championszt==5) $strfx=$strfx."&nbsp;&nbsp;&nbsp;&nbsp;Champions：请测试您支持者的忠诚度，否则会影响您项目的进度。<a href=''>点此查看测试办法</a><br>";
    	?>
    	<strong>分析结果：</strong><br>1、<font color=red>成功率在<?=$str_success;?>%左右</font><br>
    	
      <?=$strfx;?>
       </td>
  </tr>
</table>
<br>