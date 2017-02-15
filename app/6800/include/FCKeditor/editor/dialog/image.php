<?php
require_once dirname(__FILE__)."/../../../../admin/admin_global.php";
require_once dirname(__FILE__)."/../../../../admin/upfile.fun.php";

$watermark	= isset($watermark) ? $watermark : '';
$dopost		= isset($dopost)	? $dopost	 : '';
$imgwidthValue = isset($imgwidthValue) ? $imgwidthValue : 400;
$imgheightValue = isset($imgheightValue) ? $imgheightValue : 300;
$urlValue	= isset($urlValue)	? $urlValue	 : '';
$imgsrcValue= isset($imgsrcValue)?$imgsrcValue:'';
$imgurl		= isset($imgurl)	? $imgurl 	 :'';
$small		= isset($small)		? $small	 :'';

$nowtime = time();

if($_POST[dopost] =='upload')
{

	$name_file = 'imgfile';
	check_upimage($name_file);
	$destination='/editor/'.date('Ym').'/';

	if($_FILES[$name_file]['name']){

			$xm_image = start_upload($name_file,$destination);
			$imgsrcValue = $xm_image;

			$full_litfilename = $full_filename = dirname(__FILE__)."/../../../../".$xm_image;

			$sizes = getimagesize($full_filename);
			$imgwidthValue = $sizes[0];
			$imgheightValue = $sizes[1];
			$imgsize = filesize($full_litfilename);


//		$db -> query("INSERT INTO `{$db_mymps}upload` (title,url,width,height,filesize,uptime,adminid) VALUES ('小图{$mymps_image[0]}','$imgsrcValue','$imgwidthValue','$imgheightValue','{$imgsize}','{$nowtime}','{$admin_id}')");

		$kkkimg = $xm_global[cfg_basehost].$imgsrcValue;
	}

}
empty($kkkimg) && $kkkimg = 'picview.gif';

if(!eregi("^http:",$imgsrcValue)){
  $imgsrcValue = ereg_replace("/{1,}",'/',$imgsrcValue);

  $urlValue = ereg_replace("/{1,}",'/',$urlValue);
}
preg_match("/^http:/",$imgsrcValue,$newimg);
if(!$newimg[0]&&!empty($imgsrcValue)){
	$imgsrcValue = $xm_global[cfg_basehost].$imgsrcValue;
}



