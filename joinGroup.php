<?php
    if(isset($_GET['groupid'])){
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $query="insert into opbd6.passage(joblessid,groupid,statusofadoption,completiondocument) values (
            (select joblessid from opbd6.jobless where username like '$_COOKIE[login]'),
            $_GET[groupid],
            false,
            false);";
        $result=pg_query($db,$query);
        pg_close($db);
        header('Location:availible_groups.php');
    }
?>