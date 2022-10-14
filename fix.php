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
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
  exit();
}
$thing_id = $_GET['thing'];
$thing_id = mysqli_real_escape_string($dbc, trim($thing_id));
$user_id = $_SESSION['id'];
if (empty($thing_id)) {
  ?>
  <script type="text/javascript">
  document.location.href = "clothes.php?id=<?php echo "$user_id"?>";
  </script>
  <?php
  exit();
}
$query = "Select sost, place,type from things where thing_id='$thing_id' and user_id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
$total = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$sost = $row['sost'];
if ($total == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "thing.php?id=<?php echo "$thing_id"?>";
  </script>
  <?php
  exit();
}
if ($sost == 8) {
  ?>
  <script type="text/javascript">
  document.location.href = "thing.php?id=<?php echo "$thing_id"?>&err=1";
  </script>
  <?php
  exit();
}
//////////////////////Знаем что шмотка пользователя и она сушествует.
//////////////////////Знаем, что ид шмотки не пустой и апгрейд тоже и меньше 4
$query_up = "Select habar from users where id = '$user_id' limit 1";
$result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
$row_up = mysqli_fetch_array($result_up);
$habar = $row_up['habar'];
if ($sost == 0) {
  $need_habar = 240;
}
if ($sost == 1) {
  $need_habar = 210;
}
if ($sost == 2) {
  $need_habar = 180;
}
if ($sost == 3) {
  $need_habar = 150;
}
if ($sost == 4) {
  $need_habar = 120;
}
if ($sost == 5) {
  $need_habar = 90;
}
if ($sost == 6) {
  $need_habar = 60;
}
if ($sost == 7) {
  $need_habar = 30;
}
$habar= ($habar - $need_habar);
if ($habar < 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "thing.php?thing=<?php echo "$thing_id"?>&err=2";
  </script>
  <?php
  exit();  
}
/////////////////////////////////////Денег хватает.
	  $query_up = "update things set  sost = '8' where user_id = '$user_id' and thing_id='$thing_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
      $query_up = "update users set  habar = '$habar' where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
/////////////////////////////////////////////////



//////////////////////////////////////////////////////Если оружие одето
  if ($row['place'] == 2) {
    if ($row['type'] == 1) {
	  $query_up = "update users set sost_cl=8 where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	 if ($row['type'] == 2) {
	  $query_up = "update users set sost_p=8 where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	if ($row['type'] == 3) {
	  $query_up = "update users set sost_w=8 where id = '$user_id' limit 1";
      $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
  }
//////////////////////////////////////////////////////
?>
  <script type="text/javascript">
  document.location.href = "thing.php?thing=<?php echo "$thing_id"?>&err=3";
  </script>
  <?php
/////////////////////////////////////////////////////
//////////////////////////////////////////////////////
mysqli_close($dbc);
?>

</body>
</html>
