<?php
  $dbuser='postgres';
  $dbpass='1234';
  $host='localhost';
  $dbname='opbd6';
  $db=pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
  $update_quant=pg_query($db,"update opbd6.educationalgroup g set studentcount=(select count(*) from opbd6.passage where groupid=g.groupid);");
  if(!isset($_COOKIE['auto_log_in'])){
    $search_user=pg_query($db,"select * from opbd6.auth_log
                                join opbd6.jobless using(username)
                                where address='{$_SERVER['REMOTE_ADDR']}';");
    if($search_user!==null){
      $search_user=pg_fetch_assoc($search_user);
      setcookie("login",$search_user['username'],time()+60*60*24);
      setcookie("admin",($search_user['is_admin']=='t')?"1":"0",time()+60*60*24);
      setcookie("auto_log_in",true,time()+60*60*24);
    }
    pg_close($db);
  }
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="css.css" rel="stylesheet">

<!-- ШАПКА -->
<nav id="top-nav" class="nav fixed-top bg-dark w-75 ml-auto mr-auto" style="opacity:0;">
  <a id="jobless_link" onmouseover="table_list(this)" class="nav-link text-primary" style=<?php if(isset($_COOKIE['admin'])&&$_COOKIE['admin']=='1'){echo "display:block;";}else{echo "display:none;";}?>>Таблицы</a>
  <a id="availible_groups" href="availible_groups.php" class="nav-link text-primary" style=<?php if(isset($_COOKIE['login'])){echo "display:block;";}else{echo "display:none;";}?>>Доступные программы</a>
  <img id="user_icon" class="mt-auto mb-auto ml-auto" style="display:none;" src='./lib/user.png'>
  <a id="user_link" class="nav-link text-success" href="account.php" style=<?php if(isset($_COOKIE['login'])){echo "display:block;";}else{echo "display:none;";}?>><?php if(isset($_COOKIE['login']))echo $_COOKIE['login']?></a>
</nav>

<!-- Нижняя навигационная панель-->
<nav class="nav fixed-bottom text-black">
  <h6 class="font-weight-bold ml-auto mr-auto">Биржа труда</h6>
</nav>
<br>

<!-- CRUD операции -->
<ul id="choice_list" class="list-group bg-dark mt-0" style="border-bottom-left-radius:7px;border-bottom-right-radius:7px;display:none;position:absolute;z-index:3;">
  <a id="create_choice" class="list-group-item text-light bg-dark">Создать</a>
  <a id="update_choice" class="list-group-item text-light bg-dark">Редактировать</a>
  <a id="detail_choice" class="list-group-item text-light bg-dark">Детализировать</a>
  <a id="list_choice" class="list-group-item text-light bg-dark">Список</a>
</ul>

<!-- Выбор таблицы -->
<ul id="tables" class="list-group bg-dark mt-0" style="border-bottom-left-radius:7px;border-bottom-right-radius:7px;display:none;position:absolute;z-index:2;">
  <a id="jobless_choice" onmouseover="choice_field(this,'Jobless')" class="list-group-item text-light bg-dark">Безработный</a>
  <a id="stipend_choice" onmouseover="choice_field(this,'Stipend')" class="list-group-item text-light bg-dark">Пособие</a>
  <a id="organization_choice" onmouseover="choice_field(this,'Organization')"  class="list-group-item text-light bg-dark">Организация</a>
  <a id="program_choice" onmouseover="choice_field(this,'Program')" class="list-group-item text-light bg-dark">Программа</a>
  <a id="group_choice" onmouseover="choice_field(this,'Group')" class="list-group-item text-light bg-dark">Группа</a>
  <a id="group_choice" onmouseover="choice_field(this,'Passage')" class="list-group-item text-light bg-dark">Обучение</a>
</ul>
<br>
<ul id="identificator_selector" class="list-group bg-dark p-2 mt-0" style="border-top-right-radius:7px;border-bottom-right-radius:7px;width:15%;display:none;position:absolute;z-index:2;">
  <input id="choice_id" class="text-light bg-dark" style="width:100%;padding-left:20px;" type="text" name="id" placeholder="ID">
</ul>
<div id="auth_cont" class="container ml-auto mr-auto bg-dark p-2" style="position:fixed;z-index:2;width:300px;border-bottom-left-radius:7px;border-bottom-right-radius:5px;text-align:center;display:none;">
  <input type="text" placeholder="nickname"><br>
  <input type="text" placeholder="password"><br>
  <input type="text" placeholder="password repeat"><br>
</div>
<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="jquery.maskedinput.min.js"></script>
<script src="constraint.js"></script>
<script>
$(function(){
  $("#phone").mask("+7(999) 999-99-99");
  $("#passport").mask("9999 999999");
})
</script>