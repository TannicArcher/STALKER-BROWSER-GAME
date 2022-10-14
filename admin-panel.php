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
$page_title = 'Админ-панель';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$tip = $_GET['tip'];
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$admin = $row['admin'];
?>
<?php if ($user_id != '2') {?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
?>
<div id="main">
<?php if ($tip == 'new') {?>
<div class="stats">
<p class="podmenu">Создать новость</p>
<p>Заголовок:</p>
<form enctype="multipart/form-data" method="post" action="creat_new.php">
<input type="text" style="height:13px; width:230px;" class="input" name="name" /><br />
<p>Текст:</p>
<textarea rows="2" cols="35px" style="width:230px;" name="text"></textarea>
<div class="knopka">
<input type="submit" class="input" value="создать" name="create"/>
</div>
</form>
</div><?php }
?>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>