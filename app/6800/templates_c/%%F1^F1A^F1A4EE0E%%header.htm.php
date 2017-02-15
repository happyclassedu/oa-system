<?php
/*
This is not a freeware, use is subject to license terms
版权所有：而立科技 

官方网站：http://www.erlitech.com

咨询QQ：88888888

程序开发：而立科技
*/
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE><?php echo $this->_tpl_vars['seo']['title']; ?>
</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<META content="<?php echo $this->_tpl_vars['seo']['description']; ?>
" name=description>
<META content="<?php echo $this->_tpl_vars['seo']['keywords']; ?>
" name=keywords>
<META content="三秦品牌网   http://www.3qpinpai.com" name=copyright>
<meta name="alexaVerifyID" content="2VeuizpKEgrClNJDf7--0GUvh6E" />
<LINK href="templates/images/search-dq.css" type=text/css rel=stylesheet>
<LINK href="templates/images/ymPrompt.css" type=text/css rel=stylesheet>
<LINK href="templates/images/zjym.css" type=text/css rel=stylesheet>
<LINK href="templates/images/location.css" type=text/css rel=stylesheet>

</HEAD>
<BODY>
<DIV class=mainbox>
<H1><A title=三秦品牌网 href="<?php echo $this->_tpl_vars['xm_global']['cfg_basehost']; ?>
"><IMG src="templates/images/logo.gif"></A></H1>
<DIV style="FLOAT: right; WIDTH: 700px">
<DIV class=menu-top>
<div style="float:right; text-align:right; width:625px; margin:0px; padding:0px;">
				<?php if ($this->_tpl_vars['userinfo'] != ""): ?>
				欢迎您回来！<strong><a href="<?php echo $this->_tpl_vars['xm_global']['cfg_basehost']; ?>
/user_center.php" class="lj1" style="color:#FF0000"><?php echo $this->_tpl_vars['userinfo']['userid']; ?>
</a></strong>&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['xm_global']['cfg_basehost']; ?>
/user_center.php?action=logout" class="lj1">退出</a>&nbsp;&nbsp;<?php else: ?><a href="login.php" class="lj1">登录</a>&nbsp;&nbsp;<?php endif; ?><a href="#" onClick="javascript:window.external.AddFavorite('http://www.3qpinpai.com','三秦品牌网——陕西第一品牌网');" class="lj1">收藏</a>&nbsp;&nbsp;<a href="#" class="lj1">帮助</a>
				</div>
</DIV>
<DIV class=menu>
<UL>
  <LI><A class=tab href="/">首页</A> </LI>
  <LI><A class=tab href="#">品牌资讯</A> </LI>
  <LI><A class=tab href="#">知名品牌</A> </LI>
  <LI><A class=tab href="#">品牌之星</A> </LI>
  <LI><A class=tab href="#">推荐品牌</A> </LI>
  <LI><A class=tab href="#">代理加盟</A>
</LI></UL></DIV></DIV></DIV>
<DIV class=mainbox>
<DIV class=search>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD>
      <FORM name=search_company action="search.php" method=get>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD width="10%" height=48><IMG height=42
            src="templates/images/search-title.jpg" width=72></TD>
          <TD width="48%"><INPUT id=keywords
            style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; WIDTH: 400px; LINE-HEIGHT: 22px; PADDING-TOP: 0px; HEIGHT: 22px" value="<?php echo $this->_tpl_vars['keywords']; ?>
"
            name=keywords></TD>
          <TD width="13%">
		  <select name="k_city">
		  <option value="0">请选择城市</option>
		  <?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['select']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['s']['show'] = true;
$this->_sections['s']['max'] = $this->_sections['s']['loop'];
$this->_sections['s']['step'] = 1;
$this->_sections['s']['start'] = $this->_sections['s']['step'] > 0 ? 0 : $this->_sections['s']['loop']-1;
if ($this->_sections['s']['show']) {
    $this->_sections['s']['total'] = $this->_sections['s']['loop'];
    if ($this->_sections['s']['total'] == 0)
        $this->_sections['s']['show'] = false;
} else
    $this->_sections['s']['total'] = 0;
if ($this->_sections['s']['show']):

            for ($this->_sections['s']['index'] = $this->_sections['s']['start'], $this->_sections['s']['iteration'] = 1;
                 $this->_sections['s']['iteration'] <= $this->_sections['s']['total'];
                 $this->_sections['s']['index'] += $this->_sections['s']['step'], $this->_sections['s']['iteration']++):
$this->_sections['s']['rownum'] = $this->_sections['s']['iteration'];
$this->_sections['s']['index_prev'] = $this->_sections['s']['index'] - $this->_sections['s']['step'];
$this->_sections['s']['index_next'] = $this->_sections['s']['index'] + $this->_sections['s']['step'];
$this->_sections['s']['first']      = ($this->_sections['s']['iteration'] == 1);
$this->_sections['s']['last']       = ($this->_sections['s']['iteration'] == $this->_sections['s']['total']);
?><option value="<?php echo $this->_tpl_vars['select'][$this->_sections['s']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['select'][$this->_sections['s']['index']]['name']; ?>
</option><?php endfor; endif; ?>
		  </select>



		  </TD>
          <TD width="13%"><INPUT type=image height=28 width=80
            src="templates/images/search-an.jpg" border=0></TD>
          <TD width="16%"></TD></TR></TBODY></TABLE></FORM></TD></TR>
  </TBODY></TABLE>
</DIV>
</DIV>