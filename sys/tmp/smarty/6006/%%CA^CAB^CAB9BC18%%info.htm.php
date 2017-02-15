<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:09
         compiled from info.htm */ ?>

<!-- info begin-->
<div class="div_976_center">
    <div class="info_box">
        <h2 class="info_box_h2">
            <span>
                当前位置：
                <?php $_from = $this->_tpl_vars['ws']['nav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
                <a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a>&nbsp;&gt;&gt;&nbsp;
                <?php endforeach; else: ?>
                <?php endif; unset($_from); ?>
            </span>
        </h2>
        <h1 class="info_title"><?php echo $this->_tpl_vars['ws']['info']['name']; ?>
</h1>
        <div class="info_attribute">发布时间：<?php echo $this->_tpl_vars['ws']['info']['atime']; ?>
　　信息来源：<?php echo $this->_tpl_vars['ws']['info']['source']; ?>
　　访问次数：<span id="hits"><?php echo $this->_tpl_vars['ws']['info']['hits']; ?>
</span></div>
        <div class="info_content"><?php echo $this->_tpl_vars['ws']['info']['remark']; ?>
</div>
        <div id="xid" style="display: none;"><?php echo $this->_tpl_vars['ws']['info']['id']; ?>
</div>
    </div>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "lefter.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<!-- info begin-->