<?php
session_start();
ob_start();
require_once 'controller/autoloadroot.php';
require_once 'smarty/Smarty.class.php';

$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;
$smarty->setCacheDir('view/cache/');
$smarty->setCompileDir( 'view/compile/');
$smarty->setConfigDir( 'view/config/');
$smarty->setTemplateDir( 'view/templates/');
$smarty->assign('HOME', HOME);
$smarty->assign('desabilitarImagem', 'hidden="true"');
$smarty->display('view/templates/index.tpl');
