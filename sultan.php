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
$page_title = 'Султан';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////

$user_id = $_SESSION['id'];
$query_s = "Select * from users where id='$user_id' limit 1";
$result_s = mysqli_query($dbc, $query_s) or die ('Ошибка передачи запроса к БД');
$row_s = mysqli_fetch_array($result_s);
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$loto_time = $row_s['loto_time'];
$loto_time = strtotime("$loto_time");
$time = ($loto_time - $now);

echo' <div id="main">
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Султан</p>
  <p><img src="img/ico/sultan.png" width="93" height="133"/></p>
  <div class="stats">
<div class="zx">
  <p><span class="blue">- Сыграем?!</span></p>
<p class="white">Добро пожаловать в лотерею!</p>
  <p><span class="red">Одна попытка <u>стоит 100 <img src="img/ico/money.png"/> RUB</u>.</span><br /> <b>Выиграть можно:</b><br /> <img src="img/ico/materials.png"/> Хабар<br /> <img src="img/ico/money.png"/> RUB<br /> <img src="img/ico/apte4ka.png"/> Аптечки<br /> <img src="img/ico/antirad.png"/> Антирад</p>
</div>
<div class="zx">';
if ($time < 1) {
echo' <p><a class="white" href="bin.php">- Играем!</a></p>';} else {
echo' <p><span class="white">- Играем!</span> [подождите <span class="white">';
echo "$time"; 
echo' </span> секунд]</p>';}
echo'</div>

  </div>
</div>
';
//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>