<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Кто онлайн';
require_once('conf/head.php');
$lol = $_GET['t'];
$p = $_GET['page'];
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
    <div id="main">
    <div class="stats">
    <p class="podmenu">Кто онлайн</p>
	</div>
<?php if ($lol == '1') {?>
   <?php
    $query_num = "Select id from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and clan = '0'" ;
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
	  $query_us = "Select * from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and clan='0' order by opit DESC, yron_p DESC ,tochn_p DESC, bronya DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $id_us = $row_us['id'];
		$gruppa = $row_us['gruppa'];
$prem = $row_us['premium'];
$clan = $row_us['clan'];
$lvl = $row_us['lvl'];
	    ?>
	    <div class="zx">
		<?php
        if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	    if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
		if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="s"/><?php }
		if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="s"/><?php }
	  ?> <a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a> <?php if ($clan == '0' and $lvl > '4') {?>[ <img src="img/plus2.png" alt="Без отряда" title="Без отряда"/> ]<?php }?>
</div>
	  
	    <?php
	  }
	  ?>
	  <div class="zx">
	  <?php
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  ///////////////////////////////////////
	  ////////////////////////////////////////
	  if ($cur_page > 1) {?>
<a href="online.php?page=1&t=<?php echo "$lol";?>"><<</a>
     <?php }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {?>
<?php
$cur_pagel = ($cur_page - '1');
?>
<a href="online.php?page=<?php echo "$cur_pagel";?>&t=<?php echo "$lol";?>"><</a> 
      <?php }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3)?>&t=<?php echo "$lol";?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2)?>&t=<?php echo "$lol";?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1)?>&t=<?php echo "$lol";?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1)?>&t=<?php echo "$lol";?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2)?>&t=<?php echo "$lol";?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3)?>&t=<?php echo "$lol";?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {?>
<?php
$cur_paged = ($cur_page + '1');
?>
<a href="online.php?page=<?php echo "$cur_paged";?>&t=<?php echo "$lol";?>">></a>
    <?php }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {?>
<a href="online.php?page=<?php echo "$num_page";?>&t=<?php echo "$lol";?>">>></a>
     <?php }
	else {
	  echo ' >>';
	}

	////////////////////////////////
	///////////////////////////////
	}
	?>
	</div>
<?php } else {?>
   <?php
    $query_num = "Select id from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits'" ;
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$total = mysqli_num_rows($result_num); 
	?>
	<p class="podmenu">Онлайн <?php echo "[ $total ]"; ?></p>
<?php if ($p < '2') {?><div class="link"><a class="link" href="online.php?t=1"><img src="img/plus2.png" width="12"/> Без отряда</a></div><?php }?>
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
	  $query_us = "Select * from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' order by opit DESC, yron_p DESC ,tochn_p DESC, bronya DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $id_us = $row_us['id'];
		$gruppa = $row_us['gruppa'];
$prem = $row_us['premium'];
$clan = $row_us['clan'];
$lvl = $row_us['lvl'];
	    ?>
	    <div class="zx">
		<?php
        if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	    if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
		if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="s"/><?php }
		if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="s"/><?php }
	  ?> <a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a> <?php if ($clan == '0' and $lvl > '4') {?>[ <img src="img/plus2.png" alt="Без отряда" title="Без отряда"/> ]<?php }?>
</div>
	  
	    <?php
	  }
	  ?>
	  <div class="zx">
	  <?php
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  ///////////////////////////////////////
	  ////////////////////////////////////////
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=1"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=' . ($cur_page-1) . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3)?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2)?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1)?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1)?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2)?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3)?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?page=' . ($cur_page+1) . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" .  '?page=' . $num_page . '">>></a> ';
    }
	else {
	  echo ' >>';
	}

	////////////////////////////////
	///////////////////////////////
	}
	?>
	</div>
<?php }?>
	<?php
   /////////////////////////////////
   //////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>