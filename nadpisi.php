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
$page_title = 'Надписи';
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
$nadpis1 = $row4['nadpis1'];
$nadpis2 = $row4['nadpis2'];
?>
<div id="main">
<div class="stats">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Надписи</p>
</div>
<?php
if (empty($tip)) {?>
<div class="stats">
<p class="podmenu">Надпись в профиле:</p>
<form enctype="multipart/form-data" method="post" action="nadpisi.php?tip=1">
<input type="text" value="<?php echo "$nadpis1";?>" style="width:150px; height:18px;" class="input" name="text" />
<input type="submit" style="width:50px;" class="input" value="ввести" name="addchat"/>
</form><br/>
<p class="podmenu">Слова нападающему:</p>
<form enctype="multipart/form-data" method="post" action="nadpisi.php?tip=2">
<input type="text" value="<?php echo "$nadpis2";?>" style="width:150px; height:18px;" class="input" name="text1" />
<input type="submit" style="width:50px;" class="input" value="ввести" name="addchat"/>
</form><br/>
</div>
<?php }
if ($tip == '1') {?>
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
$query = "update users set nadpis1='$text' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }
if ($tip == '2') {?>
<?php
$text1 = str_replace('<','&lt;', $text1);
$text1 = str_replace('>','&gt;', $text1);
$text1 = str_replace('"','&quot', $text1);
$text1 = stripslashes("$text1");
?>
<?php
$nadpis2 = str_replace('<','&lt;', $nadpis2);
$nadpis2 = str_replace('>','&gt;', $nadpis2);
$nadpis2 = str_replace('"','&quot', $nadpis2);
$nadpis2 = stripslashes("$nadpis2");
?>
<div class="stats">
<p class="bonus">Слова нападающему успешно изменены!</p>
<p class="bonus">Старая надпись: <span class="blue"><?php echo "$nadpis2";?></span></p>
<p class="bonus">Новая надпись: <span class="blue"><?php echo "$text1";?></span></p>
</div>
<?php
$query = "update users set nadpis2='$text1' where id = '$user_id' limit 1";
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