<?php /* Smarty version 2.6.25, created on 2013-11-22 20:00:19
         compiled from info_job.htm */ ?>

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
            <table class="per_top" cellspacing="0" cellpadding="0">
                <tr>
                    <td>招聘人数：</td>
                    <td><?php echo $this->_tpl_vars['ws']['info']['num']; ?>
人</td>
                    <td>学历要求：</td>
                    <td><?php echo $this->_tpl_vars['ws']['info']['major']; ?>
</td>
                    <td>工作经验：</td>
                    <td><?php echo $this->_tpl_vars['ws']['info']['history']; ?>
</td>
                </tr>
                <tr>
                    <td>薪资范围：</td>
                    <td><?php echo $this->_tpl_vars['ws']['info']['pay']; ?>
元/月</td>
                    <td>工作区域：</td>
                    <td><?php echo $this->_tpl_vars['ws']['info']['addr']; ?>
</td>
                    <td>联 系 人：</td>
                    <td><?php echo $this->_tpl_vars['ws']['info']['linkman']; ?>
</td>
                </tr>
                <tr>
                    <td>联系电话：</td>
                    <td colspan="5"><?php echo $this->_tpl_vars['ws']['info']['tel']; ?>
</td>
                </tr>
            </table>
            <p class="com_title">职位描述：</p>
            <p><?php echo $this->_tpl_vars['ws']['info']['intro']; ?>
</p>
            <p class="com_title">公司介绍：<?php echo $this->_tpl_vars['ws']['com']['name']; ?>
</p>
            <div>
                <p><?php echo $this->_tpl_vars['ws']['com']['intro']; ?>
</p>
                <p>地址：<?php echo $this->_tpl_vars['ws']['com']['addr']; ?>
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
            <p>&nbsp;</p>
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