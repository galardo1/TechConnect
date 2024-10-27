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
				<p id='h2'>Введите номер телефона</p>
			</div>
			<div id="input">
				<form method="POST" action="sms_vf_for_add.php" id ="form">
					<input type="number" name="phone_d" class="inp" required placeholder="Введите телефон"> 
					<br>
					<button class="but">Привязать</button>
					<br>
					<?php
						session_start();
						$_SESSION['code'] = rand(000000,999999);
					?>
				</form>
				
			</div>
		</div>
	</div>
</body>
</html>	