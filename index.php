<?php
  ob_start();
  session_start();
  header("Content-Type: text/html; charset=utf-8");
  include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Головна</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>

    <div class="cont">  
<?php include('head-panel.php'); ?>

        <div class="forms form-search">                    
            <div class="row">
                <div class="wrapper">
                    <form class="header-search" method="post">
                        <fieldset class="fieldset">
                            <div class="search-text">
                                <div class="icon"><img src="content/search.png"></div>
                                <div class="search-input-div">
                                    <input class="search-input" name="s-field" autocomplete="off" type="text" placeholder="Введіть що ви хочете знайти..." name="search">
                                </div>
                            </div>
                            <span class="s-but-div">
                                <input class="s-but" type="submit" value="Пошук" name="s-but">
                            </span>
                        </fieldset>
                    </form>
                </div>
                <?php
                    if(isset($_POST['s-but'])&&!empty($_POST['s-field'])){
                        $s_row=$_POST['s-field'];
                        header("location:search.php?search=".$s_row."");
                    }
                ?>
            </div>
            <?php
                include("categorysql.php");
            ?>
            <div class="row rubrika">
                <div class="div-rubrika">
                <?php
                    $i=1;
                	while($category = mysqli_fetch_array($adres)) {
                        echo('<div class="item">
                        <a class="ref" href="search.php?category='.$category['id_cat'].'">
                            <div class="item-div">
                                <img class = "item-pic" src="'.$category['img_cat'].'">
                            </div>
                            <span class="under-pic">'
                                .$category['name_cat'].'
                            </span>
                        </div>
                        </a>
                    ');
                    $i++;
                    }


                ?>
            </div>
        </div>
        </div>
        </div>
        <?php include("footer.php"); ?>
    </body>

    </html>
