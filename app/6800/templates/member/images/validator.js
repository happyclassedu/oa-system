<!--
/*===========================================================================
 * (c)copyright 2000 liqwei
 * Email: liqwei(at)liqwei.com
 *  Site: http://www.liqwei.com/
 *===========================================================================
 * 功能：负责表单效验；
 * 版本：v1.0；
 * 发布：2009-01-01
 *===========================================================================
 */

//===========================================================================【高级效验函数】
// 功能：检验指定文本框输入是否为空；
function checkEmpty(objHandle){
	return isEmpty(objHandle.value);
}

// 功能：检验指定文本框输入是否在指定长度范围内；
function checkLength(objHandle, nameOfCheck, minLength, maxLength){
	var value = objHandle.value;
	if(minLength>0 && !isValid(value)){
		focusIt(objHandle);
		return error("“"+ nameOfCheck + "”中包含非法字符(’，*，%，&，|)！");
	}
	if(!isLengthBetween(value, minLength, maxLength)){
		focusIt(objHandle);
		return error("“"+ nameOfCheck + "”的字数范围为："+ minLength +"～"+ maxLength +"！");
	}
	return true;
}

// 功能：检验指定文本框输入是否为数字；
function checkNumber(objHandle, nameOfCheck, minLength, maxLength){
	var value = objHandle.value;
	if(minLength>0 && !isNumber(value)){
		focusIt(objHandle);
		return error("“"+ nameOfCheck + "”的格式错误！");
	}
	if(maxLength != 0 && !isLengthBetween(value, minLength, maxLength)){
		focusIt(objHandle);
		return error("“"+ nameOfCheck + "”的字数范围为："+ minLength +"～"+ maxLength +"！");
	}
	return true;
}

// 功能：检验指定文本框输入是否在指定数值范围内；
function checkValue(objHandle, nameOfCheck, minValue, maxValue){
	var value = objHandle.value;
	if(!isNumber(value)){
		focusIt(objHandle);
		return error("“"+ nameOfCheck + "”的格式错误！");	
	}
	if(minValue != 0 && maxValue != 0 && !isValueBetween(value, minValue, maxValue)){
		focusIt(objHandle);
		return error("“"+ nameOfCheck + "”的数值范围为："+ minValue +"～"+ maxValue +"！");
	}
	return true;
}

// 功能：检验指定文本框输入是否相同；
function checkSame(objHandle1, objHandle2, nameOfCheck){
	var value1 = objHandle1.value;
	var value2 = objHandle2.value;
	
	if(!isSame(value1, value2)){
		focusIt(objHandle1);
		return error("两次“"+ nameOfCheck + "”输入不一致！");
	}
	return true;
}

// 功能：检验指定文本框输入是否为邮件地址；
function checkEmail(objHandle, nameOfCheck, minLength, maxLength){
	var email = objHandle;
	if(!isLengthBetween(email.value, minLength, maxLength)){
		focusIt(email);
		return error("“"+ nameOfCheck + "”的字数范围为："+ minLength +"～"+ maxLength +"！");
	}
	if(email.value.length>0 && !isEmail(email.value)){
		focusIt(email);
		return error("“"+ nameOfCheck + "”的格式错误！");
	}
	return true;
}

// 功能：检验指定文本框输入是否为Url地址；
function checkUrl(objHandle, nameOfCheck, minLength, maxLength){
	var url = objHandle;
	if(!isLengthBetween(url.value, minLength, maxLength)){
		focusIt(url);
		return error("“"+ nameOfCheck + "”的字数范围为："+ minLength +"～"+ maxLength +"！");
	}
	if(url.value.length>0 && !isUrl(url.value)){
		focusIt(url);
		return error("“"+ nameOfCheck + "”的格式错误！");
	}
	return true;
}

