<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TechConnect</title>
	<link rel="stylesheet" href="../style/css/style.css">
	<link rel="stylesheet" href="../style/css/slider.css">
	<link rel="shortcut icon" href="../style/img/TC.png">
</head>
<body>
	<nav id="nav">
		<a id='h1' href="../index.php">TechConnect</a>
	</nav>
	<div id='Register'>
		<div id='loginPanel'>

			<div id="fh2">
				<p id='h2'>Вход</p>
			</div>

			<div id="input">
				<div class="slider2">

					<div class="navigation2">
            			<label for="slide1" id="but_for_mail">Использовать почту</label>
            				<p id="slash">/</p>
            			<label for="slide2" id="but_for_phone">Использовать номер телефона</label>
        			</div>	

        				<input type="radio" name="slider" id="slide1" checked>
        				<input type="radio" name="slider" id="slide2">

        		<div class="slides">
            		<div class="slide slide1">

                		<div id="input">
								<form method="POST" action="../processes/log.php" id ="form">
									<br>
								<input type="email" name ="email_login_email" placeholder="Введите почту" required class="inp">
									<br>
									<br>
								<input type="password" name ="email_login_password" placeholder="Введите пароль" required class="inp">
									<br>
								<button class="but">Войти</button>
								<?php
									session_start();
    								if (isset($_SESSION['ERR_MES'])) {
    										echo "<b><p id='resb'>" . $_SESSION['ERR_MES'] . "</p></b>";
    								}
    								unset($_SESSION['ERR_MES']);
    								unset($_SESSION['user_name']);
    								unset($_SESSION['user_phone']);
    								unset($_SESSION['user_email']);
    								unset($_SESSION['user_telegramid']);
    							?>
								</form>			
						</div>

            		</div>


            		<div class="slide slide2">

                		<div id="input">
							<form method="POST" action="../processes/log.php" id ="form">
								<br>
							<input type="number" name ="phone_login" placeholder="Введите телефон" required class="inp">
								<br>
								<br>
								<br>
							<button class="but">Отправить SMS</button>
							<?php
								session_start();
    							unset($_SESSION['user_name']);
    							unset($_SESSION['user_phone']);
    							unset($_SESSION['user_email']);
    							unset($_SESSION['user_telegramid']);
    						?>
							</form>	
						</div>

            		</div>
        		</div>

    			</div>		
			</div>

			<div id="logQ">
				<a href="telegram.php">Войти через Telegram</a>
			</div>

		</div>
	</div>
</body>
</html>	