<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'В локации';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
    <div id="main">
<?php
$user_id = $_SESSION['id'];
?>
<?php
$query_us0 = "Select * from users where id='$user_id'";
$result_us0 = mysqli_query($dbc, $query_us0) or die ('Ошибка передачи запроса к БД');
$row_us0 = mysqli_fetch_array($result_us0);
$loc = $row_us0['loc'];
?>
<?php
$query_num = "Select id from users where loc = '$loc' and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result_num); 
?>
<?php
$query_num = "Select id from users where loc = '$loc' and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$chat_total = mysqli_num_rows($result_num); 
?>
<p class="white">В локации <span class="bonus"><?php echo "$chat_total"; ?></span> <?php
if ($chat_total == '1' or $chat_total == '21') {?>сталкер<?php }
if ($chat_total == 2 or $chat_total == 3 or $chat_total == 4 or $chat_total == 22) {?>сталкера<?php }
if ($chat_total != '1' and $chat_total != '2' and $chat_total != '3' and $chat_total != '4' and $chat_total != '21' and $chat_total != '22') {?>сталкеров<?php }
?></p>
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
	  $query_us = "Select * from users where loc = '$loc' and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' order by last_active DESC limit $skip, $result_per_page";
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
	    ?>
	    <div class="zx">
		<?php
	  if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
	  if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
	  if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
	  if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
	  ?> <a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a> (<?php echo "$lvl"; ?>)
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
<p class="podmenu" style="border-top:2px solid #444e4f; background-color:#1c252f;"></p>
<p><a href="zonas.php" class="menu"><img src="img/reload.gif" width="12" height="12"/> Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
	<?php
   /////////////////////////////////
   //////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>