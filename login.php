<?php 
    if(isset($_POST['submit']) && trim($_POST['submit']) != ''){
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $check_user=pg_query($db,"select username,password,is_admin from opbd6.jobless where username='$_POST[username]'");
        $check_user=pg_fetch_assoc($check_user);
        if($check_user){
            if($check_user['password']==md5($_POST['password']))
            {
                $time_log=date("y-m-d h:m:s");
                pg_query($db,"insert into opbd6.auth_log(username,address,date) values('$check_user[username]','$_SERVER[REMOTE_ADDR]','$time_log')");
                setcookie("login",$check_user['username'],time()+60*60*24);
                setcookie("admin",($check_user['is_admin']=='t')?"1":"0",time()+60*60*24);
                setcookie("auto_log_in","0",time()+60*60*24);
                header('Location:home.php');
            }else{
                echo "<div class='alert alert-danger ml-auto mr-auto w-25' role=alert>
                <strong>Ошибка: </strong>Неверное имя пользователя или пароль</div>";
            }
        }
        else{
            echo "<div class='alert alert-danger ml-auto mr-auto w-25' role=alert>
            <strong>Ошибка: </strong>Неверное имя пользователя или пароль</div>";
        }
    }
    require 'home.php';
?>
<form method="POST">
    <ul class="list-group ml-auto mr-auto w-25 text-light">
        <input  id="username" onkeyup="username_checker(this)" type="text" name="username" placeholder="Никнейм" required="true" class="list-group-item">
        <input  id="password" type="password" placeholder="Пароль" name="password" required="true" class="list-group-item">
        <input  id="log_in" type="submit" name="submit" value="Войти" class="btn">
        <a href="registration.php" class="list-group-item text-center">Зарегистрироваться</a>
    </ul>
</form>