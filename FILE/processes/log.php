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

		$email_login_email = $_POST["email_login_email"]; // Получаем данные почты
		$password_login_password = $_POST["email_login_password"]; // Получаем данные пароля
		$phone_login = $_POST["phone_login"];

		if (empty($phone_login)) {
		$query = $connect->prepare("SELECT password FROM users WHERE Email = ?");//подготавливаем запрос
		$query->bind_param("s", $email_login_email);//заменяем данные 
		$query->execute();//выполняем запрос

		$result = $query->get_result();//получаем данные запрос
		$data_pass = $result->fetch_assoc();//выбираем данные из выполненного запроса
		$password = $data_pass['password'];// получаем пароль из данных

		if ($result->num_rows > 0){
			if ($password_login_password == $password) {
				$new_hashed_password = password_hash($password, PASSWORD_DEFAULT);//обеспечиваем безопастность пароля
				$update_query = $connect->prepare("UPDATE users SET password = ? WHERE Email = ?");
        		$update_query->bind_param("ss", $new_hashed_password, $email_login_email);
        		$update_query->execute();

        		$data_user = "SELECT Name, phone_number, Email, telegram_id FROM users WHERE Email = '$email_login_email'";	
				$_SESSION['user_name'] = $connect->query($data_user)->fetch_assoc()['Name'];//Получаем данные имени
				$_SESSION['user_phone'] = $connect->query($data_user)->fetch_assoc()['phone_number'];//Получаем данные номера телефона
				$_SESSION['user_email'] = $connect->query($data_user)->fetch_assoc()['Email'];//Получаем данные почты
				$_SESSION['user_telegramid'] = $connect->query($data_user)->fetch_assoc()['telegram_id'];//Получаем данные telegram id
				header("Location: ../pages/user.php");
			}
			else{
				if (password_verify($password_login_password, $password)){//проверяем захэшированный пароль
					$data_user = "SELECT Name, phone_number, Email, telegram_id FROM users WHERE Email = '$email_login_email'";	//запрос для получения данных
					$_SESSION['user_name'] = $connect->query($data_user)->fetch_assoc()['Name'];//Получаем данные имени
					$_SESSION['user_phone'] = $connect->query($data_user)->fetch_assoc()['phone_number'];//Получаем данные номера телефона
					$_SESSION['user_email'] = $connect->query($data_user)->fetch_assoc()['Email'];//Получаем данные почты
					$_SESSION['user_telegramid'] = $connect->query($data_user)->fetch_assoc()['telegram_id'];//Получаем данные telegram id
					header("Location: ../pages/user.php");
				}else{
					$_SESSION['ERR_MES'] = 'Пароль не верный';
					header("Location: ../pages/login.php");
				}
			}
		}else{
			$_SESSION['ERR_MES'] = 'Пользователь не найден';
			header("Location: ../pages/login.php");
		}
	}else{
		$query = $connect->prepare("SELECT password FROM users WHERE phone_number = ?");//подготавливаем запрос
		$query->bind_param("s", $phone_login);//заменяем данные 
		$query->execute();//выполняем запрос

		$result = $query->get_result();//получаем данные запрос
		$data_pass = $result->fetch_assoc();//выбираем данные из выполненного запроса
		$password = $data_pass['password'];// получаем пароль из данных
		if ($result->num_rows > 0){
			header("Location: ../pages/sms_vf.php");
			$_SESSION['phone_login_log'] = $phone_login;
			$code_vf = rand(000000,999999); 
			$_SESSION['code'] = $code_vf;
		}else{
			$_SESSION['ERR_MES'] = 'Пользователь не найден';
			header("Location: ../pages/login.php");
		}
	}

	$check_res->close();
	$connect->close();
?>