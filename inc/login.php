<?php
/**
 * 
 * @authors Yurii Kostenko (y.kostenko111@ya.ru)
 * @date    2015-10-09 11:57:35
 * @version 1
 */

require 'config.php';
$chat = chat::_self($db);
if(isset($_GET['color'])){
    $id = intval($_GET['id']);
    $collor = trim(strip_tags($_GET['color']));
    try{
       	if($chat->collor($collor,$id)) return true;  
    }catch(Exception $e){
         //Запись в лог
    }
}
if(isset($_POST) && !empty($_POST)){
   	if(!$chat->LoginMembers($_POST['login'],$_POST['password'])){
       	echo 0;
   	}else{
       	echo 1;
   	}   
}