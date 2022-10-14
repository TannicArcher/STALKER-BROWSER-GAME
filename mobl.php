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
$page_title = 'Объявление';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query = "update users set location = 'mail', mobl_read='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query1 = "Select * from users where id='$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$mobl = $row1['mobl'];
?>
<?php
$query_num = "Select read_id from read_top where top=99999993 and user = '$user_id' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total = mysqli_num_rows($result_num);
$query_num = "Select read_id from read_top where top=99999993 " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД50');
$total1 = mysqli_num_rows($result_num);
?>
<?php
if (empty($total)) {
$query_add_ch = "insert into read_top (`top`, `user`) values ('99999993', '$user_id')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$total1 = ($total1 + '1');
}
?>
<div id="main">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Объявление</p></center>
</div>
<p>Просмотров: <?php echo "$total1";?></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<div class="stats">
<p class="gold"><?php echo "$mobl";?></p>
</div>
<p><img src="img/reload.gif" width="12" height="12"/><a href="mailbox.php">Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
</div>
<?php



//////////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>