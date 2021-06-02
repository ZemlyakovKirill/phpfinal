<!DOCTYPE 'html'>
<head>
<title>Passage</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:passageList.php");
        $psgid=$_COOKIE['id'];
        $query2="select * from opbd6.passage where passageid=$psgid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        if($res2==null)
            header("Location:home.php");
        $query_group="select * from opbd6.educationalgroup g  join opbd6.educationalprogram p on g.programid=p.programid;";
        $query_jobless="select * from opbd6.jobless;";
        $res_group=pg_query($db,$query_group);
        $res_jobless=pg_query($db,$query_jobless);
        echo "<br><br><form method=GET>
        <div class='card text-center w-50 ml-auto mr-auto'>
                <h3>Редактирование Прохождения</h3>
                <div class='font-weight-bold'>Образовательная группа</div>
                <select class='form-control w-25 ml-auto mr-auto' name=groupid required=true>";
                while($row_group=pg_fetch_assoc($res_group)){
                    if($res2['groupid']==$row_group['groupid']){
                        echo "<option selected value='$row_group[groupid]'>$row_group[name] $row_group[studentcount]/$row_group[maxquantitystudents]</option>";
                    }
                    else{
                        echo "<option value='$row_group[programid]'>$row_group[name] $row_group[studentcount]/$row_group[maxquantitystudents]</option>";
                    }
                }
        echo "</select>
        <div class='font-weight-bold'>Безработный</div>";
        echo  "<select class='form-control w-25 ml-auto mr-auto' name=joblessid required=true>";
        while($row_jobless=pg_fetch_assoc($res_jobless)){
            if($res2['joblessid']==$row_jobless['joblessid']){
                echo "<option selected value='$row_jobless[joblessid]'>$row_jobless[joblesslastname] $row_jobless[joblessfirstname]</option>";
            }
            else{
                echo "<option value='$row_jobless[joblessid]'>$row_jobless[joblesslastname] $row_jobless[joblessfirstname]</option>";
            }
        }
        
        
        echo "</select>
                <div class='font-weight-bold'>Статус принятия в группу</div>
                <input class='checkbox ml-auto mr-auto' type=checkbox "; 
                if($res2['statusofadoption']=='t')echo "checked";
                else echo" "; 
        echo " name=statusofadoption>
                <div class='font-weight-bold'>Документ об окончании</div>
                <input class='checkbox ml-auto mr-auto' type=checkbox "; 
                if($res2['completiondocument']=='t')echo"checked";
                else echo " ";
        echo " name=completiondocument>
                <input class='btn w-25 ml-auto mr-auto' type=submit value=Обновить name=update_btn>
            </div>
        </form>";
        
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                $items=$_GET;
                if(!isset($_GET['statusofadoption']))
                    $items['statusofadoption']=0;
                else
                    $items['statusofadoption']=1;
                if(!isset($_GET['completiondocument']))
                    $items['completiondocument']=0;
                else
                    $items['completiondocument']=1;
                if(isset($_GET['update_btn'])){
                    $query3="update opbd6.passage set(groupid,joblessid,statusofadoption,completiondocument)=(
                    $items[groupid],
                    $items[joblessid],
                    '$items[statusofadoption]',
                    '$items[completiondocument]') 
                    where passageid=$psgid;";
                    $res3=pg_query($db,$query3);
                    pg_close($db);
                    header("Location:passageList.php");
                }
            }
        }
        require 'home.php';
?>