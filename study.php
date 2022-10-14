<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  header ('Location: reg.php?err_login=1');
  exit();
}
$user_id=$_SESSION['id'];
require_once('conf/ban.php');
$query = "Select lvl,gruppa,nick from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
if ($row['lvl'] > 70) {
  header ('Location: index.php');
  exit();
}
$step = $_GET['step'];
if (empty($step)) {
  $step=2;
}
if ($lvl>4) {
  $step=3;
}
if ($step == 1) {
  if ($row['gruppa'] == 'dolg') {
    $img='dolg_l.png';
	$name='Шульга';
	$gruppa = '"ДОЛГ"';
	$page_title = 'Лидер Долга';
  }
  if ($row['gruppa'] == 'svoboda') {
    $img='svoboda_l.png';
	$name='Локи';
	$gruppa = '"СВОБОДА"';
	$page_title = 'Лидер Свободы';
  }
  if ($row['gruppa'] == 'naemniki') {
    $img='odinochki_l.png';
	$name='Стрелок';
	$gruppa = '"ОДИНОЧКИ"';
	$page_title = 'Лидер Одиночек';
  }
  require_once('conf/head.php');
  require_once('conf/top.php');
  ?>
  <div id="main">
  <div class="stats">
  <table width="175" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="55" valign="top"><img src="img/ico/<?php echo "$img"?>" border="0"/></td>
    <td width="120" valign="top">
	<div class="inf">
    <p class="white"><b><?php echo "$name"?></b></p>
	<p class="white"><?php
	if ($row['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/> <?php echo "Свобода";}
	if ($row['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/> <?php echo "Долг";}
	if ($row['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/> <?php echo "Одиночки";}
	?></p>
	<p>Ранг:<span class="white"> Лидер</span></p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
  </div>
  <div class="stats">
  <p class="white">- Приветствую, сталкер. Я рад, что ты присоединился именно к нашей группировке.</p>
  <p class="white">- Наш оружейник выдал тебе стандартный комплект снаряжения (ПМм и кожанку). Как вижу, ты их уже примерил.</p><br />
  <p class="bonus">[Совет: для начала зайдите в рейды, атакуйте слепого пса. Как только наберете 1000 хабара - купите себе обрез, это значительно облегчит выживание в зоне]</p><br />
  <p class="white">- Ну что ж, в путь!</p>
  <div class="zx">
  <p>- <a class="white" href="index.php">До встречи</a></p>
  </div>
  </div>
  <?php
}
if ($step==2) {
  $page_title = 'Стрельбище';
  require_once('conf/head.php');
  require_once('conf/top.php');
  $query = "update users set location = 'study' where id = '$user_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  ?>
  <div id="main">
  <?php 
  $err=$_GET['err'];
  if ($err== 3) {?><div id="error">Оружие ещё перезаряжается, следите за индикатором выше.</div><?php }
  ?>
  <div class="stats">
  <table width="175" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="55" valign="top"><img src="img/ico/target.png" border="0"/></td>
    <td width="120" valign="top">
	<div class="inf">
    <p class="white"><b>Цель</b></p>
	<p>Неподвижная</p>
	<p><span class="white"><b>50м</b></span></p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
  </div>
  <div class="stats">
  <p class="white"><img src="img/ico/pistol.png" alt="p" width="12" height="12"/> <a href="attack.php?group=monolits&rand=1">Стрелять с пистолета</a></p>
  <div class="zx">
  <p>- <a href="study.php?step=3">Я пристрелял оружие.</a></p>
  </div>
  </div>
  <?php
  require_once('conf/log.php');
}
if ($step==4) {
  if ($row['gruppa'] == 'dolg') {
    $img='dolg_l.png';
	$name='Воронин';
	$gruppa = '"ДОЛГ"';
	$page_title = 'Лидер Долга';
  }
  if ($row['gruppa'] == 'svoboda') {
    $img='svoboda_l.png';
	$name='Лукаш';
	$gruppa = '"СВОБОДА"';
	$page_title = 'Лидер Свободы';
  }
  if ($row['gruppa'] == 'naemniki') {
    $img='odinochki_l.png';
	$name='Фенский';
	$gruppa = '"ОДИНОЧКИ"';
	$page_title = 'Лидер Одиночек';
  }
  require_once('conf/head.php');
  require_once('conf/top.php');
  ?>
  <div id="main">
  <div class="stats">
  <table width="175" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="55" valign="top"><img src="img/ico/<?php echo "$img"?>" border="0"/></td>
    <td width="120" valign="top">
	<div class="inf">
    <p class="white"><b><?php echo "$name"?></b></p>
	<p class="white"><?php
	if ($row['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/> <?php echo "Свобода";}
	if ($row['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/> <?php echo "Долг";}
	if ($row['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/> <?php echo "Одиночки";}
	?></p>
	<p>Ранг:<span class="white"> Лидер</span></p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
  </div>
  <div class="stats">
  <p class="white"> - Вот, тот самый минимум, который тебе необходимо знать:</p>
  <p> * Вся группировка поделена на <a class="white" href="listcompany.php">отряды</a>.</p>
  <p> ** Отряды контролируются своими лидерами</p>
  <p> * <a href="zona.php" class="white">В зоне</a> ведутся ожесточённые бои за захват территорий</p>
  <p> ** Хабар из зоны ты можешь обменять на оружие у <a class="white" href="salesman.php">Торговца</a></p>
  <p> * Также сталкеры зодят на <a href="zona.php" class="white">Рейды</a></p>
  <p> ** За успешный рейд вы можете найти какую-нибудь вещь или хабар</p>
  <p> * У <a class="white" href="masters.php">мастера</a>, сталкеры улучшают своё оружие</p>
  <div class="clothes"><p class="bonus">[Всю подробную информацию вы можете найти в разделе <a class="white" href="help.php">помощь</a>]</p>
  </div><br />
  <div class="zx">
  <p>- <a class="white" href="index.php">Спасибо, я всё понял.</a></p>
  </div>
  </div>
  <?php
}
if ($step==3) {
  if ($row['gruppa'] == 'dolg') {
    $img='dolg_l.png';
	$name='Воронин';
	$gruppa = '"ДОЛГ"';
	$page_title = 'Лидер Долга';
  }
  if ($row['gruppa'] == 'svoboda') {
    $img='svoboda_l.png';
	$name='Лукаш';
	$gruppa = '"СВОБОДА"';
	$page_title = 'Лидер Свободы';
  }
  if ($row['gruppa'] == 'naemniki') {
    $img='odinochki_l.png';
	$name='Фенский';
	$gruppa = '"ОДИНОЧКИ"';
	$page_title = 'Лидер Одиночек';
  }
  require_once('conf/head.php');
  require_once('conf/top.php');
  ?>
  <div id="main">
  <div class="stats">
  <table width="175" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="55" valign="top"><img src="img/ico/<?php echo "$img"?>" border="0"/></td>
    <td width="120" valign="top">
	<div class="inf">
    <p class="white"><b><?php echo "$name"?></b></p>
	<p class="white"><?php
	if ($row['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/> <?php echo "Свобода";}
	if ($row['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/> <?php echo "Долг";}
	if ($row['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/> <?php echo "Одиночки";}
	?></p>
	<p>Ранг:<span class="white"> Лидер</span></p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
  </div>
  <div class="stats">
  <p class="white">- Ты хорошо показал себя на Полигоне. Теперь ты можешь идти в бой.</p>
  <p class="white">- Но я могу ещё рассказать что, да как. Решать тебе.</p><br />
  <div class="zx">
  <p>- <a class="white" href="study.php?step=4">Я бы хотел послушать вас.</a></p>
  <p>- <a class="white" href="index.php">И так всё знаю.</a></p>
  </div>
  </div>
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