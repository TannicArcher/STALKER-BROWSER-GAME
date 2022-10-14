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
exit();
}
$page_title = 'Рейды';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query_uch = "Select * from users where id = '$user_id' ";
$result_uch = mysqli_query($dbc, $query_uch) or die ('Ошибка передачи запроса к БД');
$row_uch = mysqli_fetch_array($result_uch);
$lvl_u = $row_uch['lvl'];
$poisk_tip = $row_uch['poisk_tip'];
?>
<?php
$query = "update users set m_stop='1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php if ($poisk_tip == '1') {?>
 <script type="text/javascript">
  document.location.href = "vzlom.php";
  </script>
  <?php
  exit();
}
?>
<div id="main">
<div class="stats">
  <p class="podmenu">Рейды</p>
</div>
<?php 
$err=$_GET['err'];
if (!empty($err)) {
if ($err==1) {
?>
<div id="error">
Вы должны состоять в отряде
</div>
<?php
}
if ($err==2) {
?>
<div id="error">
Этот мутант доступен начиная с 15 уровня
</div>
<?php
}
if ($err==3) {
?>
<div id="error">
Этот мутант доступен начиная с 10 уровня
</div>
<?php
}
if ($err==4) {
?>
<div id="error">
Этот мутант доступен начиная с 20 уровня
</div>
<?php
}
if ($err==5) {
?>
<div id="error">
Этот мутант доступен начиная с 25 уровня
</div>
<?php
}
if ($err==6) {
?>
<div id="error">
Этот мутант доступен начиная с 21 уровня
</div>
<?php
}
if ($err==7) {
?>
<div id="error">
Этот мутант доступен начиная с 22 уровня
</div>
<?php
}
}
?>
<?php if ($lvl_u < 3) {?><p style="border-style: double;"><span class="white">Думаю, что лезть на серьезного мутанта без нужной подготовки - смерти подобно. Давай-ка для начала нападем на пса. Как только убьешь его - возвращайся на главную страницу, я буду ждать тебя там.</span></p><?php }?>
<div class="stats">
  <table width="170" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="33" valign="top"><img src="img/monsters/3.png" width="30" height="30" border="0"/></td>
    <td width="137" valign="top">
	<div class="inf">
	  <a <?php if ($lvl_u < 3) {?>class="red"<?php }?> href="monster.php?m=3">Слепой пес</a><?php if ($lvl_u < 3) {?><img src="img/1.gif"/><?php }?>
	 <p>[с 1 ур]</p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
</div>


<div class="stats">
  <table width="170" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="33" valign="top"><img src="img/monsters/5.png" width="30" height="30" border="0"/></td>
    <td width="137" valign="top">
	<div class="inf">
	  <a href="monster.php?m=5">Плоть</a>
	 <p>[с 10 ур]</p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
</div>


<div class="stats">
  <table width="170" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="33" valign="top"><img src="img/monsters/4.png" width="30" height="30" border="0"/></td>
    <td width="137" valign="top">
	<div class="inf">
	  <a href="monster.php?m=1">Снорк</a>
	 <p>[с 15 ур]</p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
</div>


<div class="stats">
  <table width="170" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="33" valign="top"><img src="img/monsters/1.png" width="30" height="30" border="0"/></td>
    <td width="137" valign="top">
	<div class="inf">
	  <a href="monster.php?m=6">Кровосос</a>
	 <p>[с 20 ур]</p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
</div>


<div class="stats">
  <table width="170" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="33" valign="top"><img src="img/monsters/6.png" width="30" height="30" border="0"/></td>
    <td width="137" valign="top">
	<div class="inf">
	  <a href="monster.php?m=2">Химера</a>
	 <p>[клановый]</p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
</div>

<div class="stats">
  <table width="170" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="33" valign="top"><img src="img/monsters/7.png" width="30" height="30" border="0"/></td>
    <td width="137" valign="top">
	<div class="inf">
	  <a href="monster.php?m=4">Контролер</a>
	 <p>[клановый]</p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
</div>


<div class="stats">
  <table width="170" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <td width="33" valign="top"><img src="img/monsters/8.png" width="30" height="30" border="0"/></td>
    <td width="137" valign="top">
	<div class="inf">
	  <a href="monster.php?m=7">Псевдогигант</a>
	 <p>[клановый]</p>
	</div>
	</td>
    </tr>
    </tbody>
    </table>
</div>


</div>
<?php



//////////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>