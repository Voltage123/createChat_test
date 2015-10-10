<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Добро пожаловать в чат!</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="/tmp/js/bootstrap/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/tmp/css/style.css">
<script type="text/javascript" src="/tmp/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/tmp/js/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/tmp/js/chat.js"></script>
</head>
<body>
    <?php if (isset($_SESSION['user']['login']) && !empty($_SESSION['user']['login'])) :?>
    	<a href="?logout=tru">Выход</a>
    	<div class="result"></div>
    	<div class="chat_area">
    		<div align="center">
    		<div class="result_message">В чате нет сообщений</div>
			</div>
			<br> 
			<hr><br>
			<h1>Добро пожаловать в чат!</h1>
			<br>
			<textarea name="" id="" cols="30" rows="10" class="message"></textarea>
			<br>
			<button class="btn btn-primary green" id="button">Написать сообщение</button>
			<a href="#modal" role="button" class="btn" data-toggle="modal">
				Выбрать цвет сообщений
			</a>
			<!--Модальное окно-->
			<div id="modal" class="modal hide fade">
	    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <br>
			<h2>Введите цветовой-код ваших сообщений</h2>
	    	</div>
	   		<div class="modal-body">
				<p>
                    <input id="colorpickerField" type="text"  class="color" value="<?=$this->color;?>" />
                    <input type="hidden" class="id" value="<?=$_SESSION['user']['id'];?>">
                  	<br>
                    <button class="btn btn-primary" id="color">Готово</button>
                </p>
			</div>
		</div>
		<!--Конец модального окна-->
    	</div>
    <?php else: ?>
    <?php include_once 'login.tpl'; ?>
    <?php endif; ?>
</body>
</html>