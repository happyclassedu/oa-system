<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Untitled Document</title>
</head>


<script language="javascript">
function ajax_init()
{           
    var ajax=false;
    try {       
        ajax = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            ajax = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            ajax = false;
        }
    }       
    if (!ajax && typeof XMLHttpRequest!='undefined') {
        ajax = new XMLHttpRequest();
    }
    return ajax;
}
	
function saveUserInfo(){
    var dta = document.getElementById("user_name").value; 
    var dtb = document.getElementById("user_age").value;
    var dtc = document.getElementById("user_sex").value; 
    // 要post的数据
    var postStr = "user_name="+dta;
    postStr += "&user_age="+dtb;
    postStr += "&user_sex="+dtc;
    var url = "ajax_output.php";
    var msg = document.getElementById("msg"); 
    var ajax = ajax_init();
    ajax.open("POST", url, true);
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.onreadystatechange = function() { 
        if (ajax.readyState == 4 && ajax.status == 200) { 
//             show.style.src = ajax.responseText; 
            var str1= ajax.responseText;
//            if (str1 == "1")
//            {
//            	alert ("成功了");
//            	}
//            	else
//            		{
//            			alert ("失败");
//            			}
            msg.innerHTML = str1; 
            
        }
    }
    ajax.send(postStr); 
    
//    alert (postStr); 
}
</script>
<body >
<form name="form1" method="post" action="">
姓名：<input type="text" name="user_name" id="user_name"/><br />
年龄：<input type="text" name="user_age"  id="user_age"/><br />
性别：<input type="text" name="user_sex"  id="user_age"/><br />


</form>
<input type="button" value="提交表单" onClick="saveUserInfo()">
<div name=msg id=msg style="height:40px;width:40px;background-color:#4e6a80;">  </div>
</body>
</html>