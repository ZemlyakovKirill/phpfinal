<?php
    if (isset($_GET["sbmt_btn"])){
        $items=$_GET;
        unset($items['sbmt_btn']);
        unset($items['red_btn']);
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $query_id="select max(organizationid)+1 as maxid from opbd6.educationalorganization";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $items['organizationid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.educationalorganization',$items);
        pg_close($db);
        header("Location:organizationList.php");
  }
  require 'home.php';  

?>
<!DOCTYPE 'html'>
<head>
<title>Organization</title>
</head>
<form method="GET">
<div class="card text-center w-50 ml-auto mr-auto">
    <h3>Создание Организации</h3>
    <div class="font-weight-bold">Наименование</div>
    <input class="form-control w-25 ml-auto mr-auto" type="text" name="name" required=true>
    <div class="font-weight-bold">Тип</div>
    <select class="form-control w-25 ml-auto mr-auto" name="type" size=1 required=true>
        <option value="СПО">Среднее профессиональное образование</option>
        <option value="ВПО">Высшее образование</option>
        <option value="СО">Среднее образование</option>
        <option value="СО(н)">Среднее образование(не полное)</option>
    </select>
    <div class="font-weight-bold">Адрес</div>
    <input class="form-control w-25 ml-auto mr-auto" type="text" name="address" required=true><br>
    <input class="btn w-25 ml-auto mr-auto" type="submit" value="Создать" name="sbmt_btn">
</div>
</form>