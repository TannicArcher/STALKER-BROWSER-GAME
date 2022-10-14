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
$page_title = 'Контейнеры артефактов';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$art_n = $row['art_n'];
$art1 = $row['art1'];
$art2 = $row['art2'];
$art3 = $row['art3'];
$art4 = $row['art4'];
$art5 = $row['art5'];
$art_sum = ($art1 + $art2 + $art3 + $art4 + $art5);
$profile = $row['profile'];
?>
<div id="main">
<div class="stats">
  <p class="podmenu">Контейнеры для артефактов</p>
<p>Имеется: <?php echo "$art_sum";?> артефактов</p>
<p>Было найдено: <?php echo "$art_n";?> артефактов</p>
</div>
<?php if ($art1 > '0') {?>
<div class="stats">
<p class="lal">Огненный шар</p>
<a href="boroda.php?type=5&id=1">
<p><img src="img/art/4.gif"></p>
</a>
</div>
<div class="stats">
<p><?php echo "$art1";?> штук</p>
</div>
<?php }?>
<?php if ($art2 > '0') {?>
<div class="stats">
<p class="lal">Кристалл</p>
<a href="boroda.php?type=5&id=2">
<p><img src="img/art/1.gif"></p>
</a>
</div>
<div class="stats">
<p><?php echo "$art2";?> штук</p>
</div>
<?php }?>
<?php if ($art3 > '0') {?>
<div class="stats">
<p class="lal">Глаз</p>
<a href="boroda.php?type=5&id=3">
<p><img src="img/art/7.png"></p>
</a>
</div>
<div class="stats">
<p><?php echo "$art3";?> штук</p>
</div>
<?php }?>
<?php if ($art4 > '0') {?>
<div class="stats">
<p class="lal">Выверт</p>
<a href="boroda.php?type=5&id=4">
<p><img src="img/art/6.gif"></p>
</a>
</div>
<div class="stats">
<p><?php echo "$art4";?> штук</p>
</div>
<?php }?>
<?php if ($art5 > '0') {?>
<div class="stats">
<p class="lal">Мамины бусы</p>
<a href="boroda.php?type=5&id=5">
<p><img src="img/art/8.png"></p>
</a>
</div>
<div class="stats">
<p><?php echo "$art5";?> штук</p>
</div>
<?php }?>
</div>
<p><a href="<?php if ($profile == '2') {?>me.php<?php } else {?>profile.php?id=<?php echo "$user_id";?><?php }?>" class="menu"><img src="img/reload.gif" width="12" height="12" /> Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>