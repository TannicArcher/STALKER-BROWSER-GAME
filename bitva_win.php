<?php
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
};
$page_title = 'Итог битвы';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<?php
$user_id = $_SESSION['id'];
$cl = $_GET['cl'];
$hab1 = $_GET['hab'];
$mon1 = $_GET['mon'];
$hab2 = $_GET['habb'];
$mon2 = $_GET['monn'];
$rat1 = $_GET['rat'];
$rat2 = $_GET['ratt'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$clan = $row_us['clan'];
?>
<p style="border-top: solid 1px #444e4f"></p>
<?php if ($cl == $clan) {?>
<p class="bonus"><b>Ваш отряд победил в битве!<br />
<u>Награда:</u></b><br />
Хабар: <?php echo "$hab1";?><br />
RUB: <?php echo "$mon1";?><br />
Ранг: <?php echo "$rat1";?></p>
<?php }?>
<?php if ($cl != $clan) {?>
<p class="red"><b>Ваш отряд проиграл в битве.<br />
<u>Потери:</u></b><br />
Хабар: <?php echo "$hab2";?><br />
RUB: <?php echo "$mon2";?></p>
<p class="bonus"><b><u>Получено:</u></b><br />
Ранг: <?php echo "$rat2";?></p>
<?php }?>
<p style="border-top: solid 1px #444e4f"></p>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>