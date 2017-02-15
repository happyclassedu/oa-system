<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:08
         compiled from footer_scr_act.htm */ ?>

<!-- footer begin-->
<div id="footer" class="div_976_center">
    <p id="footer_line"></p>
    <p id="footer_menu">
        <?php $_from = $this->_tpl_vars['ws']['footer_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
        | <a href="<?php echo $this->_tpl_vars['tmp']['url_act']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a>
        <?php endforeach; endif; unset($_from); ?>
        |
    </p>
    <p>中心地址：西安市雁展路一号曲江国际会展中心（2A） 联系电话：029-83155622　029-62887575　029-83155630　029-83155631</p>
    <p>客服QQ：1622838255　　　　E-mail:qjrc999@163.com　　　　Copyright(c)2007-2011 www.xaqjrc.com</p>
    <p>版权所有：西安曲江新区人才交流中心　　备案号：<a href="http://www.miibeian.gov.cn/state/outPortal/loginPortal.action;jsessionid=JyNZN3SGV3JQ5qzbpjmQwvGNz6FmHhprXsGgXcv1FHHGycB1lTtL!-1116172877">陕ICP备11002859号</a>　　技术支持：<a href="http://www.erlitech.com/www/">而立科技</a></p>
    <p><img alt="" src="../img/jingcha.gif" /></p>
</div>
<!-- footer end-->