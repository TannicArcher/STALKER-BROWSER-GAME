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
$page_title = 'Тремор';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
  $sl = $_GET['sl'];
  $sl = mysqli_real_escape_string($dbc, trim($sl));
?>
<div id="main">
  <p class="podmenu">Медик</p>
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Тремор</p>
  <p><img src="img/ico/tremor.png" width="91" height="129"/></p>
  <div class="stats">
<div class="zx">
<?php 
if ($sl == '0') {?>
  <p><span class="blue">Только не сейчас... что там у тебя?</span></p>
  <p class="white">С медикаментами сейчас туговато, поэтому могу продать только определенное количество.</p><?php }
if ($sl == '1') {?>
<p><span class="blue">Вот, забирай свои аптечки...</span></p><?php }
if ($sl == '2') {?>
<p><span class="blue">Вот, забирай свой антирад...</span></p><?php }
if ($sl == '3') {?>
<p><span class="blue">А деньги? Я бесплатно медикаментами не раскидываю...</span></p><?php }
?>
</div>
<div class="zx">
  <p class="bonus"><b>Курс:</b><br /> 1 <img src="img/ico/apte4ka.png"/> аптечка = 200 <img src="img/ico/materials.png"/> хабара<br /> 1 <img src="img/ico/antirad.png"/> антирад = 200 <img src="img/ico/materials.png"/> хабара</p>
</div>
<div class="zx">
<p><img src="img/ico/apte4ka.png"/> <a href="apt_buy.php?sht=1">Купить 1 аптечку</a></p>
<p><img src="img/ico/apte4ka.png"/> <a href="apt_buy.php?sht=5">Купить 5 аптечек</a></p>
<p><img src="img/ico/apte4ka.png"/> <a href="apt_buy.php?sht=10">Купить 10 аптечек</a></p>
<p><img src="img/ico/apte4ka.png"/> <a href="apt_buy.php?sht=25">Купить 25 аптечек</a></p>
<p><img src="img/ico/apte4ka.png"/> <a href="apt_buy.php?sht=50">Купить 50 аптечек</a></p>
<p><img src="img/ico/apte4ka.png"/> <a href="apt_buy.php?sht=100">Купить 100 аптечек</a></p>
</div>
<div class="zx">
<p><img src="img/ico/antirad.png"/> <a href="rad_buy.php?sht=1">Купить 1 антирад</a></p>
<p><img src="img/ico/antirad.png"/> <a href="rad_buy.php?sht=5">Купить 5 антирадов</a></p>
<p><img src="img/ico/antirad.png"/> <a href="rad_buy.php?sht=10">Купить 10 антирадов</a></p>
<p><img src="img/ico/antirad.png"/> <a href="rad_buy.php?sht=25">Купить 25 антирадов</a></p>
<p><img src="img/ico/antirad.png"/> <a href="rad_buy.php?sht=50">Купить 50 антирадов</a></p>
<p><img src="img/ico/antirad.png"/> <a href="rad_buy.php?sht=100">Купить 100 антирадов</a></p>
</div>
  </div>
</div>
<?php

//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>