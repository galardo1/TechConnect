<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>TechConnect</title>
	<link rel="stylesheet" href="../style/css/style.css">
	<link rel="shortcut icon" href="../style/img/TC.png">
</head>
<body>
	<nav id="nav">
		<a id='h1' href="../index.php">TechConnect</a>
		<div id="flex">
			<b><a href="login.php" class="a">Выход</a></b>
		</div>
	</nav>

	<div class="user_info">
		<p class="h2">Информация о пользователе:<p>
			<br>
					<?php
					session_start();
					if (isset($_SESSION['user_name'])){
						echo "<br><b><p>Имя: " . $_SESSION['user_name'] . "</p></b>";
					}

					if (isset($_SESSION['user_phone'])){
						echo "<br><b><p>Номер телефона: " . $_SESSION['user_phone'] . "</p></b>";
					}
					else{
						echo "
							<br>
								<form action = '../pages/add_phone.php'>
									<b><p>Номер телефона: <b>
									<button class='but'>Привязать телефон</button></b>
									</p>
								</form>";
					}

					if (isset($_SESSION['user_email'])){
						echo "<br><b><p>Почта: " . $_SESSION['user_email'] . "</p></b>";
					}

					if (isset($_SESSION['user_telegramid'])){
						echo "<br><b><p>Ваш Telegram id: " . $_SESSION['user_telegramid'] . "</p></b>";
					}
					else
					{
						echo "
							<br>
								<form action = 'for_add_telegram.php'>
									<b><p>Ваш Telegram id: <b>
									<button class='but'>Привязать Telegram</button></b>
									</p>
								</form>";
					}
    			?>
   	</div>
</body>
</html>	