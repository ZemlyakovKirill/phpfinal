<?php
    $dbuser='postgres';
    $dbpass='1234';
    $host='localhost';
    $dbname='opbd6';
    $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
    $res=pg_query($db,"delete from opbd6.auth_log where address='$_SERVER[REMOTE_ADDR]'");
    setcookie("login","",-1);
    setcookie("admin","",-1);
    setcookie("auto_log_in","",-1);
    header("Location:home.php");
?>