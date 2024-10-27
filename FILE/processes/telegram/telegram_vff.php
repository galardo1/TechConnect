<?php
session_start();
// Данные от базы данных
$DB_host_name = 'localhost'; 
$DB_admin_name = 'root'; // Логин 
$DB_password = ''; // Пароль
$DB_table_name = 'BD_TechConnect'; // Название таблицы

$connect = new mysqli($DB_host_name, $DB_admin_name, $DB_password, $DB_table_name);

// Проверка на наличие ошибок подключения
if ($connect->connect_error) {
    die("Ошибка подключения: " . $connect->connect_error);
}

$res_email = $_SESSION['user_email']; 
$res_phone = $_SESSION['user_phone'];

$code_v = $_POST["code_tgg"];

// Подготовленный запрос для получения пользователя по коду
$select_query = $connect->prepare("SELECT id, telegram_connect, telegram_id FROM users WHERE telegram_connect = '$code_v'");
$select_query->execute();
$result = $select_query->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $tg_connect = $user['telegram_connect'];
    $tg_id = $user['telegram_id'];
    $user_id = $user['id'];

    // Подготовленный запрос для обновления данных
    if ($res_phone === null) {
        $update_query = $connect->prepare("UPDATE users SET telegram_connect = '$tg_connect', telegram_id =  '$tg_id' WHERE Email = '$res_email'");
    } else {
        $update_query = $connect->prepare("UPDATE users SET telegram_connect = '$tg_connect', telegram_id = '$tg_id' WHERE phone_number = '$res_phone'");
    }

    // Выполнение обновления
    if ($update_query->execute()) {
        // Подготовленный запрос для удаления пользователя
        $del_query = $connect->prepare("DELETE FROM users WHERE id = $user_id");
        $del_query->execute();

        $_SESSION['SUC_TGG'] = "Аккаунт привязан!";
        header("Location: ../../pages/for_add_telegram.php");
    } else {
        $_SESSION['ERR_TGG'] = "Ошибка при обновлении данных!";
        header("Location: ../../pages/for_add_telegram.php");
    }
} else {
    $_SESSION['ERR_TGG'] = "Код не найден!";
    header("Location: ../../pages/for_add_telegram.php");
}

$connect->close();
?>