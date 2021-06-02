<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Program</title>
</head>
<?php
    if(!isset($_COOKIE['id']))
        header("Location:programList.php");
    $progid=$_COOKIE['id'];
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.educationalprogram where programid=$progid";
    $res=pg_query($db,$query);
    $res=pg_fetch_assoc($res);
    if($res==null)
        header("Location:home.php");
    echo "<div id='detail_card' class='card w-50'><div class='card-body'><h4 class='card-title'>Образовательная программа</h4><p class='card-text'>";    
    echo "<h3>Наименование: $res[name]</h3>";
    echo "<h3>Дата начала обучения: $res[startdate]</h3>";
    echo "<h3>Дата окончания обучения: $res[finishdate]</h3>";
    echo "<h3>Стоимость обучения: $res[cost]</h3>";
    echo "<h3>Тип: $res[type]</h3>";


?>