<?php
  ob_start();
  session_start();
  header("Content-Type: text/html; charset=utf-8");
  include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Реєстрація</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
            <!--
        <div id="header">
            <div class="inner">
                <a href="index.php"><img class="logo" src="content/1.png"></a>
                <div class="right">
                     <a class="profile" href="auth.php" class="hover">Мій профіль</a>
                     <a class="add" href="#">Додати оголошення</a>
                    </div>
            </div>
-->
<div class="cont">
<?php include('head-panel.php'); ?>

            <div class="forms">
                    
                <div class="rightf">
                    <div class="nazva"><h2>Реєстрація</h2></div>
                        <form action="" class="ogol" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                        <div class="left-bar">
                                                <div class="div"><label class="label" for="input1">Ім'я</label><br></div>
                                                <div class="div"><label class="label" for="input2">Номер мобільного</label><br></div>
                                                <div class="div"><label class="label" for="input3">e-mail</label><br></div>
                                                <div class="div"><label class="label" for="input4">Пароль</label><br></div>  
                                                <div class="div"><label class="label" for="input4">Повторіть пароль</label><br></div>                     
                                        </div>
                                        <div class="right-bar">
                                                <input type="text" name="user-fullname" class="input select-text bot" required placeholder="Введіть ім'я"><br>
                                                <input type="text" name="user-phone" class="input input2 select-text" required placeholder="Введіть номер мобільного"><br>
                                                <input type="email" name="user-email" class="input input3 select-text" required placeholder="Введіть e-mail"><br>
                                                <input type="password" name="user-password" class="input input4 select-text" required placeholder="Введіть пароль"><br>
                                                <input type="password" name="user-password-r" class="input input4 select-text" required placeholder="Повторіть пароль"><br>
                                                <input type="submit" name="user-reg" class="submit" value="Реєстрація"><br>
                                        </div>
                                    </div>
                        </form>
                </div>
            
           
        </div>
        <div>
        </div>
        </div>
        <?php include("footer.php"); ?>
    </body>

<?php
if(isset($_POST['user-reg'])) {
        $username = $_POST['user-fullname'];
        $userphone = $_POST['user-phone'];
        $usermail = $_POST['user-email'];
        $userpass = $_POST['user-password'];
        $userpass_r = $_POST['user-password-r'];
        $today = date("y.m.d");
        if($userpass_r==$userpass){
            $query = "INSERT INTO `user` (`fullname`, `email`, `password`, `phone`, `userstatus_id`,`since`) 
            VALUES ('$username', '$usermail', '$userpass', '$userphone', '3','$today')";
            $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
            echo("<script>alert(\"Вас зареєстровано!\");</script>");
            header("Refresh: 0");
        }
        else{
            echo("<script>alert(\"Паролі не співпадають\");</script>");
        }

        
}
?>