<title>Jobless</title>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:joblessList.php");
        $jid=$_COOKIE['id'];
        $query2="select * from opbd6.jobless where joblessid=$jid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        if($res2==null)
            header("Location:home.php");
        echo "<br><br><form method='POST'>
        <div class='card text-center w-50 ml-auto mr-auto'>
            <h3>Редактирование безработного</h3>
            <div class='font-weight-bold'>Никнейм</div>
            <input id='username' onkeyup='username_checker(this)' onblur='check_exist_user()' type='text' name='username' value='$res2[username]'  required='true' class='form-control w-25 ml-auto mr-auto'>
            <div class='font-weight-bold'>Пароль</div>
            <input id='password' type='password' name='password' required='true' class='form-control w-25 ml-auto mr-auto'>
            <div class='form-row w-50 ml-auto mr-auto'>
              <div class='col'>
                <div class='font-weight-bold'>Фамилия</div>
                <input class='form-control' type='text' id='last_name' name='last_name' value='$res2[joblesslastname]' required='true'>
              </div>
              <div class='col'>
                <div class='font-weight-bold'>Имя</div>
                <input class='form-control' type='text' id='first_name' value='$res2[joblessfirstname]' name='first_name' required='true'>
              </div>
            </div>
            <div class='font-weight-bold'>Отчество</div>
            <input class='form-control w-25 ml-auto mr-auto' type='text' id='middle_name' value='$res2[joblessmiddlename]' name='middle_name' required='false'>
            <div class='font-weight-bold'>Номер телефона</div>
            <input class='form-control w-25 ml-auto mr-auto' type='tel' id='phone' value='$res2[joblessphone]'  name='phone' required='true'>
            <div class='font-weight-bold'>Адрес</div>
            <input class='form-control w-25 ml-auto mr-auto' type='text' name='address' value='$res2[joblessaddress]'  required='false'>
            <div class='font-weight-bold'>Паспорт</div>
            <input class='form-control w-25 ml-auto mr-auto' type='text' id='passport' value='$res2[joblesspassport]' name='passport' required='true'>
            <div class='font-weight-bold'>Опыт работы</div>
            <input class='form-control w-25 ml-auto mr-auto' type='text' name='exp' onkeyup='positive_checker(this,100)' value='$res2[workexperience]'  required='true'><br>
            <input class='btn w-25 ml-auto mr-auto' type='submit' value='Обновить' name='update_btn'>
        </div>
        </form>";
        if(isset($_POST['update_btn'])){
            if($res2!=null){
                $_POST["phone"]=preg_replace("/[^+0-9]/","",$_POST['phone']);
                $_POST["passport"]=preg_replace("/[^0-9]/","",$_POST['passport']);
                $passwrd=md5($_POST['password']);
                $query3="update opbd6.jobless set(joblessaddress, joblesslastname, 
                joblessphone, joblesspassport, workexperience,
                joblessfirstname, joblessmiddlename,username,password)=(
                '$_POST[address]',
                '$_POST[last_name]',
                '$_POST[phone]',
                '$_POST[passport]',
                $_POST[exp],
                '$_POST[first_name]',
                '$_POST[middle_name]',
                '$_POST[username]',
                '$passwrd')
                where joblessid=$jid;";
            $res3=pg_query($db,$query3);
            pg_close($db);
            header('Location:joblessList.php');
            }
        }
         require 'home.php';
        
?>

