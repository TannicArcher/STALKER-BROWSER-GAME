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
$page_title = 'Управление отрядом';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$tip = $_GET['tip'];
$text = $_POST['text'];
$text1 = $_POST['text1'];
$query4 = "Select * from users where id='$user_id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row4 = mysqli_fetch_array($result4);
$rang_out = $row4['clan_rang'];
$clan = $row4['clan'];
$nick_out = $row4['nick'];
$ad = $_POST['ad'];
$ad = mysqli_real_escape_string($dbc, trim($ad));
$ad = str_replace('<','&lt;', $ad);
$ad = str_replace('>','&gt;', $ad);
$ad = str_replace('"','&quot', $ad);
$ad = stripslashes("$ad");
$query41 = "Select * from clans where clan_id='$clan' limit 1";
$result41 = mysqli_query($dbc, $query41) or die ('Ошибка передачи запроса к БД');
$row41 = mysqli_fetch_array($result41);
$nadpis1 = $row41['nadpis'];
?>
<?php if ($rang_out < '5' or $clan == '0') {?>
<script type="text/javascript">
  document.location.href = "clan.php";
</script>
<?php
exit();
}
?>
<div id="main">
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Управление отрядом</p></center>
<?php if (empty($tip)) {?>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Новое объявление:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div>
Ввести:
<form enctype="multipart/form-data" method="post" action="ccs.php?tip=1">
<input type="text" class="input" style="width: 80%;" name="ad" value="<?php echo "$ad"; ?>" />
<input type="submit" style="width:60px;" class="input" value="+" name="addad"/>
</form><br/>
<?php if ($rang_out > '7') {?>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Надпись отряда:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div>
Ввести:
<form enctype="multipart/form-data" method="post" action="ccs.php?tip=3">
<input type="text" value="<?php echo "$nadpis1";?>" class="input" style="width: 80%;" name="text" />
<input type="submit" style="width:60px;" class="input" value="+" name="addchat"/>
</form><br/>
<?php }?>
<?php
if ($rang_out > '8') {?>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Переименовать отряда:</b> <span class="red">(5000 RUB)</span></center>
<p style="border-top:1px solid #444e4f;"></p>
</div>
Ввести:
<form enctype="multipart/form-data" method="post" action="title_clan.php?c_id=<?php echo "$clan_id";?>">
<input type="text" class="input" style="width: 80%;" name="c_name" />
<input type="submit" style="width:60px;" class="input" value="ввести" name="addchat"/>
</form><br/>
<?php }?>
<?php if ($rang_out > '7') {?>
<p style="border-top:1px solid #444e4f;"></p>
<a href="monster_out.php" class="menu">Отменить клановые рейды</a>
<p style="border-top:1px solid #444e4f;"></p>
<?php }?>
<?php }?>
<?php
if ($tip == '1') {?>
<?php
$query_num = "update clans set ad = '$ad', ad_nick = '$nick_out' where clan_id = '$clan'";
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$query_read = "update users set read_ad = '1' where clan = '$clan'";
$result_read = mysqli_query($dbc, $query_read) or die ('Ошибка передачи запроса к БД');
?>
<div class="stats">
<p class="bonus">Объявление успешно создано!</p>
</div>
<?php }
if ($tip == '2') {?>
<div class="stats">
<p class="bonus">Отряд успешно переименован!</p>
</div>
<?php }
if ($tip == '3' and $rang_out > '7') {?>
<?php
$text = str_replace('<','&lt;', $text);
$text = str_replace('>','&gt;', $text);
$text = str_replace('"','&quot', $text);
$text = stripslashes("$text");
?>
<?php
$nadpis1 = str_replace('<','&lt;', $nadpis1);
$nadpis1 = str_replace('>','&gt;', $nadpis1);
$nadpis1 = str_replace('"','&quot', $nadpis1);
$nadpis1 = stripslashes("$nadpis1");
?>
<div class="stats">
<p class="bonus">Надпись успешно изменена!</p>
<p class="bonus">Старая надпись: <span class="blue"><?php echo "$nadpis1";?></span></p>
<p class="bonus">Новая надпись: <span class="blue"><?php echo "$text";?></span></p>
</div>
<?php
$query = "update clans set nadpis='$text' where clan_id = '$clan' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
?>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>