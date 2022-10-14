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
$page_title = 'Бонусы отряда';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$vid = $_GET['vid'];
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$clan = $row['clan'];
$clan_rang = $row['clan_rang'];
$query = "Select * from clans where clan_id='$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row_cl = mysqli_fetch_array($result);
$minus_time = $row_cl['minus_time'];
$minus_time1 = ($minus_time + '1');
$gauss = $row_cl['gauss'];
$slava = $row_cl['slava'];
$mentor = $row_cl['mentor'];
$b_slava = $row_cl['b_slava'];
if ($b_slava < '101') {
$gc12 = '100000';
}
if ($b_slava < '201' and $b_slava > '100') {
$gc12 = '200000';
}
if ($b_slava < '301' and $b_slava > '200') {
$gc12 = '300000';
}
if ($b_slava < '401' and $b_slava > '300') {
$gc12 = '400000';
}
if ($b_slava < '501' and $b_slava > '400') {
$gc12 = '500000';
}
if ($b_slava < '601' and $b_slava > '500') {
$gc12 = '600000';
}
if ($b_slava < '701' and $b_slava > '600') {
$gc12 = '700000';
}
if ($b_slava < '801' and $b_slava > '700') {
$gc12 = '800000';
}
if ($b_slava < '901' and $b_slava > '800') {
$gc12 = '900000';
}
if ($b_slava < '1001' and $b_slava > '900') {
$gc12 = '1000000';
}
if ($b_slava < '1101' and $b_slava > '1000') {
$gc12 = '2000000';
}
if ($b_slava < '1201' and $b_slava > '1100') {
$gc12 = '5000000';
}
if ($b_slava < '1301' and $b_slava > '1200') {
$gc12 = '10000000';
}
if ($b_slava < '1401' and $b_slava > '1300') {
$gc12 = '15000000';
}
if ($b_slava < '1501' and $b_slava > '1400') {
$gc12 = '20000000';
}
if ($b_slava < '1601' and $b_slava > '1500') {
$gc12 = '25000000';
}
if ($b_slava < '1701' and $b_slava > '1600') {
$gc12 = '30000000';
}
if ($b_slava < '1801' and $b_slava > '1700') {
$gc12 = '35000000';
}
if ($b_slava < '1901' and $b_slava > '1800') {
$gc12 = '40000000';
}
$dc12 = ($gc12 - '1');
$ata1 = $row_cl['oruzhie'];
$bro1 = $row_cl['bronya'];
$ata2 = ($ata1 + '1');
$bro2 = ($bro1 + '1');
$clan_habar = $row_cl['clan_habar'];
$clan_money = $row_cl['clan_money'];
$habar_at = ('300000' * ($ata1 + '1'));
$habar_br = ('300000' * ($bro1 + '1'));
$habar_at1 = ($habar_at - '1');
$habar_br1 = ($habar_br - '1');
if ($gauss == '0') {
$gc = '3000';
}
if ($gauss == '1') {
$gc = '10000';
}
if ($gauss == '2') {
$gc = '25000';
}
if ($gauss == '3') {
$gc = '40000';
}
if ($gauss == '4') {
$gc = '60000';
}
if ($gauss == '5') {
$gc = '100000';
}
if ($gauss == '6') {
$gc = '150000';
}
if ($gauss == '7') {
$gc = '250000';
}
if ($gauss == '8') {
$gc = '300000';
}
if ($gauss == '9') {
$gc = '300000';
}
if ($gauss == '10') {
$gc = '300000';
}
if ($gauss == '11') {
$gc = '300000';
}
if ($gauss == '12') {
$gc = '500000';
}
if ($gauss == '13') {
$gc = '1000000';
}
if ($gauss == '14') {
$gc = '1500000';
}
$dc = ($gc - '1');
$mtc = ($minus_time1 * 5000);
$mtm = ($mtc - '1');
?>
<div id="main">
<?php if ($vid == '1' and $clan_habar > $habar_at1 and $ata1 < '300' and $clan_rang > '7') {?>
<?php
$query = "update clans set clan_habar=clan_habar-'$habar_at', oruzhie=oruzhie+'1' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "c_bonus.php";
</script>
<?php }?>
<?php if ($vid == '1' and $clan_habar < $habar_at) {?>
<?php
$razn = ($habar_at - $clan_habar);
?>
<div style="border-style: dashed; border-width: 1px; border-color: #444e4f;">
<p class="red">В складе недостаточно хабара. Нужно еще <img src="img/ico/materials.png"/><?php echo "$razn";?></p>
</div>
<?php }?>
<?php if ($vid == '2' and $clan_habar > $habar_br1 and $bro1 < '90' and $clan_rang > '7') {?>
<?php
$query = "update clans set clan_habar=clan_habar-'$habar_br', bronya=bronya+'1' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "c_bonus.php";
</script>
<?php }?>
<?php if ($vid == '2' and $clan_habar < $habar_br) {?>
<?php
$razn = ($habar_br - $clan_habar);
?>
<div style="border-style: dashed; border-width: 1px; border-color: #444e4f;">
<p class="red">В складе недостаточно хабара. Нужно еще <img src="img/ico/materials.png"/><?php echo "$razn";?></p>
</div>
<?php }?>
<?php if ($vid == '3' and $clan_money > $dc and $gauss < '15' and $clan_rang > '7') {?>
<?php
$query = "update clans set clan_money=clan_money-'$gc', gauss=gauss+'1' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "c_bonus.php";
</script>
<?php }?>
<?php if ($vid == '3' and $clan_money < $gc) {?>
<?php
$razn1 = ($gc - $clan_money);
?>
<div style="border-style: dashed; border-width: 1px; border-color: #444e4f;">
<p class="red">В складе недостаточно денег. Нужно еще <img src="img/ico/money.png"/><?php echo "$razn1";?></p>
</div>
<?php }?>
<?php if ($vid == '4' and $clan_money > $mtm and $minus_time < '51' and $clan_rang > '7') {?>
<?php
$query = "update clans set clan_money=clan_money-'$mtc', minus_time=minus_time+'1' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "c_bonus.php";
</script>
<?php }?>
<?php if ($vid == '4' and $clan_money < $mtc) {?>
<?php
$razn2 = ($mtc - $clan_money);
?>
<div style="border-style: dashed; border-width: 1px; border-color: #444e4f;">
<p class="red">В складе недостаточно денег. Нужно еще <img src="img/ico/money.png"/><?php echo "$razn2";?></p>
</div>
<?php }?>
<?php if ($vid == '5' and $clan_habar > $dc12 and $b_slava < '1900' and $clan_rang > '7') {?>
<?php
$query = "update clans set clan_habar=clan_habar-'$gc12', b_slava=b_slava+'1' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "c_bonus.php";
</script>
<?php }?>
<?php if ($vid == '5' and $clan_habar < $gc12) {?>
<?php
$razn3 = ($gc12 - $clan_habar);
?>
<div style="border-style: dashed; border-width: 1px; border-color: #444e4f;">
<p class="red">В складе недостаточно хабара. Нужно еще <img src="img/ico/materials.png"/><?php echo "$razn3";?></p>
</div>
<?php }?>
<div class="stats">
  <center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Бонусы отряда</p></center>
