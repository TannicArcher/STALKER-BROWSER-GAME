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
$page_title = 'Почта';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<div id="main">
<div class="stats">
<p class="podmenu">Почта</p>
</div>
<?php
$user_id = $_SESSION['id'];
$query_us = "Select message from users where id = '$user_id'";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$message = $row_us['message'];
$query = "update users set location = 'mail' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<p><img src="img/reload.gif" width="12" height="12" /><a href="mailbox.php">Назад</a></p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>

<?php
$query = "Select message_id from message where dlya='$user_id' and type='6' or dlya='$user_id' and type='7' or dlya='$user_id' and type='8' or dlya='$user_id' and type='9' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
$total = mysqli_num_rows($result);
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 20;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total / $result_per_page);
	if ($num_page > 0) {
	?><div class="stats"><?php
	  $query = "Select * from message where  dlya='$user_id' and type='6' or dlya='$user_id' and type='7' or dlya='$user_id' and type='8' or dlya='$user_id' and type='9' order by time DESC limit $skip, $result_per_page";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
	  $show = 0;
	  while ($row = mysqli_fetch_array($result)) {
	    ///Если текст
		if ($row['type'] == 1 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		  $show=1;
		  $ot=$row['ot'];
		  $dlya=$row['dlya'];
		  $text = $row['text'];
		  $text = str_replace('<br />',' ', $text);
		  $text = substr($text,0,16);
		  $long_text = strlen($text);
	      if ($ot == $user_id) {
		    $query_user = "Select nick from users where id='$dlya' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
		    ?><p><img src="img/ico/letterout.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><small><span class="red">(не прочитано)</span></small><?php }?> 
			<a href="profile.php?id=<?php echo "$dlya";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a href="message.php?mes_id=<?php echo $row['message_id'];?>"><?php echo "$text"; if ($long_text >12) {echo '...';}?></a> 
			</p>
			<?php
		  }
		  if ($dlya == $user_id) {
		    $query_user = "Select nick from users where id='$ot' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
			?>
			<p>
			<img src="img/ico/letterin.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?>  
			<a href="profile.php?id=<?php echo "$ot";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a href="message.php?mes_id=<?php echo $row['message_id'];?>"><?php echo "$text"; if ($long_text >12) {echo '...';}?></a>
			</p>
			<?php
		  }		 
	    }
	  ////////////Конец текста
	  /////Шмотка
	    if ($row['type'] == 2 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
	      $show=1;
		  $ot=$row['ot'];
		  $dlya=$row['dlya'];
	      if ($ot == $user_id) {
		    $query_user = "Select nick from users where id='$dlya' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
		    ?><p><img src="img/ico/letterout.png" width="12" height="12"/> 
			<a href="profile.php?id=<?php echo "$dlya";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a href="message.php?mes_id=<?php echo $row['message_id'];?>">(Cнаряж:<?php echo $row['text'];?>)</a>
			</p>
			<?php
		  }
		  if ($dlya == $user_id) {
		    $query_user = "Select nick from users where id='$ot' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
			?>
			<p>
			<img src="img/ico/letterin.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?> 
			<a href="profile.php?id=<?php echo "$ot";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a <?php if ($row['reading'] == 0) {?>class="white"<?php }?> 
			href="message.php?mes_id=<?php echo $row['message_id'];?>">(Cнаряж:<?php echo $row['text'];?>)</a>
			</p>
			<?php
		  }
		}
	  //////////Конец шмотки
	  //////Начало денег
	    if ($row['type'] == 3 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		  $show=1;
		  $ot=$row['ot'];
		  $dlya=$row['dlya'];
	      if ($ot == $user_id) {
		    $query_user = "Select nick from users where id='$dlya' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
		    ?><p><img src="img/ico/letterout.png" width="12" height="12"/> 
			<a href="profile.php?id=<?php echo "$dlya";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a href="message.php?mes_id=<?php echo $row['message_id'];?>">(<?php echo $row['thing'];?> RUB)</a>
			</p>
			<?php
		  }
		  if ($dlya == $user_id) {
		    $query_user = "Select nick from users where id='$ot' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
			?>
			<p>
			<img src="img/ico/letterin.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?> 
			<a href="profile.php?id=<?php echo "$ot";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a <?php if ($row['reading'] == 0) {?>class="white"<?php }?> 
			href="message.php?mes_id=<?php echo $row['message_id'];?>">(<?php echo $row['thing'];?> RUB)</a>
			</p>
			<?php
		  }
		}
	  ////////Конец денег
	  ///////Начало хабара
	     if ($row['type'] == 4 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		  $show=1;
		  $ot=$row['ot'];
		  $dlya=$row['dlya'];
	      if ($ot == $user_id) {
		    $query_user = "Select nick from users where id='$dlya' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
		    ?><p><img src="img/ico/letterout.png" width="12" height="12"/> 
			<a href="profile.php?id=<?php echo "$dlya";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a href="message.php?mes_id=<?php echo $row['message_id'];?>">(хабар:<?php echo $row['thing'];?>)</a>
			</p>
			<?php
		  }
		  if ($dlya == $user_id) {
		    $query_user = "Select nick from users where id='$ot' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
			?>
			<p>
			<img src="img/ico/letterin.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?> 
			<a href="profile.php?id=<?php echo "$ot";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a <?php if ($row['reading'] == 0) {?>class="white"<?php }?> 
			href="message.php?mes_id=<?php echo $row['message_id'];?>">(хабар:<?php echo $row['thing'];?>)</a>
			</p>
			<?php
		  }
		}
	  ///////Конец хабара
	  //////Начало Аптечек
	    if ($row['type'] == 5 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		  $show=1;
		  $ot=$row['ot'];
		  $dlya=$row['dlya'];
	      if ($ot == $user_id) {
		    $query_user = "Select nick from users where id='$dlya' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
		    ?><p><img src="img/ico/letterout.png" width="12" height="12"/> 
			<a href="profile.php?id=<?php echo "$dlya";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a href="message.php?mes_id=<?php echo $row['message_id'];?>">(аптечки:<?php echo $row['thing'];?>)</a>
			</p>
			<?php
		  }
		  if ($dlya == $user_id) {
		    $show=1;
		    $query_user = "Select nick from users where id='$ot' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
			?>
			<p>
			<img src="img/ico/letterin.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?> 
			<a href="profile.php?id=<?php echo "$ot";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a <?php if ($row['reading'] == 0) {?>class="white"<?php }?> 
			href="message.php?mes_id=<?php echo $row['message_id'];?>">(аптечки:<?php echo $row['thing'];?>)</a>
			</p>
			<?php
		  }
		}
		if ($row['type'] == 6 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		$show=1;
		?><p class="white"><img src="img/ico/letterin.png" width="12" height="12"/> Аукцион: <a <?php if ($row['reading'] == 0) {?>class="white"<?php }?>  href="message.php?mes_id=<?php echo $row['message_id'];?>">вашу ставку перебили</a></p>
			<?php
		}
		/////Шмотка АУКЦИОН
	    if ($row['type'] == 7 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		    $show=1;
		    $ot=$row['ot'];
		    $dlya=$row['dlya'];
			?>
			<p>
			<img src="img/ico/auc.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?> 
			<span class="white">Аукцион:</span>
			<a <?php if ($row['reading'] == 0) {?>class="white"<?php }?> 
			href="message.php?mes_id=<?php echo $row['message_id'];?>">(Cнаряж:<?php echo $row['text'];?>)</a>
			</p>
			<?php
		}
	  //////////Конец шмотки АУКЦИОН
	  ////Деньги за купленную шмотку
	    if ($row['type'] == 8 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		    $show=1;
		    $ot=$row['ot'];
		    $dlya=$row['dlya'];
			?>
			<p class="white"><img src="img/ico/auc.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?>  Аукцион: <a <?php if ($row['reading'] == 0) {?>class="white"<?php }?>  href="message.php?mes_id=<?php echo $row['message_id'];?>">ваш лот купили</a></p>
			<?php
		}
	  //////////Конец денег за шмотку
	  /////Шмотка АУКЦИОН
	    if ($row['type'] == 9 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		    $show=1;
		    $ot=$row['ot'];
		    $dlya=$row['dlya'];
			?>
			<p>
			<img src="img/ico/auc.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?> 
			<span class="white">Аукцион:</span>
			<a <?php if ($row['reading'] == 0) {?>class="white"<?php }?> 
			href="message.php?mes_id=<?php echo $row['message_id'];?>">(Cнаряж:<?php echo $row['text'];?>)</a>
			</p>
			<?php
		}
	  //////////Конец шмотки АУКЦИОН
	  //////Начало вмр
	    if ($row['type'] == 13 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		  $show=1;
		  $ot=$row['ot'];
		  $dlya=$row['dlya'];
	      if ($ot == $user_id) {
		    $query_user = "Select nick from users where id='$dlya' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
		    ?><p><img src="img/ico/letterout.png" width="12" height="12"/> 
			<a href="profile.php?id=<?php echo "$dlya";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a href="message.php?mes_id=<?php echo $row['message_id'];?>">(<?php echo $row['thing'];?> wmr)</a>
			</p>
			<?php
		  }
		  if ($dlya == $user_id) {
		    $query_user = "Select nick from users where id='$ot' limit 1";
            $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
		    $row_user = mysqli_fetch_array($result_user);
			?>
			<p>
			<img src="img/ico/letterin.png" width="12" height="12"/> <?php if ($row['reading'] == 0) {?><img src="img/ico/new_.png"/><?php }?> 
			<a href="profile.php?id=<?php echo "$ot";?>"><?php echo $row_user['nick'];?></a><?php echo ': '; ?>
			<a <?php if ($row['reading'] == 0) {?>class="white"<?php }?> 
			href="message.php?mes_id=<?php echo $row['message_id'];?>">(<?php echo $row['thing'];?> wmr)</a>
			</p>
			<?php
		  }
		}
	  ////////Конец вмр
	    if ($row['type'] ==10 and $row['delite_ot'] <> $user_id and $row['delite_dlya'] <> $user_id) {
		    $show=1;
		    $ot=$row['ot'];
		    $dlya=$row['dlya'];
			?>
			<p class="white"><img src="img/ico/letterin.png" width="12" height="12"/> Банк: <a <?php if ($row['reading'] == 0) {?>class="white"<?php }?>  href="message.php?mes_id=<?php echo $row['message_id'];?>">пополнение счёта</a></p>
			<?php
		}
	  }
	  if ($show == 0) {echo 'Писем нет';} 
	  ?>
	  </div>
	  <?php
	  	  /////////////////////////////Навигация
	  ?>
	  <div class="stats">
	  <?php
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
	  ?>
	 </div>
	  <?php
	  ///////////////////Конец навигации
	  ?>
      <p class="clothes" style="padding-bottom:6px;"><span class="red">Удаление сообщений ускоряет загрузку страниц</span></p>
	  <div class="zx">
	  <p><img src="img/ico/delete2.png" width="12" height="12"/> <a href="delmessages.php">Удалить все прочитанные</a></p>
	  </div>
	  <?php
	} 
	else {
	  ?>
	  <div class="stats">
	  <p>Писем нет</p>
	  </div>
	  <?php
	}

	
	
?>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>