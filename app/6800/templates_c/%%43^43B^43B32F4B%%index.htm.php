<?php
/*
This is not a freeware, use is subject to license terms
��Ȩ���У������Ƽ� 

�ٷ���վ��http://www.erlitech.com

��ѯQQ��88888888

���򿪷��������Ƽ�
*/
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<DIV class=mainbox-a><!--������ݿ�ʼ-->
    <DIV class=leftbox><!--��ҵ��վ��ʼ-->
        <DIV class="newjoin">
            <DIV class="jointitle">
                <H2>֪��Ʒ��</H2>
            </DIV>
            <DIV class="joinnr">
                <DIV class="newlist">
	<?php unset($this->_sections['new']);
$this->_sections['new']['name'] = 'new';
$this->_sections['new']['loop'] = is_array($_loop=$this->_tpl_vars['newjoin']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['new']['show'] = true;
$this->_sections['new']['max'] = $this->_sections['new']['loop'];
$this->_sections['new']['step'] = 1;
$this->_sections['new']['start'] = $this->_sections['new']['step'] > 0 ? 0 : $this->_sections['new']['loop']-1;
if ($this->_sections['new']['show']) {
    $this->_sections['new']['total'] = $this->_sections['new']['loop'];
    if ($this->_sections['new']['total'] == 0)
        $this->_sections['new']['show'] = false;
} else
    $this->_sections['new']['total'] = 0;
if ($this->_sections['new']['show']):

            for ($this->_sections['new']['index'] = $this->_sections['new']['start'], $this->_sections['new']['iteration'] = 1;
                 $this->_sections['new']['iteration'] <= $this->_sections['new']['total'];
                 $this->_sections['new']['index'] += $this->_sections['new']['step'], $this->_sections['new']['iteration']++):
$this->_sections['new']['rownum'] = $this->_sections['new']['iteration'];
$this->_sections['new']['index_prev'] = $this->_sections['new']['index'] - $this->_sections['new']['step'];
$this->_sections['new']['index_next'] = $this->_sections['new']['index'] + $this->_sections['new']['step'];
$this->_sections['new']['first']      = ($this->_sections['new']['iteration'] == 1);
$this->_sections['new']['last']       = ($this->_sections['new']['iteration'] == $this->_sections['new']['total']);
?>
                    <SPAN><a href="info.php?id=<?php echo $this->_tpl_vars['newjoin'][$this->_sections['new']['index']]['id']; ?>
" target=_blank title="<?php echo $this->_tpl_vars['newjoin'][$this->_sections['new']['index']]['cname']; ?>
"><?php echo $this->_tpl_vars['newjoin'][$this->_sections['new']['index']]['cname']; ?>
</A></SPAN>
	<?php endfor; endif; ?>
                    <div  style="clear:both"></div>
                </DIV>
            </DIV>
        </DIV>
        <DIV class="newjoin" style="margin-top:8px;">
            <DIV class="jointitle">
                <H2>Ʒ��֮��</H2>
            </DIV>
            <DIV class="joinnr">
                <DIV class="newlist">
	<?php unset($this->_sections['new']);
$this->_sections['new']['name'] = 'new';
$this->_sections['new']['loop'] = is_array($_loop=$this->_tpl_vars['newupdate']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['new']['show'] = true;
$this->_sections['new']['max'] = $this->_sections['new']['loop'];
$this->_sections['new']['step'] = 1;
$this->_sections['new']['start'] = $this->_sections['new']['step'] > 0 ? 0 : $this->_sections['new']['loop']-1;
if ($this->_sections['new']['show']) {
    $this->_sections['new']['total'] = $this->_sections['new']['loop'];
    if ($this->_sections['new']['total'] == 0)
        $this->_sections['new']['show'] = false;
} else
    $this->_sections['new']['total'] = 0;
if ($this->_sections['new']['show']):

            for ($this->_sections['new']['index'] = $this->_sections['new']['start'], $this->_sections['new']['iteration'] = 1;
                 $this->_sections['new']['iteration'] <= $this->_sections['new']['total'];
                 $this->_sections['new']['index'] += $this->_sections['new']['step'], $this->_sections['new']['iteration']++):
$this->_sections['new']['rownum'] = $this->_sections['new']['iteration'];
$this->_sections['new']['index_prev'] = $this->_sections['new']['index'] - $this->_sections['new']['step'];
$this->_sections['new']['index_next'] = $this->_sections['new']['index'] + $this->_sections['new']['step'];
$this->_sections['new']['first']      = ($this->_sections['new']['iteration'] == 1);
$this->_sections['new']['last']       = ($this->_sections['new']['iteration'] == $this->_sections['new']['total']);
?>
                    <SPAN><a href="info.php?id=<?php echo $this->_tpl_vars['newupdate'][$this->_sections['new']['index']]['id']; ?>
" target=_blank title="<?php echo $this->_tpl_vars['newupdate'][$this->_sections['new']['index']]['cname']; ?>
"><?php echo $this->_tpl_vars['newupdate'][$this->_sections['new']['index']]['cname']; ?>
</A></SPAN>
	<?php endfor; endif; ?>
                    <div  style="clear:both"></div>
                </DIV>
            </DIV>
        </DIV>
        <DIV class=leftboxin>
            <!--��ҵ��վ����--><!--���ŷ���������ʼ-->
            <!--���ŷ�����������-->
            <DIV class=hyfz>
                <DIV class=fz>
                    <span style="width:125px; text-align:center"><a rel="nofollow" href="#" target=_blank><img class=adsIMG alt="" width="145" border="0" src="./img/1.jpg"></a></span>
                    <span style="width:125px; text-align:center"><a rel="nofollow" href="#" target=_blank><img class=adsIMG alt="" width="145" border="0" src="./img/2.jpg"></a></span>
                    <span style="width:125px; text-align:center"><a rel="nofollow" href="#" target=_blank><img class=adsIMG alt="" width="145" border="0" src="./img/3.jpg"></a></span>
                    <span style="width:125px; text-align:center"><a rel="nofollow" href="#" target=_blank><img class=adsIMG alt="" width="145" border="0" src="./img/5.gif"></a></span>
                    <span style="width:125px; text-align:center"><a rel="nofollow" href="#" target=_blank><img class=adsIMG alt="" width="145" border="0" src="./img/7.gif"></a></span>
                    <!--                    <?php unset($this->_sections['ad']);
$this->_sections['ad']['name'] = 'ad';
$this->_sections['ad']['loop'] = is_array($_loop=$this->_tpl_vars['index_ad']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ad']['show'] = true;
$this->_sections['ad']['max'] = $this->_sections['ad']['loop'];
$this->_sections['ad']['step'] = 1;
$this->_sections['ad']['start'] = $this->_sections['ad']['step'] > 0 ? 0 : $this->_sections['ad']['loop']-1;
if ($this->_sections['ad']['show']) {
    $this->_sections['ad']['total'] = $this->_sections['ad']['loop'];
    if ($this->_sections['ad']['total'] == 0)
        $this->_sections['ad']['show'] = false;
} else
    $this->_sections['ad']['total'] = 0;
if ($this->_sections['ad']['show']):

            for ($this->_sections['ad']['index'] = $this->_sections['ad']['start'], $this->_sections['ad']['iteration'] = 1;
                 $this->_sections['ad']['iteration'] <= $this->_sections['ad']['total'];
                 $this->_sections['ad']['index'] += $this->_sections['ad']['step'], $this->_sections['ad']['iteration']++):
$this->_sections['ad']['rownum'] = $this->_sections['ad']['iteration'];
$this->_sections['ad']['index_prev'] = $this->_sections['ad']['index'] - $this->_sections['ad']['step'];
$this->_sections['ad']['index_next'] = $this->_sections['ad']['index'] + $this->_sections['ad']['step'];
$this->_sections['ad']['first']      = ($this->_sections['ad']['iteration'] == 1);
$this->_sections['ad']['last']       = ($this->_sections['ad']['iteration'] == $this->_sections['ad']['total']);
?>
                                        <span style="width:125px; text-align:center"><a rel="nofollow" href="<?php echo $this->_tpl_vars['index_ad'][$this->_sections['ad']['index']]['targeturl']; ?>
" target=_blank><img class=adsIMG src="<?php echo $this->_tpl_vars['xm_global']['cfg_basehost']; ?>
<?php echo $this->_tpl_vars['index_ad'][$this->_sections['ad']['index']]['picdir']; ?>
" width="145" border="0"></A></span>
                                        <?php endfor; endif; ?>-->
                </DIV></DIV>
            <!--�б�ʼ-->
            <div style="padding-left:20px;" align='left' id=ad_1></div>

        </DIV>
    </DIV>
    <!--�б����-->
    <!--������ݽ���-->
    <!--�ұ����ݿ�ʼ-->
    <DIV class=rightbox>
        <DIV class=qyfwdh>
            <?php if ($this->_tpl_vars['userinfo'] == ""): ?>
            <form id="loginform" name="loginform" action="<?php echo $this->_tpl_vars['xm_global']['cfg_basehost']; ?>
/login.php" method="post" >
                <input type="hidden" name="sURL" value="member">
                <DIV class=title>
                    <H2>��Ա��¼</H2></DIV>
                <DIV class=con-bg>
                    �û�����<input   type="text" name="username" style="width:100px;height:18px;vertical-align:middle"/><br />
                    ��&nbsp;&nbsp;�룺<input   type="password" name="password"  style="width:100px;height:18px; vertical-align:middle"/><br /><hr/>
                    <input type="submit" value="��¼" style="vertical-align:middle" />&nbsp;&nbsp;<input type="button" onClick="location.href='register.php'" value="ע��" style="vertical-align:middle"/> &nbsp;&nbsp;<a href="#">��������</a>
                    <input type="hidden" name="operation" id="operation" value="sysLoginMember">
                    </form>
                </DIV>
                <?php else: ?>

                <DIV class=title>
                    <H2>��Ա��Ϣ</H2></DIV>
                <DIV class=con-bg>

                </DIV>


                <?php endif; ?>
                <DIV class=bottom-fw></DIV></DIV>
        <DIV class=dqzthy>
            <DIV class=title>
                <H2>�Ƽ�Ʒ��</H2>
            </DIV>
            <DIV class=con-bg style="text-align:center">
	<?php unset($this->_sections['new']);
$this->_sections['new']['name'] = 'new';
$this->_sections['new']['loop'] = is_array($_loop=$this->_tpl_vars['newupdate']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['new']['show'] = true;
$this->_sections['new']['max'] = $this->_sections['new']['loop'];
$this->_sections['new']['step'] = 1;
$this->_sections['new']['start'] = $this->_sections['new']['step'] > 0 ? 0 : $this->_sections['new']['loop']-1;
if ($this->_sections['new']['show']) {
    $this->_sections['new']['total'] = $this->_sections['new']['loop'];
    if ($this->_sections['new']['total'] == 0)
        $this->_sections['new']['show'] = false;
} else
    $this->_sections['new']['total'] = 0;
if ($this->_sections['new']['show']):

            for ($this->_sections['new']['index'] = $this->_sections['new']['start'], $this->_sections['new']['iteration'] = 1;
                 $this->_sections['new']['iteration'] <= $this->_sections['new']['total'];
                 $this->_sections['new']['index'] += $this->_sections['new']['step'], $this->_sections['new']['iteration']++):
$this->_sections['new']['rownum'] = $this->_sections['new']['iteration'];
$this->_sections['new']['index_prev'] = $this->_sections['new']['index'] - $this->_sections['new']['step'];
$this->_sections['new']['index_next'] = $this->_sections['new']['index'] + $this->_sections['new']['step'];
$this->_sections['new']['first']      = ($this->_sections['new']['iteration'] == 1);
$this->_sections['new']['last']       = ($this->_sections['new']['iteration'] == $this->_sections['new']['total']);
?>
                <SPAN><a href="info.php?id=<?php echo $this->_tpl_vars['newupdate'][$this->_sections['new']['index']]['id']; ?>
" target=_blank title="<?php echo $this->_tpl_vars['newupdate'][$this->_sections['new']['index']]['cname']; ?>
"><?php echo $this->_tpl_vars['newupdate'][$this->_sections['new']['index']]['cname']; ?>
</a></SPAN>
	<?php endfor; endif; ?>
            </DIV>
            <DIV class=bottom-fw></DIV>
        </DIV></DIV><!--�ұ����ݽ���--><div style="clear:both"></div></DIV><!--�������-->
<DIV class=yqlj>
    <DIV class=title-yq></DIV>
    <DIV class=title-wz><?php echo $this->_tpl_vars['link']; ?>
</DIV>
</DIV>
<!--��������ʼ-->
<!--<DIV class=containe>

</DIV>-->
<!--����������--><!--���ļ�-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "foot.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>