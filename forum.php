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
$page_title = 'Форум';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
  $user_id = $_SESSION['id'];
}
?>
<div id="main">
<?php
$type = $_GET['type'];
$clan_id = mysqli_real_escape_string($dbc, trim($clan_id));	
if ($type <> 'main' and $type <> 'company') {
  require_once('conf/notfound.php'); 
}
else {
  if ($type == 'company') {
    $clan_id = $_GET['company'];
	$clan_id = mysqli_real_escape_string($dbc, trim($clan_id));	
    $query = "Select name from clans where clan_id = '$clan_id' limit 1";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    $row = mysqli_fetch_array($result);
    if ($row == 0) {
      require_once('conf/notfound.php'); 
    } 
	else {
	  $company_name = $row['name'];
	  ?>
        <div class="stats">
		  <p class="podmenu">Форум <?php echo "$company_name"?></p>
		</div>
		<div class="stats">
		  <?php
		   $query_sub = "Select name_subf, id_subf from subforums where clan = '$clan_id' and main <> 1";
           $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
		   $count = mysqli_num_rows($result_sub);
		   if ($count == 0) {
		   ?><p>Тут пока никто ничего не создал..</p><?php
		   } 
		   else {
		     if (!empty($_GET['page'])) {
               $cur_page = $_GET['page'];
             }
             else {
               $cur_page = 1;
             }
             $result_per_page = 20;
	         $skip = (($cur_page - 1) * $result_per_page);
		     $num_page = ceil($count / $result_per_page);
	         if ($num_page > 0) {
			   $query_sub = "Select name_subf, id_subf from subforums where clan = '$clan_id' and main <> 1 limit $skip, $result_per_page";
               $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
			   while ($row_sub = mysqli_fetch_array($result_sub)) {
	             $name = $row_sub['name_subf'];
	             $id_subf = $row_sub['id_subf'];
$query_num = "Select id_top from topics where id_subf='$id_subf' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6 = mysqli_num_rows($result_num);
				 $query_top = "Select time_up, fix, id_top from topics where id_subf = $id_subf";
                 $result_top = mysqli_query($dbc, $query_top) or die ('Ошибка передачи запроса к БД');
				 $read = 1;				 
			     while ($row_top = mysqli_fetch_array($result_top)) {
				   $topic = $row_top['id_top'];
				   $query_up = "select time_up from intopics where user_id='$user_id' and topic='$topic' limit 1";
                   $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
			       $row_up = mysqli_fetch_array($result_up);
				   $time_up = 0;
				   $time_up = $row_up['time_up'];
				   $time_up = strtotime("$time_up");
				   $time_top_up = 0;
				   $time_top_up = $row_top['time_up'];
				   $time_top_up = strtotime("$time_top_up");
				   if ($row_top['fix'] == 1) {
				     $time_top_up = ($time_top_up - 86400);
				   }
				   if ($time_up < $time_top_up) {
				     $read = 0;
				     break;
				   }
				 }
				 ?>
<div class="tags">
<b style="width: 90%;"><a style="width: 100%;" href="subforum.php?subforum=<?php echo "$id_subf";?>"><?php if ($read == 0) {?><img src="img/ico/forum_new.png" width="12" height="12"/><?php } else {?><img src="img/ico/forum.png" width="12" height="12"/><?php }?> <?php echo "$name";?><span style="width: 10%;"><?php echo "$total6";?></span></a></b>
</div>
<?php
			   }
			 }
		   }
		  ?>
		</div>
		<?php 
		$user_id = $_SESSION['id'];
        $query_user = "Select clan, clan_rang from users where id = '$user_id' limit 1";
        $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
        $row_user = mysqli_fetch_array($result_user);
	    $gruppa_us = $row_user['gruppa'];
	    $clan_us = $row_user['clan'];
	    $clan_rang_us = $row_user['clan_rang'];
	    $admin_us = $row_user['admin']; 
		if ($clan_us == $clan_id) {
		  if ($clan_rang_us >= 6) {?>
		    <div class="stats">
		    <p><img src="img/ico/point.png" width="12" height="12"/> <a href="create_subforum.php">Создать раздел</a></p>
		    </div>
	        <?php
		  }
	    }
	}
  }
  else {
    $query_sub = "Select name_subf, id_subf from subforums where main = 1";
    $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
	$count = mysqli_num_rows($result_sub);
	if ($count == 0) {
	  ?><p>Тут пока никто ничего не создал..</p><?php
	} 
	else {?>
	  <div class="stats">
		  <p class="podmenu">Форум игры</p>
	  </div>
	  <div class="stats">
	  <?php 
	  if (!empty($_GET['page'])) {
        $cur_page = $_GET['page'];
      }
      else {
        $cur_page = 1;
      }
      $result_per_page = 20;
	  $skip = (($cur_page - 1) * $result_per_page);
	  $num_page = ceil($count / $result_per_page);
	  if ($num_page > 0) {
		$query_sub = "Select name_subf, id_subf from subforums where main = 1 limit $skip, $result_per_page";
               $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
			   while ($row_sub = mysqli_fetch_array($result_sub)) {
	             $name = $row_sub['name_subf'];
	             $id_subf = $row_sub['id_subf'];
$query_num = "Select id_top from topics where id_subf='$id_subf' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6 = mysqli_num_rows($result_num);
				 $query_top = "Select time_up, fix, id_top from topics where id_subf = $id_subf";
                 $result_top = mysqli_query($dbc, $query_top) or die ('Ошибка передачи запроса к БД');
				 $read = 1;				 
			     while ($row_top = mysqli_fetch_array($result_top)) {
				   $topic = $row_top['id_top'];
				   $query_up = "select time_up from intopics where user_id='$user_id' and topic='$topic' limit 1";
                   $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
			       $row_up = mysqli_fetch_array($result_up);
				   $time_up = 0;
				   $time_up = $row_up['time_up'];
				   $time_up = strtotime("$time_up");
				   $time_top_up = 0;
				   $time_top_up = $row_top['time_up'];
				   $time_top_up = strtotime("$time_top_up");
				   if ($row_top['fix'] == 1) {
				     $time_top_up = ($time_top_up - 86400);
				   }
				   if ($time_up < $time_top_up) {
				     $read = 0;
				     break;
				   }
				 }
				 ?>

<div class="tags">
<b style="width: 90%;"><a style="width: 100%;" href="subforum.php?subforum=<?php echo "$id_subf";?>"><?php if ($read == 0) {?><img src="img/ico/forum_new.png" width="12" height="12"/><?php } else {?><img src="img/ico/forum.png" width="12" height="12"/><?php }?> <?php echo "$name";?><span style="width: 10%;"><?php echo "$total6";?></span></a></b>
</div>

<?php
		}
	  }
	  ?>
	  </div>
	<?php
	}
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" .  '?type=' . $type . '&company=' . $clan_id . '&page=1"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=' . ($cur_page-1) . '&type=' . $type . '&company=' . $clan_id . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3) . '&type=' . $type . '&company=' . $clan_id ?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2) . '&type=' . $type . '&company=' . $clan_id ?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1) . '&type=' . $type . '&company=' . $clan_id ?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1) . '&type=' . $type . '&company=' . $clan_id ?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2) . '&type=' . $type . '&company=' . $clan_id  ?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3) . '&type=' . $type . '&company=' . $clan_id?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?page=' . ($cur_page+1) .  '&type=' . $type . '&company=' . $clan_id . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" .  '?page=' . $num_page .  '&type=' . $type . '&company=' . $clan_id . '">>></a> ';
    }
	else {
	  echo ' >>';
	}
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
</div>
<?php 
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>