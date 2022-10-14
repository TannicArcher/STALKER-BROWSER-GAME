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
$page_title = 'Переписка';
require_once('../conf/head1.php');
require_once('../conf/top1.php');
//////////////////////////////////////
$link = $_GET['link'];
if ($link == 'true') {?>
<?php
$id1 = $_POST['id1'];
$id2 = $_POST['id2'];
?>

<script type="text/javascript">
  document.location.href = "admin_check.php?id1=<?php echo "$id1";?>&id2=<?php echo "$id2";?>";
</script>
<?php }

$id1 = $_GET['id1'];
$id2 = $_GET['id2'];
?>

<?php
if ((empty($id1)) or (empty($id2))) {?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<p><span class="bonus"><i><b>Просмотр переписки:</b></i></span></p>
<form enctype="multipart/form-data" method="post" action="admin_check.php?link=true">
<span class="white">
  <label for="id1">ID первого сталкера:</label><br />
  <input type="text" class="input" style="width: 90%;" value="" name="id1" /><br />
  <label for="id2">ID второго сталкера:</label><br />
  <input type="text" class="input" style="width: 90%;" value="" name="id2" /><br />

  <div class="knopka">
  <input type="submit" class="input" value="Готово" name="reg" />
  </div></b></span>
</form>
<?php } else {?>


<div class="ms-fon">
<?php
$user_id = $id1;
$drug_id = $id2;
$err = $_GET['err'];
$query_igr = "Select * from users where id='$drug_id' limit 1";
$result_igr = mysqli_query($dbc, $query_igr) or die ('Ошибка передачи запроса к БД47');
$row_igr = mysqli_fetch_array($result_igr);
$drug_id = $row_igr['id'];
if ($row_igr == 0 or $user_id == $drug_id) {
$drug_id = '10033';
} 


$query = "update users set location = 'mail' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query1 = "Select * from users where id='$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
$ajax_mail = 0;


$nick1 = $row1['nick'];
$admin = $row1['admin'];
$prem = $row1['premium'];
$query2 = "Select * from users where id='$drug_id' limit 1";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
$row2 = mysqli_fetch_array($result2);
$nick2 = $row2['nick'];
$id1 = $user_id;
$id2 = $drug_id;
?>
<?php
$query_list = "Select * from black_list where user_id='$id1' and black_id='$id2' limit 1";
$result_list = mysqli_query($dbc, $query_list) or die ('Ошибка передачи запроса к БД45');
$row_list = mysqli_fetch_array($result_list);
?>
<div id="main">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Переписка с <a href="../profile.php?id=<?php echo "$drug_id";?>"><?php echo "$nick2";?></a></p></center>
<div style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/bg.jpg) repeat;">
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript">
$(function() {
	$("#send").click(function(){
		var message = $("#message").val();				
		$.ajax({
			type: "POST",
			url: "../sendmessage3.php?id=<? echo $_GET['id'];?>",
			data: {"message": message},
			cache: false,						
			success: function(response){
				var messageResp = new Array(' ',' ','Ошибка доступа! (ЧС или бан)','Ошибка доступа! (ЧС или бан)');
				var resultStat = messageResp[Number(response)];
				if(response == 0){
					$("#message").val("");
				}
				$("#resp").text(resultStat).show().delay(1500).fadeOut(800);
				
			}
		});
		return false;
				
	});
});
</script>
<?php
if ($err == '' and $ban_p == '0') {?>
<center>
<?php
if ($ajax_mail != '1') {?>
<div class="r4"><br/>
<p class="red">Переписка доступна только для чтения.</p>
<br/>
</div>
<?php } else {?>
<form action="../sendMessage3.php?id=<?php echo "$id2";?>" method="post" name="form">
         <p>Сообщение:</p><br>
       <textarea name="message"style="width:98%; height:60px;" rows="5" cols="50" id="message"></textarea>
       </p>
       <input name="js" type="hidden" value="no" id="js">
       <p>
       <input name="button" type="submit" class="input" value="Отправить" id="send">
       </p>
</form>
<span id="resp"></span>
<?php }?>
</center>
<?php }
if ($err == '1') {?>
<p class="red">У вас недостаточно хабара. Стоимость одного сообщения - 1 хабара.</p>
<?php }
if ($err == '2' or $ban_p == '1') {?>
<p class="red">Ваша почта заблокирована.<br/>
Причина: <?php echo "$wtf1";?>.<br/>
Модератор: <a href="../user.php?id=<?php echo "$mod_id1";?>"><?php echo "$mn1";?></a>.<br/>
Разбан через: <?php
$time11 = $btp;
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
if ($err == '3') {?>
<p class="red">Вы занесли этого сталкера в черный список.</p>
<?php }
if ($err == '4') {?>
<p class="red">Вы находитесь в черном списке этого сталкера.</p>
<?php }
if ($err == '5') {?>
<p class="red">Вы участвуете в бое на арене (возможно, на вас напали).</p>
<?php }
?><br/>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
</div>
<center>
<a href="admin_check.php?id1=<?php echo "$id1";?>&id2=<?php echo "$id2";?>" class="menu2">
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
<img src="../img/icon-refresh.png" />
<p class="podmenu" style="border-top:1px dashed #444e4f;"></p>
</a></center>

<?php
if ($ajax_mail == '1') {?>

 <div id="content"></div> 


 <script>  
        function show()  
        {  
            $.ajax({  
                url: "../time.php?id1=<? echo $id1;?>&id2=<? echo "$id2";?>&page=<? echo $_GET['page'];?>",  
                cache: false,  
                success: function(html){  
                    $("#content").html(html);  
                }  
            });  
        }  
      
        $(document).ready(function(){  
            show();  
            setInterval('show()',1000);  
        });  
    </script>  

<?php } else {?>
<?php
$query_num = "Select message_id from message where ot='$id1' and dlya='$id2' or ot='$id2' and dlya='$id1'" ;
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
$text = strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />', '<img src="img/smiles/anomaliya.gif" />' => ':аномалия', '<img src="img/smiles/tost.gif" />' => ':тост', '<img src="img/tomato.gif"/>' => ':томат', '<img src="img/smiles/25_kiss.gif" />' => ':*', '<img src="img/smiles/D.gif" />' => ':D', '<img src="img/smiles/gun.gif" />' => ':ган', '<img src="img/smiles/gitara.gif" />' => ':гитара' , '<img src="img/smiles/09_bebe.gif" />' => ':-P', '<img src="img/smiles/rzhu.gif" />' => ':ржу', '<img src="img/smiles/fan.gif" />' => ':фан', '<img src="img/smiles/umora.gif" />' => ':умора', '<img src="img/smiles/rasta.gif" />' => ':раста', '<img src="img/smiles/facepalm.gif" />' => ':фэйспалм', '<img src="img/smiles/dovolen.gif" />' => ':доволен', '<img src="img/smiles/dovolen2.gif" />' => ':доволен2', '<img src="img/smiles/pirat.gif" />' => ':пират', '<img src="img/smiles/olen.gif" />' => ':олень', '<img src="img/smiles/smile.gif" />' => ':)', '<img src="img/smiles/sad.gif" />' => ':(', '<img src="img/smiles/zlo.gif" />' => ':зло', '<img src="img/smiles/xmm.gif" />' => ':хмм', '<img src="img/smiles/mail.gif" />' => ':пишу', '<img src="img/smiles/xaxa.gif" />' => ':хаха', '<img src="img/smiles/zhopa.gif" />' => ':жопа', '<img src="img/smiles/gg.gif" />' => ':гг', '<img src="img/smiles/letaet.gif" />' => ':летает', '<img src="img/smiles/vau.gif" />' => ':ого', '<img src="img/smiles/tiho.gif" />' => ':тихо', '<img src="img/smiles/smert.gif" />' => ':смерть', '<img src="img/smiles/poisk.gif" />' => ':поиск', '<img src="img/smiles/pizdec.gif" />' => ':накрыло', '<img src="img/smiles/oy.gif" />' => ':оу', '<img src="img/smiles/oops.gif" />' => ':упс', '<img src="img/smiles/nyam.gif" />' => ':ням', '<img src="img/smiles/nono.gif" />' => ':ноно', '<img src="img/smiles/no.gif" />' => ':нет', '<img src="img/smiles/ninja.gif" />' => ':ниндзя', '<img src="img/smiles/neznaju.gif" />' => ':незнаю', '<img src="img/smiles/nea.gif" />' => ':неа', '<img src="img/smiles/music.gif" />' => ':муз', '<img src="img/smiles/mister.gif" />' => ':мистер', '<img src="img/smiles/lamer.gif" />' => ':ламер', '<img src="img/smiles/kulak.gif" />' => ':кыш', '<img src="img/smiles/krut.gif" />' => ':крут', '<img src="img/smiles/klass.gif" />' => ':супер', '<img src="img/smiles/hello.gif" />' => ':пока', '<img src="img/smiles/fuck.gif" />' => ':фак', '<img src="img/smiles/flood.gif" />' => ':флуд', '<img src="img/smiles/fingal.gif" />' => ':фингал', '<img src="img/smiles/cold.gif" />' => ':холодно', '<img src="img/smiles/bomba.gif" />' => ':бомба', '<img src="img/smiles/blin.gif" />' => ':блин', '<img src="img/smiles/ban.gif" />' => ':бан', '<img src="img/smiles/crazy.gif" />' => ':идиот', '<img src="img/smiles/[.gif" />' => ':[', '<img src="img/smiles/bb.gif" />' => ':качок', '<img src="img/smiles/atlet.gif" />' => ':атлет', '<img src="img/smiles/aaa.gif" />' => ':ааа', '<img src="img/smiles/scare.gif" />' => ':испуг', '<img src="img/smiles/cray.gif" />' => ':плак' , '<img src="img/smiles/8.gif" />' => ':глаза' ));
$text = strtr($text, array('é' => 'й', 'ö' => 'ц', 'ó' => 'у', 'ê' => 'к', 'å' => 'е',  'í' => 'н', 'ã' => 'г', 'ø' => 'ш', 'ù' => 'щ', 'ç' => 'з', 'õ' => 'х', 'ú' => 'ъ', 'ô' => 'ф', 'û' => 'ы', 'â' => 'в',  'à' => 'а', 'ï' => 'п', 'ð' => 'р', 'î' => 'о', 'ë' => 'л', 'ä' => 'д', 'æ' => 'ж', 'ý' => 'э', 'ÿ' => 'я', '÷' => 'ч',  'ñ' => 'с', 'ì' => 'м', 'è' => 'и', 'ò' => 'т', 'ü' => 'ь', 'á' => 'б', 'þ' => 'ю', '¸' => 'ё',
'É' => 'Й', 'Ö' => 'Ц', 'Ó' => 'У', 'Ê' => 'К', 'Å' => 'Е',  'Í' => 'Н', 'Ã' => 'Г', 'Ø' => 'Ш', 'Ù' => 'Щ', 'Ç' => 'З', 'Õ' => 'Х', 'Ú' => 'Ъ', 'Ô' => 'Ф', 'Û' => 'Ы', 'Â' => 'В',  'À' => 'А', 'Ï' => 'П', 'Ð' => 'Р', 'Î' => 'О', 'Ë' => 'Л', 'Ä' => 'Д', 'Æ' => 'Ж', 'Ý' => 'Э', 'ß' => 'Я', '×' => 'Ч',  'Ñ' => 'С', 'Ì' => 'М', 'È' => 'И', 'Ò' => 'Т', 'Ü' => 'Ь', 'Á' => 'Б', 'Þ' => 'Ю', '¨' => 'Ё'
));

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
if ($ot == $id1) {?><a class="bonus" href="../profile.php?id=<?php echo "$id1";?>"><?php echo "$nick1";?></a><span class="bonus">:</span><br/><?php }
if ($ot == $id2) {?><a class="bonus" href="../profile.php?id=<?php echo "$id2";?>"><?php echo "$nick2";?></a><span class="bonus">:</span><br/><?php }
?> <span class="white"><?php
if ($type == '1') {?>
<?php echo "$text";?>
<?php }
if ($type == '2') {?>
<u>Посылка:</u> <?php echo "$text";?> <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="../mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=2">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?>
<?php }
if ($type == '3' and $ot != '10033') {?>
<u>Посылка:</u> <?php echo "$thing";?> <img src="../img/ico/money.png"/>RUB <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=3">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?><br/>
<?php }
if ($type == '3' and $ot == '10033') {?>
<b>Банк игры:</b><br/> <?php echo "$thing";?> <img src="../img/ico/money.png"/>RUB <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=3">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?><br/>
<i>Спасибо за покупку!</i><br/>
<?php }
if ($type == '4') {?>
<u>Посылка:</u> <?php echo "$thing";?> хабара <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="../mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=4">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?>
<?php }
if ($type == '5') {?>
<u>Посылка:</u> <?php echo "$thing";?> аптечек <?php if ($ot != $id1) {?><?php if ($in == '0') {?>[<a class="bonus" href="../mesthg.php?id=<?php echo "$thing";?>&id3=<?php echo "$m_id";?>&tip=5">забрать</a>]<?php } else {?>[уже забрано]<?php }?><?php } else {?><?php if ($in == '0') {?>[<span class="bonus">не забрано</span>]<?php } else {?>[забрано]<?php }?><?php }?>
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
<?php
require_once('navigaa.php');
?>
</div>

<?php }?>


</div>
<?php if ($admin == '1' or $prem == '1') {?>
<div style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/bg.jpg) repeat;">
<center>
	<p>Отправить RUB:</p>
    <form enctype="multipart/form-data" method="post" action="../sendmes.php?type=3&set_id=<?php echo "$id2"; ?>">
    <input type="text" class="input" name="money" style="width:75%;"/>
    <input type="submit" style="width:70px;" class="input" value="Отправить" name="send"/>
    </form>
</center><br/>
</div>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>
<?php }?>
<p><img src="../img/reload.gif" width="12" height="12" /> <a href="index.php?id1=<?php echo "$id1";?>">Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f;"></p>

<?php }?>


<?php



//////////////////////////////////////

require_once('../conf/navig.php');
require_once('../conf/foot.php');
?>
</body>
</html>