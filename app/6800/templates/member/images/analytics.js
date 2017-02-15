// cnzz.com
document.write("<div style=\"display:none;\">");
document.write("<script type=\"text\/javascript\" charset=\"gb2312\"");
document.write(" src=\"http://s11.cnzz.com/stat.php?id=1136418&web_id=1136418\">");
document.write("<\/script>");
document.write("<\/div>");

// google.com/analytics
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript' %3E%3C/script%3E"));

function initAnalytics(){
	var pageTracker = _gat._getTracker("UA-2287133-4");
	
	pageTracker._addOrganic("pala.cn", "wd");
	pageTracker._addOrganic("youdao.com", "q");
	pageTracker._addOrganic("soso.com", "w");
	pageTracker._addOrganic("sogou.com", "query");
	pageTracker._addOrganic("zhongsou.com", "word");
	pageTracker._addOrganic("114.com.cn", "keywords");
	pageTracker._addOrganic("cnnic.cn", "name");
	pageTracker._addOrganic("google.cn", "q");
	
	pageTracker._addOrganic("3721.com", "p");
	pageTracker._addOrganic("yahoo.cn", "p");
	pageTracker._addOrganic("cn.yahoo.com", "p");
	
	pageTracker._addOrganic("image.baidu.com", "word");
	pageTracker._addOrganic("baike.baidu.com", "word");
	pageTracker._addOrganic("zhidao.baidu.com", "word");
	
	var domainName = location.host;
	if(domainName!=undefined && domainName.indexOf(".")>0){
		pageTracker._setDomainName(domainName);
	}
	pageTracker._initData();
	pageTracker._trackPageview();
}