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
$page_title = 'Аватар отряда';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$t = $_GET['t'];
$vid = $_GET['v'];
$s = $_GET['s'];
$query4 = "Select * from users where id='$user_id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row4 = mysqli_fetch_array($result4);
$clan_rang = $row4['clan_rang'];
$clan = $row4['clan'];
$query4 = "Select * from clans where clan_id='$clan' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row6 = mysqli_fetch_array($result4);
$c_money = $row6['clan_money'];
$gerb = $row6['gerb'];
?>
<?php if ($clan_rang < '8') {?>
<?php
echo "Это закрытый раздел";
?>
<div class="stats">
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
exit();
?>
<?php }
?>
<?php if ($vid == '1') {?><div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Стоимость:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
Индивидуальный герб стоит 10000 <img src="img/ico/money.png"/>RUB. <br/>
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
<form action="upload1.php" method="post"
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
$t = round("$t");
if ($t != 1 and $t != 2 and $t != 3 and $t != 4 and $t != 5 and $t != 6 and $t != 7) {
$t = '0';
}
?>
<?php if ($t != '0' and $c_money > '4999' and $clan_rang > '7') {
$query = "update clans set gerb='$t', clan_money=clan_money-'5000' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$buy = '1';
}
?>
<?php if ($s == '1') {
$query = "update clans set gerb='0' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$buy = '2';
}
?>
<div id="main"><center>
<?php if ($buy == '1') {?>
<div class="stats">
<small><p class="lal2">Герб успешно куплен!</p></small>
</div>
<?php }?>
<?php if ($buy == '2') {?>
<div class="stats">
<small><p class="lal2">Герб успешно сброшен!</p></small>
</div>
<?php }?>
<?php if ($c_money < '5000') {?>
<div class="stats">
<small><p class="lal">В складе недостаточно средств для покупки</p></small>
</div>
<?php }?>
<div class="stats">
<small><p class="lal">*Цена герба - 5000 <img src="img/ico/money.png"/>RUB</p></small>
</div>
<a href="cava.php?v=1" class="menu1">Загрузить свой герб</a>
<p style="border-top: 2px dotted #444e4f;"></p>
<?php if ($gerb <> '0') {?>
<a href="cava.php?s=1" class="menu" style="color: red;">Сбросить герб</a>
<p style="border-top: 1px solid #444e4f;"></p>
<?php }?><br/>
<p><img src="img/gerb/1.jpg"/></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><b><a href="cava.php?t=1" class="menu" onclick="return confirm ('Уверены?')">Купить</a></b></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><img src="img/gerb/2.jpg"/></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><b><a href="cava.php?t=2" class="menu" onclick="return confirm ('Уверены?')">Купить</a></b></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><img src="img/gerb/3.jpg"/></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><b><a href="cava.php?t=3" class="menu" onclick="return confirm ('Уверены?')">Купить</a></b></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><img src="img/gerb/4.jpg"/></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><b><a href="cava.php?t=4" class="menu" onclick="return confirm ('Уверены?')">Купить</a></b></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><img src="img/gerb/5.jpg"/></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><b><a href="cava.php?t=5" class="menu" onclick="return confirm ('Уверены?')">Купить</a></b></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><img src="img/gerb/6.jpg"/></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><b><a href="cava.php?t=6" class="menu" onclick="return confirm ('Уверены?')">Купить</a></b></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><img src="img/gerb/7.jpg"/></p>
<p style="border-top: 1px solid #444e4f;"></p>
<p><b><a href="cava.php?t=7" class="menu" onclick="return confirm ('Уверены?')">Купить</a></b></p>
<p style="border-top: 1px solid #444e4f;"></p>
</center></div>
<?php }?>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</div>
</body>
</html>