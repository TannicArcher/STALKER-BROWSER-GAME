<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "login.php";
  </script>
  <?php
  exit();
}
$page_title = 'Сталкер онлайн';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
require_once('conf/banned.php');
$user_id = $_SESSION['id'];
?>

<?php
/////////////////////////////////
////////////////////////////////////Записали локацию
$query = "Select * from users where id = '$user_id'  limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6');
$row = mysqli_fetch_array($result);
?>

<?php
$prem_time = $row['premium_time'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time = $row['premium_time'];
$loto_time = strtotime("$loto_time");
$loto_time = ($loto_time + 604800);
$time141 = ($loto_time - $now);

$location = $row['location'];
$m_fight=$row['m_fight'];
  if ($location == 'monster1' or $location == 'monster2' or $location == 'monster3' or $location == 'monster4' or $location == 'monster5' or $location == 'monster6' or $location == 'monster7' or $location == 'monster8' or $location == 'monster9' or $location == 'monster10' or $location == 'mail') {
$query_t = "Select id from users where m_fight='$m_fight' and location = '$location' and hp>0 and last_active > NOW() - (500)";
$result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД2');
$count = mysqli_num_rows($result_t);
if ($count <= 1) {
$query_t = "Select id from users where m_fight='$m_fight'";
$result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД2');
while ($row_t=mysqli_fetch_array($result_t)) {
$id_t=$row_t['id'];
$query = "update users set m_fight=0 where id = '$id_t' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД5');
}
$query_tt = "Select id_monster from m_fight where id_fight='$m_fight' limit 1";
$result_tt = mysqli_query($dbc, $query_tt) or die ('Ошибка передачи запроса к БД2');
$row_tt = mysqli_fetch_array($result_tt);
$m=$row_tt['id_monster'];

$query_tt = "Select clan, max_hp from monsters where id_monster='$m' limit 1";
$result_tt = mysqli_query($dbc, $query_tt) or die ('Ошибка передачи запроса к БД2');
$row_tt = mysqli_fetch_array($result_tt);
if ($row_tt['clan'] <> 0) {
$hp_monst=$row_tt['max_hp'];
$query_tt = "update m_fight set start=0, hp='$hp_monst' where id_fight='$m_fight' limit 1";
$result_tt = mysqli_query($dbc, $query_tt) or die ('Ошибка передачи запроса к БД2');
}

}
$query_tt = "Select start from m_fight where id_fight='$m_fight' limit 1";
$result_tt = mysqli_query($dbc, $query_tt) or die ('Ошибка передачи запроса к БД2');
$row_tt = mysqli_fetch_array($result_tt);
if ($row_tt['start'] == 0) {
$query_tt = "update users set m_fight=0 where id='$user_id' limit 1";
$result_tt = mysqli_query($dbc, $query_tt) or die ('Ошибка передачи запроса к БД2');
$query_tt = "DELETE FROM m_inf WHERE `user_id` ='$user_id' and id_fight='$m_fight' limit 1";
$result_tt = mysqli_query($dbc, $query_tt) or die ('Ошибка передачи запроса к БД2');
}
}
$hp = $row['hp'];
$max_hp = $row['max_hp'];
if ($hp <= 0) {
$sost_p = $row['sost_p'];
if ($sost_p>0) {
$sost_p = ($sost_p - 1);
}
$sost_w = $row['sost_w'];
if ($sost_w>0) {
$sost_w = ($sost_w - 1);
}
$sost_cl = $row['sost_cl'];
if ($sost_cl>0) {
$sost_cl = ($sost_cl - 1);
}
$query = "update users set hp='$max_hp', location = 'index', sost_cl = '$sost_cl', sost_p = '$sost_p', sost_w = '$sost_w' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
$query = "update things set sost = '$sost_cl' where user_id = '$user_id' and type = 1 and place=2 limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update things set sost = '$sost_p' where user_id = '$user_id' and type = 2 and place=2  limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update things set sost = '$sost_w' where user_id = '$user_id' and type = 3 and place=2  limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
else {
$query_loc = "update users set location = 'index' where id = '$user_id' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
$query_loc = "DELETE FROM `m_inf` WHERE user_id = '$user_id' and id_fight='$m_fight' limit 1";
$result_loc = mysqli_query($dbc, $query_loc) or die ('Ошибка передачи запроса к БД');
}
require_once('conf/top.php');
}
else {
$ip = getenv("REMOTE_ADDR");
$query_del = "DELETE FROM `login` WHERE `ip` = '$ip' LIMIT 1";
$result_del = mysqli_query($dbc, $query_del) or die ('Ошибка передачи запроса к БД');
$invite_id = $_GET['inv'];
$adress = getenv("HTTP_REFERER");
$time_beg=microtime();
$ip = mysqli_real_escape_string($dbc, trim($ip));
$invite_id =  mysqli_real_escape_string($dbc, trim($invite_id));
$adress =  mysqli_real_escape_string($dbc, trim($adress));
$query = "select id_invite from invite where ip='$ip'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
if (mysqli_fetch_array($result)) {
$query = "update invite set id_invite = '$invite_id', iz = '$adress' where ip='$ip'  limit 1";
@$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
else {
$query = "insert into invite (`ip`, `id_invite`, `iz`) values ( '$ip', '$invite_id', '$adress')";
@$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
}
?>


	<?php
	  $query_us = "Select * from users where gruppa <> 'lol' order by lvl DESC";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $name = $row_us['name'];
$nickkk = $row_us['nick'];
$iddl = $row_us['id'];
?>
<?php
$long_text = strlen($nickkk);
if ($long_text < '1') {
$query = "update users set nick='^_^' where id = '$iddl' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>
<?php 
}
?>

  <?php
$query_uch = "Select * from users where id = '$user_id' ";
$result_uch = mysqli_query($dbc, $query_uch) or die ('Ошибка передачи запроса к БД');
$row_uch = mysqli_fetch_array($result_uch);
$lvl_u = $row_uch['lvl'];
$m_kill_u = $row_uch['m_kill'];
$clannn = $row_uch['clan'];
$adminnn = $row_uch['admin'];
$moderrr = $row_uch['moder'];
$query_rek = "Select regen from users where id = '76' ";
$result_rek = mysqli_query($dbc, $query_rek) or die ('Ошибка передачи запроса к БД');
$row_rek = mysqli_fetch_array($result_rek);
$regenI = ($row_rek['regen']+'1');
 $query_num = "Select id from users where gruppa = 'naemniki'" ;
 $result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
 $od = mysqli_num_rows($result_num);

 $query_num = "Select id from users where gruppa = 'svoboda'" ;
 $result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
 $sv = mysqli_num_rows($result_num);

 $query_num = "Select id from users where gruppa = 'dolg'" ;
 $result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
 $do = mysqli_num_rows($result_num);

 $query_num = "Select id from users where gruppa = 'mon'" ;
 $result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
 $mo = mysqli_num_rows($result_num);
	$query_num = "Select id from users where gruppa <> 'ggg'" ;
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$real_total = mysqli_num_rows($result_num);
	$lzhe_total = ($real_total);
	$lol = rand(1,6);
	$gg = rand(1,$real_total);
$query_gg = "Select nick from users where id = '$gg' ";
$result_gg = mysqli_query($dbc, $query_gg) or die ('Ошибка передачи запроса к БД');
$row_gg = mysqli_fetch_array($result_gg);
$nick = ($row_gg['nick']);
?>
<?php
$query_opit = "Select * from users where admin <> '1' order by opit desc limit 1";
$result_opit = mysqli_query($dbc, $query_opit) or die ('Ошибка передачи запроса к БД100');
$row_opit = mysqli_fetch_array($result_opit);
$lvl_lider = $row_opit['lvl'];
$nick_1 = $row_opit['nick'];
$id_1 = $row_opit['id'];
$query_opit1 = "Select * from users where admin <> '1' order by slava desc limit 1";
$result_opit1 = mysqli_query($dbc, $query_opit1) or die ('Ошибка передачи запроса к БД101');
$row_opit1 = mysqli_fetch_array($result_opit1);
$slava_lider = $row_opit1['slava'];
$nick_2 = $row_opit1['nick'];
$id_2 = $row_opit1['id'];
$query_opit2 = "Select * from users where admin <> '1' order by activ desc limit 1";
$result_opit2 = mysqli_query($dbc, $query_opit2) or die ('Ошибка передачи запроса к БД102');
$row_opit2 = mysqli_fetch_array($result_opit2);
$activ_lider = $row_opit2['activ'];
$nick_3 = $row_opit2['nick'];
$id_3 = $row_opit2['id'];
$query_opit3 = "Select * from users where admin <> '1' order by tainik_time desc limit 1";
$result_opit3 = mysqli_query($dbc, $query_opit3) or die ('Ошибка передачи запроса к БД103');
$row_opit3 = mysqli_fetch_array($result_opit3);
$time_t_lider = $row_opit3['tainik_time'];
$nick_4 = $row_opit3['nick'];
$id_4 = $row_opit3['id'];
$query_opit4 = "Select * from users where admin <> '1' order by m_kill desc limit 1";
$result_opit4 = mysqli_query($dbc, $query_opit4) or die ('Ошибка передачи запроса к БД104');
$row_opit4 = mysqli_fetch_array($result_opit4);
$kill_lider = $row_opit4['m_kill'];
$nick_5 = $row_opit4['nick'];
$id_5 = $row_opit4['id'];
$query_opit5 = "Select * from users where admin <> '1' order by quests desc limit 1";
$result_opit5 = mysqli_query($dbc, $query_opit5) or die ('Ошибка передачи запроса к БД105');
$row_opit5 = mysqli_fetch_array($result_opit5);
$zad_lider = $row_opit5['quests'];
$nick_6 = $row_opit5['nick'];
$id_6 = $row_opit5['id'];
$query_opit6 = "Select * from users where admin <> '1' order by art_n DESC, opit DESC limit 1";
$result_opit6 = mysqli_query($dbc, $query_opit6) or die ('Ошибка передачи запроса к БД106');
$row_opit6 = mysqli_fetch_array($result_opit6);
$art_lider = $row_opit6['art_n'];
$nick_7 = $row_opit6['nick'];
$id_7 = $row_opit6['id'];
?>
<?php
$top = rand(1,7);
?>
<?php
if ($prem == '1' and $time141 < '0') {?>
<?php
$query = "update users set premium='0' where id='$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?
}
?>

<div class="pole2" style="background: #000000;">
<div style="background-color: #1E1E1E;">
<img src="img/lag.png" alt="Лого" width="100%"/>
<div style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/dlfon.gif) repeat;">
<center>
<?php if ($lvl_u >= 5) {?>
<?php
if ($lol == '1') {?><p class="white"><b>Они зарабатывают не так, как обычные люди. Они выживают там, где не выживет обычный человек. Они - сталкеры, стань лучшим из них!</b></p><?php }
if ($lol == '2') {?><p class="white"><b>Они зарабатывают не так, как обычные люди. Они выживают там, где не выживет обычный человек. Они - сталкеры, стань лучшим из них!</b></p><?php }
if ($lol == '3') {?><p class="white"><b>Лучший сталкер рейтинга <?php
if ($top == '1') {?>опыта<?php }
if ($top == '2') {?>славы<?php }
if ($top == '3') {?>активности<?php }
if ($top == '4') {?>взлома тайников<?php }
if ($top == '5') {?>охотников<?php }
if ($top == '6') {?>заданий<?php }
if ($top == '7') {?>искателей<?php }
?>: <a href="profile.php?id=<?php
if ($top == '1') {?><?php echo "$id_1"; ?><?php }
if ($top == '2') {?><?php echo "$id_2"; ?><?php }
if ($top == '3') {?><?php echo "$id_3"; ?><?php }
if ($top == '4') {?><?php echo "$id_4"; ?><?php }
if ($top == '5') {?><?php echo "$id_5"; ?><?php }
if ($top == '6') {?><?php echo "$id_6"; ?><?php }
if ($top == '7') {?><?php echo "$id_7"; ?><?php }
?>"><?php
if ($top == '1') {?><?php echo "$nick_1"; ?><?php }
if ($top == '2') {?><?php echo "$nick_2"; ?><?php }
if ($top == '3') {?><?php echo "$nick_3"; ?><?php }
if ($top == '4') {?><?php echo "$nick_4"; ?><?php }
if ($top == '5') {?><?php echo "$nick_5"; ?><?php }
if ($top == '6') {?><?php echo "$nick_6"; ?><?php }
if ($top == '7') {?><?php echo "$nick_7"; ?><?php }
?></a></b> 
(<?php
if ($top == '1') {?><?php echo "$lvl_lider"; ?> уровень<?php }
if ($top == '2') {?><?php echo "$slava_lider"; ?> славы<?php }
if ($top == '3') {?><?php echo "$activ_lider"; ?> активности<?php }
if ($top == '4') {?><?php echo "$time_t_lider"; ?> секунд<?php }
if ($top == '5') {?><?php echo "$kill_lider"; ?> убийств<?php }
if ($top == '6') {?><?php echo "$zad_lider"; ?> заданий<?php }
if ($top == '7') {?><?php echo "$art_lider"; ?> артефактов<?php }
?>
)</p><?php }
if ($lol == '4') {?><p class="white"><b>Нас уже <?php echo "$lzhe_total"; ?>!</b></p><?php }
if ($lol == '5') {?><p class="white"><b>Лучший сталкер рейтинга <?php
if ($top == '1') {?>опыта<?php }
if ($top == '2') {?>славы<?php }
if ($top == '3') {?>активности<?php }
if ($top == '4') {?>взлома тайников<?php }
if ($top == '5') {?>охотников<?php }
if ($top == '6') {?>заданий<?php }
if ($top == '7') {?>искателей<?php }
?>: <a href="profile.php?id=<?php
if ($top == '1') {?><?php echo "$id_1"; ?><?php }
if ($top == '2') {?><?php echo "$id_2"; ?><?php }
if ($top == '3') {?><?php echo "$id_3"; ?><?php }
if ($top == '4') {?><?php echo "$id_4"; ?><?php }
if ($top == '5') {?><?php echo "$id_5"; ?><?php }
if ($top == '6') {?><?php echo "$id_6"; ?><?php }
if ($top == '7') {?><?php echo "$id_7"; ?><?php }
?>"><?php
if ($top == '1') {?><?php echo "$nick_1"; ?><?php }
if ($top == '2') {?><?php echo "$nick_2"; ?><?php }
if ($top == '3') {?><?php echo "$nick_3"; ?><?php }
if ($top == '4') {?><?php echo "$nick_4"; ?><?php }
if ($top == '5') {?><?php echo "$nick_5"; ?><?php }
if ($top == '6') {?><?php echo "$nick_6"; ?><?php }
if ($top == '7') {?><?php echo "$nick_7"; ?><?php }
?></a></b> 
(<?php
if ($top == '1') {?><?php echo "$lvl_lider"; ?> уровень<?php }
if ($top == '2') {?><?php echo "$slava_lider"; ?> славы<?php }
if ($top == '3') {?><?php echo "$activ_lider"; ?> активности<?php }
if ($top == '4') {?><?php echo "$time_t_lider"; ?> секунд<?php }
if ($top == '5') {?><?php echo "$kill_lider"; ?> убийств<?php }
if ($top == '6') {?><?php echo "$zad_lider"; ?> заданий<?php }
if ($top == '7') {?><?php echo "$art_lider"; ?> артефактов<?php }
?>
)</p><?php }
if ($lol == '6') {?><p class="white"><b>Состав сталкеров: <?php echo "$od";?> одиночек, <?php echo "$sv";?> свободовцев, <?php echo "$do";?> долговцев, <?php echo "$mo";?> монолитовцев.</b></p><?php }
?>
</div>
<?php }
if ($lvl_u < 3 and $lvl_u > 0) {?><p style="border-style: double;"><span class="white">Добро пожаловать в  онлайн игру "S.T.A.L.K.E.R. - Зов Припяти!"<br />Начнем твое обучение: сражения в рейдах - способ заработать немного хабара и опыта. Так давай же сходим туда.</span></p><?php }
if ($lvl_u < 5 and $lvl_u >= 3) {?><p style="border-style: double;"><span class="white">Слепой пес мертв. Зона ему пухом... Кстати, насчет Зоны: давай заглянем и туда!</span></p><?php }
if ($lvl_u < 1) {?><p style="border-style: double;"><span class="white">Добро пожаловать в мобильную онлайн игру "S.T.A.L.K.E.R. - Зов Припяти!"<br />Для начала игры пройдите быструю регистрацию.</span></p><?php }
?>
</div>
</div>
<?php
if ($lvl_u > '4') {?><p style="border-style: double;">


<small>
<?php
$room = '2';
  $query_chat = "SELECT * FROM `chat` where time > NOW() - 240000 and type = '$room' ORDER BY `time` DESC limit 1";
  $result_chat = mysqli_query($dbc, $query_chat) or die ('Ошибка передачи запроса к БД');
  $count_chat = mysqli_num_rows($result_chat);
  if (!empty($count_chat)) {
    while ($row_chat = mysqli_fetch_array($result_chat)) {
    $id_chat = $row_chat['user_id'];
	$query_ch = "Select nick, gruppa, admin, moder, user, last_active from users where id = '$id_chat'";
    $result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
	$row_ch=mysqli_fetch_array($result_ch);
	$say = $row_chat['say'];
        $dlya = $row_chat['dlya_id'];
	$time = $row_chat['time'];
	$last_active = $row_ch['last_active'];
	$time11 = strtotime("$time");
	?><?php
$last_active = strtotime("$last_active");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$razn_last_act = ($now - $last_active);
$razn = ($now - $time);
$time11 = ($now - $time11);
if ($row_ch['gruppa'] == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'mon') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?>
<a href="profile.php?id=<?php echo $row_chat['user_id'];?>"><?php echo $row_ch['nick'];?></a> : <span class="net"><?php echo "$say";?></span>  <small><?php
if ($time11 < '60') {?><?php echo "$time11";?>сек.<?php }
if ($time11 > '59' and $time11 < '120') {?>1мин.<?php }
if ($time11 > '119' and $time11 < '180') {?>2мин.<?php }
if ($time11 > '179' and $time11 < '240') {?>3мин.<?php }
if ($time11 > '239' and $time11 < '300') {?>4мин.<?php }
if ($time11 > '299' and $time11 < '360') {?>5мин.<?php }
if ($time11 > '359' and $time11 < '420') {?>6мин.<?php }
if ($time11 > '419' and $time11 < '480') {?>7мин.<?php }
if ($time11 > '479' and $time11 < '540') {?>8мин.<?php }
if ($time11 > '539' and $time11 < '600') {?>9мин.<?php }
if ($time11 > '599' and $time11 < '660') {?>10мин.<?php }
if ($time11 > '659' and $time11 < '720') {?>11мин.<?php }
if ($time11 > '719' and $time11 < '780') {?>12мин.<?php }
if ($time11 > '779' and $time11 < '840') {?>13мин.<?php }
if ($time11 > '839' and $time11 < '900') {?>14мин.<?php }
if ($time11 > '899' and $time11 < '960') {?>15мин.<?php }
if ($time11 > '959' and $time11 < '1020') {?>16мин.<?php }
if ($time11 > '1019' and $time11 < '1080') {?>17мин.<?php }
if ($time11 > '1079' and $time11 < '1140') {?>18мин.<?php }
if ($time11 > '1139' and $time11 < '1200') {?>19мин.<?php }
if ($time11 > '1199' and $time11 < '1260') {?>20мин.<?php }
if ($time11 > '1259' and $time11 < '1320') {?>21мин.<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22мин.<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23мин.<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24мин.<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25мин.<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26мин.<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27мин.<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28мин.<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29мин.<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30мин.<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31мин.<?php }
if ($time11 > '1919' and $time11 < '1980') {?>32мин.<?php }
if ($time11 > '1979' and $time11 < '2040') {?>33мин.<?php }
if ($time11 > '2039' and $time11 < '2100') {?>34мин.<?php }
if ($time11 > '2099' and $time11 < '2160') {?>35мин.<?php }
if ($time11 > '2159' and $time11 < '2220') {?>36мин.<?php }
if ($time11 > '2219' and $time11 < '2280') {?>37мин.<?php }
if ($time11 > '2279' and $time11 < '2340') {?>38мин.<?php }
if ($time11 > '2339' and $time11 < '2400') {?>39мин.<?php }
if ($time11 > '2399' and $time11 < '2460') {?>40мин.<?php }
if ($time11 > '2459' and $time11 < '2520') {?>41мин.<?php }
if ($time11 > '2519' and $time11 < '2580') {?>42мин.<?php }
if ($time11 > '2579' and $time11 < '2640') {?>43мин.<?php }
if ($time11 > '2639' and $time11 < '2700') {?>44мин.<?php }
if ($time11 > '2699' and $time11 < '2760') {?>45мин.<?php }
if ($time11 > '2759' and $time11 < '2820') {?>46мин.<?php }
if ($time11 > '2819' and $time11 < '2880') {?>47мин.<?php }
if ($time11 > '2879' and $time11 < '2940') {?>48мин.<?php }
if ($time11 > '2939' and $time11 < '3000') {?>49мин.<?php }
if ($time11 > '2999' and $time11 < '3060') {?>50мин.<?php }
if ($time11 > '3059' and $time11 < '3120') {?>51мин.<?php }
if ($time11 > '3119' and $time11 < '3180') {?>52мин.<?php }
if ($time11 > '3179' and $time11 < '3240') {?>53мин.<?php }
if ($time11 > '3239' and $time11 < '3300') {?>54мин.<?php }
if ($time11 > '3299' and $time11 < '3360') {?>55мин.<?php }
if ($time11 > '3359' and $time11 < '3420') {?>56мин.<?php }
if ($time11 > '3419' and $time11 < '3480') {?>57мин.<?php }
if ($time11 > '3479' and $time11 < '3540') {?>58мин.<?php }
if ($time11 > '3539' and $time11 < '3600') {?>59мин.<?php }
if ($time11 > '3599' and $time11 < '3660') {?>60мин.<?php }
if ($time11 > '3659' and $time11 < '7200') {?>1час.<?php }
if ($time11 > '7199' and $time11 < '10800') {?>2час.<?php }
if ($time11 > '10799' and $time11 < '14400') {?>3час.<?php }
if ($time11 > '14399' and $time11 < '18000') {?>4час.<?php }
if ($time11 > '17999' and $time11 < '21600') {?>5час.<?php }
if ($time11 > '21599' and $time11 < '25200') {?>6час.<?php }
if ($time11 > '25199' and $time11 < '28800') {?>7час.<?php }
if ($time11 > '28799' and $time11 < '32400') {?>8час.<?php }
if ($time11 > '32399' and $time11 < '36000') {?>9час.<?php }
if ($time11 > '35999' and $time11 < '39600') {?>10час.<?php }
if ($time11 > '39599' and $time11 < '43200') {?>11час.<?php }
if ($time11 > '43199' and $time11 < '46800') {?>12час.<?php }
if ($time11 > '46799' and $time11 < '50400') {?>13час.<?php }
if ($time11 > '50399' and $time11 < '54000') {?>14час.<?php }
if ($time11 > '53999' and $time11 < '57600') {?>15час.<?php }
if ($time11 > '57599' and $time11 < '61200') {?>16час.<?php }
if ($time11 > '61199' and $time11 < '64800') {?>17час.<?php }
if ($time11 > '64799' and $time11 < '68400') {?>18час.<?php }
if ($time11 > '68399' and $time11 < '72000') {?>19час.<?php }
if ($time11 > '71999' and $time11 < '75600') {?>20час.<?php }
if ($time11 > '75599' and $time11 < '79200') {?>21час.<?php }
if ($time11 > '79199' and $time11 < '82800') {?>22час.<?php }
if ($time11 > '82799' and $time11 < '86400') {?>23час.<?php }
if ($time11 > '86399' and $time11 < '90000') {?>1день<?php }
if ($time11 > '89999' and $time11 < '172800') {?>2дня<?php }
?></small>
<?php
}
}
?>
</small>



</p><?php }
?>
</center></div>
<div style="border-left:1px solid #444e4f;border-right:1px solid #444e4f;">
<?php
if ((!isset($_SESSION['id'])) and (!isset($_SESSION['nick'])))  {
?>
<div class="link"><a href="reg.php" class="link"><img src="img/ico/link.png" width="12" height="12"/> Регистрация <?php if ($lvl_u < 1) {?><img src="img/1.gif"/><?php }?></a></div>
<div class="link"><a href="login.php" class="link"><img src="img/ico/link.png" width="12" height="12"/> Вход</a></div>
<?php
}
?>
<?php
$query = "update users set m_stop='0', m_fight='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php
$query_num = "Select id from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result_num); 
?>
<?php
$query_num = "Select id from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and location = 'chat'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$chat_total = mysqli_num_rows($result_num); 
?>
<?php
$query_num = "Select id from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and location = 'forum'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$forum_total = mysqli_num_rows($result_num); 
?>
<?php if ($adminnn == '1') {?>
<center><div class="name">Админ-панель</div></center>
<div class="link"><a href="admin-panel.php?tip=new" class="link"><img src="img/pencil1.png" width="12" height="12"/> Создать новость</a></div>
<div class="link"><a href="err.php" class="link"><img src="img/ico/no.png" width="12" height="12"/> Список заблокированных</a></div>
<?php }?>
<center><div class="name">Услуги</div></center>

<div class="link"><a href="skadovsk.php" class="link"><img src="img/ico/magazin.png" width="12" height="12"/> Скадовск</a></div>
<div class="link"><a href="a_clothes.php" class="link"><img src="img/ico/auc.png" width="12" height="12"/> Аукцион</a></div>
<div class="link"><a href="poisk.php" class="link"><img src="img/ico/search.png" width="12" height="12"/> Поиск</a></div>
<div class="link"><a href="start.php?type=1" class="link"><img src="img/ico/start.png" width="12" height="12"/> Обучение</a></div>
<div class="link"><a href="client.php" class="link"><img src="img/client_ico.png" width="12" height="12"/> Клиент для Android</a></div>
<?php if ($clannn == '0') {?><div class="link"><a href="createcompany.php" class="link"><img src="img/ico/flag1.png" width="12" height="12"/> Создать отряд</a></div><?php }?>
<center><div class="name">Зона</div></center>
<div class="link"><a href="zonas.php" class="link"><img src="favicon.ico" width="12" height="12"/> Новая Зона <span class="red">(test)</span></a></div>
<div class="link"><a class="link" href="zona.php"><img src="img/ico/radiation1.PNG" width="12" height="12"/> Зона <?php if ($lvl_u < 5 and $lvl_u >= 3) {?><img src="img/1.gif"/><?php }?></a>
</div>
<div class="link"><a class="link" href="monsters.php"><img src="img/ico/ohotniki.gif" width="12" height="12"/> Рейды <?php if ($lvl_u < 3 and $lvl_u > 0) {?><img src="img/1.gif"/><?php }?></a>
</div>
<div class="link"><a href="arena.php" class="link"><img src="img/ico/arena.png" width="12" height="12"/> Арена</a></div>
<div class="link"><a href="vzlom.php" class="link"><img src="img/ico/link.png" width="12" height="12"/> Взлом тайников</a></div>
<center><div class="name">Общение</div></center>
<?php if ($lvl_u >= 5) {?>
<div class="link"><a href="chat.php?c=1" class="link"><img src="img/ico/chat.png" width="12" height="12"/> Чат <span class="bonus"><?php echo "($chat_total)"; ?></span></a></div>
<?php }?>
<div class="link"><a href="forum.php?type=main" class="link"><img src="img/ico/forum_new.png" width="12" height="12"/> Форум <span class="bonus"><?php echo "($forum_total)"; ?></span></a></div>
<div class="link"><a href="online.php" class="link"><img src="img/ico/on.png" width="12" height="12"/> Кто онлайн <span class="bonus"><?php echo "($total)"; ?></span></a></div>
<div class="link"><a href="vip-list.php" class="link"><img src="img/star.png" width="12" height="12"/> VIP-сталкеры</a></div>
<div class="link"><a href="help.php" class="link"><img src="img/ico/pravila.png" width="12" height="12"/> Помощь</a></div>
<center><div class="name">Рейтинги</div></center>
<div class="link"><a href="legend_zona.php" class="link"><img src="img/ico/link.png" width="12" height="12"/> Просмотреть</a></div>
<img src="style/img/black.png" width="100%" height="5"/>
<center><div class="name">Персонаж</div></center>
<?php
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/navigin.php');
}
?>
<?php
require_once('conf/blok.php');
?>
</body>
</html>