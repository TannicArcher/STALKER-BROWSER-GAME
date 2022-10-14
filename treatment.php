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
}
$page_title = 'Самолечение';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<?php
$user_id = $_SESSION['id'];
$igrok = $_GET['igrok'];
$igrok = mysqli_real_escape_string($dbc, trim($igrok));
$query_us = "Select nick, money, loto_time, user from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$user = $row_us['user'];
$nick = $row_us['nick'];
?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php if ($igrok == '') {?>
<p class="white">Не можешь зайти на рейды? Вылечи себя сам!</p>
<p><span class="white">Игрок: <?php echo "$nick" ; ?></span> [<a class="bonus" href="treatment.php?igrok=<?php echo "$user_id" ; ?>">вылечить</a>]</p><?php } else {?><span class="bonus">Ошибка успешно устранена!</span><?php }?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php if ($igrok != '') {?>
<?php
$query = "update users set m_fight= '0' where id='$igrok' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$cpu = '1';
?>
<?php }?>
<p><span class="white">Статус команды: </span>
<?php if ($cpu == '1') {?><span class="bonus">выполнена</span><?php } else {?><span class="red">не выполнена</span><?php }?>
</p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>