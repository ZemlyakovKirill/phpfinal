<?php
    if(isset($_GET['username'])){
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $query="select * from opbd6.jobless where username='$_GET[username]'";
        $result=pg_query($db,$query);
        if(pg_fetch_assoc($result)){
            echo "True";
        }  
    }
?>