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
$page_title = 'Поиск';
require_once('conf/head.php');
require_once('conf/top.php');;
?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<p><span class="bonus"><i><b>Для поиска сталкера введите его ник в поле:</b></i></span></p>
<form enctype="multipart/form-data" method="post" action="poisk1.php">
<input type="text" style="width:150px; height:18px;" class="input" name="post" />
<input type="submit" style="width:50px;" class="input" value="искать" name="addchat"/>
</form>
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Найдено:</p>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>

<?php
$post = $_POST['post'];
if (empty($post)) {
$post = 'qwsadftrthd1';
}
$query_sub = "Select * from users where nick LIKE '%$post%' and gruppa <> 'mytants' and gruppa <> 'zombie' and gruppa <> 'monolit' and gruppa <> 'bandits' order by lvl desc limit 25";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
$now = (date("Y-m-d H:i:s"));
      $now = strtotime("$now");
	  while ($row_sub = mysqli_fetch_array($result_sub)) {
		$gruppa = $row_sub['gruppa'];
		$last_active = $row_sub['last_active'];
		$lvl = $row_sub['lvl'];
        $last_active = strtotime("$last_active");
        $razn_last_act = ($now - $last_active);
	$opit = $row_sub['opit'];
$id_top = $row_sub['id'];
$name = $row_sub['nick'];
?>
<?php
if ($gruppa == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?> <a href="profile.php?id=<?php echo "$id_top"; ?>"><?php echo "$name";?></a> [<span class="white"><?php echo "$lvl"; ?>ур</span>]<br />
<?php 
}
?>
<p class="podmenu" style="border-top:1px dashed #444e4f; background-color:#1c252f;"></p>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>