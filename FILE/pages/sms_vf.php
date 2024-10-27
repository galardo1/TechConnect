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
				<form method="POST" action="../processes/sms.php" id ="form">
					<input type="number" name="code_for_vf" class="inp" required placeholder="Введите код из SMS"> 
					<br>
					<button class="but">Войти</button>
					<br>
					<?php
					session_start();
    					if (isset($_SESSION['code'])) {
    							echo "<b>Ваш код:<p id='resg'>" . $_SESSION['code'] . "</p></b>";
    						}
    						
    				?>

    				<?php
					session_start();
    					if (isset($_SESSION['ERR_MESS'])) {
    							echo "<b>Ваш код:<p id='resb'>" . $_SESSION['ERR_MESS'] . "</p></b>";
    						}
    					unset($_SESSION['ERR_MESS']);
    				?>

				</form>
				
			</div>
		</div>
	</div>
</body>
</html>	