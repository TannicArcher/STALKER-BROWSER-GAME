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
}
$page_title = 'Лот';
require_once('conf/head.php');
require_once('conf/top.php');
$lot = $_GET['lot'];
$lot = htmlentities($lot, ENT_QUOTES);
$lot = mysqli_real_escape_string($dbc, trim($lot));
if (empty($lot)) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
  $query_lot = "Select  thing_id, price,price_now from auction where id_lot='$lot' limit 1";
  $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД');
  $row_lot = mysqli_fetch_array($result_lot);
if ($row_lot == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
  $thing_id=$row_lot['thing_id'];
  $query_th = "Select inf_id,stat1,stat2, stat3, upgrade_stat3 ,speed, sost,privat,thing_id, upgrade_speed, upgrade_stat1, upgrade_stat2, type from things where thing_id='$thing_id' limit 1";
  $result_th = mysqli_query($dbc, $query_th) or die ('Ошибка передачи запроса к БД');
  $row_th = mysqli_fetch_array($result_th);
  $inf_id=$row_th['inf_id'];
if ($row_th == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}  
  $type=$row_th['type'];
if ($type == 1) {
  $query_c = "Select screen, name, klass from clothes where clothes_id = '$inf_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 2) {
  $query_c = "Select screen, name, klass from pistols where pistols_id = '$inf_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
if ($type == 3) {
  $query_c = "Select screen, name,klass from weapons where weapons_id = '$inf_id' limit 1";
  $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_c);
}
?>
<div id="main">
  <div class="stats">
    <p class="podmenu">Лот</p>
  </div>
  <div class="stats">
    <p><img src="img/ico/left.png" /> <a href="a_clothes.php">Назад к аукциону</a></p>
  </div>
  <?php 
  $user_id = $_SESSION['id'];
  $query = "Select lvl,money, habar from users where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $money = $row['money'];
  $habar = $row['habar'];
  $lvl = $row['lvl'];
  ?>
  <div class="stats">
    <p>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo "$money"; ?></span>] [<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo "$habar"; ?></span>]</p>
  </div>
  <?php
  $err = $_GET['err'];
  if (!empty($err)) {?>
  <div id="error">
  <?php if ($err == 1) {echo 'У вас недостаточно средств';}?>
  </div>
  <?php
  }
  ///////////////////////////////////////////////////////
  if ($type == 1) {
    ?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/clothes/<?php echo $row_cl['screen'];?>" alt="." /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><span class="white"><?php echo $row_cl['name']; ?></span>, новый</p>
        <p><?php
		if ($upgrade_stat2 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat2 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat2 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat2 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?>
		 Броня: <span class="white"><?php echo "$prochn";?></span> </p>
        <p><?php
		if ($upgrade_stat1 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat1 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat1 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat1 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Здор: <span class="white"><?php echo "$hp";?></span> 
		</p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	<div class="clothes">
	  <p><?php
		if ($upgrade_stat3 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat3 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat3 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat3 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Прочность: <span class="white"><?php echo "$razriv";?></span></p>
	  <p><?php
		if ($upgrade_speed == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_speed == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_speed == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_speed >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Рад. защ: <span class="white"><?php echo "$radiation";?></span>
		</p>
	</div>
	<?php
  
  
  }
  ///////////////////////////////////////////////////////
?>
</div>  
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>