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
$page_title = 'Скадовск';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query4 = "Select * from users where id='$user_id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row4 = mysqli_fetch_array($result4);
?>

<div id="main">
<center><div class="name">Бар</div></center>
<div class="stats">
<img src="img/ico/skad1.png" alt="Бар" width="100%"/>
</div>
<div class="stats">
<center><div class="name">Пройти к:</div></center>
<div class="link"><a href="salesman.php" class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Сычу</a></div>
<div class="link"><a href="z_zver.php" class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Гонте</a></div>
<div class="link"><p class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Дядьке Яру</p></div>
<div class="link"><a href="tremor.php?sl=0" class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Тремору</a></div>
<div class="link"><a href="masters.php" class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Кардану</a></div>
<div class="link"><a href="koryaga.php" class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Коряге</a></div>
<div class="link"><a href="sultan.php" class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Султану</a></div>
<div class="link"><a href="boroda.php?type=1" class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Бороде</a></div>
<div class="link"><a href="locman.php?type=1" class="link"><img src="img/ico/link.png" width="12" height="12" alt="."/> Лоцману</a></div>
<p style="border-top: solid 1px #444e4f;"></p>
<p><a href="zonas.php" class="menu1"><img src="img/ico/left.png" alt="."/> Выйти</a></p>
</div>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>