<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<link rel="stylesheet"  type="text/css" href="style_login.css">

<body>
<div class="card">	
  <div class="header">
  	<h1>Rejestr Pracowników<img class="logo" src="Icons/logo.png"></h1>
  </div>
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<input type="text" placeholder="Wpisz login" name="username" >
  	</div>
  	<div class="input-group">
  		<input type="password" placeholder="Wpisz hasło" name="password">
  	</div>
  	<div class="input-group">
  		<button class="loginButton" type="submit" name="login_user"><b>Zaloguj</b></button>
  	</div>
  	<p>
  		Jeszcze nie masz konta? <a href="register.php">Zarejestruj się!</a>
  	</p>
  </form>
</div>
</body>
</html>