<?php
  ob_start();
  session_start();
  header("Content-Type: text/html; charset=utf-8");
  include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Авторищація</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
    <div class="cont">
    <?php include('head-panel.php'); ?>
            <div class="forms">
                    
                <div class="rightf">
                    <div class="nazva"><h2>Вхід</h2></div>
                        <form action="" class="ogol" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                        <div class="left-bar">
                                                <div class="div"><label class="label" for="input1">e-mail</label><br></div>
                                                <div class="div"><label class="label" for="input2">Пароль</label><br></div>                    
                                        </div>
                                        <div class="right-bar">
                                            <div class="vir">
                                                <input type="text" name="user-email" class="input input1 select-text" required placeholder="Введіть e-mail"><br>
                                                <input type="password" name="user-password" class="input input2 select-text" required placeholder="Введіть пароль"><br>
                                                <input type="submit" name="user-auth" class="submit width" value="Увійти"><br>
                                                <a class="reg-a" href="registration.php" class="hover">Зареєструватись</a>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                </div>

        </div>
            </div>
            <?php include("footer.php"); ?>
    </body>

<?php
if(isset($_POST['user-auth'])) {
        $usermail = $_POST['user-email'];
        $userpass = $_POST['user-password'];

        $query = "SELECT * FROM `user` WHERE `email` = '$usermail' AND `password` = '$userpass'";
        $result = mysqli_query($conn,$query) or die(mysql_error($conn));
        if($row = mysqli_fetch_array($result)) {
            $_SESSION['userid'] = $row['id'];
            header("Location: /index.php");
        }
        else {
            //front-endschik will make error
            echo("<script>alert(\"Неправильний логін чи пароль!\");</script>");
        }
}
?>