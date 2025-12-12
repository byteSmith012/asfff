<?
// FILE SEND PAGE //
//-----------------//
if (isset ($_POST['send_user']) || isset ($_POST['send_upsell']) || isset ($_POST['send_no_upsell'])) { // запрет прямого обращения к обработчику
	session_start();
	// Обрабатываем данные полученные с html-формы, формируем нужные переменные
		if (isset ($_POST['user_name'])) {$name = $_POST['user_name'];htmlspecialchars($name);trim ($name);$_SESSION['order_name'] = $name;}if ($name == ""){unset ($name);}
		if (isset ($_POST['user_phone'])) {$tel = $_POST['user_phone'];htmlspecialchars($tel);trim ($tel);$_SESSION['order_tel'] = $tel;}if ($tel == ""){unset ($tel);}
		if (isset ($_POST['user_mail'])) {$email = $_POST['user_mail'];htmlspecialchars($email);trim ($email);}if ($email == ""){unset ($email);}
		if (isset ($_POST['user_adres'])) {$adres = $_POST['user_adres'];htmlspecialchars($adres);trim ($adres);}if ($adres == ""){unset ($adres);}
		if (isset ($_POST['user_message'])) {$message = $_POST['user_message'];htmlspecialchars($message);trim ($message);}if ($message == ""){unset ($message);}
	// Формируем текст сообщения исходя из наличия переменных
		if(isset($name)){$string_message = "Имя покупателя: ".$name."<br>";}
		if(isset($tel)){$string_message .= "Телефон: ".$ tel."<br>";}
		if(isset($email)){$string_message .= "E-mail: ".$email."<br>";}
		if(isset($adres)){$string_message .= "Адрес отправления: ".$adres."<br>";}
		if(isset($message)){$string_message .= "Сообщение клиента: ".$message."<br>";}
		$string_message .= "<br>Заказ с сайта: ".$_SERVER['HTTP_HOST']."<br>";
		$string_message .= "Время заказа: ".date("m.d.Y H:i:s")."<br>";
		$string_message .= "IP покупателя: ".$_SERVER['REMOTE_ADDR']."<br>";
		$string_message .= "Сайт реферер: ".$_SERVER['HTTP_REFERER']."<br><br>";
		
		$subject = 'Заявка с сайта '.$_SERVER['HTTP_HOST']; // заголовок письма


		//////////// АДРЕС ПОЧТЫ ДЛЯ ПРИЕМА ЗАЯВОК ////////////
		$to = "flyuntnatalia@gmail.com"; // Ваш Электронный адрес
		///////////////////////////////////////////////////////


		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$header .= "From: <zakaz@{$_SERVER['HTTP_HOST']}> \r\n";

	//-- ОБРАБОТЧИК ФОРМЫ ЗАЯВКИ НА САЙТЕ --//
	if (isset ($_POST['send_user'])){ // проверяем отправку формы заявки
		if (isset ($tel) || isset ($email)){ // проверяем заполнение обязательного полея контакта
			$result = mail($to,$subject,$string_message,$header); // оправляем письмо с сайта
			if ($result == 'TRUE'){ // проверяем результат отправки
				header ('Location: senks_page.php');
			}else {?><script>alert ('Сообщение с формы не отправлено!');location.replace('../');</script><?}
		}else{?><script>alert ('Не заполнены обязательные поля! Они отмечены звездочками*');location.replace('../');</script><?}
	}

	//-- ОБРАБОТЧИК ДОБАВЛЕНЫХ АПСЕЛОВ --//
	if (isset($_POST['send_upsell'])) { // проверяем отправку добавленых апселов 
		$name = $_SESSION['order_name'];
		$tel = $_SESSION['order_tel'];
		if (isset($_POST['upsell'])) { // проверяем наличие добавленных товаров
		$arr_upsell = $_POST['upsell']; // формируем строку с добавленными товарами
			foreach ($arr_upsell as $value) {
				if ($value != '0') {
					$string .= '| '.$value.' | ';
				}
			}
			$tema = 'Добавление к заказу с страницы апселов'; // Тема отправляемого письма
			$string_message = "Имя отправителя: ".$name."\r\nТелефон: ".$tel."\r\nДобавленые товары: ".$string; // форимруем текст сообщениея
			$result = mail ($to,$tema,$string_message,$headers); // оправляем письмо с сайта
			if ($result == 'TRUE'){ // проверяем результат отправки
				header ('Location: senks_page.php');
			}else {?><script>alert ('Сообщение не отправлено!');location.replace('senks_page.php');</script><?}
		}else{?><script>alert ('Вы не выбрали товар!');location.replace('senks_page.php');</script><?}
	}
	//-- ОБРАБОТЧИК ОТКАЗА ОТ АПСЕЛОВ --//
	if (isset($_POST['send_no_upsell'])) { // если апселы не добавлены
		header ('Location: senks_page.php');
	}
}else{?><script>location.replace('../');</script><?}

// Интеграция с RetailCRM
$data=array(
  'name'=>isset($_POST['user_name']) ? $_POST['user_name'] : '',
  'utm_source'=>isset($_POST['utm_source']) ? $_POST['utm_source'] : '',
  'utm_campaign'=>isset($_POST['utm_campaign']) ? $_POST['utm_campaign'] : '',
  'utm_medium'=>isset($_POST['utm_medium']) ? $_POST['utm_medium'] : '',
  'utm_keyword'=>isset($_POST['utm_keyword']) ? $_POST['utm_keyword'] : '',
  'phone'=>isset($_POST['user_phone']) ? $_POST['user_phone'] : '' 
);

extract($data);

if(!$phone) exit;
$order = json_encode(
array(
	"phone" => $phone,
	"firstName" => $name,
	"source" => array(
		"source" => $utm_source,
		"medium" => $utm_medium,
		"campaign" => $utm_campaign,
		"keyword" => $utm_keyword,
		"content" => "",
	)
));

$peremen = array(
	"site" => "winterboots-store-1",
	"order" => $order,
);

$handle=curl_init();
curl_setopt($handle, CURLOPT_URL, "https://bydray.retailcrm.ru/api/v4/orders/create?apiKey=UZT9gnGfIcObg92gfE9WfrhIPGsqhIUS");
curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($peremen));
curl_setopt($handle, CURLOPT_HEADER, false);
$response=curl_exec($handle);
$code=curl_getinfo($handle, CURLINFO_HTTP_CODE);
curl_close($handle);
// все сделано
?>