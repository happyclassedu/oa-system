<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:18
         compiled from list_qa.htm */ ?>

<div class="msg">
    <h1>留言回复</h1>
    <p><input id="btn_qa" type="button" value="我要留言" />
    </p>
    <div class="msg_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="msg_title">
                <td>留言标题</td>
                <td>留言者</td>
                <td>留言时间</td>
                <td>状态</td>
            </tr>
            <?php $_from = $this->_tpl_vars['ws']['qa']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
            <tr>
                <td><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['tmp']['q_name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['tmp']['atime']; ?>
</td>
                <td><?php if ('2' == $this->_tpl_vars['tmp']['drwx']): ?>已处理<?php elseif ('3' == $this->_tpl_vars['tmp']['drwx']): ?>已隐藏<?php else: ?>未处理<?php endif; ?></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </div>
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