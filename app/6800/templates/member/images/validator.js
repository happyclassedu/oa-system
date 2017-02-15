<!--
/*===========================================================================
 * (c)copyright 2000 liqwei
 * Email: liqwei(at)liqwei.com
 *  Site: http://www.liqwei.com/
 *===========================================================================
 * ���ܣ������Ч�飻
 * �汾��v1.0��
 * ������2009-01-01
 *===========================================================================
 */

//===========================================================================���߼�Ч�麯����
// ���ܣ�����ָ���ı��������Ƿ�Ϊ�գ�
function checkEmpty(objHandle){
	return isEmpty(objHandle.value);
}

// ���ܣ�����ָ���ı��������Ƿ���ָ�����ȷ�Χ�ڣ�
function checkLength(objHandle, nameOfCheck, minLength, maxLength){
	var value = objHandle.value;
	if(minLength>0 && !isValid(value)){
		focusIt(objHandle);
		return error("��"+ nameOfCheck + "���а����Ƿ��ַ�(����*��%��&��|)��");
	}
	if(!isLengthBetween(value, minLength, maxLength)){
		focusIt(objHandle);
		return error("��"+ nameOfCheck + "����������ΧΪ��"+ minLength +"��"+ maxLength +"��");
	}
	return true;
}

// ���ܣ�����ָ���ı��������Ƿ�Ϊ���֣�
function checkNumber(objHandle, nameOfCheck, minLength, maxLength){
	var value = objHandle.value;
	if(minLength>0 && !isNumber(value)){
		focusIt(objHandle);
		return error("��"+ nameOfCheck + "���ĸ�ʽ����");
	}
	if(maxLength != 0 && !isLengthBetween(value, minLength, maxLength)){
		focusIt(objHandle);
		return error("��"+ nameOfCheck + "����������ΧΪ��"+ minLength +"��"+ maxLength +"��");
	}
	return true;
}

// ���ܣ�����ָ���ı��������Ƿ���ָ����ֵ��Χ�ڣ�
function checkValue(objHandle, nameOfCheck, minValue, maxValue){
	var value = objHandle.value;
	if(!isNumber(value)){
		focusIt(objHandle);
		return error("��"+ nameOfCheck + "���ĸ�ʽ����");	
	}
	if(minValue != 0 && maxValue != 0 && !isValueBetween(value, minValue, maxValue)){
		focusIt(objHandle);
		return error("��"+ nameOfCheck + "������ֵ��ΧΪ��"+ minValue +"��"+ maxValue +"��");
	}
	return true;
}

// ���ܣ�����ָ���ı��������Ƿ���ͬ��
function checkSame(objHandle1, objHandle2, nameOfCheck){
	var value1 = objHandle1.value;
	var value2 = objHandle2.value;
	
	if(!isSame(value1, value2)){
		focusIt(objHandle1);
		return error("���Ρ�"+ nameOfCheck + "�����벻һ�£�");
	}
	return true;
}

// ���ܣ�����ָ���ı��������Ƿ�Ϊ�ʼ���ַ��
function checkEmail(objHandle, nameOfCheck, minLength, maxLength){
	var email = objHandle;
	if(!isLengthBetween(email.value, minLength, maxLength)){
		focusIt(email);
		return error("��"+ nameOfCheck + "����������ΧΪ��"+ minLength +"��"+ maxLength +"��");
	}
	if(email.value.length>0 && !isEmail(email.value)){
		focusIt(email);
		return error("��"+ nameOfCheck + "���ĸ�ʽ����");
	}
	return true;
}

// ���ܣ�����ָ���ı��������Ƿ�ΪUrl��ַ��
function checkUrl(objHandle, nameOfCheck, minLength, maxLength){
	var url = objHandle;
	if(!isLengthBetween(url.value, minLength, maxLength)){
		focusIt(url);
		return error("��"+ nameOfCheck + "����������ΧΪ��"+ minLength +"��"+ maxLength +"��");
	}
	if(url.value.length>0 && !isUrl(url.value)){
		focusIt(url);
		return error("��"+ nameOfCheck + "���ĸ�ʽ����");
	}
	return true;
}

