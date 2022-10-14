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
$page_title = 'Анкета';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php 
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
  header('Cache-Control: no-store, no-cache, must-revalidate'); 
  header('Cache-Control: post-check=0, pre-check=0', FALSE); 
  header('Pragma: no-cache'); 
?> 
<?php
$user_id1 = $_SESSION['id'];
$user_id = $_GET['id'];

if (empty($user_id)) {
$user_id = $user_id1;
}
$query_an = "Select * from anketa where user_id = '$user_id' limit 1";
$result_an = mysqli_query($dbc, $query_an) or die ('Ошибка передачи запроса к БД');
$row_an = mysqli_fetch_array($result_an);
$name = $row_an['name'];
$family = $row_an['family'];
$city = $row_an['city'];
$foto = $row_an['photo'];
$nation = $row_an['nation'];
$history = $row_an['history'];
$vk = $row_an['vk'];
$spaces = $row_an['spaces'];
$bd1 = $row_an['day_bd'];
$bd2 = $row_an['month_bd'];
$bd3 = $row_an['age_bd'];

$query4 = "Select * from users where id='$user_id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row4 = mysqli_fetch_array($result4);
$nick = $row4['nick'];
?>
<?php if (empty($row_an)) {?>
<div id="error">Такого сталкера не существует, или же он не создал анкету.</div>
<?php } else {?>
<div class="r6">
<center><div class="name">Анкета <?php echo "$nick";?>:</div></center>
<br/>
<?php if (!empty($foto)) {?>
<div class="r5" style="margin: -3px; color: #ffffff;">
<center><img src="img/foto/<?php echo "$foto";?>.png" class="upl"/></center>
</div><br/>
<?php } else {?>
<div class="r5" style="margin: -3px; color: #ffffff;">
<center><img src="img/foto/00.jpg" class="upl"/></center>
</div><br/>
<?php }?>
<?php if (!empty($history)) {?>
<div class="r5" style="margin: -3px; color: #ffffff;">
<p><center><b>О себе:</b></center><br/ >  <i><?php echo "$history";?></i></p>
</div><br />
<?php }?>
<div class="r5" style="margin: -3px; color: #ffffff;">
<?php if (!empty($name)) {?><p><b>Имя:</b>  <?php echo "$name";?></p><?php }?>
<?php if (!empty($family)) {?><p><b>Фамилия:</b>  <?php echo "$family";?></p><?php }?>

<?php if ($bd1 <> 0 or $bd2 <> 0  or $bd3 <> 0 ) {?>
<p><b>Дата рождения:</b> 
<?php if (!empty($bd1)) {?><?php echo "$bd1";?> <?php }?>

<?php if (!empty($bd2)) {?>

<?php
if ($bd2 == '1') {
if (empty($bd1)) {
echo "Январь";
} else {
echo "Января";
}
}

if ($bd2 == '2') {
if (empty($bd1)) {
echo "Февраль";
} else {
echo "Февраля";
}
}

if ($bd2 == '3') {
if (empty($bd1)) {
echo "Март";
} else {
echo "Марта";
}
}

if ($bd2 == '4') {
if (empty($bd1)) {
echo "Апрель";
} else {
echo "Апреля";
}
}

if ($bd2 == '5') {
if (empty($bd1)) {
echo "Май";
} else {
echo "Мая";
}
}

if ($bd2 == '6') {
if (empty($bd1)) {
echo "Июнь";
} else {
echo "Июня";
}
}

if ($bd2 == '7') {
if (empty($bd1)) {
echo "Июль";
} else {
echo "Июля";
}
}

if ($bd2 == '8') {
if (empty($bd1)) {
echo "Август";
} else {
echo "Августа";
}
}

if ($bd2 == '9') {
if (empty($bd1)) {
echo "Сентябрь";
} else {
echo "Сентября";
}
}

if ($bd2 == '10') {
if (empty($bd1)) {
echo "Октябрь";
} else {
echo "Октября";
}
}

if ($bd2 == '11') {
if (empty($bd1)) {
echo "Ноябрь";
} else {
echo "Ноября";
}
}

if ($bd2 == '12') {
if (empty($bd1)) {
echo "Декабрь";
} else {
echo "Декабря";
}
}
?>
<?php }?>
<?php if (!empty($bd3)) {?> <?php echo "$bd3";?> года<?php }?>
</p>
<?php }?>


<?php
if (!empty($bd3)) {
?>
<?php
$date="".$bd1.".".$bd2.".".$bd3."";
$happyday = $date;
$curday = date('d.m.Y');
$d1 = strtotime($happyday);
$d2 = strtotime($curday);
$diff = $d2-$d1;
$diff = $diff/(60*60*24*365);
$years = floor($diff);
?>
<p><b>Полных лет:</b> <span class="net"><?php echo "$years";?></span>
</p>
<?php }?>

<?php if (!empty($nation)) {?><p><b>Страна:</b>  <?php echo "$nation";?></p><?php }?>
<?php if (!empty($city)) {?><p><b>Город:</b>  <?php echo "$city";?></p><?php }?>
</div><br/>
<div class="r5" style="margin: -3px; color: #ffffff;">
<center><b>Контакты:</b></center><br/>
<?php if (!empty($vk)) {?><p><b>VK:</b>  <a href="http://m.vk.com/<?php echo "$vk";?>" target="_blank">http://m.vk.com/<?php echo "$vk";?></a></p><?php }?>
<?php if (!empty($spaces)) {?><p><b>Spaces:</b>  <a href="http://<?php echo "$spaces";?>.spaces.ru" target="_blank">http://<?php echo "$spaces";?>.spaces.ru</a></p><?php }?>

</div>
<?php }?>
<br/>
<div class="stats">
<p style="border-top: solid 1px #444e4f;"></p>
<a href="user.php?id=<?php echo "$user_id";?>" class="menu"><img src="img/ico/left.png" alt="."/> Выйти</a>
</div>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>