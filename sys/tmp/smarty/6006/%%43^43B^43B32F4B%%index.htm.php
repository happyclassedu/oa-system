<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:09
         compiled from index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.htm', 56, false),array('modifier', 'truncate_i', 'index.htm', 114, false),)), $this); ?>

<!-- content begin-->
<div id="index_con" class="div_976_center">
    <div class="login">
        <h2><a href="#">会员登录</a></h2>
        <div class="login-content">
            <ul id="box_login" class="box_login">
                <li class="txt_box">
                    <input id="btn_login" type="button" />
                    <div>账 号：<input id="txt_username" type="text" /></div>
                    <div>密 码：<input id="txt_password" type="password" /></div>
                </li>
                <li>
                    <input id="btn_r_login" name="btn_r_login" type="radio" checked="checked" value="p" />
                    <label for="btn_r_login">个人会员</label>
                    <input id="btn_r_login_c" name="btn_r_login" type="radio" value="c" />
                    <label for="btn_r_login_c">企业会员</label>
                </li>
                <li class="txt_2"><a href="./info_600.htm">会员注册须知</a><a href="./x_pass_find.htm">忘记密码</a></li>
                <li><input id="btn_reg_p" type="button" /><input id="btn_reg_c" type="button" /></li>
            </ul>
            <ul id="box_login_p" style="display: none;" class="box_login">
                <li><span id="user_title"></span>欢迎您的访问！</li>
                <li><input id="btn_ucenter_p" type="button" value="进入我的个人用户中心" /></li>
                <li><input id="btn_resume_view" type="button" value="查看我的简历" />&nbsp;&nbsp;<input id="btn_resume_edit" type="button" value="修改我的简历" /></li>
                <li><input class="btn_passwd_edit" type="button" value="修改登陆密码" />&nbsp;&nbsp;<input class="btn_logout" type="button" value="退出本次登录" /></li>
                <li class="txt_2"><a href="./info_600.htm">会员注册须知</a><a href="./x_pass_find.htm">忘记密码</a></li>
                <li><input id="btn_reg_p" type="button" /><input id="btn_reg_c" type="button" /></li>
            </ul>
            <ul id="box_login_c" style="display: none;" class="box_login">
                <li><span id="user_title"></span>欢迎您的访问！</li>
                <li><input id="btn_ucenter_c" type="button" value="进入企业用户中心" /></li>
                <li><input id="btn_com_view" type="button" value="查看我的简历" />&nbsp;&nbsp;<input id="btn_com_edit" type="button" value="修改我的简历" /></li>
                <li><input class="btn_passwd_edit" type="button" value="修改登陆密码" />&nbsp;&nbsp;<input class="btn_logout" type="button" value="退出本次登录" /></li>
                <li class="txt_2"><a href="./info_600.htm">会员注册须知</a><a href="./x_pass_find.htm">忘记密码</a></li>
                <li><input id="btn_reg_p" type="button" /><input id="btn_reg_c" type="button" /></li>
            </ul>
            <ul id="box_search">
                <li><input id="txt_s_job_class" class="btn_s" type="button" value="请选择职位类别" /></li>
                <li><input id="txt_s_job_title" class="btn_s" type="button" value="请选择职位名称" /></li>
                <li><input id="txt_s_com_class" class="btn_s" type="button" value="请选择行业类别" /></li>
                <li><input id="txt_s_job_addr" class="btn_s" type="button" value="请选择工作城市" /></li>
                <li><input id="txt_s_diy" type="text" value="请输入公司或职位" /><input id="btn_search" type="button" /></li>
            </ul>
        </div>
    </div>
    <div id="index_news1">
        <h2 id="index_news1_title">
            <?php $_from = $this->_tpl_vars['ws']['index_news1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
            <a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a>
            <?php endforeach; endif; unset($_from); ?>
        </h2>
        <?php $_from = $this->_tpl_vars['ws']['index_news1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index_news']):