// 功能：检验指定文本框输入是否为电话号码；
function checkPhoneCode(objHaddle, nameOfCheck, minLength, maxLength){
	var phoneCode = objHaddle;
	if(!isLengthBetween(phoneCode.value, minLength, maxLength)){
		focusIt(phoneCode);
		return error("“"+ nameOfCheck + "”的字数范围为："+ minLength +"～"+ maxLength +"！");
	}
	if(phoneCode.value.length>0 && !isPhoneCode(phoneCode.value)){
		focusIt(phoneCode);
		return error("“"+ nameOfCheck + "”的格式错误！");
	}
	return true;
}

// 功能：检验指定文本框输入是否为手机号码；
function checkMobileCode(objHaddle, nameOfCheck, minLength, maxLength){
	var mobileCode = objHaddle;
	if(!isLengthBetween(mobileCode.value, minLength, maxLength)){
		focusIt(mobileCode);
		return error("“"+ nameOfCheck + "”的字数范围为："+ minLength +"～"+ maxLength +"！");
	}
	if(mobileCode.value.length>0 && !isMobileCode(mobileCode.value)){
		focusIt(mobileCode);
		return error("“"+ nameOfCheck + "”的格式错误！");
	}
	return true;
}

// 功能：检验指定文本框输入是否为邮政号码；
function checkPostCode(objHaddle, nameOfCheck){
	var postCode = objHaddle;
	if(!isPostCode(postCode.value)){
		focusIt(postCode);
		return error("“"+ nameOfCheck + "”的格式错误！");
	}
	return true;	
}

// 功能：检验是否选择了指定的单选框；
function checkSelect(objHandle, nameOfCheck){
	if(!isSelect(objHandle)){
		focusIt(objHandle);
		return error("请选择“"+ nameOfCheck + "”！");
	}
	return true;
}

// 功能：检验是否选择了指定数量的复选框；
function checkSelectCount(objHandle, nameOfCheck, minCount, maxCount){
	if(!isSelectBetween(objHandle, minCount, maxCount)){
		focusIt(objHandle);
		if(maxCount<0)
			return error("至少选择"+ minCount +"个"+ nameOfCheck +"！");
		else
			return error("“"+ nameOfCheck + "”的选择范围为："+ minCount +"～"+ maxCount +"个！");
	}
	return true;
}

// 功能：检验是否选择下拉列表框；
function checkList(objHandle, nameOfCheck, errorValue){
	var list = objHandle;
	if(isEmpty(list.value)){
		focusIt(list);
		return error("请选择“"+ nameOfCheck + "”！");
	}
	if(list.multiple){  // 多选情况；
		with(list){
			for(var i=0; i<length; i++){
				if(options[i].selected)
					return true;
			}
		}
		focusIt(list);
		return error("请选择“"+ nameOfCheck + "”！");
	}else if(isSame(list.value, errorValue)){  // 单选情况；
		focusIt(list);
		return error("请选择“"+ nameOfCheck + "”！");
	}
	return true;
}

// 功能：检验是否选择了指定数量的下拉列表框选项（针对可多选的情况）；
function checkListCount(objHandle, nameOfCheck, minCount, maxCount){
	var list = objHandle;
	if(isEmpty(list.value)){
		focusIt(list);
		return error("请选择“"+ nameOfCheck + "”！");
	}
	if(list.multiple){  // 多选情况；
		var selectedCount = 0;
		with(list){
			for(var i=0; i<length; i++){
				if(options[i].selected)
					selectedCount ++;
			}
		}
		if(!(selectedCount>(minCount-1) && selectedCount<(maxCount+1))){
			focusIt(list);
			return error("“"+ nameOfCheck + "”的选择范围为："+ minCount +"～"+ maxCount +"个！");
		}
	}
	return true;
}
//===========================================================================【提示函数】
// 功能：确认操作相关函数；
function onDelete(){
	return confirm("系统提示：\n\n所选数据一旦被删除将无法恢复，确实要删除？\t\n\n（删除请点击“确定”，否则点击“取消”）\t");
}

// 功能：重置表单前确认；
function onReset(){
	return confirm("系统提示：\n\n输入数据一旦被重设将无法恢复，确实要重设？\t\n\n（重设请点击“确定”，否则点击“取消”）\t");
}

