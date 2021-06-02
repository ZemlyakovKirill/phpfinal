<!DOCTYPE 'html'>
<head>
<title>Program</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:programList.php");
        $progid=$_COOKIE['id'];
        $query2="select * from opbd6.educationalprogram where programid=$progid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        if($res2==null)
            header("Location:home.php");
        echo "<br><br><form method=GET>
            <div class='card text-center w-50 ml-auto mr-auto'>
                <h3>Редактирование Программы</h3>
                <div class='font-weight-bold'>Наименование</div>
                <input class='form-control w-25 ml-auto mr-auto' type=text name=name value='$res2[name]' required=true>
                <div class='font-weight-bold'>Дата начала обучения</div>
                <input class='form-control w-25 ml-auto mr-auto' type=date name=startdate required=true value='$res2[startdate]'>
                <div class='font-weight-bold'>Дата окончания обучения</div>
                <input class='form-control w-25 ml-auto mr-auto' type=date name=finishdate required=true value='$res2[finishdate]'>
                <div class='font-weight-bold'>Стоимость обучения</div>
                <input class='form-control w-25 ml-auto mr-auto' type=text name=cost required=true value='$res2[cost]'>
                <div class='font-weight-bold'>Тип</div>
                <input class='form-control w-25 ml-auto mr-auto' type=text name=type required=true value='$res2[type]'><br>
                <input class='btn w-25 ml-auto mr-auto' type=submit value=Обновить name=update_btn>
            </div>
        </form>";
        
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $query3="update opbd6.educationalprogram set(name,startdate,finishdate,cost,type)=(
                    '$_GET[name]',
                    '$_GET[startdate]',
                    '$_GET[finishdate]',
                     $_GET[cost],
                    '$_GET[type]')
                    where programid=$progid;";
                    $res3=pg_query($db,$query3);
                    pg_close($db);
                    header("Location:programList.php");
                }
            }
        }
        require 'home.php';
?>