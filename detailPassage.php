<?php
    include('home.php');
?>
<!DOCTYPE 'html'>
<head>
<title>Passage</title>
</head>
<?php
    if(!isset($_COOKIE['id']))
        header("Location:passageList.php");
    $psgid=$_COOKIE['id'];
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.passage p
    join opbd6.jobless j on p.joblessid = j.joblessid
    join opbd6.educationalgroup g on  p.groupid=g.groupid
    join opbd6.educationalprogram pr on pr.programid=g.programid where passageid=$psgid;";
    $res=pg_query($db,$query);
    $res=pg_fetch_assoc($res);
    if($res==null)
        header("Location:home.php");
    echo "<div id='detail_card' class='card w-50'><div class='card-body'><h4 class='card-title'>Прохождение обучения</h4><p class='card-text'>";
    echo "<h3>Группа: $res[name] ($res[studentcount]/$res[maxquantitystudents])</h3>";
    echo "<h3>Безработный: $res[joblesslastname] $res[joblessfirstname] $res[joblessmiddlename]</h3>";
    echo "<h3>Статус принятия в группу: ";
    if($res['statusofadoption']=='t')echo " да ";
    else echo " нет "; 
    echo "</h3>";
    echo "<h3>Документ об окончании: ";
    if($res['completiondocument']=='t')echo " да ";
    else echo " нет "; 
    echo "</h3></div>";

?>