<?php 
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query_jobless="select joblessid,joblesslastname,joblessfirstname,username from opbd6.jobless";
    $res=pg_query($db,$query_jobless);
    if (isset($_GET["sbmt_btn"])){
        $items=$_GET;
        unset($items['sbmt_btn']);
        unset($items['red_btn']);
        $query_id="select max(stipendid)+1 as maxid from opbd6.stipend";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $items['stipendid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.stipend',$items);
        pg_close($db);
        header("Location:stipendList.php");
    } 
    require 'home.php';
?>

<!DOCTYPE 'html'>
<head>
<title>Stipend</title>
</head>
<form method="GET">
<div class="card text-center w-50 ml-auto mr-auto">
    <h3>Создание пособия</h3>
    <div class="font-weight-bold">Безработный</div>
    <select class="form-control w-25 ml-auto mr-auto" name="joblessid" required=true>
    <?php
        while($row=pg_fetch_row($res)){
            echo "<option value='$row[0]'>$row[1] $row[2] [$row[3]]</option>";
        }
    ?>
    </select>
    <div class="font-weight-bold">Величина</div>
    <input class="form-control w-25 ml-auto mr-auto" type="text" onkeyup="positive_checker(this,1000000)"name="value" min='0' required=true>
    <div class="font-weight-bold">Дата начала предоставления</div>
    <input class="form-control w-25 ml-auto mr-auto"  type="date" name="provisionstart" required=true>
    <div class="font-weight-bold">Дата окончания предоставления</div>
    <input class="form-control w-25 ml-auto mr-auto"  type="date" name="provisionfin" required=true pattern="[+][0-9]{11}"><br>
    <input class="btn w-25 ml-auto mr-auto" type="submit" value="Создать" name="sbmt_btn">
</div>
</form>
