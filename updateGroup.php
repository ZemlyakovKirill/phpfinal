<!DOCTYPE 'html'>
<head>
<title>Group</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:groupList.php");
        $grpid=$_COOKIE['id'];
        $query2="select * from opbd6.educationalgroup where groupid=$grpid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        if($res2==null)
            header("Location:home.php");
        $qry_program="select * from opbd6.educationalprogram";
        $res_program=pg_query($db,$qry_program);
        echo "<br><br><form method=GET>
        <div class='card text-center w-50 ml-auto mr-auto'>
                <h3>Редактирование Группы</h3>
                <div class='font-weight-bold'>Программа</div>
                <select class='form-control w-25 ml-auto mr-auto' name=programid required=true>";
                while($row=pg_fetch_assoc($res_program)){
                    if($res2['programid']==$row['programid']){
                        echo "<option selected value='$row[programid]'>$row[name] $row[cost]</option>";
                    }
                    else{
                        echo "<option value='$row[programid]'>$row[name] $row[cost]</option>";
                    }
                }
        echo "</select>
                <div class='font-weight-bold'>Максимальное кол-во студентов</div>
                <input class='form-control w-25 ml-auto mr-auto' type=text onkeyup='positive_checker(this,10000)' name=maxquantitystudents required=true value='$res2[maxquantitystudents]'><br>
                <input class='btn w-25 ml-auto mr-auto' type=submit value=Обновить name=update_btn>
            </div>
        </form>";
        
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $query3="update opbd6.educationalgroup set(programid,maxquantitystudents,studentcount)=(
                     $_GET[programid],
                     $_GET[maxquantitystudents],
                     0)
                    where groupid=$grpid;";
                    $res3=pg_query($db,$query3);
                    pg_close($db);
                    header("Location:groupList.php");
                }
            }
        }
        require 'home.php';
?>