</div>
<p>Склад: <img src="img/ico/materials.png"/><?php echo "$clan_habar";?> хабара, <img src="img/ico/money.png"/><?php echo "$clan_money";?> RUB.</p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Сталкеры:</p><br/>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<b>Характеристики:</b>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<p class="bonus">+<?php echo "$mentor";?>% <span class="dan">/</span> <span style="color: #404040;">+<?php $b_slava1 = ('100' + $b_slava); echo "$b_slava1";?>%</span> (<span class="gold"><?php echo "$slava";?> славы</span>)</p>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<b>Опыт:</b>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<p class="bonus">+<?php $mentor1 = ($slava / '500'); $mentor1 = round("$mentor1"); echo "$mentor1";?>% (<span class="gold"><?php echo "$slava";?> славы</span>)</p>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Битвы отряда:</p><br/>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<b>Разрывные патроны:</b>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
<p class="bonus">+<?php echo "$ata1";?>% урона</p>
<?php if ($ata1 < '300' and $clan_rang > '7') {?>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<p><a href="c_bonus.php?vid=1" onclick="return confirm ('Уверены?')">Улучшить</a> <span class="blue">[+<?php echo "$ata2";?>%]</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$habar_at";?>)</span></p>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<?php } else {?><?php }?>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<b>Дополнительная броня:</b>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
<p class="bonus">-<?php echo "$bro1";?>% вражеского урона</p>
<?php if ($bro1 < '90' and $clan_rang > '7') {?>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<p><a href="c_bonus.php?vid=2" onclick="return confirm ('Уверены?')">Улучшить</a> <span class="blue">[-<?php echo "$bro2";?>%]</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$habar_br";?>)</span></p>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<?php } else {?><?php }?>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<b>Ускоренный заряд аккумуляторов:</b>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
<p class="bonus"><?php echo "$minus_time";?> уровень - минус <?php echo "$minus_time"; ?> минут</p>
<?php if ($minus_time < '51' and $clan_rang > '7') {?>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<p><a href="c_bonus.php?vid=4" onclick="return confirm ('Уверены?')">Улучшить</a> <span class="blue">[минус <?php
echo "$minus_time1";
?> минут]</span> <span class="white">(<img src="img/ico/money.png"/><?php echo "$mtc";?>)</span></p>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<?php } else {?><?php }?>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<b>Лимит бонуса к параметрам:</b>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
<p class="bonus"><?php echo "$b_slava1";?>%</p>
<?php if ($b_slava < '1900' and $clan_rang > '7') {?>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<p><a href="c_bonus.php?vid=5" onclick="return confirm ('Уверены?')">Улучшить</a> <span class="blue">[<?php $b_slava2 = ('101' + $b_slava);
echo "$b_slava2";
?>%]</span> <span class="white">(<img src="img/ico/materials.png"/><?php echo "$gc12";?>)</span></p>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<?php } else {?><?php }?>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<b>Гаусс пушки:</b>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
<p class="bonus"><?php echo "$gauss";?> уровень - <?php
if ($gauss == '0') {?>500 урона.<?php }
if ($gauss == '1') {?>3500 урона.<?php }
if ($gauss == '2') {?>6000 урона.<?php }
if ($gauss == '3') {?>9500 урона.<?php }
if ($gauss == '4') {?>13500 урона.<?php }
if ($gauss == '5') {?>17500 урона.<?php }
if ($gauss == '6') {?>22500 урона.<?php }
if ($gauss == '7') {?>29500 урона.<?php }
if ($gauss == '8') {?>35000 урона.<?php }
if ($gauss == '9') {?>40000 урона.<?php }
if ($gauss == '10') {?>45000 урона.<?php }
if ($gauss == '11') {?>50000 урона.<?php }
if ($gauss == '12') {?>55000 урона.<?php }
if ($gauss == '13') {?>75000 урона.<?php }
if ($gauss == '14') {?>105000 урона.<?php }
if ($gauss == '15') {?>150000 урона.<?php }
?></p>
<?php if ($gauss < '15' and $clan_rang > '7') {?>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<p><a href="c_bonus.php?vid=3" onclick="return confirm ('Уверены?')">Улучшить</a> <span class="blue">[<?php
if ($gauss == '0') {?>3500 урона<?php }
if ($gauss == '1') {?>6000 урона<?php }
if ($gauss == '2') {?>9500 урона<?php }
if ($gauss == '3') {?>13500 урона<?php }
if ($gauss == '4') {?>17500 урона<?php }
if ($gauss == '5') {?>22500 урона<?php }
if ($gauss == '6') {?>29500 урона<?php }
if ($gauss == '7') {?>35000 урона<?php }
if ($gauss == '8') {?>40000 урона<?php }
if ($gauss == '9') {?>45000 урона<?php }
if ($gauss == '10') {?>50000 урона<?php }
if ($gauss == '11') {?>55000 урона<?php }
if ($gauss == '12') {?>75000 урона<?php }
if ($gauss == '13') {?>105000 урона<?php }
if ($gauss == '14') {?>150000 урона<?php }
?>]</span> <span class="white">(<img src="img/ico/money.png"/><?php echo "$gc";?>)</span></p>
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<?php } else {?><?php }?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<a href="clan.php" class="menu"><img src="img/reload.gif" width="15" height="15"/> Назад</a>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>