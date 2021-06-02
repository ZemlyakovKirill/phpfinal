<?php 
if(isset($_POST['submit']) && trim($_POST['submit']) != ''){
    $_POST["phone"]=preg_replace("/[^+0-9]/","",$_POST['phone']);
    $_POST["passport"]=preg_replace("/[^0-9]/","",$_POST['passport']);
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $passwrd=md5($_POST['password']);
    $query="insert into opbd6.jobless (joblessaddress, joblesslastname, 
                                joblessphone, joblesspassport, workexperience,
                                joblessfirstname, joblessmiddlename,username,password)
    values (
    '$_POST[address]',
    '$_POST[last_name]',
    '$_POST[phone]',
    '$_POST[passport]',
    $_POST[workexperience],
    '$_POST[first_name]',
    '$_POST[middle_name]',
    '$_POST[username]',
    '$passwrd');";
    $result=pg_query($db,$query);
    pg_close($db);
    header('Location: login.php');
}
require 'home.php';
?>
<form method="POST" id="reg_form">
    <ul class="list-group ml-auto mr-auto w-25 text-light">
        <input  id="username" onkeyup="username_checker(this)" onblur="check_exist_user()" type="text" name="username" placeholder="Никнейм" required="true" class="list-group-item">
        <input  id="password" type="password" placeholder="Пароль" name="password" required="true" class="list-group-item">
        <input  id="password2" onkeyup="password_checker(this,'password','create_user')" required="true" type="password" name="password2" placeholder="Повтор пароля" class="list-group-item">
        <input  id="joblesslastname" required="true" type="text" name="last_name" placeholder="Фамилия" class="list-group-item">
        <input  id="joblessfirstname" required="true" type="text" name="first_name" placeholder="Имя" class="list-group-item">
        <input  id="joblessmiddlename" required="true" type="text" name="middle_name" placeholder="Отчество" class="list-group-item">
        <input  id="passport" required="true" type="text" name="passport" placeholder="Паспортные данные" class="list-group-item">
        <input  id="address" required="true" type="text" name="address" placeholder="Адрес проживания" class="list-group-item">
        <input  id="phone" required="true" type="text" name="phone" placeholder="Телефон" class="list-group-item">
        <input  id="workexperience" onkeyup="positive_checker(this,100)"required="true" type="text" name="workexperience" placeholder="Опыт работы" class="list-group-item">
        <input  id="create_user" type="submit" name="submit" value="Создать" class="btn">
    </ul>
</form>
<script>
function username_checker(element){
    element.value=element.value.replace(/[^0-9a-z]/g,"");
}
function check_exist_user(){
    $.get( "./userchck.php",{username:$("#username").val()},function(data){
        if(data){
            $("#create_user").attr('disabled','disabled');
        }
        else{
            $("#create_user").removeAttr('disabled');
        }
    });
    }
</script>