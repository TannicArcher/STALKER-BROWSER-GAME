<?php
require_once('../conf/dbc.php');
require_once('../conf/session_start.php');
require_once('../conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
?>
<script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
</script>
<?php
};
$page_title = 'Личные сообщения';
require_once('../conf/head.php');
require_once('../conf/top1.php');
$id_mail = $_GET['id1'];
?>
<?php
$user_id = $id_mail;
$tip = $_GET['tip'];
$query = "update users set location = 'mail' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query1 = "Select * from users where id='$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$query_num = "Select message_id from message where dlya='$user_id' and reading='0' and type != '6' and type != '7' and type != '8' and type != '9' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6 = mysqli_num_rows($result_num);
$message = $total6;
?>
<div id="main">
<div class="stats">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Личные сообщения (<?php echo "$message";?>)</p></center>
</div>
<?php
$query_num = "Select kon_id from kontakts where user_id='$user_id' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД11');
$total5 = mysqli_num_rows($result_num); 
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
$query_sub = "Select * from kontakts where user_id = '$user_id' order by time desc limit $skip, $result_per_page";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id = $row_sub['kon_id'];
$id1 = $row_sub['user_id'];
$id2 = $row_sub['drug_id'];
$query_num = "Select message_id from message where ot='$id2' and dlya='$id1' and reading='0' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6 = mysqli_num_rows($result_num);
$test = $total6;
$query = "Select * from users where id='$id2' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$avatar = $row['avatar'];
$nick = $row['nick'];
$sex = $row['sex'];
$gruppa = $row['gruppa'];
$last_active = $row['last_active'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$last_active = strtotime("$last_active");
$razn_last_act = ($now - $last_active);
$query4 = "Select * from message where ot='$id1' and dlya='$id2' or ot='$id2' and dlya='$id1' order by time desc limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row4 = mysqli_fetch_array($result4);
$type = $row4['type'];
$ot = $row4['ot'];
$dlya = $row4['dlya'];
$text = $row4['text'];
$reading = $row4['reading'];
$time = $row4['time'];
$text = str_replace('<br />',' ', $text);
$text = strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />', '<img src="img/smiles/anomaliya.gif" />' => ':аномалия', '<img src="img/smiles/tost.gif" />' => ':тост', '<img src="img/tomato.gif"/>' => ':томат', '<img src="img/smiles/25_kiss.gif" />' => ':*', '<img src="img/smiles/D.gif" />' => ':D', '<img src="img/smiles/gun.gif" />' => ':ган', '<img src="img/smiles/gitara.gif" />' => ':гитара' , '<img src="img/smiles/09_bebe.gif" />' => ':-P', '<img src="img/smiles/rzhu.gif" />' => ':ржу', '<img src="img/smiles/fan.gif" />' => ':фан', '<img src="img/smiles/umora.gif" />' => ':умора', '<img src="img/smiles/rasta.gif" />' => ':раста', '<img src="img/smiles/facepalm.gif" />' => ':фэйспалм', '<img src="img/smiles/dovolen.gif" />' => ':доволен', '<img src="img/smiles/dovolen2.gif" />' => ':доволен2', '<img src="img/smiles/pirat.gif" />' => ':пират', '<img src="img/smiles/olen.gif" />' => ':олень', '<img src="img/smiles/smile.gif" />' => ':)', '<img src="img/smiles/sad.gif" />' => ':(', '<img src="img/smiles/zlo.gif" />' => ':зло', '<img src="img/smiles/xmm.gif" />' => ':хмм', '<img src="img/smiles/mail.gif" />' => ':пишу', '<img src="img/smiles/xaxa.gif" />' => ':хаха', '<img src="img/smiles/zhopa.gif" />' => ':жопа', '<img src="img/smiles/gg.gif" />' => ':гг', '<img src="img/smiles/letaet.gif" />' => ':летает', '<img src="img/smiles/vau.gif" />' => ':ого', '<img src="img/smiles/tiho.gif" />' => ':тихо', '<img src="img/smiles/smert.gif" />' => ':смерть', '<img src="img/smiles/poisk.gif" />' => ':поиск', '<img src="img/smiles/pizdec.gif" />' => ':накрыло', '<img src="img/smiles/oy.gif" />' => ':оу', '<img src="img/smiles/oops.gif" />' => ':упс', '<img src="img/smiles/nyam.gif" />' => ':ням', '<img src="img/smiles/nono.gif" />' => ':ноно', '<img src="img/smiles/no.gif" />' => ':нет', '<img src="img/smiles/ninja.gif" />' => ':ниндзя', '<img src="img/smiles/neznaju.gif" />' => ':незнаю', '<img src="img/smiles/nea.gif" />' => ':неа', '<img src="img/smiles/music.gif" />' => ':муз', '<img src="img/smiles/mister.gif" />' => ':мистер', '<img src="img/smiles/lamer.gif" />' => ':ламер', '<img src="img/smiles/kulak.gif" />' => ':кыш', '<img src="img/smiles/krut.gif" />' => ':крут', '<img src="img/smiles/klass.gif" />' => ':супер', '<img src="img/smiles/hello.gif" />' => ':пока', '<img src="img/smiles/fuck.gif" />' => ':фак', '<img src="img/smiles/flood.gif" />' => ':флуд', '<img src="img/smiles/fingal.gif" />' => ':фингал', '<img src="img/smiles/cold.gif" />' => ':холодно', '<img src="img/smiles/bomba.gif" />' => ':бомба', '<img src="img/smiles/blin.gif" />' => ':блин', '<img src="img/smiles/ban.gif" />' => ':бан', '<img src="img/smiles/crazy.gif" />' => ':идиот', '<img src="img/smiles/[.gif" />' => ':[', '<img src="img/smiles/bb.gif" />' => ':качок', '<img src="img/smiles/atlet.gif" />' => ':атлет', '<img src="img/smiles/aaa.gif" />' => ':ааа', '<img src="img/smiles/scare.gif" />' => ':испуг', '<img src="img/smiles/cray.gif" />' => ':плак' , '<img src="img/smiles/8.gif" />' => ':глаза' ));
$text = strtr($text, array('é' => 'й', 'ö' => 'ц', 'ó' => 'у', 'ê' => 'к', 'å' => 'е',  'í' => 'н', 'ã' => 'г', 'ø' => 'ш', 'ù' => 'щ', 'ç' => 'з', 'õ' => 'х', 'ú' => 'ъ', 'ô' => 'ф', 'û' => 'ы', 'â' => 'в',  'à' => 'а', 'ï' => 'п', 'ð' => 'р', 'î' => 'о', 'ë' => 'л', 'ä' => 'д', 'æ' => 'ж', 'ý' => 'э', 'ÿ' => 'я', '÷' => 'ч',  'ñ' => 'с', 'ì' => 'м', 'è' => 'и', 'ò' => 'т', 'ü' => 'ь', 'á' => 'б', 'þ' => 'ю', '¸' => 'ё',
'É' => 'Й', 'Ö' => 'Ц', 'Ó' => 'У', 'Ê' => 'К', 'Å' => 'Е',  'Í' => 'Н', 'Ã' => 'Г', 'Ø' => 'Ш', 'Ù' => 'Щ', 'Ç' => 'З', 'Õ' => 'Х', 'Ú' => 'Ъ', 'Ô' => 'Ф', 'Û' => 'Ы', 'Â' => 'В',  'À' => 'А', 'Ï' => 'П', 'Ð' => 'Р', 'Î' => 'О', 'Ë' => 'Л', 'Ä' => 'Д', 'Æ' => 'Ж', 'Ý' => 'Э', 'ß' => 'Я', '×' => 'Ч',  'Ñ' => 'С', 'Ì' => 'М', 'È' => 'И', 'Ò' => 'Т', 'Ü' => 'Ь', 'Á' => 'Б', 'Þ' => 'Ю', '¨' => 'Ё'
));
$text1 = substr($text,0,60);
$long_text = strlen($text);
$time11 = strtotime("$time");
$time11 = ($now - $time11);
?>
<?php
if (empty($row4)) {
$query = "delete from kontakts where user_id='$id1' and drug_id='$id2' or user_id='$id2' and drug_id='$id1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>

<div style="padding: 3px; border-bottom: 1px solid #4c4c4c;
border-top: 1px solid #333333;
border-left: 1px solid #636363;
border-right: 1px solid #474747;
">
<table class="dialog1"><tr>
<td class="dia" style="width: 20%; height: 80px;">
<a href="profile.php?id=<?php echo "$id2";?>" style="text-decoration: none;">
<div class="dialog">
<center>
<img style="width: 100%; height: 80px;" src="../img/ava/<?php echo "$avatar";?>.png"/>
</center>
</div>
</a>
</td>
<td class="dia" style="width: 60%; height: 80px;">
<a href="admin_check.php?id1=<?php echo "$id_mail";?>&id2=<?php echo "$id2";?>" style="text-decoration: none;">
<div class="dialog" style="height: 80px;">
<center>
<?php
if ($gruppa == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="../img/ico/on.png" width="12" height="12" alt="н"/><img src="../img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="../img/ico/off.png" width="12" height="12" alt="н"/><img src="../img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="../img/ico/on.png" width="12" height="12" alt="н"/><img src="../img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="../img/ico/off.png" width="12" height="12" alt="н"/><img src="../img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="../img/ico/on.png" width="12" height="12" alt="н"/><img src="../img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="../img/ico/off.png" width="12" height="12" alt="н"/><img src="../img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
if ($gruppa == 'mon') {if ($razn_last_act < 1800 ) {?><img src="../img/ico/on.png" width="12" height="12" alt="н"/><img src="../img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="../img/ico/off.png" width="12" height="12" alt="н"/><img src="../img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
?><?php echo "$nick";?> <?php 
if ($reading == '0' and $ot == $id1) {?><small><span class="red">(не прочитано)</span></small><?php }
if ($reading == '0' and $dlya == $id1) {?><small><span class="gold">(новое)</span> <span class="bonus">(+<?php echo "$test";?>)</span></small><?php }
?></center>
<p style="border-bottom: solid 1px #444e4f;"></p>
<div style="margin-left: 3px; padding: 2px;">
<?php if ($ot == $user_id) {?><span class="net">Я:</span><?php } else {?>
<?php if ($sex == 'male') {?><span class="bonus">Он:</span><?php } else {?><span class="bonus">Она:</span><?php }?>
<?php }?>
<small>
 <span class="white"> <?php if ($type == '1') {?><?php echo "$text1"; echo '...';?><?php } else {?><?php if ($type == '3') {?><?php if ($ot == '10033') {?><b>Банк игры</b><?php } else {?><u>Посылка</u><?php }?><?php } else {?><u>Посылка</u><?php }?><?php }?></span> 

(<?php
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
if ($time11 > '10367999' and $time11 < '12960000') {?>4мес.<?php }
if ($time11 > '12959999' and $time11 < '15552000') {?>5мес.<?php }
if ($time11 > '15551999' and $time11 < '18144000') {?>6мес.<?php }
if ($time11 > '18143999' and $time11 < '20736000') {?>7мес.<?php }
if ($time11 > '20735999' and $time11 < '23328000') {?>8мес.<?php }
if ($time11 > '23327999' and $time11 < '25920000') {?>9мес.<?php }
if ($time11 > '25919999' and $time11 < '28512000') {?>10мес.<?php }
if ($time11 > '28511999' and $time11 < '31104000') {?>11мес.<?php }
if ($time11 > '31103999' and $time11 < '62208000') {?>1год<?php }
if ($time11 > '62207999' and $time11 < '93312000') {?>2года<?php }
if ($time11 > '93311999' and $time11 < '186624000') {?>3года<?php }
if ($time11 > '186623999' and $time11 < '279936000') {?>4года<?php }
if ($time11 > '279935999' and $time11 < '373248000') {?>5лет<?php }
if ($time11 > '373248000') {?>более 5 лет<?php }
?>)
</small>
</div>
</div>
</a>
</td>
<td style="width: 20px; height: 80px;">
<a onclick="return confirm ('Уверены, что хотите удалить диалог?')" href="../del-mes.php?id=<?php echo "$id2";?>" style="text-decoration: none;">
<div class="dialog" style="height: 80px;">
<span style="padding: 26px; margin-left: 9px;">
<center><img src="../img/cross.png"/></center>
</span>
</div>
</a>
</td>
</tr>
</table>
</div>
<?php 
}
}
?>
</div>
<div style="border-left:1px solid #444e4f;border-right:1px solid #444e4f;">
<?php
require_once('navigaa.php');
?>
<p><a href="../mailbox.php" class="menu"><img src="../img/reload.gif" width="12" height="12" /> Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<?php



//////////////////////////////////////

require_once('../conf/navig.php');
require_once('../conf/foot.php');
?>
</body>
</html>