<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Снаряжение';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
    <div id="main">
    <div class="stats">
    <p class="podmenu">Рейтинг сталкеров по вооружению</p>
	</div>
	<?php
	$type=$_GET['type'];
	if (empty($type)) {
	$type=1;
	}
	?>
	<div class="stats"><p><img src="img/ico/shield.png" alt="p" width="12" height="12"/>[<a <?php if ($type == 1) {?>class="white"<?php }?> href="rating.php?type=1">Здор</a>] [<a <?php if ($type == 2) {?>class="white"<?php }?> href="rating.php?type=2">Броня</a>] [<a <?php if ($type == 3) {?>class="white"<?php }?> href="rating.php?type=3">Разрыв</a>]</p>
	<p>- - - - - - - - - - - - - -</p>
	<p><img src="img/ico/pistol.png" alt="p" width="12" height="12"/>[<a <?php if ($type == 4) {?>class="white"<?php }?> href="rating.php?type=4">Урон</a>] [<a <?php if ($type == 5) {?>class="white"<?php }?> href="rating.php?type=5">Точн</a>] [<a <?php if ($type == 6) {?>class="white"<?php }?> href="rating.php?type=6">Надёжн</a>]</p>
	<p>- - - - - - - - - - - - - -</p>
	<p><img src="img/ico/avtomat.png" alt="p" width="12" height="12"/>[<a <?php if ($type == 7) {?>class="white"<?php }?> href="rating.php?type=7">Урон</a>] [<a <?php if ($type == 8) {?>class="white"<?php }?> href="rating.php?type=8">Точн</a>] [<a <?php if ($type == 9) {?>class="white"<?php }?> href="rating.php?type=9">Надёжн</a>]</p>
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
	  if ($type==1) {
	  $query_us = "Select nick ,id,gruppa, max_hp, last_active, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by max_hp DESC limit $skip, $result_per_page";
	  }
	  if ($type==2) {
	  $query_us = "Select nick ,id,gruppa, last_active, bronya, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by bronya DESC limit $skip, $result_per_page";
	  }
	  if ($type==3) {
	  $query_us = "Select nick ,id,gruppa, last_active, razriv_cl, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by razriv_cl DESC limit $skip, $result_per_page";
	  }
	  if ($type==4) {
	  $query_us = "Select nick ,id,gruppa, last_active, yron_p, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by yron_p DESC limit $skip, $result_per_page";
	  }
	  if ($type==5) {
	  $query_us = "Select nick ,id,gruppa, last_active, tochn_p, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by tochn_p DESC limit $skip, $result_per_page";
	  }
	  if ($type==6) {
	  $query_us = "Select nick ,id,gruppa, last_active, safety_p, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by safety_p DESC limit $skip, $result_per_page";
	  }
	  if ($type==7) {
	  $query_us = "Select nick ,id,gruppa, last_active, yron_w, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by yron_w DESC limit $skip, $result_per_page";
	  }
	  if ($type==8) {
	  $query_us = "Select nick ,id,gruppa, last_active, tochn_w, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by tochn_w DESC limit $skip, $result_per_page";
	  }
	  if ($type==9) {
	  $query_us = "Select nick ,id,gruppa, last_active, safety_w, lvl, avatar from users where gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and id <> '1' and admin <> '1' order by safety_w DESC limit $skip, $result_per_page";
	  }
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  $now = (date("Y-m-d H:i:s"));
      $now = strtotime("$now");
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $id_us = $row_us['id'];
		$gruppa = $row_us['gruppa'];
		$lvl = $row_us['lvl'];
		$last_active = $row_us['last_active'];
        $last_active = strtotime("$last_active");
        $razn_last_act = ($now - $last_active);
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
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;"><span class="white"><b><?php
	  if ($type==1) { echo $row_us['max_hp'];}
	  if ($type==2) { echo $row_us['bronya'];}
	  if ($type==3) { echo $row_us['razriv_cl'];}
	  if ($type==4) { echo $row_us['yron_p'];}
	  if ($type==5) { echo $row_us['tochn_p'];}
	  if ($type==6) { echo $row_us['safety_p'] . '%';}
	  if ($type==7) { echo $row_us['yron_w'];}
	  if ($type==8) { echo $row_us['tochn_w'];}
	  if ($type==9) { echo $row_us['safety_w'] . '%';}
	  ?></b></span></div>
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