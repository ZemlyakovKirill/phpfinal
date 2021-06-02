<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Passage</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.passage p
    join opbd6.jobless j on p.joblessid = j.joblessid
    join opbd6.educationalgroup g on  p.groupid=g.groupid
    join opbd6.educationalprogram pr on pr.programid=g.programid order by passageid;";
    $res=pg_query($db,$query);
    echo "<div class='card ml-auto mr-auto' style='width:500px;position:flex;z-index:1;'><div class='card-body'>
    <h4 class='card-title'>Прохождение обучения</h2>";
    while($row=pg_fetch_assoc($res)){
        echo "<p class='card-text'>(".$row['passageid'].") ".$row['joblesslastname']." ".$row['joblessfirstname']."->".$row['name']."</p>";
    };
    echo "</div></div>";
?>