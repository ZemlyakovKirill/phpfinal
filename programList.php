<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Program</title>
</head>
<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.educationalprogram order by programid";
    $res=pg_query($db,$query);
    echo "<div class='card ml-auto mr-auto' style='width:300px;position:flex;z-index:1;'><div class='card-body'>
    <h4 class='card-title'>Образовательные программы</h2>";
    while($row=pg_fetch_row($res)){
        echo "<p class='card-text'>(".$row[0].") ".$row[1]."</p>";
    };
    echo "</div></div>";

?>