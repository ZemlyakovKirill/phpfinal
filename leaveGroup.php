<?php
    if(isset($_GET['groupid'])){
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $query="delete from opbd6.passage 
            where joblessid=(select joblessid from opbd6.jobless where username like '$_COOKIE[login]')
            and groupid=$_GET[groupid];";
        $result=pg_query($db,$query);
        pg_close($db);
        header('Location:myGroups.php');
    }
?>