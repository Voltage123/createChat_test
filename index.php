<?php 
	require_once 'inc/config.php';
  	$chat = chat::_self($db);
  	if(isset($_GET['logout'])){
    	$chat->Logout();
      	@header("Location:".$_SERVER['PHP_SELF']);
  	}
  	if(isset($_GET['id']) && !empty($_GET['id'])){
		$id = intval($_GET['id']);
    	$chat->DeleteMessage($id);
	}
  	$templater = new tmp();

  	if(isset($_SESSION['user']['login'])){
  	$color = $chat->ShowCollor($_SESSION['user']['id']);

  	$templater->assign("color", $color);
  	}
  	$templater->show_display('home.tpl');
?>