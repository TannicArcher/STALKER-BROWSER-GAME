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
$page_title = 'Итог боя';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<?php
$user_id = $_SESSION['id'];
$id2 = $_GET['id'];
$query_us = "Select * from arena_inf where  user_id = '$user_id' and vrag_id='$id2' order by time desc  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$lol = mysqli_fetch_array($result_us);
$id1 = $lol['user_id'];
$id2 = $lol['vrag_id'];
$yron1 = $lol['yron1'];
$yron2 = $lol['yron2'];
$habar1 = $lol['habar1'];
$habar2 = $lol['habar2'];
$dengi1 = $lol['dengi1'];
$dengi2 = $lol['dengi2'];
$rat1 = $lol['rat1'];
$rat2 = $lol['rat2'];
$hp1 = $lol['hp1'];
$hp2 = $lol['hp2'];
$win = $lol['win'];
?>
<p style="border-top: solid 1px #444e4f"></p>
<?php if ($user_id != $id2) {?>
<?php if ($win == $user_id) {?>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Победа!</p></center>
<p class="podmenu">Ваша награда:</p>
<p>Хабар: <?php echo "$habar2";?></p>
<p>Чеки: <?php echo "$dengi2";?></p>
<?php if ($rat1 > '0') {?><p>Слава: <?php echo "$rat1";?></p><?php }?>
<p class="podmenu">Общий урон:</p>
<p>Вы: <?php echo "$yron1";?></p>
<p>Противник: <?php echo "$yron2";?></p>
<p class="podmenu">Здоровье:</p>
<p>Ваше: <?php echo "$hp1";?></p>
<p>Противника: <?php echo "$hp2";?></p>
<?php }?>
<?php if ($win != $user_id) {?>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Поражение!</p></center>
<p class="podmenu">Ваши потери:</p>
<p>Хабар: <?php echo "$habar1";?></p>
<p>Чеки: <?php echo "$dengi1";?></p>
<p class="podmenu">Общий урон:</p>
<p>Вы: <?php echo "$yron1";?></p>
<p>Противник: <?php echo "$yron2";?></p>
<p class="podmenu">Здоровье:</p>
<p>Ваше: <?php echo "$hp1";?></p>
<p>Противника: <?php echo "$hp2";?></p>
<?php }?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<p><img src="img/ico/arena.png" width="12" height="12"/> <a href="arena.php">Арена</a></p>
<?php } else {?>
<p>Данный раздел дорабатывается...</p>
<?php }?>
<p style="border-top: solid 1px #444e4f"></p>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>