<?php
require_once 'constantes_URL.php';
require_once 'constantes.php';
define('LOGIC', 'logic/');
define('DAO', '../model/dao/');
define('DTO', '../model/dto/');
define('MYSQL', '../model/mysql/');
define('SQL', '../model/sql/');
define('VALIDATOR', '../validator/');
define('CONTROLLER', '../controller/');
define('VIEW', '../view/');
define('SMARTY', '../smarty/');
define('FUNC', 'function/');
require_once '../smarty/Smarty.class.php';
$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 0;
$smarty->setCacheDir('view/cache/');
$smarty->setCompileDir('view/compile/');
$smarty->setConfigDir('view/config/');
$smarty->setTemplateDir('view/templates/');

spl_autoload_register('__autoload');

function __autoload($class_name) {
    $class_name = ucfirst($class_name);
    if (file_exists(LOGIC . $class_name . '.class.php')) {
        require_once LOGIC . $class_name . '.class.php';
    } elseif (file_exists(DAO . $class_name . '.class.php')) {
        require_once DAO . $class_name . '.class.php';
    } elseif (file_exists(DTO . $class_name . '.class.php')) {
        require_once DTO . $class_name . '.class.php';
    } elseif (file_exists(MYSQL . $class_name . '.class.php')) {
        require_once MYSQL . $class_name . '.class.php';
    } elseif (file_exists(SQL . $class_name . '.class.php')) {
        require_once SQL . $class_name . '.class.php';
    } elseif (file_exists(VALIDATOR . $class_name . '.class.php')) {
        require_once VALIDATOR . $class_name . '.class.php';
    } elseif (file_exists(CONTROLLER . $class_name . '.class.php')) {
        require_once CONTROLLER . $class_name . '.class.php';
    } elseif (file_exists(VIEW . $class_name . '.class.php')) {
        require_once VIEW . $class_name . '.class.php';
    } elseif (file_exists(SMARTY . $class_name . '.class.php')) {
        require_once SMARTY . $class_name . '.class.php';
    } elseif (file_exists(FUNC . $class_name . '.class.php')) {
        require_once FUNC . $class_name . '.class.php';
    } else {
        echo 'classe não existe  -> ' . $class_name;
    }
}
