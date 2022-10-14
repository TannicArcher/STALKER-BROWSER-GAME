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
$page_title = 'Урон в битве';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$clan = $row['clan'];
$query1 = "Select * from users where clan='$clan' order by bit_y desc limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$id1 = $row1['id'];
$query_num = "Select id from users where clan='$clan' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total = mysqli_num_rows($result_num);
?>
<?php if ($clan == '0') {?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
?>
<div id="main">
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Урон в битве:</p></center>
</div>
	<?php
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 10;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total / $result_per_page);
	if ($num_page > 0) {
$query_sub = "Select * from users where clan='$clan' order by bit_y desc limit $skip, $result_per_page";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id = $row_sub['id'];
$nick = $row_sub['nick'];
$lvl = $row_sub['lvl'];
$bit_y = $row_sub['bit_y'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$gruppa = $row_sub['gruppa'];
$last_active = $row_sub['last_active'];
$last_active = strtotime("$last_active");
$razn_last_act = ($now - $last_active);
?>
<p><span class="net" style="vertical-align: super"><?php echo "$lvl";?></span><?php
if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><?php }
?> <?php if ($id1 == $id) {?><img src="img/lider.png"/> <?php }?> <a <?php if ($id != $user_id) {?>class="white"<?php } else {?>class="bonus"<?php }?> href="profile.php?id=<?php echo "$id";?>"><?php echo "$nick";?></a> <small><span class="lal">[<?php echo "$bit_y";?>]</span></small></p>
<p style="border-top:1px ridge #444e4f;"></p>
<?php 
}
}
?>
<?php
require_once('conf/naviga.php');
?>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>