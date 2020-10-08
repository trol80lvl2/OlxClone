<?php
  ob_start();
  session_start();
  header("Content-Type: text/html; charset=utf-8");
  include('connection.php');
  $cat=$_GET["category"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Оголошення</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body style="background-color:#f2f4f5">
        
   <div class="cont">
<?php 
    include('head-panel.php');
    include("categorysql.php");
?>
<div class="forms form-search">                    
<div class="forms form-search">                    
            <div class="row">
                <div class="wrapper">
                    <form class="header-search" method="post">
                        <fieldset class="fieldset">
                            <div class="search-text">
                                <div class="icon"><img src="content/search.png"></div>
                                <div class="search-input-div">
                                    <input class="search-input" autocomplete="off" type="text" placeholder="Введіть що ви хочете знайти..." name="search">
                                </div>
                            </div>
                            <span class="s-but-div">
                                <input class="s-but" name="s-but" type="submit" value="Пошук">
                            </span> 
                            <?php
                                if(isset($_POST['s-but'])){
                                    $search=$_POST['search'];
                                    if($search!="");
                                    
                                    header("Location:search.php?search=".$search."");
                                }
                            ?>
                        </fieldset>
                    </form>
                </div>
            </div>
    <div class="og">

        <div class="og-left">
        <?php
                                      $paramid = $_GET['paramid'];
                                      $query = "SELECT * FROM `ogoloshennya` JOIN `category` ON `ogoloshennya`.id_cat = `category`.id_cat
                                          JOIN `user` ON `ogoloshennya`.id_user = `user`.id
                                          WHERE `ogoloshennya`.id = '$paramid'";
                                      $res = mysqli_query($conn,$query) or die(mysqli_error($conn));
                                      $row = mysqli_fetch_array($res);
                                      $images = explode(",", $row['id_photo']);
                                      $opis = explode("\n",$row["opis"]);
                                      echo("<h1 class=\"description-head\" style=\"margin-top:5px;margin-bottom:15px;\">".$row['name']."</h1>");
                                      for($i = 0; $i < count($images); $i++)
                                        if(strlen($images[$i]) < 10)
                                          unset($images[$i]);
                                          for($i = 0; $i < count($images); $i++) {
                                            if($images[0]=="./content/image/"){
                                                echo("
                                                <div class=\"mySlides\">
                                                  <div class=\"numbertext\">".($i + 1)." / ".count($images)."</div>
                                                  <img src=\"content/no-image.png\" style=\"width:100%; height:427.5px;object-fit: cover;\">
                                                </div>
                                                ");
                                            }
                                            else{
                                                echo("
                                                <div class=\"mySlides\">
                                                  <div class=\"numbertext\">".($i + 1)." / ".count($images)."</div>
                                                  <img src=\"".$images[$i]."\" style=\"width:100%; height:427.5px;object-fit: cover;\">
                                                </div>
                                                ");
                                            }

                                          }
                                          echo("
                                            <a class=\"prev\" onclick=\"plusSlides(-1)\">❮</a>
                                            <a class=\"next\" onclick=\"plusSlides(1)\">❯</a>
                                          ");?>


<?php
$since_row;
$since = explode("-",$row['since']);
switch($since[1]){
    case "01":
        $since_row="січня";
        break;
    case "02":
        $since_row="лютого";
        break;
    case "03":
        $since_row="березня";
        break;
    case "04":
        $since_row="квітня";
        break;
    case "05":
        $since_row="травня";
        break;
    case "06":
        $since_row="червня";
        break;
    case "07":
        $since_row="липня";
        break;
    case "08":
        $since_row="серпня";
        break;
    case "09":
        $since_row="вересня";
        break;
    case "10":
        $since_row="жовтня";
        break;
    case "11":
        $since_row="листопада";
        break;
    case "01":
        $since_row="грудня";
        break;
}

$since_row=$since_row." ".$since[0]." року";

?>

                                
        </div>
        <div class="og-right">
            <div class="pad">
                <div class="og-right-head">Користувач</div>
                <div class="image">
                    <div class="left-div">
                        <img class="og-right-img" src="content/user-img.png">
                    </div>
                    <div class="right-div">
                        <h2 class="og-right-body-name"><?php echo($row['fullname']); ?></h2>
                        <span class="og-right-body-date">на сайті з <?php echo($since_row);?></span>
                    </div>
                </div>
            </div>
            <h3 class="phone"><?php echo($row['email']); ?></h3>
            <h3 class="phone"><?php echo($row['phone']); ?></h3>
            <div class="space"></div>
            <div class="og-another">
            <div class="og-right-head">Інші оголошення автора</div>
            <?php
            $since_row="";
            $since = explode("-",$row['added']);
            switch($since[1]){
                case "01":
                    $since_row= $since[2]." січня";
                    break;
                case "02":
                    $since_row=$since[2]." лютого";
                    break;
                case "03":
                    $since_row=$since[2]." березня";
                    break;
                case "04":
                    $since_row=$since[2]." квітня";
                    break;
                case "05":
                    $since_row=$since[2]." травня";
                    break;
                case "06":
                    $since_row=$since[2]." червня";
                    break;
                case "07":
                    $since_row=$since[2]." липня";
                    break;
                case "08":
                    $since_row=$since[2]." серпня";
                    break;
                case "09":
                    $since_row=$since[2]." вересня";
                    break;
                case "10":
                    $since_row=$since[2]." жовтня";
                    break;
                case "11":
                    $since_row=$since[2]." листопада";
                    break;
                case "01":
                    $since_row=$since[2]." грудня";
                    break;
            }
            $since_row=$since_row." ".$since[0]." року";

                $query="SELECT COUNT(*) FROM `ogoloshennya` as total where id_user =".$row['id_user']."";
                $res = mysqli_query($conn,$query) or die(mysqli_error($conn));
                $data=mysqli_fetch_array($res);
                if($data[0]>0){
                    $query="SELECT * FROM `ogoloshennya` where id !=".$paramid." AND id_user =".$row['id_user']." LIMIT 3";
                    $res = mysqli_query($conn,$query) or die(mysqli_error($conn));
                    while($row = mysqli_fetch_array($res)){
                        $images = explode(",", $row['id_photo']);
                        echo("
                        <div class=\"og-another-og\">
                        <a href=\"ogoloshennya.php?paramid=".$row["id"]."\">
                            <img class=\"og-another-img\" src=\"".$images[0]."\">
                            <h4 class=\"og-another-head\">".$row["name"]."</h4>
                            <h4 class=\"og-another-price\">".$row["price"]." грн</h4>
                        </a>
                    </div>
                        ");
                    }
                }
                ?>     
            </div>
        </div>
        <div class="og-left og-left-2">
            <?php
            echo("
            <h1 class=\"offer-titlebox\">".$row["name"]."</h1>
            <h1 class=\"description-head\">Опис</h1>
            <div class=\"description\">");
            for($i = 0; $i < count($opis); $i++){
                echo($opis[$i]."<br>");
            }
            echo("</div>");

            
            ?>
            

            <div class="og-under">
                <ul class="ul-items">
                    <li class="ul-item">
                        Додано: 
                            <strong><?php echo($since_row);?></strong>
                    </li>
                    <li class="ul-item">
                        Номер оголошення: 
                            <strong><?php echo($paramid); ?></strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
    
    <script src="js/script.js"></script>