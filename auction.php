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
$page_title = 'Аукционы';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<div id="main">
<div class="stats">
  <p class="podmenu">Аукцион</p>
</div>
<div class="stats">
<p class="white">Список Аукционов:</p>
<p><img src="img/ico/shield.png" width="12" height="12" alt="."/> <a href="a_clothes.php">Снаряжение</a></p>
<p><img src="img/ico/materials.png" width="12" height="12" alt="."/> <a href="soon.php">Ресурсы</a></p>
</div>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>