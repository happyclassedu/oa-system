<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:21
         compiled from list_job.htm */ ?>

<!-- list begin-->
<div class="div_976_center">
    <div id="info_box">
        <h2 id="nav_box">
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
        <table id="tb_list_job" width="98%" align="center" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <td>职务名称</td>
                    <td>公司名称</td>
                    <td>工作地址</td>
                    <td>招聘人数</td>
                    <td>待遇</td>
                </tr>
            </thead>
            <tbody>
                <?php $_from = $this->_tpl_vars['ws']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
                <tr>
                    <td><a href="info_job_<?php echo $this->_tpl_vars['tmp']['id']; ?>
.htm" target="_blank"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></td>
                    <td><a href="info_com_<?php echo $this->_tpl_vars['tmp']['cid']; ?>
.htm" target="_blank"><?php echo $this->_tpl_vars['tmp']['cname']; ?>
</a></td>
                    <td><?php echo $this->_tpl_vars['tmp']['addr']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['tmp']['num']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['tmp']['pay']; ?>
</td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
            </tbody>
        </table>
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