?>
<HTML>
<HEAD>
<title>插入图片</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style>
td{font-size:10pt;}
</style>
<script language=javascript>
var oEditor	= window.parent.InnerDialogLoaded() ;
var oDOM		= oEditor.FCK.EditorDocument ;
var FCK = oEditor.FCK;
function ImageOK()
{
	var inImg,ialign,iurl,imgwidth,imgheight,ialt,isrc,iborder;
	ialign = document.form1.ialign.value;
	iborder = document.form1.border.value;
	imgwidth = document.form1.imgwidth.value;
	imgheight = document.form1.imgheight.value;
	ialt = document.form1.alt.value;
	isrc = document.form1.imgsrc.value;
	iurl = document.form1.url.value;
	if(ialign!=0) ialign = " align='"+ialign+"'";
	inImg  = "<img src='"+ isrc +"' width='"+ imgwidth;
	inImg += "' height='"+ imgheight +"' border='"+ iborder +"' alt='"+ ialt +"'"+ialign+"/>";
	if(iurl!="") inImg = "<a href='"+ iurl +"' target='_blank'>"+ inImg +"</a>\r\n";
	if(document.all) oDOM.selection.createRange().pasteHTML(inImg);
	else FCK.InsertHtml(inImg);
  window.close();
}
function SeePic(imgid,fobj)
{
   if(!fobj) return;
   if(fobj.value != "" && fobj.value != null)
   {
     var cimg = document.getElementById(imgid);
     if(cimg) cimg.src = fobj.value;
   }
}
function UpdateImageInfo()
{
	var imgsrc = document.form1.imgsrc.value;
	if(imgsrc!="")
	{
	  var imgObj = new Image();
	  imgObj.src = imgsrc;
	  document.form1.himgheight.value = imgObj.height;
	  document.form1.himgwidth.value = imgObj.width;
	  document.form1.imgheight.value = imgObj.height;
	  document.form1.imgwidth.value = imgObj.width;
  }
}
function UpImgSizeH()
{
   var ih = document.form1.himgheight.value;
   var iw = document.form1.himgwidth.value;
   var iih = document.form1.imgheight.value;
   var iiw = document.form1.imgwidth.value;
   if(ih!=iih && iih>0 && ih>0 && document.form1.autoresize.checked)
   {
      document.form1.imgwidth.value = Math.ceil(iiw * (iih/ih));
   }
}
function UpImgSizeW()
{
   var ih = document.form1.himgheight.value;
   var iw = document.form1.himgwidth.value;
   var iih = document.form1.imgheight.value;
   var iiw = document.form1.imgwidth.value;
   if(iw!=iiw && iiw>0 && iw>0 && document.form1.autoresize.checked)
   {
      document.form1.imgheight.value = Math.ceil(iih * (iiw/iw));
   }
}
</script>
<link href="base.css" rel="stylesheet" type="text/css">
<base target="_self">
</HEAD>
<body bgcolor="#EBF6CD" leftmargin="4" topmargin="2">
<form enctype="multipart/form-data" name="form1" id="form1" method="post">
<input type="hidden" name="dopost" value="upload">
<input type="hidden" name="himgheight" value="<?php echo $imgheightValue?>">
<input type="hidden" name="himgwidth" value="<?php echo $imgwidthValue?>">
  <table width="100%" border="0">
    <tr height="20">
      <td colspan="3">
      <fieldset>
        <legend>图片属性</legend>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="65" height="25" align="right">网址：</td>
            <td colspan="2">
            	<input name="imgsrc" type="text" id="imgsrc" size="30" onChange="SeePic('picview',this);" value="<?php echo $imgsrcValue?>">
            </td>
          </tr>
          <tr>
            <td height="25" align="right">宽度：</td>
            <td colspan="2" nowrap>
			 <input type="text"  id="imgwidth" name="imgwidth" size="8" value="<?php echo $imgwidthValue?>" onChange="UpImgSizeW()">
              &nbsp;&nbsp; 高度:
              <input name="imgheight" type="text" id="imgheight" size="8" value="<?php echo $imgheightValue?>" onChange="UpImgSizeH()">
              <input type="button" name="Submit" value="原始" class="binput" style="width:40" onClick="UpdateImageInfo()">
              <input name="autoresize" type="checkbox" id="autoresize" value="1" checked>
              自适应</td>
          </tr>
          <tr>
            <td height="25" align="right">边框：</td>
            <td colspan="2" nowrap><input name="border" type="text" id="border" size="4" value="0">
              &nbsp;替代文字:
              <input name="alt" type="text" id="alt" size="10"></td>
          </tr>
          <tr>
            <td height="25" align="right">链接：</td>
            <td width="166" nowrap><input name="url" type="text" id="url" size="30"   value="<?php echo $urlValue?>"></td>
            <td width="155" align="center" nowrap>&nbsp;</td>
          </tr>
		  <tr>
            <td height="25" align="right">对齐：</td>
            <td nowrap><select name="ialign" id="ialign">
                <option value="0" selected>默认</option>
                <option value="right">右对齐</option>
                <option value="center">中间</option>
                <option value="left">左对齐</option>
                <option value="top">顶端</option>
                <option value="bottom">底部</option>
              </select></td>
            <td align="right" nowrap>
            	<input onClick="ImageOK();" type="button" name="Submit2" value=" 确定 " class="binput">&nbsp;
            </td>
          </tr>
        </table>
        </fieldset>
        </td>
    </tr>
    <tr height="25">
      <td colspan="3" nowrap> <fieldset>
        <legend>上传新图片</legend>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr height="30">
            <td align="right" nowrap>　新图片：</td>
            <td colspan="2" nowrap><input name="imgfile" type="file" id="imgfile" onChange="SeePic('picview',this);" style="height:22" class="binput">
              &nbsp; <input type="submit" name="picSubmit" id="picSubmit" value=" 上 传  " style="height:22" class="binput"></td>
          </tr>

        </table>
        </fieldset></td>
    </tr>
    <tr height="50">
      <td height="140" align="right" nowrap>预览区:</td>
      <td height="140" colspan="2" nowrap>
	  <table width="150" height="120" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td align="center"><img name="picview" id="picview" src="<?php echo $kkkimg?>" width="160" height="120" alt="预览图片"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
</body>
</HTML>