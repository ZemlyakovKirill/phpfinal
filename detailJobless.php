<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Jobless</title>
</head>
<?php
    if(!isset($_COOKIE['id']))
        header("Location:joblessList.php");
    $jid=$_COOKIE['id'];
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.jobless where joblessid=$jid";
    $res=pg_query($db,$query);
    $res=pg_fetch_assoc($res);
    if($res==null)
        header("Location:home.php");
    echo "<div id='detail_card' class='card w-50'><div class='card-body'><h4 class='card-title'>Безработный</h4><p class='card-text'>";
    echo "<h3>Ник: $res[username]</h3>";
    echo "<h3>Фамилия: $res[joblesslastname]</h3>";
    echo "<h3>Имя: $res[joblessfirstname]</h3>";
    echo "<h3>Отчество: $res[joblessmiddlename]</h3>";
    echo "<h3>Адрес: $res[joblessaddress]</h3>";
    echo "<h3>Телефон: $res[joblessphone]</h3>";
    echo "<h3>Паспорт: $res[joblesspassport]</h3>";
    echo "<h3>Опыт работы: $res[workexperience]</h3></p></div></div>";
?>