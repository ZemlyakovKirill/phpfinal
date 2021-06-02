<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query_group="select * from opbd6.educationalprogram";
    $res=pg_query($db,$query_group);
    if (isset($_GET["sbmt_btn"])){
        $items=$_GET;
        unset($items['sbmt_btn']);
        $query_id="select max(groupid)+1 as maxid from opbd6.educationalgroup";
        $id=pg_query($db,$query_id);
        $items['studentcount']=0;
        $id=pg_fetch_assoc($id);
        $items['groupid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.educationalgroup',$items);
        pg_close($db);
        header("Location:groupList.php");
    }
    require 'home.php';  
?>
<!DOCTYPE 'html'>
<head>
<title>Group</title>
</head>
<form method="GET">
<div class="card text-center w-50 ml-auto mr-auto">
    <h3>Создание группы</h3>
    <div class='font-weight-bold'>Образовательная группа</div>
    <select class='form-control w-25 ml-auto mr-auto' name="programid" required=true>
    <?php
        while($row=pg_fetch_assoc($res)){
            echo "<option value='$row[programid]'>$row[name] $row[cost]</option>";
        }
    ?>
    </select>
    <div class='font-weight-bold'>Максимальное кол-во студентов</div>
    <input class='form-control w-25 ml-auto mr-auto' type="text" onkeyup='positive_checker(this,10000)' name="maxquantitystudents" required=true><br>
    <input class='btn w-25 ml-auto mr-auto' type="submit" value="Создать" name="sbmt_btn">
</div>
</form>
