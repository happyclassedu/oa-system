<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:08
         compiled from menuer_scr.htm */ ?>

<!-- menuer begin-->
<div class="div_976_center">
    <ul id="menuer">
        <?php $_from = $this->_tpl_vars['ws']['menuer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
        <li<?php if ($this->_tpl_vars['tmp']['name'] == "职业技能鉴定"): ?> class="w112"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></li>
        <?php endforeach; endif; unset($_from); ?>
    </ul>
</div>
<!-- menuer end-->