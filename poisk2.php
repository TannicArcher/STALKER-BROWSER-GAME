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
<p><span class="bonus"><i><b>Для поиска отряда введите его название в поле:</b></i></span></p>
<form enctype="multipart/form-data" method="post" action="poisk2.php">
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
$query_sub = "Select * from clans where name LIKE '%$post%' order by clan_opit desc limit 25";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
$now = (date("Y-m-d H:i:s"));
      $now = strtotime("$now");
	  while ($row_sub = mysqli_fetch_array($result_sub)) {
		$gruppa = $row_sub['gruppa'];
$id_top = $row_sub['clan_id'];
$name = $row_sub['name'];
?>
<?php
if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
?> <a href="clan.php?id=<?php echo "$id_top"; ?>"><?php echo "$name";?></a><br />
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