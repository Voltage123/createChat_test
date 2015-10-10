<?php
/**
 * 
 * @authors Yurii Kostenko (y.kostenko111@ya.ru)
 * @date    2015-10-09 00:34:28
 * @version 1
 */

session_start();

require_once 'database.php';
require_once dirname(__FILE__).'/../libs/tmp.class.php';
require_once dirname(__FILE__).'/../libs/chat.class.php';

$url = explode("/",$_SERVER['PHP_SELF']);
$catalog = empty($url[1]) ? '/' : '/'.$url[1];

define("ROOT", dirname(__FILE__).'/../');
define("URL_ROOT", "http://".$_SERVER['HTTP_HOST'].$catalog); 
?>
