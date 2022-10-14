<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Аватары';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Аватары</p></center>
<?php
$user_id = $_SESSION['id'];
$t = $_GET['t'];
$vid = $_GET['v'];
$s = $_GET['s'];
$query4 = "Select * from users where id='$user_id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row4 = mysqli_fetch_array($result4);
$c_money = $row4['money'];
$sex = $row4['sex'];
$avatar = $row4['avatar'];
$t = round("$t");
$query4 = "Select * from ava where ava_id='$t' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row6 = mysqli_fetch_array($result4);
?>
<?php if ($vid == '1') {?>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Стоимость:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
Индивидуальный аватар стоит 3000 <img src="img/ico/money.png"/>RUB. <br/>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Правила загрузки:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
1. Формат картинки: jpg, jpeg или png.<br/>
2. Вес картинки не более 60кб.<br/>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Запрещено:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
1. Загружать картинки порнографического характера.<br/>
2. Загружать картинки с ругательными надписями или рекламой.<br/>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Внимание:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
Учтите, что если картинка будет превышать ограничение в 300x250 пикселей, то она будет сжата до ограничения.<br/><center>
<br/>
<p style="border-top:1px dashed #444e4f;"></p>
<form action="upload.php" method="post"
enctype="multipart/form-data">
<label for="file">Файл:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Загрузить" />
</form></center>
<p style="border-top:1px dashed #444e4f;"></p><br/>
<?php } else {?>
<?php
if (empty($t)) {
$t = '0';
}
if (empty($row6)) {
$t = '0';
}
if ($t == '137' and $user_id != '2447') {
$t = '0';
}
if ($t == '138' and $user_id != '1840') {
$t = '0';
}
if ($t == '156' and $user_id != '1093') {
$t = '0';
}
if ($t == '157' and $user_id != '530') {
$t = '0';
}
if ($t == '158' and $user_id != '3990') {
$t = '0';
}
?>
<?php if ($t != '0' and $c_money > '499') {
$query = "update users set avatar='$t', money=money-'500' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$buy = '1';
}
?>
<?php if ($s == '1') {
$query = "update users set avatar='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$buy = '2';
}
?>
<div id="main"><center>
<?php if ($buy == '1') {?>
<div class="stats">
<small><p class="lal2">Аватар успешно куплен!</p></small>
</div>
<?php }?>
<?php if ($buy == '2') {?>
<div class="stats">
<small><p class="lal2">Аватар успешно сброшен!</p></small>
</div>
<?php }?>
<?php if ($c_money < '500') {?>
<div class="stats">
<small><p class="lal">У вас не хватает денег для покупки</p></small>
</div>
<?php }?>
<div class="stats">
<small><p class="lal">*Цена аватара - 500 <img src="img/ico/money.png"/>RUB</p></small>
</div>
<a href="ava.php?v=1" class="menu1">Загрузить свой аватар</a>
<p style="border-top: 2px dotted #444e4f;"></p>
<?php if ($avatar <> '0') {?>
<div class="stats">
<a href="ava.php?s=1" class="menu" style="color: red;" onclick="return confirm ('Уверены?')">Сбросить аватар</a></div>
<?php }?>
<br/></center>
<?php if ($user_id == '2447') {?>
<a href="ava.php?t=137" onclick="return confirm ('Уверены?')"><img src="img/ava/137.png" width="80" height="80"/></a><br />
<?php }?>
<?php if ($user_id == '1840') {?>
<a href="ava.php?t=138" onclick="return confirm ('Уверены?')"><img src="img/ava/138.png" width="80" height="80"/></a><br />
<?php }?>
<?php if ($user_id == '1093') {?>
<a href="ava.php?t=156" onclick="return confirm ('Уверены?')"><img src="img/ava/156.png" width="80" height="80"/></a><br />
<?php }?>
<?php if ($user_id == '530') {?>
<a href="ava.php?t=157" onclick="return confirm ('Уверены?')"><img src="img/ava/157.png" width="80" height="80"/></a><br />
<?php }?>
<?php if ($sex == 'male') {?>
<?php
$total5 = '153'; 
?>
   <?php
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 10;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total5 / $result_per_page);
	if ($num_page > 0) {
$query_sub = "Select * from ava where ava_id != '137' and ava_id != '138' and ava_id != '156' and ava_id != '157' and ava_id != '158' order by ava_id desc limit $skip, $result_per_page";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id = $row_sub['ava_id'];
$screen = $row_sub['screen'];
?>
<a href="ava.php?t=<?php echo "$id";?>" onclick="return confirm ('Уверены?')"><img src="img/ava/<?php echo "$screen";?>" width="80" height="80"/></a><br />
<?php 
}
}
?>
<?php } else {?>
<?php
$total5 = '153'; 
?>
   <?php
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 10;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total5 / $result_per_page);
	if ($num_page > 0) {
$query_sub = "Select * from ava where ava_id != '137' and ava_id != '138' and ava_id != '156' order by ava_id desc limit $skip, $result_per_page";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id = $row_sub['ava_id'];
$screen = $row_sub['screen'];
?>
<a href="ava.php?t=<?php echo "$id";?>" onclick="return confirm ('Уверены?')"><img src="img/ava/<?php echo "$screen";?>" width="80" height="80"/></a><br />
<?php 
}
}
?>
<?php }?>
<?php
require_once('conf/naviga.php');
?>
<?php }?>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>