?>
        <ul>
            <?php $_from = $this->_tpl_vars['index_news']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['arr_index'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['arr_index']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tmp']):
        $this->_foreach['arr_index']['iteration']++;
?>
            <li><span><?php echo ((is_array($_tmp=$this->_tpl_vars['tmp']['atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d") : smarty_modifier_date_format($_tmp, "%m-%d")); ?>
</span><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></li>
            <?php endforeach; else: ?>
            <?php endif; unset($_from); ?>
        </ul>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div id="index_con3">
        <div id="index_pics_box">
            <ul id="index_pics">
                <?php $_from = $this->_tpl_vars['ws']['link_pics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
                <li><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
"><img src="doc::<?php echo $this->_tpl_vars['tmp']['img']; ?>
" /><p><?php echo $this->_tpl_vars['tmp']['name']; ?>
</p></a></li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>
        <h1 id="index_notice" title="<?php echo $this->_tpl_vars['ws']['cfg']['name']; ?>
,<?php echo $this->_tpl_vars['ws']['cfg']['name_s']; ?>
,<?php echo $this->_tpl_vars['ws']['cfg']['seo_keys']; ?>
"><a href="#">欢迎您光临曲江人才新版网站！</a></h1>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "link4".($this->_tpl_vars['ws']['mk']).".htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index_coms.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "link0".($this->_tpl_vars['ws']['mk']).".htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "banner2".($this->_tpl_vars['ws']['mk']).".htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="index_cnt2_box" class="div_976_center">
    <div id="index_cnt2">
        <h2><a class="re" href="<?php echo $this->_tpl_vars['ws']['index_news2']['5']['url']; ?>
"><?php echo $this->_tpl_vars['ws']['index_news2']['5']['name']; ?>
</a>
            <span id="index_news2_title">
                <?php $_from = $this->_tpl_vars['ws']['index_news2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tmp']):
?>
                <a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a>
                <?php endforeach; endif; unset($_from); ?>
            </span>
        </h2>
        <div id="index_cnt2_1">
            <ul>
                <?php $_from = $this->_tpl_vars['ws']['index_news2']['5']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['arr_index'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['arr_index']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tmp']):
        $this->_foreach['arr_index']['iteration']++;
?>
                <?php if (($this->_foreach['arr_index']['iteration']-1) == 0): ?>
                <li class="photo"><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
"><img align="left" style="margin:4px;" src="../img/re-pic.jpg" /><?php echo $this->_tpl_vars['tmp']['name']; ?>
……［全文］</a></li>
                <?php else: ?>
                <li><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></li>
                <?php endif; ?>
                <?php endforeach; else: ?>
                <?php endif; unset($_from); ?>
            </ul>
        </div>
        <div id="index_news2_cnt">
            <?php $_from = $this->_tpl_vars['ws']['index_news2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index_news']):
?>
            <ul>
                <?php $_from = $this->_tpl_vars['index_news']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['arr_index'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['arr_index']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tmp']):
        $this->_foreach['arr_index']['iteration']++;
?>
                <li><span><?php echo ((is_array($_tmp=$this->_tpl_vars['tmp']['atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d") : smarty_modifier_date_format($_tmp, "%m-%d")); ?>
</span><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</a></li>
                <?php endforeach; else: ?>
                <?php endif; unset($_from); ?>
            </ul>
            <?php endforeach; endif; unset($_from); ?>
        </div>
    </div>
    <div id="index_cnt3">
        <h2><a href="list_resume_1_1.htm">推荐简历</a></h2>
        <ul>
            <li class="hei"><span class="s1">姓名</span><span class="s2">性别</span><span class="s3">学历</span><span class="s4">毕业学校</span></li>
            <?php $_from = $this->_tpl_vars['ws']['index_resume']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['arr_index'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['arr_index']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tmp']):
        $this->_foreach['arr_index']['iteration']++;
?>
            <li><a href="<?php echo $this->_tpl_vars['tmp']['url']; ?>
" title="<?php echo $this->_tpl_vars['tmp']['name']; ?>
"><span class="s1"><?php echo $this->_tpl_vars['tmp']['name']; ?>
</span> <span class="s2"><?php echo $this->_tpl_vars['tmp']['sex']; ?>
</span> <span class="s3"><?php echo $this->_tpl_vars['tmp']['degree']; ?>
</span> <span class="s4"><?php echo ((is_array($_tmp=$this->_tpl_vars['tmp']['univ'])) ? $this->_run_mod_handler('truncate_i', true, $_tmp, 8, "…") : smarty_modifier_truncate_i($_tmp, 8, "…")); ?>
</span></a></li>
            <?php endforeach; else: ?>
            <?php endif; unset($_from); ?>

        </ul>
    </div>
</div>
<!-- content end-->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "link1".($this->_tpl_vars['ws']['mk']).".htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "link2".($this->_tpl_vars['ws']['mk']).".htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>