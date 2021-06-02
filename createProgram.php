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
        $query_id="select max(programid)+1 as maxid from opbd6.educationalprogram;";
        $id=pg_query($db,$query_id);
        $id=pg_fetch_assoc($id);
        $items['programid']=$id['maxid'];
        $result=pg_insert($db,'opbd6.educationalprogram',$items);
        pg_close($db);
        header("Location:programList.php");
  }
  require 'home.php';  
?>
<!DOCTYPE 'html'>
<head>
<title>Program</title>
</head>
<form method="GET">
<div class="card text-center w-50 ml-auto mr-auto">
    <h3>Создание программы</h3>
    <div class="font-weight-bold">Наименование</div>
    <input class="form-control ml-auto mr-auto w-25" type="text" name="name"  required=true>
    <div class="font-weight-bold">Дата начала обучения</div>
    <input class="form-control ml-auto mr-auto w-25" type="date" name="startdate" required=true>
    <div class="font-weight-bold">Дата окончания обучения</div>
    <input class="form-control ml-auto mr-auto w-25" type="date" name="finishdate"  required=true>
    <div class="font-weight-bold">Стоимость обучения</div>
    <input class="form-control ml-auto mr-auto w-25" onkeyup="positive_checker(this,1000000)" type="text" name="cost"  required=true>
    <div class="font-weight-bold">Тип</div>
    <input class="form-control ml-auto mr-auto w-25" type="text" name="type"  required=true><br>
    <input class="btn w-25 ml-auto mr-auto" type="submit" value="Создать" name="sbmt_btn">
</div>
</form>
