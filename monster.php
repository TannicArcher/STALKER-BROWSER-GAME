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
$user_id = $_SESSION['id'];
$query_sus = "Select * from users where  id = '$user_id'  limit 1";
$result_sus = mysqli_query($dbc, $query_sus) or die ('Ошибка передачи запроса к БД');
$row_sus = mysqli_fetch_array($result_sus);
$poisk_tip = $row_sus['poisk_tip'];
$monster_id = $_GET['m'];
$monster_id = htmlentities($monster_id, ENT_QUOTES);
 if ($poisk_tip != '0') {?>
  <script type="text/javascript">
  document.location.href = "vzlom.php";
  </script>
  <?php
  exit();
}
if (empty($monster_id)) {
  ?>
  <script type="text/javascript">
  document.location.href = "monsters.php";
  </script>
  <?php
  exit();
}
$monster_id = mysqli_real_escape_string($dbc, trim($monster_id));
$query_m = "Select name, screen, clan, max_people, max_hp, bronya, yron, speed, bonus_type, bonus, location, time_angry, location_name, respawn_time, max_aptechki from monsters where id_monster = '$monster_id' limit 1";
$result_m = mysqli_query($dbc, $query_m) or die ('Ошибка передачи запроса к БД2');
$row_m = mysqli_fetch_array($result_m);
$max_hp = $row_m['max_hp'];
$max_people = $row_m['max_people'];
$location = $row_m['location'];
$location_name = $row_m['location_name'];
$max_aptechki = $row_m['max_aptechki'];
if (empty($row_m)) {
  ?>
  <script type="text/javascript">
  document.location.href = "monsters.php";
  </script>
  <?php
  exit();
}
/////////////////////////////////////////////////Этот монстер существует
$query_user = "Select location, clan, clan_rang, m_fight, hp, max_hp, monst_apt, aptechki, gruppa, razriv_cl, sost_cl, sost_p, sost_w, lvl from users where id = '$user_id' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД2');
$row_user = mysqli_fetch_array($result_user);
$hphp=$row_user['hp'];
$gruppa_us = $row_user['gruppa'];
if ($row_user['location'] <> $row_m['location']) {/////////////Если он ещё не в рейде
  if ($row_user['hp'] <=0) {
  ?>
  <script type="text/javascript">
  document.location.href = "death.php";
  </script>
  <?php
  exit();
  }
  
  
  if ( $row_user['location'] == 'monster2' and $monster_id==4) { 
    $page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
	?>
	<div id="main">
               <div class="stats">
                 <p class="podmenu">Вы не можете присоединиться к рейду</p>
               </div>
			   <div class="stats">
			   <p class="white">Дождитесь окончания рейда</p>
			   </div><br />
			   <p><img src="img/ico/left.png" /> <a href="monsters.php">К списку рейдов</a></p><br />
			</div>
	<?php
	require_once('conf/log.php');
    require_once('conf/navig.php');
    require_once('conf/foot.php');
    ?>
    </body>
    </html>
    <?php
	exit();
  }
  if ( $row_user['location'] == 'monster4' and $monster_id==2) {
    $page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
	?>
	<div id="main">
               <div class="stats">
                 <p class="podmenu">Вы не можете присоединиться к рейду</p>
               </div>
			   <div class="stats">
			   <p class="white">Дождитесь окончания рейда</p>
			   </div><br />
			   <p><img src="img/ico/left.png" /> <a href="monsters.php">К списку рейдов</a></p><br />
			</div>
	<?php
	require_once('conf/log.php');
    require_once('conf/navig.php');
    require_once('conf/foot.php');
    ?>
    </body>
    </html>
    <?php
	exit();
   
  }
  ///////////////////////////////////////////////////////////////////////////////////
  if ($row_m['clan'] <> 0) {//Если это клановый монстр
    if ($row_user['clan'] == 0) {
	  ?>
      <script type="text/javascript">
      document.location.href = "monsters.php?err=1";
      </script>
      <?php
      exit();
	}
	//////////////////////////////////////////После раскрутки воткнуть ограны на ЛВЛ отряды.
	$page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
	$location = $row_m['location'];
	/////////////Проверка на время
	$query_t = "Select time_respawn from m_time where user_id = '$user_id' and id_monster='$monster_id' limit 1";
    $result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД2');
    $row_t = mysqli_fetch_array($result_t);
	if (!empty($row_t)) {
	  $now = (date("Y-m-d H:i:s"));
      $now = strtotime("$now");
	  $time_respawn = $row_t['time_respawn'];
	  $time_respawn = strtotime("$time_respawn");
	  $need_time = ($time_respawn + $row_m['respawn_time']);
	  if ($need_time >= $now) {
	    $lost_time = ($need_time - $now);
		$hours_time = ($lost_time/3600);
        $hours_time = floor($hours_time);
        $minutes_time = ($lost_time - (3600 * $hours_time));
        $minutes_time = ($minutes_time/60);
        $minutes_time = floor($minutes_time);
        $seconds = ($lost_time - ($hours_time*3600) - ($minutes_time*60));
	    ////////////////////
		?>
		<div id="main">
               <div class="stats">
                 <p class="podmenu">Вы не можете пойти на рейд</p>
               </div>
			   <div class="stats">
			   <p class="white">Попробуйте через [<?php echo "$hours_time:$minutes_time:$seconds";?>]</p>
			   </div><br />
			   <p><img src="img/ico/left.png" /> <a href="monsters.php">К списку рейдов</a></p><br />
			</div>
	     <?php
		 $end=1;
		/////////////////////
	  }
	}
	//////////////////////////////
	if (empty($end)) {
	  $clan_id = $row_user['clan'];
	  $query_isset = "Select id_fight, start from m_fight where clan_id='$clan_id' and id_monster='$monster_id' limit 1";
      $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД2');
      $row_isset = mysqli_fetch_array($result_isset);
	  if (empty($row_isset)) {
	    $max_hp=$row_m['max_hp'];
	    $query_isset = "insert into m_fight (`id_monster`, `hp`, `start`, `last_active`, `time_start`, `clan_id`) values ('$monster_id', '$max_hp' , '0', '0', '0','$clan_id')";
        $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД2');
		$query_isset = "Select id_fight, start from m_fight where clan_id='$clan_id' limit 1";
        $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД2');
        $row_isset = mysqli_fetch_array($result_isset);
	  }
	    $start = $row_isset['start'];
		if ($start == 1) {
		  ?>
		  	<div id="main">
               <div class="stats">
                 <p class="podmenu">Рейд уже начался</p>
               </div>
			   <div id="error">
			   <p>Вы не можете принять в рейде участие</p> 
			   <p class="white">Рейд уже начался</p>
			   </div><br />
			   <p><img src="img/ico/left.png" /> <a href="monsters.php">К списку рейдов</a></p><br />
			</div>
		  <?php
		}
		else {
		  $id_fight = $row_isset['id_fight'];
		  $query_count = "Select id from users where location = '$location' and last_active > NOW()-(1000) and clan = '$clan_id' and hp>0 and m_fight='$id_fight' limit $max_people";
          $result_count = mysqli_query($dbc, $query_count) or die ('Ошибка передачи запроса к БД2');
          $row_count = mysqli_num_rows($result_count);
		  if ($row_count >= $max_people) {
			?>
			<div id="main">
               <div class="stats">
                 <p class="podmenu">Приём на рейд окончен</p>
               </div>
			   <div id="error">
			   <p>Вы не можете принять в рейде участие</p> 
			   <p class="white">Максимальное количество человек - <?php echo "$max_people";?></p><br />
			    <p><img src="img/ico/left.png" /> <a href="monsters.php">К списку рейдов</a></p>
			   </div>
			</div>
			<?php
		  } 
		  else {
		    $query = "update users set monst_apt = '$max_aptechki', location = '$location', m_fight='$id_fight', m_stop='0' where id='$user_id'";
            $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
			
		  $query_isset = "select about_id from m_inf where user_id='$user_id' and monster_id='$monster_id' limit 1";
          $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД24');
		  $cc=mysqli_fetch_array($result_isset);
		  if (!empty($cc)) {
		    $about_id=$cc['about_id'];
		    $query_isset = "update m_inf set active=0, thing_id=0, id_fight='$id_fight' where about_id='$about_id' limit 1";
            $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД25');
		  }
		  else {
		    $query_isset = "insert into m_inf (`user_id`, `monster_id`, `active`, `thing_id`, `id_fight`) values ('$user_id', '$monster_id' , '0', '0', '$id_fight')";
            $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД26');
	     }
		
			///////////////////////////////Всё успешно, показываем типа пользователь в локации.
			$count = ($row_count + 1);
			  ?>
             <div id="main">
               <div class="stats">
                 <p class="podmenu"><?php echo "$location_name";?></p>
               </div>
               <div class="stats">
                 <table width="170" border="0" cellpadding="0" cellspacing="0">
                 <tbody>
                 <tr>
                 <td width="54" valign="top"><img src="img/monsters/<?php echo $row_m['screen']; ?>" width="50" height="50" border="0"/></td>
                 <td width="116" valign="top">
	             <div class="inf">
	               <p class="white"><?php echo $row_m['name']; ?></p>
<p class="white"><img src="img/ico/life.png" width="12" height="12" border="0"/>100% <img src="img/ico/time.png" width="12" height="12" border="0"/> 00:00</p>
	               <p><?php 
				   if ($row_user['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="."/> <?php }
	               if ($row_user['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="."/> <?php }
	               if ($row_user['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="."/> <?php }
	             echo "$count" . '/' .  $row_m['max_people']?> <img src="img/ico/apte4ka.png" width="12" height="12" border="0"/> <?php echo $row_m['max_aptechki'] . '/' . $row_m['max_aptechki'];?></p>
	             </div>
	             </td>
                 </tr>
                 </tbody>
                 </table>
               </div>
              <div class="stats">
               <?php if ($row_m['clan'] <> 0) {
			    if ($row_isset['start'] == 0 and $row_user['clan_rang'] >5) {?>
              <p><img src="img/ico/pistol.png" alt="p" width="12" height="12"/>  <a href="monster.php?m=<?php echo "$monster_id";?>&sost=1">Начать рейд</a></p>
			  <?php
			     }
			   } 
			   ?>
			   <p><img src="img/ico/point.png" /> <a href="monster.php?m=<?php echo "$monster_id";?>">Обновить</a></p>
            </div>
		  </div>
<?php			  
			///////////////////////////////
		  }
		}
    }
  }
  else {//Если не клановый
    if ($monster_id==1) {
	  if ($row_user['lvl'] < 15) {
	  ?>
      <script type="text/javascript">
      document.location.href = "monsters.php?err=2";
      </script>
      <?php
      exit();
	  }
	}
	$id_fight = $row_isset['id_fight'];
    $page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
	$location = $row_m['location'];

    if ($monster_id==6) {
	  if ($row_user['lvl'] < 20) {
	  ?>
      <script type="text/javascript">
      document.location.href = "monsters.php?err=4";
      </script>
      <?php
      exit();
	  }
	}
	$id_fight = $row_isset['id_fight'];
    $page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
	$location = $row_m['location'];

    if ($monster_id==9) {
	  if ($row_user['lvl'] < 20) {
	  ?>
      <script type="text/javascript">
      document.location.href = "monsters.php?err=4";
      </script>
      <?php
      exit();
	  }
	}
	$id_fight = $row_isset['id_fight'];
    $page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
	$location = $row_m['location'];

    if ($monster_id==10) {
	  if ($row_user['lvl'] < 40) {
	  ?>
      <script type="text/javascript">
      document.location.href = "monsters.php?err=2";
      </script>
      <?php
      exit();
	  }
	}
	$id_fight = $row_isset['id_fight'];
    $page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
	$location = $row_m['location'];

    if ($monster_id==8) {
	  if ($row_user['lvl'] < 25) {
	  ?>
      <script type="text/javascript">
      document.location.href = "monsters.php?err=5";
      </script>
      <?php
      exit();
	  }
	}
	$id_fight = $row_isset['id_fight'];
    $page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
	$location = $row_m['location'];
    /////////////Проверка на время
	$query_t = "Select time_respawn from m_time where user_id = '$user_id' and id_monster='$monster_id' limit 1";
    $result_t = mysqli_query($dbc, $query_t) or die ('Ошибка передачи запроса к БД2');
    $row_t = mysqli_fetch_array($result_t);
	if (!empty($row_t)) {
	  $now = (date("Y-m-d H:i:s"));
      $now = strtotime("$now");
	  $time_respawn = $row_t['time_respawn'];
	  $time_respawn = strtotime("$time_respawn");
	  $need_time = ($time_respawn + $row_m['respawn_time']);
	  if ($need_time >= $now) {
	    $lost_time = ($need_time - $now);
		$hours_time = ($lost_time/3600);
        $hours_time = floor($hours_time);
        $minutes_time = ($lost_time - (3600 * $hours_time));
        $minutes_time = ($minutes_time/60);
        $minutes_time = floor($minutes_time);
        $seconds = ($lost_time - ($hours_time*3600) - ($minutes_time*60));
	    ////////////////////
		?>
		<div id="main">
               <div class="stats">
                 <p class="podmenu">Вы не можете пойти на рейд</p>
               </div>
			   <div class="stats">
			   <p class="white">Попробуйте через [<?php echo "$hours_time:$minutes_time:$seconds";?>]</p>
			   </div><br />
			   <p><img src="img/ico/left.png" /> <a href="monsters.php">К списку рейдов</a></p><br />
			</div>
	     <?php
		 $end=1;
		/////////////////////
	  }
	}
	if ($row_user['m_fight'] <> 0) {
	  ////////////////////
		?>
		<div id="main">
               <div class="stats">
                 <p class="podmenu">Вы не можете присоединиться к рейду</p>
               </div>
			   <div class="stats">
			   <p class="white">Дождитесь окончания рейда</p>
			   </div><br />
			   <p><img src="img/ico/left.png" /> <a href="monsters.php">К списку рейдов</a></p><br />
			</div>
	     <?php
		 $end=1;
		/////////////////////
	}
	//////////////////////////////
    if (empty($end)) {
	  $sost=$_GET['sost'];
    if ($sost == 1) {
	  $query_isset = "Select id_fight from m_fight where start=0 and gruppa = '$gruppa_us' and id_monster='$monster_id' limit 1";
      $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД22');
      $row_isset = mysqli_fetch_array($result_isset);
	  $id_fight= $row_isset['id_fight'];
      $query = "update users set monst_apt = '$max_aptechki', location = '$location', m_fight='$id_fight', m_stop='0' where id='$user_id'";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
	  
	  $query_count = "Select id from users where location = '$location' and last_active > NOW()-(1000) and hp>0 and m_fight='$id_fight' limit $max_people";
      $result_count = mysqli_query($dbc, $query_count) or die ('Ошибка передачи запроса к БД23');
      $row_count_st = mysqli_num_rows($result_count);
	  while ($row_st=mysqli_fetch_array($result_count)) {
		  $inf_id=$row_st['id'];
		  $query_isset = "select about_id from m_inf where user_id='$inf_id' and monster_id='$monster_id' limit 1";
          $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД24');
		  $cc=mysqli_fetch_array($result_isset);
		  if (!empty($cc)) {
		    $about_id=$cc['about_id'];
		    $query_isset = "update m_inf set active=0, thing_id=0, id_fight='$id_fight' where about_id='$about_id' limit 1";
            $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД25');
		  }
		  else {
		    $query_isset = "insert into m_inf (`user_id`, `monster_id`, `active`, `thing_id`, `id_fight`) values ('$inf_id', '$monster_id' , '0', '0', '$id_fight')";
            $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД26');
	     }
		}
	  if ($row_count_st >= $max_people) {
	    $query = "update m_fight set start = 1, time_start=NOW(), last_active=NOW() where id_fight='$id_fight'";
        $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
	  }
	  
	  ?>
      <script type="text/javascript">
      document.location.href = "monster.php?m=<?php echo "$monster_id"; ?>";
      </script>
      <?php
      exit();
    }
	  $query_isset = "Select id_fight from m_fight where start=0 and gruppa = '$gruppa_us' and id_monster='$monster_id' limit 1";
      $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД2');
      $row_isset = mysqli_fetch_array($result_isset);
	  $location = $row_m['location'];
	  $id_fight = $row_isset['id_fight'];
	  $query_count = "Select id from users where location = '$location' and last_active > NOW()-(1000) and hp>0  and m_fight='$id_fight' limit $max_people";
      $result_count = mysqli_query($dbc, $query_count) or die ('Ошибка передачи запроса к БД2');
      $row_count = mysqli_num_rows($result_count);
	  if (empty($row_isset)) {
	    $max_hp=$row_m['max_hp'];
	    $query_isset = "insert into m_fight (`id_monster`, `hp`, `start`, `last_active`, `time_start`, `gruppa`) values ('$monster_id', '$max_hp' , '0', '0', '0', '$gruppa_us')";
        $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД2');
		?>
             <div id="main">
               <div class="stats">
                 <p class="podmenu"><?php echo "$location_name";?></p>
               </div>
               <div class="stats">
                 <table width="170" border="0" cellpadding="0" cellspacing="0">
                 <tbody>
                 <tr>
                 <td width="54" valign="top"><img src="img/monsters/<?php echo $row_m['screen']; ?>" width="50" height="50" border="0"/></td>
                 <td width="116" valign="top">
	             <div class="inf">
	               <p class="white"><?php echo $row_m['name']; ?></p>
	               <p class="white"><img src="img/ico/life.png" width="12" height="12" border="0"/>100% <img src="img/ico/time.png" width="12" height="12" border="0"/> 00:00</p>
	               <p><?php 
				   if ($row_user['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="."/> <?php }
	               if ($row_user['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="."/> <?php }
	               if ($row_user['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="."/> <?php }
				    echo  "$row_count/"  .  $row_m['max_people']?> <img src="img/ico/apte4ka.png" width="12" height="12" border="0"/> <?php echo $row_m['max_aptechki'] . '/' . $row_m['max_aptechki']; ?></p>
	             </div>
	             </td>
                 </tr>
                 </tbody>
                 </table>
               </div>
              <div class="stats">
              <p><img src="img/ico/point.png" /> <a href="monster.php?m=<?php echo "$monster_id";?>">Обновить</a></p>
			  <p><img src="img/ico/point.png" /> <a class="white" href="monster.php?m=<?php echo "$monster_id";?>&sost=1">Записаться на рейд</a></p>
            </div>
		  </div>
			<?php
	  }
	  else {
	  ?>
             <div id="main">
               <div class="stats">
                 <p class="podmenu"><?php echo "$location_name";?></p>
               </div>
               <div class="stats">
                 <table width="170" border="0" cellpadding="0" cellspacing="0">
                 <tbody>
                 <tr>
                 <td width="54" valign="top"><img src="img/monsters/<?php echo $row_m['screen']; ?>" width="50" height="50" border="0"/></td>
                 <td width="116" valign="top">
	             <div class="inf">
	               <p class="white"><?php echo $row_m['name']; ?></p>
	               <p class="white"><img src="img/ico/life.png" width="12" height="12" border="0"/>100% <img src="img/ico/time.png" width="12" height="12" border="0"/> 00:00</p>
	               <p><?php 
				   if ($row_user['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="."/> <?php }
	               if ($row_user['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="."/> <?php }
	               if ($row_user['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="."/> <?php }
				   echo  "$row_count" . '/' .  $row_m['max_people'];?>  <img src="img/ico/apte4ka.png" width="12" height="12" border="0"/> <?php echo $row_m['max_aptechki'] . '/' . $row_m['max_aptechki']; ?></p>
	             </div>
	             </td>
                 </tr>
                 </tbody>
                 </table>
               </div>
              <div class="stats">
              <p><img src="img/ico/point.png" /> <a href="monster.php?m=<?php echo "$monster_id";?>">Обновить</a></p>
			  <p><img src="img/ico/point.png" /> <a class="white" href="monster.php?m=<?php echo "$monster_id";?>&sost=1">Записаться на рейд</a></p>
            </div>
		  </div>
			<?php
	  }

    }
  }
}
else {//Если он уже в рейде
  $sost = $_GET['sost'];
  $m_fight = $row_user['m_fight'];
  $query_isset = "Select id_monster, hp, start, last_active, time_start, clan_id from m_fight where id_fight= '$m_fight' limit 1";
  $result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД2');
  $row_isset = mysqli_fetch_array($result_isset);
  if ($sost == 1) {
    if ($row_m['clan'] <> 0) {
	  if ($row_isset['start'] == 0 and $row_user['clan_rang'] >5) {
		$query = "update m_fight set start = 1, last_active=NOW(), time_start=NOW() where id_fight='$m_fight' and id_monster='$monster_id' limit 1";
        $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
		?>
        <script type="text/javascript">
        document.location.href = "monster.php?m=<?php echo "$monster_id"; ?>";
        </script>
        <?php
        exit();
	  }
	}
  }
  if ($sost == 2) {
    if ($row_isset['start'] == 0) {
      $query = "update users set monst_apt = '0', location = 'index', m_fight='0', m_stop='0' where id='$user_id'";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД4');
	  ?>
      <script type="text/javascript">
      document.location.href = "monster.php?m=<?php echo "$monster_id"; ?>";
      </script>
      <?php
      exit();
	}
  }
  if ($row_isset['start'] == 1 and $row_isset['hp'] > 0) {
  
  
  
  /////////////////// TIME
  $now = (date("Y-m-d H:i:s"));
  $now = strtotime("$now");
  $time_start = $row_isset['time_start'];
  $time_start = strtotime("$time_start");
  $echo_time = ($now - $time_start);
  $hours_time = ($echo_time/3600);
  $hours_time = floor($hours_time);
  $minutes_time = ($echo_time - (3600 * $hours_time));
  $minutes_time = ($minutes_time/60);
  $minutes_time = floor($minutes_time);
  $seconds = ($echo_time - ($hours_time*3600) - ($minutes_time*60));
  ///////////////
  //////////////
  }
  else {
    $minutes_time='00';
    $seconds='00';
  }
  $mhp_hp = ($row_m['max_hp']/1000);
  $mhp_hp = ($row_isset['hp']);
  $mhp_hp = round($mhp_hp);

  $proc_hp = ($row_m['max_hp']/100);
  $proc_hp = ($row_isset['hp']/$proc_hp);
  $proc_hp = round($proc_hp);
  
  $id_fight = $row_user['m_fight'];
  if (!empty($location)) {
  $query_count = "Select id from users where location = '$location' and last_active > NOW()-(1000) and hp > 0 and m_fight='$id_fight'";
  $result_count = mysqli_query($dbc, $query_count) or die ('Ошибка передачи запроса к БД2');
  $row_count = mysqli_num_rows($result_count);
  $page_title = "$location_name";
    require_once('conf/head.php');
    require_once('conf/top.php');
 ?>
             <div id="main">
               <div class="stats">
                 <p class="podmenu"><?php echo "$location_name";?></p>
               </div>
			   <?php 
			   $err=$_GET['err'];
			   if ($err == 1) {?><div id="error"><p>Оружие сломано.</p></div><?php }
			   if ($err == 2) {?><div id="error"><p>У вас нет оружия.</p></div><?php }
			   if ($err == 3) {?><div id="error"><p>Оружие ещё не готово.</p></div><?php }
			   ?>
               <div class="stats">
                 <table width="170" border="0" cellpadding="0" cellspacing="0">
                 <tbody>
                 <tr>
                 <td width="54" valign="top"><img src="img/monsters/<?php echo $row_m['screen']; ?>" width="50" height="50" border="0"/></td>
                 <td width="116" valign="top">
	             <div class="inf">
	               <p class="white"><?php echo $row_m['name']; ?></p>
	               <p class="white"><img src="img/ico/life.png" width="12" height="12" border="0"/> <?php echo "$mhp_hp";?> <?php echo "($proc_hp %)";?> <img src="img/ico/time.png" width="12" height="12" border="0"/> <?php echo "$minutes_time:$seconds" ?></p>
	               <p><?php
				   if ($row_user['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="."/> <?php }
	               if ($row_user['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="."/> <?php }
	               if ($row_user['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="."/> <?php }
				    echo  "$row_count" . '/' .  $row_m['max_people'];?> <img src="img/ico/apte4ka.png" width="12" height="12" border="0"/> <?php echo $row_user['monst_apt'] . '/' . $row_m['max_aptechki']; ?></p>
	             </div>
	             </td>
                 </tr>
                 </tbody>
                 </table>
               </div>
			   <?php
			   if ($hphp > 0) { ?>
              <div class="stats">
			  <?php if ($row_m['clan'] <> 0) {
			    if ($row_isset['start'] == 0 and $row_user['clan_rang'] >5 and $m_fight<>0) {?>
              <p><img src="img/ico/pistol.png" alt="p" width="12" height="12"/>  <a href="monster.php?m=<?php echo "$monster_id";?>&sost=1">Начать рейд</a></p>
			  <p><img src="img/ico/point.png" alt="p" width="12" height="12"/>  <a href="monster.php?m=<?php echo "$monster_id";?>">Обновить</a></p>
			  
              <?php
			     } else {
				   if ($row_isset['start'] == 0 and $m_fight<>0) {
				 ?><p><img src="img/ico/point.png" alt="p" width="12" height="12"/>  <a href="monster.php?m=<?php echo "$monster_id";?>">Обновить</a></p><?php
				   }
				 }
			   } 
			   else {
			     if ($row_isset['start'] == 0 and $m_fight<>0) {?>
              <p><img src="img/ico/point.png" alt="p" width="12" height="12"/>  <a href="monster.php?m=<?php echo "$monster_id";?>">Обновить</a></p>
			  <p><img src="img/ico/point.png" /> <a href="monster.php?m=<?php echo "$monster_id";?>&sost=2">Отказаться от рейда</a></p>
			  
              <?php
			     } 
			    
			   }
			   if ($m_fight == 0) {?>
                     <p class="bonus">Вы успешно сходили в рейд</p>
					 <p class="podmenu">[Информация]</p>
<?php
$user_idd = $_SESSION['id'];
$query_lool = "Select * from users where id='$user_idd' limit 1";
$result_lool = mysqli_query($dbc, $query_lool) or die ('Ошибка передачи запроса к БД');
$row_lool = mysqli_fetch_array($result_lool);
$vid_m = $row_lool['vid'];
$kol_m = $row_lool['kol'];
$need_kol_m = $row_lool['need_kol'];
$quest = $row_lool['quest'];
$priz_q = $row_lool['priz_q'];
$m_stop = $row_lool['m_stop'];
$mm_id = $_GET['m'];
$mm_id = mysqli_real_escape_string($dbc, trim($mm_id));
?>
<?php if ($vid_m == $mm_id and $m_stop != '1') {?>
<?php
$query = "update users set kol=kol+'1', m_stop='1' where id = '$user_idd' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
					 <?php 
					 $query_i="select id_fight from m_inf where user_id='$user_id' and monster_id='$monster_id' limit 1";
					 $result_i = mysqli_query($dbc, $query_i) or die ('Ошибка передачи запроса к БД2');
                     $row_i = mysqli_fetch_array($result_i);
					 $id_ff=$row_i['id_fight'];
					 $id_mm=$row_i['id_monster'];
					 $query_i="select user_id, thing_id, thing_id2 from m_inf where id_fight='$id_ff' and thing_id<>0";
					 $result_i = mysqli_query($dbc, $query_i) or die ('Ошибка передачи запроса к БД2');
					 $row_i = mysqli_num_rows($result_i);
                     while ($row_i = mysqli_fetch_array($result_i)) {
					   $id_iu=$row_i['user_id'];
					   $query_iu="select nick,gruppa from users where id='$id_iu' limit 1";
					   $result_iu = mysqli_query($dbc, $query_iu) or die ('Ошибка передачи запроса к БД2');
					   $row_iu = mysqli_fetch_array($result_iu);
					   if ($row_i['thing_id'] == -1) {
					   ?><p><?php
					   if ($row_iu['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
					   ?> <a href="profile.php?id=<?php echo "$id_iu";?>"><?php echo $row_iu['nick'];?></a> <b><span class="red">не получил награду из-за полного рюкзака</span></b></p><?php
					   }
					   else {
					   $t_id=$row_i['thing_id'];
					   $query_it="select type,inf_id from things where thing_id='$t_id' limit 1";
					   $result_it = mysqli_query($dbc, $query_it) or die ('Ошибка передачи запроса к БД2');
					   $row_it = mysqli_fetch_array($result_it);
					   $inf_id = $row_it['inf_id'];
					   if ($row_it['type'] == 1) {
					     $query_it="select name, klass from clothes where clothes_id='$inf_id' limit 1";
					     $result_it = mysqli_query($dbc, $query_it) or die ('Ошибка передачи запроса к БД2');
					     $row_it = mysqli_fetch_array($result_it);
					   }
					   if ($row_it['type'] == 2) {
					     $query_it="select name, klass from pistols where pistols_id='$inf_id' limit 1";
					     $result_it = mysqli_query($dbc, $query_it) or die ('Ошибка передачи запроса к БД2');
					     $row_it = mysqli_fetch_array($result_it);
					   }
					   if ($row_it['type'] == 3) {
					     $query_it="select name, klass from weapons where weapons_id='$inf_id' limit 1";
					     $result_it = mysqli_query($dbc, $query_it) or die ('Ошибка передачи запроса к БД2');
					     $row_it = mysqli_fetch_array($result_it);
					   }
					   ?><p><?php
					   if ($row_iu['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
					   ?> <a href="profile.php?id=<?php echo "$id_iu";?>"><?php echo $row_iu['nick'];?></a> <b><span class="bonus"> получил</span></b> <?php 
					   if ($monster_id<>3 and $monster_id<>5) {
					   if ($row_it['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
	                   if ($row_it['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
	                   if ($row_it['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
					   if ($row_it['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
					   ?><a href="thing.php?thing=<?php echo "$t_id";?>"><?php echo $row_it['name']; ?></a><?php
					   }else {
					   ?><b><span class="bonus"><img src="img/ico/materials.png" width="12" height="12"/> <?php echo "$t_id";?></span></b><?php
					   }
					   ?></p><?php
					   }
					   if ($row_i['thing_id2'] <> 0) {
					   if ($row_i['thing_id2'] == -1) {
					   ?><p><?php
					   if ($row_iu['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
					   ?> <a href="profile.php?id=<?php echo "$id_iu";?>"><?php echo $row_iu['nick'];?></a> <b><span class="red">не получил награду из-за полного рюкзака</span></b></p><?php
					   }
					   else {
					   $t_id=$row_i['thing_id2'];
					   $query_it="select type,inf_id from things where thing_id='$t_id' limit 1";
					   $result_it = mysqli_query($dbc, $query_it) or die ('Ошибка передачи запроса к БД2');
					   $row_it = mysqli_fetch_array($result_it);
					   $inf_id = $row_it['inf_id'];
					   if ($row_it['type'] == 1) {
					     $query_it="select name, klass from clothes where clothes_id='$inf_id' limit 1";
					     $result_it = mysqli_query($dbc, $query_it) or die ('Ошибка передачи запроса к БД2');
					     $row_it = mysqli_fetch_array($result_it);
					   }
					   if ($row_it['type'] == 2) {
					     $query_it="select name, klass from pistols where pistols_id='$inf_id' limit 1";
					     $result_it = mysqli_query($dbc, $query_it) or die ('Ошибка передачи запроса к БД2');
					     $row_it = mysqli_fetch_array($result_it);
					   }
					   if ($row_it['type'] == 3) {
					     $query_it="select name, klass from weapons where weapons_id='$inf_id' limit 1";
					     $result_it = mysqli_query($dbc, $query_it) or die ('Ошибка передачи запроса к БД2');
					     $row_it = mysqli_fetch_array($result_it);
					   }
					   ?><p><?php
					   if ($row_iu['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
					   ?> <a href="profile.php?id=<?php echo "$id_iu";?>"><?php echo $row_iu['nick'];?></a> <b><span class="bonus"> получил</span></b> <?php 
					   if ($monster_id<>3 and $monster_id<>5) {
					   if ($row_it['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
	                   if ($row_it['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
	                   if ($row_it['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
					   if ($row_it['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
					   ?><a href="thing.php?thing=<?php echo "$t_id";?>"><?php echo $row_it['name']; ?></a><?php
					   }else {
					   ?><b><span class="bonus"><img src="img/ico/materials.png" width="12" height="12"/> <?php echo "$t_id";?></span></b><?php
					   }
					   ?></p><?php
					   }
					   }
					   ///////////////////Теперь участие
					   $query_i="select user_id, active from m_inf where id_fight='$id_ff'  order by active  DESC";
					   $result_i = mysqli_query($dbc, $query_i) or die ('Ошибка передачи запроса к БД2');
					   $row_i = mysqli_num_rows($result_i);
                       while ($row_i = mysqli_fetch_array($result_i)) {
					   $id_iu=$row_i['user_id'];
					   $query_iu="select nick,gruppa from users where id='$id_iu' and last_active > NOW() - 60 limit 1";
					   $result_iu = mysqli_query($dbc, $query_iu) or die ('Ошибка передачи запроса к БД2');
					   $row_iu = mysqli_fetch_array($result_iu);
					   if (!empty($row_iu)) {
					   ?><p><?php
					   if ($row_iu['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
	                   if ($row_iu['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
					   ?> <a href="profile.php?id=<?php echo "$id_iu";?>"><?php echo $row_iu['nick'];?></a> <b><span class="bonus">(<?php echo $row_i['active'];?>)</span></b></p><?php 
					   }
					   }
					   //////////////////////////////////
					 }
					 ?><br />
					 <p><img src="img/ico/left.png" /> <a href="monsters.php">К списку рейдов</a></p>
			  
              <?php
			     } 
			   if ($row_isset['start'] <> 0 and $row_isset['hp']>0) {?>
			     <p><img src="img/ico/pistol.png" width="12" height="12" alt="m"/> <a href="attack.php?weapon=pistol">Стрелять с пистолета</a></p>
				 <?php
				 if ($row_user['sost_w'] > 0 and $row_isset['hp']>0) {?> 
				 <p><img src="img/ico/avtomat.png" width="12" height="12" alt="m"/> <a href="attack.php?weapon=avtomat">Стрелять с автомата</a></p>
			   <?php
			     }
				 if ($row_user['aptechki'] >0 and $row_user['monst_apt']>0) {
				 ?><p>-</p>
				<p><img src="img/ico/apte4ka.png" width="12" height="12" alt="m"/> <a href="uphealth.php">Использовать аптечку</a></p><?php
			     }
			   }
			   ?>
			</div>
			<?php
			} 
			else {
			?>
            <div id="error">
			<p>Вас убили. Дождитесь окончания боя.</p>
			<p><img src="img/ico/point.png" width="12" height="12"/> <a href="death.php?re=1&m=<?php echo "$monster_id";?>">Восстановиться</a></p>
			</div>
            <?php
			}
			?>
		  </div>
			<?php
			}
}
//////////////////////////////////////
require_once('conf/log.php');
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html