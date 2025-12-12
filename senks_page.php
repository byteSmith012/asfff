<?
// FILE SENKS PAGE //
//-----------------//
session_start();
$name = $_SESSION['order_name'];
$tel = $_SESSION['order_tel'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<meta name='robots' content='noindex,follow' />
	<title>Ваш заказ принят!</title>
	<link rel="stylesheet" href="css/senks_style.css" />
	<style>
		#senks_block {color: #313E47;text-align: center;position: fixed;top: 10%;width: 100%;}
		#senks_block img {width: 185px;margin-bottom: 10px;}
		#senks_block h1 {font-size: 36px;font-weight: 700;text-transform: uppercase;color: rgba(9, 14, 100, 0.7);}
		.senks_text {line-height: 1.2;font-size: 18px;margin: 25px auto;}
		.senks_red {color: #fff;font-size: 19px;font-weight: bold;background: rgba(9, 14, 100, 0.7);height: 45px;line-height: 45px;}
	</style>
</head>
<body style="background-size: 100% 100%;">
	<div id="senks_block">
		<img src="img/index.png" alt="">
		<h1><? if(isset($name)){echo $name;} ?><br>Ваш заказ принят!</h1>
		<p class='senks_text'>В ближайшее время с вами свяжется оператор для подтверждения заказа.<br><br>Пожалуйста, проконтролируйте чтобы ваш контактный телефон <b>"<?=$tel?>"</b> был включен.</p>
		<p class='senks_red'>Спасибо<? if(isset($name)){echo " ".$name;} ?>, что выбрали нас!</p>
	</div>
</body>
</html>