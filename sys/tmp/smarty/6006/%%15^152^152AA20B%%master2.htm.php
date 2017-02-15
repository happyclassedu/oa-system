<?php /* Smarty version 2.6.25, created on 2013-11-22 19:58:18
         compiled from master2.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $this->_tpl_vars['ws']['seo']['title']; ?>
<?php echo $this->_tpl_vars['ws']['cfg']['name_s']; ?>
</title>
        <meta name="keywords" content="<?php echo $this->_tpl_vars['ws']['seo']['keys']; ?>
<?php echo $this->_tpl_vars['ws']['cfg']['seo_keys']; ?>
" />
        <meta name="description" content="<?php echo $this->_tpl_vars['ws']['seo']['desc']; ?>
<?php echo $this->_tpl_vars['ws']['cfg']['seo_desc']; ?>
" />
        <link type="text/css" rel="stylesheet" href="../css/www.css" />
        <link type="text/css" rel="stylesheet" href="../css/www_lefter.css" />
        <link type="text/css" rel="stylesheet" href="../css/www_<?php echo $this->_tpl_vars['ws']['act']; ?>
.css" />
    </head>
    <body>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header".($this->_tpl_vars['ws']['mk']).".htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menuer".($this->_tpl_vars['ws']['mk']).".htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['ws']['tpl'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer".($this->_tpl_vars['ws']['mk']).".htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </body>
</html>
<input type="hidden" id="g_id_www" value="<?php echo $this->_tpl_vars['ws']['act']; ?>
" />
<script type="text/javascript" language="javascript" src="../js/www.js"></script>