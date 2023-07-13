<?php include('server.php');
        include('calendar.php');
        include('days_to_accept.php');
        include('errors.php');?>

<?php
 
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

if (isset($_GET['wiadomosc'])) {
  $wiadomosc = urldecode($_GET['wiadomosc']);
  echo $wiadomosc;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Rejestracja godzin</title>
    <link rel="stylesheet" type="text/css" href="style_calendar.css"/>
</head>
<body>
<div class="calendarLook">
  <div class="header">
    <h2>Rejestracja godzin<img class="logo" src="Icons/logo.png"></h2> 
    <form action="register_hours.php" method="post">
    <div class="submitStyle">
        <input type=submit name="logout" value="Wyloguj">
    </div>
    <div class="submitStyle">
        <input type=submit name="profil" value="Profil">
    </div>
    </form>
  </div>
    <div class="tableContent">
      <?php  
        $sql = "SELECT * FROM ZarejestrowaneGodziny WHERE nazwa = '{$_SESSION['username']}'";
        $query = mysqli_query($db, $sql);
        $work_hours = [0 => 0];
        $statuses = [0 => 0];
        while($row = mysqli_fetch_array($query)) {
          $timestamp = substr($row['3'], strrpos($row['3'], '-') + 1);
          $status = $row['weryfikacja'];
          if (substr($timestamp, 0, 1) === '0') {
            $timestamp = substr($timestamp, 1);
        }
          $work_hours += [
            $timestamp => $row['2']
          ];
          $statuses += [
            $timestamp => $status
          ];
        }
        echo draw_calendar(date("m"), date("y"), $work_hours, $statuses);
      ?>
    </div>
  <div class="calendarLow">
    <div class="registerBox">
      <h3 class="registerHeader">Rejestracja godzin</h3>
        <div class="dateStyle">
          <form action="register_hours.php" method="post">
            <input type="date" id="work_date" name="work_date"><br>
        </div>
      <div class="inputStyle">
        <input type="number" placeholder="Ilość godzin" id="hours_worked" name="hours_worked" min="0" max="12" step="1">
      </div>
      <div class="inputStyle">
        <input type="string" placeholder="Komentarz" id="komentarz" name="komentarz">
      </div>
      <div class="submitStyle">
        <input type=submit name="register_hours" value="Zarejestruj">
      </div>
      <?php
      if($_SESSION['role']>=2)
      {
      ?>
      <div class="submitStyle">
        <input type=submit name="admin_panel" value="Panel administratora">
      </div>
      <?php
      }
      ?>
        <div class="deleteHours">
          <h3><?php if($_SESSION['role']>=2){echo'Usuwanie godzin';}?></h3>
        </div>
    </div>
  </div>
  <div class="adminPanel">
    <?php
      if($_SESSION['role']>=2)
      {
      ?>
      <input type="string" placeholder="Użytkownik" id="delete_name" name="delete_name">
      <input type="number" placeholder="Miesiąc" id="delete_month" name="delete_month" min="1" max="12" step="1">
      <input type=submit name="register_delete" value="Usuń godziny" onclick="return confirm('Czy na pewno usunąć wszystkie wizyty?')">
      <?php
      }
      ?>
      <?php
    ?>
    </div>
      </form>
      <div>
      <form method="POST" action="register_hours.php">
    <?php
    if($_SESSION['role']>=1)
    {
        $sqltoacc = "SELECT * FROM ZarejestrowaneGodziny WHERE weryfikacja = 'Do zatwierdzenia' ORDER BY data_pracy ASC";
        $querytoacc = mysqli_query($db, $sqltoacc);
        echo draw_table($querytoacc)
    ?>
    <input type="submit" name="register_accept" value="Zaakceptuj wybrane dni pracy">
    <input type="submit" name="register_cancel" value="Odrzuć wybrane dni pracy">
    <?php
      }
    else{
      $sqltoacc = "SELECT * FROM ZarejestrowaneGodziny WHERE nazwa = '{$_SESSION['username']}' ORDER BY data_pracy ASC";
        $querytoacc = mysqli_query($db, $sqltoacc);
        echo draw_usertable($querytoacc);
    }
    ?>
</form>
    </div>
</div>

</body>
</html>