<?php
    require 'home.php';
?>
<div id='user_choice_list' class='card bg-dark text-light' style="position:absolute;">
<div class='card-body'><h4 class='card-title'><?php if(isset($_COOKIE['login']))echo strtoupper($_COOKIE['login'])?></h4><p class='card-text'> 
<a id="personal_area" href="personal.php" class="list-group-item text-light bg-dark ml-0 mr-0">Личный кабинет</a>
<a id="my_groups" href="myGroups.php" class="list-group-item text-light bg-dark ml-0 mr-0">Мои группы</a>
<a id="passed_education" href="passedEducation.php" class="list-group-item text-light bg-dark ml-0 mr-0">Пройденное обучение</a>
<a id="passed_education" href="logout.php" class="list-group-item text-danger bg-dark ml-0 mr-0">Выйти</a>
</div>