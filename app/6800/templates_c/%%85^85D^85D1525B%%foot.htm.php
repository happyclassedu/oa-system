<?php
/*
This is not a freeware, use is subject to license terms
版权所有：而立科技 

官方网站：http://www.erlitech.com

咨询QQ：88888888

程序开发：而立科技
*/
?><DIV class=foot>
<?php unset($this->_sections['foot']);
$this->_sections['foot']['name'] = 'foot';
$this->_sections['foot']['loop'] = is_array($_loop=$this->_tpl_vars['select']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foot']['show'] = true;
$this->_sections['foot']['max'] = $this->_sections['foot']['loop'];
$this->_sections['foot']['step'] = 1;
$this->_sections['foot']['start'] = $this->_sections['foot']['step'] > 0 ? 0 : $this->_sections['foot']['loop']-1;
if ($this->_sections['foot']['show']) {
    $this->_sections['foot']['total'] = $this->_sections['foot']['loop'];
    if ($this->_sections['foot']['total'] == 0)
        $this->_sections['foot']['show'] = false;
} else
    $this->_sections['foot']['total'] = 0;
if ($this->_sections['foot']['show']):

            for ($this->_sections['foot']['index'] = $this->_sections['foot']['start'], $this->_sections['foot']['iteration'] = 1;
                 $this->_sections['foot']['iteration'] <= $this->_sections['foot']['total'];
                 $this->_sections['foot']['index'] += $this->_sections['foot']['step'], $this->_sections['foot']['iteration']++):
$this->_sections['foot']['rownum'] = $this->_sections['foot']['iteration'];
$this->_sections['foot']['index_prev'] = $this->_sections['foot']['index'] - $this->_sections['foot']['step'];
$this->_sections['foot']['index_next'] = $this->_sections['foot']['index'] + $this->_sections['foot']['step'];
$this->_sections['foot']['first']      = ($this->_sections['foot']['iteration'] == 1);
$this->_sections['foot']['last']       = ($this->_sections['foot']['iteration'] == $this->_sections['foot']['total']);
?>
<A class=baicu href="list.php?city=<?php echo $this->_tpl_vars['select'][$this->_sections['foot']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['select'][$this->_sections['foot']['index']]['name']; ?>
黄页</A>&nbsp;&nbsp;&nbsp;&nbsp;
<?php endfor; endif; ?>
</DIV>
<DIV></DIV>
<DIV class=containe style="COLOR: #bc3204"><?php echo $this->_tpl_vars['xm_global']['cfg_power']; ?>
<BR><A rel="nofollow" href="http://www.miibeian.gov.cn" 
target=_blank><?php echo $this->_tpl_vars['xm_global']['cfg_beian']; ?>
</A></DIV>
</BODY></HTML>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v2.jiathis.com/code/jiathis_r.js?move=0&btn=r5.gif" charset="utf-8"></script>
<!-- JiaThis Button END -->