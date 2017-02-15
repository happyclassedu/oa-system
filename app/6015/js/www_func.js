//ͼƬ����
$.fn.scrol=function(o){
    var defaults={
        prevs:'Previous',
        nexts:'Next',
        sctype:false,
        controls:"none",
        contid:"scro1",
        direct:"top",
        speed:10,
        auto:false,
        pause:0,
        tospeed:0,
        w:0,
        s:0,
        t:0,
        pages:0
    };

    var o=$.extend(defaults,o);
    this.each(function(){
        var obj=$(this);
        var ul=$(".scul",obj);
        var lis=$("li",obj);
        obj.css("overflow","hidden");
        if(o.direct=="left"){
            o.w=(lis.width()*lis.length);
            o.s=obj.width();
            o.t="margin-left";
            ul.css({
                "margin-left":"0",
                "width":o.w*2
            });
        }else{
            o.w=ul.height();
            o.s=obj.height();
            o.t="margin-top";
            ul.css(o.t,"0");
        }
        o.pages=Math.ceil(o.w/o.s);
        if(!o.sctype){
            ul.append(ul.html());
        }
        if(o.controls=="number"){
            var html="<div id='page"+o.contid+"'>";
            for(var i=1;i<=o.pages;i++){
                html=html+"<span";
                if(i==1){
                    html=html+" class='now'";
                }
                html=html+">"+i+"</span> ";
            }
            html=html+"</div>";
            $(obj).after(html);
        }
        if(o.controls=="next"){
            $(obj).before("<span id='prev"+o.contid+"'>"+o.prevs+"</span>");
            $(obj).after("<span id='next"+o.contid+"'>"+o.nexts+"</span>");
        }
        $("span#prev"+o.contid).css("cursor","pointer").click(function(){
            scro("prev",true);
        });
        $("span#next"+o.contid).css("cursor","pointer").click(function(){
            scro("next",true);
        });
        $("#page"+o.contid).find("span").css("cursor","pointer").click(function(){
            scro($(this).html(),true);
        });
        ul.mouseover(function(){
            if(o.pause==0){
                clearInterval(a);
            }
        });
        ul.mouseout(function(){
            if(o.pause==0){
                ascro();
            }
        });
        function scro(dir,clicked){
            if(!dir){
                dir="next";
            }
            if(ul.css(o.t)>=o.w){
                ul.css(o.t)=0;
            }
            o.tospeed=o.speed;
            if(dir=="prev"){
                if(!o.sctype&&parseInt(ul.css(o.t))==0){
                    ul.css(t,"-"+o.w+"px");
                }
                tleft=parseInt(ul.css(o.t))+o.s;
                if(o.sctype&&tleft>0){
                    tleft=0
                };

            }
            if(dir=="next"){
                if(!o.sctype&&parseInt(ul.css(o.t))==-o.w){
                    ul.css(o.t,"0");
                }
                tleft=parseInt(ul.css(o.t))-o.s;
                if(o.sctype&&tleft<=-o.w){
                    tleft=0;
                };

                if(tleft<=-o.w+o.s&&tleft>-o.w){
                    tleft=-o.w+o.s;
                }
            }
            if(parseInt(dir)>0&&parseInt(dir)>0<=o.pages){
                tleft=-((parseInt(dir)-1)*o.s);
            }
            if(o.direct=="left"){
                ul.animate({
                    marginLeft:tleft
                },o.tospeed);
            }else{
                ul.animate({
                    marginTop:tleft
                },o.tospeed);
            }
            if(o.controls=="number"){
                $("#page"+o.contid+" span").removeClass("now");
                $("#page"+o.contid+" span:eq("+(-Math.ceil(tleft/o.s))+")").addClass("now");
            }
            if(tleft==0&&o.controls=="next"){
                $("span#prev"+o.contid+" *").hide()
            }else{
                $("span#prev"+o.contid+" *").show();
            }
            if(tleft==o.s-o.w&&o.controls=="next"){
                $("span#next"+o.contid+" *").hide()
            }else{
                $("span#next"+o.contid+" *").show();
            }
            if(clicked)clearTimeout(timeout);
            if(o.auto&&!clicked){
                timeout=setTimeout(function(){
                    scro("next",false);
                },o.tospeed+o.pause);
            };

        }
        function ascro(){
            a=setInterval(function(){
                if(parseInt(ul.css(o.t))<=-o.w){
                    ul.css(o.t,"0");
                }
                ul.css(o.t,parseInt(ul.css(o.t))-1+"px");
            },o.speed);
        }
        var timeout;
        if(o.auto){
            if(o.pause==0){
                timeout=setTimeout(function(){
                    var a;
                    ascro();
                });
            }else{
                timeout=setTimeout(function(){
                    scro("next",false);
                },o.pause);
            }
        }
        scro("next",false);
    });
};