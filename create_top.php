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
$query= "Select clan, rangs_cre, main, gruppa, name_subf from subforums where id_subf='$subforum' limit 1";
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
//////////////SUBFORUM ТОЧНО СУЩЕСТВУЕТ
$query_user = "Select clan, clan_rang, gruppa, f_ban, lvl, admin from users where id='$user_id' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
$row_user = mysqli_fetch_array($result_user);
if ($subforum == 1 and $row_user['admin'] <> 1) {
      ?>
      <script type="text/javascript">
      document.location.href = "subforum.php?subforum=<?php echo "$subforum";?>&err=1";
      </script>
      <?php
      exit(); 
} 
if ($row['main'] == 0) {//////////////Если это клан подфорум
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
    if ($row['rangs_cre'] <> 0) {////////Если писать всем нельзя
	  ?>
      <script type="text/javascript">
      document.location.href = "subforum.php?subforum=<?php echo "$subforum";?>";
      </script>
      <?php
      exit(); 
	} 
  }
}
else {
  if ($row_user['admin'] <> 1 and $row_user['admin'] <> 2) {
  if ($row_user['f_ban'] == 1 or $row_user['lvl'] < 10) {
	  ?>
      <script type="text/javascript">
      document.location.href = "subforum.php?subforum=<?php echo "$subforum";?>";
      </script>
      <?php
      exit(); 
  }
  else {
    if ($row['gruppa'] <> 'all' and $row['gruppa'] <> $row_user['gruppa']) {
      ?>
      <script type="text/javascript">
      document.location.href = "subforum.php?subforum=<?php echo "$subforum";?>";
      </script>
      <?php
      exit(); 
	}
  } 
  } 
}
///////////////////////////////////На всё проверили.
$create = $_POST['create'];
if (isset($create)) {
  $name = $_POST['name'];
  $cr = 1;
  $long_name = strlen($name);
  if (($long_name<2) or ($long_name>50)) {
    $err = 1;
	$cr = 0;
  }
   $text = $_POST['text'];
  $long_text = strlen($text);
  if (($long_text<1) or ($long_text>20000)) {
    $err = 2;
	$cr = 0;
  }
  if ($cr == 1) {
    $name = str_replace('<','&lt;', $name);
	$name = str_replace('<img src = "1.jpg">','=)', $name);
    $name = str_replace('>','&gt;', $name);
    $name = str_replace('"','&quot', $name);
    $name=stripslashes("$name");
    $name =  mysqli_real_escape_string($dbc, trim($name));
    $text = preg_replace('/(\r\n)+/', "\r\n", $text);
    $text = preg_replace('/(\r)+/', "\r", $text);
    $text = preg_replace('/(\n)+/', "\n", $text);
	$text = str_replace('<','&lt;', $text);
    $text = str_replace('<img src = "1.jpg">','=)', $text);
    $text = str_replace('>','&gt;', $text);
    $text = str_replace('"','&quot', $text);
require_once('inc_smiles.php');
    $text =  mysqli_real_escape_string($dbc, trim($text));
	$query_cr = "insert into topics (`id_subf`, `avtor`, `fix`, `text`, `time_cre`, `time_up`, `name`) values ('$subforum', '$user_id', '0', '$text', NOW(), NOW(), '$name')";
	$result_cr = mysqli_query($dbc, $query_cr) or die ('Ошибка передачи запроса к БД1');
	$query_cr = "select id_top from topics where id_subf='$subforum' and avtor='$user_id' and  fix=0 and text = '$text' and name = '$name'";
	$result_cr = mysqli_query($dbc, $query_cr) or die ('Ошибка передачи запроса к БД');
	$row_cr = mysqli_fetch_array($result_cr);
	$id_top = $row_cr['id_top'];
	?>
    <script type="text/javascript">
    document.location.href = "topic.php?topic=<?php echo "$id_top";?>";
    </script>
    <?php
    exit();
  }
}
$page_title = 'Создать новый топик';
require_once('conf/head.php');
require_once('conf/top.php')
?>
<div class="main">
<?php
if ($err == 1) {?><p id="error">Название должно быть в пределах от 2 до 32 символов</p><?php }
if ($err == 2) {?><p id="error">Название должно быть в пределах от 1 до 1024 символов</p><?php }
?>
<div class="stats">
<p><?php if ($row['main'] == 1) {?> <img src="img/ico/forum_new.png" width="12" height="12"/> <a href="forum.php?type=main">Форум игры</a><?php } else {?><img src="img/ico/forum_new.png" width="12" height="12"/> <a href="forum.php?type=company&company=<?php echo $row['clan'];?>">Форум отряда</a><?php }?><span class="white"> / </span><a href="subforum.php?subforum=<?php echo "$subforum";?>"><?php echo $row['name_subf']?></a></p>
</div>
<div class="stats">
<p>Заголовок:</p>
<form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
<input type="text" style="height:13px; width:230px;" class="input" name="name" /><br />
<p>Сообщение:</p>
<textarea rows="2" cols="35px" style="width:230px;" name="text"></textarea>
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