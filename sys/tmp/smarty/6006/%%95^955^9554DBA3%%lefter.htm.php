<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:09
         compiled from lefter.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate_i', 'lefter.htm', 14, false),)), $this); ?>

<!-- lefter begin-->
<div class="lefter">
    <div class="lefter_ads"><a href="#"><img src="../img/ads.jpg" /></a></div>
    <div id="lefter_news" class="lefter_tab">
        <h2 id="lefter_news_title">
            <?php $_from = $this->_tpl_vars['ws']['lefter_news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
            <a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a>
            <?php endforeach; endif; unset($_from); ?>
        </h2>
        <?php $_from = $this->_tpl_vars['ws']['lefter_news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['news']):
?>
        <ul class="lefter_list_info">
            <?php $_from = $this->_tpl_vars['news']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
            <li><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
" target="_blank"><?php echo ((is_array($_tmp=$this->_tpl_vars['tmp']['name_s'])) ? $this->_run_mod_handler('truncate_i', true, $_tmp, 19, "…") : smarty_modifier_truncate_i($_tmp, 19, "…")); ?>
</a></li>
            <?php endforeach; else: ?>
            <?php endif; unset($_from); ?>
        </ul>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div class="lefter_top">
        <h2><span><a href="list_26_1.htm">热门企业招聘</a></span></h2>
        <ul class="lefter_list_info">
            <?php $_from = $this->_tpl_vars['ws']['lefter_qyzp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tmp'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tmp']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tmp']):
        $this->_foreach['tmp']['iteration']++;
?>
            <li class="no<?php echo ($this->_foreach['tmp']['iteration']-1)+1; ?>
"><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
" target="_blank"><?php echo ((is_array($_tmp=$this->_tpl_vars['tmp']['name_s'])) ? $this->_run_mod_handler('truncate_i', true, $_tmp, 19, "…") : smarty_modifier_truncate_i($_tmp, 19, "…")); ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>
    <div class="lefter_list">
        <h2><span><a href="list_30_1.htm">表格下载</a></span></h2>
        <ul class="lefter_list_info">
            <?php $_from = $this->_tpl_vars['ws']['lefter_bgxz']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
            <li><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
" target="_blank"><?php echo ((is_array($_tmp=$this->_tpl_vars['tmp']['name_s'])) ? $this->_run_mod_handler('truncate_i', true, $_tmp, 19, "…") : smarty_modifier_truncate_i($_tmp, 19, "…")); ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>
</div>
<!-- lefter end-->