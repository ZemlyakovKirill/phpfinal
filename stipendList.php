<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Stipend</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.jobless a join opbd6.stipend b on a.joblessid = b.joblessid order by b.stipendid;";
    $res=pg_query($db,$query);
    echo "<div class='card ml-auto mr-auto' style='width:300px;position:flex;z-index:1;'><div class='card-body'>
    <h4 class='card-title'>Пособия</h2>";
    while($row=pg_fetch_assoc($res)){
        echo "<p class='card-text'>(".$row['stipendid'].") [".$row['username']."] ".$row['joblesslastname']." ".$row['joblessfirstname']." ".$row['value']."</p>";
    };
    echo "</div></div>";
?>