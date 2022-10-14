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
$subforum = $_GET['subforum'];
$subforum = htmlentities($subforum, ENT_QUOTES);
$subforum = mysqli_real_escape_string($dbc, trim($subforum));	
if (empty($subforum)) {
  require_once('conf/head.php');
  require_once('conf/top.php');
  require_once('conf/notfound.php'); 
}
else {
  $query = "Select rangs_read, rangs_cre, name_subf,main, clan, gruppa from subforums where id_subf = '$subforum' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $gruppa_subforum = $row['gruppa'];
  if ($row == 0) {
      require_once('conf/head.php');
      if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
        require_once('conf/top.php');
	  }
    require_once('conf/notfound.php'); 
  }
  else {
      //////////////////////////////Проверка
	  $user_id = $_SESSION['id'];
$query = "update users set location = 'forum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
      $query_user = "Select gruppa, clan, clan_rang, admin from users where id = '$user_id' limit 1";
      $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
      $row_user = mysqli_fetch_array($result_user);
	  $gruppa_us = $row_user['gruppa'];
	  $clan_us = $row_user['clan'];
	  $clan_rang_us = $row_user['clan_rang'];
	  $admin_us = $row_user['admin'];
	  if ($row['main'] == 0) {
	    if ($row['clan'] == $clan_us) {
		  if ($row['rangs_read'] > $clan_rang_us) {
		    ?>
            <script type="text/javascript">
            document.location.href = "error.php?err=1";
            </script>
            <?php
            exit();
		  }
		}
		else {
		  if ($row['rangs_read'] <> 0) {
		    ?>
            <script type="text/javascript">
            document.location.href = "error.php?err=1";
            </script>
            <?php
            exit();
		  }
		}
	  } 
	  /////////////////////////////////////////////////////////
	  /////////////////////////////////////////////////////////
      $page_title = $row['name_subf'];
      require_once('conf/head.php');
      if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
        require_once('conf/top.php');
	  }
	  ?><div id="main">
	  <div class="stats"><p class="podmenu"><?php echo $row['name_subf'];?></p><div class="zx">
	  <?php if ($row['main'] == 1) {?>
	  <p><img src="img/ico/forum_new.png" width="12" height="12"/> <a href="forum.php?type=main">Форум игры</a><?php } else {?>
	  <p><img src="img/ico/forum_new.png" width="12" height="12"/> <a href="forum.php?type=company&company=<?php echo $row['clan'];?>">Форум отряда</a><?php }?> / <span class="white"><?php echo $row['name_subf'];?></span></p>
	  </div>
	  </div>
	  <div class="stats"><?php
	  $query_sub = "Select id_top from topics where id_subf = '$subforum'";
      $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
      $count = mysqli_num_rows($result_sub);
	  if ($count == 0) {
	    ?><p>Тут пока никто ничего не создал..</p></div><?php
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
	      $query_sub = "Select name, id_top,fix, time_up, time_cre from topics where id_subf = '$subforum' order by time_up desc limit $skip, $result_per_page";
          $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
	      while ($row_sub = mysqli_fetch_array($result_sub)) {
	        $name = $row_sub['name_subf'];
	        $id_subf = $row_sub['id_subf'];
			$topic = $row_sub['id_top'];

$query_num = "Select id_com from comments where id_top='$topic' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total6 = mysqli_num_rows($result_num);
			$time_up = 0;
			$query_up = "select time_up from intopics where user_id='$user_id' and topic='$topic' limit 1";
            $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
			$row_up = mysqli_fetch_array($result_up);
			$time_up = $row_up['time_up'];
			$time_up_subf = $row_sub['time_up'];
			$time_up_subf = strtotime("$time_up_subf");
			$time_up = strtotime("$time_up");
		    ?><?php if ($row_sub['fix'] == 1) {?><?php 
			$time_up_subf = ($time_up_subf - 86400);
			}?>

<div class="tags">
<b style="width: 90%;"><a style="width: 100%; <?php if ($row_sub['fix'] == 1) {?>font-size: 15px;<?php }?>" href="topic.php?topic=<?php echo $row_sub['id_top'];?>"><?php if ($time_up < $time_up_subf) {?><img src="img/ico/topic.png" width="12" height="12"/><?php } else {?><img src="img/ico/topicread.png" width="12" height="12"/><?php }?> <?php echo $row_sub['name'];?><span style="width: 10%;"><?php echo "$total6";?></span></a></b>
</div>


<?php
		  }
}
}
	//////////////////////////////
	  ?></div>
	  <?php
	  if ($row['main'] == 0) {
	    if ($row['clan'] == $clan_us) {
		  if ($clan_rang_us >= $row['rangs_cre']) {
		    ?>
            <div class="stats">
	        <p><img src="img/ico/point.png" width="12" height="12"/> <a href="create_top.php?subforum=<?php echo "$subforum";?>">Создать топик</a></p>
			<p><img src="img/ico/point.png" width="12" height="12"/> <a href="edit_subforum.php?subforum=<?php echo "$subforum";?>">Редактировать раздел</a></p>
	        </div>
            <?php
		  }
		}
	  } 
	  else {
	    if ($admin_us <> 1 and $admin_us <> 2) {
	    if ($gruppa_subforum == $gruppa_us or $gruppa_subforum == 'all') {
		  if ($subforum <> 1) {
		  ?>
          <div class="stats">
	      <p><img src="img/ico/point.png" width="12" height="12"/> <a href="create_top.php?subforum=<?php echo "$subforum";?>">Создать топик</a></p>
	      </div>
          <?php
		}
		}
		}
		else {
		?>
          <div class="stats">
	      <p><img src="img/ico/point.png" width="12" height="12"/> <a href="create_top.php?subforum=<?php echo "$subforum";?>">Создать топик</a></p>
	      </div>
          <?php
		}
	  }
	  ?>
	  </div><?php
	  ////////////////////////////////////
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  if ($cur_page > 1) {
	  echo ' <a href="' . "$phpself" .  '?page=' . (1) . '&subforum=' . $subforum . '"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=' . ($cur_page-1) . '&subforum=' . $subforum . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3) .  '&subforum=' . $subforum?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2) .  '&subforum=' . $subforum?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1) . '&subforum=' . $subforum?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1)  .'&subforum=' . $subforum ?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2) . '&subforum=' . $subforum?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3). '&subforum=' . $subforum?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?page=' . ($cur_page+1) .'&subforum=' . $subforum . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" .  '?page=' . $num_page . '&subforum=' . $subforum . '">>></a> ';
    }
	else {
	  echo ' >>';
	}

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>