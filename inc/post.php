<?php
/**
 * 
 * @authors Yurii Kostenko (y.kostenko111@ya.ru)
 * @date    2015-10-09 14:43:38
 * @version 1
 */

require 'config.php';
$chat = chat::_self($db);
echo $chat->ShowMessage();

if (isset($_POST['message'] && !empty($_POST['message']))) {
	$message = strip_tags(trim($_POST['message']));	

if (!$chat->newMessage($message)) echo 0; 
else echo 1;
}