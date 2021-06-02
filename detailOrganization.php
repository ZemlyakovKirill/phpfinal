<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Organization</title>
</head>

<?php
    if(!isset($_COOKIE['id']))
        header("Location:organizationList.php");
    $orgid=$_COOKIE['id'];
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select name,type,address from opbd6.educationalorganization where organizationid=$orgid";
    $res=pg_query($db,$query);
    $res=pg_fetch_assoc($res);
    if($res==null)
        header("Location:home.php");
    echo "<div id='detail_card' class='card w-50'><div class='card-body'><h4 class='card-title'>Образовательная Организация</h4><p class='card-text'>";
    echo "<h3>Наименование: $res[name]</h3>";
    echo "<h3>Тип: ";
    if ($res['type'] == 'СПО' ) {
        echo "Среднее профессиональное образование";
    }
    if ($res['type'] == 'ВПО' ) {
        echo "Высшее образование";
    }
    if ($res['type'] == 'СО') {
        echo "Среднее образование";
    }
    if ($res['type'] == 'СО(н)') {
        echo "Среднее неполное образование";
    }
    echo "</h3>";
    echo "<h3>Адрес: $res[address]</h3></div>";

?>