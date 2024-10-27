<?php
	session_start();
	//Данные от базы данных

	$DB_host_name = 'localhost'; 
	$DB_admin_name = 'root'; // Логин 
	$DB_password = ''; // Пароль
	$DB_table_name = 'BD_TechConnect'; // Название таблицы

	$connect = new mysqli($DB_host_name, $DB_admin_name, $DB_password, $DB_table_name);

	if ($connect->connect_error) {
    	die("Ошибка подключения: " . $connect->connect_error);
	}

	$user_code = $_POST["code_for_vf"];
	$bot_code = $_SESSION['code'];



	if($user_code == $bot_code){
		$phone_login = $_SESSION['phone_login_log'];
		$data_user = "SELECT Name, phone_number, Email, telegram_id FROM users WHERE phone_number = '$phone_login'";	//запрос для получения данных
			$_SESSION['user_name'] = $connect->query($data_user)->fetch_assoc()['Name'];//Получаем данные имени
			$_SESSION['user_phone'] = $connect->query($data_user)->fetch_assoc()['phone_number'];//Получаем данные номера телефона
			$_SESSION['user_email'] = $connect->query($data_user)->fetch_assoc()['Email'];//Получаем данные почты
			$_SESSION['user_telegramid'] = $connect->query($data_user)->fetch_assoc()['telegram_id'];//Получаем данные telegram id
			header("Location: ../pages/user.php");

	}else{
		$_SESSION['ERR_MESS'] = "Код не верный";
		header("Location: ../pages/sms_vf.php");
	}
?>