// ���ܣ�����ָ���ı��������Ƿ�Ϊ�绰���룻
function checkPhoneCode(objHaddle, nameOfCheck, minLength, maxLength){
	var phoneCode = objHaddle;
	if(!isLengthBetween(phoneCode.value, minLength, maxLength)){
		focusIt(phoneCode);
		return error("��"+ nameOfCheck + "����������ΧΪ��"+ minLength +"��"+ maxLength +"��");
	}
	if(phoneCode.value.length>0 && !isPhoneCode(phoneCode.value)){
		focusIt(phoneCode);
		return error("��"+ nameOfCheck + "���ĸ�ʽ����");
	}
	return true;
}

// ���ܣ�����ָ���ı��������Ƿ�Ϊ�ֻ����룻
function checkMobileCode(objHaddle, nameOfCheck, minLength, maxLength){
	var mobileCode = objHaddle;
	if(!isLengthBetween(mobileCode.value, minLength, maxLength)){
		focusIt(mobileCode);
		return error("��"+ nameOfCheck + "����������ΧΪ��"+ minLength +"��"+ maxLength +"��");
	}
	if(mobileCode.value.length>0 && !isMobileCode(mobileCode.value)){
		focusIt(mobileCode);
		return error("��"+ nameOfCheck + "���ĸ�ʽ����");
	}
	return true;
}

// ���ܣ�����ָ���ı��������Ƿ�Ϊ�������룻
function checkPostCode(objHaddle, nameOfCheck){
	var postCode = objHaddle;
	if(!isPostCode(postCode.value)){
		focusIt(postCode);
		return error("��"+ nameOfCheck + "���ĸ�ʽ����");
	}
	return true;	
}

// ���ܣ������Ƿ�ѡ����ָ���ĵ�ѡ��
function checkSelect(objHandle, nameOfCheck){
	if(!isSelect(objHandle)){
		focusIt(objHandle);
		return error("��ѡ��"+ nameOfCheck + "����");
	}
	return true;
}

// ���ܣ������Ƿ�ѡ����ָ�������ĸ�ѡ��
function checkSelectCount(objHandle, nameOfCheck, minCount, maxCount){
	if(!isSelectBetween(objHandle, minCount, maxCount)){
		focusIt(objHandle);
		if(maxCount<0)
			return error("����ѡ��"+ minCount +"��"+ nameOfCheck +"��");
		else
			return error("��"+ nameOfCheck + "����ѡ��ΧΪ��"+ minCount +"��"+ maxCount +"����");
	}
	return true;
}

// ���ܣ������Ƿ�ѡ�������б��
function checkList(objHandle, nameOfCheck, errorValue){
	var list = objHandle;
	if(isEmpty(list.value)){
		focusIt(list);
		return error("��ѡ��"+ nameOfCheck + "����");
	}
	if(list.multiple){  // ��ѡ�����
		with(list){
			for(var i=0; i<length; i++){
				if(options[i].selected)
					return true;
			}
		}
		focusIt(list);
		return error("��ѡ��"+ nameOfCheck + "����");
	}else if(isSame(list.value, errorValue)){  // ��ѡ�����
		focusIt(list);
		return error("��ѡ��"+ nameOfCheck + "����");
	}
	return true;
}

// ���ܣ������Ƿ�ѡ����ָ�������������б��ѡ���Կɶ�ѡ���������
function checkListCount(objHandle, nameOfCheck, minCount, maxCount){
	var list = objHandle;
	if(isEmpty(list.value)){
		focusIt(list);
		return error("��ѡ��"+ nameOfCheck + "����");
	}
	if(list.multiple){  // ��ѡ�����
		var selectedCount = 0;
		with(list){
			for(var i=0; i<length; i++){
				if(options[i].selected)
					selectedCount ++;
			}
		}
		if(!(selectedCount>(minCount-1) && selectedCount<(maxCount+1))){
			focusIt(list);
			return error("��"+ nameOfCheck + "����ѡ��ΧΪ��"+ minCount +"��"+ maxCount +"����");
		}
	}
	return true;
}
//===========================================================================����ʾ������
// ���ܣ�ȷ�ϲ�����غ�����
function onDelete(){
	return confirm("ϵͳ��ʾ��\n\n��ѡ����һ����ɾ�����޷��ָ���ȷʵҪɾ����\t\n\n��ɾ��������ȷ��������������ȡ������\t");
}

