<?php
  ob_start();
  session_start();
  header("Content-Type: text/html; charset=utf-8");
  include('connection.php');

  $query = "SELECT * FROM `ogoloshennya` where id=".$_GET['paramid'];
  $rowchik = mysqli_fetch_array(mysqli_query($conn,$query));
  function reArrayFiles($file)
  {
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    for($i=0;$i<$file_count;$i++)
      foreach($file_key as $val)
        $file_ary[$i][$val] = $file[$val][$i];
    return $file_ary;

  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Редагування</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
    <div class="cont">
        <?php include('head-panel.php'); ?>

            <div class="forms">  
                <div class="rightf">
                    <div class="nazva"><h2>Подача оголошення на нашому сайті</h2></div>
                        <form action="" class="ogol" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                        <div class="left-bar">
                                                <div class="div"><label class="label" for="input">Заголовок</label><br></div>
                                                <div class="div"><label class="label" for="input">Рубрика</label><br></div>
                                                <div class="div"><label class="label" for="input">Підрубрика</label><br></div>
                                                <div class="div"><label class="label" for="input">Ціна</label><br></div>
                                                <div class="div"><label class="label" for="input">Стан</label><br></div>
                                                <div class="div"><label class="label" for="textarea">Опис</label><br></div>
                                        </div>
                                        <div class="right-bar">
                                                <input type="text" name="ad-name" class="input input1 " value="<?php echo($rowchik['name']);?>" required placeholder="Введіть заголовок оголошення"><br>
                                                <select  onchange="getValue(this.value);" name="category" class="input input2 select select-text bot" required>
                                                <option value="" disabled selected style="display: none;">Виберіть категорію</option>
                                                    <?php 
                                                        $query = "SELECT * FROM `category` where id_cat=".$rowchik['id_cat'];
                                                        $rowcat = mysqli_fetch_array(mysqli_query($conn,$query));
                                                        echo("<option style=\"display:none;\" selected value=\"".$rowcat['id_cat']."\">".$rowcat['name_cat']."</option>");
					                                    $query = "SELECT `id_cat`, `name_cat` FROM `category`";
					                                    $res = mysqli_query($conn,$query) or die(mysql_error($conn));
					                                    while($row = mysqli_fetch_array($res)) {
						                                    echo("<option value=\"".$row['id_cat']."\">".$row['name_cat']."</option>");
					                                    }
			                                        ?>
                                                </select><br>
                                                <!-- TODO: MAKE SIMPLY INPUT TEXT WITH CHECKING DB -->
                                                <select id="sub" name="subcategory" class="input input2 select select-text bot" required>
                                                <option value="" disabled selected style="display: none;">Виберіть підкатегорію</option>
                                                    <?php 
                                                        $query = "SELECT * FROM `subcategory` where id_sub=".$rowchik['id_subcat'];
                                                        $rowcat = mysqli_fetch_array(mysqli_query($conn,$query));
                                                        echo("<option style=\"display:none;\" selected value=\"".$rowcat['id_sub']."\">".$rowcat['name_sub']."</option>");
					                                    $query = "SELECT * FROM `subcategory`";
					                                    $res = mysqli_query($conn,$query) or die(mysql_error($conn));
                                                        while($scategory = mysqli_fetch_array($res)) {
                                                            echo('<option class="'.$scategory['id_cat'].'" value="'.$scategory['id_sub'].'">'.$scategory['name_sub']."</option>");
                                                        }
			                                        ?>
                                                    </select><br>
                                                    
                                                <input type="number" step="1" name="price" class="input input4" value="<?php echo($rowchik['price']);?>" required placeholder="Ціна"><br>
                                                
                                                <input type="radio" name="stan" value="bv" <?php if($rowchik['stan']=="bv")  echo("checked"); else echo("");  ?>  required>Б/В<br>
                                                <input type="radio" name="stan" value ="new" <?php if($rowchik['stan']=="new")  echo("checked"); else echo("");  ?>  required>Новий<br>
                                                <textarea type="textarea" name="ad-about" value="" class="input input19" required placeholder="Опис оголошення..."><?php echo($rowchik['opis']);?></textarea><br>
                                                <input type="file"  class="input file" name="car_images[]" multiple><br>
                                                <input type="submit" name="edit-ad" class="submit" value="Зберегти"><br>
                                        </div>
                                    </div>
                            </form>
                </div>
            </div>
            </div>
            <?php include("footer.php"); ?>

</body>

<?php 

if(isset($_POST['edit-ad'])) {
    $links=$rowchik['id_photo'];
  $imageimg = $_FILES['car_images'];
  if(!empty($imageimg)) {
    $img_desc = reArrayFiles($imageimg);
    foreach($img_desc as $val) {
      move_uploaded_file($val['tmp_name'], './content/image/'.$val['name']);
      $links .= './content/image/'.$val['name'].', ';
    }
  }
    $adname = mysql_escape_string($_POST['ad-name']);
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $price = $_POST['price'];
    $stan = $_POST['stan'];
    $opis = mysql_escape_string($_POST['ad-about']);
    
    $today = date("y.m.d");
    $sellerid = $_SESSION['userid'];

    $query = "UPDATE `ogoloshennya` SET `id_cat` = $category, `id_subcat` = $subcategory,  `name` = '$adname', `opis` =  '$opis', `price`=$price,`added`='$today',`id_photo`='$links',`stan`='$stan' where `id`=".$rowchik['id'];
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));


    echo("<script>alert(\"Оголошення буде розглянуто модератором!\");</script>");
    header("Location: /index.php");
  
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