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
};
$page_title = 'Почта';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query = "update users set location = 'mail' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query1 = "Select * from users where id='$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$clan_mes = $row1['clan_mes'];
$new = $row1['new'];
$clan = $row1['clan'];
$mc = $row1['mc'];
$user = $row1['user'];
$admin = $row1['admin'];

$query_num = "Select message_id from message where dlya='$user_id' and reading='0' and type != '6' and type != '7' and type != '8' and type != '9' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6 = mysqli_num_rows($result_num);
$message = $total6;
$query_num = "Select message_id from message where dlya='$user_id' and reading='0' and type != '1' and type != '2' and type != '3' and type != '4' and type != '5' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total7 = mysqli_num_rows($result_num);
$message1 = $total7;
$query_ti = "Select * from texpod where reading = '0'";
$result_ti = mysqli_query($dbc, $query_ti) or die ('Ошибка передачи запроса к БД1');
$row_ti = mysqli_num_rows($result_ti);
$query_ti1 = "Select * from texpod where reading_in = '1' and ot='$user_id'";
$result_ti1 = mysqli_query($dbc, $query_ti1) or die ('Ошибка передачи запроса к БД1');
$row_ti1 = mysqli_num_rows($result_ti1);
?>
<div class="stats">
  <center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Почта</p></center>
</div>
<div class="stats">
<a href="new.php" class="menu"><?php if ($new == '0') {?><img src="img/ico/mail3.png" width="12" height="12"/><?php } else {?><img src="img/ico/mail2.png" width="12" height="12"/><?php }?>Новости <?php if ($new > '0') {?>[<span class="gold"><?php echo "$new";?></span>]<?php }?></a>
<a href="mail2.php" class="menu"><?php if ($message == '0') {?><img src="img/ico/mail3.png" width="12" height="12"/><?php } else {?><img src="img/ico/mail2.png" width="12" height="12"/><?php }?>Личные сообщения <?php if ($message > '0') {?>[<span class="gold"><?php echo "$message";?></span>]<?php }?></a>
<?php if ($clan != '0') {?><a href="clanmail.php" class="menu"><?php if ($clan_mes == '0') {?><img src="img/ico/mail3.png" width="12" height="12"/><?php } else {?><img src="img/ico/mail2.png" width="12" height="12"/><?php }?>Отрядные сообщения <?php if ($clan_mes > '0') {?>[<span class="gold"><?php echo "$clan_mes";?></span>]<?php }?></a><?php }?>
<?php if ($user != '1') {?>
<a href="mod_chat.php" class="menu"><?php if ($mc == '0') {?><img src="img/ico/mail3.png" width="12" height="12"/><?php } else {?><img src="img/ico/mail2.png" width="12" height="12"/><?php }?>Комната совещаний <?php if ($mc > '0') {?>[<span class="gold"><?php echo "$mc";?></span>]<?php }?></a>
<?php }?>
<?php if ($user != '1') {?>
<a href="tex_list.php" class="menu"><?php if ($row_ti == '0') {?><img src="img/ico/mail3.png" width="12" height="12"/><?php } else {?><img src="img/ico/mail2.png" width="12" height="12"/><?php }?>Техподдержка <?php if ($row_ti > '0') {?>[<span class="gold"><?php echo "$row_ti";?></span>]<?php }?></a>
<?php } else {?><a href="tex.php" class="menu"><?php if ($row_ti1 == '0') {?><img src="img/ico/mail3.png" width="12" height="12"/><?php } else {?><img src="img/ico/mail2.png" width="12" height="12"/><?php }?>Техподдержка</a> <?php if ($row_ti1 > '0') {?>[<span class="gold"><?php echo "$row_ti1";?></span>]<?php }?><?php }?>
<a href="auction.php" class="menu"><img src="img/ico/auc.png" width="12" height="12"/>Аукцион <?php if ($message1 > '0') {?>[<span class="gold"><?php echo "$message1";?></span>]<?php }?></a>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>