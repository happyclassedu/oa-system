<!-- 
//****�ж��Ƿ���Number.
function fIsNumber (sV,sR){
var sTmp;
if(sV.length==0){ return (false);}
for (var i=0; i < sV.length; i++){
sTmp= sV.substring (i, i+1);
if (sR.indexOf (sTmp, 0)==-1) {return (false);}
}
return (true);
}

function InitAjax(){
var ajax=false; 
try { ajax = new ActiveXObject("Msxml2.XMLHTTP"); } 
catch (e) { try { ajax = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { ajax = false; } }
if (!ajax && typeof XMLHttpRequest!='undefined') { ajax = new XMLHttpRequest(); } 
return ajax;}

function RegAjax(u,s){
	if (s!=""){
		var url = "regcheck.php";
		if(u=="UserName"){
	      var Post = "Action=member&User="+escape(s);
		  }else{
	      var Post = "Action=email&email="+escape(s);
		  }
		if (Post){
		  var ajax = InitAjax();
		  ajax.open("POST", url, true); 
		  ajax.setRequestHeader("CONTENT-TYPE","application/x-www-form-urlencoded; charset=GB2312"); 
		  ajax.send(Post);
		  //��ӡ���
		  ajax.onreadystatechange = function(){
		    if (ajax.readyState == 4){getinfo = ajax.responseText;}else{getinfo = "δ֪����";}
	        if(u=="UserName"){error.innerHTML = getinfo;}else{Email.innerHTML = getinfo;}
		  }
		}
	}
}
function countnum(str){
	UserName.innerHTML = str.length+"���ַ�";
	
	
	}
function rUserName(str){
  if(str =="" || str.length<4 || str.length>20 ) {  
      error.innerHTML = "��Ա�û�������Ӧ����4��20���ַ�֮�䡣";
	return false;  
  }
	if ( fIsNumber(str,"1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ")!=1 ){
    error.innerHTML ="��Ա�û���Ӧ����0-9��a-z��A-Z���ַ����.</span>";
    return false;		
    } 
  error.innerHTML = "�����,���Ե�...";
  RegAjax("UserName",str)
}  
function rEmail(str){
  var filter=/^\s*([A-Za-z0-9_-]+(\.\w+)*@(\w+\.)+\w{2,3})\s*$/;
  if (str =="" || !filter.test(str)) { 
     Email.innerHTML = "��������ȷ�������ַ��</span>";
     return false;
  }
  Email.innerHTML = "�����,���Ե�...";
  RegAjax("Email",str)
}
function replaceInput(obj,event){
	if(event.keyCode!=37 && event.keyCode!=39)
	obj.value=obj.value.replace(/[^\u4E00-\u9FA50-9a-zA-Z_\.]/g,'');
}
function rPassWord(str){
  if( str =="" || str.length<3 || str.length>20) {  
    PassWord.innerHTML = "���볤�ȱ���Ϊ 3-20 �ַ���";
    return false;  
  } 
  if( str == J_RegForm.UserName.value) {  
    PassWord.innerHTML = "���벻�����¼�û�����ͬ��";
    return false;  
  }  
  PassWord.innerHTML = "�������ʹ��";
}
function rPass(str){
  if(str =="") {  
    Pass.innerHTML = "���ظ��������롣";
    return false;  
  }
  if(J_RegForm.PassWord.value != str) {  
    Pass.innerHTML = "������������벻һ�¡�";
    return false;  
  }
  Pass.innerHTML = "ȷ��������ȷ";
}
function ClickSubmit(){
  var Msg = "";
  if (document.regform.UserName.value =="" || document.regform.UserName.value.length<3 || document.regform.UserName.value.length>20){
    error.innerHTML = "��Ա�û�������Ӧ����4��20���ַ�֮�䡣";
    Msg = "Err";
  }
  var filter=/^\s*([A-Za-z0-9_-]+(\.\w+)*@(\w+\.)+\w{2,3})\s*$/;
  if (document.regform.Email.value =="" || !filter.test(document.regform.Email.value)){
    Email.innerHTML = "��������ȷ�������ַ��";
    Msg = "Err";
  }
  if (document.regform.PassWord.value =="" || document.regform.PassWord.value.length<3 || document.regform.PassWord.value.length>20 || document.regform.PassWord.value==document.regform.UserName.value){
    PassWord.innerHTML = "���볤�ȱ���Ϊ 3-20 �ַ��Ҳ��ܺ��û�����ͬ��";
    Msg = "Err";
  }
  if (document.regform.RePassword.value == "" || document.regform.PassWord.value != document.regform.RePassword.value){
    Pass.innerHTML = "���ظ����������Һ͵�¼����һ����";
    Msg = "Err";
  }
  if ( Msg != ""){
	return false;
  }else{
    regform.submit();
  }
}
// -->