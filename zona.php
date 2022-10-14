<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  $page_title = 'Зона';
  require_once('conf/head.php');
  require_once('conf/top.php');
  $user_id = $_SESSION['id'];
  $query_loc = "update users set location = 'index' where id = '$user_id'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $query = "Select gruppa,lvl,hp from users where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $health = $row['hp'];
  if ($health <= 0) {//Если здоровье равно 0, то ссылкаемся на смерть
  ?>
  <script type="text/javascript">
  document.location.href = "death.php";
  </script>
  <?php
  exit();
}
  ?>
<?php
$query_uch = "Select * from users where id = '$user_id' ";
$result_uch = mysqli_query($dbc, $query_uch) or die ('Ошибка передачи запроса к БД');
$row_uch = mysqli_fetch_array($result_uch);
$lvl_u = $row_uch['lvl'];
$poisk_tip = $row_uch['poisk_tip'];
?>
<?php if ($poisk_tip == '1') {?>
 <script type="text/javascript">
  document.location.href = "vzlom.php";
  </script>
  <?php
  exit();
}
?>
  <div id="main">
<?php if ($lvl_u < 5 and $lvl_u >= 3) {?><p style="border-style: double;"><span class="white">Вот она, родимая, Зона!.. Пока для тебя доступна только одна локация - Деревня новичков. Зайди туда и убей несколько мутантов... О, сообщение на КПК пришло, кажется кому-то нужна моя помощь. На этом твое обучение окончено, может еще увидимся... </span></p><?php }?>
  <div class="stats">
  <p class="podmenu">Карта Зоны</p>
  </div>
  <?php 
  $err = $_GET['err'];
  if (!empty($err)) {
  ?>
  <div id="error">
  <?php if ($err == 1) {echo 'Сюда можно только с 10 ур';}?>
  <?php if ($err == 2) {echo 'Сюда можно только с 15 ур';}?>
  <?php if ($err == 3) {echo 'Сюда можно только с 20 ур';}?>
  <?php if ($err == 4) {echo 'Сюда можно только с 25 ур';}?>
  <?php if ($err == 5) {echo 'Сюда можно только с 28 ур';}?>
  <?php if ($err == 6) {echo 'Сюда можно только с 31 ур';}?>
  <?php if ($err == 7) {echo 'Сюда можно только с 40 ур';}?>
  </div>
  <?php
  }
  if ($row['gruppa'] == 'naemniki') {
  ?>
  <div class="stats">
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'base'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="base.php">Деревня новичков</a> <?php if ($lvl_u < 5 and $lvl_u >= 3) {?><img src="img/1.gif"/><?php }?> [<b>1 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'kordon1'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="kordon.php?location=kordon1">Затон</a> [<b>10 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'svalka1'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="svalka.php?location=svalka1">Юпитер</a> [<b>15 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'agroprom1'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="agroprom.php?location=agroprom1">Оазис</a> [<b>20 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'yantar1'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="yantar.php?location=yantar1">Припять</a> [<b>25 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'voensklad1'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="voensklad.php?location=voensklad1">Лаборатория Х-8</a> [<b>28 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'pripyat1'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="pripyat.php?location=pripyat1">Окрестности ЧАЭС</a> [<b>31 ур.</b>]</p>

  </div>
  <?php
  }
  if ($row['gruppa'] == 'dolg') {
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////DOLG
  ?>
  <div class="stats">
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'base'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="base.php">Деревня новичков</a> <?php if ($lvl_u < 5 and $lvl_u >= 3) {?><img src="img/1.gif"/><?php }?> [<b>1 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'kordon3'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="kordon.php?location=kordon3">Затон</a> [<b>10 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'svalka3'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="svalka.php?location=svalka3">Юпитер</a> [<b>15 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'agroprom6'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="agroprom.php?location=agroprom6">Оазис</a> [<b>20 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'yantar6'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="yantar.php?location=yantar6">Припять</a> [<b>25 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'voensklad7'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="voensklad.php?location=voensklad7">Лаборатория Х-8</a> [<b>28 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'pripyat10'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="pripyat.php?location=pripyat10">Окрестности ЧАЭС</a> [<b>31 ур.</b>]</p>
  </div>
  <?php
  }
  if ($row['gruppa'] == 'svoboda') {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////СВОБОДА
    ?>
  <div class="stats">
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'base'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="base.php">Деревня новичков</a> <?php if ($lvl_u < 5 and $lvl_u >= 3) {?><img src="img/1.gif"/><?php }?> [<b>1 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'kordon2'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="kordon.php?location=kordon2">Затон</a> [<b>10 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'svalka2'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="svalka.php?location=svalka2">Юпитер</a> [<b>15 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'agroprom2'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="agroprom.php?location=agroprom2">Оазис</a> [<b>20 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'yantar2'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="yantar.php?location=yantar2">Припять</a> [<b>25 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'voensklad2'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="voensklad.php?location=voensklad2">Лаборатория Х-8</a> [<b>28 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'pripyat2'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="pripyat.php?location=pripyat2">Окрестности ЧАЭС</a> [<b>31 ур.</b>]</p>
  </div>
  <?php
  }
  if ($row['gruppa'] == 'mon') {
  ?>
  <div class="stats">
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'base'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="base.php">Деревня новичков</a> <?php if ($lvl_u < 5 and $lvl_u >= 3) {?><img src="img/1.gif"/><?php }?> [<b>1 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'kordon4'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="kordon.php?location=kordon4">Затон</a> [<b>10 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'svalka4'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="svalka.php?location=svalka4">Юпитер</a> [<b>15 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'agroprom5'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="agroprom.php?location=agroprom5">Оазис</a> [<b>20 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'yantar4'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="yantar.php?location=yantar4">Припять</a> [<b>25 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'voensklad4'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="voensklad.php?location=voensklad4">Лаборатория Х-8</a> [<b>28 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'pripyat4'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  <p><?php
  if ($row_loc['bp_gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
  if ($row_loc['bp_gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
  if ($row_loc['bp_gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
  ?> <a <?php if ($row['lvl'] >= $row_loc['lvl_need']) {?>class="white"<?php } ?> href="pripyat.php?location=pripyat4">Окрестности ЧАЭС</a> [<b>31 ур.</b>]</p>
  <?php
  $query_loc = "Select lvl_need, bp_gruppa from location where location_name = 'aes3'";
  $result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
  $row_loc = mysqli_fetch_array($result_loc);
  ?>
  </div>
  <?php
  }
?>
</div>
<?php
//////////////////////////////////////////////  
  require_once('conf/navig.php');
require_once('conf/foot.php');
}
else {
?>
<script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
</script>
<?php
}
mysqli_close($dbc);
?>