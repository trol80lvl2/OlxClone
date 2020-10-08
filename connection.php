<?php
    header("Content-Type: text/html; charset=utf-8");
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($conn,'olx') or die(mysqli_error());    
?>