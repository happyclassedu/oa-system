<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:18
         compiled from qa.htm */ ?>
<div class="msg">
    <h1>留言详细信息</h1>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="msg_title" colspan="2" align="center">标题：<?php echo $this->_tpl_vars['ws']['qa']['name']; ?>
</td>
      </tr>
      <tr>
        <td width="50%">留言时间：<?php echo $this->_tpl_vars['ws']['qa']['atime']; ?>
</td>
        <td width="50%">留言状态：<?php if ('2' == $this->_tpl_vars['ws']['qa']['drwx']): ?>已处理<?php elseif ('3' == $this->_tpl_vars['ws']['qa']['drwx']): ?>已隐藏<?php else: ?>未处理<?php endif; ?></td>
      </tr>
      <tr>
        <td>留 言 者 ：<?php echo $this->_tpl_vars['ws']['qa']['q_name']; ?>
</td>
        <td>回复部门：<?php echo $this->_tpl_vars['ws']['qa']['org']; ?>
</td>
      </tr>
      <tr>
        <td>留言内容：</td>
        <td>回复内容：</td>
      </tr>
      <tr>
        <td>
            <?php echo $this->_tpl_vars['ws']['qa']['q_intro']; ?>

        </td>
        <td class="msg_sr">
            <?php echo $this->_tpl_vars['ws']['qa']['a_intro']; ?>

        </td>
      </tr>
    </table>
</div>