// 功能：onMouseOver 事件下，聚焦指定对象；
function onOver(obj){
	try{ obj.focus(); }catch(e){}
}

// 功能：聚焦指定对象；
function focusIt(obj){
	try{ obj.focus(); }catch(e){}
}

// 功能：提示错误信息，并返回“假”；
function error(msg){
	alert("错误提示：\n\n"+ msg +"\t");
	return false;
}
//===========================================================================【获取指定对象】
// 功能：获取指定名称的控件对象；
function getById(fieldName){
	return document.getElementById(fieldName);
}

// 功能：获取指定名称的控件对象数组；
function getByName(fieldName){
	return document.getElementsByName(fieldName);
}

// 功能：获取指定表单，指定名称的控件对象或对象数组；
function getByForm(formName, fieldName){
	return eval("document."+ formName +"."+ fieldName);
}

// 功能：获取指定控件对象的值；
function getValue(objHaddle){
	return objHaddle.value;
}

// 功能：获取指定的单选框控件对象的值；
function getValueByRadio(objHaddle){
	for(var i=0; i<objHaddle.length; i++){
		if(objHaddle[i].checked) return objHaddle[i].value;
	}
}

// 功能：获取指定的多选框控件对象的值；
function getValueByCheck(objHaddle, splitor){
	var value = new Array();
	var j=0;
	for(var i=0; i<objHaddle.length; i++){
		if(objHaddle[i].checked){
			value[j++]=objHaddle[i].value;
		}
	}
	return value.join(splitor);
}
//===========================================================================【基础校验函数】
// 功能：检测指定值是否为空；
function isEmpty(value){
	value = trim(value);
	return (value.length == 0);
}

// 功能：检测两个值是否相同；
function isSame(value1, value2){
	return (trim(value1) == trim(value2));
}

// 功能：检测数据是否在指定的长度范围内(包含边界值)，当为 -1 时忽略边界值；
function isLengthBetween(value, minLength, maxLength){
	value = trim(value);
	if(minLength==-1 && maxLength==-1){
		return true;
	}else if(minLength==-1){
		return (value.length<(maxLength+1));
	}else if(maxLength==-1){
		return (value.length>(minLength-1));
	}else{
		return (value.length>(minLength-1) && value.length<(maxLength+1));
	}
}

// 功能：检测数据是否在指定的数据范围内(包含边界值)；
function isValueBetween(value, minValue, maxValue){
	if(!isNumber(value)) return false;
	var temp = parseInt(value);
	return (temp>(minValue-1) && temp<(maxValue+1));
}

// 功能：检测是否选择了指定对象，针对 checkbox，radio 控件；
function isSelect(obj){
	var checkedFlag = false;
	if(obj.length != "undifine" && obj.length>0){
		for(var i=0; i<obj.length; i++){
			if(obj[i].checked){
				checkedFlag = true;
				break;
			}
		}
	}else{
		if(obj.checked){ checkedFlag = true; }
	}
	
	return checkedFlag;
}

// 功能：检测是否选择了指定数目的对象，针对 checkbox，radio 控件；
function isSelectBetween(obj, minCount, maxCount){
	var selectedCount = 0;
	if(obj.length>0){
		for(var i=0; i<obj.length; i++){
			if(obj[i].checked){
				selectedCount ++;
			}
		}
	}else{
		if(obj.checked){ selectedCount ++; }
	}
	
	if(maxCount<0)
		return (selectedCount>(minCount-1));
	else
		return (selectedCount>(minCount-1) && selectedCount<(maxCount+1));
}
//===========================================================================【底层校验函数】
// 功能：检测指定值是否为数字；
function isNumber(value){
	return (new RegExp("[0-9]+$","gi")).test(value);
}

// 功能：检测指定值是否为字母，不区分大小写；
function isLetter(value){
	return (new RegExp("^[A-Za-z]+$","gi")).test(value);
}

// 功能：检测指定值是否为汉字；
function isChinese(value){
	return (new RegExp("[\u4e00-\u9fa5]","gi")).test(value);
}

