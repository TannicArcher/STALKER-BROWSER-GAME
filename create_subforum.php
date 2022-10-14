<?php
//*******************************************************************//
//**///////////////////////Автор: Андрей Наумов////////////////////**//
//**//////Двиг был написан мною и никаких соавторов не имеется/////**//
//**////////////////////////VK: vk.com/linux8//////////////////////**//
//**/////Устроюсь как на временную, так и на постоянную работу/////**//
//**//////////Знаю: Php, MySQL, CSS, xhtml, photoshop//////////////**//
//**/////Цена договорная, зависит от сложности и объёма работы/////**//
//**///////////////////////////////////////////////////////////////**//
//**////////////Спасибо за использование моего движка//////////////**//
//**/////Буду рад радовать вас новыми и интересными движками///////**//
//*******************************************************************//

require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) and (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
}
$H=getenv("HTTP_REFERER");
if (empty($H)) {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
$user_id = $_SESSION['id'];
$query_user = "Select clan, clan_rang, gruppa from users where id='$user_id' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
$row_user = mysqli_fetch_array($result_user);
$clan_us = $row_user['clan'];
$clan_rang_us = $row_user['clan_rang'];
$gruppa_us = $row_user['gruppa'];
if ($clan_rang_us < 6 or $clan_us == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "error.php?err=2";
  </script>
  <?php
  exit();
}
$create = $_POST['create'];
if (isset($create)) {
  $cr = 1;
  $name = $_POST['name'];
  $read = $_POST['read'];
  $com = $_POST['com'];
  $cre = $_POST['cre'];
  $long_name = strlen($name);
  if (($long_name<2) or ($long_name>32)) {
    $err = 1;
	$cr = 0;
  }
  if ($read>10 or $read<0) {
    $cr = 0;
  }
  if ($com>10 or $com<0) {
    $cr = 0;
  }
  if ($cre>10 or $cre<0) {
    $cr = 0;
  }
  if ($cr == 1) {
    $name = str_replace('<','&lt;', $name);
    $name = str_replace('>','&gt;', $name);
    $name = str_replace('"','&quot', $name);
    $name=stripslashes("$name");
    $name =  mysqli_real_escape_string($dbc, trim($name));
	$read =  mysqli_real_escape_string($dbc, trim($read));
	$com =  mysqli_real_escape_string($dbc, trim($com));
	$cre =  mysqli_real_escape_string($dbc, trim($cre));
    $query_cr = "insert into subforums (`name_subf`, `clan`, `rangs_read`, `rangs_com`, `rangs_cre`, `gruppa`) values ('$name', '$clan_us', '$read', '$com', '$cre', '$gruppa_us')";
	$result_cr = mysqli_query($dbc, $query_cr) or die ('Ошибка передачи запроса к БД');
	$query_cr = "select id_subf from subforums where name_subf='$name' and clan = '$clan_us' and rangs_read='$read' and rangs_com='$com' and rangs_cre='$cre' and gruppa='$gruppa_us' limit 1";
	$result_cr = mysqli_query($dbc, $query_cr) or die ('Ошибка передачи запроса к БД');
	$row_cr = mysqli_fetch_array($result_cr);
	$id_subf = $row_cr['id_subf'];
	?>
    <script type="text/javascript">
    document.location.href = "subforum.php?subforum=<?php echo "$id_subf";?>";
    </script>
    <?php
    exit();
  }
}
$page_title = 'Создать раздел';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<div class="main">
<?php
if ($err == 1) {?><p id="error">Название должно быть в пределах от 2 до 32 символов</p><?php }
?>
<div class="stats">
<p>Название раздела:</p>
<form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
<input type="text" style="height:13px; width:230px;" class="input" name="name" /><br />
<label for="read">Могут читать:</label><br />
<select name="read" class="input" size="1">
<option value="0" <? if ($_POST['read'] == 0) {?>selected="selected"<?php }?> >Гость</option>
<option value="1" <? if ($_POST['read'] == 1) {?>selected="selected"<?php }?> >Рекрут</option>
<option value="2" <? if ($_POST['read'] == 2) {?>selected="selected"<?php }?>>Рядовой</option>
<option value="3" <? if ($_POST['read'] == 3) {?>selected="selected"<?php }?>>Сержант</option>
<option value="4" <? if ($_POST['read'] == 4) {?>selected="selected"<?php }?>>Лейтенант</option>
<option value="5" <? if ($_POST['read'] == 5) {?>selected="selected"<?php }?>>Капитан</option>
<option value="6" <? if ($_POST['read'] == 6) {?>selected="selected"<?php }?>>Майор</option>
<option value="7" <? if ($_POST['read'] == 7) {?>selected="selected"<?php }?>>Полковник</option>
<option value="8" <? if ($_POST['read'] == 8) {?>selected="selected"<?php }?>>Генерал</option>
<option value="9" <? if ($_POST['read'] == 9) {?>selected="selected"<?php }?>>Лидер</option>
</select><br />
<label for="com">Могут комментировать:</label><br />
<select name="com" class="input" size="1">
<option value="0" <? if ($_POST['com'] == 0) {?>selected="selected"<?php }?> >Гость</option>
<option value="1" <? if ($_POST['com'] == 1) {?>selected="selected"<?php }?> >Рекрут</option>
<option value="2" <? if ($_POST['com'] == 2) {?>selected="selected"<?php }?>>Рядовой</option>
<option value="3" <? if ($_POST['com'] == 3) {?>selected="selected"<?php }?>>Сержант</option>
<option value="4" <? if ($_POST['com'] == 4) {?>selected="selected"<?php }?>>Лейтенант</option>
<option value="5" <? if ($_POST['com'] == 5) {?>selected="selected"<?php }?>>Капитан</option>
<option value="6" <? if ($_POST['com'] == 6) {?>selected="selected"<?php }?>>Майор</option>
<option value="7" <? if ($_POST['com'] == 7) {?>selected="selected"<?php }?>>Полковник</option>
<option value="8" <? if ($_POST['com'] == 8) {?>selected="selected"<?php }?>>Генерал</option>
<option value="9" <? if ($_POST['com'] == 9) {?>selected="selected"<?php }?>>Лидер</option>
</select><br />
<label for="cre">Могут создавать топики:</label><br />
<select name="cre" class="input" size="1">
<option value="0" <? if ($_POST['cre'] == 0) {?>selected="selected"<?php }?> >Гость</option>
<option value="1" <? if ($_POST['cre'] == 1) {?>selected="selected"<?php }?> >Рекрут</option>
<option value="2" <? if ($_POST['cre'] == 2) {?>selected="selected"<?php }?>>Рядовой</option>
<option value="3" <? if ($_POST['cre'] == 3) {?>selected="selected"<?php }?>>Сержант</option>
<option value="4" <? if ($_POST['cre'] == 4) {?>selected="selected"<?php }?>>Лейтенант</option>
<option value="5" <? if ($_POST['cre'] == 5) {?>selected="selected"<?php }?>>Капитан</option>
<option value="6" <? if ($_POST['cre'] == 6) {?>selected="selected"<?php }?>>Майор</option>
<option value="7" <? if ($_POST['cre'] == 7) {?>selected="selected"<?php }?>>Полковник</option>
<option value="8" <? if ($_POST['cre'] == 8) {?>selected="selected"<?php }?>>Генерал</option>
<option value="9" <? if ($_POST['cre'] == 9) {?>selected="selected"<?php }?>>Лидер</option>
</select><br />
<div class="knopka">
<input type="submit" class="input" value="Создать" name="create"/>
</div>
</form>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php'); 
mysqli_close($dbc);
?>