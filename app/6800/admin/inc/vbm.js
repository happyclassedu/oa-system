function winshow(pagename,w,h){
  window.open(pagename,null,"width="+w+",height="+h);
}

function checkbox(obj,num){
  var id;
  for (i=1;i<=num;i++){
	id=obj+i;
	if(document.getElementById(id).checked==""){
	  document.getElementById(id).checked="checked";
	}
	else{
	  document.getElementById(id).checked="";
	}
  }
}

function win(){

   window.opener.document.all.imgs.innerText=document.getElementById("imgs").value;
   //window.opener.document.all.bb.innerText=document.getElementById("sex").value;
   window.close();
}

function noneblock(targetid){

	var input = document.getElementsByTagName("div"); //

	for(var i=0;i<input.length;i++)
	{
		  if(input.item(i).id.indexOf("h") >= 0 )//
		   {
				document.getElementById(input.item(i).id).style.display = "none";//
		   }
	}

    var target=document.getElementById(targetid);

	if (target.style.display=="none"){
		target.style.display="block";
	} else{
		target.style.display="none";
	}
}

function blocknone(targetid){
	var input = document.getElementsByTagName("tr"); //获取页面所有input

	for(var i=0;i<input.length;i++)
	{
		  if(input.item(i).id.indexOf("pm_") >= 0 )//判断input的id中是否包含h字符串
		   {
				document.getElementById(input.item(i).id).style.display = "none";//隐藏控件
		   }
	}

	var ifview = document.getElementById(targetid);
	ifview.style.display = ifview.style.display == 'none' ? 'block' : 'none';
}

function $Obj(objname){
	return document.getElementById(objname);
}

function ShowUrlTr(){
	var jumpTest = $Obj('isjump');
	var jtr = $Obj('redirecturltr');
	var tbody = $Obj('detail');
	if(jumpTest.checked){
		jtr.style.display = "block";
		detail.style.display = "none";
	} else {
		jtr.style.display = "none";
		detail.style.display = "block";
	}
}

function HidUrlTr(){
	var jumpTest = $Obj('isjump');
	var jtr = $Obj('redirecturltr');
	var tbody = $Obj('detail');
	jtr.style.display = "block";
	detail.style.display = "none";

}

function SeePic(img,f){
   if ( f.value != "" ) { img.src = f.value; }
}