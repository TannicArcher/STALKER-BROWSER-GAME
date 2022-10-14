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

$log_id = $_SESSION['id'];
$query_ch = "Select money, clan, gruppa_num from users where id = '$log_id'";
$result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
$row_ch = mysqli_fetch_array($result_ch);
$clan_ch = $row_ch['clan'];
$gn = $row_ch['gruppa_num'];
$money = $row_ch['money'];
$nm = '3000';
if ($gn < '1') {
$nm = '0';
}
if ($money<$nm) {
  header ('Location: settings.php?error=1');
  exit();
}
  ////////////////////////////////////////////////////////////
  if (!empty($_POST['change'])) {
    $group=$_POST['group'];
   if ((isset($group)) and (!empty($group))) {
	  if (($group != 'dolg') and ($group != 'svoboda') and ($group != 'odinochki') and ($group != 'mon')) {
	    $err=1;
	  }
    }
	else {
	  $err=2;
	}
  if ($clan_ch != '0') {
	  $err=3;
}
	if ($err==0) {
	  if ($group == 'odinochki') {
	    $group = 'naemniki';
	  }
	  $query = "update users set gruppa = '$group', gruppa_num=gruppa_num+1, money=money-'$nm', clan='' where id = '$log_id' limit 1";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  header ('Location: settings.php?error=3');
      exit();
	}
  }
  ////////////////////////////////////////////////////////////
  $page_title = 'Сменить группировку';
  require_once('conf/head.php');
  require_once('conf/top.php');
  ?>
  <?php if(!empty($err)) {?><div id="error">
   <?php if ($err==1) {echo 'Подмена данных';}?>
   <?php if ($err==2) {echo 'Вы не выбрали группировку';}?>
   <?php if ($err==3) {echo 'Покиньте отряд, в котором вы находитесь';}?>
   </div><?php } ?>
   <div class="stats">
   <form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
	 <label for="group">Группировка:</label><br />
    <select name="group" class="input" size="1">
    <option value="dolg" <? if ($_POST['group'] == dolg) {?>selected="selected"<?php }?> >Долг</option>
    <option value="svoboda" <? if ($_POST['group'] == svoboda) {?>selected="selected"<?php }?> >Свобода</option>
    <option value="odinochki" <? if ($_POST['group'] == odinochki) {?>selected="selected"<?php }?>>Одиночки</option>
    <option value="mon" <? if ($_POST['group'] == mon) {?>selected="selected"<?php }?> >Монолит</option>
    </select>
	 <div class="knopka">
     <input type="submit" class="input" value="Сменить" name="change"/>
     </div>
	 </form>
  <p><span class="bonus">Стоимость: <?php if ($gn < '1') {?><span class="bonus"><i>бесплатно!</i></span><?php } else {?><img src="img/ico/money.png" width="12" height="12"/> 3000 RUB<?php }?></span></p>
  </div>
  <?php  
   require_once('conf/navig.php');
   require_once('conf/foot.php'); 
//////////////////////////////////////////////  
mysqli_close($dbc);
?>