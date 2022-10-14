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
$user_id = $_SESSION['id'];
$H=getenv("HTTP_REFERER");
if (empty($H)) {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
$page = $_GET['page'];
$page = htmlentities($page, ENT_QUOTES);
// 1 прикрепить топ
// 2 закрыть топ
// 3 переместить топ
// 4 удалить топ
// 5 изменить топ
// 6 удалить комент
// 7 бан по форуму
// 8 бан по игре
// 9 удалить полностью
$type = $_GET['type'];
if ($type > 9 or $type <1) {
  ?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$H"?>";
  </script>
  <?php
  exit();
}
//// В типе указано то, что нужно.
if ($type == 1) {//////////////////////прикрепить топ.
  $topic = $_GET['topic'];
  $topic = mysqli_real_escape_string($dbc, trim($topic));
  $topic = htmlentities($topic, ENT_QUOTES);
  $query_isset = "Select fix, id_subf, time_up from topics where id_top='$topic' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  if (empty($row_isset)) {//Существует ли топик
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  $fix = $row_isset['fix'];
  $time_up = $row_isset['time_up'];
  $id_subf = $row_isset['id_subf'];
  $query_sub = "Select main, clan, rangs_read, rangs_com, rangs_cre, gruppa from subforums where id_subf = '$id_subf' limit 1";
  $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
  $row_sub = mysqli_fetch_array($result_sub);
  if (empty($row_sub)) {//Существует ли раздел
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  else {
    $main = $row_sub['main'];
  }
  $query_user = "Select gruppa, clan, clan_rang, admin, moder, f_ban, lvl from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  if ($main == 0) {
    if ($row_user['clan'] == $row_sub['clan']) {//Если это его клан
	  if (6 > $row_user['clan_rang']) {//Если ранг не позволяет
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit(); 
	  }
	} 
	else {//Если кланы не равны.
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	} 
  }
  else {
    if ($row_user['admin'] <> 1 and $row_user['admin'] <> 2 and $row_user['admin'] <> 3 and $row_user['moder'] <> 1) {
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
  }
  //////////////////////До этого места всё проверили и прикепляем топ/отсоединяем:)
  if ($fix == 1) {
    $fix = 0;
  }
  else {
    $fix = 1;
  }
  $query = "update topics set fix= '$fix', time_up=NOW()+1000000 where id_top='$topic' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  ?>
  <script type="text/javascript">
  document.location.href = "topic.php?topic=<?php echo "$topic";?>&moderator=1&page=<?php echo "$page";?>";
  </script>
  <?php
  exit(); 
}
/////////////////////////////////////////////////КОНЕЦ TYPE 1

if ($type == 2) {///////////////////// закрыть/открыть топ топ.
  $topic = $_GET['topic'];
  $topic = mysqli_real_escape_string($dbc, trim($topic));
  $query_isset = "Select close, id_subf, time_up from topics where id_top='$topic' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  if (empty($row_isset)) {//Существует ли топик
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  $close = $row_isset['close'];
  $id_subf = $row_isset['id_subf'];
  $query_sub = "Select main, clan, rangs_read, rangs_com, rangs_cre, gruppa from subforums where id_subf = '$id_subf' limit 1";
  $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
  $row_sub = mysqli_fetch_array($result_sub);
  if (empty($row_sub)) {//Существует ли раздел
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  else {
    $main = $row_sub['main'];
  }
  $query_user = "Select gruppa, clan, clan_rang, admin, moder, f_ban, lvl from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  if ($main == 0) {
    if ($row_user['clan'] == $row_sub['clan']) {//Если это его клан
	  if (6 > $row_user['clan_rang']) {//Если ранг не позволяет
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit(); 
	  }
	} 
	else {//Если кланы не равны.
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	} 
  }
  else {
    if ($row_user['admin'] <> 1 and $row_user['admin'] <> 2 and $row_user['admin'] <> 3 and $row_user['moder'] <> 1) {
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
  }
  //////////////////////До этого места всё проверили и прикепляем топ/отсоединяем:)
  if ($close == 1) {
    $close = 0;
  }
  else {
    $close = 1;
  }
  $query = "update topics set close = '$close' where id_top='$topic' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  ?>
  <script type="text/javascript">
  document.location.href = "topic.php?topic=<?php echo "$topic";?>&moderator=1&page=<?php echo "$page";?>";
  </script>
  <?php
  exit(); 
}
///////////////////////////////////////Конец ТИПУ 2

if ($type == 3) {///////////////////// перенести.
  $topic = $_GET['topic'];
  $topic = mysqli_real_escape_string($dbc, trim($topic));
  $query_isset = "Select name, id_subf, time_up from topics where id_top='$topic' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  $name = $row_isset['name'];
  if (empty($row_isset)) {//Существует ли топик
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  $id_subf = $row_isset['id_subf'];
  $query_sub = "Select main, clan, rangs_read, rangs_com, rangs_cre, gruppa from subforums where id_subf = '$id_subf' limit 1";
  $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
  $row_sub = mysqli_fetch_array($result_sub);
  if (empty($row_sub)) {//Существует ли раздел
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  else {
    $main = $row_sub['main'];
  }
  $query_user = "Select gruppa, clan, clan_rang, admin, moder, f_ban, lvl from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  $clan = $row_user['clan'];
  $cre = $row_sub['rangs_cre'];
  if ($main == 0) {
    if ($row_user['clan'] == $row_sub['clan']) {//Если это его клан
	  if (6 > $row_user['clan_rang']) {//Если ранг не позволяет
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit(); 
	  }
	} 
	else {//Если кланы не равны.
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	} 
  }
  else {
    ?>
    <script type="text/javascript">
    document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
    </script>
    <?php
    exit();
  }
  $create = $_POST['create'];
  if (isset($create)) {
    $cr=1;
    $addsub = $_POST['subforum'];
	if (empty($addsub)) {
	  $cr=0;
	}
	$addsub =  mysqli_real_escape_string($dbc, trim($addsub));
	$query = "Select name_subf from subforums where clan = '$clan' and id_subf='$addsub' and main <> 1 and rangs_cre<='$cre' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	$row = mysqli_fetch_array($result);
	if (empty($row)) {
	  $cr=0;
	}
	if ($cr == 1) {
	  $query = "update topics  set id_subf='$addsub' where id_top = '$topic' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
  }
  //////////////////////До этого места всё проверили и прикепляем топ/отсоединяем:)
  $page_title = 'Перемещение топика';
  require_once('conf/head.php');
  require_once('conf/top.php');
  ?>
  <div id="main">
    <div class="stats">
    <p class="podmenu">Перемещение топика</p>
	</div>
	<div class="stats">
	<p class="white"><?php echo "$name";?></p>
	<p>Раздел:</p>
	<form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
	<select name="subforum" class="input" size="1">
	<?php
	$query = "Select name_subf, id_subf from subforums where clan = '$clan' and main <> 1 and rangs_cre<='$cre'";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    while ($row = mysqli_fetch_array($result)) {
	?><option value="<?php echo $row['id_subf'];?>" <? if ($row['id_subf'] == $id_subf) {?>selected="selected"<?php }?> ><?php echo $row['name_subf'];?></option><?php
	}
	?>
	</select>
	<div class="knopka">
    <input type="submit" class="input" value="Изменить" name="create"/>
    </div>
    </form>
	</div>
  </div>
  <?php
  require_once('conf/navig.php');
  require_once('conf/foot.php'); 
}
///////////////////////////////////////Конец ТИПУ 3

if ($type == 4) {//////////////////////Удалить топ
  $topic = $_GET['topic'];
  $topic = mysqli_real_escape_string($dbc, trim($topic));
  $query_isset = "Select fix, id_subf, time_up, id_subf from topics where id_top='$topic' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  if (empty($row_isset)) {//Существует ли топик
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  $fix = $row_isset['fix'];
  $time_up = $row_isset['time_up'];
  $id_subf = $row_isset['id_subf'];
  $query_sub = "Select main, clan, rangs_read, rangs_com, rangs_cre, gruppa from subforums where id_subf = '$id_subf' limit 1";
  $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
  $row_sub = mysqli_fetch_array($result_sub);
  if (empty($row_sub)) {//Существует ли раздел
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  else {
    $main = $row_sub['main'];
  }
  $query_user = "Select gruppa, clan, clan_rang, admin, moder, f_ban, lvl from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  if ($main == 0) {
    if ($row_user['clan'] == $row_sub['clan']) {//Если это его клан
	  if (6 > $row_user['clan_rang']) {//Если ранг не позволяет
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit(); 
	  }
	} 
	else {//Если кланы не равны.
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	} 
  }
  else {
    if ($row_user['admin'] <> 1 and $row_user['admin'] <> 2 and $row_user['moder'] <> 1) {
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
  }
  //////////////////////До этого места всё проверили и прикепляем топ/отсоединяем:)
  $query = "DELETE FROM topics WHERE `id_top` = '$topic' LIMIT 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $query = "DELETE FROM comments WHERE `id_top` = '$topic'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $id_subf = htmlentities($id_subf, ENT_QUOTES);
  ?>
  <script type="text/javascript">
  document.location.href = "subforum.php?subforum=<?php echo "$id_subf";?>";
  </script>
  <?php
  exit(); 
}
///////////////////////////////////////Конец ТИПУ 4

if ($type == 5) {///////////////////////////////////////изменить топ
  $topic = $_GET['topic'];
  $topic = mysqli_real_escape_string($dbc, trim($topic));
  $query_isset = "Select fix, id_subf, time_up, id_subf, name, avtor, text from topics where id_top='$topic' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  if (empty($row_isset)) {//Существует ли топик
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
$text_top = $row_isset['text'];
$name_top = $row_isset['name'];
    $text_top = strtr($text_top, array('<br/>' => ' ', '<br />' => ' '));
    $text_top = stripslashes("$text_top");
  $id_subf = $row_isset['id_subf'];
  $id_subf = htmlentities($id_subf);
  $query_sub = "Select main, clan, rangs_read, rangs_com, rangs_cre, gruppa from subforums where id_subf = '$id_subf' limit 1";
  $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
  $row_sub = mysqli_fetch_array($result_sub);
  if (empty($row_sub)) {//Существует ли раздел
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  else {
    $main = $row_sub['main'];
  }
  $query_user = "Select gruppa, clan, clan_rang, admin, moder, f_ban, lvl from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  if ($main == 0) {
    if ($row_user['clan'] == $row_sub['clan']) {//Если это его клан
	  if (6 > $row_user['clan_rang']) {//Если ранг не позволяет
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit(); 
	  }
	} 
	else {//Если кланы не равны.
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	} 
  }
  else {
    if ($row_user['admin'] <> 1 and $row_user['admin'] <> 2 and $row_user['moder'] <> 1) {
	  if ($row_isset['avtor'] <> $user_id) {
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit();
	  }
	}
  }
/////////////////////////////////ОБНОВЛЯЕМ  
$create = $_POST['create'];
if (isset($create)) {
  $name = $_POST['name'];
  $cr = 1;
  $long_name = strlen($name);
  if (($long_name<2) or ($long_name>32)) {
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
    $name = str_replace('>','&gt;', $name);
    $name = str_replace('"','&quot', $name);
    $name=stripslashes("$name");
    $name =  mysqli_real_escape_string($dbc, trim($name));
    $text = preg_replace('/(\r\n)+/', "\r\n", $text);
    $text = preg_replace('/(\r)+/', "\r", $text);
    $text = preg_replace('/(\n)+/', "\n", $text);
    $text = str_replace('<','&lt;', $text);
    $text = str_replace('>','&gt;', $text);
    $text = str_replace('"','&quot', $text);
    $text = strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />'));
    $text=stripslashes("$text");
    $text =  mysqli_real_escape_string($dbc, trim($text));
	$query_cr = "update topics set text = '$text', name = '$name' where id_top='$topic'";
	$result_cr = mysqli_query($dbc, $query_cr) or die ('Ошибка передачи запроса к БД1');
	?>
    <script type="text/javascript">
    document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
    </script>
    <?php
    exit();
  }
}
///////////////////////////////////
$page_title = 'Редактирование топика';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<div class="main">
<?php
if ($err == 1) {?><p id="error">Название должно быть в пределах от 2 до 32 символов</p><?php }
if ($err == 2) {?><p id="error">Название должно быть в пределах от 1 до 1024 символов</p><?php }
?>
<div class="stats">
<p><?php if ($main == 1) {?> <img src="img/ico/forum_new.png" width="12" height="12"/> <a href="forum.php?type=main">Форум игры</a><?php } else {?><img src="img/ico/forum_new.png" width="12" height="12"/> <a href="forum.php?type=company&company=<?php echo "$id_subf";?>">Форум отряда</a><?php }?><span class="white"> / </span><a href="topic.php?topic=<?php echo "$topic";?>"><?php echo $row_isset['name'];?></a></p>
</div>
<div class="stats">
<p>Заголовок:</p>
<form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
<input type="text" value="<?php echo "$name_top";?>" style="height:13px; width:230px;" class="input" name="name" /><br />
<p>Сообщение:</p>
<textarea rows="2" cols="35px" style="width:230px;" name="text"><?php echo "$text_top" ; ?></textarea>
<div class="knopka">
<input type="submit" class="input" value="Изменить" name="create"/>
</div>
</form>
</div>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php'); 
}
////////////////////////////////////////КОНЕЦ ТИПУ 5

if ($type == 6) {///////////////////////////////////////удалить комент
  $comment = $_GET['comment'];
  $comment = mysqli_real_escape_string($dbc, trim($comment));
  $query_isset = "Select id_top from comments where id_com='$comment' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  $topic = $row_isset['id_top'];
  if (empty($row_isset)) {//Существует ли comment
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  $query_isset = "Select fix, id_subf, time_up, id_subf, name from topics where id_top='$topic' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  if (empty($row_isset)) {//Существует ли топик
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  $id_subf = $row_isset['id_subf'];
  $query_sub = "Select main, clan, rangs_read, rangs_com, rangs_cre, gruppa from subforums where id_subf = '$id_subf' limit 1";
  $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
  $row_sub = mysqli_fetch_array($result_sub);
  if (empty($row_sub)) {//Существует ли раздел
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  else {
    $main = $row_sub['main'];
  }
  $query_user = "Select gruppa, clan, clan_rang, admin, moder, f_ban, lvl, nick from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  if ($main == 0) {
    if ($row_user['clan'] == $row_sub['clan']) {//Если это его клан
	  if (6 > $row_user['clan_rang']) {//Если ранг не позволяет
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit(); 
	  }
	} 
	else {//Если кланы не равны.
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	} 
  }
  else {
    if ($row_user['admin'] <> 1 and $row_user['admin'] <> 2 and $row_user['admin'] <> 3 and $row_user['moder'] <> 1) {
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
  }
  $nick = $row_user['nick'];
  $text = '<span style="color:#00aecd">Данное сообщение нарушало правила форума. Скрыто</span><br /><span class="clothes" style="color:#888888">---<br />Модератор: </span>' . '<span class="clothes" style="color:#00aecd">' . "$nick" . '</span>';
  $query = "update comments set text= '$text' where id_com = '$comment' LIMIT 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  ?>
  <script type="text/javascript">
  document.location.href = "topic.php?topic=<?php echo "$topic";?>&moderator=1&page=<?php echo "$page";?>";
  </script>
  <?php
}
///////////////////////////////////////КОНЕЦ ТИПУ 6

//////////////////////////////////////////////бан по форуму.
if ($type == 7) {
  $query_user = "Select admin, moder from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  $admin_user = $row_user['admin'];
  $moder_user = $row_user['moder'];
  $topic = $_GET['topic'];
  if ($admin_user <> 2 and $admin_user <> 1 and $admin_user <> 3 and $moder_user <> 1) {
    ?>
    <script type="text/javascript">
    document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
    </script>
    <?php 
	exit();
  }//////////////////////Проверили на админа
  $avtor = $_GET['avtor'];
  $avtor = htmlentities($avtor, ENT_QUOTES);
  $avtor = mysqli_real_escape_string($dbc, trim($avtor));
  $query_isset = "Select admin, f_ban from users where id='$avtor' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  if (empty($row_isset)) {//Существует ли avtor
    ?>
    <script type="text/javascript">
    document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
    </script>
    <?php
    exit();
  }
  if ($row_isset['admin'] == 1 or $row_isset['admin'] == 2 or $row_isset['moder'] == 1) {//Если админ не главный.
    ?>
    <script type="text/javascript">
    document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>&moderator=1";
    </script>
    <?php
    exit();
  }
  if ($row_isset['f_ban'] == 1) {
    $f_ban = 0;
  }
  else {
    $f_ban = 1;
  } 
  $query = "update users set f_ban= '$f_ban' where id='$avtor' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  if (!empty($topic) and !empty($page)) {
  ?>
  <script type="text/javascript">
  document.location.href = "topic.php?topic=<?php echo "$topic";?>&moderator=1&page=<?php echo "$page";?>";
  </script>
  <?php
  exit(); 
  }
  else {
	if (!empty($avtor)) {
    ?>
    <script type="text/javascript">
    document.location.href = "profile.php?id=<?php echo "$avtor";?>";
    </script>
    <?php
    exit(); 
	}
	else {
	  ?>
      <script type="text/javascript">
      document.location.href = "index.php";
      </script>
      <?php
      exit(); 
	}
  }
}
///////////////////////

//////////////////////////////////////////////бан по жизни.
if ($type == 8) {
  $query_user = "Select admin, nick from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  $admin_user = $row_user['admin'];
  $nick = $row_user['nick'];
  $avtor = $_GET['profile'];
  $avtor = htmlentities($avtor, ENT_QUOTES);
  if ($admin_user <> 2 and $admin_user <> 1) {
    ?>
    <script type="text/javascript">
    document.location.href = "profile.php?id=<?php echo "$avtor"?>";
    </script>
    <?php 
	exit();
  }//////////////////////Проверили на админа
  $avtor = mysqli_real_escape_string($dbc, trim($avtor));
  $query_isset = "Select admin from users where id='$avtor' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  if (empty($row_isset)) {//Существует ли avtor
    ?>
    <script type="text/javascript">
    document.location.href = "profile.php?id=<?php echo "$avtor"?>";
    </script>
    <?php 
    exit();
  }
  if ($row_isset['admin'] == 1 or $row_isset['admin'] == 2) {//Если админ не главный.
    ?>
    <script type="text/javascript">
    document.location.href = "profile.php?id=<?php echo "$avtor"?>";
    </script>
    <?php 
    exit();
  }
  $input = $_POST['ban'];
  if (isset($input)) {
    $cr=1;
    $text = $_POST['text'];
    $long_text = strlen($text);
  if (($long_text<1) or ($long_text>1024)) {
    $err = 1;
	$cr = 0;
  }
  if ($cr == 1) {
    $text = preg_replace('/(\r\n)+/', "\r\n", $text);
    $text = preg_replace('/(\r)+/', "\r", $text);
    $text = preg_replace('/(\n)+/', "\n", $text);
    $text = str_replace('<','&lt;', $text);
    $text = str_replace('>','&gt;', $text);
    $text = str_replace('"','&quot', $text);
    $text = strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />'));
    $text=stripslashes("$text");
    $text =  mysqli_real_escape_string($dbc, trim($text));
	$add = '<br /><span class="clothes" style="color:#888888">---<br />Администратор: </span>' . '<span class="clothes" style="color:#00aecd">' . "$nick" . '</span>';
	$text = "$text" . "$add";
	$query = "update users set ban= '1', why_ban = '$text' where id='$avtor' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	?>
    <script type="text/javascript">
    document.location.href = "profile.php?id=<?php echo "$avtor"?>";
    </script>
    <?php 
    exit();
    }
  }
  ///////////////////////////////////
  $page_title = 'БАН';
  require_once('conf/head.php');
  require_once('conf/top.php');
?>
  <div class="main">
<?php
if ($err == 1) {?><p id="error">Название должно быть в пределах от 2 до 64 символов</p><?php }
?>
  <div class="stats">
  <form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
  <p>Причина:</p>
  <textarea rows="2" cols="35px" style="width:230px;" name="text"></textarea>
  <div class="knopka">
  <input type="submit" class="input" value="Забанить" name="ban"/>
  </div>
  </form>
  </div>
  </div>
  <?php
  require_once('conf/navig.php');
  require_once('conf/foot.php'); 
////////////////////////////////////////
}
///////////////////////

if ($type == 9) {///////////////////////////////////////удалить комент полностью
  $comment = $_GET['comment'];
  $comment = mysqli_real_escape_string($dbc, trim($comment));
  $query_isset = "Select id_top from comments where id_com='$comment' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  $topic = $row_isset['id_top'];
  if (empty($row_isset)) {//Существует ли comment
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  $query_isset = "Select fix, id_subf, time_up, id_subf, name from topics where id_top='$topic' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
  $row_isset = mysqli_fetch_array($result_isset);
  if (empty($row_isset)) {//Существует ли топик
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  $id_subf = $row_isset['id_subf'];
  $query_sub = "Select main, clan, rangs_read, rangs_com, rangs_cre, gruppa from subforums where id_subf = '$id_subf' limit 1";
  $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
  $row_sub = mysqli_fetch_array($result_sub);
  if (empty($row_sub)) {//Существует ли раздел
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  else {
    $main = $row_sub['main'];
  }
  $query_user = "Select gruppa, clan, clan_rang, admin, moder, f_ban, lvl, nick from users where id = '$user_id' limit 1";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
  $row_user = mysqli_fetch_array($result_user);
  if ($main == 0) {
    if ($row_user['clan'] == $row_sub['clan']) {//Если это его клан
	  if (6 > $row_user['clan_rang']) {//Если ранг не позволяет
	    ?>
        <script type="text/javascript">
        document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
        </script>
        <?php
        exit(); 
	  }
	} 
	else {//Если кланы не равны.
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	} 
  }
  else {
    if ($row_user['admin'] <> 1 and $row_user['admin'] <> 2 and $row_user['moder'] <> 1) {
	  ?>
      <script type="text/javascript">
      document.location.href = "topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$page";?>";
      </script>
      <?php
      exit();
	}
  }
  $nick = $row_user['nick'];
  $query = "DELETE FROM comments WHERE id_com = '$comment' LIMIT 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  ?>
  <script type="text/javascript">
  document.location.href = "topic.php?topic=<?php echo "$topic";?>&moderator=1&page=<?php echo "$page";?>";
  </script>
  <?php
}
///////////////////////////////////////КОНЕЦ ТИПУ 9


mysqli_close($dbc);
?>