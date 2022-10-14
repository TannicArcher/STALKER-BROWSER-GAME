<script type="text/javascript">
  document.location.href = "clan.php?id=<?php echo $_GET['company_id'];?>"
</script>
<?php
exit();
?>
<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Отряд';
require_once('conf/head.php');

if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  $show_ad = 1;
  require_once('conf/top.php');
  $user_id = $_SESSION['id'];
}

$clan_id = $_GET['company_id'];
$clan_id = mysqli_real_escape_string($dbc, trim($clan_id));	
$ral = $_GET['ral'];
if (empty($clan_id)) {
require_once('conf/notfound.php'); 
}
else {
$query_num2 = "Select id from users where clan='$clan_id' " ;
$result_num2 = mysqli_query($dbc, $query_num2) or die ('Ошибка передачи запроса к БД');
$sostav = mysqli_num_rows($result_num2); 
  $query_ggg = "Select clan, clan_rang from users where id = '$user_id'";
  $result_ggg = mysqli_query($dbc, $query_ggg) or die ('Ошибка передачи запроса к БД');
  $row_ggg = mysqli_fetch_array($result_ggg);
  $clan_ggg = $row_ggg['clan'];
  $clan_rang_ggg = $row_ggg['clan_rang'];
  $query_sto = "Select * from clans where clan_id = '$clan_ggg'";
  $result_sto = mysqli_query($dbc, $query_sto) or die ('Ошибка передачи запроса к БД');
  $row_sto = mysqli_fetch_array($result_sto);
  $war_oo = $row_sto['war'];
  $query_out = "Select clan, clan_rang, nick from users where id = '$user_id'";
  $result_out = mysqli_query($dbc, $query_out) or die ('Ошибка передачи запроса к БД');
  $row_out = mysqli_fetch_array($result_out);
  $clan_out = $row_out['clan'];
  $rang_out = $row_out['clan_rang'];
  $nick_out = $row_out['nick'];
  $rule = $_GET['rule'];
  $rule = htmlentities($rule, ENT_QUOTES);
  if (!empty($rule)) {
    if ($clan_id <> $clan_out or $rang_out < 6) {
	?>
    <script type="text/javascript">
    document.location.href = "company.php?company_id=<?php echo "$clan_id";?>";
    </script>
    <?php
	exit();
	}
  }
  $query = "Select * from clans where clan_id = '$clan_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  if ($row == 0) {
    require_once('conf/notfound.php'); 
  }
  else {
	$rating = $row['rating'];
	$win = $row['win'];
	$over = $row['over'];
	$name = $row['name'];
	$gruppa = $row['gruppa'];
	$clan_opit = $row['clan_opit'];
	$mentor = $row['mentor'];
	$war_1 = $row['war'];
  $war_1id = $row['war_id'];
  $query = "Select * from clans where clan_id = '$war_1id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $rowwer = mysqli_fetch_array($result);
    ?>
<?php
$stalkers = $row['stalkers'];
if ($stalkers == '3') {
$cash = '30000';
}
if ($stalkers == '4') {
$cash = '60000';
}
if ($stalkers == '5') {
$cash = '100000';
}
if ($stalkers == '6') {
$cash = '200000';
}
if ($stalkers == '7') {
$cash = '300000';
}
if ($stalkers == '8') {
$cash = '500000';
}
if ($stalkers == '9') {
$cash = '1000000';
}
if ($stalkers > '9' and $stalkers < '31') {
$cash = ($stalkers * 300000);
}
if ($stalkers > '30' and $stalkers < '36') {
$cash = ($stalkers * 500000);
}
if ($stalkers > '35') {
$cash = ($stalkers * 550000);
}
?>
    <div id="main">
<?php
if ($ral == '1') {?>
<p class="red"><b>Недостаточно хабара</b></p>
<?php }
?>
    <div class="stats">
    <p class="podmenu"><?php
	  if ($row['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12"/><?php }
	  if ($row['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12"/><?php }
	  if ($row['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12"/><?php } 
	  if ($row['gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12"/><?php } 
	  echo " $name"; ?></p>
    <?php
	$total = $row['people']; 
	?>
	</div>
	<?php
	///////////////////////Объява=============
	if (!empty($show_ad) and empty($read_ad)) {
  $query_ad = "select ad_nick, ad from clans where clan_id = '$clan_ad'";
  $result_ad = mysqli_query($dbc, $query_ad) or die ('Ошибка передачи запроса к БД');
  $row_ad = mysqli_fetch_array($result_ad);
  $ad = $row_ad['ad'];
  $ad_nick = $row_ad['ad_nick'];
  $ad = str_replace('<','&lt;', $ad);
  $ad = str_replace('>','&gt;', $ad);
  $ad = str_replace('"','&quot', $ad);
  $ad = stripslashes("$ad");
  if (!empty($ad) and $clan_out == $clan_id) {
  ?>
  <div class="stats"><span class="white">Объявление отряда: </span><span class="bonus"><?php echo "$ad // $ad_nick"; ?></span></div><?php }?>
  <?php
}
///////////////////////Объява=============КОНЕЦ


	///////////////////////////////Ошибка
	  $err = $_GET['err'];
	  if (!empty($err)) {
	  ?>
	  <div id="error">
	  <?php
	    if ($err == 'out') { echo "В отряде никого не должно быть.";}
	    if ($err == 'war') { echo "Ваш отряд не должен участвовать в битве.";}
	  ?>
	  </div>
	  <?php
	  }
	  //////////////////////////Конец ошибки
	  
	  ////////////Объявление.
	 if (!empty($rule)) {
	 if(isset($_POST['addad'])) {
	   $add_err = 0;
	   $ad = $_POST['ad'];
	   $ad = mysqli_real_escape_string($dbc, trim($ad));
  $ad = str_replace('<','&lt;', $ad);
  $ad = str_replace('>','&gt;', $ad);
  $ad = str_replace('"','&quot', $ad);
  $ad = stripslashes("$ad");
	   $ad_num = strlen($ad);
if ($ad_num>2024) {
	     $add_err = 1;
?><span id="error">Длина объявления должна быть не больше 2024 символов</span><?php
	   }
	   if ($ad_num == 0 and $add_err == 0) {
	     $query_num = "update clans set ad = '$ad' where clan_id = '$clan_id'";
		 $result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
		 $query_read = "update users set read_ad = '0' where clan = '$clan_id'";
		 $result_read = mysqli_query($dbc, $query_read) or die ('Ошибка передачи запроса к БД');
		 ?>
         <script type="text/javascript">
         document.location.href = "company.php?company_id=<?php echo "$clan_id";?>&rule=1";
         </script>
         <?php
	     exit();
	   }
	   if ($ad_num <> 0 and $add_err == 0) {
	     $query_num = "update clans set ad = '$ad', ad_nick = '$nick_out' where clan_id = '$clan_id'";
		 $result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
		 $query_read = "update users set read_ad = '1' where clan = '$clan_id'";
		 $result_read = mysqli_query($dbc, $query_read) or die ('Ошибка передачи запроса к БД');
		 ?>
         <script type="text/javascript">
         document.location.href = "company.php?company_id=<?php echo "$clan_id";?>&rule=1";
         </script>
         <?php
	     exit();
	   }
	 }
	 $adbot=$_POST['ad'];
	 $adbot = htmlentities($adbot);
	 ?> 
	 <div class="stats">
	 <p>Новое объявление:</p>
	 <form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
	 <input type="text" class="input" name="ad" value="<?php echo "$adbot"; ?>" />
     <input type="submit" style="width:35px;" class="input" value="+" name="addad"/>
     </form>
	 </div>
	 <?php 
	 }
	 //////////////////////////Конец обьявы
	?>
<?php
if ($clan_id == $clan_out and $rang_out == 9 and $rule == 1) {?>
<div class="stats">
<p>Переименовать отряд: <span class="red">(5000 RUB)</span></p>
<form enctype="multipart/form-data" method="post" action="title_clan.php?c_id=<?php echo "$clan_id";?>">
<input type="text" class="input" name="c_name" />
<input type="submit" style="width:60px;" class="input" value="ввести" name="addchat"/>
</form>
<?php }?>
	<div class="stats">
	<?php
    $query_lvl = "Select lvl, opit from clan_opit order by lvl desc";
	  $result_lvl = mysqli_query($dbc, $query_lvl) or die ('Ошибка передачи запроса к БД');
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  $big_next_lvl = $row_lvl['opit'];
	  $lvl=$row_lvl['lvl'];
	  while (($clan_opit/1000)< $row_lvl['opit']) {
	  $next_lvl = $row_lvl['opit'];
	  $lvl=($lvl-1);
	  $row_lvl = mysqli_fetch_array($result_lvl);
	  }
	  if ($next_lvl == 0) {
	    $next_lvl = "$big_next_lvl" ;
	  } 
	$next_lvl = ($next_lvl/100);
	$clan_opit = ($clan_opit/100000);
	$clan_opit = round($clan_opit,2);
	$query_c = "Select id from users where clan = '$clan_id' and last_active > NOW() - (3000)";
    $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
    $row_c = mysqli_num_rows($result_c);
	?>
<?php
$ssq = '0';
?>
<?php
$query_sub = "Select * from users where clan = '$clan_id' order by lvl desc";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$slava = $row_sub['slava'];
?>
<?php
$ssq = ($ssq + $slava);
?>
<?php 
}
?>
<?php
$lalsw = ($cash / '100');
$lalsw2 = ('100' - $lvl);
$cash = ($lalsw2 * $lalsw);
?>
	<p class="white">Уровень: <?php echo "$lvl"?></p>
	<p>Опыт: <span class="white"><?php echo "$clan_opit"; ?>к / <?php echo "$next_lvl";?>к</span></p>
	<p>Слава: <span class="white"><?php echo "$ssq"; ?></span></p>
	<p>Ранг: <span class="white"><?php echo "$rating"; ?></span></p>
<p style="border-top: solid 1px #444e4f"></p>
	<p>Побед: <span class="white"><?php echo "$win"; ?></span></p>
	<p>Поражений: <span class="white"><?php echo "$over"; ?></span></p>
<p style="border-top: solid 1px #444e4f"></p>
<?php if ($war_1 == '0') {?>
<?php if ($clan_out != $clan_id and $rang_out > '7' and $war_oo == '0') {?>
<p><a class="red" href="bitva_on.php?c_id=<?php echo "$clan_id";?>" onclick="return confirm ('Уверены?')">Напасть!</a></p>
<p style="border-top: solid 1px #444e4f"></p>
<?php }?>
<?php } else {?><p class="red">Воюет с отрядом <a href="company.php?company_id=<?php echo "$war_1id";?>"><?php echo $rowwer['name'];?></a></p><?php }?>
	 <div class="zx">
<?php if ($clan_out == $clan_id and $rang_out > '7') {?>
<center><p><small><a href="monster_out.php">Отменить клановые рейды</a></small></p></center>
<?php }?>
	<?php if ($clan_out == $clan_id) {?><p><img src="img/ico/point.png" width="12" height="12"/> <a href="csklad.php?c_id=<?php echo "$clan_id";?>">Склад</a></p>
	<?php }?>
	<?php if ($clan_out == $clan_id) {?><p><img src="img/ico/point.png" width="12" height="12"/> <a href="c_bonus.php">Бонусы отряда</a></p>
	<?php }?>
	<p><img src="img/ico/forum_new.png" width="12" height="12"/> <a href="forum.php?type=company&company=<?php echo "$clan_id"?>">Форум</a></p>
<?php if ($clan_out == $clan_id) {?><p><img src="img/ico/forum_new.png" width="12" height="12"/> <a href="clanmail.php">Чат отряда</a></p>
	<?php }?>
	<p><img src="img/ico/point.png" width="12" height="12"/> <a href="onlinecom.php?company_id=<?php echo "$clan_id";?>">Онлайн</a> <span class="white"><?php echo "$row_c";?></span></p>
	</div>
	</div>
	<p class="podmenu">Состав: [ <?php echo "$sostav"; ?> / <?php echo "$stalkers";?>] <?php if ($clan_out == $clan_id and $rang_out > '7' and $stalkers < '50') {?>[<a href="aaa.php" onclick="return confirm ('Уверены?')">+1</a>] (-<img src="img/ico/materials.png"/><?php echo "$cash";?> <small><span class="lal2">[-<?php echo "$lvl";?>%]</span></small>)<?php }?></p>
	<?php
	if (!empty($_GET['page'])) {
	$cur_page = $_GET['page'];
	}
	else {
	$cur_page = 1;
	}
	$result_per_page = 10;
	$skip = (($cur_page - 1) * $result_per_page);
	$num_page = ceil($sostav / $result_per_page);
	if ($num_page > 0) {
	  $query_us = "Select nick ,id, clan_rang, ko, last_active  from users where clan = '$clan_id' order by clan_rang DESC, ko DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $clan_rang = $row_us['clan_rang'];
	    $id_us = $row_us['id'];
		$ko = $row_us['ko'];
		$ko = ($ko/100000);
		$ko = round($ko,2);
		$last_active = $row_us['last_active'];
		$last_active = strtotime("$last_active");
		$now = (date("Y-m-d H:i:s"));
        $now = strtotime("$now");
		$razn_last_act = ($now - $last_active);
	    ?>
	    <div class="zx">
		<?php
	  if ($row_us['clan_rang'] == '1') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/rekryt.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/rangs/rekryton.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_us['clan_rang'] == '2') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/ryadovoy.png" width="12" height="12"alt="р"/><?php } else {?><img src="img/rangs/ryadovoyon.png" width="12" height="12"alt="р"/><?php }}
	  if ($row_us['clan_rang'] == '3') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/serjant.png" width="12" height="12" alt="с"/><?php } else {?><img src="img/rangs/serjanton.png" width="12" height="12" alt="с"/><?php }}
	  if ($row_us['clan_rang'] == '4') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/leitenant.png" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/leitenanton.png" width="12" height="12" alt="л"/><?php }}
	  if ($row_us['clan_rang'] == '5') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/kapitan.png" width="12" height="12" alt="к"/><?php } else {?><img src="img/rangs/kapitanon.png" width="12" height="12" alt="к"/><?php }}
	  if ($row_us['clan_rang'] == '6') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/mayor.png" width="12" height="12" alt="м"/><?php } else {?><img src="img/rangs/mayoron.png" width="12" height="12" alt="м"/><?php }}
	  if ($row_us['clan_rang'] == '7') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/polkovnik.png" width="12" height="12" alt="п"/><?php } else {?><img src="img/rangs/polkovnikon.png" width="12" height="12" alt="п"/><?php }}
	  if ($row_us['clan_rang'] == '8') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/general.png" width="12" height="12" alt="г"/><?php } else {?><img src="img/rangs/generalon.png" width="12" height="12" alt="г"/><?php }}
	  if ($row_us['clan_rang'] == '9') { if ($razn_last_act > 1800 ) {?><img src="img/rangs/lider.png" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/lideron.png" width="12" height="12" alt="л"/><?php }} 
	  ?>
	  <span class="white"><a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a> (<?php echo "$ko";?>к)</span> <?php if (!empty($rule) and $rang_out>$clan_rang) { if ($rang_out>($clan_rang+1)) {?>[<a href="rang.php?inf=up&id=<?php echo "$id_us";?>">Повысить</a>]<?php }  if (0<($clan_rang-1)) {?> [<a href="rang.php?inf=down&id=<?php echo "$id_us";?>">Понизить</a>]<?php } ?> [<a href="agree.php?inf=outuser&id=<?php echo "$id_us";?>">Исключить</a>]<?php }?> <?php if ($rang_out == '9' and $rule == '1' and $user_id != $id_us) {?>[<a href="lider.php?id=<?php echo "$id_us";?>"  onclick="return confirm
('Уверены, что хотите сделать этого игрока лидером отряда? Вы будете понижены до генерала.')">+Лидер</a>]<?php }?></div>
	  
	    <?php
	  }
	  ?>
	  <div class="zx">
	  <?php
	  ///////////////////////////////////////
	  ////////////////////////////////////////
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  if ($cur_page > 1) {
	  echo ' <a href="' . "$phpself" .  '?page=' . (1) . '&company_id=' .$clan_id . '&rule=' . $rule .  '"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=' . ($cur_page-1) . '&company_id=' .$clan_id . '&rule=' . $rule . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3). '&company_id=' .$clan_id . '&rule=' . $rule ?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2). '&company_id=' .$clan_id . '&rule=' . $rule?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1). '&company_id=' .$clan_id  . '&rule=' . $rule?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1). '&company_id=' .$clan_id . '&rule=' . $rule?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2). '&company_id=' .$clan_id . '&rule=' . $rule ?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3). '&company_id=' .$clan_id . '&rule=' . $rule ?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?page=' . ($cur_page+1). '&company_id=' .$clan_id  . '&rule=' . $rule . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" .  '?page=' . $num_page . '&company_id=' .$clan_id . '&rule=' . $rule .  '">>></a> ';
    }
	else {
	  echo ' >>';
	}
	////////////////////////////////
	///////////////////////////////
	}
	?>
	</div>
	<?php
	//////////////////////////////////Покинуть клан/Управление кланом
	if ($clan_out == $clan_id) {
	  if ($rang_out > 5 and empty($rule)) {
	  ?>
	  <div class="stats"> <img src="img/ico/point.png" width="12" height="12"/> <a href="company.php?page=<?php echo "$cur_page"; ?>&company_id=<?php echo "$clan_id";?>&rule=1">Управление отрядом</a></div>
	  <?php
	  }
	  if ($rang_out < 9) {
	  ?><div class="stats"><img src="img/ico/point.png" width="12" height="12"/> <a href="agree.php?inf=company">Покинуть отряд</a></div>
	<?php
	  }
	  else {
	    if ($sostav == 1) {
		?><div class="stats"><img src="img/ico/point.png" width="12" height="12"/> <a href="agree.php?inf=company">Покинуть отряд</a></div>
	<?php
		}
	  }
	}
	//////////////////////////////////////
	?>
    </div>
    <?php
  }
  
}
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>