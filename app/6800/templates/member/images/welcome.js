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
	document.write('Hi����ӭ������������ҳ��</font></td>')
	document.write('<td width="4%" align="left" style="font-weight:bold;">')
	document.write('<a href="#" onClick="javascript:document.getElementById(\'ssyqad\').style.display=\'none\'">')
	document.write('<img src="http://file.uei114.com/www/200904/22/ssyqad2.gif" alt="�ر�" width="27" height="27" border="0" /></a>')
	document.write('</td></tr><tr><td colspan="2" align="left" style="font-size:14px">�����ڲ��ң�')
	document.write('<a href="http://www.uei114.com/company/company_list.jsp?keywords='+referer+'"')
	document.write(' class="l14" target="_blank" style="font-size:14px"><b>'+referer+'</b></a>')
	document.write('<img src="http://file.uei114.com/www/200904/22/jt-left.gif" width="30" height="13" />')
	document.write('<font color="#0066bb">��վ������������</font><br style=" line-height:10px" /><br style=" line-height:10px" />�����������Ҫ��ѯ��ҵ��Ϣ�����ס���ǵ�������������ҳ�� ')
	document.write('<a href="http://www.uei114.com" target="_blank" class="l14" style="font-size:14px">www.uei114.com</a> ���߽����ŵ�����')
	document.write('<a href="javascript:addFavorite()" class="l14" style="font-size:14px">�ղؼ�</a>����Ȼ����Ҳ���԰���')
	document.write('<a href="javascript:setHomepage()" class="l14" style="font-size:14px">��Ϊ��ҳ</a></td></tr>')
	document.write('<tr><td colspan="2" align="left" style="font-size:14px">�����������Է������������ҵ��ϸ��Ϣ����ص���ϵ�绰��</td></tr></table>')
	document.write('</td></tr><tr>')
	document.write('<td><table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">')
	document.write('<tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td ><table width="98%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000; padding-top:10px">&nbsp;<b>��&nbsp;&nbsp;�ѣ�</b>�������ȫ���</td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>��&nbsp;&nbsp;����</b>30����ɷ������򵥿��</td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>��&nbsp;&nbsp;�ţ�</b>�����Ժ�����һ�����������ǵĴ��� </td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>��&nbsp;&nbsp;ʵ��</b>�˹������Ϣ���ݣ������Υ����Ϣ˵����</td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>��&nbsp;&nbsp;����</b>��ʮ����Ϣ��������ķ�������</td></tr>')
	document.write('<tr><td height="26" align="left" valign="middle" style="font-size:14px;color:#cc0000">&nbsp;<b>��&nbsp;&nbsp;�أ�</b>���Ų���һ��������Ǣ̸������</td></tr></table></td>')
	document.write('<td>')
	document.write('<table width="98%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; line-height:16px">')
	document.write('<tr><td width="25%" class="font-14">')
	document.write('<a href="http://www.uei114.com/location/" target="_blank" class="l14" style="font-size:14px; color:#cc0000">���л�ҳ</a> ')
	document.write('<img src="http://file.uei114.com/www/200904/22/jt.gif" width="30" height="13" /></td>')
	document.write('<td width="75%" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="20" valign="bottom">�� <font color="#cc0000">��ʡ���� �����ء�</font>������ҵ��Ϣ</td></tr>')
	document.write('<tr><td height="20" valign="top"><font color="#666">(34��ʡ�У�399�����У�2941�����أ�')
	document.write('</font></td></tr></table></td></tr>')
	document.write('<tr><td class="font-14"><a href="http://www.uei114.com/category/" target="_blank" class="l14" style="font-size:14px; color:#cc0000">��ҵ��ҳ</a> ')
	document.write('<img src="http://file.uei114.com/www/200904/22/jt.gif" width="30" height="13" /></td>')
	document.write('<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="20" valign="bottom">�� <font color="#cc0000">��һ������������</font>��ҵ ������ҵ��Ϣ</td></tr>')
	document.write('<tr><td height="20" valign="top"><font color="#666">(19��һ����132��������611������)</font></td></tr></table>')
	document.write('</td></tr><tr><td class="font-14"><a href="http://topic.uei114.com/" target="_blank" class="l14" style="font-size:14px; color:#cc0000">�����ҳ</a> ') 
	document.write('<img src="http://file.uei114.com/www/200904/22/jt.gif" width="30" height="13" /></td>')
	document.write('<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="20" valign="bottom">�� <font color="#cc0000">����ᡢ��ҵ����ҵ��</font>�¼� ������ҵ��Ϣ')
	document.write('</td></tr><tr><td height="20" valign="top"><font color="#666">(397�����⣬ƽ��ÿ����2���������)</font>')
	document.write('</td></tr></table></td></tr><tr><td class="font-14">')
	document.write('<a href="http://www.uei114.com/map/" target="_blank" class="l14" style="font-size:14px; color:#cc0000">��ͼ��ҳ</a> ')
	document.write('<img src="http://file.uei114.com/www/200904/22/jt.gif" width="30" height="13" /></td>')
	document.write('<td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">')
	document.write('<tr><td height="20" valign="bottom">�� <font color="#cc0000">����ҵ��������</font>�ؼ��� ������ҵ����λ��</td>')
	document.write('</tr><tr><td height="20" valign="top"><font color="#666">(1000�������ҵȫ��ƥ���˵���λ��)</font></td>')
	document.write('</tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table></div></div>')
}
function trim(value){
	return value.replace(/^\s*/,"").replace(/\s*$/,'');
}
function SendRequest(url, isAsynchronous){
	var xmlhttp = getXmlHttp();
	
	if (!xmlhttp) return false;
    xmlhttp.open("GET", url, isAsynchronous);   // ͬ����ʽ��
    xmlhttp.send(null);
	
	if(!isAsynchronous){
		return xmlhttp.responseText;
	}
}
function getXmlHttp(){	
	var xmlhttp = false;
	
	if(window.XMLHttpRequest) { // Mozilla �����
		xmlhttp = new XMLHttpRequest();
	}else if(window.ActiveXObject) { // IE�����
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