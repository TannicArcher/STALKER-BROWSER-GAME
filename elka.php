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
$page_title = 'Дядька Яр';
require_once('conf/head.php');
require_once('conf/top.php');
exit();
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query_num = "Select id from users where invite= '$user_id'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result_num);
?>
<?php
$t = $_GET['t'];
$query4 = "Select * from users where id='$user_id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row4 = mysqli_fetch_array($result4);
$lvl = $row4['lvl'];
$bon_time = $row4['bon_time'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_bon = strtotime("$bon_time");
$time_bonu = ($time_bon + '3600');
$time_bonus = ($time_bonu - $now);
$luck = 2;
$money = ($lvl * $total);
if ($money > '1000') {
$money = 1000;
}
?>

<div id="main">
<div class="stats">
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Дядька Яр</p>
</div>
<div class="stats">
<img src="img/Yar.png" alt="Яр"/>
<div style="background-color: #1E1E1E;">
<p class="white">Чем больше сталкеров в Скадовске, тем безопаснее в нём находиться. За каждого сталкера, которого ты пригласишь на нашу станцию, я буду давать тебе деньги.</p>
<p style="border-top: 1px solid #444e4f;"></p>
<p style="color: orange;">Каждый час ты будешь получать: <span class="white"><small><img src="img/ico/money.png"/><?php echo "$money";?> RUB.</small></span></p>
<p style="color: orange;">Приглашено рефералов: <span class="white"><small><img src="img/ico/chel.png" width="12"/><?php echo "$total";?> сталкеров.</small></span></p>
<p style="border-top: 1px solid #444e4f;"></p>
</div>


<?php if ($lvl < '15') {?>
<?php
echo "Ты слишком неопытный. Приходи когда поднимешься до 15 уровня.";
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
<?php if ($total < '1') {?>
<?php
echo "Сначала пригласи хоть одного друга.";
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
<?php if ($t == 'true' and $time_bonus < '1' and $lvl > '14') {
$query = "update users set bon_time = NOW(), money=money+'$money' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>


<?php if ($time_bonus < '1' and $lvl > '100') {?><br/>
<a href="elka.php"><img src="img/ico/bonn.png" width="30" height="30" alt="Подарок"/></a>
<?php }?>
</div></center>
<?php if ($time_bonus > '0' and $t == 'true') {?>
<?php
echo "Не торопись. Твоё время ещё не пришло.";
?>
<div class="stats">
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
exit();
?>
<?php }?>

<?php if ($t == 'true') {?>
<?php if ($luck == '1') {?><font color="#ff9f9f">В</font><font color="#ffbf9f">а</font><font color="#ffdf9f">м</font> <font color="#ffff9f">у</font><font color="#e7ff9f">л</font><font color="#cfff9f">ы</font><font color="#b7ff9f">б</font><font color="#9fff9f">н</font><font color="#9fffbf">у</font><font color="#9fffdf">л</font><font color="#9fffff">а</font><font color="#9fe7ff">с</font><font color="#9fcfff">ь</font> <font color="#9fb7ff">у</font><font color="#9f9fff">д</font><font color="#b79fff">а</font><font color="#cf9fff">ч</font><font color="#e79fff">а</font><font color="#ff9fff">!</font><?php }?> <span class="bonus">Держи свои <?php echo "$money";?> <img src="img/ico/money.png" alt="RUB"/>RUB.</span>
<?php } else {?>
<?php if ($time_bonus < '1') {?>
<a href="elka.php?t=true" class="menu" style="color: green"><img src="img/ico/harvest.png" width="12" height="15" alt="Подарок"/> Взять деньги</a>
<?php } else {?><center>Взять деньги можно будет через <?php if ($time_bonus > '60') {?><?php $time1 = ($time_bonus / '60'); $time1 = round("$time1"); echo "$time1 минут";?><?php } else {?><?php echo "$time_bonus";?> секунд<?php }?></center><?php }?>
<?php }?>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>