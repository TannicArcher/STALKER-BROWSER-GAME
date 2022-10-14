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
$page_title = 'Поиск';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<div id="main">
<div class="stats">
  <p class="podmenu">Поиск</p>
</div>
<div class="stats">
<p class="white">Выберите тип:</p>
<a href="poisk1.php" class="menu"><img src="img/ico/search.png" width="12" height="12"/> Поиск сталкера</a>
<a href="poisk2.php" class="menu"><img src="img/ico/search.png" width="12" height="12"/> Поиск отряда</a>
</div>
</div>
<?php



//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>