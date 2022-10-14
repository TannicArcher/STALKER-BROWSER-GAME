<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$topic = $_GET['topic'];
$lol = $_GET['lol'];
$topic = htmlentities($topic, ENT_QUOTES);
$topic = mysqli_real_escape_string($dbc, trim($topic));
if (!empty($lol)) {
$query_dfd = "Select * from users where id='$lol' limit 1";
$result_dfd = mysqli_query($dbc, $query_dfd) or die ('Ошибка передачи запроса к БД');
$row_dfd = mysqli_fetch_array($result_dfd);
$nick_dfd = $row_dfd['nick'];
$nick_dfd = ($nick_dfd.',');
}
if (empty($topic)) {
  require_once('conf/notfound.php'); 
}
else {
  $query = "Select id_subf, avtor, fix, text, name, time_cre, close from topics where id_top = '$topic' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $close = $row['close'];
  $fix = $row['fix'];
  if (empty($row)) {
    $page_title = 'Не найдено';
    require_once('conf/head.php');
	require_once('conf/top.php');
    require_once('conf/notfound.php'); 
  }  
  else {
    $subforum = $row['id_subf'];
    $query_sub = "Select name_subf, clan, rangs_read, gruppa, rangs_com, rangs_cre,	main from  subforums where id_subf = '$subforum' limit 1";
    $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
    $row_sub = mysqli_fetch_array($result_sub);
	$com = $row_sub['rangs_com'];
	$cre = $row_sub['rangs_cre'];
	$main = $row_sub['main'];
	$gruppa = $row_sub['gruppa'];
	$clan = $row_sub['clan'];
	//////////////////////////////Проверка
	  $user_id = $_SESSION['id'];
$query = "update users set location = 'forum' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
      $query_user = "Select gruppa, clan, clan_rang, admin, moder, f_ban, lvl from users where id = '$user_id' limit 1";
      $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
      $row_user = mysqli_fetch_array($result_user);
	  $gruppa_us = $row_user['gruppa'];
	  $clan_us = $row_user['clan'];
	  $clan_rang_us = $row_user['clan_rang'];
	  $admin_us = $row_user['admin'];
	  $moder_us = $row_user['moder'];
	  $f_ban_us = $row_user['f_ban'];
	  $lvl_us = $row_user['lvl'];
	  if ($row_sub['main'] == 0) {
	    if ($row_sub['clan'] == $clan_us) {
		  if ($row_sub['rangs_read'] > $clan_rang_us) {
		    ?>
            <script type="text/javascript">
            document.location.href = "error.php?err=1";
            </script>
            <?php
            exit();
		  }
		}
		else {
		  if ($row_sub['rangs_read'] <> 0) {
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
    $page_title = $row['name'];
    require_once('conf/head.php');
    if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
      require_once('conf/top.php');
      $user_id = $_SESSION['id'];
	}
  ?>
  <div id="main">
    <div class="stats">
    <p class="podmenu"><?php echo $row['name'];?></p>
	<p class="white"><img src="img/ico/forum_new.png" width="12" height="12"/> <?php 
	if ($row_sub['main'] == 1) {?><a href="forum.php?type=main">Форум игры</a><?php } 
	else {?><a href="forum.php?type=company&company=<?php echo $row_sub['clan'];?>">Форум клана</a><?php }?>
	/ <a href="subforum.php?subforum=<?php echo "$subforum";?>"><?php echo $row_sub['name_subf'];?></a> / <span class="white"><?php echo $row['name'];?></span></p>
	</div>
  <?php
  $err = $_GET['err'];
  if ($err == 1) {?><div id="error"><p>Поле обязательно для ввода</p></div><?php }
  $query_up = "select page from intopics where user_id='$user_id' and topic='$topic' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $number = mysqli_fetch_array($result_up);
  if ($number == 0) {
    if (!empty($_GET['page'])) {
      $cur_page = $_GET['page'];
    }
    else {
      $cur_page = 1;
    }
	$cur_page = mysqli_real_escape_string($dbc, trim($cur_page));
    $query_up = "insert into  intopics (`user_id`, `topic`, `time_up`, `page`) values ( '$user_id', '$topic', NOW(), '$cur_page')";
    $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД'); 
  } 
  else {
    if (!empty($_GET['page'])) {
      $cur_page = $_GET['page'];
    }
    else {
      $cur_page = $number['page'];
    }
    $query_up = "update intopics set time_up = NOW(), page = '$cur_page' where topic='$topic' and user_id='$user_id'";
    $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД'); 
  }
  if ($cur_page == 1) {
    $avtor_id = $row['avtor'];
    $query_avt = "Select nick, gruppa, last_active, admin, moder from  users where id = '$avtor_id' limit 1";
    $result_avt = mysqli_query($dbc, $query_avt) or die ('Ошибка передачи запроса к БД');
    $row_avt = mysqli_fetch_array($result_avt);
	$last_active = $row_avt['last_active'];
  ?>
  <div class="stats">
  <p>
  <?php
  $last_active = strtotime("$last_active");
  $now = (date("Y-m-d H:i:s"));
  $now = strtotime("$now");
  $razn_last_act = ($now - $last_active);
  if ($row_avt['gruppa'] == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_avt['gruppa'] == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_avt['gruppa'] == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_avt['gruppa'] == 'mon') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
	 ?> <a href="topic.php?topic=<?php echo "$topic";?>&lol=<?php echo "$avtor_id";?>"><?php echo $row_avt['nick'];?></a> [<a href="profile.php?id=<?php echo "$avtor_id";?>"><img src="img/ico/profile.png" width="15" height ="15"/></a>]</p>
	 <p class="clothes" style="color:#FF0000;">[<?php echo $row['time_cre'];?>]</p>
	 <?php
	 }
	 $moderator = $_GET['moderator'];
	 if ($main == 0) {
	   if ($clan == $clan_us) {
	     if (6 <= $clan_rang_us) {
		 ?><p><img src="img/ico/point.png" /> <a href="topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&moderator=<?php if ($moderator == 1) {echo '0';} else {echo '1';} ?>">Модерировать</a></p>
	 <?php
		 }
		 else {
		   if ($avtor_id == $user_id) {
		     ?><p><img src="img/ico/point.png" /> Редактировать топик</p><?php
		   }
		 }
	   }
	   if ($moderator == 1 and 6 <= $clan_rang_us) {
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&type=1&page=<?php echo "$cur_page";?>"><?php if ($row['fix'] == 0) {?>Прикрепить топик<?php } else {?>Открепить топик<?php }?></a></p>
	 <?php
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&type=2&page=<?php echo "$cur_page";?>"><?php if ($row['close'] == 0) {?>Закрыть топик<?php } else {?>Открыть топик<?php }?></a></p>
	 <?php
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&type=3&page=<?php echo "$cur_page";?>">Переместить</a></p>
	 <?php
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&type=4&page=<?php echo "$cur_page";?>">Удалить топик</a></p>
	 <?php
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&type=5&page=<?php echo "$cur_page";?>">Изменить топик</a></p>
	 <?php
	   }
	 }
	 else {////////////////////////Главный форум
	   if ($admin_us == 1 or $admin_us == 2 or $admin_us == 3 or $moder_us == 1) {
		 ?><p><img src="img/ico/point.png" /> <a href="topic.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&moderator=<?php if ($moderator == 1) {echo '0';} else {echo '1';} ?>">Модерировать</a></p>
	  <?php
	    if ($moderator == 1) {
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&type=1"><?php if ($row['fix'] == 0) {?>Прикрепить топик<?php } else {?>Открепить топик<?php }?></a></p>
	 <?php
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&type=2"><?php if ($row['close'] == 0) {?>Закрыть топик<?php } else {?>Открыть топик<?php }?></a></p>
	 <?php
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&type=4">Удалить топик</a></p>
	 <?php
	   if ($admin_us == 3 and $avtor_id == $user_id) {
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&type=5">Изменить топик</a></p>
	 <?php }
	   if ($admin_us == 2 or $admin_us == 1 or $moder_us == 1) {
	   ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&type=5">Изменить топик</a></p>
	 <?php }
	   }
	   }
	   else {
	     if ($avtor_id == $user_id) {
		  ?><p><img src="img/ico/point.png" /> <a href="moderator.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&type=5">Редактировать топик</a></p>
	  <?php
		 }
	   }
	 }
	 if ($cur_page == 1) {
	 ?>
	 
	 <div class="zx" style="padding-top:3px; margin-top:6px;">
<?php
$text = $row['text'];
require_once('inc_smiles.php');
$text1 = $text;
?>
	 <p <?php if ($row_avt['admin'] == 1 or $row_avt['moder'] == 1) {?>class="admin_msg"<?php } else {?> class="white"<?php }?>><?php echo "$text1";?></p>
	 </div>
  </div><?php
  }
  $query_avt = "Select id_com from  comments where id_top = '$topic'";
  $result_avt = mysqli_query($dbc, $query_avt) or die ('Ошибка передачи запроса к БД');
  $count = mysqli_num_rows($result_avt);
  ?>
<?php
$query_num = "Select read_id from read_top where top='$topic' and user = '530' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$totaladm = mysqli_num_rows($result_num);
$query_num = "Select read_id from read_top where top='$topic' and user = '$user_id' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total = mysqli_num_rows($result_num);
$query_num = "Select read_id from read_top where top='$topic' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД50');
$total1 = mysqli_num_rows($result_num);
?>
<?php
if (empty($total)) {
$query_add_ch = "insert into read_top (`top`, `user`) values ('$topic', '$user_id')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
$total1 = ($total1 + '1');
}
?>
  <div class="stats" style="padding-top:6px; padding-bottom:6px;">
  <p class="white"><b>Просмотров (<?php echo "$total1";?>)</b> <?php if (!empty($totaladm)) {?><span class="bonus"><small>(<img src="img/ok.png" width="10" height="10"/>Просмотрено администратором)</small></span><?php }?></p>
  <p class="white"><b>Комментариев (<?php echo "$count";?>)</b></p>
  </div><?php
  if ($count <> 0) {
      $user_id = $_SESSION['id'];
    $result_per_page = 10;
    $skip = (($cur_page - 1) * $result_per_page);
    $num_page = ceil($count / $result_per_page);
    if ($num_page > 0) {
	  $query_sub = "Select avtor, text, time_cre, id_com, dlya  from  comments where id_top = '$topic'  order by time_cre asc limit $skip, $result_per_page";
      $result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
      while ($row_sub = mysqli_fetch_array($result_sub)) {
	    $avtor_id = $row_sub['avtor'];
$dlya = $row_sub['dlya'];
        $query_avt = "Select nick, gruppa, last_active, admin, moder from  users where id = '$avtor_id' limit 1";
        $result_avt = mysqli_query($dbc, $query_avt) or die ('Ошибка передачи запроса к БД');
        $row_avt = mysqli_fetch_array($result_avt);
	    $last_active = $row_avt['last_active'];
		$last_active = strtotime("$last_active");
        $now = (date("Y-m-d H:i:s"));
        $now = strtotime("$now");
        $razn_last_act = ($now - $last_active);
		?>

<?php
$text = $row_sub['text'];
require_once('inc_smiles.php');
?>

<div class="comments"><?php
  if ($row_avt['gruppa'] == 'svoboda') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_avt['gruppa'] == 'dolg') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_avt['gruppa'] == 'naemniki') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }}
	  if ($row_avt['gruppa'] == 'mon') {if ($razn_last_act < 1800 ) {?><img src="img/ico/on.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php } else {?><img src="img/ico/off.png" width="12" height="12" alt="н"/><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }}
	 ?> <a href="topic.php?topic=<?php echo "$topic";?>&lol=<?php echo "$avtor_id";?>"><?php echo $row_avt['nick'];?></a> [<a href="profile.php?id=<?php echo "$avtor_id";?>"><img src="img/ico/profile.png" width="15" height ="15"/></a>]</p>
	 <p class="clothes" style="color:#555555;">[<?php echo $row_sub['time_cre'];?>]</p>
	 <p <?php if ($row_avt['admin'] == '1' and $dlya != $user_id) {?>class="admin_msg"<?php }
if ($row_avt['moder'] == '1' and $dlya != $user_id) {?>class="moder_msg"<?php }
if ($dlya == $user_id) {?>class="net"<?php }?>><?php echo "$text";?></p>
	 <p><?php
	   if ($main == 1) {
	     if ($moderator == 1) {
	       if ($admin_us == 1 or $admin_us == 2 or $admin_us == 3 or $moder_us == 1) {
	         ?>[<a href="moderator.php?comment=<?php echo $row_sub['id_com'];?>&type=6&page=<?php echo "$cur_page";?>">скрыть</a>] 
			 <?php
			 if ($admin_us == 1 or $admin_us == 2 or $moder_us == 1) {
			   if ($row_avt['admin'] <> 1 and $row_avt['admin'] <> 2) {
			   ?>[<a href="moderator.php?comment=<?php echo $row_sub['id_com'];?>&type=9&page=<?php echo "$cur_page";?>">DEL</a>]<?php
			   }
			   else {
			     if($avtor_id == $user_id) {
				 ?>[<a href="moderator.php?comment=<?php echo $row_sub['id_com'];?>&type=9&page=<?php echo "$cur_page";?>">DEL</a>]<?php
				 }
			   }
			 }
			 if ($row_avt['moder'] <> 1 and $row_avt['admin'] <> 1 and $row_avt['admin'] <> 2 and $row_avt['admin'] <> 3) {?>
			   [<a href="moderator.php?avtor=<?php echo "$avtor_id";?>&type=7&page=<?php echo "$cur_page";?>&topic=<?php echo "$topic";?>">бан на форум</a>]<?php 
			 }
			 if ($admin_us == 1 or $admin_us == 2 or $moder_us == 1) {
			   if ($row_avt['admin'] <> 1 and $row_avt['admin'] <> 2 and $row_avt['moder'] <> 1) {
	         ?> [<a href="moderator.php?profile=<?php echo "$avtor_id";?>&type=8&page=<?php echo "$cur_page";?>&topic=<?php echo "$topic";?>">бан на игру</a>] <?php
			   }
			 }
	       }
		 }
	   }
	   else {
	     if ($clan == $clan_us) {
		   if ($moderator == 1) {
	         if ($cre <= $clan_rang_us) {?>[<a href="moderator.php?comment=<?php echo $row_sub['id_com'];?>&type=9&page=<?php echo "$cur_page";?>">удалить</a>]<?php }
		   }
		 }
	   }
	   ?></p>
	 </div>
	 <?php
      }
    }
  }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself". '?topic=' .$topic.  '&page=1"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself". '?topic=' .$topic.  '&page=' . ($cur_page-1) . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself". '?topic=' .$topic.  '&page=' . ($cur_page-3)?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself". '?topic=' .$topic.  '&page=' . ($cur_page-2)?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself". '?topic=' .$topic.  '&page=' . ($cur_page-1)?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself". '?topic=' .$topic.  '&page=' . ($cur_page+1)?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself". '?topic=' .$topic.  '&page=' . ($cur_page+2)?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself". '?topic=' .$topic.  '&page=' . ($cur_page+3)?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?topic=' .$topic.  '&page=' . ($cur_page+1) . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" . '?topic=' .$topic.  '&page=' . $num_page . '">>></a> ';
    }
	else {
	  echo ' >>';
	}
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ($count <> 1000) {
  if ($admin_us <> 1 and $admin_us <> 2 and $admin_us <> 3 and $moder_us <> 1) {
  if ($row['close'] <> 1) {
    if ($main == 0) {
      if ($clan == $clan_us) {
	    if ($com <= $clan_rang_us) {
	      ?>
<?php if ($ban_f == '0') {?>
	      <div class="stats">
          <p>Сообщение:</p>
          <form enctype="multipart/form-data" method="post" action="addcomments.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&id=<?php echo "$lol";?>">
          <textarea rows="2" cols="35px" name="text"><?php echo "$nick_dfd" ; ?> </textarea>
          <div class="knopka">
          <input type="submit" style="width:67px;" class="input" value="Отправить" name="addad"/>
          </div>
          </form>
<?php } else {?>
<p class="red">Вы были забанены на форуме.<br/>
Причина: <?php echo "$wtf2";?>.<br/>
Модератор: <a href="user.php?id=<?php echo "$mod_id2";?>"><?php echo "$mn2";?></a>.<br/>
Разбан через: <?php
$time11 = $btf;
if ($time11 < '60') {?><?php echo "$time11";?>сек.<?php }
if ($time11 > '59' and $time11 < '120') {?>1мин.<?php }
if ($time11 > '119' and $time11 < '180') {?>2мин.<?php }
if ($time11 > '179' and $time11 < '240') {?>3мин.<?php }
if ($time11 > '239' and $time11 < '300') {?>4мин.<?php }
if ($time11 > '299' and $time11 < '360') {?>5мин.<?php }
if ($time11 > '359' and $time11 < '420') {?>6мин.<?php }
if ($time11 > '419' and $time11 < '480') {?>7мин.<?php }
if ($time11 > '479' and $time11 < '540') {?>8мин.<?php }
if ($time11 > '539' and $time11 < '600') {?>9мин.<?php }
if ($time11 > '599' and $time11 < '660') {?>10мин.<?php }
if ($time11 > '659' and $time11 < '720') {?>11мин.<?php }
if ($time11 > '719' and $time11 < '780') {?>12мин.<?php }
if ($time11 > '779' and $time11 < '840') {?>13мин.<?php }
if ($time11 > '839' and $time11 < '900') {?>14мин.<?php }
if ($time11 > '899' and $time11 < '960') {?>15мин.<?php }
if ($time11 > '959' and $time11 < '1020') {?>16мин.<?php }
if ($time11 > '1019' and $time11 < '1080') {?>17мин.<?php }
if ($time11 > '1079' and $time11 < '1140') {?>18мин.<?php }
if ($time11 > '1139' and $time11 < '1200') {?>19мин.<?php }
if ($time11 > '1199' and $time11 < '1260') {?>20мин.<?php }
if ($time11 > '1259' and $time11 < '1320') {?>21мин.<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22мин.<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23мин.<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24мин.<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25мин.<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26мин.<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27мин.<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28мин.<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29мин.<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30мин.<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31мин.<?php }
if ($time11 > '1919' and $time11 < '1980') {?>32мин.<?php }
if ($time11 > '1979' and $time11 < '2040') {?>33мин.<?php }
if ($time11 > '2039' and $time11 < '2100') {?>34мин.<?php }
if ($time11 > '2099' and $time11 < '2160') {?>35мин.<?php }
if ($time11 > '2159' and $time11 < '2220') {?>36мин.<?php }
if ($time11 > '2219' and $time11 < '2280') {?>37мин.<?php }
if ($time11 > '2279' and $time11 < '2340') {?>38мин.<?php }
if ($time11 > '2339' and $time11 < '2400') {?>39мин.<?php }
if ($time11 > '2399' and $time11 < '2460') {?>40мин.<?php }
if ($time11 > '2459' and $time11 < '2520') {?>41мин.<?php }
if ($time11 > '2519' and $time11 < '2580') {?>42мин.<?php }
if ($time11 > '2579' and $time11 < '2640') {?>43мин.<?php }
if ($time11 > '2639' and $time11 < '2700') {?>44мин.<?php }
if ($time11 > '2699' and $time11 < '2760') {?>45мин.<?php }
if ($time11 > '2759' and $time11 < '2820') {?>46мин.<?php }
if ($time11 > '2819' and $time11 < '2880') {?>47мин.<?php }
if ($time11 > '2879' and $time11 < '2940') {?>48мин.<?php }
if ($time11 > '2939' and $time11 < '3000') {?>49мин.<?php }
if ($time11 > '2999' and $time11 < '3060') {?>50мин.<?php }
if ($time11 > '3059' and $time11 < '3120') {?>51мин.<?php }
if ($time11 > '3119' and $time11 < '3180') {?>52мин.<?php }
if ($time11 > '3179' and $time11 < '3240') {?>53мин.<?php }
if ($time11 > '3239' and $time11 < '3300') {?>54мин.<?php }
if ($time11 > '3299' and $time11 < '3360') {?>55мин.<?php }
if ($time11 > '3359' and $time11 < '3420') {?>56мин.<?php }
if ($time11 > '3419' and $time11 < '3480') {?>57мин.<?php }
if ($time11 > '3479' and $time11 < '3540') {?>58мин.<?php }
if ($time11 > '3539' and $time11 < '3600') {?>59мин.<?php }
if ($time11 > '3599' and $time11 < '3660') {?>60мин.<?php }
if ($time11 > '3659' and $time11 < '7200') {?>1час.<?php }
if ($time11 > '7199' and $time11 < '10800') {?>2час.<?php }
if ($time11 > '10799' and $time11 < '14400') {?>3час.<?php }
if ($time11 > '14399' and $time11 < '18000') {?>4час.<?php }
if ($time11 > '17999' and $time11 < '21600') {?>5час.<?php }
if ($time11 > '21599' and $time11 < '25200') {?>6час.<?php }
if ($time11 > '25199' and $time11 < '28800') {?>7час.<?php }
if ($time11 > '28799' and $time11 < '32400') {?>8час.<?php }
if ($time11 > '32399' and $time11 < '36000') {?>9час.<?php }
if ($time11 > '35999' and $time11 < '39600') {?>10час.<?php }
if ($time11 > '39599' and $time11 < '43200') {?>11час.<?php }
if ($time11 > '43199' and $time11 < '46800') {?>12час.<?php }
if ($time11 > '46799' and $time11 < '50400') {?>13час.<?php }
if ($time11 > '50399' and $time11 < '54000') {?>14час.<?php }
if ($time11 > '53999' and $time11 < '57600') {?>15час.<?php }
if ($time11 > '57599' and $time11 < '61200') {?>16час.<?php }
if ($time11 > '61199' and $time11 < '64800') {?>17час.<?php }
if ($time11 > '64799' and $time11 < '68400') {?>18час.<?php }
if ($time11 > '68399' and $time11 < '72000') {?>19час.<?php }
if ($time11 > '71999' and $time11 < '75600') {?>20час.<?php }
if ($time11 > '75599' and $time11 < '79200') {?>21час.<?php }
if ($time11 > '79199' and $time11 < '82800') {?>22час.<?php }
if ($time11 > '82799' and $time11 < '86400') {?>23час.<?php }
if ($time11 > '86399' and $time11 < '90000') {?>1день<?php }
if ($time11 > '89999' and $time11 < '172800') {?>2дня<?php }
if ($time11 > '172799' and $time11 < '259200') {?>3дня<?php }
if ($time11 > '259199' and $time11 < '345600') {?>4дня<?php }
if ($time11 > '345599' and $time11 < '432000') {?>5дней<?php }
if ($time11 > '431999' and $time11 < '518400') {?>6дней<?php }
if ($time11 > '518399' and $time11 < '619200') {?>7дней<?php }
if ($time11 > '619199' and $time11 < '777600') {?>8дней<?php }
if ($time11 > '777599' and $time11 < '864000') {?>9дней<?php }
if ($time11 > '863999' and $time11 < '950400') {?>10дней<?php }
if ($time11 > '950399' and $time11 < '1036800') {?>11дней<?php }
if ($time11 > '1036799' and $time11 < '1123200') {?>12дней<?php }
if ($time11 > '1123199' and $time11 < '1209600') {?>13дней<?php }
if ($time11 > '1209599' and $time11 < '1296000') {?>14дней<?php }
if ($time11 > '1295999' and $time11 < '1382400') {?>15дней<?php }
if ($time11 > '1382399' and $time11 < '1468800') {?>16дней<?php }
if ($time11 > '1468799' and $time11 < '1555200') {?>17дней<?php }
if ($time11 > '1555199' and $time11 < '1641600') {?>18дней<?php }
if ($time11 > '1641599' and $time11 < '1728000') {?>19дней<?php }
if ($time11 > '1727999' and $time11 < '1814400') {?>20дней<?php }
if ($time11 > '1814399' and $time11 < '1900800') {?>21день<?php }
if ($time11 > '1900799' and $time11 < '1987200') {?>22дня<?php }
if ($time11 > '1987199' and $time11 < '2073600') {?>23дня<?php }
if ($time11 > '2073599' and $time11 < '2160000') {?>24дня<?php }
if ($time11 > '2159999' and $time11 < '2246400') {?>25дней<?php }
if ($time11 > '2246399' and $time11 < '2332800') {?>26дней<?php }
if ($time11 > '2332799' and $time11 < '2419200') {?>27дней<?php }
if ($time11 > '2419199' and $time11 < '2505600') {?>28дней<?php }
if ($time11 > '2505599' and $time11 < '2592000') {?>29дней<?php }
if ($time11 > '2591999' and $time11 < '5184000') {?>1мес.<?php }
if ($time11 > '5183999' and $time11 < '7776000') {?>2мес.<?php }
if ($time11 > '7775999' and $time11 < '10368000') {?>3мес.<?php }
?></p>
<?php }?>
          </div> 
	      <?php
	    } 
	    else {
	    ?>
	    <div id="error">
	    <p>>>> У вас недостаточно прав для комментирования этого топика <<<</p>
	    </div>
	    <?php
	    }  
	  }
	  else {
	    if ($com == 0 and $gruppa == $gruppa_us) {
		  ?>
<?php if ($ban_f == '0') {?>
	      <div class="stats">
          <p>Сообщение:</p>
          <form enctype="multipart/form-data" method="post" action="addcomments.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&id=<?php echo "$lol";?>">
          <textarea rows="2" cols="35px" name="text"><?php echo "$nick_dfd" ; ?> </textarea>
          <div class="knopka">
          <input type="submit" style="width:67px;" class="input" value="Отправить" name="addad"/>
          </div>
          </form>
<?php } else {?>
<p class="red">Вы были забанены на форуме.<br/>
Причина: <?php echo "$wtf2";?>.<br/>
Модератор: <a href="user.php?id=<?php echo "$mod_id2";?>"><?php echo "$mn2";?></a>.<br/>
Разбан через: <?php
$time11 = $btf;
if ($time11 < '60') {?><?php echo "$time11";?>сек.<?php }
if ($time11 > '59' and $time11 < '120') {?>1мин.<?php }
if ($time11 > '119' and $time11 < '180') {?>2мин.<?php }
if ($time11 > '179' and $time11 < '240') {?>3мин.<?php }
if ($time11 > '239' and $time11 < '300') {?>4мин.<?php }
if ($time11 > '299' and $time11 < '360') {?>5мин.<?php }
if ($time11 > '359' and $time11 < '420') {?>6мин.<?php }
if ($time11 > '419' and $time11 < '480') {?>7мин.<?php }
if ($time11 > '479' and $time11 < '540') {?>8мин.<?php }
if ($time11 > '539' and $time11 < '600') {?>9мин.<?php }
if ($time11 > '599' and $time11 < '660') {?>10мин.<?php }
if ($time11 > '659' and $time11 < '720') {?>11мин.<?php }
if ($time11 > '719' and $time11 < '780') {?>12мин.<?php }
if ($time11 > '779' and $time11 < '840') {?>13мин.<?php }
if ($time11 > '839' and $time11 < '900') {?>14мин.<?php }
if ($time11 > '899' and $time11 < '960') {?>15мин.<?php }
if ($time11 > '959' and $time11 < '1020') {?>16мин.<?php }
if ($time11 > '1019' and $time11 < '1080') {?>17мин.<?php }
if ($time11 > '1079' and $time11 < '1140') {?>18мин.<?php }
if ($time11 > '1139' and $time11 < '1200') {?>19мин.<?php }
if ($time11 > '1199' and $time11 < '1260') {?>20мин.<?php }
if ($time11 > '1259' and $time11 < '1320') {?>21мин.<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22мин.<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23мин.<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24мин.<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25мин.<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26мин.<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27мин.<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28мин.<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29мин.<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30мин.<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31мин.<?php }
if ($time11 > '1919' and $time11 < '1980') {?>32мин.<?php }
if ($time11 > '1979' and $time11 < '2040') {?>33мин.<?php }
if ($time11 > '2039' and $time11 < '2100') {?>34мин.<?php }
if ($time11 > '2099' and $time11 < '2160') {?>35мин.<?php }
if ($time11 > '2159' and $time11 < '2220') {?>36мин.<?php }
if ($time11 > '2219' and $time11 < '2280') {?>37мин.<?php }
if ($time11 > '2279' and $time11 < '2340') {?>38мин.<?php }
if ($time11 > '2339' and $time11 < '2400') {?>39мин.<?php }
if ($time11 > '2399' and $time11 < '2460') {?>40мин.<?php }
if ($time11 > '2459' and $time11 < '2520') {?>41мин.<?php }
if ($time11 > '2519' and $time11 < '2580') {?>42мин.<?php }
if ($time11 > '2579' and $time11 < '2640') {?>43мин.<?php }
if ($time11 > '2639' and $time11 < '2700') {?>44мин.<?php }
if ($time11 > '2699' and $time11 < '2760') {?>45мин.<?php }
if ($time11 > '2759' and $time11 < '2820') {?>46мин.<?php }
if ($time11 > '2819' and $time11 < '2880') {?>47мин.<?php }
if ($time11 > '2879' and $time11 < '2940') {?>48мин.<?php }
if ($time11 > '2939' and $time11 < '3000') {?>49мин.<?php }
if ($time11 > '2999' and $time11 < '3060') {?>50мин.<?php }
if ($time11 > '3059' and $time11 < '3120') {?>51мин.<?php }
if ($time11 > '3119' and $time11 < '3180') {?>52мин.<?php }
if ($time11 > '3179' and $time11 < '3240') {?>53мин.<?php }
if ($time11 > '3239' and $time11 < '3300') {?>54мин.<?php }
if ($time11 > '3299' and $time11 < '3360') {?>55мин.<?php }
if ($time11 > '3359' and $time11 < '3420') {?>56мин.<?php }
if ($time11 > '3419' and $time11 < '3480') {?>57мин.<?php }
if ($time11 > '3479' and $time11 < '3540') {?>58мин.<?php }
if ($time11 > '3539' and $time11 < '3600') {?>59мин.<?php }
if ($time11 > '3599' and $time11 < '3660') {?>60мин.<?php }
if ($time11 > '3659' and $time11 < '7200') {?>1час.<?php }
if ($time11 > '7199' and $time11 < '10800') {?>2час.<?php }
if ($time11 > '10799' and $time11 < '14400') {?>3час.<?php }
if ($time11 > '14399' and $time11 < '18000') {?>4час.<?php }
if ($time11 > '17999' and $time11 < '21600') {?>5час.<?php }
if ($time11 > '21599' and $time11 < '25200') {?>6час.<?php }
if ($time11 > '25199' and $time11 < '28800') {?>7час.<?php }
if ($time11 > '28799' and $time11 < '32400') {?>8час.<?php }
if ($time11 > '32399' and $time11 < '36000') {?>9час.<?php }
if ($time11 > '35999' and $time11 < '39600') {?>10час.<?php }
if ($time11 > '39599' and $time11 < '43200') {?>11час.<?php }
if ($time11 > '43199' and $time11 < '46800') {?>12час.<?php }
if ($time11 > '46799' and $time11 < '50400') {?>13час.<?php }
if ($time11 > '50399' and $time11 < '54000') {?>14час.<?php }
if ($time11 > '53999' and $time11 < '57600') {?>15час.<?php }
if ($time11 > '57599' and $time11 < '61200') {?>16час.<?php }
if ($time11 > '61199' and $time11 < '64800') {?>17час.<?php }
if ($time11 > '64799' and $time11 < '68400') {?>18час.<?php }
if ($time11 > '68399' and $time11 < '72000') {?>19час.<?php }
if ($time11 > '71999' and $time11 < '75600') {?>20час.<?php }
if ($time11 > '75599' and $time11 < '79200') {?>21час.<?php }
if ($time11 > '79199' and $time11 < '82800') {?>22час.<?php }
if ($time11 > '82799' and $time11 < '86400') {?>23час.<?php }
if ($time11 > '86399' and $time11 < '90000') {?>1день<?php }
if ($time11 > '89999' and $time11 < '172800') {?>2дня<?php }
if ($time11 > '172799' and $time11 < '259200') {?>3дня<?php }
if ($time11 > '259199' and $time11 < '345600') {?>4дня<?php }
if ($time11 > '345599' and $time11 < '432000') {?>5дней<?php }
if ($time11 > '431999' and $time11 < '518400') {?>6дней<?php }
if ($time11 > '518399' and $time11 < '619200') {?>7дней<?php }
if ($time11 > '619199' and $time11 < '777600') {?>8дней<?php }
if ($time11 > '777599' and $time11 < '864000') {?>9дней<?php }
if ($time11 > '863999' and $time11 < '950400') {?>10дней<?php }
if ($time11 > '950399' and $time11 < '1036800') {?>11дней<?php }
if ($time11 > '1036799' and $time11 < '1123200') {?>12дней<?php }
if ($time11 > '1123199' and $time11 < '1209600') {?>13дней<?php }
if ($time11 > '1209599' and $time11 < '1296000') {?>14дней<?php }
if ($time11 > '1295999' and $time11 < '1382400') {?>15дней<?php }
if ($time11 > '1382399' and $time11 < '1468800') {?>16дней<?php }
if ($time11 > '1468799' and $time11 < '1555200') {?>17дней<?php }
if ($time11 > '1555199' and $time11 < '1641600') {?>18дней<?php }
if ($time11 > '1641599' and $time11 < '1728000') {?>19дней<?php }
if ($time11 > '1727999' and $time11 < '1814400') {?>20дней<?php }
if ($time11 > '1814399' and $time11 < '1900800') {?>21день<?php }
if ($time11 > '1900799' and $time11 < '1987200') {?>22дня<?php }
if ($time11 > '1987199' and $time11 < '2073600') {?>23дня<?php }
if ($time11 > '2073599' and $time11 < '2160000') {?>24дня<?php }
if ($time11 > '2159999' and $time11 < '2246400') {?>25дней<?php }
if ($time11 > '2246399' and $time11 < '2332800') {?>26дней<?php }
if ($time11 > '2332799' and $time11 < '2419200') {?>27дней<?php }
if ($time11 > '2419199' and $time11 < '2505600') {?>28дней<?php }
if ($time11 > '2505599' and $time11 < '2592000') {?>29дней<?php }
if ($time11 > '2591999' and $time11 < '5184000') {?>1мес.<?php }
if ($time11 > '5183999' and $time11 < '7776000') {?>2мес.<?php }
if ($time11 > '7775999' and $time11 < '10368000') {?>3мес.<?php }
?></p>
<?php }?>
          </div> 
	      <?php
		}
		else {
	      ?>
	      <div id="error">
	      <p>>>> Вы не можете комментировать эту тему <<<</p>
	      </div>
	      <?php
	    }
	  }
    }
	else {
	  if ($lvl_us >= 10) {
	    if ($gruppa == $gruppa_us or $gruppa == 'all' and $f_ban_us <> 1) {
		  ?>
<?php if ($ban_f == '0') {?>
	      <div class="stats">
          <p>Сообщение:</p>
          <form enctype="multipart/form-data" method="post" action="addcomments.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&id=<?php echo "$lol";?>">
          <textarea rows="2" cols="35px" name="text"><?php echo "$nick_dfd" ; ?> </textarea>
          <div class="knopka">
          <input type="submit" style="width:67px;" class="input" value="Отправить" name="addad"/>
          </div>
          </form>
<?php } else {?>
<p class="red">Вы были забанены на форуме.<br/>
Причина: <?php echo "$wtf2";?>.<br/>
Модератор: <a href="user.php?id=<?php echo "$mod_id2";?>"><?php echo "$mn2";?></a>.<br/>
Разбан через: <?php
$time11 = $btf;
if ($time11 < '60') {?><?php echo "$time11";?>сек.<?php }
if ($time11 > '59' and $time11 < '120') {?>1мин.<?php }
if ($time11 > '119' and $time11 < '180') {?>2мин.<?php }
if ($time11 > '179' and $time11 < '240') {?>3мин.<?php }
if ($time11 > '239' and $time11 < '300') {?>4мин.<?php }
if ($time11 > '299' and $time11 < '360') {?>5мин.<?php }
if ($time11 > '359' and $time11 < '420') {?>6мин.<?php }
if ($time11 > '419' and $time11 < '480') {?>7мин.<?php }
if ($time11 > '479' and $time11 < '540') {?>8мин.<?php }
if ($time11 > '539' and $time11 < '600') {?>9мин.<?php }
if ($time11 > '599' and $time11 < '660') {?>10мин.<?php }
if ($time11 > '659' and $time11 < '720') {?>11мин.<?php }
if ($time11 > '719' and $time11 < '780') {?>12мин.<?php }
if ($time11 > '779' and $time11 < '840') {?>13мин.<?php }
if ($time11 > '839' and $time11 < '900') {?>14мин.<?php }
if ($time11 > '899' and $time11 < '960') {?>15мин.<?php }
if ($time11 > '959' and $time11 < '1020') {?>16мин.<?php }
if ($time11 > '1019' and $time11 < '1080') {?>17мин.<?php }
if ($time11 > '1079' and $time11 < '1140') {?>18мин.<?php }
if ($time11 > '1139' and $time11 < '1200') {?>19мин.<?php }
if ($time11 > '1199' and $time11 < '1260') {?>20мин.<?php }
if ($time11 > '1259' and $time11 < '1320') {?>21мин.<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22мин.<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23мин.<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24мин.<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25мин.<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26мин.<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27мин.<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28мин.<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29мин.<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30мин.<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31мин.<?php }
if ($time11 > '1919' and $time11 < '1980') {?>32мин.<?php }
if ($time11 > '1979' and $time11 < '2040') {?>33мин.<?php }
if ($time11 > '2039' and $time11 < '2100') {?>34мин.<?php }
if ($time11 > '2099' and $time11 < '2160') {?>35мин.<?php }
if ($time11 > '2159' and $time11 < '2220') {?>36мин.<?php }
if ($time11 > '2219' and $time11 < '2280') {?>37мин.<?php }
if ($time11 > '2279' and $time11 < '2340') {?>38мин.<?php }
if ($time11 > '2339' and $time11 < '2400') {?>39мин.<?php }
if ($time11 > '2399' and $time11 < '2460') {?>40мин.<?php }
if ($time11 > '2459' and $time11 < '2520') {?>41мин.<?php }
if ($time11 > '2519' and $time11 < '2580') {?>42мин.<?php }
if ($time11 > '2579' and $time11 < '2640') {?>43мин.<?php }
if ($time11 > '2639' and $time11 < '2700') {?>44мин.<?php }
if ($time11 > '2699' and $time11 < '2760') {?>45мин.<?php }
if ($time11 > '2759' and $time11 < '2820') {?>46мин.<?php }
if ($time11 > '2819' and $time11 < '2880') {?>47мин.<?php }
if ($time11 > '2879' and $time11 < '2940') {?>48мин.<?php }
if ($time11 > '2939' and $time11 < '3000') {?>49мин.<?php }
if ($time11 > '2999' and $time11 < '3060') {?>50мин.<?php }
if ($time11 > '3059' and $time11 < '3120') {?>51мин.<?php }
if ($time11 > '3119' and $time11 < '3180') {?>52мин.<?php }
if ($time11 > '3179' and $time11 < '3240') {?>53мин.<?php }
if ($time11 > '3239' and $time11 < '3300') {?>54мин.<?php }
if ($time11 > '3299' and $time11 < '3360') {?>55мин.<?php }
if ($time11 > '3359' and $time11 < '3420') {?>56мин.<?php }
if ($time11 > '3419' and $time11 < '3480') {?>57мин.<?php }
if ($time11 > '3479' and $time11 < '3540') {?>58мин.<?php }
if ($time11 > '3539' and $time11 < '3600') {?>59мин.<?php }
if ($time11 > '3599' and $time11 < '3660') {?>60мин.<?php }
if ($time11 > '3659' and $time11 < '7200') {?>1час.<?php }
if ($time11 > '7199' and $time11 < '10800') {?>2час.<?php }
if ($time11 > '10799' and $time11 < '14400') {?>3час.<?php }
if ($time11 > '14399' and $time11 < '18000') {?>4час.<?php }
if ($time11 > '17999' and $time11 < '21600') {?>5час.<?php }
if ($time11 > '21599' and $time11 < '25200') {?>6час.<?php }
if ($time11 > '25199' and $time11 < '28800') {?>7час.<?php }
if ($time11 > '28799' and $time11 < '32400') {?>8час.<?php }
if ($time11 > '32399' and $time11 < '36000') {?>9час.<?php }
if ($time11 > '35999' and $time11 < '39600') {?>10час.<?php }
if ($time11 > '39599' and $time11 < '43200') {?>11час.<?php }
if ($time11 > '43199' and $time11 < '46800') {?>12час.<?php }
if ($time11 > '46799' and $time11 < '50400') {?>13час.<?php }
if ($time11 > '50399' and $time11 < '54000') {?>14час.<?php }
if ($time11 > '53999' and $time11 < '57600') {?>15час.<?php }
if ($time11 > '57599' and $time11 < '61200') {?>16час.<?php }
if ($time11 > '61199' and $time11 < '64800') {?>17час.<?php }
if ($time11 > '64799' and $time11 < '68400') {?>18час.<?php }
if ($time11 > '68399' and $time11 < '72000') {?>19час.<?php }
if ($time11 > '71999' and $time11 < '75600') {?>20час.<?php }
if ($time11 > '75599' and $time11 < '79200') {?>21час.<?php }
if ($time11 > '79199' and $time11 < '82800') {?>22час.<?php }
if ($time11 > '82799' and $time11 < '86400') {?>23час.<?php }
if ($time11 > '86399' and $time11 < '90000') {?>1день<?php }
if ($time11 > '89999' and $time11 < '172800') {?>2дня<?php }
if ($time11 > '172799' and $time11 < '259200') {?>3дня<?php }
if ($time11 > '259199' and $time11 < '345600') {?>4дня<?php }
if ($time11 > '345599' and $time11 < '432000') {?>5дней<?php }
if ($time11 > '431999' and $time11 < '518400') {?>6дней<?php }
if ($time11 > '518399' and $time11 < '619200') {?>7дней<?php }
if ($time11 > '619199' and $time11 < '777600') {?>8дней<?php }
if ($time11 > '777599' and $time11 < '864000') {?>9дней<?php }
if ($time11 > '863999' and $time11 < '950400') {?>10дней<?php }
if ($time11 > '950399' and $time11 < '1036800') {?>11дней<?php }
if ($time11 > '1036799' and $time11 < '1123200') {?>12дней<?php }
if ($time11 > '1123199' and $time11 < '1209600') {?>13дней<?php }
if ($time11 > '1209599' and $time11 < '1296000') {?>14дней<?php }
if ($time11 > '1295999' and $time11 < '1382400') {?>15дней<?php }
if ($time11 > '1382399' and $time11 < '1468800') {?>16дней<?php }
if ($time11 > '1468799' and $time11 < '1555200') {?>17дней<?php }
if ($time11 > '1555199' and $time11 < '1641600') {?>18дней<?php }
if ($time11 > '1641599' and $time11 < '1728000') {?>19дней<?php }
if ($time11 > '1727999' and $time11 < '1814400') {?>20дней<?php }
if ($time11 > '1814399' and $time11 < '1900800') {?>21день<?php }
if ($time11 > '1900799' and $time11 < '1987200') {?>22дня<?php }
if ($time11 > '1987199' and $time11 < '2073600') {?>23дня<?php }
if ($time11 > '2073599' and $time11 < '2160000') {?>24дня<?php }
if ($time11 > '2159999' and $time11 < '2246400') {?>25дней<?php }
if ($time11 > '2246399' and $time11 < '2332800') {?>26дней<?php }
if ($time11 > '2332799' and $time11 < '2419200') {?>27дней<?php }
if ($time11 > '2419199' and $time11 < '2505600') {?>28дней<?php }
if ($time11 > '2505599' and $time11 < '2592000') {?>29дней<?php }
if ($time11 > '2591999' and $time11 < '5184000') {?>1мес.<?php }
if ($time11 > '5183999' and $time11 < '7776000') {?>2мес.<?php }
if ($time11 > '7775999' and $time11 < '10368000') {?>3мес.<?php }
?></p>
<?php }?>
          </div> 
	      <?php
		}
		else {
		  ?>
          <div id="error">
          <p>>>> Вы не можете комментировать эту тему <<<</p>
          </div>
        <?php
		}
	  } 
	  else {
	    ?>
        <div id="error">
        <p>>>> Чтобы писать в форуме - получите 10 уровень <<<</p>
        </div>
        <?php
	  }
	}
  } 
  else {
  ?>
  <div id="error">
  <p>>>> Тема закрыта <<<</p>
  </div>
  <?php
  }
  }
  else {
    if ($row['close'] <> 1) {
    ?>
<?php if ($ban_f == '0') {?>
	      <div class="stats">
          <p>Сообщение:</p>
          <form enctype="multipart/form-data" method="post" action="addcomments.php?topic=<?php echo "$topic";?>&page=<?php echo "$cur_page";?>&id=<?php echo "$lol";?>">
          <textarea rows="2" cols="35px" name="text"><?php echo "$nick_dfd" ; ?> </textarea>
          <div class="knopka">
          <input type="submit" style="width:67px;" class="input" value="Отправить" name="addad"/>
          </div>
          </form>
<?php } else {?>
<p class="red">Вы были забанены на форуме.<br/>
Причина: <?php echo "$wtf2";?>.<br/>
Модератор: <a href="user.php?id=<?php echo "$mod_id2";?>"><?php echo "$mn2";?></a>.<br/>
Разбан через: <?php
$time11 = $btf;
if ($time11 < '60') {?><?php echo "$time11";?>сек.<?php }
if ($time11 > '59' and $time11 < '120') {?>1мин.<?php }
if ($time11 > '119' and $time11 < '180') {?>2мин.<?php }
if ($time11 > '179' and $time11 < '240') {?>3мин.<?php }
if ($time11 > '239' and $time11 < '300') {?>4мин.<?php }
if ($time11 > '299' and $time11 < '360') {?>5мин.<?php }
if ($time11 > '359' and $time11 < '420') {?>6мин.<?php }
if ($time11 > '419' and $time11 < '480') {?>7мин.<?php }
if ($time11 > '479' and $time11 < '540') {?>8мин.<?php }
if ($time11 > '539' and $time11 < '600') {?>9мин.<?php }
if ($time11 > '599' and $time11 < '660') {?>10мин.<?php }
if ($time11 > '659' and $time11 < '720') {?>11мин.<?php }
if ($time11 > '719' and $time11 < '780') {?>12мин.<?php }
if ($time11 > '779' and $time11 < '840') {?>13мин.<?php }
if ($time11 > '839' and $time11 < '900') {?>14мин.<?php }
if ($time11 > '899' and $time11 < '960') {?>15мин.<?php }
if ($time11 > '959' and $time11 < '1020') {?>16мин.<?php }
if ($time11 > '1019' and $time11 < '1080') {?>17мин.<?php }
if ($time11 > '1079' and $time11 < '1140') {?>18мин.<?php }
if ($time11 > '1139' and $time11 < '1200') {?>19мин.<?php }
if ($time11 > '1199' and $time11 < '1260') {?>20мин.<?php }
if ($time11 > '1259' and $time11 < '1320') {?>21мин.<?php }
if ($time11 > '1319' and $time11 < '1380') {?>22мин.<?php }
if ($time11 > '1379' and $time11 < '1440') {?>23мин.<?php }
if ($time11 > '1439' and $time11 < '1500') {?>24мин.<?php }
if ($time11 > '1499' and $time11 < '1560') {?>25мин.<?php }
if ($time11 > '1559' and $time11 < '1620') {?>26мин.<?php }
if ($time11 > '1619' and $time11 < '1680') {?>27мин.<?php }
if ($time11 > '1679' and $time11 < '1740') {?>28мин.<?php }
if ($time11 > '1739' and $time11 < '1800') {?>29мин.<?php }
if ($time11 > '1799' and $time11 < '1860') {?>30мин.<?php }
if ($time11 > '1859' and $time11 < '1920') {?>31мин.<?php }
if ($time11 > '1919' and $time11 < '1980') {?>32мин.<?php }
if ($time11 > '1979' and $time11 < '2040') {?>33мин.<?php }
if ($time11 > '2039' and $time11 < '2100') {?>34мин.<?php }
if ($time11 > '2099' and $time11 < '2160') {?>35мин.<?php }
if ($time11 > '2159' and $time11 < '2220') {?>36мин.<?php }
if ($time11 > '2219' and $time11 < '2280') {?>37мин.<?php }
if ($time11 > '2279' and $time11 < '2340') {?>38мин.<?php }
if ($time11 > '2339' and $time11 < '2400') {?>39мин.<?php }
if ($time11 > '2399' and $time11 < '2460') {?>40мин.<?php }
if ($time11 > '2459' and $time11 < '2520') {?>41мин.<?php }
if ($time11 > '2519' and $time11 < '2580') {?>42мин.<?php }
if ($time11 > '2579' and $time11 < '2640') {?>43мин.<?php }
if ($time11 > '2639' and $time11 < '2700') {?>44мин.<?php }
if ($time11 > '2699' and $time11 < '2760') {?>45мин.<?php }
if ($time11 > '2759' and $time11 < '2820') {?>46мин.<?php }
if ($time11 > '2819' and $time11 < '2880') {?>47мин.<?php }
if ($time11 > '2879' and $time11 < '2940') {?>48мин.<?php }
if ($time11 > '2939' and $time11 < '3000') {?>49мин.<?php }
if ($time11 > '2999' and $time11 < '3060') {?>50мин.<?php }
if ($time11 > '3059' and $time11 < '3120') {?>51мин.<?php }
if ($time11 > '3119' and $time11 < '3180') {?>52мин.<?php }
if ($time11 > '3179' and $time11 < '3240') {?>53мин.<?php }
if ($time11 > '3239' and $time11 < '3300') {?>54мин.<?php }
if ($time11 > '3299' and $time11 < '3360') {?>55мин.<?php }
if ($time11 > '3359' and $time11 < '3420') {?>56мин.<?php }
if ($time11 > '3419' and $time11 < '3480') {?>57мин.<?php }
if ($time11 > '3479' and $time11 < '3540') {?>58мин.<?php }
if ($time11 > '3539' and $time11 < '3600') {?>59мин.<?php }
if ($time11 > '3599' and $time11 < '3660') {?>60мин.<?php }
if ($time11 > '3659' and $time11 < '7200') {?>1час.<?php }
if ($time11 > '7199' and $time11 < '10800') {?>2час.<?php }
if ($time11 > '10799' and $time11 < '14400') {?>3час.<?php }
if ($time11 > '14399' and $time11 < '18000') {?>4час.<?php }
if ($time11 > '17999' and $time11 < '21600') {?>5час.<?php }
if ($time11 > '21599' and $time11 < '25200') {?>6час.<?php }
if ($time11 > '25199' and $time11 < '28800') {?>7час.<?php }
if ($time11 > '28799' and $time11 < '32400') {?>8час.<?php }
if ($time11 > '32399' and $time11 < '36000') {?>9час.<?php }
if ($time11 > '35999' and $time11 < '39600') {?>10час.<?php }
if ($time11 > '39599' and $time11 < '43200') {?>11час.<?php }
if ($time11 > '43199' and $time11 < '46800') {?>12час.<?php }
if ($time11 > '46799' and $time11 < '50400') {?>13час.<?php }
if ($time11 > '50399' and $time11 < '54000') {?>14час.<?php }
if ($time11 > '53999' and $time11 < '57600') {?>15час.<?php }
if ($time11 > '57599' and $time11 < '61200') {?>16час.<?php }
if ($time11 > '61199' and $time11 < '64800') {?>17час.<?php }
if ($time11 > '64799' and $time11 < '68400') {?>18час.<?php }
if ($time11 > '68399' and $time11 < '72000') {?>19час.<?php }
if ($time11 > '71999' and $time11 < '75600') {?>20час.<?php }
if ($time11 > '75599' and $time11 < '79200') {?>21час.<?php }
if ($time11 > '79199' and $time11 < '82800') {?>22час.<?php }
if ($time11 > '82799' and $time11 < '86400') {?>23час.<?php }
if ($time11 > '86399' and $time11 < '90000') {?>1день<?php }
if ($time11 > '89999' and $time11 < '172800') {?>2дня<?php }
if ($time11 > '172799' and $time11 < '259200') {?>3дня<?php }
if ($time11 > '259199' and $time11 < '345600') {?>4дня<?php }
if ($time11 > '345599' and $time11 < '432000') {?>5дней<?php }
if ($time11 > '431999' and $time11 < '518400') {?>6дней<?php }
if ($time11 > '518399' and $time11 < '619200') {?>7дней<?php }
if ($time11 > '619199' and $time11 < '777600') {?>8дней<?php }
if ($time11 > '777599' and $time11 < '864000') {?>9дней<?php }
if ($time11 > '863999' and $time11 < '950400') {?>10дней<?php }
if ($time11 > '950399' and $time11 < '1036800') {?>11дней<?php }
if ($time11 > '1036799' and $time11 < '1123200') {?>12дней<?php }
if ($time11 > '1123199' and $time11 < '1209600') {?>13дней<?php }
if ($time11 > '1209599' and $time11 < '1296000') {?>14дней<?php }
if ($time11 > '1295999' and $time11 < '1382400') {?>15дней<?php }
if ($time11 > '1382399' and $time11 < '1468800') {?>16дней<?php }
if ($time11 > '1468799' and $time11 < '1555200') {?>17дней<?php }
if ($time11 > '1555199' and $time11 < '1641600') {?>18дней<?php }
if ($time11 > '1641599' and $time11 < '1728000') {?>19дней<?php }
if ($time11 > '1727999' and $time11 < '1814400') {?>20дней<?php }
if ($time11 > '1814399' and $time11 < '1900800') {?>21день<?php }
if ($time11 > '1900799' and $time11 < '1987200') {?>22дня<?php }
if ($time11 > '1987199' and $time11 < '2073600') {?>23дня<?php }
if ($time11 > '2073599' and $time11 < '2160000') {?>24дня<?php }
if ($time11 > '2159999' and $time11 < '2246400') {?>25дней<?php }
if ($time11 > '2246399' and $time11 < '2332800') {?>26дней<?php }
if ($time11 > '2332799' and $time11 < '2419200') {?>27дней<?php }
if ($time11 > '2419199' and $time11 < '2505600') {?>28дней<?php }
if ($time11 > '2505599' and $time11 < '2592000') {?>29дней<?php }
if ($time11 > '2591999' and $time11 < '5184000') {?>1мес.<?php }
if ($time11 > '5183999' and $time11 < '7776000') {?>2мес.<?php }
if ($time11 > '7775999' and $time11 < '10368000') {?>3мес.<?php }
?></p>
<?php }?>
          </div> 
	      <?php
	}
	else {
	  ?>
      <div id="error">
      <p>>>> Тема закрыта <<<</p>
     </div>
     <?php
	}
  }
  }
  else {?><div id="error">
        <p>>>> Достигнуто максимальное количество постов в данной теме <<<</p>
        </div><?php }
  ?>
 <?php
  ?></div><?php
  }
}
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>