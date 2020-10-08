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
        <title>Додати підкатегорію</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <?php include('head-panel.php'); ?>
<div>
    <form method="post" style="padding:24px;width:250px;" enctype="multipart/form-data">
        <input class="input input1" class="input input1 " name="cat-name" type="text" style="width:225px;" required placeholder="Назва підкатегорії"><br>
        <select class="input input1" name="cat" style="width:225px;" required>
        <?php
            $query="SELECT * FROM `category`";
            $res = mysqli_query($conn,$query) or die(mysql_error($conn));
            while($row = mysqli_fetch_array($res)) {
                echo("<option value=\"".$row['id_cat']."\">".$row['name_cat']."</option>");
            }
        ?>
        </select>
        <input type="submit" name="edit-ad" class="submit" value="Зберегти" style="width:225px;">
    </form>
    
</div>
<?php
    if(isset($_POST['edit-ad'])){
        $name=$_POST['cat-name'];
        $cat=$_POST['cat'];
        $query="INSERT INTO `subcategory`(`name_sub`,`id_cat`) VALUES('$name','$cat')";
        mysqli_query($conn,$query) or die(mysqli_error($conn));
        header("Refresh:0");
    }

?>