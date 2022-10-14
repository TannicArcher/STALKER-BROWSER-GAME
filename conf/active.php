<?php
$act = $_SESSION['id'];
$query_act = "update users set last_active = NOW() where id = '$act'";
$result_act = mysqli_query($dbc, $query_act) or die ('Ошибка передачи запроса к БД');
?>