<?php include('server.php') ?>

<?php

$month = ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];

  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['email']);
  	header("location: login.php");
  }

$conn = mysqli_connect('localhost', 'root', '', 'erpsystem');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$nazwa = mysqli_real_escape_string($db,$_SESSION['username']);
$sql = "SELECT * FROM zarejestrowanegodziny WHERE nazwa='$nazwa'";
$result = mysqli_query($conn,$sql);

  ?>
<html>
<head>	
	<title>Edytuj dane</title>
  <head>
  <link rel="stylesheet" type="text/css" href="style_user.css"/>
</head>
</head>
<body>
<div class="card">
  <div class="navbar">
      <div class="header">
      <div class="container">
        <div class="containerHeader"><h2>Dane użytkownika<img class="logo" src="Icons/logo.png"></h2></div>
          <h2><div class="userName"><?php echo " " .$_SESSION['username'];?></div></h2>
        </div>
        <div class="content">
          <?php  if (isset($_SESSION['username'])) : ?>
            <p> <a class="main" href="index.php">Strona główna</a> </p>
            <p> <a class="logout" href="index.php?logout='1'">Wyloguj</a> </p>
          <?php endif ?>
      </div>
    </div>
  </div>
    <div class="passwordChange">
      <p>Zmiana hasła:</p>
      <form method="post" action="user.php">
        <input class="email" type="email" name="email" placeholder="Email:"></br>
        <input class="oldPassword" type="password" name="old_password" placeholder="Stare hasło:"></br>
        <input class="newPassword" type="password" name="new_password" placeholder="Nowe hasło:"></br>
        <input class="button" type="submit" name="aktualizuj" value="Aktualizuj"></td>
      </form>
        </div>
          <?php include('errors.php'); ?>
            <p class="registeredHours"> Twoje przepracowane godziny </p>
            <div class="lowerPanel">
          <?php
            echo 
              '<table>
                <tr>
                  <th>Miesiąc</th>
                  <th>Godziny</th>
                  <th>Norma</th>
                </tr>';
            for($i=0;$i<12;$i++)
              {
                echo 
                '<tr>
                  <td>'.$month[$i].'</td>
                  <td>'.'test'.'</td>
                  <td>'.'168'.'</td>
                </tr>';
              }
            ?>
        </div>
</div>

</body>
</html>