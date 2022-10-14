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
$page_title = 'Сообщение';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<div id="main">
<?php
$user_id = $_SESSION['id'];
$mes_id = $_GET['mes_id'];
$h = getenv("HTTP_REFERER");
$mes_id = htmlentities($mes_id, ENT_QUOTES);
$mes_id = mysqli_real_escape_string($dbc, trim($mes_id));
$query = "Select * from message where message_id='$mes_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
$row = mysqli_fetch_array($result);
$notread = $row['reading'];
$ot = $row['ot'];
$dlya=$row['dlya'];
$dlya = mysqli_real_escape_string($dbc, trim($dlya));
$total = mysqli_num_rows($result);
if (!empty($total) and ($row['ot']==$user_id or $row['dlya'] == $user_id) and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
///////////////////////////////Точно знаем, что сообщение пользователя и оно существует 
//////ТЕКСТ НАЧАЛО
  if ($ot == $user_id and $row['type'] == 1) {
    $query_user = "Select nick from users where id='$dlya' limit 1";
    $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
    $row_user = mysqli_fetch_array($result_user);
	$query_send = "Select nick, lvl,gruppa,id,admin from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $dlya;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение для <?php echo $row_user['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$admin = $row_send['admin'];
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span></p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p <?php if ($admin <> 0) {?>class="admin_msg"<?php } else {?>class="white"<?php }?> style="padding-bottom:4px; padding-top:4px;"><?php echo $row['text'];?></p>
	<?php
  }
  if ($dlya == $user_id and $row['type'] == 1) {
	$query_send = "Select nick, lvl,gruppa,id, admin from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	if ($notread <> 1) {
	$query_up = "update message set reading=1 where message_id = '$mes_id' limit 1";
    $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	$query_up = "select message from users where id='$user_id' limit 1";
    $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
    $read= mysqli_fetch_array($result_up);
    $unread_mes=$read['message'];
    $message = ($unread_mes - 1);
	$query_up = "update users set message = '$message' where id='$user_id' limit 1";
    $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
	}
	$to = $ot;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение от <?php echo $row_send['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$admin = $row_send['admin'];
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span> [<a href="mail1.php?post=<?php echo $row_send['id']; ?>">переписка</a>]</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p <?php if ($admin <> 0) {?>class="admin_msg"<?php } else {?>class="white"<?php }?> style="padding-bottom:4px; padding-top:4px;"><?php echo $row['text'];?></p>
	<?php
  }
//////ТЕКСТ КОНЕЦ
//////ШМОТКА НАЧАЛО
  if ($ot == $user_id and $row['type'] == 2) {
    $query_user = "Select nick from users where id='$dlya' limit 1";
    $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
    $row_user = mysqli_fetch_array($result_user);
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $dlya;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение для <?php echo $row_user['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span>,</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;">(Cнаряжeние:<?php echo $row['text'];?>)</p>
	<?php
  }
  if ($dlya == $user_id and $row['type'] == 2) {
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $ot;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение от <?php echo $row_send['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span>,</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;">(Cнаряжение:<?php echo $row['text'];?>)</p>
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
  }
////////ШМОТКА КОНЕЦ
//////ДЕНЬГИ НАЧАЛО
  if ($ot == $user_id and $row['type'] == 3) {
    $query_user = "Select nick from users where id='$dlya' limit 1";
    $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
    $row_user = mysqli_fetch_array($result_user);
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $dlya;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение для <?php echo $row_user['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/naemnikion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span>,</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
<p class="white" style="padding-bottom:4px; padding-top:4px;"><img src="img/ico/money.png" width="12" height="12"/> <?php echo $row['thing'];?></p>
	<?php
  }
  if ($dlya == $user_id and $row['type'] == 3) {
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $ot;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение от <?php echo $row_send['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/naemnikion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span>,</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;"><img src="img/ico/money.png" width="12" height="12"/> <?php echo $row['thing'];?></p>
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
  }
/////////Деньги Конец
//////ХАБАР НАЧАЛО
  if ($ot == $user_id and $row['type'] == 4) {
    $query_user = "Select nick from users where id='$dlya' limit 1";
    $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
    $row_user = mysqli_fetch_array($result_user);
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $dlya;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение для <?php echo $row_user['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/naemnikion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span>,</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;"><img src="img/ico/materials.png" width="12" height="12"/> <?php echo $row['thing'];?></p>
	<?php
  }
  if ($dlya == $user_id and $row['type'] == 4) {
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $ot;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение от <?php echo $row_send['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/naemnikion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span>,</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;"><img src="img/ico/materials.png" width="12" height="12"/> <?php echo $row['thing'];?></p>
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
  }
/////////Деньги ХАБАР
//////АПТЕЧКИ НАЧАЛО
  if ($ot == $user_id and $row['type'] == 5) {
    $query_user = "Select nick from users where id='$dlya' limit 1";
    $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
    $row_user = mysqli_fetch_array($result_user);
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $dlya;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение для <?php echo $row_user['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/naemnikion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span>,</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;"><img src="img/ico/apte4ka.png" width="12" height="12"/> <?php echo $row['thing'];?></p>
	<?php
  }
  if ($dlya == $user_id and $row['type'] == 5) {
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $ot;
	?>
	<div class="stats">
    <p class="podmenu">Сообщение от <?php echo $row_send['nick'];?></p>
    </div>
	<div class="stats">
	<p>
	<?php
	$gruppa= $row_send['gruppa'];
	if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa == 'naemniki') {?><img src="img/ico/naemnikion.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo $row_send['id']; ?>"><?php echo $row_send['nick'];?></a> <span class="white">(<?php echo $row_send['lvl']; ?> ур.)</span>,</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;"><img src="img/ico/apte4ka.png" width="12" height="12"/> <?php echo $row['thing'];?></p>
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
  }/////////АПТЕЧКИ КОНЕЦ
    if ($dlya == $user_id and $row['type'] == 6) {////////Ставка начало
	?>
	<div class="stats">
    <p class="podmenu">Аукцион</p>
    </div>
	<div class="stats">
	<p class="white">Вашу ставку в [<img src="img/ico/money.png" width="12" height="12"/><?php echo $row['thing'];?>] за <a href="lot.php?lot=<?php echo "$ot";?>"><?php echo $row['text'];?></a></p><br />
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
	?></div><?php
  }
/////////СТАВКА конец
//////ШМОТКА НАЧАЛО АУК
  if ($dlya == $user_id and $row['type'] == 7) {
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $ot;
	?>
	<div class="stats">
    <p class="podmenu">Аукцион</p>
    </div>
	<div class="stats">
	<p class="white">Вы приобрели лот.</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;">(Cнаряжение:<?php echo $row['text'];?>)</p>
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
  }
////////ШМОТКА КОНЕЦ АУК
if ($dlya == $user_id and $row['type'] == 8) {////////Ставка начало
	?>
	<div class="stats">
    <p class="podmenu">Аукцион</p>
    </div>
	<div class="stats">
	<p class="white">Ваш лот (<?php echo $row['text']; ?>) купили за [<img src="img/ico/money.png" width="12" height="12"/><?php echo $row['thing'];?>]</p><br />
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
	?></div><?php
  }
/////////СТАВКА конец
//////ШМОТКА НАЧАЛО АУК
  if ($dlya == $user_id and $row['type'] == 9) {
	$query_send = "Select nick, lvl,gruppa,id from users where id='$ot' limit 1";
    $result_send = mysqli_query($dbc, $query_send) or die ('Ошибка передачи запроса к БД');
    $row_send = mysqli_fetch_array($result_send);
	$to = $ot;
	?>
	<div class="stats">
    <p class="podmenu">Аукцион</p>
    </div>
	<div class="stats">
	<p class="white">Вы не продали лот.</p>
	<p><span class="clothes"><?php echo $row['time'];?></span><p>
	</div>
	<p class="white" style="padding-bottom:4px; padding-top:4px;">(Cнаряжение:<?php echo $row['text'];?>)</p>
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
  }
////////ШМОТКА КОНЕЦ АУК
if ($dlya == $user_id and $row['type'] == 10) {////////Ставка начало
	?>
	<div class="stats">
    <p class="podmenu">Банк игры</p>
    </div>
	<div class="stats">
	<p class="white">Пополнение счёта на [<img src="img/ico/money.png" width="12" height="12"/><?php echo $row['thing'];?>]</p><br />
	<?php
	if ($row['reading'] <> 1) {
    ?>
	<p style="padding-bottom:4px;">[<a href="takething.php?mes_id=<?php echo "$mes_id";?>">ЗАБРАТЬ ИЗ ПОЧТЫ</a>]</p>
	<?php
	}
	else {
	?>
	<p style="padding-bottom:4px;">[Уже забрано]</p>
	<?php
	}
	?></div><?php
  }
/////////СТАВКА конец

if ($row['type'] <> 6 and $row['type'] <>7 and $row['type'] <>8 and $row['type'] <>9 and $row['type'] <>10) {
?>
<div class="zx"style="padding-bottom:4px; border-bottom: dotted #444e4f 1px;" >
<p>Сообщение:</p>
<form enctype="multipart/form-data" method="post" action="sendmessage.php?type=1&set_id=<?php echo "$to"; ?>">
<textarea rows="2" cols="35px" name="text">
</textarea>
<div class="knopka">
<input type="submit" style="width:67px;" class="input" value="Отправить" name="addad"/> Стоимость:<img src="img/ico/materials.png" width="12" height="12"/><span class="white"> 1 </span>
</div>
</form></br>
<p><img src="img/reload.gif" width="12" height="12"/> <a href="<?php echo "$h"; ?>">Назад</a></p>
<p><img src="img/ico/letter.png" width="12" height="12"/> <a href="send.php?set_id=<?php echo "$to"; ?>">Отправить посылку</a></p>
</div>
<?php
}
}
else {
require_once('conf/notfound.php');
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