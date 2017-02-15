<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:16
         compiled from list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'list.htm', 16, false),)), $this); ?>

<!-- list begin-->
<div class="div_976_center">
    <div class="list_box">
        <h2 class="list_box_h2">            
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
        <?php $_from = $this->_tpl_vars['ws']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
        <ul>
            <li><span class="info_date">日期：<?php echo ((is_array($_tmp=$this->_tpl_vars['tmp']['atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
 点击：100 </span><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></li>
            <?php if ($this->_tpl_vars['tmp']['intro'] != $this->_tpl_vars['tmp']['name'] && $this->_tpl_vars['tmp']['intro'] != ""): ?>
            <li class="n1"><?php echo $this->_tpl_vars['tmp']['intro']; ?>
</li>
            <?php endif; ?>
        </ul>
        <?php endforeach; endif; unset($_from); ?>
        <div id="page_box">
            <a id="info_num" href="#">共 <?php echo $this->_tpl_vars['ws']['page']['info_num']; ?>
 条</a>
            <a id="page_num" href="#">共 <?php echo $this->_tpl_vars['ws']['page']['page_num']; ?>
 页</a>
            <a id="page_now" href="#">第 <?php echo $this->_tpl_vars['ws']['page']['page_now']; ?>
 页</a>
            <a id="page_first" href="<?php echo $this->_tpl_vars['ws']['page']['first']; ?>
">首页</a>
            <a id="page_prev" href="<?php echo $this->_tpl_vars['ws']['page']['prev']; ?>
">上一页</a>
            <?php $_from = $this->_tpl_vars['ws']['page']['num']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['tmp']):
?>
            <a id="page_<?php echo $this->_tpl_vars['i']; ?>
" href="<?php echo $this->_tpl_vars['tmp']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</a>
            <?php endforeach; endif; unset($_from); ?>
            <a id="page_next" href="<?php echo $this->_tpl_vars['ws']['page']['next']; ?>
">下一页</a>
            <a id="page_last" href="<?php echo $this->_tpl_vars['ws']['page']['last']; ?>
">尾页</a>
        </div>
    </div>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "lefter.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<!-- list begin-->