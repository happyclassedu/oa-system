<?php
define('ELIN_ROOT'		, ereg_replace("[/\\]{1,}",'/',substr(dirname(__FILE__),0,-8)));
define('ELIN_INC'		, ELIN_ROOT.'/include');
define('ELIN_SMARTY'	, ELIN_INC.'/smarty');
define('ELIN_TPL'		, ELIN_ROOT.'/templates');
define('ELIN_ASS'		, ELIN_INC.'/assign');
define('ELIN_DATA'		, ELIN_ROOT.'/date');
?>
