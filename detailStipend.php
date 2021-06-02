<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Jobless</title>
</head>
<?php
    if(!isset($_COOKIE['id']))
        header("Location:stipendList.php");
    $stpid=$_COOKIE['id'];
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.jobless a join opbd6.stipend b on a.joblessid = b.joblessid where stipendid=$stpid;";
    $res=pg_query($db,$query);
    $res=pg_fetch_assoc($res);
    if($res==null)
        header("Location:home.php");
    echo "<div id='detail_card' class='card w-50'><div class='card-body'><h4 class='card-title'>Пособие</h4><p class='card-text'>";
    echo "<h3>Безработный:[$res[username]] $res[joblesslastname] $res[joblessfirstname] $res[joblessmiddlename]</h3>";
    echo "<h3>Значение: $res[joblessfirstname]</h3>";
    echo "<h3>Дата начала предоставления: $res[provisionstart]</h3>";
    echo "<h3>Дата окончания предоставления: $res[provisionfin]</h3></p></div></div>";


?>