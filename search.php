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
        <title>Пошук</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body style="background-color:#f2f4f5">
    <div class="cont">  

<?php include('head-panel.php');
    include("categorysql.php");
    $quer=$_GET['search'];
    $ot=$_GET['ot'];
    $do=$_GET['do'];
?>

<div class="forms form-search">                    
            <div class="row">
                <div class="wrapper">
                    <form class="header-search" method="get">
                        <fieldset class="fieldset">
                            <div class="search-text">
                                <div class="icon"><img src="content/search.png"></div>
                                <div class="search-input-div">
                                    <input class="search-input" autocomplete="off" <?php echo('value="'.$quer.'"') ?> type="text" placeholder="Введіть що ви хочете знайти..." name="search">
                                </div>
                            </div>
                           
                            <span class="s-but-div">
                                <input class="s-but" type="submit" value="Пошук">
                            </span>
                        </fieldset>
                        <div class="filters">
                                <h1 style="margin-top:0;">Фільтри<h1>
                                <select name="category" class="def-input" onchange="getValue(this.value);">
                                <option selected disabled style="display:none;">Оберіть категорію</option>
                                    <?php 
                                    
                                    $active="";
                                    while($category = mysqli_fetch_array($adres)) {
                                        if($cat==$category['id_cat']){
                                            $active="selected";
                                        }
                                            echo('<option value="'.$category['id_cat'].'"'.$active.'>'.$category['name_cat']."</option>");
                                            $active="";

                                    }?>
                                </select>
                                <select name="subcategory" class="def-input" id="sub">
                                <option selected disabled style="display:none;">Оберіть підкатегорію</option>
                                    <?php while($scategory = mysqli_fetch_array($subcategory)) {
                                        if($cat!=$scategory['id_cat']){
                                            $active="hidden";
                                        }
                                        echo('<option class="'.$scategory['id_cat'].'" value="'.$scategory['id_sub'].'"'.$active.'>'.$scategory['name_sub']."</option>");
                                        $active="";
                                    }?>
                                </select>
                                <input type="number" class="def-input" <?php echo('value="'.$ot.'"') ?> name="ot" placeholder="Від" style="width:80px;">
                                <input type="text" class="def-input" <?php echo('value="'.$do.'"') ?> name="do" placeholder="До" style="width:80px;">
                                <select name="stan" class="def-input">
                                    <option selected disabled style="display:none;">Стан</option>
                                    <option value="new">Новий</option>
                                    <option value="bv">Б/В</option>
                                </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="in-div">
            <h2 style="color:#002e34;">Оголошення</h2>

            <?php 
                if($ot==""){
                    $ot=0;
                }
                if($do==""){
                    $do=1000000;
                }
                                                 if(empty($_GET['category'])){

                                                    $quer = trim($quer); 
                                                    $quer = mysqli_real_escape_string($conn,$quer);
                                                    $quer = htmlspecialchars($quer);
                                                    $category = $_GET['category'];
                                                    
                                                    $subcategory = $_GET['subcategory'];
                                                    if($quer!=""&&$category==""&&$subcategory==""){
                                                        $query = "SELECT * FROM `ogoloshennya` 
                                                        JOIN `category` ON `ogoloshennya`.id_cat = `category`.id_cat 
                                                        JOIN `subcategory` on `ogoloshennya`.id_subcat = `subcategory`.id_sub
                                                        WHERE `ogoloshennya`.opis LIKE '%$quer%' 
                                                        OR `category`.name_cat LIKE '%$quer%'
                                                        OR `subcategory`.name_sub LIKE '%$quer%'
                                                        or `ogoloshennya`.name LIKE '%$quer%'
                                                    
                                                        ";
                                                    }
    
                                                    else{
                                                        $query = "SELECT * FROM `ogoloshennya` 
                                                        JOIN `category` ON `ogoloshennya`.id_cat = `category`.id_cat 
                                                        JOIN `subcategory` on `ogoloshennya`.id_subcat = `subcategory`.id_sub
                                                        WHERE `ogoloshennya`.price >='$ot'
                                                        and `ogoloshennya`.price <='$do' and
                                                        `ogoloshennya`.id_cat = '$category' and
                                                        `ogoloshennya`.id_subcat = '$subcategory' and
                                                        (`ogoloshennya`.opis LIKE '%$quer%' 
                                                        OR `category`.name_cat LIKE '%$quer%'
                                                        OR `subcategory`.name_sub LIKE '%$quer%'
                                                        or `ogoloshennya`.name LIKE '%$quer%')
                                                    
                                                        " ;
                                                        
                                                    }

                                                                                                          $res = mysqli_query($conn,$query) or die(mysqli_error($conn));
                                                                                                          while($row = mysqli_fetch_array($res)){
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
                                                                                                             $images = explode(",", $row['id_photo']);
                                                                                                              echo("
                                                                                                              <div class=\"line-og\">
                                                                                                              <div class=\"image-div\">
                                                                                                              ");
                                                                                                              if($images[0]=="./content/image/"){
                                                                                                                  echo("<img class=\"line-img\" src=\"content/no-image.png\">");
                                                                                                              }
                                                                                                              else{
                                                                                                                  echo("<img class=\"line-img\" src=\"".$images[0]."\">");
                                                                                                              }
                                                                                                              echo("</div>
                                                                                                              <div class=\"div-flex\">
                                                                                                                  <a class=\"line-head\" href=\"ogoloshennya.php?paramid=".$row["id"]."\"><strong>".$row["name"]."</strong></a>
                                                                                                                  <p class=\"line-under\">".$since_row."</p>
                                                                                                              </div>
                                                                                                              <span class=\"line-price\">".$row["price"]." грн</span>
                                                                                                          </div>
                                                                                                              ");

                                                                                                          }
                                                 }
                                                 else if(!empty($_GET['category'])) {
                                                    $quer = trim($quer); 
                                                    $quer = mysqli_real_escape_string($conn,$quer);
                                                    $quer = htmlspecialchars($quer);
                                                    $category = $_GET['category'];
                                                    
                                                    $subcategory = $_GET['subcategory'];

                                                    if($quer==""&&$category!=""&&$subcategory==""){
                                                        $query = "SELECT * FROM `ogoloshennya` 
                                                        JOIN `category` ON `ogoloshennya`.id_cat = `category`.id_cat 
                                                        JOIN `subcategory` on `ogoloshennya`.id_subcat = `subcategory`.id_sub
                                                        WHERE `ogoloshennya`.id_cat = ".$category.
                                                        "";
                                                        
                                                    }
                                                    if($quer==""&&$category!=""&&$subcategory==!""){
                                                        $query = "SELECT * FROM `ogoloshennya` 
                                                        JOIN `category` ON `ogoloshennya`.id_cat = `category`.id_cat 
                                                        JOIN `subcategory` on `ogoloshennya`.id_subcat = `subcategory`.id_sub
                                                        WHERE `ogoloshennya`.id_subcat='$subcategory' and `ogoloshennya`.id_cat = ".$category.
                                                        " ";
                                                        
                                                    }
                                                    $res = mysqli_query($conn,$query) or die(mysqli_error($conn));
                                                        while($row = mysqli_fetch_array($res)){
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
                                                            $images = explode(",", $row['id_photo']);
                                                            echo("
                                                            <div class=\"line-og\">
                                                            <div class=\"image-div\">
                                                            ");
                                                            if($images[0]=="./content/image/"){
                                                                echo("<img class=\"line-img\" src=\"content/no-image.png\">");
                                                            }
                                                            else{
                                                                echo("<img class=\"line-img\" src=\"".$images[0]."\">");
                                                            }
                                                            echo("</div>
                                                            <div class=\"div-flex\">
                                                                <a class=\"line-head\" href=\"ogoloshennya.php?paramid=".$row["id"]."\"><strong>".$row["name"]."</strong></a>
                                                                <p class=\"line-under\">".$since_row."</p>
                                                            </div>
                                                            <span class=\"line-price\">".$row["price"]." грн</span>
                                                        </div>
                                                            ");

                                                                                                          
                                                 }
                                                }
                                                
                                            
                                                 

                                                 

                                                      ?>
        </div>
        </div>
        <?php include("footer.php"); ?>
        <?php
                    if(isset($_GET['s-but'])){
                        $s_row=$_GET['s-field'];
                    }
                ?>

                <script>

                function getValue(value) {
                    var options = document.getElementById("sub").options;
                    var counter=0;
                    for(var i=0;i<options.length;i++){
                        options[i].removeAttribute("hidden");
                        options[i].removeAttribute("selected");
                        if(!options[i].classList.contains(value)){
                            options[i].setAttribute("hidden","hidden");
                        }
                        else{
                            if(counter==0){
                                options[i].setAttribute("selected","selected");
                                counter++;
                            }
                        }
                    }
                    counter=0;
                }
            </script>