<?php
$token = $_GET['token'];
$db = mysqli_connect('localhost', 'root', '', 'erpsystem');

$result = mysqli_query($db, "SELECT * FROM rejestracja WHERE token = '$token' LIMIT 1");

if (mysqli_num_rows($result) == 1) {
    mysqli_query($db, "UPDATE rejestracja SET aktywacja = 1 WHERE token = '$token'");

    $message = "Adres e-mail został pomyślnie potwierdzony!";
} else {
    $message = "Potwierdź adres e-mail.";
}
?>

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
        <p> 
            <?php
                echo $message;
            ?>
        </p>
        <div class="input-group">
		<p>
  	        <button class="RegisterButton" type="submit" onclick="window.location.href='login.php';" class="btn" name="reg_user"><b>Strona główna</b></button>
        </p>
  	    </div>
    </div>
</div>	
</body>
</html>