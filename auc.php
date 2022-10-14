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
$page_title = 'Аукцион/Снаряжение';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<div id="main">
<center><div class="name">Торговля</div></center>
<?php
$user_id = $_SESSION['id'];
$query = "Select * from things where user_id='$user_id' and place=3";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result);
?>
<?php if ($total > '0') {?><p class="podmenu">Вещей на аукционе: [ <?php echo "$total";?> ]</p><?php } else {?>Вы еще не выставили на аукцион ни одной вещи.<?php }?>
    <?php
$query_cl = "SELECT * FROM  `things` WHERE  `user_id` = '$user_id' AND  `place` =3 LIMIT 0 , 30";
$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
while ($row_cl = mysqli_fetch_array($result_cl)) {
        $thing_id = $row_cl['thing_id'];
	$sostoyanie_1 = $row_cl['sost'];
	$upgrade_speed = $row_cl['upgrade_speed'];
	$upgrade_stat1 = $row_cl['upgrade_stat1'];
	$upgrade_stat2 = $row_cl['upgrade_stat2'];
	$upgrade_stat3 = $row_cl['upgrade_stat3'];
	$razriv = $row_cl['stat3'];
	$hp = $row_cl['stat1'];
	$radiation = $row_cl['speed'];
	$prochn = $row_cl['stat2'];
	$cl_id = $row_cl['inf_id'];
	$privat = $row_cl['privat'];
$type = $row_cl['type'];
$query = "Select * from auction where thing_id='$thing_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row_a = mysqli_fetch_array($result);
$auct = $row_a['price_user'];
?>
<?php
if ($type == '1') {
	$query_cl1 = "Select screen,name,klass from clothes where clothes_id = '$cl_id'";
	$result_cl1 = mysqli_query($dbc, $query_cl1) or die ('Ошибка передачи запроса к БД');
	$row_cl1 = mysqli_fetch_array($result_cl1);
}
if ($type == '2') {
	$query_cl1 = "Select screen,name,klass from pistols where pistols_id = '$cl_id'";
	$result_cl1 = mysqli_query($dbc, $query_cl1) or die ('Ошибка передачи запроса к БД');
	$row_cl1 = mysqli_fetch_array($result_cl1);
}
if ($type == '3') {
	$query_cl1 = "Select screen,name,klass from weapons where weapons_id = '$cl_id'";
	$result_cl1 = mysqli_query($dbc, $query_cl1) or die ('Ошибка передачи запроса к БД');
	$row_cl1 = mysqli_fetch_array($result_cl1);
}
?>
<?php if ($auct == '0') {?>
<a href="thing1.php?thing=<?php echo "$thing_id";?>" style="text-decoration:none"><div class="r2">
<p class="button3"><?php echo $row_cl1['name'];?></p>
<center><p><?php
if ($type == '1') {?>
<img src="img/clothes/<?php echo $row_cl1['screen'];?>" alt="Броня" width="50" height="50"/> 
<?php }
if ($type == '2') {?>
<img src="img/weapons/<?php echo $row_cl1['screen'];?>" alt="Пистолет" width="60" height="50"/> 
<?php }
if ($type == '3') {?>
<img src="img/weapons/<?php echo $row_cl1['screen'];?>" alt="Автомат" width="145" height="50"/> 
<?php }
?>
</p></center>
</div>
</a>
<?php } else {?>
<div class="r2" style="background-color: #000010;">
<p class="button3"><?php echo $row_cl1['name'];?></p>
<center><p><?php
if ($type == '1') {?>
<img src="img/clothes/<?php echo $row_cl1['screen'];?>" alt="Броня" width="50" height="50"/> 
<?php }
if ($type == '2') {?>
<img src="img/weapons/<?php echo $row_cl1['screen'];?>" alt="Пистолет" width="60" height="50"/> 
<?php }
if ($type == '3') {?>
<img src="img/weapons/<?php echo $row_cl1['screen'];?>" alt="Автомат" width="145" height="50"/> 
<?php }
?>
</p></center>
<center><b>На торгах</b></center>
</div>
<?php }?>

<?php
}
?>
</div>


<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>