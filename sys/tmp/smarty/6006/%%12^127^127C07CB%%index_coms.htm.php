<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:09
         compiled from index_coms.htm */ ?>
<!-- qyzp begin-->
<div class="div_976_center qyzp">
    <h2><span><a href="list_26_1.htm">企业招聘</a></span></h2>
    <ul>
        <?php $_from = $this->_tpl_vars['ws']['link_coms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
        <li><img src="../img/new.gif" /><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
" target="_blank"><?php echo $this->_tpl_vars['tmp']['name_s']; ?>
</a></li>
        <?php endforeach; endif; unset($_from); ?>
    </ul>
</div>
<!-- qyzp end-->