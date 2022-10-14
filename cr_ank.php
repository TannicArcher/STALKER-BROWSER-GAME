<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php";
  </script>
  <?php
  exit();
}
$page_title = 'Заполнение анкеты';
require_once('conf/head.php');
require_once('conf/top.php');

$user_id122 = $_SESSION['id'];
$query123 = "Select moder, admin, nick, sex from users where id = '$user_id122' limit 1";
$result123 = mysqli_query($dbc, $query123) or die ('Ошибка передачи запроса к БД');
$row123 = mysqli_fetch_array($result123);
$moder = $row123['moder'];
$admin = $row123['admin'];
$nick = $row123['nick'];
?>
<?php 
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
  header('Cache-Control: no-store, no-cache, must-revalidate'); 
  header('Cache-Control: post-check=0, pre-check=0', FALSE); 
  header('Pragma: no-cache'); 
?> 
<script>
function show_hide(id){
var item = document.getElementById(id);
if (item.style.display == 'none') {item.style.display = 'block';}
else item.style.display = 'none';
}
</script>


<div style="background-color: #1E1E1E; margin-top: 4px;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Ваша анкета:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div>
<div class="regf" style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/dlfon.gif) repeat;">
<center>
<?php
$name = $_POST['name'];
$family = $_POST['family'];
$city = $_POST['city'];
$nation = $_POST['nation'];
$history = $_POST['history'];
$vk = $_POST['vk'];
$spaces = $_POST['spaces'];
$day_bd = $_POST['bd1'];
$month_bd = $_POST['bd2'];
$age_bd = $_POST['bd3'];
$sex = $_POST['sex'];
$link = $_GET['link'];


  $ad = str_replace('<','&lt;', $name);
  $ad = str_replace('>','&gt;', $ad);
  $ad = str_replace('"','&quot', $ad);
  $ad = stripslashes("$ad");
$name = $ad;
  $ad1 = str_replace('<','&lt;', $family);
  $ad1 = str_replace('>','&gt;', $ad1);
  $ad1 = str_replace('"','&quot', $ad1);
  $ad1 = stripslashes("$ad1");
$family = $ad1;
  $ad2 = str_replace('<','&lt;', $city);
  $ad2 = str_replace('>','&gt;', $ad2);
  $ad2 = str_replace('"','&quot', $ad2);
  $ad2 = stripslashes("$ad2");
$city = $ad2;
  $ad3 = str_replace('<','&lt;', $nation);
  $ad3 = str_replace('>','&gt;', $ad3);
  $ad3 = str_replace('"','&quot', $ad3);
  $ad3 = stripslashes("$ad3");
$nation = $ad3;
 $ad4 = str_replace('<','&lt;', $history);
  $ad4 = str_replace('>','&gt;', $ad4);
  $ad4 = str_replace('"','&quot', $ad4);
  $ad4 = stripslashes("$ad4");
$history = $ad4;
 $ad5 = str_replace('<','&lt;', $vk);
  $ad5 = str_replace('>','&gt;', $ad5);
  $ad5 = str_replace('"','&quot', $ad5);
  $ad5 = stripslashes("$ad5");
$vk = $ad5;
 $ad5 = str_replace('<','&lt;', $day_bd);
  $ad5 = str_replace('>','&gt;', $ad5);
  $ad5 = str_replace('"','&quot', $ad5);
  $ad5 = stripslashes("$ad5");
$day_bd = $ad5;
 $ad5 = str_replace('<','&lt;', $month_bd);
  $ad5 = str_replace('>','&gt;', $ad5);
  $ad5 = str_replace('"','&quot', $ad5);
  $ad5 = stripslashes("$ad5");
$month_bd = $ad5;
 $ad5 = str_replace('<','&lt;', $age_bd);
  $ad5 = str_replace('>','&gt;', $ad5);
  $ad5 = str_replace('"','&quot', $ad5);
  $ad5 = stripslashes("$ad5");
