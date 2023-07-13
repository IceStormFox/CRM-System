<?php 
include('server.php') ?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style_register.css"/> 
<body>
<head>
	<meta charset="UTF-8">
	<meta name="vievport" content="width=device-width, initialscale=1.0"/>
	<title>Rejestracja pracowników</title>
</head>

<body>
 <div class="card">
 <div class="header">
  	<h1>Rejestracja <img class="logo" src="Icons/logo.png"></h1>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <input type="text" placeholder="Wpisz login" name="username" value="<?php echo $username; ?>">
  	</div>
	<div class="input-group">
  	<input type="password" placeholder="Wpisz hasło" name="password_unsafe">
  	</div>
  	<div class="input-group">
  	  <input type="email" name="email" placeholder="Wpisz Email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
		<p>
  	  <button class="RegisterButton" type="submit" class="btn" name="reg_user"><b>Zarejestruj się</b></button>
       </p>
  	</div>
  	<p>
  		Posiadasz konto? <a href="login.php">Zaloguj się!</a>
  	</p>
 </div>	
  
  </form>
</body>
</html>