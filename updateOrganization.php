<!DOCTYPE 'html'>
<head>
<title>Organization</title>
</head>
<?php
        if(!isset($_COOKIE['id']))
            header("Location:organizationList.php");
        $orgid=$_COOKIE['id'];
        $query2="select * from opbd6.educationalorganization where organizationid=$orgid";
        $dbuser='postgres';
        $dbpass='1234';
        $host='localhost';
        $dbname='opbd6';
        $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
        $res2=pg_query($db,$query2);
        $res2=pg_fetch_assoc($res2);
        if($res2==null)
            header("Location:home.php");
        echo "<br><br><form method=GET>
            <div class='card text-center w-50 ml-auto mr-auto'>
                <h3>Редактирование Организации</h3>
                <div class='font-weight-bold'>Наименование</div>
                <input class='form-control w-25 ml-auto mr-auto' type=text name=name value='$res2[name]' required=true>
                <div class='font-weight-bold'>Тип</div>";
                if ($res2['type'] == 'СПО' ) {
                    echo "
                    <select class='form-control w-25 ml-auto mr-auto' required=true name=type>
                        <option selected value=СПО>Среднее профессиональное образование</option>
                        <option value=ВПО>Высшее образование</option>
                        <option value=СО>Среднее образование</option>
                        <option value=СО(н)>Среднее образование(не полное)</option>
                    </select>";
                }
                if ($res2['type'] == 'ВПО' ) {
                    echo "
                    <select class='form-control w-25 ml-auto mr-auto' required=true name=type>
                        <option value=СПО>Среднее профессиональное образование</option>
                        <option selected value=ВПО>Высшее образование</option>
                        <option value=СО>Среднее образование</option>
                        <option value=СО(н)>Среднее образование(не полное)</option>
                    </select>";
                }
                if ($res2['type'] == 'СО') {
                    echo "
                    <select class='form-control w-25 ml-auto mr-auto' required=true name=type>
                        <option value=СПО>Среднее профессиональное образование</option>
                        <option value=ВПО>Высшее образование</option>
                        <option selected value=СО>Среднее образование</option>
                        <option value=СО(н)>Среднее образование(не полное)</option>
                    </select>";
                }
                if ($res2['type'] == 'СО(н)') {
                    echo "
                    <select class='form-control w-25 ml-auto mr-auto' required=true name=type>
                        <option value=СПО>Среднее профессиональное образование</option>
                        <option value=ВПО>Высшее образование</option>
                        <option value=СО>Среднее образование</option>
                        <option selected value=СО(н)>Среднее образование(не полное)</option>
                    </select>";
                }        
                echo "
                <div class='font-weight-bold'>Адрес</div>
                <input class='form-control w-25 ml-auto mr-auto' type=text name=address required=true value='$res2[address]'><br>
                <input class='btn w-25 ml-auto mr-auto' type=submit value=Обновить name=update_btn>
            </div>
        </form>";
        
        if(isset($_GET['update_btn'])){
            if($res2!=null){
                if(isset($_GET['update_btn'])){
                    $query3="update opbd6.educationalorganization set(name,type,address)=(
                    '$_GET[name]',
                    '$_GET[type]',
                    '$_GET[address]')
                    where organizationid=$orgid;";
                    $res3=pg_query($db,$query3);
                    pg_close($db);
                    header("Location:organizationList.php");
                }
            }
        }
        require 'home.php';
?>