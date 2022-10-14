<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<meta name="viewport" content="width=device-width; minimum-scale=1; maximum-scale=1"/>
<link rel="icon" href="/favicon4.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/favicon4.ico" />
<meta name="keywords" content="онлайн, игра, сталкер, для, мобилы, мобилки, мобильного телефона">
<?php
  echo '<title>Сталкер Онлайн</title>';
?>

<link type="text/css" rel="stylesheet" href="http://stalkeronlinegame.epizy.com/style/main1.css" />
<script type="text/javascript" src="jquery.js"></script>  

<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript">
$(function() {
	$("#send").click(function(){
		var message = $("#message").val();				
		$.ajax({
			type: "POST",
			url: "sendmessage3.php?id=6103",
			data: {"message": message},
			cache: false,						
			success: function(response){
				var messageResp = new Array('Ваше сообщение отправлено','Сообщение не отправлено Ошибка базы данных','Нельзя отправлять пустые сообщения');
				var resultStat = messageResp[Number(response)];
				if(response == 0){
					$("#message").val("");
				}
				$("#resp").text(resultStat).show().delay(1500).fadeOut(800);
				
			}
		});
		return false;
				
	});
});
</script>
</head>
<body>
