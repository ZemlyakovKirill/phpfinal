<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query_group="select * from opbd6.educationalgroup g  join opbd6.educationalprogram p on g.programid=p.programid;";
    $query_jobless="select * from opbd6.jobless;";
    $res_group=pg_query($db,$query_group);
    $res_jobless=pg_query($db,$query_jobless);
    if (isset($_GET["sbmt_btn"])){
          $items=$_GET;
          if(!isset($_GET['statusofadoption']))
              $items['statusofadoption']=FALSE;
          else
              $items['statusofadoption']=TRUE;
          if(!isset($_GET['completiondocument']))
              $items['completiondocument']=FALSE;
          else
              $items['completiondocument']=TRUE;
          unset($items['sbmt_btn']);
          unset($items['red_btn']);
          $query_id="select max(passageid)+1 as maxid from opbd6.passage";
          $id=pg_query($db,$query_id);
          $id=pg_fetch_assoc($id);
          $items['passageid']=$id['maxid'];
          $result=pg_insert($db,'opbd6.passage',$items);
          pg_close($db);
          header("Location:passageList.php");
    }
    require 'home.php';  
?>
<!DOCTYPE 'html'>
<head>
<title>Passage</title>
</head>
<form method="GET">
<div class="card text-center w-50 ml-auto mr-auto">
    <h3>Создание Прохождения</h3>
    <div class='font-weight-bold'>Образовательная группа</div>
    <select class='form-control w-25 ml-auto mr-auto' name="groupid" required=true>
    <?php
        while($row_group=pg_fetch_assoc($res_group)){
            echo "<option value='$row_group[groupid]'>$row_group[name] $row_group[studentcount]/$row_group[maxquantitystudents] </option>";
        }
    ?>
    </select>
    <div class='font-weight-bold'>Безработный</div>
    <select class='form-control w-25 ml-auto mr-auto' name="joblessid" required=true>
    <?php
        while($row_jobless=pg_fetch_assoc($res_jobless)){
            echo "<option value='$row_jobless[joblessid]'>$row_jobless[joblesslastname] $row_jobless[joblessfirstname]</option>";
        }
    ?>
    </select>
    <div class='font-weight-bold'>Статус принятия в группу</div>
    <input class='checkbox ml-auto mr-auto' type="checkbox"name="statusofadoption">
    <div class='font-weight-bold'>Документ об окончании</div>
    <input class='checkbox ml-auto mr-auto' type="checkbox"name="completiondocument"><br>
    <input class='btn w-25 ml-auto mr-auto' type="submit" value="Создать" name="sbmt_btn">
</div>
</form>