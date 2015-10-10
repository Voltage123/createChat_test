<?php
/**
 * 
 * @authors Yurii Kostenko (y.kostenko111@ya.ru)
 * @date    2015-10-09 00:45:34
 * @version 1
 */

$host = "localhost";
$user = "root";
$password = "";
$database = "chat_matematica";

$db = new mysqli($host,$user,$password,$database);
$db->query("SET NAMES UTF8");

