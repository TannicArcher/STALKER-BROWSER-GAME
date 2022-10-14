<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$h=getenv("HTTP_REFERER");
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
  exit();
}
?>
<?php
$user_id = $_SESSION['id'];
$say = $_POST['msg'];
$query_us = "Select * from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$apt = $row_us['clan'];
$max_hp = $row_us['max_hp'];
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$clan_rang = $row_us['clan_rang'];
$clan = $row_us['clan'];
$say = str_replace('<','&lt;', $say);
$say = str_replace('>','&gt;', $say);
$say = str_replace('"','&quot', $say);
$text = $say;
require_once('inc_smiles.php');
$say = $text;
$say = stripslashes("$say");
$say =  mysqli_real_escape_string($dbc, trim($say));
?>
<?php
$query_add_ch = "insert into clan_mail (`user_id`, `rang`, `clan_id`, `say`, `time`) values ('$user_id', '$clan_rang', '$clan', '$say', NOW())";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$query = "update users set clan_mes=clan_mes+'1' where clan = '$clan' and id != '$user_id' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "clanmail.php";
</script>
</body>
</html>