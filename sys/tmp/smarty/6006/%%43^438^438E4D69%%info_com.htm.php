<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:17
         compiled from info_com.htm */ ?>

<!-- info begin-->
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
        <h1 class="info_title"><?php echo $this->_tpl_vars['ws']['info']['name']; ?>
</h1>
        <div class="info_attribute">发布时间：<?php echo $this->_tpl_vars['ws']['info']['atime']; ?>
　　访问次数：<span id="hits">1005</span></div>
        <div class="info_content">
            <p>公司规模：<?php echo $this->_tpl_vars['ws']['info']['pnum']; ?>
人</p>
            <p>公司性质：<?php echo $this->_tpl_vars['ws']['info']['pnum']; ?>
</p>
            <p class="com_title">公司简介：</p>
            <p><?php echo $this->_tpl_vars['ws']['info']['intro']; ?>
</p>
            <p class="com_title">公司联系方式：</p>
            <p>联系人：<?php echo $this->_tpl_vars['ws']['info']['linkman']; ?>
 </p>
            <p>联系方式：<span class="tel"><?php echo $this->_tpl_vars['ws']['info']['tel']; ?>
</span></p>
            <p>电子邮箱：<?php echo $this->_tpl_vars['ws']['info']['email']; ?>
</p>
            <p>公司地址：<?php echo $this->_tpl_vars['ws']['info']['address']; ?>
</p>
            <p class="com_title">所有招聘职务：</p>
            <table class="resume" widtd="98%" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr class="res_title">
                    <td>职务名称</td>
                    <td>招聘人数</td>
                    <td>工作地址</td>
                    <td>待遇</td>
                </tr>
                <?php $_from = $this->_tpl_vars['ws']['list_job']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
                <tr>
                    <td><a href="info_job_<?php echo $this->_tpl_vars['tmp']['id']; ?>
.htm" target="_blank"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></td>
                    <td><?php echo $this->_tpl_vars['tmp']['addr']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['tmp']['num']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['tmp']['pay']; ?>
</td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
            </table>
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