<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Онлайн в отряде';
require_once('conf/head.php');

if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  $show_ad = 1;
  require_once('conf/top.php');
  $user_id = $_SESSION['id'];
}

$clan_id = $_GET['company_id'];
$clan_id = htmlentities($clan_id, ENT_QUOTES);
$clan_id = mysqli_real_escape_string($dbc, trim($clan_id));	
if (empty($clan_id)) {
  require_once('conf/notfound.php'); 
}
else {
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
    <div id="main">
    <div class="stats">
    <p class="podmenu"><?php
	  if ($row['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12"/><?php }
	  if ($row['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12"/><?php }
	  if ($row['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12"/><?php } 
	  if ($row['gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="s"/><?php }
	  echo " $name"; ?></p>
	</div>
   <?php
   $query_num = "Select id from users where clan = '$clan_id' and last_active > NOW() - (3000)";
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$total = mysqli_num_rows($result_num); 
	?>
	<p class="podmenu">Онлайн <?php echo "[ $total ]"; ?></p>
	<?php
   /////////////////////////////////
   ////////////////////////////////
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 10;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total / $result_per_page);
	if ($num_page > 0) {
	  $query_us = "Select nick ,id, clan_rang from users where clan = '$clan_id' and last_active > NOW() - (3000) order by clan_rang DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $clan_rang = $row_us['clan_rang'];
	    $id_us = $row_us['id'];
	    ?>
	    <div class="zx">
		<?php
        if ($clan_rang == '1') {?><img src="img/rangs/rekryton.png" width="12" height="12" alt="н"/><?php }
	    if ($clan_rang == '2') {?><img src="img/rangs/ryadovoyon.png" width="12" height="12"alt="р"/><?php }
	    if ($clan_rang == '3') {?><img src="img/rangs/serjanton.png" width="12" height="12" alt="с"/><?php }
	    if ($clan_rang == '4') {?><img src="img/rangs/leitenanton.png" width="12" height="12" alt="л"/><?php }
	    if ($clan_rang == '5') {?><img src="img/rangs/kapitanon.png" width="12" height="12" alt="к"/><?php }
	    if ($clan_rang == '6') {?><img src="img/rangs/mayoron.png" width="12" height="12" alt="м"/><?php }
	    if ($clan_rang == '7') {?><img src="img/rangs/polkovnikon.png" width="12" height="12" alt="п"/><?php }
	    if ($clan_rang == '8') {?><img src="img/rangs/generalon.png" width="12" height="12" alt="г"/><?php }
	    if ($clan_rang == '9') {?><img src="img/rangs/zamon.jpg" width="12" height="12" alt="л"/><?php } 
	    if ($clan_rang == '10') {?><img src="img/rangs/lideron.png" width="12" height="12" alt="л"/><?php } 
	  ?> <a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a></div>
	  
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
	<?php
   /////////////////////////////////
   //////////////////////////////////
   }
}   
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>