<!DOCTYPE 'html'>
<head>
<title>Stipend</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:stipendList.php");
        $stpid=$_COOKIE['id'];
        $query2="select * from opbd6.jobless a join opbd6.stipend b on a.joblessid = b.joblessid where b.stipendid=$stpid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        if($res2==null)
            header("Location:home.php");
        $res3=pg_query($db,"select joblessid,joblesslastname,joblessfirstname,username from opbd6.jobless");
        echo "<br><br><form id=F2 method=GET action=\"\">
            <div class='card text-center w-50 ml-auto mr-auto'>
                <h3>Редактирование Пособия</h3>
                <div class='font-weight-bold'>Безработный</div>
                <select class='form-control w-25 ml-auto mr-auto' name=joblessid>";
                while($row=pg_fetch_row($res3)){
                    if($row[0]==$res2['joblessid'])
                        echo "<option selected value='$row[0]'>[$row[3]] $row[1] $row[2] (this)</option>";
                    else
                        echo "<option value='$row[0]'>[$row[3]] $row[1] $row[2]</option>";
                }
                echo "</select>
                <div class='font-weight-bold'>Величина</div>
                <input type=text onkeyup='positive_checker(this,1000000)' class='form-control w-25 ml-auto mr-auto' name='value' value='$res2[value]' required=true>
                <div class='font-weight-bold'>Дата начала предоставления</div>
                <input class='form-control w-25 ml-auto mr-auto' type=date name=provisionstart required=true value='$res2[provisionstart]'>
                <div class='font-weight-bold'>Дата окончания предоставления</div>
                <input class='form-control w-25 ml-auto mr-auto' type=date name=provisionfin value='$res2[provisionfin]' required=true pattern=[+][0-9]{11}><br>
                <input class='btn w-25 ml-auto mr-auto' type=submit value=Обновить name=update_btn>
            </div>
        </form>";
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $cond['stipendid']=$stpid;
                    $items=$_GET;
                    unset($items['red_btn']);
                    unset($items['update_btn']);
                    $res3=pg_update($db,'opbd6.stipend',$items,$cond);
                    pg_close($db);
                    header("Location:stipendList.php");
                }
            }
        }
        require 'home.php';
?>