<?php
//*******************************************************************//
//**///////////////////////Автор: Андрей Наумов////////////////////**//
//**//////Двиг был написан мною и никаких соавторов не имеется/////**//
//**////////////////////////VK: vk.com/linux8//////////////////////**//
//**/////Устроюсь как на временную, так и на постоянную работу/////**//
//**//////////Знаю: Php, MySQL, CSS, xhtml, photoshop//////////////**//
//**/////Цена договорная, зависит от сложности и объёма работы/////**//
//**///////////////////////////////////////////////////////////////**//
//**////////////Спасибо за использование моего движка//////////////**//
//**/////Буду рад радовать вас новыми и интересными движками///////**//
//*******************************************************************//

require_once('conf/dbc.php');
$query_lots = "Select * from auction where date<NOW()-86400";
$result_lots = mysqli_query($dbc, $query_lots) or die ('Ошибка передачи запроса к БД');
$s=0;
while ($row_lot = mysqli_fetch_array($result_lots)) {
  $lot=$row_lot['id_lot'];
  if ($row_lot['price_user'] == 0) {
    $thing=$row_lot['thing_id'];
	$query = "Select user_id, inf_id, type from things where thing_id='$thing' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
    $row = mysqli_fetch_array($result);
	$inf_cl = $row['inf_id'];
	$tip=$row['type'];
	$user_thing=$row['user_id'];
	if ($tip == 1) {
	  $query_inf = "Select name from clothes where clothes_id = '$inf_cl' limit 1";
	  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	  $row_inf = mysqli_fetch_array($result_inf);
	}//Назваине брони
	if ($tip == 2) {
	  $query_inf = "Select name from pistols where pistols_id = '$inf_cl' limit 1";
	  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	  $row_inf = mysqli_fetch_array($result_inf);
	}//Название Пистолета
	if ($tip == 3) {
	  $query_inf = "Select name from weapons where weapons_id = '$inf_cl' limit 1";
	  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	  $row_inf = mysqli_fetch_array($result_inf);
	}//Название оружия
	$name=$row_inf['name'];
	$query_lot = "insert into message (`type`, `ot`, `dlya`, `text`, `thing`, `time`, `reading`, `delite_ot`, `delite_dlya`) values (9, '', '$user_thing', '$name', '$thing', NOW(),0,0,0)";
	$result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	$query_lot = "delete from auction where id_lot='$lot'";
    $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	$query_u = "update users set message=message+1 where id='$user_thing'";
    $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД5');
  }
  else {
    $thing=$row_lot['thing_id'];
	$query = "Select user_id, inf_id, type from things where thing_id='$thing' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
    $row = mysqli_fetch_array($result);
	$inf_cl = $row['inf_id'];
	$tip=$row['type'];
	$user_thing=$row['user_id'];
	$user_buy=$row_lot['price_user'];
	$price_buy=$row_lot['price_now'];
	$price_buy=($price_buy*0.9);
	if ($tip == 1) {
	  $query_inf = "Select name from clothes where clothes_id = '$inf_cl' limit 1";
	  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	  $row_inf = mysqli_fetch_array($result_inf);
	}//Назваине брони
	if ($tip == 2) {
	  $query_inf = "Select name from pistols where pistols_id = '$inf_cl' limit 1";
	  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	  $row_inf = mysqli_fetch_array($result_inf);
	}//Название Пистолета
	if ($tip == 3) {
	  $query_inf = "Select name from weapons where weapons_id = '$inf_cl' limit 1";
	  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	  $row_inf = mysqli_fetch_array($result_inf);
	}//Название оружия
	$name=$row_inf['name'];
	$query_u = "update users set message=message+1 where id='$user_thing'";
    $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД5');
	$query_lot = "insert into message (`type`, `ot`, `dlya`, `text`, `thing`, `time`, `reading`, `delite_ot`, `delite_dlya`) values (8, '', '$user_thing', '$name', '$price_buy', NOW(),0,0,0)";
	$result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	/////////////////////////////////////Хозяину скинули деньги  
	$query_lot = "insert into message (`type`, `ot`, `dlya`, `text`, `thing`, `time`, `reading`, `delite_ot`, `delite_dlya`) values (7, '', '$user_buy', '$name', '$thing', NOW(),0,0,0)";
	$result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	$query_u = "update users set message=message+1 where id='$user_buy'";
    $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД5');
	$query_lot = "delete from auction where id_lot='$lot'";
    $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	  
  }
  $s=($s+1);
}
mysqli_close($dbc);
?>