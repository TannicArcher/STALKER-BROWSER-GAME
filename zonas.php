<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$user_id = $_SESSION['id'];
$queryqw = "Select * from users where id='$user_id' limit 1";
$resultqw = mysqli_query($dbc, $queryqw) or die ('Ошибка передачи запроса к БД');
$rowqw = mysqli_fetch_array($resultqw);
$loc2 = $rowqw['loc'];
$h=getenv("HTTP_REFERER");
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
?>
<script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
</script>
<?php
};
if ($loc2 == 'skadovsk') {
$page_title = 'Скадовск';
}
if ($loc2 == 'shevchenko') {
$page_title = 'Шевченко';
}
if ($loc2 == 'hutor') {
$page_title = 'Сгоревший хутор';
}
if ($loc2 == 'zemsnaryad') {
$page_title = 'Земснаряд';
}
if ($loc2 == 'p_kran') {
$page_title = 'Портовые краны';
}
if ($loc2 == 'izumrudnoe') {
$page_title = 'Изумрудное';
}
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$trofi = $_GET['trofi'];
$vid5 = $_GET['v'];
$col5 = $_GET['c'];
$m_sta = $_GET['yr'];
$m_mon = $_GET['m'];
$dib1 = $_GET['dib'];
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$clan = $row['clan'];
$query091 = "Select * from clans where clan_id='$clan' limit 1";
$result091 = mysqli_query($dbc, $query091) or die ('Ошибка передачи запроса к БД');
$row091 = mysqli_fetch_array($result091);
$slava = $row091['slava'];
$b_op = ($slava / '500');
$b_op = round("$b_op");
$b_op1 = ($b_op + '100');
$prem = $row['premium'];
$art_time = $row['art_time'];
$art_time = strtotime("$art_time");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_art = ($art_time + '10800');
$time_art = ($time_art - $now);
$art_poisk = $row['art_poisk'];
$art_apt = $row['art_apt'];
$art_pr = $row['art_pr'];
$art_tip = $row['art_tip'];
$art_vid = $row['art_vid'];
$max_hp = $row['max_hp'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_apt = $row['time_apt'];
$time_apt = strtotime("$time_apt");
$time_apte = ($time_apt + '30');
$time_aptechka = ($time_apte - $now);
$mon_time = $row['mon_time'];
$mon_time = strtotime("$mon_time");
$mq_time = ($mon_time + '120');
$time_mon = ($mq_time - $now);
$loc = $row['loc'];
$lvl_i = $row['lvl'];
$mons = $row['m_at'];
$vid = $row['m_vid'];
$col = $row['m_col'];
$need = $row['m_need'];
$m_zd = $row['m_zd'];
$max_zd = $row['max_zd'];
$mon_d = $row['mon_d'];
$attack = '100';
if ($time_mon < '1') {
$attack = rand(1,100);
}
if ($time_mon < '1' and $dib1 == 'true') {
$dib = 'true';
}
$razn_col = ($need - $col);
$query_dec = "Select * from things where user_id = '$user_id' and type='7' and place='2' limit 1";
$result_dec = mysqli_query($dbc, $query_dec) or die ('Ошибка передачи запроса к БД');
$row_dec = mysqli_fetch_array($result_dec);
?>
<?php if ($time_mon > '0') {?>
<div style="border-style: solid; border-color: #net; border-width: 1px;">
<p class="dan">Отдых от боёв еще <?php echo "$time_mon";?> секунд</p>
</div>
<?php }?>
<?php
if ($loc == 'skadovsk') {?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Скадовск</p></center>
<center><img src="img/location/1.jpg" /></center>
<center><a href="z_list.php"><?php
require_once('z_panel.php');
?>
</a></center>
</div>
<div class="stats">
<center><a href="skadovsk.php" class="menu1"><img src="img/ico/up.png" /> Войти</a></center>
</div>
<p><a href="cross.php?l=2" class="menu"><img src="img/ico/topleft.png"/> Сгоревший хутор</a></p>
<p><a href="cross.php?l=3" class="menu"><img src="img/ico/right.png"/> Земснаряд</a></p>
<p><a href="cross.php?l=1" class="menu"><img src="img/ico/bottomleft.png"/> Шевченко</a></p>
<p><a href="cross.php?l=4" class="menu"><img src="img/ico/bottomright.png"/> Портовые краны</a></p>
<?php }
if ($loc == 'shevchenko') {?>
<div class="stats">
<?php if ($trofi == 'true') {?>
<div style="border-style: solid; border-color: green; border-width: 1px;">
<p class="net">Вы 
<?php
if ($vid5 == '1') {?>отрезали<?php }
if ($vid5 == '2') {?>отрезали<?php }
if ($vid5 == '3') {?>вырезали<?php }
if ($vid5 == '4') {?>вырезали<?php }
if ($vid5 == '5') {?>отрезали<?php }
?> <?php echo "$col5";?> <?php
if ($vid5 == '1') {?>хвостов пси-собак<?php }
if ($vid5 == '2') {?>хвостов пси-собак<?php }
if ($vid5 == '3') {?>глаз плотей<?php }
if ($vid5 == '4') {?>глаз плотей<?php }
if ($vid5 == '5') {?>ног снорков<?php }
?>
</p>
</div>
<?php }?>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Шевченко</p></center>
<?php
$vid1 = rand(1,5);
if ($vid1 == '1') {
$col1 = rand(3,5);
$hah = 'Пси-пёс';
$hp_i = ('1000' * $lvl_i);
}
if ($vid1 == '2') {
$col1 = rand(3,5);
$hah = 'Пси-пёс';
$hp_i = ('1000' * $lvl_i);
}
if ($vid1 == '3') {
$col1 = rand(4,6);
$hah = 'Плоть';
$hp_i = ('1250' * $lvl_i);
}
if ($vid1 == '4') {
$col1 = rand(4,6);
$hah = 'Плоть';
$hp_i = ('1250' * $lvl_i);
}
if ($vid1 == '5') {
$col1 = rand(1,3);
$hah = 'Снорк';
$hp_i = ('5000' * $lvl_i);
}
?>
<?php if ($mons == '0' and $attack < '50' or $mons == '0' and $dib == 'true') {?>
<?php
$query = "update users set m_at='1', m_zd='$hp_i', max_zd='$hp_i', m_vid='$vid1', m_col='0', m_need='$col1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$mons = '1';
?>
<script type="text/javascript">
  document.location.href = "zonas.php";
</script>
<?php }?>
<?php if ($mons == '0') {?>
<center><img src="img/location/2.jpg" /></center>
<center><a href="z_list.php"><?php
require_once('z_panel.php');
?>
</a></center>
</div>
<p style="border-top: solid 1px #444e4f"></p>
<a href="zonas.php?dib=true" class="menu"><img src="img/ico/ohotniki.gif"> Напасть на мутантов</a>
<p style="border-top: solid 1px #444e4f"></p>
<p><a href="cross.php?l=1" class="menu"><img src="img/ico/topright.png"/> Скадовск</a></p>
<p><a href="cross.php?l=2" class="menu"><img src="img/ico/left.png"/> Изумрудное</a></p>
<?php }?>
<?php if ($mons == '1' and $mon_d == '0') {?>
<?php if ($hp < '1') {?>
<script type="text/javascript">
  document.location.href = "z_death.php";
</script>
<?php
exit();
}
?>
<div class="stats">
<center><p class="podmenu"><?php if ($vid == '1' or $vid == '2') {?>Пси-пёс<?php }?><?php if ($vid == '3' or $vid == '4') {?>Плоть<?php }?><?php if ($vid == '5') {?>Снорк<?php }?></p></center>
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2') {?>1<?php }?><?php if ($vid == '3' or $vid == '4') {?>2<?php }?><?php if ($vid == '5') {?>3<?php }?>.png"></center></p>
</div>
<p class="red">На вас напали мутанты. Осталось еще <?php echo "$razn_col";?> <?php if ($vid == '1' or $vid == '2') {?>пси-псов<?php }?><?php if ($vid == '3' or $vid == '4') {?>плотей<?php }?><?php if ($vid == '5') {?>снорков<?php }?></p>
<?php if ($m_sta > '0') {?>
<small><p class="lal">Опыт: +<?php
if ($prem == '0') {
$lal = ($m_sta / '2000');
} else {
$lal = ($m_sta / '1000');
}
$lal = ($lal / '100');
$lal = ($lal * $b_op1);
$lal = round("$lal");
echo "$lal";
?>k <?php if ($b_op > '0') {?><span class="bonus">(+<?php echo "$b_op";?>%)</span><?php }?></p></small>
<?php }?>
<?php if ($m_sta > '0') {?>
<p class="net">Урон: <?php echo "$m_sta";?></p>
<?php }?>
<?php if ($m_mon > '0') {?>
<p class="red">Ранение: <?php echo "$m_mon";?></p>
<?php }?>
<p><img src="img/ico/life.png" width="12" height="12" /> Здоровье мутанта: <?php echo "$m_zd";?>/<?php echo "$max_zd";?></p>
<?php if ($hp < $max_hp) {?><?php if ($time_aptechka < '1') {?><p><a href="apt.php" class="menu"><img src="img/ico/apte4ka.png" /> Использовать аптечку</a></p><?php } else {?><p class="red">До следующего использования аптечки <?php echo "$time_aptechka";?> секунд</p><?php }?><?php }?>
<?php if ($time_p > '0' and $time_w > '0') {?><center><p><a href="zonas.php"><img src="img/icon-refresh.png" /></a></p></center><?php }?>
<p class="podmenu">Стрелять:</p>
<?php if ($time_p < '1') {?>
<a href="boi.php?tip=1" class="menu">Из пистолета</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php if ($time_w < '1') {?>
<a href="boi.php?tip=2" class="menu">Из автомата</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php }?>
<?php if ($mon_d == '1' and $razn_col > '0') {?>
<div class="stats">
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2') {?>1<?php }?><?php if ($vid == '3' or $vid == '4') {?>2<?php }?><?php if ($vid == '5') {?>3<?php }?>.png"></center></p>
<p class="net"><?php if ($vid == '1' or $vid == '2') {?>Пси-пёс<?php }?><?php if ($vid == '3' or $vid == '4') {?>Плоть<?php }?><?php if ($vid == '5') {?>Снорк<?php }?> убит</p>
</div>
<p class="red">Осталось еще <?php echo "$razn_col";?> <?php if ($vid == '1' or $vid == '2') {?>пси-псов<?php }?><?php if ($vid == '3' or $vid == '4') {?>плотей<?php }?><?php if ($vid == '5') {?>снорков<?php }?></p>
<?php
$query = "update users set mon_d='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php if ($hp < $max_hp) {?><?php if ($time_aptechka < '1') {?><p><a href="apt.php" class="menu"><img src="img/ico/apte4ka.png" /> Использовать аптечку</a></p><?php } else {?><p class="red">До следующего использования аптечки <?php echo "$time_aptechka";?> секунд</p><?php }?><?php }?>
<?php if ($time_p > '0' and $time_w > '0') {?><center><p><a href="zonas.php"><img src="img/icon-refresh.png" /></a></p></center><?php }?>
<p class="podmenu">Стрелять в следующего:</p>
<?php if ($time_p < '1') {?>
<a href="boi.php?tip=1" class="menu">Из пистолета</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php if ($time_w < '1') {?>
<a href="boi.php?tip=2" class="menu">Из автомата</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php }?>
<?php if ($mon_d == '1' and $razn_col < '1') {?>
<div class="stats">
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2') {?>1<?php }?><?php if ($vid == '3' or $vid == '4') {?>2<?php }?><?php if ($vid == '5') {?>3<?php }?>.png"></center></p>
<p class="net">Убит<?php if ($vid == '3' or $vid == '4') {?>а последняя плоть<?php } else {?> последний <?php }?><?php if ($vid == '1' or $vid == '2') {?>пси-пёс<?php }?><?php if ($vid == '5') {?>снорк<?php }?></p>
</div>
<?php
$query = "update users set mon_d='0', m_at='0', mon_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p><a href="z_trofi.php">Отрезать части тел</a></p>
<?php }?>
<?php }

if ($loc == 'hutor') {?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Сгоревший хутор</p></center>
<?php if ($art_poisk == '0') {?>
<center><img src="img/location/3.jpg" /></center>
<center><a href="z_list.php"><?php
require_once('z_panel.php');
?>
</a></center>
</div>
<?php
require_once('z_art.php');
?>
<?php if (!empty($row_dec)) {?>
<?php if ($time_art < '1') {?>
<div class="stats">
<center><p><a href="art_p.php" class="menu"><img src="img/ico/Пламя.png" width="16" height="16" /> Искать артефакты</a></p></center>
</div>
<?php } else {?>
<div class="stats">
<center><p class="red">В аномалии нет артефактов. Появятся через <span class="white"><?php
$time111 = $time_art;
$time44 = ($time111 - '3600');
if ($time111 < '60') {?><?php echo "$time111";?> секунд<?php }
if ($time111 > '59' and $time111 < '120') {?>1 минуту<?php }
if ($time111 > '119' and $time111 < '180') {?>2 минуты<?php }
if ($time111 > '179' and $time111 < '240') {?>3 минуты<?php }
if ($time111 > '239' and $time111 < '300') {?>4 минуты<?php }
if ($time111 > '299' and $time111 < '360') {?>5 минут<?php }
if ($time111 > '359' and $time111 < '420') {?>6 минут<?php }
if ($time111 > '419' and $time111 < '480') {?>7 минут<?php }
if ($time111 > '479' and $time111 < '540') {?>8 минут<?php }
if ($time111 > '539' and $time111 < '600') {?>9 минут<?php }
if ($time111 > '599' and $time111 < '660') {?>10 минут<?php }
if ($time111 > '659' and $time111 < '720') {?>11 минут<?php }
if ($time111 > '719' and $time111 < '780') {?>12 минут<?php }
if ($time111 > '779' and $time111 < '840') {?>13 минут<?php }
if ($time111 > '839' and $time111 < '900') {?>14 минут<?php }
if ($time111 > '899' and $time111 < '960') {?>15 минут<?php }
if ($time111 > '959' and $time111 < '1020') {?>16 минут<?php }
if ($time111 > '1019' and $time111 < '1080') {?>17 минут<?php }
if ($time111 > '1079' and $time111 < '1140') {?>18 минут<?php }
if ($time111 > '1139' and $time111 < '1200') {?>19 минут<?php }
if ($time111 > '1199' and $time111 < '1260') {?>20 минут<?php }
if ($time111 > '1259' and $time111 < '1320') {?>21 минуту<?php }
if ($time111 > '1319' and $time111 < '1380') {?>22 минуты<?php }
if ($time111 > '1379' and $time111 < '1440') {?>23 минуты<?php }
if ($time111 > '1439' and $time111 < '1500') {?>24 минуты<?php }
if ($time111 > '1499' and $time111 < '1560') {?>25 минут<?php }
if ($time111 > '1559' and $time111 < '1620') {?>26 минут<?php }
if ($time111 > '1619' and $time111 < '1680') {?>27 минут<?php }
if ($time111 > '1679' and $time111 < '1740') {?>28 минут<?php }
if ($time111 > '1739' and $time111 < '1800') {?>29 минут<?php }
if ($time111 > '1799' and $time111 < '1860') {?>30 минут<?php }
if ($time111 > '1859' and $time111 < '1920') {?>31 минуту<?php }
if ($time111 > '1919' and $time111 < '1980') {?>32 минуты<?php }
if ($time111 > '1979' and $time111 < '2040') {?>33 минуты<?php }
if ($time111 > '2039' and $time111 < '2100') {?>34 минуты<?php }
if ($time111 > '2099' and $time111 < '2160') {?>35 минут<?php }
if ($time111 > '2159' and $time111 < '2220') {?>36 минут<?php }
if ($time111 > '2219' and $time111 < '2280') {?>37 минут<?php }
if ($time111 > '2279' and $time111 < '2340') {?>38 минут<?php }
if ($time111 > '2339' and $time111 < '2400') {?>39 минут<?php }
if ($time111 > '2399' and $time111 < '2460') {?>40 минут<?php }
if ($time111 > '2459' and $time111 < '2520') {?>41 минуту<?php }
if ($time111 > '2519' and $time111 < '2580') {?>42 минуты<?php }
if ($time111 > '2579' and $time111 < '2640') {?>43 минуты<?php }
if ($time111 > '2639' and $time111 < '2700') {?>44 минуты<?php }
if ($time111 > '2699' and $time111 < '2760') {?>45 минут<?php }
if ($time111 > '2759' and $time111 < '2820') {?>46 минут<?php }
if ($time111 > '2819' and $time111 < '2880') {?>47 минут<?php }
if ($time111 > '2879' and $time111 < '2940') {?>48 минут<?php }
if ($time111 > '2939' and $time111 < '3000') {?>49 минут<?php }
if ($time111 > '2999' and $time111 < '3060') {?>50 минут<?php }
if ($time111 > '3059' and $time111 < '3120') {?>51 минуту<?php }
if ($time111 > '3119' and $time111 < '3180') {?>52 минуты<?php }
if ($time111 > '3179' and $time111 < '3240') {?>53 минуты<?php }
if ($time111 > '3239' and $time111 < '3300') {?>54 минуты<?php }
if ($time111 > '3299' and $time111 < '3360') {?>55 минут<?php }
if ($time111 > '3359' and $time111 < '3420') {?>56 минут<?php }
if ($time111 > '3419' and $time111 < '3480') {?>57 минут<?php }
if ($time111 > '3479' and $time111 < '3540') {?>58 минут<?php }
if ($time111 > '3539' and $time111 < '3600') {?>59 минут<?php }
if ($time111 > '3599' and $time111 < '3660') {?>60 минут<?php }
if ($time111 > '3659' and $time111 < '7200') {?>1 час <?php if ($time44 > '59' and $time44 < '120') {?>1 минуту<?php }
if ($time44 > '119' and $time44 < '180') {?>2 минуты<?php }
if ($time44 > '179' and $time44 < '240') {?>3 минуты<?php }
if ($time44 > '239' and $time44 < '300') {?>4 минуты<?php }
if ($time44 > '299' and $time44 < '360') {?>5 минут<?php }
if ($time44 > '359' and $time44 < '420') {?>6 минут<?php }
if ($time44 > '419' and $time44 < '480') {?>7 минут<?php }
if ($time44 > '479' and $time44 < '540') {?>8 минут<?php }
if ($time44 > '539' and $time44 < '600') {?>9 минут<?php }
if ($time44 > '599' and $time44 < '660') {?>10 минут<?php }
if ($time44 > '659' and $time44 < '720') {?>11 минут<?php }
if ($time44 > '719' and $time44 < '780') {?>12 минут<?php }
if ($time44 > '779' and $time44 < '840') {?>13 минут<?php }
if ($time44 > '839' and $time44 < '900') {?>14 минут<?php }
if ($time44 > '899' and $time44 < '960') {?>15 минут<?php }
if ($time44 > '959' and $time44 < '1020') {?>16 минут<?php }
if ($time44 > '1019' and $time44 < '1080') {?>17 минут<?php }
if ($time44 > '1079' and $time44 < '1140') {?>18 минут<?php }
if ($time44 > '1139' and $time44 < '1200') {?>19 минут<?php }
if ($time44 > '1199' and $time44 < '1260') {?>20 минут<?php }
if ($time44 > '1259' and $time44 < '1320') {?>21 минуту<?php }
if ($time44 > '1319' and $time44 < '1380') {?>22 минуты<?php }
if ($time44 > '1379' and $time44 < '1440') {?>23 минуты<?php }
if ($time44 > '1439' and $time44 < '1500') {?>24 минуты<?php }
if ($time44 > '1499' and $time44 < '1560') {?>25 минут<?php }
if ($time44 > '1559' and $time44 < '1620') {?>26 минут<?php }
if ($time44 > '1619' and $time44 < '1680') {?>27 минут<?php }
if ($time44 > '1679' and $time44 < '1740') {?>28 минут<?php }
if ($time44 > '1739' and $time44 < '1800') {?>29 минут<?php }
if ($time44 > '1799' and $time44 < '1860') {?>30 минут<?php }
if ($time44 > '1859' and $time44 < '1920') {?>31 минуту<?php }
if ($time44 > '1919' and $time44 < '1980') {?>32 минуты<?php }
if ($time44 > '1979' and $time44 < '2040') {?>33 минуты<?php }
if ($time44 > '2039' and $time44 < '2100') {?>34 минуты<?php }
if ($time44 > '2099' and $time44 < '2160') {?>35 минут<?php }
if ($time44 > '2159' and $time44 < '2220') {?>36 минут<?php }
if ($time44 > '2219' and $time44 < '2280') {?>37 минут<?php }
if ($time44 > '2279' and $time44 < '2340') {?>38 минут<?php }
if ($time44 > '2339' and $time44 < '2400') {?>39 минут<?php }
if ($time44 > '2399' and $time44 < '2460') {?>40 минут<?php }
if ($time44 > '2459' and $time44 < '2520') {?>41 минуту<?php }
if ($time44 > '2519' and $time44 < '2580') {?>42 минуты<?php }
if ($time44 > '2579' and $time44 < '2640') {?>43 минуты<?php }
if ($time44 > '2639' and $time44 < '2700') {?>44 минуты<?php }
if ($time44 > '2699' and $time44 < '2760') {?>45 минут<?php }
if ($time44 > '2759' and $time44 < '2820') {?>46 минут<?php }
if ($time44 > '2819' and $time44 < '2880') {?>47 минут<?php }
if ($time44 > '2879' and $time44 < '2940') {?>48 минут<?php }
if ($time44 > '2939' and $time44 < '3000') {?>49 минут<?php }
if ($time44 > '2999' and $time44 < '3060') {?>50 минут<?php }
if ($time44 > '3059' and $time44 < '3120') {?>51 минуту<?php }
if ($time44 > '3119' and $time44 < '3180') {?>52 минуты<?php }
if ($time44 > '3179' and $time44 < '3240') {?>53 минуты<?php }
if ($time44 > '3239' and $time44 < '3300') {?>54 минуты<?php }
if ($time44 > '3299' and $time44 < '3360') {?>55 минут<?php }
if ($time44 > '3359' and $time44 < '3420') {?>56 минут<?php }
if ($time44 > '3419' and $time44 < '3480') {?>57 минут<?php }
if ($time44 > '3479' and $time44 < '3540') {?>58 минут<?php }
if ($time44 > '3539' and $time44 < '3600') {?>59 минут<?php }
if ($time44 > '3599' and $time44 < '3660') {?>60 минут<?php } ?><?php }
$time44 = ($time111 - '7200');
if ($time111 > '7199' and $time111 < '10800') {?>2 часа <?php if ($time44 > '59' and $time44 < '120') {?>1 минуту<?php }
if ($time44 > '119' and $time44 < '180') {?>2 минуты<?php }
if ($time44 > '179' and $time44 < '240') {?>3 минуты<?php }
if ($time44 > '239' and $time44 < '300') {?>4 минуты<?php }
if ($time44 > '299' and $time44 < '360') {?>5 минут<?php }
if ($time44 > '359' and $time44 < '420') {?>6 минут<?php }
if ($time44 > '419' and $time44 < '480') {?>7 минут<?php }
if ($time44 > '479' and $time44 < '540') {?>8 минут<?php }
if ($time44 > '539' and $time44 < '600') {?>9 минут<?php }
if ($time44 > '599' and $time44 < '660') {?>10 минут<?php }
if ($time44 > '659' and $time44 < '720') {?>11 минут<?php }
if ($time44 > '719' and $time44 < '780') {?>12 минут<?php }
if ($time44 > '779' and $time44 < '840') {?>13 минут<?php }
if ($time44 > '839' and $time44 < '900') {?>14 минут<?php }
if ($time44 > '899' and $time44 < '960') {?>15 минут<?php }
if ($time44 > '959' and $time44 < '1020') {?>16 минут<?php }
if ($time44 > '1019' and $time44 < '1080') {?>17 минут<?php }
if ($time44 > '1079' and $time44 < '1140') {?>18 минут<?php }
if ($time44 > '1139' and $time44 < '1200') {?>19 минут<?php }
if ($time44 > '1199' and $time44 < '1260') {?>20 минут<?php }
if ($time44 > '1259' and $time44 < '1320') {?>21 минуту<?php }
if ($time44 > '1319' and $time44 < '1380') {?>22 минуты<?php }
if ($time44 > '1379' and $time44 < '1440') {?>23 минуты<?php }
if ($time44 > '1439' and $time44 < '1500') {?>24 минуты<?php }
if ($time44 > '1499' and $time44 < '1560') {?>25 минут<?php }
if ($time44 > '1559' and $time44 < '1620') {?>26 минут<?php }
if ($time44 > '1619' and $time44 < '1680') {?>27 минут<?php }
if ($time44 > '1679' and $time44 < '1740') {?>28 минут<?php }
if ($time44 > '1739' and $time44 < '1800') {?>29 минут<?php }
if ($time44 > '1799' and $time44 < '1860') {?>30 минут<?php }
if ($time44 > '1859' and $time44 < '1920') {?>31 минуту<?php }
if ($time44 > '1919' and $time44 < '1980') {?>32 минуты<?php }
if ($time44 > '1979' and $time44 < '2040') {?>33 минуты<?php }
if ($time44 > '2039' and $time44 < '2100') {?>34 минуты<?php }
if ($time44 > '2099' and $time44 < '2160') {?>35 минут<?php }
if ($time44 > '2159' and $time44 < '2220') {?>36 минут<?php }
if ($time44 > '2219' and $time44 < '2280') {?>37 минут<?php }
if ($time44 > '2279' and $time44 < '2340') {?>38 минут<?php }
if ($time44 > '2339' and $time44 < '2400') {?>39 минут<?php }
if ($time44 > '2399' and $time44 < '2460') {?>40 минут<?php }
if ($time44 > '2459' and $time44 < '2520') {?>41 минуту<?php }
if ($time44 > '2519' and $time44 < '2580') {?>42 минуты<?php }
if ($time44 > '2579' and $time44 < '2640') {?>43 минуты<?php }
if ($time44 > '2639' and $time44 < '2700') {?>44 минуты<?php }
if ($time44 > '2699' and $time44 < '2760') {?>45 минут<?php }
if ($time44 > '2759' and $time44 < '2820') {?>46 минут<?php }
if ($time44 > '2819' and $time44 < '2880') {?>47 минут<?php }
if ($time44 > '2879' and $time44 < '2940') {?>48 минут<?php }
if ($time44 > '2939' and $time44 < '3000') {?>49 минут<?php }
if ($time44 > '2999' and $time44 < '3060') {?>50 минут<?php }
if ($time44 > '3059' and $time44 < '3120') {?>51 минуту<?php }
if ($time44 > '3119' and $time44 < '3180') {?>52 минуты<?php }
if ($time44 > '3179' and $time44 < '3240') {?>53 минуты<?php }
if ($time44 > '3239' and $time44 < '3300') {?>54 минуты<?php }
if ($time44 > '3299' and $time44 < '3360') {?>55 минут<?php }
if ($time44 > '3359' and $time44 < '3420') {?>56 минут<?php }
if ($time44 > '3419' and $time44 < '3480') {?>57 минут<?php }
if ($time44 > '3479' and $time44 < '3540') {?>58 минут<?php }
if ($time44 > '3539' and $time44 < '3600') {?>59 минут<?php }
if ($time44 > '3599' and $time44 < '3660') {?>60 минут<?php } ?><?php }
if ($time111 > '10799' and $time111 < '14400') {?>3 часа<?php }
?></span></p></center>
</div>
<?php }?>
<?php }?>
<?php if (empty($row_dec)) {?>
<div class="stats">
<center><p><a href="boroda.php?type=3" class="menu1"><img src="img/dec/otklik.gif" width="16" height="16" /> Купите детектор</a></p></center>
</div>
<?php }?>
<p><a href="cross.php?l=1" class="menu"><img src="img/ico/bottomright.png"/> Скадовск</a></p>
<?php }?>
<?php if ($art_poisk == '1' and $art_tip == '0') {?>
<?php
require_once('z_art.php');
?>
<div class="stats">
<p class="podmenu">Статус: <span class="net">поиск</span></p>
</div>
<p><a href="art_p.php" class="menu"><img src="img/ico/search.png" /> Искать активность артефактов</a></p>
<?php }?>
<?php if ($art_poisk == '1' and $art_tip == '1' and $art_pr < '100') {?>
<?php
require_once('z_art.php');
?>
<div class="stats">
<center><img src="img/art/<?php if ($art_vid == '1') {?>4.gif<?php }?><?php if ($art_vid == '2') {?>1.gif<?php }?><?php if ($art_vid == '3') {?>7.png<?php }?>" /></center>
<p class="podmenu">Статус: <span class="bonus">найден</span></p>
<p class="podmenu">Прогресс: <span class="net"><?php echo "$art_pr";?>%</span></p>
</div>
<?php if ($art_apt == '0') {?>
<p><a href="apt.php" class="menu"><img src="img/ico/apte4ka.png" /> Использовать аптечку</a></p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }?>
<p><a href="art_p.php" class="menu"><img src="img/ico/harvest.png" /> Попытаться достать</a></p>
<?php }?>
<?php if ($art_poisk == '1' and $art_tip == '1' and $art_pr > '99') {?>
<div class="stats">
<center><p class="podmenu"><?php if ($art_vid == '1') {?>Огненный шар<?php }?><?php if ($art_vid == '2') {?>Кристалл<?php }?><?php if ($art_vid == '3') {?>Глаз<?php }?></p></center>
<center><img src="img/art/<?php if ($art_vid == '1') {?>4.gif<?php }?><?php if ($art_vid == '2') {?>1.gif<?php }?><?php if ($art_vid == '3') {?>7.png<?php }?>" /></center>
</div>
<p><a href="art_p.php" class="menu"><img src="img/ico/harvest.png" /> Взять артефакт</a></p>
<?php }?>
<?php }
if ($loc == 'zemsnaryad') {?>
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Земснаряд</p></center>
<?php if ($art_poisk == '0') {?>
<center><img src="img/location/4.jpg" /></center>
<center><a href="z_list.php"><?php
require_once('z_panel.php');
?>
</a></center>
</div>
<?php
require_once('z_art.php');
?>
<?php if (!empty($row_dec)) {?>
<?php if ($time_art < '1') {?>
<div class="stats">
<center><p><a href="art_p.php" class="menu"><img src="img/ico/Пламя.png" width="16" height="16" /> Искать артефакты</a></p></center>
</div>
<?php } else {?>
<div class="stats">
<center><p class="red">В аномалии нет артефактов. Появятся через <span class="white"><?php
$time111 = $time_art;
$time44 = ($time111 - '3600');
if ($time111 < '60') {?><?php echo "$time111";?> секунд<?php }
if ($time111 > '59' and $time111 < '120') {?>1 минуту<?php }
if ($time111 > '119' and $time111 < '180') {?>2 минуты<?php }
if ($time111 > '179' and $time111 < '240') {?>3 минуты<?php }
if ($time111 > '239' and $time111 < '300') {?>4 минуты<?php }
if ($time111 > '299' and $time111 < '360') {?>5 минут<?php }
if ($time111 > '359' and $time111 < '420') {?>6 минут<?php }
if ($time111 > '419' and $time111 < '480') {?>7 минут<?php }
if ($time111 > '479' and $time111 < '540') {?>8 минут<?php }
if ($time111 > '539' and $time111 < '600') {?>9 минут<?php }
if ($time111 > '599' and $time111 < '660') {?>10 минут<?php }
if ($time111 > '659' and $time111 < '720') {?>11 минут<?php }
if ($time111 > '719' and $time111 < '780') {?>12 минут<?php }
if ($time111 > '779' and $time111 < '840') {?>13 минут<?php }
if ($time111 > '839' and $time111 < '900') {?>14 минут<?php }
if ($time111 > '899' and $time111 < '960') {?>15 минут<?php }
if ($time111 > '959' and $time111 < '1020') {?>16 минут<?php }
if ($time111 > '1019' and $time111 < '1080') {?>17 минут<?php }
if ($time111 > '1079' and $time111 < '1140') {?>18 минут<?php }
if ($time111 > '1139' and $time111 < '1200') {?>19 минут<?php }
if ($time111 > '1199' and $time111 < '1260') {?>20 минут<?php }
if ($time111 > '1259' and $time111 < '1320') {?>21 минуту<?php }
if ($time111 > '1319' and $time111 < '1380') {?>22 минуты<?php }
if ($time111 > '1379' and $time111 < '1440') {?>23 минуты<?php }
if ($time111 > '1439' and $time111 < '1500') {?>24 минуты<?php }
if ($time111 > '1499' and $time111 < '1560') {?>25 минут<?php }
if ($time111 > '1559' and $time111 < '1620') {?>26 минут<?php }
if ($time111 > '1619' and $time111 < '1680') {?>27 минут<?php }
if ($time111 > '1679' and $time111 < '1740') {?>28 минут<?php }
if ($time111 > '1739' and $time111 < '1800') {?>29 минут<?php }
if ($time111 > '1799' and $time111 < '1860') {?>30 минут<?php }
if ($time111 > '1859' and $time111 < '1920') {?>31 минуту<?php }
if ($time111 > '1919' and $time111 < '1980') {?>32 минуты<?php }
if ($time111 > '1979' and $time111 < '2040') {?>33 минуты<?php }
if ($time111 > '2039' and $time111 < '2100') {?>34 минуты<?php }
if ($time111 > '2099' and $time111 < '2160') {?>35 минут<?php }
if ($time111 > '2159' and $time111 < '2220') {?>36 минут<?php }
if ($time111 > '2219' and $time111 < '2280') {?>37 минут<?php }
if ($time111 > '2279' and $time111 < '2340') {?>38 минут<?php }
if ($time111 > '2339' and $time111 < '2400') {?>39 минут<?php }
if ($time111 > '2399' and $time111 < '2460') {?>40 минут<?php }
if ($time111 > '2459' and $time111 < '2520') {?>41 минуту<?php }
if ($time111 > '2519' and $time111 < '2580') {?>42 минуты<?php }
if ($time111 > '2579' and $time111 < '2640') {?>43 минуты<?php }
if ($time111 > '2639' and $time111 < '2700') {?>44 минуты<?php }
if ($time111 > '2699' and $time111 < '2760') {?>45 минут<?php }
if ($time111 > '2759' and $time111 < '2820') {?>46 минут<?php }
if ($time111 > '2819' and $time111 < '2880') {?>47 минут<?php }
if ($time111 > '2879' and $time111 < '2940') {?>48 минут<?php }
if ($time111 > '2939' and $time111 < '3000') {?>49 минут<?php }
if ($time111 > '2999' and $time111 < '3060') {?>50 минут<?php }
if ($time111 > '3059' and $time111 < '3120') {?>51 минуту<?php }
if ($time111 > '3119' and $time111 < '3180') {?>52 минуты<?php }
if ($time111 > '3179' and $time111 < '3240') {?>53 минуты<?php }
if ($time111 > '3239' and $time111 < '3300') {?>54 минуты<?php }
if ($time111 > '3299' and $time111 < '3360') {?>55 минут<?php }
if ($time111 > '3359' and $time111 < '3420') {?>56 минут<?php }
if ($time111 > '3419' and $time111 < '3480') {?>57 минут<?php }
if ($time111 > '3479' and $time111 < '3540') {?>58 минут<?php }
if ($time111 > '3539' and $time111 < '3600') {?>59 минут<?php }
if ($time111 > '3599' and $time111 < '3660') {?>60 минут<?php }
if ($time111 > '3659' and $time111 < '7200') {?>1 час <?php if ($time44 > '59' and $time44 < '120') {?>1 минуту<?php }
if ($time44 > '119' and $time44 < '180') {?>2 минуты<?php }
if ($time44 > '179' and $time44 < '240') {?>3 минуты<?php }
if ($time44 > '239' and $time44 < '300') {?>4 минуты<?php }
if ($time44 > '299' and $time44 < '360') {?>5 минут<?php }
if ($time44 > '359' and $time44 < '420') {?>6 минут<?php }
if ($time44 > '419' and $time44 < '480') {?>7 минут<?php }
if ($time44 > '479' and $time44 < '540') {?>8 минут<?php }
if ($time44 > '539' and $time44 < '600') {?>9 минут<?php }
if ($time44 > '599' and $time44 < '660') {?>10 минут<?php }
if ($time44 > '659' and $time44 < '720') {?>11 минут<?php }
if ($time44 > '719' and $time44 < '780') {?>12 минут<?php }
if ($time44 > '779' and $time44 < '840') {?>13 минут<?php }
if ($time44 > '839' and $time44 < '900') {?>14 минут<?php }
if ($time44 > '899' and $time44 < '960') {?>15 минут<?php }
if ($time44 > '959' and $time44 < '1020') {?>16 минут<?php }
if ($time44 > '1019' and $time44 < '1080') {?>17 минут<?php }
if ($time44 > '1079' and $time44 < '1140') {?>18 минут<?php }
if ($time44 > '1139' and $time44 < '1200') {?>19 минут<?php }
if ($time44 > '1199' and $time44 < '1260') {?>20 минут<?php }
if ($time44 > '1259' and $time44 < '1320') {?>21 минуту<?php }
if ($time44 > '1319' and $time44 < '1380') {?>22 минуты<?php }
if ($time44 > '1379' and $time44 < '1440') {?>23 минуты<?php }
if ($time44 > '1439' and $time44 < '1500') {?>24 минуты<?php }
if ($time44 > '1499' and $time44 < '1560') {?>25 минут<?php }
if ($time44 > '1559' and $time44 < '1620') {?>26 минут<?php }
if ($time44 > '1619' and $time44 < '1680') {?>27 минут<?php }
if ($time44 > '1679' and $time44 < '1740') {?>28 минут<?php }
if ($time44 > '1739' and $time44 < '1800') {?>29 минут<?php }
if ($time44 > '1799' and $time44 < '1860') {?>30 минут<?php }
if ($time44 > '1859' and $time44 < '1920') {?>31 минуту<?php }
if ($time44 > '1919' and $time44 < '1980') {?>32 минуты<?php }
if ($time44 > '1979' and $time44 < '2040') {?>33 минуты<?php }
if ($time44 > '2039' and $time44 < '2100') {?>34 минуты<?php }
if ($time44 > '2099' and $time44 < '2160') {?>35 минут<?php }
if ($time44 > '2159' and $time44 < '2220') {?>36 минут<?php }
if ($time44 > '2219' and $time44 < '2280') {?>37 минут<?php }
if ($time44 > '2279' and $time44 < '2340') {?>38 минут<?php }
if ($time44 > '2339' and $time44 < '2400') {?>39 минут<?php }
if ($time44 > '2399' and $time44 < '2460') {?>40 минут<?php }
if ($time44 > '2459' and $time44 < '2520') {?>41 минуту<?php }
if ($time44 > '2519' and $time44 < '2580') {?>42 минуты<?php }
if ($time44 > '2579' and $time44 < '2640') {?>43 минуты<?php }
if ($time44 > '2639' and $time44 < '2700') {?>44 минуты<?php }
if ($time44 > '2699' and $time44 < '2760') {?>45 минут<?php }
if ($time44 > '2759' and $time44 < '2820') {?>46 минут<?php }
if ($time44 > '2819' and $time44 < '2880') {?>47 минут<?php }
if ($time44 > '2879' and $time44 < '2940') {?>48 минут<?php }
if ($time44 > '2939' and $time44 < '3000') {?>49 минут<?php }
if ($time44 > '2999' and $time44 < '3060') {?>50 минут<?php }
if ($time44 > '3059' and $time44 < '3120') {?>51 минуту<?php }
if ($time44 > '3119' and $time44 < '3180') {?>52 минуты<?php }
if ($time44 > '3179' and $time44 < '3240') {?>53 минуты<?php }
if ($time44 > '3239' and $time44 < '3300') {?>54 минуты<?php }
if ($time44 > '3299' and $time44 < '3360') {?>55 минут<?php }
if ($time44 > '3359' and $time44 < '3420') {?>56 минут<?php }
if ($time44 > '3419' and $time44 < '3480') {?>57 минут<?php }
if ($time44 > '3479' and $time44 < '3540') {?>58 минут<?php }
if ($time44 > '3539' and $time44 < '3600') {?>59 минут<?php }
if ($time44 > '3599' and $time44 < '3660') {?>60 минут<?php } ?><?php }
$time44 = ($time111 - '7200');
if ($time111 > '7199' and $time111 < '10800') {?>2 часа <?php if ($time44 > '59' and $time44 < '120') {?>1 минуту<?php }
if ($time44 > '119' and $time44 < '180') {?>2 минуты<?php }
if ($time44 > '179' and $time44 < '240') {?>3 минуты<?php }
if ($time44 > '239' and $time44 < '300') {?>4 минуты<?php }
if ($time44 > '299' and $time44 < '360') {?>5 минут<?php }
if ($time44 > '359' and $time44 < '420') {?>6 минут<?php }
if ($time44 > '419' and $time44 < '480') {?>7 минут<?php }
if ($time44 > '479' and $time44 < '540') {?>8 минут<?php }
if ($time44 > '539' and $time44 < '600') {?>9 минут<?php }
if ($time44 > '599' and $time44 < '660') {?>10 минут<?php }
if ($time44 > '659' and $time44 < '720') {?>11 минут<?php }
if ($time44 > '719' and $time44 < '780') {?>12 минут<?php }
if ($time44 > '779' and $time44 < '840') {?>13 минут<?php }
if ($time44 > '839' and $time44 < '900') {?>14 минут<?php }
if ($time44 > '899' and $time44 < '960') {?>15 минут<?php }
if ($time44 > '959' and $time44 < '1020') {?>16 минут<?php }
if ($time44 > '1019' and $time44 < '1080') {?>17 минут<?php }
if ($time44 > '1079' and $time44 < '1140') {?>18 минут<?php }
if ($time44 > '1139' and $time44 < '1200') {?>19 минут<?php }
if ($time44 > '1199' and $time44 < '1260') {?>20 минут<?php }
if ($time44 > '1259' and $time44 < '1320') {?>21 минуту<?php }
if ($time44 > '1319' and $time44 < '1380') {?>22 минуты<?php }
if ($time44 > '1379' and $time44 < '1440') {?>23 минуты<?php }
if ($time44 > '1439' and $time44 < '1500') {?>24 минуты<?php }
if ($time44 > '1499' and $time44 < '1560') {?>25 минут<?php }
if ($time44 > '1559' and $time44 < '1620') {?>26 минут<?php }
if ($time44 > '1619' and $time44 < '1680') {?>27 минут<?php }
if ($time44 > '1679' and $time44 < '1740') {?>28 минут<?php }
if ($time44 > '1739' and $time44 < '1800') {?>29 минут<?php }
if ($time44 > '1799' and $time44 < '1860') {?>30 минут<?php }
if ($time44 > '1859' and $time44 < '1920') {?>31 минуту<?php }
if ($time44 > '1919' and $time44 < '1980') {?>32 минуты<?php }
if ($time44 > '1979' and $time44 < '2040') {?>33 минуты<?php }
if ($time44 > '2039' and $time44 < '2100') {?>34 минуты<?php }
if ($time44 > '2099' and $time44 < '2160') {?>35 минут<?php }
if ($time44 > '2159' and $time44 < '2220') {?>36 минут<?php }
if ($time44 > '2219' and $time44 < '2280') {?>37 минут<?php }
if ($time44 > '2279' and $time44 < '2340') {?>38 минут<?php }
if ($time44 > '2339' and $time44 < '2400') {?>39 минут<?php }
if ($time44 > '2399' and $time44 < '2460') {?>40 минут<?php }
if ($time44 > '2459' and $time44 < '2520') {?>41 минуту<?php }
if ($time44 > '2519' and $time44 < '2580') {?>42 минуты<?php }
if ($time44 > '2579' and $time44 < '2640') {?>43 минуты<?php }
if ($time44 > '2639' and $time44 < '2700') {?>44 минуты<?php }
if ($time44 > '2699' and $time44 < '2760') {?>45 минут<?php }
if ($time44 > '2759' and $time44 < '2820') {?>46 минут<?php }
if ($time44 > '2819' and $time44 < '2880') {?>47 минут<?php }
if ($time44 > '2879' and $time44 < '2940') {?>48 минут<?php }
if ($time44 > '2939' and $time44 < '3000') {?>49 минут<?php }
if ($time44 > '2999' and $time44 < '3060') {?>50 минут<?php }
if ($time44 > '3059' and $time44 < '3120') {?>51 минуту<?php }
if ($time44 > '3119' and $time44 < '3180') {?>52 минуты<?php }
if ($time44 > '3179' and $time44 < '3240') {?>53 минуты<?php }
if ($time44 > '3239' and $time44 < '3300') {?>54 минуты<?php }
if ($time44 > '3299' and $time44 < '3360') {?>55 минут<?php }
if ($time44 > '3359' and $time44 < '3420') {?>56 минут<?php }
if ($time44 > '3419' and $time44 < '3480') {?>57 минут<?php }
if ($time44 > '3479' and $time44 < '3540') {?>58 минут<?php }
if ($time44 > '3539' and $time44 < '3600') {?>59 минут<?php }
if ($time44 > '3599' and $time44 < '3660') {?>60 минут<?php } ?><?php }
if ($time111 > '10799' and $time111 < '14400') {?>3 часа<?php }
?></span></p></center>
</div>
<?php }?>
<?php }?>
<?php if (empty($row_dec)) {?>
<div class="stats">
<center><p><a href="boroda.php?type=3" class="menu1"><img src="img/dec/otklik.gif" width="16" height="16" /> Купите детектор</a></p></center>
</div>
<?php }?>
<p><a href="cross.php?l=1" class="menu"><img src="img/ico/left.png"/> Скадовск</a></p>
<?php }?>
<?php if ($art_poisk == '1' and $art_tip == '0') {?>
<?php
require_once('z_art.php');
?>
<div class="stats">
<p class="podmenu">Статус: <span class="net">поиск</span></p>
</div>
<p><a href="art_p.php" class="menu"><img src="img/ico/search.png" /> Искать активность артефактов</a></p>
<?php }?>
<?php if ($art_poisk == '1' and $art_tip == '1' and $art_pr < '100') {?>
<?php
require_once('z_art.php');
?>
<div class="stats">
<center><img src="img/art/<?php if ($art_vid == '1') {?>1.gif<?php }?><?php if ($art_vid == '2') {?>6.gif<?php }?><?php if ($art_vid == '3') {?>8.png<?php }?>" /></center>
<p class="podmenu">Статус: <span class="bonus">найден</span></p>
<p class="podmenu">Прогресс: <span class="net"><?php echo "$art_pr";?>%</span></p>
</div>
<?php if ($art_apt == '0') {?>
<p><a href="apt.php" class="menu"><img src="img/ico/apte4ka.png" /> Использовать аптечку</a></p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }?>
<p><a href="art_p.php" class="menu"><img src="img/ico/harvest.png" /> Попытаться достать</a></p>
<?php }?>
<?php if ($art_poisk == '1' and $art_tip == '1' and $art_pr > '99') {?>
<div class="stats">
<center><p class="podmenu"><?php if ($art_vid == '1') {?>Кристалл<?php }?><?php if ($art_vid == '2') {?>Выверт<?php }?><?php if ($art_vid == '3') {?>Мамины бусы<?php }?></p></center>
<center><img src="img/art/<?php if ($art_vid == '1') {?>1.gif<?php }?><?php if ($art_vid == '2') {?>6.gif<?php }?><?php if ($art_vid == '3') {?>8.png<?php }?>" /></center>
</div>
<p><a href="art_p.php" class="menu"><img src="img/ico/harvest.png" /> Взять артефакт</a></p>
<?php }?>
<?php }
if ($loc == 'p_kran') {?>
<div class="stats">
<?php if ($trofi == 'true') {?>
<div style="border-style: solid; border-color: green; border-width: 1px;">
<p class="net">Вы отрезали <?php echo "$col5";?> <?php
if ($vid5 == '1') {?>хвостов пси-собак<?php }
if ($vid5 == '2') {?>хвостов пси-собак<?php }
if ($vid5 == '3') {?>копыт кабанов<?php }
if ($vid5 == '4') {?>копыт кабанов<?php }
if ($vid5 == '5') {?>щупалец кровососов<?php }
?>
</p>
</div>
<?php }?>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Портовые краны</p></center>
<?php
$vid1 = rand(1,5);
if ($vid1 == '1') {
$col1 = rand(4,7);
$hah = 'Пси-пёс';
$hp_i = ('1000' * $lvl_i);
}
if ($vid1 == '2') {
$col1 = rand(4,7);
$hah = 'Пси-пёс';
$hp_i = ('1000' * $lvl_i);
}
if ($vid1 == '3') {
$col1 = rand(5,7);
$hah = 'Кабан';
$hp_i = ('1500' * $lvl_i);
}
if ($vid1 == '4') {
$col1 = rand(5,7);
$hah = 'Кабан';
$hp_i = ('1500' * $lvl_i);
}
if ($vid1 == '5') {
$col1 = rand(1,3);
$hah = 'Кровосос';
$hp_i = ('5500' * $lvl_i);
}
?>
<?php if ($mons == '0' and $attack < '50' or $mons == '0' and $dib == 'true') {?>
<?php
$query = "update users set m_at='1', m_zd='$hp_i', max_zd='$hp_i', m_vid='$vid1', m_col='0', m_need='$col1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$mons = '1';
?>
<script type="text/javascript">
  document.location.href = "zonas.php";
</script>
<?php }?>
<?php if ($mons == '0') {?>
<center><img src="img/location/5.jpg" /></center>
<center><a href="z_list.php"><?php
require_once('z_panel.php');
?>
</a></center>
</div>
<p style="border-top: solid 1px #444e4f"></p>
<a href="zonas.php?dib=true" class="menu"><img src="img/ico/ohotniki.gif"> Напасть на мутантов</a>
<p style="border-top: solid 1px #444e4f"></p>
<p><a href="cross.php?l=1" class="menu"><img src="img/ico/topleft.png"/> Скадовск</a></p>
<?php }?>
<?php if ($mons == '1' and $mon_d == '0') {?>
<?php if ($hp < '1') {?>
<script type="text/javascript">
  document.location.href = "z_death.php";
</script>
<?php
exit();
}
?>
<div class="stats">
<center><p class="podmenu"><?php if ($vid == '1' or $vid == '2') {?>Пси-пёс<?php }?><?php if ($vid == '3' or $vid == '4') {?>Кабан<?php }?><?php if ($vid == '5') {?>Кровосос<?php }?></p></center>
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2') {?>1<?php }?><?php if ($vid == '3' or $vid == '4') {?>4<?php }?><?php if ($vid == '5') {?>5<?php }?>.png"></center></p>
</div>
<p class="red">На вас напали мутанты. Осталось еще <?php echo "$razn_col";?> <?php if ($vid == '1' or $vid == '2') {?>пси-псов<?php }?><?php if ($vid == '3' or $vid == '4') {?>кабанов<?php }?><?php if ($vid == '5') {?>кровососов<?php }?></p>
<?php if ($m_sta > '0') {?>
<small><p class="lal">Опыт: +<?php
if ($prem == '0') {
$lal = ($m_sta / '2000');
} else {
$lal = ($m_sta / '1000');
}
$lal = ($lal / '100');
$lal = ($lal * $b_op1);
$lal = round("$lal");
echo "$lal";
?>k <?php if ($b_op > '0') {?><span class="bonus">(+<?php echo "$b_op";?>%)</span><?php }?></p></small>
<?php }?>
<?php if ($m_sta > '0') {?>
<p class="net">Урон: <?php echo "$m_sta";?></p>
<?php }?>
<?php if ($m_mon > '0') {?>
<p class="red">Ранение: <?php echo "$m_mon";?></p>
<?php }?>
<p><img src="img/ico/life.png" width="12" height="12" /> Здоровье мутанта: <?php echo "$m_zd";?>/<?php echo "$max_zd";?></p>
<?php if ($hp < $max_hp) {?><?php if ($time_aptechka < '1') {?><p><a href="apt.php" class="menu"><img src="img/ico/apte4ka.png" /> Использовать аптечку</a></p><?php } else {?><p class="red">До следующего использования аптечки <?php echo "$time_aptechka";?> секунд</p><?php }?><?php }?>
<?php if ($time_p > '0' and $time_w > '0') {?><center><p><a href="zonas.php"><img src="img/icon-refresh.png" /></a></p></center><?php }?>
<p class="podmenu">Стрелять:</p>
<?php if ($time_p < '1') {?>
<a href="boi.php?tip=1" class="menu">Из пистолета</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php if ($time_w < '1') {?>
<a href="boi.php?tip=2" class="menu">Из автомата</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php }?>
<?php if ($mon_d == '1' and $razn_col > '0') {?>
<div class="stats">
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2') {?>1<?php }?><?php if ($vid == '3' or $vid == '4') {?>4<?php }?><?php if ($vid == '5') {?>5<?php }?>.png"></center></p>
<p class="net"><?php if ($vid == '1' or $vid == '2') {?>Пси-пёс<?php }?><?php if ($vid == '3' or $vid == '4') {?>Кабан<?php }?><?php if ($vid == '5') {?>Кровосос<?php }?> убит</p>
</div>
<p class="red">Осталось еще <?php echo "$razn_col";?> <?php if ($vid == '1' or $vid == '2') {?>пси-псов<?php }?><?php if ($vid == '3' or $vid == '4') {?>кабанов<?php }?><?php if ($vid == '5') {?>кровососов<?php }?></p>
<?php
$query = "update users set mon_d='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php if ($hp < $max_hp) {?><?php if ($time_aptechka < '1') {?><p><a href="apt.php" class="menu"><img src="img/ico/apte4ka.png" /> Использовать аптечку</a></p><?php } else {?><p class="red">До следующего использования аптечки <?php echo "$time_aptechka";?> секунд</p><?php }?><?php }?>
<?php if ($time_p > '0' and $time_w > '0') {?><center><p><a href="zonas.php"><img src="img/icon-refresh.png" /></a></p></center><?php }?>
<p class="podmenu">Стрелять в следующего:</p>
<?php if ($time_p < '1') {?>
<a href="boi.php?tip=1" class="menu">Из пистолета</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php if ($time_w < '1') {?>
<a href="boi.php?tip=2" class="menu">Из автомата</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php }?>
<?php if ($mon_d == '1' and $razn_col < '1') {?>
<div class="stats">
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2') {?>1<?php }?><?php if ($vid == '3' or $vid == '4') {?>4<?php }?><?php if ($vid == '5') {?>5<?php }?>.png"></center></p>
<p class="net">Убит<?php if ($vid == '3' or $vid == '4') {?> последний кабан<?php } else {?> последний <?php }?><?php if ($vid == '1' or $vid == '2') {?>пси-пёс<?php }?><?php if ($vid == '5') {?>кровосос<?php }?></p>
</div>
<?php
$query = "update users set mon_d='0', m_at='0', mon_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p><a href="z_trofi.php">Отрезать части тел</a></p>
<?php }?>
<?php }
if ($loc == 'izumrudnoe') {?>
<div class="stats">
<?php if ($trofi == 'true') {?>
<div style="border-style: solid; border-color: green; border-width: 1px;">
<p class="net">Вы 
отрезали <?php echo "$col5";?> <?php
if ($vid5 == '1') {?>копыт кабанов<?php }
if ($vid5 == '2') {?>копыт кабанов<?php }
if ($vid5 == '3') {?>копыт кабанов<?php }
if ($vid5 == '4') {?>хвостов слепых псов<?php }
if ($vid5 == '5') {?>хвостов слепых псов<?php }
?>
</p>
</div>
<?php }?>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Изумрудное</p></center>
<?php
$vid1 = rand(1,5);
if ($vid1 == '1') {
$col1 = rand(5,8);
$hah = 'Кабан';
$hp_i = ('1250' * $lvl_i);
}
if ($vid1 == '2') {
$col1 = rand(5,8);
$hah = 'Кабан';
$hp_i = ('1250' * $lvl_i);
}
if ($vid1 == '3') {
$col1 = rand(5,8);
$hah = 'Кабан';
$hp_i = ('1250' * $lvl_i);
}
if ($vid1 == '4') {
$col1 = rand(4,9);
$hah = 'Слепой пёс';
$hp_i = ('1200' * $lvl_i);
}
if ($vid1 == '5') {
$col1 = rand(4,9);
$hah = 'Слепой пёс';
$hp_i = ('1200' * $lvl_i);
}
?>
<?php if ($mons == '0' and $attack < '50' or $mons == '0' and $dib == 'true') {?>
<?php
$query = "update users set m_at='1', m_zd='$hp_i', max_zd='$hp_i', m_vid='$vid1', m_col='0', m_need='$col1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$mons = '1';
?>
<script type="text/javascript">
  document.location.href = "zonas.php";
</script>
<?php }?>
<?php if ($mons == '0') {?>
<center><img src="img/location/6.jpg" /></center>
<center><a href="z_list.php"><?php
require_once('z_panel.php');
?>
</a></center>
</div>
<p style="border-top: solid 1px #444e4f"></p>
<a href="zonas.php?dib=true" class="menu"><img src="img/ico/ohotniki.gif"> Напасть на мутантов</a>
<p style="border-top: solid 1px #444e4f"></p>
<p><a href="cross.php?l=1" class="menu"><img src="img/ico/right.png"/> Шевченко</a></p>
<?php }?>
<?php if ($mons == '1' and $mon_d == '0') {?>
<?php if ($hp < '1') {?>
<script type="text/javascript">
  document.location.href = "z_death.php";
</script>
<?php
exit();
}
?>
<div class="stats">
<center><p class="podmenu"><?php if ($vid == '1' or $vid == '2' or $vid == '3') {?>Кабан<?php }?><?php if ($vid == '4' or $vid == '5') {?>Слепой пёс<?php }?></p></center>
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2' or $vid == '3') {?>4<?php }?><?php if ($vid == '4' or $vid == '5') {?>6<?php }?>.png"></center></p>
</div>
<p class="red">На вас напали мутанты. Осталось еще <?php echo "$razn_col";?> <?php if ($vid == '1' or $vid == '2' or $vid == '3') {?>кабанов<?php }?><?php if ($vid == '4' or $vid == '5') {?>слепых псов<?php }?></p>
<?php if ($m_sta > '0') {?>
<small><p class="lal">Опыт: +<?php
if ($prem == '0') {
$lal = ($m_sta / '2000');
} else {
$lal = ($m_sta / '1000');
}
$lal = ($lal / '100');
$lal = ($lal * $b_op1);
$lal = round("$lal");
echo "$lal";
?>k <?php if ($b_op > '0') {?><span class="bonus">(+<?php echo "$b_op";?>%)</span><?php }?></p></small>
<?php }?>
<?php if ($m_sta > '0') {?>
<p class="net">Урон: <?php echo "$m_sta";?></p>
<?php }?>
<?php if ($m_mon > '0') {?>
<p class="red">Ранение: <?php echo "$m_mon";?></p>
<?php }?>
<p><img src="img/ico/life.png" width="12" height="12" /> Здоровье мутанта: <?php echo "$m_zd";?>/<?php echo "$max_zd";?></p>
<?php if ($hp < $max_hp) {?><?php if ($time_aptechka < '1') {?><p><a href="apt.php" class="menu"><img src="img/ico/apte4ka.png" /> Использовать аптечку</a></p><?php } else {?><p class="red">До следующего использования аптечки <?php echo "$time_aptechka";?> секунд</p><?php }?><?php }?>
<?php if ($time_p > '0' and $time_w > '0') {?><center><p><a href="zonas.php"><img src="img/icon-refresh.png" /></a></p></center><?php }?>
<p class="podmenu">Стрелять:</p>
<?php if ($time_p < '1') {?>
<a href="boi.php?tip=1" class="menu">Из пистолета</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php if ($time_w < '1') {?>
<a href="boi.php?tip=2" class="menu">Из автомата</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php }?>
<?php if ($mon_d == '1' and $razn_col > '0') {?>
<div class="stats">
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2' or $vid == '3') {?>4<?php }?><?php if ($vid == '4' or $vid == '5') {?>6<?php }?>.png"></center></p>
<p class="net"><?php if ($vid == '1' or $vid == '2' or $vid == '3') {?>Кабан<?php }?><?php if ($vid == '4' or $vid == '5') {?>Слепой пёс<?php }?> убит</p>
</div>
<p class="red">Осталось еще <?php echo "$razn_col";?> <?php if ($vid == '1' or $vid == '2' or $vid == '3') {?>кабанов<?php }?><?php if ($vid == '4' or $vid == '5') {?>слепых псов<?php }?></p>
<?php
$query = "update users set mon_d='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php if ($hp < $max_hp) {?><?php if ($time_aptechka < '1') {?><p><a href="apt.php" class="menu"><img src="img/ico/apte4ka.png" /> Использовать аптечку</a></p><?php } else {?><p class="red">До следующего использования аптечки <?php echo "$time_aptechka";?> секунд</p><?php }?><?php }?>
<?php if ($time_p > '0' and $time_w > '0') {?><center><p><a href="zonas.php"><img src="img/icon-refresh.png" /></a></p></center><?php }?>
<p class="podmenu">Стрелять в следующего:</p>
<?php if ($time_p < '1') {?>
<a href="boi.php?tip=1" class="menu">Из пистолета</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php if ($time_w < '1') {?>
<a href="boi.php?tip=2" class="menu">Из автомата</a>
<?php } else {?>
<p class="red">Перезарядка</p>
<?php }?>
<?php }?>
<?php if ($mon_d == '1' and $razn_col < '1') {?>
<div class="stats">
<p><center><img src="img/monster/<?php if ($vid == '1' or $vid == '2' or $vid == '3') {?>4<?php }?><?php if ($vid == '4' or $vid == '5') {?>6<?php }?>.png"></center></p>
<p class="net">Убит последний <?php if ($vid == '1' or $vid == '2' or $vid == '3') {?>кабан<?php }?><?php if ($vid == '4' or $vid == '5') {?>слепой пёс<?php }?></p>
</div>
<?php
$query = "update users set mon_d='0', m_at='0', mon_time=NOW() where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p><a href="z_trofi.php">Отрезать части тел</a></p>
<?php }?>
<?php }
?>
<p style="border-top: solid 1px #444e4f;"></p>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>