<?php
	session_start();
	$DB_host_name = 'localhost'; 
	$DB_admin_name = 'root'; // Логин 
	$DB_password = ''; // Пароль
	$DB_table_name = 'BD_TechConnect'; // Название таблицы

	$connect = new mysqli($DB_host_name, $DB_admin_name, $DB_password, $DB_table_name);

// Проверка на наличие ошибок подключения
	if ($connect->connect_error) {
    	die("Ошибка подключения: " . $connect->connect_error);
	}

	$code_v = $_POST["code_tg"];
	$check = "SELECT Name, phone_number, Email, telegram_id FROM users WHERE telegram_connect = '$code_v'";	
	if($connect->query($check)->num_rows > 0){
			$name = "SELECT Name, phone_number, Email, telegram_id FROM users WHERE telegram_connect = '$code_v'";	
			$_SESSION['user_name'] = $connect->query($name)->fetch_assoc()['Name'];
			$_SESSION['user_phone'] = $connect->query($name)->fetch_assoc()['phone_number'];
			$_SESSION['user_email'] = $connect->query($name)->fetch_assoc()['Email'];
			$_SESSION['user_telegramid'] = $connect->query($name)->fetch_assoc()['telegram_id'];
			header("Location: ../../pages/User.php");	
		}
	else{
		$_SESSION['ERR_TG'] = "Код не найден!";
		$_SESSION['int'] = "0";
		header("Location: ../../pages/telegram.php");
	}
	
	$connect->close();
	
?>