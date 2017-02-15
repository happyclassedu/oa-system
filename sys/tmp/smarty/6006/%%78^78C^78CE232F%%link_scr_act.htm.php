<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:08
         compiled from link_scr_act.htm */ ?>

<?php $this->assign('tmp', $this->_tpl_vars['ws']['link']['info']); ?>
<!-- link b -->
<div id="<?php echo $this->_tpl_vars['ws']['act']; ?>
" class="div_976_center">
    <h2><a href="<?php echo $this->_tpl_vars['tmp']['url_act']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></h2>
    <ul>
        <?php $_from = $this->_tpl_vars['ws']['link']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
        <li>
            <a href="<?php echo $this->_tpl_vars['tmp']['url_act']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
" target="_blank">
                <?php if ($this->_tpl_vars['tmp']['img'] == ""): ?>
                <?php echo $this->_tpl_vars['tmp']['name']; ?>

                <?php else: ?>
                <img src="doc::<?php echo $this->_tpl_vars['tmp']['img']; ?>
" />
                <?php endif; ?>
            </a>
        </li>
        <?php endforeach; endif; unset($_from); ?>
    </ul>
</div>
<!-- link e -->