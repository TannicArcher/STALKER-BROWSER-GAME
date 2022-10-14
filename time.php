<?php
$dbc = mysqli_connect ('sql112.epizy.com', 'epiz_31567044', 'l8iJvfOQAP', 'epiz_31567044_stalker') or die ('Ошибка соединения с БД lol');
mysqli_set_charset($dbc, 'utf8');
?>

<?php
$page = $_GET['page'];
$id1 = $_GET['id1'];
$id2 = $_GET['id2'];
$user_id = $id1;
$drug_id = $id2;


$query = "Select * from users where id='$id1' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$device = $row['device'];
$nick1 = $row['nick'];

$query = "Select * from users where id='$id2' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$nick2 = $row['nick'];
?>

<?php
$query_num = "Select message_id from message where ot='$id1' and dlya='$id2' or ot='$id2' and dlya='$id1'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД11');
$total5 = mysqli_num_rows($result_num); 


$query_num = "Select message_id from message where ot='$drug_id' and dlya='$user_id' and reading='0' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6r = mysqli_num_rows($result_num);
?>


<?php if ($total6r <> '0' and $device == '2') {?>
<audio autoplay>
  <source src="http://stalkeronlinegame.epizy.com/stalker_sms1.wav" type="audio/wav">
</audio>
<?php }?>


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
$query_sub = "Select * from message where ot='$id1' and dlya='$id2' or ot='$id2' and dlya='$id1' order by time desc limit $skip, $result_per_page";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД333');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$m_id = $row_sub['message_id'];
$reading = $row_sub['reading'];
$text = $row_sub['text'];
$ot = $row_sub['ot'];
$dlya = $row_sub['ot'];
$time = $row_sub['time'];
$type = $row_sub['type'];
$thing = $row_sub['thing'];
$in = $row_sub['in'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time = $row_sub['time'];
$loto_time = strtotime("$loto_time");
$time11 = ($now - $loto_time);
$text = strtr($text, array('é' => 'й', 'ö' => 'ц', 'ó' => 'у', 'ê' => 'к', 'å' => 'е',  'í' => 'н', 'ã' => 'г', 'ø' => 'ш', 'ù' => 'щ', 'ç' => 'з', 'õ' => 'х', 'ú' => 'ъ', 'ô' => 'ф', 'û' => 'ы', 'â' => 'в',  'à' => 'а', 'ï' => 'п', 'ð' => 'р', 'î' => 'о', 'ë' => 'л', 'ä' => 'д', 'æ' => 'ж', 'ý' => 'э', 'ÿ' => 'я', '÷' => 'ч',  'ñ' => 'с', 'ì' => 'м', 'è' => 'и', 'ò' => 'т', 'ü' => 'ь', 'á' => 'б', 'þ' => 'ю', '¸' => 'ё',
'É' => 'Й', 'Ö' => 'Ц', 'Ó' => 'У', 'Ê' => 'К', 'Å' => 'Е',  'Í' => 'Н', 'Ã' => 'Г', 'Ø' => 'Ш', 'Ù' => 'Щ', 'Ç' => 'З', 'Õ' => 'Х', 'Ú' => 'Ъ', 'Ô' => 'Ф', 'Û' => 'Ы', 'Â' => 'В',  'À' => 'А', 'Ï' => 'П', 'Ð' => 'Р', 'Î' => 'О', 'Ë' => 'Л', 'Ä' => 'Д', 'Æ' => 'Ж', 'Ý' => 'Э', 'ß' => 'Я', '×' => 'Ч',  'Ñ' => 'С', 'Ì' => 'М', 'È' => 'И', 'Ò' => 'Т', 'Ü' => 'Ь', 'Á' => 'Б', 'Þ' => 'Ю', '¨' => 'Ё'
));
$text = strtr($text, array('<?' => '<!--', '?>' => '--!>'));
require_once('inc_smiles.php');
?>

<?php
$query_num = "Select message_id from message where ot='$drug_id' and dlya='$user_id' and reading='0' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6 = mysqli_num_rows($result_num);
$query = "update users set message=message-'$total6' where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query = "update message set reading='1' where ot='$id2' and dlya='$id1' and reading='0' limit $total6 ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');

$query = "Select * from users where id='$id1' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row_mns = mysqli_fetch_array($result);
if ($row_mns['message'] < '0') {
$query = "update users set message=0 where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>

<?php
if ($ot == $id1) {?>
<div class='q1_1' style="float: right; margin-right: 30px;"></div>
<?php } else {?>
<div class='q1'></div>
<?php }?>

<?php if ($reading == '0') {?>
<div class='q3' style="clear: right;">
<?php } else {?>
<div class='q2' style="clear: right;">
<?php }?>

<p><?php 
if ($ot == $id1) {?><a class="bonus" href="profile.php?id=<?php echo "$id1";?>"><?php echo "$nick1";?></a><span class="bonus">:</span><br/><?php }
if ($ot == $id2) {?><a class="bonus" href="profile.php?id=<?php echo "$id2";?>"><?php echo "$nick2";?></a><span class="bonus">:</span><br/><?php }
?> <span class="white"><?php
if ($type == '1') {?>
<?php echo "$text";?>
<?php }
if ($type == '2') {?>
<u>Посылка:</u> <?php echo "$text";?> <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=2">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?>
<?php }
if ($type == '3' and $ot != '10033') {?>
<u>Посылка:</u> <?php echo "$thing";?> <img src="img/ico/money.png"/>RUB <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=3">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?><br/>
<?php }
if ($type == '3' and $ot == '10033') {?>
<b>Банк игры:</b><br/> <?php echo "$thing";?> <img src="img/ico/money.png"/>RUB <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=3">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?><br/>
<i>Спасибо за покупку!</i><br/>
<?php }
if ($type == '4') {?>
<u>Посылка:</u> <?php echo "$thing";?> хабара <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=4">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?>
<?php }
if ($type == '5') {?>
<u>Посылка:</u> <?php echo "$thing";?> аптечек <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=5">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?>
<?php }
?></span><br/>
 <?php
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
if ($time11 > '373248000') {?>более 5 <?php }
?>
</p>
</div>
<?php 
}
}
?>
<center><?php
	  $phpself = 'mail4.php';
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself". '?id=' .$drug_id.  '&page=1"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself". '?id=' .$drug_id.  '&page=' . ($cur_page-1) . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself". '?id=' .$drug_id.  '&page=' . ($cur_page-3)?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself". '?id=' .$drug_id.  '&page=' . ($cur_page-2)?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself". '?id=' .$drug_id.  '&page=' . ($cur_page-1)?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself". '?id=' .$drug_id.  '&page=' . ($cur_page+1)?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself". '?id=' .$drug_id.  '&page=' . ($cur_page+2)?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself". '?id=' .$drug_id.  '&page=' . ($cur_page+3)?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?id=' .$drug_id.  '&page=' . ($cur_page+1) . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" . '?id=' .$drug_id.  '&page=' . $num_page . '">>></a> ';
    }
	else {
	  echo ' >>';
	}
?></center>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
</div>
