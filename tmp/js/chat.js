/**
 * 
 * @authors Yurii Kostenko (y.kostenko111@ya.ru)
 * @date    2015-10-09 01:01:00
 * @version 1
 */
 function show(){
 	var Result = "";
 	$.ajax({
 		url: "inc/post.php",
 		cache: false,
 		success: function(ResultData){
 			ResultData = JSON.parse(ResultData);


 			for(i=0; ResultData.login.length; i++) {
 				Result += "<div class='chat_result' style='color:#" + ResultData.color[i] + "''>&nbsp;[" + ResultData.date[i] + "]&nbsp;" + ResultData.login[i] + ":&nbsp" + ResultData.message[i] + "</div>";
 			}
 			$(".result_message").html(Result);
 		}
 	});
 }
 $(function(){
 	show();
 	setInterval('show()', 1000);
 	//Сообщения
 	$("#button").click(function(){
 		var message = $(".message").val();
 		$.ajax({
 			type : "POST",
 			data : (message:message),
 			url : "inc/post.php",
 			success : function(data){
 				if (data == 0) {
 					$(".result").html("<div class='alert alert-error'>Ошибка при записи в чат!</div>");
 				}else{
 					$(".result").html("<div class='alert alert-succes'>Сообщение успешно добавлено.</div>");
 					show();
 				}
 			}
 		});
 	});
 	//Вход
 	$("#button_login").click(function(){
 			var login = $(".login").val();
 			var password = $(".password").val();
 			if(login == "" || password == "" ){
 				$(".result").html("<div class='alert alert-error'>Вы не ввели логин или пароль</div>");
 			}else{
 				$.ajax({
 					type: "POST",
 					date: (login:login,password:password),
 					url : "inc/login.php",
 					success: function(data){
 						if(data == 0){
 							$(".result").html("<div class='alert alert-error'>Ошибка при входе!</div>");
 						}else{
 							$(".result").html("<div class='alert alert-succes'>Поздравляю! Вы были успешно авторизированы!</div>");
 						SetTimeout('window.location.reload()', 3000);
 						}
 					}
 				});
 			}
 		});
 		//цвет
 		$("#color").click(function(){
 			var color = $(".color").val();
 			var uid = $(".id").val();
 			if(uid == "") uid = 1;
 			$.get("inc/login.php", {color:color, id:uid},
 			function(){
 				alert("Данные успешно сохранены!");
 			});
 		});
 	});