// 功能：检测指定值是否为合法 Email 地址；
function isEmail(value){
	return (new RegExp("\\w+@{1}((\\w)+[-]?(\\w)+\\.)+[a-z]{2,3}$","gi")).test(value);
}

// 功能：检测指定值是否为合法 URL 地址；
function isUrl(value){
	return (new RegExp("\[http://]?[www\\.]?((\\w)+\\.)+[a-z]{2,3}[/]?$","gi")).test(value);
}

// 功能：检测是否为电话号码，例如：0311-82261131；
function isPhoneCode(value){
	return (new RegExp("(\\d{3}-\\d{8}|\\d{4}-\\d{7})","gi")).test(value);
}

// 功能：检测是否为电话号码，例如：13522487523；
function isMobileCode(value){
	return (new RegExp("\\d{11}","gi")).test(value);
}

// 功能：检测是否为邮政编码；
function isPostCode(value){
	return (new RegExp("\\d{6}","gi")).test(value);
}

// 功能：检测指定值是否包含非法字符( ’，*，&，| )；
function isValid(value){
	if(value.indexOf("'")!=-1) return false;
	if(value.indexOf("*")!=-1) return false;
	if(value.indexOf("&")!=-1) return false;
	if(value.indexOf("|")!=-1) return false;
	return true;
}

// 功能：去处空格(包括空格，tab，form feed，换行符，等价于[ \f\n\r\t\v])；
function trim(value){
	return ltrim(rtrim(value));
}

// 功能：去除左边的空格； 
function ltrim(value){
	return value.replace( /^\s*/,"");
}

// 功能：去除右边的空格；
function rtrim(value){
	return value.replace(/\s*$/,'');
}

// 功能：从HTML代码中抽取指定数目的文字摘要，同时替换中英文引号，空格；
function abstractTextFromHtml(html, begin, length){
	return trim(stripHtml(html)).replace("&nbsp;"," ").replace("&ldquo;","“").replace("&rdquo;","”").replace("&quot;","\"").substring(begin,length);
}

// 功能：去除指定文本中的HTML标记：/<(.*)>.*<\/>|<(.*) \/>/；
function stripHtml(html){
	return html.replace(/<[^>]*>/g,"");
}

// 功能：去除指定文本中的空白行；
function stripBlankLine(text){
	return text.replace(/\n[\s| ]*\r/g,"");
}

// 功能：去除指定文本中的首尾空白字符；
function stripBlank(text){
	return text.replace(/(^\s*)|(\s*$)/g,"");
}

// 功能：去除指定文本中的首处空白行字符；
function stripHeadBlank(text){
	return text.replace(/^\s*/g,"");
}

// 功能：去除指定文本中的尾处空白字符；
function stripFootBlank(text){
	return text.replace(/\s*$/g,"");
}
//===========================================================================【Ajax调用函数】
// 功能：发送 Http 请求，可指定是否以异步方式发送，同步方式有返回值，异步方式无返回值；
function SendRequest(url, isAsynchronous){
	var xmlhttp = getXmlHttp();
	
	if (!xmlhttp) return false;
    xmlhttp.open("GET", url, isAsynchronous);   // 同步方式；
    xmlhttp.send(null);
	
	if(!isAsynchronous){
		return xmlhttp.responseText;
	}
}

// 功能：以异步方式，访问指定url，同时指定回调函数，并返回 xmlhttp 对象以供回调函数使用；
function SendRequestWithCallback(url, callback){	
	var xmlhttp = getXmlHttp();
	
	if (!xmlhttp) return false;
	xmlhttp.onreadystatechange = eval(callback);
	xmlhttp.open("GET", url, true);   // 异步方式；
	xmlhttp.send(null);
	
	return xmlhttp;
}

// 功能：创建 xmlhttp 对象；
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

// 功能：标红指定值，即返回显示为红色的 html 代码；
function red(value){
	return "<font color=\"red\">"+ value +"</font>";
}

// 功能：标绿指定值，即返回显示为绿色的 html 代码；
function green(value){
	return "<font color=\"green\">"+ value +"</font>";
}
-->