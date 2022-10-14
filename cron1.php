<?php
require_once('conf/dbc.php');

$query_us = "Select * from clans where gruppa <> 'lol' order by slava DESC";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
while ($row_us = mysqli_fetch_array($result_us)) {
$b_slava = $row_us['b_slava'];
$limm = ('100' + $b_slava);
$name = $row_us['name'];
$clan_id = $row_us['clan_id'];
$slava1 = $row_us['slava'];
$ssq = '0';

$query_sub = "Select * from users where clan = '$clan_id' order by lvl desc";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$slava = $row_sub['slava'];
?>
<?php
$ssq = ($ssq + $slava);
?>
<?php 
}
$mentorr = ($ssq / '100');
if ($mentorr > $limm) {
$mentorr = $limm;
}
?>
<?php
$query = "update clans set slava='$ssq', mentor='$mentorr' where clan_id = '$clan_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
	    <?php
	  }
	  ?>