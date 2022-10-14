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
}
$page_title = 'Чат';
require_once('conf/head.php');
require_once('conf/top.php');
$log_id=$_SESSION['id'];
$query_out = "Select clan, clan_rang, nick from users where id = '$log_id'";
$result_out = mysqli_query($dbc, $query_out) or die ('Ошибка передачи запроса к БД');
$row_out = mysqli_fetch_array($result_out);

$query = "update users set location = 'chat' where id = '$log_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');


////////////////////////////ЧАТ!!!!
$room = $_GET['c'];
if (empty($_GET['c'])) {
$room = $_GET['topic'];
}
if ($room != '1' and $room != '2') {
$room = '1';
}
  $nick = $_GET['nick'];
if (!empty($nick)) {
$query_dfd = "Select * from users where id='$nick' limit 1";
$result_dfd = mysqli_query($dbc, $query_dfd) or die ('Ошибка передачи запроса к БД');
$row_dfd = mysqli_fetch_array($result_dfd);
$nick_dfd = $row_dfd['nick'];
}
  $post = $_GET['post'];
  $post = mysqli_real_escape_string($dbc, trim($post));
  $err = $_GET['err'];
  $query_isset = "Select chat_id from chat where chat_id='$post' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);

$query_ch = "Select clan, clan_rang, regen from users where id = '$log_id'";
$result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
$row_ch = mysqli_fetch_array($result_ch);
$clan_ch = $row_ch['regen'];
$clan_rang_ch = $row_ch['clan_rang'];
$query_user = "Select gruppa, nick, admin, moder, user from users where id = '$log_id'";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД1');
  $row_user = mysqli_fetch_array($result_user);
  if (!empty($clan_ch)) {
    $say_err=$_GET['say_err'];
    if(!empty($say_err)) {
if ($say_err == 1) {?><span id="error">Длина сообщения должна быть не больше 1000 символов</span><?php }
		 if ($say_err == 2) {?><span id="error">Введите хоть что-то</span><?php }
		 if ($say_err == 3) {?><span class="bonus">Ваше сообщение успешно добавлено!</span><?php }
	 }
	  
   ?>



<style type="text/css">
ul.jclisticon-bubble { padding: 0; list-style-image: none; list-style-type: none; }
ul.jclisticon-bubble li {background-image: none; list-style: none; list-style-image: none; margin-left: 5px !important; margin-left: 0; margin-right: 5px !important; margin-right: 0; display: block; overflow: hidden;background:url("http://stalkermod.ru/templates/yoo_quantum/images/toolbar.png");border-radius:6px; box-shadow:0 1px 0 rgba(255, 255, 255, 0.12) inset, 0 1px 0 rgba(0, 0, 0, 0.3), 0 0 0 2px rgba(0, 0, 0, 0.3);padding: 6px !important;margin-bottom:7px !important;}
ul.jclisticon-bubble img.de { width: 32px; height: 32px; margin: 5px 5px 5px 5px;float: left;}
ul.jclisticon-bubble span img {width: auto; height: auto; float: none;}
</style>



<?php
$query_num = "Select id from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and location = 'chat'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$chat_total = mysqli_num_rows($result_num);
?>
<?php if ($room == '1') {?>
<center><div class="name">Общий чат</div></center>
<img src="img/346.png" alt="Чат" width="100%"/>
<div class="link"><a href="chat_online.php" class="link"><img src="img/ico/on.png" width="12" height="12"/> В чате <span class="bonus"><?php echo "$chat_total"; ?></span> <?php
if ($chat_total == '1' or $chat_total == '21') {?>сталкер<?php }
if ($chat_total == 2 or $chat_total == 3 or $chat_total == 4 or $chat_total == 22) {?>сталкера<?php }
if ($chat_total != '1' and $chat_total != '2' and $chat_total != '3' and $chat_total != '4' and $chat_total != '21' and $chat_total != '22') {?>сталкеров<?php }
?></a></div>
<div class="link"><a href="chat.php?c=2" class="link"><img src="img/ico/auc.png" width="12" height="12"/> Сменить комнату</a></div>
	  <p style="border-top:1px solid #444e4f;"> </p>
<div style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/bg.jpg) repeat;">
   <div class="stats">
<?php if ($err == '' and $ban_c == '0') {?>
<center>
  <p>Сообщение<?php if (!empty($nick)) {?> для <a class="stalker_link" href="profile.php?id=<?php echo "$nick";?>"><?php echo "$nick_dfd";?></a><?php }?>:</p><br/>
<form enctype="multipart/form-data" method="post" action="addchat.php?room=1<?php if (!empty($nick)) {?>&dlya=<?php echo "$nick";?><?php }?>" name="message">
<?php
require_once('inc_smiles_panel.php');
?>
<textarea rows="2" style="width:98%; height:60px;" cols="35px" name="msg" autofocus required><?php if ($nick <> '') {?><?php echo "$nick_dfd";?>, <?php }?></textarea>
<div class="knopka">
<input type="submit" style="width:74px;" class="input" value="Отправить" name="addad" accesskey="ы"/>
<a href="chat.php?c=1"><img src="img/icon-refresh.png" width="25" height="25"/></a>
</div>
</form></center>
<?php }
if ($err == '1' or $ban_c == '1') {?>
<p class="red">Вы были забанены в чате.<br/>
Причина: <?php echo "$wtf3";?>.<br/>
Модератор: <a href="user.php?id=<?php echo "$mod_id3";?>"><?php echo "$mn3";?></a>.<br/>
Разбан через: <?php
$time11 = $btc;
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
if ($time11 > '172799' and $time11 < '259200') {?>3дня<?php }
if ($time11 > '259199' and $time11 < '345600') {?>4дня<?php }
if ($time11 > '345599' and $time11 < '432000') {?>5дней<?php }
if ($time11 > '431999' and $time11 < '518400') {?>6дней<?php }
if ($time11 > '518399' and $time11 < '619200') {?>7дней<?php }
if ($time11 > '619199' and $time11 < '777600') {?>8дней<?php }
if ($time11 > '777599' and $time11 < '864000') {?>9дней<?php }
if ($time11 > '863999' and $time11 < '950400') {?>10дней<?php }
if ($time11 > '950399' and $time11 < '1036800') {?>11дней<?php }
if ($time11 > '1036799' and $time11 < '1123200') {?>12дней<?php }
if ($time11 > '1123199' and $time11 < '1209600') {?>13дней<?php }
if ($time11 > '1209599' and $time11 < '1296000') {?>14дней<?php }
if ($time11 > '1295999' and $time11 < '1382400') {?>15дней<?php }
if ($time11 > '1382399' and $time11 < '1468800') {?>16дней<?php }
if ($time11 > '1468799' and $time11 < '1555200') {?>17дней<?php }
if ($time11 > '1555199' and $time11 < '1641600') {?>18дней<?php }
if ($time11 > '1641599' and $time11 < '1728000') {?>19дней<?php }
if ($time11 > '1727999' and $time11 < '1814400') {?>20дней<?php }
if ($time11 > '1814399' and $time11 < '1900800') {?>21день<?php }
if ($time11 > '1900799' and $time11 < '1987200') {?>22дня<?php }
if ($time11 > '1987199' and $time11 < '2073600') {?>23дня<?php }
if ($time11 > '2073599' and $time11 < '2160000') {?>24дня<?php }
if ($time11 > '2159999' and $time11 < '2246400') {?>25дней<?php }
if ($time11 > '2246399' and $time11 < '2332800') {?>26дней<?php }
if ($time11 > '2332799' and $time11 < '2419200') {?>27дней<?php }
if ($time11 > '2419199' and $time11 < '2505600') {?>28дней<?php }
if ($time11 > '2505599' and $time11 < '2592000') {?>29дней<?php }
if ($time11 > '2591999' and $time11 < '5184000') {?>1мес.<?php }
if ($time11 > '5183999' and $time11 < '7776000') {?>2мес.<?php }
if ($time11 > '7775999' and $time11 < '10368000') {?>3мес.<?php }
?></p>
<?php }
?>
<p style="border-top: dashed #444e4f 1px;"> </p>
	<?php
	$query_num = "Select chat_id from chat where time > NOW() - 240000 and type = '1'" ;
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$total = mysqli_num_rows($result_num); 
	?>
   <?php
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 15;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total / $result_per_page);
	if ($num_page > 0) {
  $query_chat = "SELECT * FROM `chat` where time > NOW() - 240000 and type = '1' ORDER BY `time` DESC limit $skip, $result_per_page";
  $result_chat = mysqli_query($dbc, $query_chat) or die ('Ошибка передачи запроса к БД');
  $count_chat = mysqli_num_rows($result_chat);
  if (!empty($count_chat)) {
    while ($row_chat = mysqli_fetch_array($result_chat)) {
    $id_chat = $row_chat['user_id'];
	$query_ch = "Select nick, gruppa, admin, moder, user, last_active, premium, c_ban, avatar from users where id = '$id_chat'";
    $result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
	$row_ch=mysqli_fetch_array($result_ch);
	$say = $row_chat['say'];
        $dlya = $row_chat['dlya_id'];
	$time = $row_chat['time'];
	$last_active = $row_ch['last_active'];
	$time11 = strtotime("$time");
$avatar = $row_ch['avatar'];
$say = strtr($say, array("rn" => '<br />', '\"' => '"'));
$text = $say;
require_once('inc_smiles.php');
$say = $text;


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ban_c = '0';
$query_cb = "Select * from bans where user_id = '$id_chat' and type = '3'";
$result_cb = mysqli_query($dbc, $query_cb) or die ('Ошибка передачи запроса к БД');
$row_cb = mysqli_fetch_array($result_cb);
if ($row_cb > '0') {
$ban_c = '1';
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	?><?php
$last_active = strtotime("$last_active");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$razn_last_act = ($now - $last_active);
$razn = ($now - $time);
$time11 = ($now - $time11);
$moderator = '0';
if ($row_ch['admin'] == '1') {
$moderator = '1';
}
if ($row_ch['moder'] == '1') {
$moderator = '1';
}
?>


<ul class="jclisticon-bubble">
<li>
<img src="img/ava/<?php echo "$avatar"; ?>.png" alt="" border="0" class="de"/>
<?php
if ($row_ch['premium'] == '1') {
if ($razn_last_act < '1800') {?>
<span class="gold"><small>(vip)</small></span>
<?php } else {?>
<small>(vip)</small>
<?php }
}
if ($row_ch['gruppa'] == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'mon') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?><a class="stalker_link" <?php if ($moderator == '1') {?>style="text-shadow:0px 0px 7px; color: #00BFFF; font-weight: bold;"<?php }?>  href="chat.php?nick=<?php echo $row_chat['user_id'];?>" title="<?php echo $row_ch['nick'];?>"><?php echo $row_ch['nick'];?></a> [<a href="profile.php?id=<?php echo $row_chat['user_id'];?>"><img src="img/ico/profile.png" width="15" height="15" alt="н"/></a>]:
<br />
<?php if ($row_ch['c_ban'] == '1' or $ban_c == '1') {?>
Скрыто модератором.<?php } else {?>
<span class="stalker_post" style="<?php
if ($dlya == $log_id) {?>color: #4682B4;<?php }
if ($moderator == '1') {?>color: green;<?php }
?>"><?php
echo "$say";?></span><?php }?> <?php if ($row_user['user'] == '1') {?> <?php } else {?> [<a class="red" href="del_post.php?post_id=<?php echo $row_chat['chat_id']; ?>">удалить</a>]<?php }?>
<br />
<span style="color: #CCCCCC; text-shadow: 0 0 5px #FFFFFF;"><small><?php
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
?></small> назад</span></li>


<?php
    }
  }

		}
  ?>
  </div>



<?php }
else {?>




<center><div class="name">Рекламный чат</div></center>
<img src="img/346.png" alt="Чат" width="100%"/>
<div class="link"><a href="chat_online.php" class="link"><img src="img/ico/on.png" width="12" height="12"/> В чате <span class="bonus"><?php echo "$chat_total"; ?></span> <?php
if ($chat_total == '1' or $chat_total == '21') {?>сталкер<?php }
if ($chat_total == 2 or $chat_total == 3 or $chat_total == 4 or $chat_total == 22) {?>сталкера<?php }
if ($chat_total != '1' and $chat_total != '2' and $chat_total != '3' and $chat_total != '4' and $chat_total != '21' and $chat_total != '22') {?>сталкеров<?php }
?></a></div>
<div class="link"><a href="chat.php?c=1" class="link"><img src="img/ico/room1.png" width="12" height="12"/> Сменить комнату</a></div>
	  <p style="border-top:1px solid #444e4f;"> </p>
<div style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/bg.jpg) repeat;">
   <div class="stats">
<?php if ($err == '' and $ban_c == '0') {?>
<center>
  <p>Сообщение<?php if (!empty($nick)) {?> для <a class="stalker_link" href="profile.php?id=<?php echo "$nick";?>"><?php echo "$nick_dfd";?></a><?php }?>:</p><br/>
<form enctype="multipart/form-data" method="post" action="addchat.php?room=2<?php if (!empty($nick)) {?>&dlya=<?php echo "$nick";?><?php }?>" name="message">
<?php
require_once('inc_smiles_panel.php');
?>
<textarea rows="2" style="width:98%; height:60px;" cols="35px" name="msg" autofocus required><?php if ($nick <> '') {?><?php echo "$nick_dfd";?>, <?php }?></textarea>
<div class="knopka">
<input type="submit" style="width:74px;" class="input" value="Отправить" name="addad" accesskey="ы"/>
<a href="chat.php?c=2"><img src="img/icon-refresh.png" width="25" height="25"/></a>
</div>
</form></center>
<?php }
if ($err == '1' or $ban_c == '1') {?>
<p class="red">Вы были забанены в чате.<br/>
Причина: <?php echo "$wtf3";?>.<br/>
Модератор: <a href="user.php?id=<?php echo "$mod_id3";?>"><?php echo "$mn3";?></a>.<br/>
Разбан через: <?php
$time11 = $btc;
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
?></p>
<?php }
?>
<p style="border-top: dashed #444e4f 1px;"> </p>
	<?php
	$query_num = "Select chat_id from chat where time > NOW() - 240000 and type = '2'" ;
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$total = mysqli_num_rows($result_num); 
	?>
   <?php
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 15;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total / $result_per_page);
	if ($num_page > 0) {
  $query_chat = "SELECT * FROM `chat` where time > NOW() - 240000 and type = '2' ORDER BY `time` DESC limit $skip, $result_per_page";
  $result_chat = mysqli_query($dbc, $query_chat) or die ('Ошибка передачи запроса к БД');
  $count_chat = mysqli_num_rows($result_chat);
  if (!empty($count_chat)) {
    while ($row_chat = mysqli_fetch_array($result_chat)) {
    $id_chat = $row_chat['user_id'];
	$query_ch = "Select nick, gruppa, admin, moder, user, last_active, premium, c_ban, avatar from users where id = '$id_chat'";
    $result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
	$row_ch=mysqli_fetch_array($result_ch);
	$say = $row_chat['say'];
        $dlya = $row_chat['dlya_id'];
	$time = $row_chat['time'];
	$last_active = $row_ch['last_active'];
	$time11 = strtotime("$time");
$avatar = $row_ch['avatar'];
$say = strtr($say, array("rn" => '<br />', '\"' => '"'));

$text = $say;
require_once('inc_smiles.php');
$say = $text;

	?><?php
$last_active = strtotime("$last_active");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$razn_last_act = ($now - $last_active);
$razn = ($now - $time);
$time11 = ($now - $time11);
$moderator = '0';
if ($row_ch['admin'] == '1') {
$moderator = '1';
}
if ($row_ch['moder'] == '1') {
$moderator = '1';
}
?>


<ul class="jclisticon-bubble">
<li>
<img src="img/ava/<?php echo "$avatar"; ?>.png" alt="" border="0" class="de"/>
<?php
if ($row_ch['premium'] == '1') {
if ($razn_last_act < '1800') {?>
<span class="gold"><small>(vip)</small></span>
<?php } else {?>
<small>(vip)</small>
<?php }
}
if ($row_ch['gruppa'] == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($row_ch['gruppa'] == 'mon') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?><a class="stalker_link"  href="chat.php?nick=<?php echo $row_chat['user_id'];?>&c=2" title="<?php echo $row_ch['nick'];?>"><?php echo $row_ch['nick'];?></a> [<a href="profile.php?id=<?php echo $row_chat['user_id'];?>"><img src="img/ico/profile.png" width="15" height="15" alt="н"/></a>]:
<br />
<?php if ($row_ch['c_ban'] == '1' or $ban_c == '1') {?>
Скрыто модератором.<?php } else {?>
<span class="stalker_post" style="<?php
if ($dlya == $log_id) {?>color: #4682B4;<?php }
if ($moderator == '1') {?>color: green;<?php }
?>"><?php echo "$say";?></span><?php }?> <?php if ($row_user['user'] == '1') {?> <?php } else {?> [<a class="red" href="del_post.php?post_id=<?php echo $row_chat['chat_id']; ?>">удалить</a>]<?php }?>
<br />
<span style="color: #CCCCCC; text-shadow: 0 0 5px #FFFFFF;"><small><?php
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
?></small> назад</span></li>


<?php
    }
  }

		}
  ?>
  </div>
<?php }?>
  <?php
}
else {
  require_once('conf/notfound.php');
} 
////////////////////////////////
///////////////////////////

require_once('conf/naviga1.php');
require_once('conf/navig.php');
require_once('conf/fot.php');
mysqli_close($dbc);
?>

</body>
</html>