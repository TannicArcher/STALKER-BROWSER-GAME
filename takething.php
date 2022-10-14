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
if ((!isset($_SESSION['id'])) and (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
}
$H=getenv("HTTP_REFERER");
if (empty($H)) {
  ?>
  <script type="text/javascript">
  document.location.href = "mail.php";
  </script>
  <?php
  exit();
}
$user_id = $_SESSION['id'];
$mes_id = $_GET['mes_id'];
$mes_id = mysqli_real_escape_string($dbc, trim($mes_id));
////////////////Если не указано сообщение	
if (empty($mes_id)) {
  ?>
  <script type="text/javascript">
  document.location.href = "mail.php";
  </script>
  <?php
  exit();
}
///////////////////////////////////

///////////////Если этого сообщения не существует, если оно не пользователя, если оно уже прочитано.
$query_isset = "Select * from message where message_id='$mes_id' and dlya='$user_id' and reading=0 limit 1";
$result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
$row_isset = mysqli_num_rows($result_isset);
$row_isset = mysqli_fetch_array($result_isset);
if (empty($row_isset)) {
?>
<script type="text/javascript">
  document.location.href = "mail.php";
</script>
<?php
exit();
}
/////////////

///////////////Если это текст
if ($row_isset['type']==1) {
?>
<script type="text/javascript">
  document.location.href = "mail.php";
</script>
<?php
exit();
}
///////////////////////////

$query_up = "select message,aptechki, habar,money from users where id='$user_id' limit 1";
$result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
$read= mysqli_fetch_array($result_up);
$unread_mes=$read['message'];
$message = ($unread_mes - 1);
///////Eсли это шмотка
if ($row_isset['type'] == 2) {
  $thing = $row_isset['thing'];
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $query_up = "update things set place=0 where thing_id='$thing' and user_id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
////////////////////////////

///////Eсли это деньги
if ($row_isset['type'] == 3) {
  $thing = $row_isset['thing'];
  $money = $read['money'];
  $money = ($money + $thing);
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message', money = '$money' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////////////////

//////Если  хабар
if ($row_isset['type'] == 4) {
  $thing = $row_isset['thing'];
  $habar = $read['habar'];
  $habar = ($habar + $thing);
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message', habar = '$habar' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
/////////////////////////////

//////Если нужно отправить аптечки
if ($row_isset['type'] == 5) {
  $thing = $row_isset['thing'];
  $apt = $read['aptechki'];
  $apt = ($apt + $thing);
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message', aptechki = '$apt' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////

///////Eсли это аукцион
if ($row_isset['type'] == 6) {
  $thing = $row_isset['thing'];
  $money = $read['money'];
  $money = ($money + $thing);
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message', money = '$money' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////////////////

///////Eсли это шмотка
if ($row_isset['type'] == 7) {
  $thing = $row_isset['thing'];
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $query_up = "update things set place=0, user_id='$user_id' where thing_id='$thing' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
////////////////////////////

///////Eсли это аукцион
if ($row_isset['type'] == 8) {
  $thing = $row_isset['thing'];
  $money = $read['money'];
  $money = ($money + $thing);
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message', money = '$money' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////////////////

///////Eсли это шмотка
if ($row_isset['type'] == 9) {
  $thing = $row_isset['thing'];
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $query_up = "update things set place=0, user_id='$user_id' where thing_id='$thing' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
////////////////////////////

///////Eсли это аукцион
if ($row_isset['type'] == 10) {
  $thing = $row_isset['thing'];
  $money = $read['money'];
  $money = ($money + $thing);
  $query = "update message set reading = 1 where message_id='$mes_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message', money = '$money' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////////////////
?>
<script type="text/javascript">
  document.location.href = "mail.php";
</script>
<?php
mysqli_close($dbc);
?>