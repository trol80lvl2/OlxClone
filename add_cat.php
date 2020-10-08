<?php
  ob_start();
  session_start();
  header("Content-Type: text/html; charset=utf-8");
  include('connection.php');

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
    <head>
        <title>Додати категорію</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <?php include('head-panel.php'); ?>
<div>
    <form method="post" style="padding:24px;width:250px;" enctype="multipart/form-data">
        <input class="input input1" class="input input1 " name="cat-name" type="text" style="width:225px;" required placeholder="Назва категорії"><br>
        <input type="file"  class="input file" name="car_images[]"><br>
        <input type="submit" name="edit-ad" class="submit" value="Зберегти" style="width:225px;">
        <a class="profile" href="/add_subcat.php">Додати підкатегорію</a>
    </form>
    
</div>
<?php
    if(isset($_POST['edit-ad'])){
        $imageimg = $_FILES['car_images'];
        if(!empty($imageimg)) {
            $img_desc = reArrayFiles($imageimg);
            foreach($img_desc as $val) {
                move_uploaded_file($val['tmp_name'], './content/image/'.$val['name']);
                $links .= './content/image/'.$val['name'];
            }
        }
        $name=$_POST['cat-name'];
        $query="INSERT INTO `category`(`name_cat`,`img_cat`) VALUES('$name','$links')";
        mysqli_query($conn,$query) or die(mysqli_error($conn));
        header("Refresh:0");
    }

?>