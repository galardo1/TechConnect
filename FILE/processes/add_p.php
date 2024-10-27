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
		$bot_code = $_SESSION['code'];
		$user_code = $_POST['code_for_vf'];
		if($bot_code == $user_code){
			if (empty($_SESSION['add_phone'])) {
				$phone_add = $_POST['phone_d'];
			}else{
				$phone_add = $_SESSION['add_phone'];
			}


	$email_user = $_SESSION['user_email'];
	$user_telegram_id = $_SESSION['user_telegramid'];


	if (empty($user_telegram_id)) {
		$update_query = $connect->query("UPDATE users SET phone_number = $phone_add WHERE Email = '$email_user'");
		header("Location: ../pages/user.php");
	}else{
		$update_query = $connect->query("UPDATE users SET phone_number = $phone_add WHERE telegram_id = '$user_telegram_id'");
		header("Location: ../pages/user.php");
	}
}else{
	$_SESSION['ERR_MESS'] = "Не верный код";
	header("Location: ../pages/sms_vf_for_add.php");
}
	
	unset($_SESSION['add_phone']);
	$connect->close();
?>