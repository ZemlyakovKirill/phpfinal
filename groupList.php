<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Group</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.educationalgroup a join opbd6.educationalprogram b on a.programid=b.programid order by groupid";
    $res=pg_query($db,$query);
    echo "<div class='card ml-auto mr-auto' style='width:350px;position:flex;z-index:1;'><div class='card-body'>
    <h4 class='card-title'>Образовательные группы</h2>";
    while($row=pg_fetch_assoc($res)){
        echo "<p class='card-text'>(".$row['groupid'].") ".$row['name']." ".$row['studentcount']." / ".$row['maxquantitystudents']."</p>";
    };
    echo "</div></div>";
?>