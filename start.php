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
$page_title = 'Дегтярев';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<div id="main">
<p class="podmenu" style="border-top:1px
solid #444e4f; background-
color:#1c252f;">Дегтярев</p> 
<p class="podmenu" style="border-top:1px solid #444e4f; background- color:#1c252f;">
<p><img src="img/ico/rev.png"/></p>
  <?php
$type=$_GET['type'];
if (empty($type) or $type <> 1 and $type <> 2 ) {
  $type=1;
}
?>
  <?php
$type=$_GET['type'];
if (empty($type) or $type <> 2 and $type <> 3 ) {
}
?>
  <?php
$type=$_GET['type'];
if (empty($type) or $type <> 2 and $type <> 4 ) {
}
?>
  <?php
$type=$_GET['type'];
if (empty($type) or $type <> 2 and $type <> 5 ) {
}
?>
  <?php
$type=$_GET['type'];
if (empty($type) or $type <> 2 and $type <> 6 ) {
}
?>
  <?php
$type=$_GET['type'];
if (empty($type) or $type <> 2 and $type <> 7 ) {
}
?>
  <?php
if ($type == 1) {
  ?>
  <div class="stats">
<p><span class="bonus">Если хочешь выжить в зоне, запомни!</p><br />
<p class="podmenu" style="border-top:1px
solid #444e4f; background- color:#1c252f;">
<p> О отрядах</p>
<p class="podmenu" style="border-top:1px
solid #444e4f; background- color:#1c252f;">
<p>* Вся группировка поделена на <a
class="white" href="listcompany.php">отряды</a>.</p>
<p> ** Отряды контролируются своими
лидерами</p> 
<p class="podmenu" style="border-top:1px
solid #444e4f; background- color:#1c252f;">
<p> Заработок и Покупка</p>
 <p class="podmenu" style="border-top:1px
solid #444e4f; background- color:#1c252f;">
<p> * <a href="zona.php" class="white">В
зоне</a> ведутся ожесточённые бои за захват территорий</p> 
<p> ** Хабар из зоны ты можешь
обменять на оружие у <a class="white"
href="salesman.php">Торговца</a></p> 
 <p> * Также сталкеры ходят на <a
href="monsters.php" class="white">Рейды</a></p>
 <p> ** За успешный рейд вы можете
найти какую-нибудь вещь или хабар</p> 
<p> * У <a class="white"
href="masters.php">Кардана</a>, сталкеры
улучшают своё оружие</p> 
 <div class="clothes"><p class="bonus">
<p class="podmenu" style="border-top:1px
solid #444e4f; background- color:#1c252f;">
[Всю подробную информацию вы можете
найти в разделе <a class="bonus"
href="help.php">помощь</a>]</p> 
<p class="podmenu" style="border-top:1px
solid #444e4f; background- color:#1c252f;">
 <p>- <a class="white"
href="index.php">Спасибо, я всё понял.</a></
p> 

  </div>
</div>
<?php
}
if ($type == 2) {
  ?>
<div class="stats">
  <p><a href="locman.php?type=3">- Расскажи о "жарке"</a></p>
  <p><a href="locman.php?type=4">- Расскажи о "газировке"</a></p>
  <p><a href="locman.php?type=5">- Расскажи о "электре"</a></p>
  <p><a href="locman.php?type=6">- Расскажи о гравитационных аномалиях</a></p>
  <p><a href="locman.php?type=7">- Расскажи о подвижных аномалиях</a></p>
  
  </div>
<?php
}
if ($type == 3) {
  ?>
<div class="stats">
  <p><b><a href="locman.php?type=2">- Интересно. Можешь рассказать о...</a></b></p>
  
  </div>
<?php
}
if ($type == 4) {
  ?>
<div class="stats">
  <p><b><a href="locman.php?type=2">- Интересно. Можешь рассказать о...</a></b></p>
  
  </div>
<?php
}
if ($type == 5) {
  ?>
<div class="stats">
  <p><b><a href="locman.php?type=2">- Интересно. Можешь рассказать о...</a></b></p>
  
  </div>
<?php
}
if ($type == 6) {
  ?>
<div class="stats">
  <p><b><a href="locman.php?type=2">- Интересно. Можешь рассказать о...</a></b></p>
  
  </div>
<?php
}
if ($type == 7) {
  ?>
<div class="stats">
  <p><b><a href="locman.php?type=2">- Интересно. Можешь рассказать о...</a></b></p>
  
  </div>
  <?php
}
?>
</div>
<?php

//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>