var referer = document.referrer;
if(referer.indexOf("liqwei")>-1 || referer.indexOf("www.baidu")>-1 || referer.indexOf("www.google")>-1){
	if(referer.indexOf("baidu")>-1){
		var begin = referer.indexOf("wd=")+3;
		var end = referer.indexOf("&", begin);
		if(end>-1){
			referer = referer.substring(begin, end);
		}else{
			referer = referer.substr(begin);
		}
		referer = trim(SendRequest("http://www.uei114.com/system/welcome.jsp?word="+ referer, false));
	}else if(referer.indexOf("liqwei")>-1 || referer.indexOf("google")>-1){
		var begin = referer.indexOf("q=")+2;
		var end = referer.indexOf("&", begin);
		if(end>-1){
			referer = referer.substring(begin, end);
		}else{
			referer = referer.substr(begin);
		}
		referer = decodeURIComponent(referer);
	}
	
	
	document.write('<link type="text/css" rel="stylesheet" href="http://file.uei114.com/www/200904/22/search-uei114.css" />')
	document.write('<script type="text\/javascript" src="http://file.uei114.com/www/200904/22/float_zone.js"><\/script>')
	
	document.write('<div id="ssyqad"><div id="float_zone_body" class="ssyqad" align="center">')
	document.write('<table width="98%" border="0" cellspacing="0" cellpadding="0" align="right" >')
	document.write('<tr><td colspan="2" align="right" valign="middle">')
	document.write('<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">')
	document.write('<tr><td width="96%" height="50" align="left" style="font-weight:bold; font-size:16px"><font color="#cc0000">')
	document.write('Hi，欢迎您来到锐索黄页网</font></td>')
	document.write('<td width="4%" align="left" style="font-weight:bold;">')
	document.write('<a href="#" onClick="javascript:document.getElementById(\'ssyqad\').style.display=\'none\'">')
	document.write('<img src="http://file.uei114.com/www/200904/22/ssyqad2.gif" alt="关闭" width="27" height="27" border="0" /></a>')
	document.write('</td></tr><tr><td colspan="2" align="left" style="font-size:14px">您正在查找：')
	document.write('<a href="http://www.uei114.com/company/company_list.jsp?keywords='+referer+'"')
	document.write(' class="l14" target="_blank" style="font-size:14px"><b>'+referer+'</b></a>')
	document.write('<img src="http://file.uei114.com/www/200904/22/jt-left.gif" width="30" height="13" />')
	document.write('<font color="#0066bb">（站内搜索请点击）</font><br style=" line-height:10px" /><br style=" line-height:10px" />如果您经常需要查询企业信息，请记住我们的域名：锐索黄页网 ')
	document.write('<a href="http://www.uei114.com" target="_blank" class="l14" style="font-size:14px">www.uei114.com</a> 或者将他放到您的')
	document.write('<a href="javascript:addFavorite()" class="l14" style="font-size:14px">收藏夹</a>，当然，您也可以把他')
	document.write('<a href="javascript:setHomepage()" class="l14" style="font-size:14px">设为首页</a></td></tr>')
	document.write('<tr><td colspan="2" align="left" style="font-size:14px">在这里您可以发布、浏览到企业详细信息和相关的联系电话。</td></tr></table>')
	document.write('</td></tr><tr>')
	document.write('<td><table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">')
	document.write('<tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td ><table width="98%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000; padding-top:10px">&nbsp;<b>免&nbsp;&nbsp;费：</b>浏览发布全免费</td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>简&nbsp;&nbsp;单：</b>30秒完成发布，简单快捷</td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>开&nbsp;&nbsp;放：</b>您可以和我们一起来纠正我们的错误 </td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>真&nbsp;&nbsp;实：</b>人工审核信息内容，与虚假违规信息说：不</td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>海&nbsp;&nbsp;量：</b>数十万信息涵盖生活的方方面面</td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>本&nbsp;&nbsp;地：</b>百闻不如一见，当面洽谈更放心</td></tr></table></td>')
	document.write('<td>')
	document.write('<table width="98%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; line-height:16px">')
	document.write('<tr><td width="25%" class="font-14">')
	document.write('<a href="http://www.uei114.com/location/" target="_blank" class="l14" style="font-size:14px; color:#cc0000">城市黄页</a> ')
	document.write('<img src="http://file.uei114.com/www/200904/22/jt.gif" width="30" height="13" /></td>')
	document.write('<td width="75%" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="20" valign="bottom">按 <font color="#cc0000">“省、市 、区县”</font>查找企业信息</td></tr>')
	document.write('<tr><td height="20" valign="top"><font color="#666">(34个省市，399个城市，2941个区县）')
	document.write('</font></td></tr></table></td></tr>')
	document.write('<tr><td class="font-14"><a href="http://www.uei114.com/category/" target="_blank" class="l14" style="font-size:14px; color:#cc0000">行业黄页</a> ')
	document.write('<img src="http://file.uei114.com/www/200904/22/jt.gif" width="30" height="13" /></td>')
	document.write('<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="20" valign="bottom">按 <font color="#cc0000">“一、二、三级”</font>行业 查找企业信息</td></tr>')
	document.write('<tr><td height="20" valign="top"><font color="#666">(19个一级，132个二级，611个三级)</font></td></tr></table>')
	document.write('</td></tr><tr><td class="font-14"><a href="http://topic.uei114.com/" target="_blank" class="l14" style="font-size:14px; color:#cc0000">主题黄页</a> ') 
	document.write('<img src="http://file.uei114.com/www/200904/22/jt.gif" width="30" height="13" /></td>')
	document.write('<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="20" valign="bottom">按 <font color="#cc0000">“社会、行业、产业”</font>事件 查找企业信息')
	document.write('</td></tr><tr><td height="20" valign="top"><font color="#666">(397个主题，平均每周以2个主题递增)</font>')
	document.write('</td></tr></table></td></tr><tr><td class="font-14">')
	document.write('<a href="http://www.uei114.com/map/" target="_blank" class="l14" style="font-size:14px; color:#cc0000">地图黄页</a> ')
	document.write('<img src="http://file.uei114.com/www/200904/22/jt.gif" width="30" height="13" /></td>')
	document.write('<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="20" valign="bottom">按 <font color="#cc0000">“行业、地区”</font>关键词 查找企业地理位置</td>')
	document.write('</tr><tr><td height="20" valign="top"><font color="#666">(1000多万家企业全部匹配了地理位置)</font></td>')
	document.write('</tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table></div></div>')
}
function trim(value){
	return value.replace(/^\s*/,"").replace(/\s*$/,'');
}
function SendRequest(url, isAsynchronous){
	var xmlhttp = getXmlHttp();
	
	if (!xmlhttp) return false;
    xmlhttp.open("GET", url, isAsynchronous);   // 同步方式；
    xmlhttp.send(null);
	
	if(!isAsynchronous){
		return xmlhttp.responseText;
	}
}
function getXmlHttp(){	
	var xmlhttp = false;
	
	if(window.XMLHttpRequest) { // Mozilla 浏览器
		xmlhttp = new XMLHttpRequest();
	}else if(window.ActiveXObject) { // IE浏览器
		var aVersions = ["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"];
		for(var i=0; i<aVersions.length && !xmlhttp; i++) {
			try { 
				xmlhttp = new ActiveXObject(aVersions[i]);
			}catch(e) {
				xmlhttp = false;
			}
		}
	}
	
	return xmlhttp;
}