$age_bd = $ad5;
 $ad5 = str_replace('<','&lt;', $spaces);
  $ad5 = str_replace('>','&gt;', $ad5);
  $ad5 = str_replace('"','&quot', $ad5);
  $ad5 = stripslashes("$ad5");
$spaces = $ad5;
?>

<div class="r3">
<?php
if ($link == 'true') {?>
<p style="color: green;">Анкета успешно изменена!</p>
<?php }
?>
</div>

<?php
$query_an = "Select * from anketa where user_id = '$user_id122' limit 1";
$result_an = mysqli_query($dbc, $query_an) or die ('Ошибка передачи запроса к БД');
$row_an = mysqli_fetch_array($result_an);
$name3 = $row_an['name'];
$family3 = $row_an['family'];
$city3 = $row_an['city'];
$foto3 = $row_an['photo'];
$nation3 = $row_an['nation'];
$history3 = $row_an['history'];
$vk3 = $row_an['vk'];
$spaces3 = $row_an['spaces'];
$day_bd3 = $row_an['day_bd'];
$month_bd3 = $row_an['month_bd'];
$age_bd3 = $row_an['age_bd'];
$sex3 = $row123['sex'];

if ($day_bd <> 0 and $day_bd < '32') {
$query = "update anketa set day_bd = '$day_bd' where user_id = '$user_id122' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$day_bd3 = $day_bd;
}
if ($month_bd <> 0 and $month_bd < '13') {
$query = "update anketa set month_bd = '$month_bd' where user_id = '$user_id122' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$month_bd3 = $month_bd;
}
if ($age_bd <> 0 and $age_bd < '2013' and $age_bd > '1969') {
$query = "update anketa set age_bd = '$age_bd' where user_id = '$user_id122' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$age_bd3 = $age_bd;
}
 if ($link == 'true') {
$query = "update users set sex='$sex' where id = '$user_id122' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}

if ($link == 'true' and $row_an < 1) {
$query_q = "insert into anketa (`user_id`, `name`, `family`, `city`, `nation`, `history`, `vk`, `spaces`) values ('$user_id122', '$name', '$family', '$city', '$nation', '$history', '$vk', '$spaces')";
$result_q = mysqli_query($dbc, $query_q) or die ('Ошибка передачи запроса к БД');
}
if ($link == 'true' and $row_an > 0) {
$query = "update anketa set name='$name', family='$family', city='$city', nation='$nation', history='$history', vk='$vk', spaces='$spaces' where user_id = '$user_id122' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>

<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Фото:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
<?php if (!empty($foto3)) {?>
<div class="r5" style="margin: -3px; color: #ffffff;">
<center><img src="img/foto/<?php echo "$foto3";?>.png" class="upl"/></center>
</div>
<?php } else {?>
<div class="r5" style="margin: -3px; color: #ffffff;">
<center><img src="img/foto/00.jpg" class="upl"/></center>
</div>
<?php }?>
Личное фото для анкеты абсолютно бесплатно и может меняться неограниченное количество раз.
<p style="border-top: 1px solid #444e4f;"></p>
<a href="javascript:show_hide('block')" class="menu">Сменить</a>
<div id="block" style="display:none">
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Правила загрузки:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
1. Формат картинки: jpg, jpeg или png.<br/>
2. Вес картинки не более 60кб.<br/>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Запрещено:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
1. Загружать фотографии порнографического характера.<br/>
2. Загружать фотографии с ругательными надписями или рекламой.<br/>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Внимание:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
Учтите, что если картинка будет превышать ограничение в 300x250 пикселей, то она будет сжата до ограничения.<br/><center>
<br/>
<p style="border-top:1px dashed #444e4f;"></p>
<form action="upload2.php" method="post"
enctype="multipart/form-data">
<label for="file">Файл:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Загрузить" />
</form></center>
<p style="border-top:1px dashed #444e4f;"></p><br/>
</div>

 <div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Остальные данные:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><br/>
  <div id="error">
<div class="r6">
<span w:id="navigation">
<div class="brunches-block">
<form enctype="multipart/form-data" method="post" action="cr_ank.php?link=true">
<span class="white">
  <label for="name">Имя:</label><br />
  <input type="text" class="input" style="width: 90%;" value="<?php echo "$name3";?>" name="name" /><br />
  <label for="family">Фамилия:</label><br />
  <input type="text" class="input" style="width: 90%;" value="<?php echo "$family3";?>" name="family" /><br />
    <label for="sex">Пол:</label><br />
 <select name="sex" class="input" style="width: 90%;" size="1">
   <option value="male" <? if ($_POST['sex'] == male) {?>selected="selected"<?php }?>>Мужской</option>
   <option value="imale" <? if ($_POST['sex'] == imale) {?>selected="selected"<?php }?>>Женский</option>
</select>
<label for="nation">Страна:</label><br />
  <input type="text" class="input" style="width: 90%;" value="<?php echo "$nation3";?>" name="nation" /><br />
  <label for="city">Город:</label><br />
  <input type="text" class="input" style="width: 90%;" value="<?php echo "$city3";?>" name="city" /><br />
 <label for="history">О себе:</label><br />
  <input type="text" class="input" style="width: 90%;" value="<?php echo "$history3";?>" name="history" /><br />
 <label for="vk">ID в вконтакте:</label><br />
  <input type="text" class="input" style="width: 90%;" placeholder="id1234567890"  value="<?php echo "$vk3";?>" name="vk" /><br />
 <label for="spaces">Логин в spaces:</label><br />
  <input type="text" class="input" style="width: 90%;" placeholder="qwerty11"  value="<?php echo "$spaces3";?>" name="spaces" /><br />

<label for="birdthay">Дата рождения:</label><br />
<?php if ((!empty($month_bd3)) and (empty($day_bd3))) {?>
 <select name="bd1" class="input" style="width: 30%;" size="1">
   <option value="" <? if ($_POST['bd1'] == '') {?>selected="selected"<?php }?>>День</option>
   <option value="1" <? if ($_POST['bd1'] == 1) {?>selected="selected"<?php }?>>1</option>
   <option value="2" <? if ($_POST['bd1'] == 2) {?>selected="selected"<?php }?>>2</option>
   <option value="3" <? if ($_POST['bd1'] == 3) {?>selected="selected"<?php }?>>3</option>
   <option value="4" <? if ($_POST['bd1'] == 4) {?>selected="selected"<?php }?>>4</option>
   <option value="5" <? if ($_POST['bd1'] == 5) {?>selected="selected"<?php }?>>5</option>
   <option value="6" <? if ($_POST['bd1'] == 6) {?>selected="selected"<?php }?>>6</option>
   <option value="7" <? if ($_POST['bd1'] == 7) {?>selected="selected"<?php }?>>7</option>
   <option value="8" <? if ($_POST['bd1'] == 8) {?>selected="selected"<?php }?>>8</option>
   <option value="9" <? if ($_POST['bd1'] == 9) {?>selected="selected"<?php }?>>9</option>
   <option value="10" <? if ($_POST['bd1'] == 10) {?>selected="selected"<?php }?>>10</option>
   <option value="11" <? if ($_POST['bd1'] == 11) {?>selected="selected"<?php }?>>11</option>
   <option value="12" <? if ($_POST['bd1'] == 12) {?>selected="selected"<?php }?>>12</option>
   <option value="13" <? if ($_POST['bd1'] == 13) {?>selected="selected"<?php }?>>13</option>
   <option value="14" <? if ($_POST['bd1'] == 14) {?>selected="selected"<?php }?>>14</option>
   <option value="15" <? if ($_POST['bd1'] == 15) {?>selected="selected"<?php }?>>15</option>
   <option value="16" <? if ($_POST['bd1'] == 16) {?>selected="selected"<?php }?>>16</option>
   <option value="17" <? if ($_POST['bd1'] == 17) {?>selected="selected"<?php }?>>17</option>
   <option value="18" <? if ($_POST['bd1'] == 18) {?>selected="selected"<?php }?>>18</option>
   <option value="19" <? if ($_POST['bd1'] == 19) {?>selected="selected"<?php }?>>19</option>
   <option value="20" <? if ($_POST['bd1'] == 20) {?>selected="selected"<?php }?>>20</option>
   <option value="21" <? if ($_POST['bd1'] == 21) {?>selected="selected"<?php }?>>21</option>
   <option value="22" <? if ($_POST['bd1'] == 22) {?>selected="selected"<?php }?>>22</option>
   <option value="23" <? if ($_POST['bd1'] == 23) {?>selected="selected"<?php }?>>23</option>
   <option value="24" <? if ($_POST['bd1'] == 24) {?>selected="selected"<?php }?>>24</option>
   <option value="25" <? if ($_POST['bd1'] == 25) {?>selected="selected"<?php }?>>25</option>
   <option value="26" <? if ($_POST['bd1'] == 26) {?>selected="selected"<?php }?>>26</option>
   <option value="27" <? if ($_POST['bd1'] == 27) {?>selected="selected"<?php }?>>27</option>
   <option value="28" <? if ($_POST['bd1'] == 28) {?>selected="selected"<?php }?>>28</option>
<?php if ($month_bd3 != '2') {?>
   <option value="29" <? if ($_POST['bd1'] == 29) {?>selected="selected"<?php }?>>29</option>
   <option value="30" <? if ($_POST['bd1'] == 30) {?>selected="selected"<?php }?>>30</option>
<?php if ($month_bd3 != '4' and $month_bd3 != '6' and $month_bd3 != '9' and $month_bd3 != '11') {?>
   <option value="31" <? if ($_POST['bd1'] == 31) {?>selected="selected"<?php }?>>31</option>
<?php }?>
<?php }?>
</select>
<?php }?>
<?php if (empty($month_bd3)) {?>
 <select name="bd2" class="input" style="width: 30%;" size="1">
   <option value="" <? if ($_POST['bd2'] == '') {?>selected="selected"<?php }?>>Месяц</option>
   <option value="1" <? if ($_POST['bd2'] == 1) {?>selected="selected"<?php }?>>Январь</option>
   <option value="2" <? if ($_POST['bd2'] == 2) {?>selected="selected"<?php }?>>Февраль</option>
   <option value="3" <? if ($_POST['bd2'] == 3) {?>selected="selected"<?php }?>>Март</option>
   <option value="4" <? if ($_POST['bd2'] == 4) {?>selected="selected"<?php }?>>Апрель</option>
   <option value="5" <? if ($_POST['bd2'] == 5) {?>selected="selected"<?php }?>>Май</option>
   <option value="6" <? if ($_POST['bd2'] == 6) {?>selected="selected"<?php }?>>Июнь</option>
   <option value="7" <? if ($_POST['bd2'] == 7) {?>selected="selected"<?php }?>>Июль</option>
   <option value="8" <? if ($_POST['bd2'] == 8) {?>selected="selected"<?php }?>>Август</option>
   <option value="9" <? if ($_POST['bd2'] == 9) {?>selected="selected"<?php }?>>Сентябрь</option>
   <option value="10" <? if ($_POST['bd2'] == 10) {?>selected="selected"<?php }?>>Октябрь</option>
   <option value="11" <? if ($_POST['bd2'] == 11) {?>selected="selected"<?php }?>>Ноябрь</option>
   <option value="12" <? if ($_POST['bd2'] == 12) {?>selected="selected"<?php }?>>Декабрь</option>
</select>
<?php }?>

<input type="text" class="input" style="width: 30%;" placeholder="1970" value="<?php echo "$age_bd3";?>" name="bd3" /><br />
 

  <div class="knopka">
  <input type="submit" class="input" value="Сохранить" name="reg" />
  </div></b></span>
</form>
</div>
</span>
</div>
</center>


</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>