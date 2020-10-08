<?php
  ob_start();
  session_start();
  header("Content-Type: text/html; charset=utf-8");
  include('connection.php');
  $query="DELETE FROM `ogoloshennya` where id=".$_GET['paramid'];
  mysqli_query($conn,$query);
  header("Location:profile.php");
?>