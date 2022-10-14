<?
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Взлом сейфа';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
<div id="main">
<div class="stats">
<form enctype="multipart/form-data" method="post" action="loks.php">
<p class="podmenu">Взлом сейфа</p>
Пароль сложный, но и награда приличная! Тот кто взломает сейф получит 10 000 руб.</br></br>
<input name="text"></input>
<div class="knopka">
<input type="submit" style="width:67px;" class="input" value="Взломать" name="addad"/>
</div>
</div>


<?
require_once('conf/navig.php');
require_once('conf/foot.php');
?>