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
	</nav>
	<div id='Register'>
		<div id='loginPanel'>
			<div id="fh2">
				<p id='h2'>Авторизация</p>
			</div>
			<div id="input">
				<form method="POST" action="../processes/telegram/telegram_vff.php" id ="form">
					<input type="number" name="code_tgg" class="inp" required placeholder="Введите код из Telegram"> 
					<br>
					<button class="but">Войти</button>
					<div id="logQ">
						<br>
						<br>
						<p>Отправьте команду /log нашему <a href="https://web.telegram.org/k/#@auth_TechConnect_bot" target="_blank">телеграм-боту</a>,</p>
						<p>и введите код из чата!</p>
						
					</div>
					<?php
						session_start();
						if (isset($_SESSION['SUC_TGG'])) {
    								echo "<br><br><br><br><br><b><p id='resg'>" . $_SESSION['SUC_TGG'] . "</p></b>";
    						}
    					unset($_SESSION['SUC_TGG']);
    					$_SESSION['em'] = $_SESSION['user_email'];

    					if (isset($_SESSION['ERR_TGG'])) {
    								echo "<br><br><br><br><br><b><p id='resb'>" . $_SESSION['ERR_TGG'] . "</p></b>";
    						}
    					unset($_SESSION['ERR_TGG']);
    					?>
					<br>
				</form>
				
			</div>
		</div>
	</div>
</body>
</html>	