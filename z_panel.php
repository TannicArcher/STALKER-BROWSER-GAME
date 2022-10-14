<?php
$query_num = "Select id from users where loc = '$loc2' and gruppa = 'naemniki'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total1 = mysqli_num_rows($result_num); 
?>
  <img src="img/ico/odinochki.png"><?php echo "$total1";?>  
<?php
$query_num = "Select id from users where loc = '$loc2' and gruppa = 'dolg'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total2 = mysqli_num_rows($result_num); 
?>
  <img src="img/ico/dolg.png"><?php echo "$total2";?>  
<?php
$query_num = "Select id from users where loc = '$loc2' and gruppa = 'svoboda'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total3 = mysqli_num_rows($result_num); 
?>
  <img src="img/ico/svoboda.png"><?php echo "$total3";?>
<?php
$query_num = "Select id from users where loc = '$loc2' and gruppa = 'mon'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total4 = mysqli_num_rows($result_num); 
?>
  <img src="img/ico/monolit.png"><?php echo "$total4";?>