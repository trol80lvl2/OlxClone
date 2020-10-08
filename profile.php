<?php
  ob_start();
  session_start();
  header("Content-Type: text/html; charset=utf-8");
  include('connection.php');
  if($_SESSION['userid']==""){
      header("Location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Профіль</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body style="background-color:#f2f4f5">
        <div class="cont">
   
<?php 
    include('head-panel.php');
    include("categorysql.php");
?>
<div style="width:100%;background-color:white; height:100px;" >
    <div class="under-head">
        <h2 style="font-size: 32px; font-weight: 500; line-height: 1.06;padding-top:30px;">Оголошення</h2>
    </div>
</div>
<div style="width:1092px; margin:0 auto;">
<?php

$query="SELECT * FROM `ogoloshennya` where  id_user =".$_SESSION['userid']."";
                    $res = mysqli_query($conn,$query) or die(mysqli_error($conn));
                    while($row = mysqli_fetch_array($res)){
                        $images = explode(",", $row['id_photo']);
                        echo("
                        <div class=\"ig-another-og\">
                        <a href=\"ogoloshennya.php?paramid=".$row["id"]."\">
                        
                        <a href=\"delete.php?paramid=".$row['id']."\"><img src=\"content/cross.png\" style=\" width:20px; height:20px; float:right; margin-top:3px; margin-right:3px;\"></a>
                        <a href=\"edit.php?paramid=".$row['id']."\"><img src=\"content/edit.png\" style=\" width:20px; height:20px; float:right; margin-top:3px; margin-right:3px;\"></a><br>
                        <h4 class=\"ig-another-head\">".$row["name"]."</h4>");
                        if($images[0]=="./content/image/"){
                            echo("<img class=\"line-img\" src=\"content/no-image.png\">");
                        }
                        else{
                            echo("<img class=\"line-img\" src=\"".$images[0]."\">");
                        }
                            
                           echo( "<h4 class=\"ig-another-price\">".$row["price"]." грн</h4>
                        </a>
                    </div>
                        ");
                    }
                        ?>
    </div>
    </div>
    <?php include("footer.php"); ?>