<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

session_start();

$username = "";
$email    = "";
$role     = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'erpsystem');

// Rejestracja użytkownika
if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_unsafe = mysqli_real_escape_string($db, $_POST['password_unsafe']);
if (empty($username) || empty($email) || empty($password_unsafe) || strlen($password_unsafe) < 8){
  if (empty($username)) { array_push($errors, "Brak nazwy uzytkownika!");}
  if (empty($email)) { array_push($errors, "Brak adresu e-mail!"); }
  if (empty($password_unsafe)) { array_push($errors, "Brak hasla!"); }
  if(strlen($password_unsafe) < 8) { array_push($errors, "Hasło musi zawierać conajmniej 8 znaków"); }
}
else{
  $user_check_query = "SELECT * FROM rejestracja WHERE nazwa='$username' OR email='$email'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['nazwa'] == $username) {
      array_push($errors, "Uzytkownik o takiej nazwie juz istnieje");
    }

    if ($user['email'] == $email) {
      array_push($errors, "Wskazany adres e-mail zostal juz wykorzystany");
    }
  }
  else{
  	$password = md5($password_unsafe);
    $token = md5(uniqid(rand(), true));

    $activation_link = "http://localhost/aktywuj-konto.php?token=" . $token;
    $mail = new PHPMailer(true);

    try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'testowy20230609@gmail.com';
    $mail->Password = 'utwruwrfgsukljzb';
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';
    
    $mail->setFrom('testowy20230609@gmail.com', 'Rejestracja');
    $mail->addAddress("{$email}");

    $mail->Subject = 'Aktywacja konta';
    $mail->Body = "Twoj link aktywacyjny: {$activation_link}";
    $mail->send();
    $query = "INSERT INTO rejestracja (nazwa, haslo, email, token) 
  			  VALUES('$username', '$password', '$email', '$token')";
  	mysqli_query($db, $query);
    } catch (Exception $e) {
    }

  	$_SESSION['username'] = $username;
  	header('location: login.php');
  }
}
}

// Logowanie użytkownika
if (isset($_POST['login_user'])) {
  $checkactivate = "SELECT aktywacja FROM rejestracja WHERE nazwa='{$_POST['username']}' AND aktywacja = 1";
  $checkresult = mysqli_query($db, $checkactivate);
  if(mysqli_fetch_assoc($checkresult)){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Nazwa uzytkownika jest wymagana");
  }
  if (empty($password)) {
  	array_push($errors, "Haslo jest wymagane");
  }
  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM rejestracja WHERE nazwa='$username' AND haslo='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      while($data = mysqli_fetch_assoc($results))
      {
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['nazwa'];
        $_SESSION['password'] = $data['haslo'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['rola'];
      }
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Nieprawidlowy login lub haslo");
  	}
  }
  }
  else {
    array_push($errors, "Konto nieaktywne.");
  }
}

//Aktualizowanie danych użytkownika
if(isset($_POST['aktualizuj'])) {
  $nazwa = mysqli_real_escape_string($db,$_SESSION['username']);
  $email = mysqli_real_escape_string($db,$_POST['email']);
  $old_password = mysqli_real_escape_string($db, $_POST['old_password']);
  $new_password = mysqli_real_escape_string($db, $_POST['new_password']);
  $password_newsafe = md5($new_password);
  $old_passworddb = mysqli_real_escape_string($db, $_SESSION['password']);

  if (empty($email)) {
  	array_push($errors, "Wprowadz email");
  }
  else if (empty($new_password)) {
  	array_push($errors, "Wprowadz nowe haslo");
  }
  else if(strlen($new_password) < 8)
  {
    array_push($errors, "Hasło musi zawierać conajmniej 8 znaków");
  }
  else if(md5($old_password) !== $old_passworddb)
  {
    if (empty($old_password)) {
      array_push($errors, "Wprowadz stare haslo");
    }
    else
    {
    array_push($errors, "Podałeś nieprawidłowe stare hasło");
    }
  }
  else
  {
    $sql_update = "UPDATE rejestracja SET email='$email', haslo='$password_newsafe' WHERE nazwa='$nazwa'";
    mysqli_query($db,$sql_update);
  }
}

?>