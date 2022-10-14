<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Взлом тайников';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
    <div id="main">
    <div class="stats">
    <p class="podmenu">Рейтинг сталкеров по взлому тайников</p>
	</div>
   <?php
	$total = '100'; 
	?>
<?php
$hgfdsa = $_GET['page'];
if (empty($hgfdsa)) {
$hgfdsa = '1';
}
$gpg = ($hgfdsa - '1');
$start = (($gpg * '10') + '1');
	?>
<ol start="<?php echo "$start";?>">
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
	  $query_us = "Select nick ,id,gruppa, last_active, lvl, opit, tainik_time, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' order by tainik_time DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  $now = (date("Y-m-d H:i:s"));
      $now = strtotime("$now");
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $id_us = $row_us['id'];
		$gruppa = $row_us['gruppa'];
		$last_active = $row_us['last_active'];
		$lvl = $row_us['lvl'];
        $last_active = strtotime("$last_active");
        $razn_last_act = ($now - $last_active);
	$opit = $row_us['opit'];
	$t_t = $row_us['tainik_time'];
	    ?>
<li>
<div style="background: url(/style/img/2.jpg);"><?php
	  if ($gruppa == 'mon') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
	  if ($gruppa == 'svoboda') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($gruppa == 'dolg') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($gruppa == 'naemniki') {if ($razn_last_act < 600 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  ?> [<?php echo "$lvl"; ?>ур] <a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a></div>
<div style="background: url(/style/img/line.png);">
<img src="img/ava/<?php echo $row_us['avatar']; ?>.png" width="75" height="75"/>
<img src="style/img/line.png" width="100%" height="2"/>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;"><span class="white"><b>Время: <img src="img/ico/time.png"/><?php echo "$t_t";?> секунд</b></span></div>
<img src="style/img/line.png" width="100%" height="2"/>
</div>
</li>
<img src="http://stalkeronlinegame.epizy.com/img/ico/2.png" width="100%" height="3"/>
	    <?php
	  }
	  ?>
</ol>
<center>
<div style="background: url(/style/img/2.jpg);">
	  <?php
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  ///////////////////////////////////////
	  ////////////////////////////////////////
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=1' . '&type=' . $type . '"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=' . ($cur_page-1) . '&type=' . $type . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3) . "&type=$type"?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2) . "&type=$type"?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1) . "&type=$type"?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1) . "&type=$type"?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2) . "&type=$type"?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3) . "&type=$type"?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?page=' . ($cur_page+1) . '&type=' . $type . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" .  '?page=' . $num_page . '&type=' . $type . '">>></a> ';
    }
	else {
	  echo ' >>';
	}

	////////////////////////////////
	///////////////////////////////
	}
	?>
	</div>
</center>
	<?php
   /////////////////////////////////
   //////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>