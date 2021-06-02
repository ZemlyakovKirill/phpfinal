<?php
    require 'home.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availible Groups</title>
</head>
<?php
  $dbuser='postgres';
  $dbpass='1234';
  $host='localhost';
  $dbname='opbd6';
  $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
  $result=pg_query($db,"select * from opbd6.educationalgroup join opbd6.educationalprogram using(programid)
  where studentcount<maxquantitystudents and
  groupid not in(select groupid from opbd6.passage join opbd6.jobless using(joblessid) where username like '$_COOKIE[login]') order by groupid;");
  
  


  echo "<div class='card ml-auto mr-auto w-50' style='width:350px;position:flex;z-index:1;'><div class='card-body'>
  <h4 class='card-title'>Образовательные группы</h2>";
  $counter=0;
  while($row=pg_fetch_assoc($result)){
      $counter++;
      echo "<p class='card-text'>".$row['name']." ".$row['cost']." (".$row['studentcount']." / ".$row['maxquantitystudents'].")".
      "<a href='joinGroup.php?groupid=$row[groupid]'class='nav-link text-success'>Присоединиться</a>".
      "</p>";
  };
  if($counter==0)
    echo "<p class='card-text'>Нет доступных групп по программам</p>";
  echo "</div></div>";

?>