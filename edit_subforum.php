<?php
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
$subforum = $_GET['subforum'];
if (empty($subforum)) {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit(); 
}
/////////////Указали subforum
$user_id = $_SESSION['id'];
$query= "Select clan, rangs_cre, rangs_read, rangs_com, main, gruppa, name_subf from subforums where id_subf='$subforum' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
if (empty($row)) {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit(); 
}

$user_id = $_SESSION['id'];
//////////////SUBFORUM ТОЧНО СУЩЕСТВУЕТ
$query_user = "Select clan, clan_rang, gruppa, f_ban, lvl from users where id='$user_id' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
$row_user = mysqli_fetch_array($result_user);
if ($row['main'] == 0) {
if ($row['clan'] == $row_user['clan']) {/////////Если это клан юзера
    if ($row['rangs_cre'] > $row_user['clan_rang']) {////////Если ранг не позволяет.
	  ?>
      <script type="text/javascript">
      document.location.href = "subforum.php?subforum=<?php echo "$subforum";?>";
      </script>
      <?php
      exit(); 
	} 
  }
  else {////////Если это клан НЕ ЮЗЕРА
    ?>
    <script type="text/javascript">
    document.location.href = "subforum.php?subforum=<?php echo "$subforum";?>";
    </script>
    <?php
    exit(); 
  }
}
else {
  ?>
  <script type="text/javascript">
  document.location.href = "subforum.php?subforum=<?php echo "$subforum";?>";
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
    $query_cr = "update subforums set name_subf='$name', rangs_read='$read', rangs_cre = '$cre', rangs_com = '$com' where id_subf='$subforum'";
	$result_cr = mysqli_query($dbc, $query_cr) or die ('Ошибка передачи запроса к БД');
	?>
    <script type="text/javascript">
    document.location.href = "subforum.php?subforum=<?php echo "$subforum";?>";
    </script>
    <?php
    exit();
  }
}
$page_title = 'Изменить раздел';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<div class="main">
<?php
if ($err == 1) {?><p id="error">Название должно быть в пределах от 2 до 32 символов</p><?php }
?>
<div class="stats">
<p class="podmenu">Изменить раздел "<?php echo $row['name_subf'];?>"</p>
<p>Название раздела:</p>
<form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
<input type="text" value="<?php echo $row['name_subf'];?>" style="height:13px; width:230px;" class="input" name="name" /><br />
<label for="read">Могут читать:</label><br />
<select name="read" class="input" size="1">
<option value="0" <? if ($row['rangs_read'] == 0) {?>selected="selected"<?php }?> >Гость</option>
<option value="1" <? if ($row['rangs_read'] == 1) {?>selected="selected"<?php }?> >Рекрут</option>
<option value="2" <? if ($row['rangs_read'] == 2) {?>selected="selected"<?php }?>>Рядовой</option>
<option value="3" <? if ($row['rangs_read'] == 3) {?>selected="selected"<?php }?>>Сержант</option>
<option value="4" <? if ($row['rangs_read'] == 4) {?>selected="selected"<?php }?>>Лейтенант</option>
<option value="5" <? if ($row['rangs_read'] == 5) {?>selected="selected"<?php }?>>Капитан</option>
<option value="6" <? if ($row['rangs_read'] == 6) {?>selected="selected"<?php }?>>Майор</option>
<option value="7" <? if ($row['rangs_read'] == 7) {?>selected="selected"<?php }?>>Полковник</option>
<option value="8" <? if ($row['rangs_read'] == 8) {?>selected="selected"<?php }?>>Генерал</option>
<option value="9" <? if ($row['rangs_read'] == 9) {?>selected="selected"<?php }?>>Лидер</option>
</select><br />
<label for="com">Могут комментировать:</label><br />
<select name="com" class="input" size="1">
<option value="0" <? if ($row['rangs_com'] == 0) {?>selected="selected"<?php }?> >Гость</option>
<option value="1" <? if ($row['rangs_com'] == 1) {?>selected="selected"<?php }?> >Рекрут</option>
<option value="2" <? if ($row['rangs_com'] == 2) {?>selected="selected"<?php }?>>Рядовой</option>
<option value="3" <? if ($row['rangs_com'] == 3) {?>selected="selected"<?php }?>>Сержант</option>
<option value="4" <? if ($row['rangs_com'] == 4) {?>selected="selected"<?php }?>>Лейтенант</option>
<option value="5" <? if ($row['rangs_com'] == 5) {?>selected="selected"<?php }?>>Капитан</option>
<option value="6" <? if ($row['rangs_com'] == 6) {?>selected="selected"<?php }?>>Майор</option>
<option value="7" <? if ($row['rangs_com'] == 7) {?>selected="selected"<?php }?>>Полковник</option>
<option value="8" <? if ($row['rangs_com'] == 8) {?>selected="selected"<?php }?>>Генерал</option>
<option value="9" <? if ($row['rangs_com'] == 9) {?>selected="selected"<?php }?>>Лидер</option>
</select><br />
<label for="cre">Могут создавать топики:</label><br />
<select name="cre" class="input" size="1">
<option value="0" <? if ($row['rangs_cre'] == 0) {?>selected="selected"<?php }?> >Гость</option>
<option value="1" <? if ($row['rangs_cre'] == 1) {?>selected="selected"<?php }?> >Рекрут</option>
<option value="2" <? if ($row['rangs_cre'] == 2) {?>selected="selected"<?php }?>>Рядовой</option>
<option value="3" <? if ($row['rangs_cre'] == 3) {?>selected="selected"<?php }?>>Сержант</option>
<option value="4" <? if ($row['rangs_cre'] == 4) {?>selected="selected"<?php }?>>Лейтенант</option>
<option value="5" <? if ($row['rangs_cre'] == 5) {?>selected="selected"<?php }?>>Капитан</option>
<option value="6" <? if ($row['rangs_cre'] == 6) {?>selected="selected"<?php }?>>Майор</option>
<option value="7" <? if ($row['rangs_cre'] == 7) {?>selected="selected"<?php }?>>Полковник</option>
<option value="8" <? if ($row['rangs_cre'] == 8) {?>selected="selected"<?php }?>>Генерал</option>
<option value="9" <? if ($row['rangs_cre'] == 9) {?>selected="selected"<?php }?>>Лидер</option>
</select><br />
<div class="knopka">
<input type="submit" class="input" value="Изменить" name="create"/>
</div>
</form>
<?php if ($row_user['clan_rang'] > '7') {?>
<a href="delete.php?id=<?php echo "$subforum";?>">Удалить раздел</a>
<?php }?>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php'); 
mysqli_close($dbc);
?>