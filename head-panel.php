
<div id="header">
    <div class="inner">
        <div style="padding-top:10px;padding-left:10px;width:100px;float:left;"><a href="index.php" style="font-size:40px;color black;">I C T</a></div>
        <div class="right">
            <?php
                if(isset($_POST['logout'])) {
                    unset($_SESSION['userid']);
                    //header("Location: /index.php");
                    header("Refresh: 0");
                }
                if(isset($_SESSION['userid'])) {
                    $uid = $_SESSION['userid'];
                    $query = "SELECT * FROM `user` WHERE `id` = ".$uid;
                    $result = mysqli_query($conn,$query) or die(mysql_error());
                    $row = mysqli_fetch_array($result);
                    if($row['userstatus_id']==1){

                        echo('
                        <a class="profile" href="/add_cat.php" class="hover">Додати категорію</a>
                      ');
                    }

                    echo('
                          <a class="profile" href="/profile.php?id='.$_SESSION['userid'].'" class="hover">'.$row['email'].'</a>
                          <form action="" method="POST">
                          <input class="btn" name="logout" type="submit" value="">
                          </form>
                          <a class="add" href="add.php">Додати оголошення</a>
                        ');
                } 
                else {
                    echo('
                          <a class="profile" href="auth.php" class="hover">Мій профіль</a>
                          <a class="add" href="auth.php">Додати оголошення</a>
                        ');
                }
            ?>
        </div>
    </div>
</div>