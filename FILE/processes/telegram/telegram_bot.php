<?php
header("Location: ../../pages/log in/log_in.php");
session_start();
// Замените 'YOUR_TOKEN' на токен вашего бота
$token = '7601434344:AAHxb_LUaPzpeZibPDDb6Uh7acHH32_qmV4';
$apiUrl = "https://api.telegram.org/bot$token/";

// Функция для отправки сообщения
function sendMessage($chatId, $message) {
    global $apiUrl;
    $url = $apiUrl . "sendMessage?chat_id=$chatId&text=" . urlencode($message);
    file_get_contents($url);
}

// Получение обновлений
$offset = 0;

while (true) {
    $connect = new mysqli("localhost", "root", "", "BD_TechConnect");
    // Получаем обновления
    $updates = json_decode(file_get_contents($apiUrl . "getUpdates?offset=$offset"), true);

    // Обрабатываем каждое обновление
    foreach ($updates['result'] as $update) {
        $chatId = $update['message']['chat']['id'];
        $messageText = $update['message']['text'];
        $check = "SELECT telegram_connect FROM users WHERE telegram_id = $chatId";
        // Проверяем команду /start
        if ($messageText == "/reg") {   
            
            if ($connect->query($check)->num_rows > 0) {
                sendMessage($chatId,"Вы уже зарегестрированы");
            }else{
              $code = rand(000000,999999);
              $pass = rand(00000000,99999999); 
              $firstName = isset($message['from']['first_name']) ? $message['from']['first_name']: 'Неизвестно';
              $p_hash = password_hash($pass, PASSWORD_DEFAULT);
              $query2 = "INSERT INTO users (Name, telegram_connect, telegram_id, password) VALUES ('$firstName' ,$code, $chatId, '$p_hash')";
              if ($connect->query($query2) === TRUE) {

                   sendMessage($chatId,"Вы успешно зарегестрировались. Для входа введите команду /log!");
                    sendMessage($chatId,"Ваш пароль от аккаунта: $pass!");
               }else{
                sendMessage($chatId,"Ошибка");
               } 
              
            }
            
        }else if($messageText == "/log"){

            if ($connect->query($check)->num_rows <= 0) {
                sendMessage($chatId,"Вы не зарегестрированы, введите команду /reg!");
            }else{
                $code2 = rand(000000,999999);
                $q = $connect->query("UPDATE `users` SET telegram_connect = $code2 WHERE telegram_id = $chatId");
              sendMessage($chatId,"Ваш код для входа: $code2");
              $_SESSION['tg_conn'] = $code2;
            }
            
        }else if($messageText == "/start"){
            sendMessage($chatId,"Добро пожаловать в TC! Для регистрации введите /reg. Если вы уже зарегестрированы введите /log для получения кода!");
        }else{
            
        }

        $offset = $update['update_id'] + 1;
    }

    sleep(1);
}

?>