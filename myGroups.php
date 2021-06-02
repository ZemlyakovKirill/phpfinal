<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $query="select * from opbd6.educationalgroup g
            join opbd6.educationalprogram
            using(programid)
            join opbd6.passage p
            using(groupid)
            join opbd6.jobless j
            using(joblessid)
            where j.username='$_COOKIE[login]'
            and p.statusofadoption=true
            and p.completiondocument=false;";
    $result=pg_query($db,$query);
    echo "<br><br><div id='choiced_item' class='card text-center w-50' style='position:absolute;'>
    <h4 class='card-title'>Образовательные группы</h2>";
    if($result==null){
        header("Location:account.php");
    }
    $counter=0;
    while($row=pg_fetch_assoc($result)){
        $counter++;
        echo "<p class='card-text'><h6>".$row['name']."</h6> ".$row['startdate']."-".$row['finishdate'] ."(".$row['studentcount']."/".$row['maxquantitystudents'].")".
        "<a href='leaveGroup.php?groupid=$row[groupid]'class='nav-link text-danger'>Покинуть</a>
        </p>";
        };
    if($counter==0)
        echo "<p class='card-text'>У Вас нет групп или Вы не приняты ни в одну из них</p>";
    echo "</div></div>";
    require 'account.php';
?>
