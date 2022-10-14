<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'В чате';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
$h=getenv("HTTP_REFERER");
?>
    <div id="main">
<?php
    $query_num = "Select id from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and location = 'chat'" ;
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$total = mysqli_num_rows($result_num); 
	?>
<?php
    $query_num = "Select id from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and location = 'chat'" ;
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$chat_total = mysqli_num_rows($result_num); 
	?>
<p class="white">В чате <span class="bonus"><?php echo "$chat_total"; ?></span> <?php
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
	  $query_us = "Select * from users where last_active > NOW()-(3000) and gruppa <> 'mytants' and gruppa <>'bandits' and gruppa <> 'zombie' and gruppa <> 'monolits' and location = 'chat' order by last_active DESC limit $skip, $result_per_page";
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
		<?php
	  if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
	  if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
	  if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
	  if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
	  ?> <a href="chat.php?nick=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a> [<a href="profile.php?id=<?php echo "$id_us"; ?>"><img src="img/ico/profile.png" width="15" height="15"></a>] (<?php echo $row_us['last_active']; ?>)<br/>

	    <?php
	  }
	  ?>
<div style="border-left:1px solid #444e4f;border-right:1px solid #444e4f;">
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
<a href="<?php echo "$h";?>" class="menu"><img src="img/ico/chat.png" width="12" height="12"/>Вернуться в чат</a>
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