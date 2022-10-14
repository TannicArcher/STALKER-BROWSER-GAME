<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Взносы';
require_once('conf/head.php');

if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  $show_ad = 1;
  require_once('conf/top.php');
  $user_id = $_SESSION['id'];
}
$type = $_GET['type'];
$cl = $_GET['cl'];
$query_us2 = "Select * from users where id = '$user_id'";
$result_us2 = mysqli_query($dbc, $query_us2) or die ('Ошибка передачи запроса к БД');
$row_us2 = mysqli_fetch_array($result_us2);
$clan2 = $row_us2['clan'];
$clan_id = $clan2; 

  $query = "Select name, gruppa from clans where clan_id = '$clan_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  if ($row == 0) {
    require_once('conf/notfound.php'); 
  }
  else {
    $name = $row['name'];
	$gruppa = $row['gruppa'];
    ?>
<?php
$query_us1 = "Select * from users where id = '$user_id'";
$result_us1 = mysqli_query($dbc, $query_us1) or die ('Ошибка передачи запроса к БД');
$row_us1 = mysqli_fetch_array($result_us1);
$clan1 = $row_us1['clan'];
$clan_rang1 = $row_us1['clan_rang'];
?>
<?php
if ($clan1 != $clan_id) {
$clan_id = $clan1;
}
?>
    <div id="main">
<?php if ($cl == '7' and $clan_rang1 > '9') {?>
<?php
$query = "update users set c_hab='0' where clan = '$clan1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="bonus">Рейтинг хабара обнулён.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }?>
<?php if ($cl == '8' and $clan_rang1 > '9') {?>
<?php
$query = "update users set c_mon='0' where clan = '$clan1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p style="border-top: solid 1px #444e4f;"></p>
<p class="bonus">Рейтинг денег обнулён.</p>
<p style="border-top: solid 1px #444e4f;"></p>
<?php }?>
   <?php
   $query_num = "Select id from users where clan = '$clan_id'";
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$total = mysqli_num_rows($result_num); 
	?>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Взносы <?php
	  if ($row['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12"/><?php }
	  if ($row['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12"/><?php }
	  if ($row['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12"/><?php } 
	  if ($row['gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="s"/><?php }
	  echo " $name"; ?></p></center>
<p style="border-top: solid 1px #444e4f;"></p>
<p><img src="img/ico/link.png"/> <a href="rat.php?id=<?php echo "$clan_id";?>">По рангу</a></p>
<p><img src="img/ico/materials.png"/> <a href="rat.php?id=<?php echo "$clan_id";?>&type=1">По хабару</a></p>
<p><img src="img/ico/money.png"/> <a href="rat.php?id=<?php echo "$clan_id";?>&type=2">По деньгам</a></p>
<?php if ($clan1 == $clan_id and $clan_rang1 > '9') {?>
<p style="border-top: solid 1px #444e4f;"></p>
<p><img src="img/ico/no.png"/> <a href="rat.php?id=<?php echo "$clan_id";?>&cl=7" onclick="return confirm ('Уверены?')">Обнулить рейтинг хабара</a></p>
<p><img src="img/ico/no.png"/> <a href="rat.php?id=<?php echo "$clan_id";?>&cl=8" onclick="return confirm ('Уверены?')">Обнулить рейтинг денег</a></p>
<?php }?>
<p style="border-top: solid 1px #444e4f;"></p>
	<?php
   /////////////////////////////////
   ////////////////////////////////
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 5;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total / $result_per_page);
	if ($num_page > 0) {
if ($type != 1 and $type != 2) {
	  $query_us = "Select * from users where clan = '$clan_id' order by clan_rang DESC limit $skip, $result_per_page";
}
if ($type == 1) {
	  $query_us = "Select * from users where clan = '$clan_id' order by c_hab DESC limit $skip, $result_per_page";
}
if ($type == 2) {
	  $query_us = "Select * from users where clan = '$clan_id' order by c_mon DESC limit $skip, $result_per_page";
}
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $clan_rang = $row_us['clan_rang'];
	    $id_us = $row_us['id'];
	$hab = $row_us['c_hab'];
	$mon = $row_us['c_mon'];
		$last_active = $row_us['last_active'];
		$last_active = strtotime("$last_active");
		$now = (date("Y-m-d H:i:s"));
        $now = strtotime("$now");
		$razn_last_act = ($now - $last_active);
	    ?>
	    <div class="zx">
		<?php
	  if ($row_us['clan_rang'] == '1') { if ($razn_last_act > 600 ) {?><img src="img/rangs/rekryt.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/rangs/rekryton.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_us['clan_rang'] == '2') { if ($razn_last_act > 600 ) {?><img src="img/rangs/ryadovoy.png" width="12" height="12"alt="р"/><?php } else {?><img src="img/rangs/ryadovoyon.png" width="12" height="12"alt="р"/><?php }}
	  if ($row_us['clan_rang'] == '3') { if ($razn_last_act > 600 ) {?><img src="img/rangs/serjant.png" width="12" height="12" alt="с"/><?php } else {?><img src="img/rangs/serjanton.png" width="12" height="12" alt="с"/><?php }}
	  if ($row_us['clan_rang'] == '4') { if ($razn_last_act > 600 ) {?><img src="img/rangs/leitenant.png" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/leitenanton.png" width="12" height="12" alt="л"/><?php }}
	  if ($row_us['clan_rang'] == '5') { if ($razn_last_act > 600 ) {?><img src="img/rangs/kapitan.png" width="12" height="12" alt="к"/><?php } else {?><img src="img/rangs/kapitanon.png" width="12" height="12" alt="к"/><?php }}
	  if ($row_us['clan_rang'] == '6') { if ($razn_last_act > 600 ) {?><img src="img/rangs/mayor.png" width="12" height="12" alt="м"/><?php } else {?><img src="img/rangs/mayoron.png" width="12" height="12" alt="м"/><?php }}
	  if ($row_us['clan_rang'] == '7') { if ($razn_last_act > 600 ) {?><img src="img/rangs/polkovnik.png" width="12" height="12" alt="п"/><?php } else {?><img src="img/rangs/polkovnikon.png" width="12" height="12" alt="п"/><?php }}
	  if ($row_us['clan_rang'] == '8') { if ($razn_last_act > 600 ) {?><img src="img/rangs/general.png" width="12" height="12" alt="г"/><?php } else {?><img src="img/rangs/generalon.png" width="12" height="12" alt="г"/><?php }}
	  if ($row_us['clan_rang'] == '9') { if ($razn_last_act > 600 ) {?><img src="img/rangs/zamoff.jpg" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/zamon.jpg" width="12" height="12" alt="л"/><?php }} 
	  if ($row_us['clan_rang'] == '10') { if ($razn_last_act > 600 ) {?><img src="img/rangs/lider.png" width="12" height="12" alt="л"/><?php } else {?><img src="img/rangs/lideron.png" width="12" height="12" alt="л"/><?php }} 
	  ?> <a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a><br/>
<img src="img/ico/materials.png"/> Хабар: <?php echo "$hab";?><br/>
<img src="img/ico/money.png"/> Деньги:  <?php echo "$mon";?>
</div>
	  
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
	    echo '<a href="' . "$phpself" . '?company_id=' . $clan_id . '&page=1"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?company_id=' . $clan_id . '&page=' . ($cur_page-1) . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?company_id=' . $clan_id . '&page=' . ($cur_page-3)?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?company_id=' . $clan_id . '&page=' . ($cur_page-2)?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?company_id=' . $clan_id . '&page=' . ($cur_page-1)?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?company_id=' . $clan_id . '&page=' . ($cur_page+1)?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?company_id=' . $clan_id . '&page=' . ($cur_page+2)?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?company_id=' . $clan_id . '&page=' . ($cur_page+3)?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?company_id=' . $clan_id . '&page=' . ($cur_page+1) . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" . '?company_id=' . $clan_id . '&page=' . $num_page . '">>></a> ';
    }
	else {
	  echo ' >>';
	}

	////////////////////////////////
	///////////////////////////////
	}
	?>
	</div>
<p style="border-top: solid 1px #444e4f;"></p>
<p><img src="img/reload.gif"/> <a href="csklad.php?c_id=<?php echo "$clan_id";?>">Назад</a></p>
<p style="border-top: solid 1px #444e4f;"></p>
	<?php
   /////////////////////////////////
   //////////////////////////////////
   }
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>