<?php include('server.php');
include('days_to_accept.php') ?>

<?php
if ($_SESSION['role'] < 2) {
    header('location: index.php');
}
if(isset($_POST['delete_user']))
{
    if ($_POST['checkboxadmin']){
    $sql_acc="DELETE FROM rejestracja WHERE id={$_POST['checkboxadmin']}";
    mysqli_query($db,$sql_acc);
    header("Location: admin.php");
    }
    else{
    header("Location: admin.php");
    }
}
if(isset($_POST['modify_role']))
{
    if ($_POST['checkboxadmin'] && $_POST['role_user'] != ""){
    $sql_acc="UPDATE rejestracja SET rola={$_POST['role_user']} WHERE id={$_POST['checkboxadmin']}";
    mysqli_query($db,$sql_acc);
    header("Location: admin.php");
    }
    else{
    header("Location: admin.php");
    }
}
if(isset($_POST['modify_name']))
{
    if ($_POST['checkboxadmin'] && $_POST['name_user'] != ""){
    $sql_acc="UPDATE rejestracja SET nazwa='{$_POST['name_user']}' WHERE id={$_POST['checkboxadmin']}";
    mysqli_query($db,$sql_acc);
    header("Location: admin.php");
    }
    else{
    header("Location: admin.php");
    }
}
if(isset($_POST['modify_email']))
{
    if ($_POST['checkboxadmin'] && $_POST['email_user'] != ""){
    $sql_acc="UPDATE rejestracja SET email='{$_POST['email_user']}' WHERE id={$_POST['checkboxadmin']}";
    mysqli_query($db,$sql_acc);
    header("Location: admin.php");
    }
    else{
    header("Location: admin.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Administratora</title>
    <link rel="stylesheet" type="text/css" href="style_panel_admin.css"/>
</head>
<body>
  <?php
  ?>
<div class="calendarLook">
  <div class="header">
    <h2>Panel Administratora<img class="logo" src="Icons/logo.png"></h2> 
    <form action="register_hours.php" method="post">
    <div class="submitStyle">
      <input type="button" onclick="window.location.href='index.php';" value="Powrót na stronę główną">
    </div>
    
    </form>
  </div>
    <div class="tableContent">
      
    </div>
  <div class="calendarLow">
    <div class="registerBox">
      <h3 class="registerHeader">Wyszukiwanie użytkowników</h3>     
    </div>
  </div>
  <div class="adminPanel">
    <form method="POST" action="admin.php">
      <input type="text" placeholder="Wyszukaj użytkownika" id="search_user" name="search_user">
      <input type="submit" name="search_user_button" value="Szukaj">
      <input type="submit" name="all_user" value="Wyczyść tabelę">
    </form>
    <br>
  </div>
  <div class="adminPanel"> 
  <form method="POST" action="admin.php">
    <?php
      if(isset($_POST['search_user_button']))
      {
        $sql = "SELECT * FROM Rejestracja WHERE nazwa='{$_POST['search_user']}'";
        $query = mysqli_query($db, $sql);
        echo draw_admintable($query);
      }
      else if(isset($_POST['all_user']))
      {
        $sql = "SELECT * FROM Rejestracja WHERE id=0";
        $query = mysqli_query($db, $sql);
        echo draw_admintable($query);
      }
      else
      {
        $sql = "SELECT * FROM Rejestracja";
        $query = mysqli_query($db, $sql);
        echo draw_admintable($query);
      }
      ?>
      <input type="submit" name="delete_user" value="Usuń">
      <br>
      <input type="text" placeholder="Nowa rola użytkownika" id="role_user" name="role_user">
      <input type="submit" name="modify_role" value="Zmień rolę">
      <br>
      <input type="text" placeholder="Nowy email użytkownika" id="email_user" name="email_user">
      <input type="submit" name="modify_email" value="Zmień email">
      <br>
      <input type="text" placeholder="Nowa nazwa użytkownika" id="name_user" name="name_user">
      <input type="submit" name="modify_name" value="Zmień nazwę">
    </form>
  </div>
</div>

</body>
</html>