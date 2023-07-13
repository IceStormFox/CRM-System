<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'erpsystem');
$errors = array(); 

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    header("Location: login.php");
    exit();
}

if (isset($_POST['register_hours'])) {
    $work_date = mysqli_real_escape_string($db, $_POST['work_date']);
    $hours_worked = mysqli_real_escape_string($db, $_POST['hours_worked']);
    $comment = mysqli_real_escape_string($db, $_POST['komentarz']);
    $username = $_SESSION['username'];
    if ($hours_worked <= 0) {  
        $wiadomosc = "Godziny muszą być większe niż 0.";
        $encoded_wiadomosc = urlencode($wiadomosc); 
        header("Location: index.php?wiadomosc=$encoded_wiadomosc");
    }
    else if (!$work_date) {
        $wiadomosc = "Ustaw poprawną datę.";
        $encoded_wiadomosc = urlencode($wiadomosc); 
        header("Location: index.php?wiadomosc=$encoded_wiadomosc");
    }
    else{
    $query = "INSERT INTO zarejestrowanegodziny (data_pracy, godziny, nazwa, weryfikacja, komentarz) VALUES ('$work_date', '$hours_worked', '$username', 'Do zatwierdzenia', '$comment')";
    mysqli_query($db, $query);
    header("Location: index.php");
    exit();
    }
}

//Akceptacja zaznaczonych godzin
if(isset($_POST['register_accept']))
{
    if ($_POST['checkbox']){
    $sql_acc="UPDATE zarejestrowanegodziny SET weryfikacja='Zaakceptowane' WHERE id={$_POST['checkbox']}";
    mysqli_query($db,$sql_acc);
    $wiadomosc = "Godziny zarejestrowane.";
    $encoded_wiadomosc = urlencode($wiadomosc); 
    header("Location: index.php?wiadomosc=$encoded_wiadomosc");  
    }
    else{
    $wiadomosc = "Zaznacz poprawne dni pracy.";
    $encoded_wiadomosc = urlencode($wiadomosc); 
    header("Location: index.php?wiadomosc=$encoded_wiadomosc");
    }
}
//Odrzucenie zaznaczonych godzin
if(isset($_POST['register_cancel']))
{
    if ($_POST['checkbox']){
    $sql_acc="DELETE FROM zarejestrowanegodziny WHERE id={$_POST['checkbox']}";
    mysqli_query($db,$sql_acc);
    $wiadomosc = "Godziny usunięte.";
    $encoded_wiadomosc = urlencode($wiadomosc); 
    header("Location: index.php?wiadomosc=$encoded_wiadomosc");
    }
    else{
    $wiadomosc = "Zaznacz poprawne dni pracy.";
    $encoded_wiadomosc = urlencode($wiadomosc); 
    header("Location: index.php?wiadomosc=$encoded_wiadomosc");
    }
}


 //Usuwanie godzin z tabelki
if(isset($_POST['register_delete']))
{
  $query = "DELETE FROM zarejestrowanegodziny WHERE nazwa = '{$_POST['delete_name']}'";
  $result = mysqli_query($db, $query);
  header("Location: index.php");
}

if(isset($_POST['profil']))
{
    header("Location: user.php");
}
if(isset($_POST['admin_panel']))
{
    header("Location: admin.php");
}
mysqli_close($db);
?>