// ���ܣ����ñ�ǰȷ�ϣ�
function onReset(){
	return confirm("ϵͳ��ʾ��\n\n��������һ�������轫�޷��ָ���ȷʵҪ���裿\t\n\n������������ȷ��������������ȡ������\t");
}

// ���ܣ�onMouseOver �¼��£��۽�ָ������
function onOver(obj){
	try{ obj.focus(); }catch(e){}
}

// ���ܣ��۽�ָ������
function focusIt(obj){
	try{ obj.focus(); }catch(e){}
}

// ���ܣ���ʾ������Ϣ�������ء��١���
function error(msg){
	alert("������ʾ��\n\n"+ msg +"\t");
	return false;
}
//===========================================================================����ȡָ������
// ���ܣ���ȡָ�����ƵĿؼ�����
function getById(fieldName){
	return document.getElementById(fieldName);
}

// ���ܣ���ȡָ�����ƵĿؼ��������飻
function getByName(fieldName){
	return document.getElementsByName(fieldName);
}

// ���ܣ���ȡָ������ָ�����ƵĿؼ������������飻
function getByForm(formName, fieldName){
	return eval("document."+ formName +"."+ fieldName);
}

// ���ܣ���ȡָ���ؼ������ֵ��
function getValue(objHaddle){
	return objHaddle.value;
}

// ���ܣ���ȡָ���ĵ�ѡ��ؼ������ֵ��
function getValueByRadio(objHaddle){
	for(var i=0; i<objHaddle.length; i++){
		if(objHaddle[i].checked) return objHaddle[i].value;
	}
}

// ���ܣ���ȡָ���Ķ�ѡ��ؼ������ֵ��
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
//===========================================================================������У�麯����
// ���ܣ����ָ��ֵ�Ƿ�Ϊ�գ�
function isEmpty(value){
	value = trim(value);
	return (value.length == 0);
}

// ���ܣ��������ֵ�Ƿ���ͬ��
function isSame(value1, value2){
	return (trim(value1) == trim(value2));
}

// ���ܣ���������Ƿ���ָ���ĳ��ȷ�Χ��(�����߽�ֵ)����Ϊ -1 ʱ���Ա߽�ֵ��
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

// ���ܣ���������Ƿ���ָ�������ݷ�Χ��(�����߽�ֵ)��
function isValueBetween(value, minValue, maxValue){
	if(!isNumber(value)) return false;
	var temp = parseInt(value);
	return (temp>(minValue-1) && temp<(maxValue+1));
}

// ���ܣ�����Ƿ�ѡ����ָ��������� checkbox��radio �ؼ���
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

// ���ܣ�����Ƿ�ѡ����ָ����Ŀ�Ķ������ checkbox��radio �ؼ���
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
//===========================================================================���ײ�У�麯����
// ���ܣ����ָ��ֵ�Ƿ�Ϊ���֣�
function isNumber(value){
	return (new RegExp("[0-9]+$","gi")).test(value);
}

// ���ܣ����ָ��ֵ�Ƿ�Ϊ��ĸ�������ִ�Сд��
function isLetter(value){
	return (new RegExp("^[A-Za-z]+$","gi")).test(value);
}

// ���ܣ����ָ��ֵ�Ƿ�Ϊ���֣�
function isChinese(value){
	return (new RegExp("[\u4e00-\u9fa5]","gi")).test(value);
}

// ���ܣ����ָ��ֵ�Ƿ�Ϊ�Ϸ� Email ��ַ��
function isEmail(value){
	return (new RegExp("\\w+@{1}((\\w)+[-]?(\\w)+\\.)+[a-z]{2,3}$","gi")).test(value);
}

// ���ܣ����ָ��ֵ�Ƿ�Ϊ�Ϸ� URL ��ַ��
function isUrl(value){
	return (new RegExp("\[http://]?[www\\.]?((\\w)+\\.)+[a-z]{2,3}[/]?$","gi")).test(value);
}

