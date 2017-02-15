<!-- 
//****判断是否是Number.
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
		  //打印结果
		  ajax.onreadystatechange = function(){
		    if (ajax.readyState == 4){getinfo = ajax.responseText;}else{getinfo = "未知错误";}
	        if(u=="UserName"){error.innerHTML = getinfo;}else{Email.innerHTML = getinfo;}
		  }
		}
	}
}
function countnum(str){
	UserName.innerHTML = str.length+"个字符";
	
	
	}
function rUserName(str){
  if(str =="" || str.length<4 || str.length>20 ) {  
      error.innerHTML = "会员用户名长度应该在4－20个字符之间。";
	return false;  
  }
	if ( fIsNumber(str,"1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ")!=1 ){
    error.innerHTML ="会员用户名应该是0-9、a-z、A-Z等字符组成.</span>";
    return false;		
    } 
  error.innerHTML = "检测中,请稍等...";
  RegAjax("UserName",str)
}  
function rEmail(str){
  var filter=/^\s*([A-Za-z0-9_-]+(\.\w+)*@(\w+\.)+\w{2,3})\s*$/;
  if (str =="" || !filter.test(str)) { 
     Email.innerHTML = "请输入正确的邮箱地址。</span>";
     return false;
  }
  Email.innerHTML = "检测中,请稍等...";
  RegAjax("Email",str)
}
function replaceInput(obj,event){
	if(event.keyCode!=37 && event.keyCode!=39)
	obj.value=obj.value.replace(/[^\u4E00-\u9FA50-9a-zA-Z_\.]/g,'');
}
function rPassWord(str){
  if( str =="" || str.length<3 || str.length>20) {  
    PassWord.innerHTML = "密码长度必须为 3-20 字符。";
    return false;  
  } 
  if( str == J_RegForm.UserName.value) {  
    PassWord.innerHTML = "密码不能与登录用户名相同。";
    return false;  
  }  
  PassWord.innerHTML = "密码可以使用";
}
function rPass(str){
  if(str =="") {  
    Pass.innerHTML = "请重复输入密码。";
    return false;  
  }
  if(J_RegForm.PassWord.value != str) {  
    Pass.innerHTML = "两次输入的密码不一致。";
    return false;  
  }
  Pass.innerHTML = "确认密码正确";
}
function ClickSubmit(){
  var Msg = "";
  if (document.regform.UserName.value =="" || document.regform.UserName.value.length<3 || document.regform.UserName.value.length>20){
    error.innerHTML = "会员用户名长度应该在4－20个字符之间。";
    Msg = "Err";
  }
  var filter=/^\s*([A-Za-z0-9_-]+(\.\w+)*@(\w+\.)+\w{2,3})\s*$/;
  if (document.regform.Email.value =="" || !filter.test(document.regform.Email.value)){
    Email.innerHTML = "请输入正确的邮箱地址。";
    Msg = "Err";
  }
  if (document.regform.PassWord.value =="" || document.regform.PassWord.value.length<3 || document.regform.PassWord.value.length>20 || document.regform.PassWord.value==document.regform.UserName.value){
    PassWord.innerHTML = "密码长度必须为 3-20 字符且不能和用户名相同。";
    Msg = "Err";
  }
  if (document.regform.RePassword.value == "" || document.regform.PassWord.value != document.regform.RePassword.value){
    Pass.innerHTML = "请重复输入密码且和登录密码一样。";
    Msg = "Err";
  }
  if ( Msg != ""){
	return false;
  }else{
    regform.submit();
  }
}
// -->