<?php
  if (isset($_POST["sbmt_btn"])){
        $_POST["phone"]=preg_replace("/[^+0-9]/","",$_POST['phone']);
        $_POST["passport"]=preg_replace("/[^0-9]/","",$_POST['passport']);
        $passwrd=md5($_POST['password']);
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $query="insert into opbd6.jobless (joblessaddress, joblesslastname, 
                                joblessphone, joblesspassport, workexperience,
                                joblessfirstname, joblessmiddlename,username,password)
              values (
        '$_POST[address]',
        '$_POST[last_name]',
        '$_POST[phone]',
        '$_POST[passport]',
        $_POST[exp],
        '$_POST[first_name]',
        '$_POST[middle_name]',
        '$_POST[username]',
        '$passwrd');";
        $result=pg_query($db,$query);
        pg_close($db);
        header("Location:joblessList.php");
  }  
    require 'home.php';
?>

<!DOCTYPE 'html'>
<head>
<title>Jobless</title>
</head>
<form method="POST">
<div class="card text-center w-50 ml-auto mr-auto">
    <h3>Создание безработного</h3>
    <div class="font-weight-bold">Никнейм</div>
    <input id="username" onkeyup="username_checker(this)" onblur="check_exist_user()" type="text" name="username" required="true" class="form-control w-25 ml-auto mr-auto">
    <div class="font-weight-bold">Пароль</div>
    <input id="password" type="password" name="password" required="true" class="form-control w-25 ml-auto mr-auto">
    <div class="form-row w-50 ml-auto mr-auto">
      <div class="col">
        <div class="font-weight-bold">Фамилия</div>
        <input class="form-control" type="text" id="last_name" name="last_name" required=true>
      </div>
      <div class="col">
        <div class="font-weight-bold">Имя</div>
        <input class="form-control" type="text" id="first_name" name="first_name" required=true>
      </div>
    </div>
    <div class="font-weight-bold">Отчество</div>
    <input class="form-control w-25 ml-auto mr-auto" type="text" id="middle_name" name="middle_name" required=false>
    <div class="font-weight-bold">Номер телефона</div>
    <input class="form-control w-25 ml-auto mr-auto" type="tel" id="phone" name="phone" required=true>
    <div class="font-weight-bold">Адрес</div>
    <input class="form-control w-25 ml-auto mr-auto" type="text" name="address" required=false>
    <div class="font-weight-bold">Паспорт</div>
    <input class="form-control w-25 ml-auto mr-auto" type="text" id="passport" name="passport" required=true>
    <div class="font-weight-bold">Опыт работы</div>
    <input class="form-control w-25 ml-auto mr-auto" type="text" name="exp" onkeyup="positive_checker(this,100)" required=true><br>
    <input id="create_user" class="btn w-25 ml-auto mr-auto" type="submit" value="Создать" name="sbmt_btn">
</div>
</form>
<script>
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
