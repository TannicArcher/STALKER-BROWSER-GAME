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
$skad = $row4['skadovs'];
$query = "update users set location = 'skadovsk' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div id="main">
<?php if ($skad == '0') {?>
<div style="border-style: solid; border-width: 1px; border-color: #444e4f;">
<div style="float: left;">
<img src="img/ico/bor.png"/>
</div>
<p><span class="gold">Борода:</span> <span class="bonus">Вижу, ты здесь впервые. Ну что ж, давай осваивать новое место: <span class="white">Сыч</span> - это наш торговец. Может он и барыга, но товар у него качественный. <span class="white">Гонта</span> - охотник на мутантов. Скупает разные части их тел. <span class="white">Дядька Яр</span> - "свободовец" в отставке. Всё беспокоится о защите Скадовска - платит сталкерам за друзей, которых они сюда приглашают. <span class="white">Тремор</span> - это местный медик. Странный он какой-то... К нему заходи, если нужны аптечки или антирады. <span class="white">Кардан</span> - это наш техник. Со снарягой он на "ты", но бухарь - страшный. Без бутылки жить не может... <span class="white">Глухарь</span> - сторожила. Следит за порядком на скадовске и близ лежащих территориях. Помощников день со днем не сыщешь, поэтому если нужны деньги - зайди к нему, уж у него то точно найдется работенка. <span class="white">Коряга</span> - меняла. Меняет <span class="blue">чеки</span> на <span class="blue">RUB</span>. <span class="white">Султан</span> - лидер "Бандитов". Тот еще дикарь... Но он тоже полезным делом занимается - лотереей. Поэтому заходи к нему, если хочешь испытать удачу. <span class="white">Лоцман</span> - это наш проводник. Сейчас он не предоставляет никаких услуг, так как его единственный путь перегорадили логова опасных мутантов. Сейчас он рассказывает сталкерам об аномалиях. Ну а я, точнее, <span class="white">Борода</span>, так меня прозвали сталкеры, торгую артефактами и детекторами. Если найдешь в аномалии что-то ценное - тащи ко мне, посмотрю. На этом вроде бы всё, рассказал тебе - теперь обживайся на новом месте.</span></p>
</div>
<?php
$query = "update users set skadovs='1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<center><div class="name">Скадовск</div></center>
<div class="stats">
<img src="img/ico/skad1.png" alt="Скадовск" width="100%"/>
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