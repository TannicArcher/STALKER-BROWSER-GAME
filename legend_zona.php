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
$err = $_GET['err'];
$page_title = 'Рейтинги';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$query_us = "Select * from clans where gruppa <> 'lol' order by slava DESC";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
while ($row_us = mysqli_fetch_array($result_us)) {
$b_slava = $row_us['b_slava'];
$limm = ('100' + $b_slava);
$name = $row_us['name'];
$clan_id = $row_us['clan_id'];
$slava1 = $row_us['slava'];
$ssq = '0';

$query_sub = "Select * from users where clan = '$clan_id' order by lvl desc";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$slava = $row_sub['slava'];
?>
<?php
$ssq = ($ssq + $slava);
?>
<?php 
}
$mentorr = ($ssq / '100');
if ($mentorr > $limm) {
$mentorr = $limm;
}
?>
<?php
$query = "update clans set slava='$ssq', mentor='$mentorr' where clan_id = '$clan_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
	    <?php
	  }
	  ?>
<div id="main">
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Рейтинги игроков:</p>
</div>
<div class="stats">
<a href="opitrat.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> По опыту</a>
<a href="slava.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> По славе</a>
<a href="activerat.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> По активности</a>
<?php if ($err == '1') {?><div style="border-style: solid; border-width: 1px; border-color: #444e4f;"><?php }?>
<a <?php if ($err == '1') {?>class="white"<?php } else {?>class="menu"<?php }?> href="legend_zona.php?err=1"><img src="img/ico/link.png" width="12" height="12" alt="."/> Арена...</a>
<?php if ($err == '1') {?><p style="border-top:1px solid #444e4f;"></p>
<a href="winrat.php" class="menu"><img src="img/ico/letterin1.png" width="12" height="12"/> По победам</a>
<a href="overrat.php" class="menu"><img src="img/ico/letterout1.png" width="12" height="12"/> По поражениям</a>
<?php }?>
<?php if ($err == '1') {?></div><?php }?>
<a href="artrat.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> По найденным артефактам</a>
<a href="rating.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> По вооружению</a>
<a href="vzlom_rat.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> По взлому тайников</a>
<a href="ohotniki.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> По убитым мутантам</a>
<a href="zadania_rat.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> По выполненным заданиям</a></p>
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Рейтинги отрядов:</p>
</div>
<a href="clans.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> Самые престижные отряды</a>
<a href="listcompany.php" class="menu"><img src="img/ico/link.png" width="12" height="12" alt="."/> Самые опытные отряды</a>
</div>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>