// ���ܣ�����Ƿ�Ϊ�绰���룬���磺0311-82261131��
function isPhoneCode(value){
	return (new RegExp("(\\d{3}-\\d{8}|\\d{4}-\\d{7})","gi")).test(value);
}

// ���ܣ�����Ƿ�Ϊ�绰���룬���磺13522487523��
function isMobileCode(value){
	return (new RegExp("\\d{11}","gi")).test(value);
}

// ���ܣ�����Ƿ�Ϊ�������룻
function isPostCode(value){
	return (new RegExp("\\d{6}","gi")).test(value);
}

// ���ܣ����ָ��ֵ�Ƿ�����Ƿ��ַ�( ����*��&��| )��
function isValid(value){
	if(value.indexOf("'")!=-1) return false;
	if(value.indexOf("*")!=-1) return false;
	if(value.indexOf("&")!=-1) return false;
	if(value.indexOf("|")!=-1) return false;
	return true;
}

// ���ܣ�ȥ���ո�(�����ո�tab��form feed�����з����ȼ���[ \f\n\r\t\v])��
function trim(value){
	return ltrim(rtrim(value));
}

// ���ܣ�ȥ����ߵĿո� 
function ltrim(value){
	return value.replace( /^\s*/,"");
}

// ���ܣ�ȥ���ұߵĿո�
function rtrim(value){
	return value.replace(/\s*$/,'');
}

// ���ܣ���HTML�����г�ȡָ����Ŀ������ժҪ��ͬʱ�滻��Ӣ�����ţ��ո�
function abstractTextFromHtml(html, begin, length){
	return trim(stripHtml(html)).replace("&nbsp;"," ").replace("&ldquo;","��").replace("&rdquo;","��").replace("&quot;","\"").substring(begin,length);
}

// ���ܣ�ȥ��ָ���ı��е�HTML��ǣ�/<(.*)>.*<\/>|<(.*) \/>/��
function stripHtml(html){
	return html.replace(/<[^>]*>/g,"");
}

// ���ܣ�ȥ��ָ���ı��еĿհ��У�
function stripBlankLine(text){
	return text.replace(/\n[\s| ]*\r/g,"");
}

// ���ܣ�ȥ��ָ���ı��е���β�հ��ַ���
function stripBlank(text){
	return text.replace(/(^\s*)|(\s*$)/g,"");
}

// ���ܣ�ȥ��ָ���ı��е��״��հ����ַ���
function stripHeadBlank(text){
	return text.replace(/^\s*/g,"");
}

// ���ܣ�ȥ��ָ���ı��е�β���հ��ַ���
function stripFootBlank(text){
	return text.replace(/\s*$/g,"");
}
//===========================================================================��Ajax���ú�����
// ���ܣ����� Http ���󣬿�ָ���Ƿ����첽��ʽ���ͣ�ͬ����ʽ�з���ֵ���첽��ʽ�޷���ֵ��
function SendRequest(url, isAsynchronous){
	var xmlhttp = getXmlHttp();
	
	if (!xmlhttp) return false;
    xmlhttp.open("GET", url, isAsynchronous);   // ͬ����ʽ��
    xmlhttp.send(null);
	
	if(!isAsynchronous){
		return xmlhttp.responseText;
	}
}

// ���ܣ����첽��ʽ������ָ��url��ͬʱָ���ص������������� xmlhttp �����Թ��ص�����ʹ�ã�
function SendRequestWithCallback(url, callback){	
	var xmlhttp = getXmlHttp();
	
	if (!xmlhttp) return false;
	xmlhttp.onreadystatechange = eval(callback);
	xmlhttp.open("GET", url, true);   // �첽��ʽ��
	xmlhttp.send(null);
	
	return xmlhttp;
}

// ���ܣ����� xmlhttp ����
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

// ���ܣ����ָ��ֵ����������ʾΪ��ɫ�� html ���룻
function red(value){
	return "<font color=\"red\">"+ value +"</font>";
}

// ���ܣ�����ָ��ֵ����������ʾΪ��ɫ�� html ���룻
function green(value){
	return "<font color=\"green\">"+ value +"</font>";
}
-->