<?php
$log_id = $_SESSION['id'];
$query_log = "SELECT * FROM `log` where location = '$location' or location = 'all' and user_id = '$log_id' or thing = '$log_id' ORDER BY `log_id` DESC limit 8";
$result_log = mysqli_query($dbc, $query_log) or die ('Ошибка передачи запроса к БД');
$count_log = mysqli_num_rows($result_log);
////////////////////////////ЧАТ!!!!
$query_ch = "Select clan, clan_rang from users where id = '$log_id'";
$result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
$row_ch = mysqli_fetch_array($result_ch);
$clan_ch = $row_ch['clan'];
$clan_rang_ch = $row_ch['clan_rang'];
$query_user = "Select gruppa, nick from users where id = '$log_id'";
  $result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД1');
  $row_user = mysqli_fetch_array($result_user);
if (!empty($clan_ch)) {
    $say_err=$_GET['say_err'];
    if(!empty($say_err)) {
		 if ($say_err == 1) {?><span id="error">Длина сообщения должна быть не больше 64 символов</span><?php }
		 if ($say_err == 2) {?><span id="error">Длина сообщения должна быть не больше 64 символов</span><?php }
	 }
	   
   ?> <div class="stats">
	 <form enctype="multipart/form-data" method="post" action="addchatcompany.php">
	 <input type="text" style="width:50%; height:18px;" class="input" name="say" />
     <input type="submit" style="width:35px;" class="input" value="+" name="addchat"/>
     </form>
   <?php
  $query_chat = "SELECT * FROM `clan_chat` where clan_id = '$clan_ch' and time > NOW() - 120 ORDER BY `time` DESC limit 5";
  $result_chat = mysqli_query($dbc, $query_chat) or die ('Ошибка передачи запроса к БД');
  $count_chat = mysqli_num_rows($result_chat);
  if (!empty($count_chat)) {
    while ($row_chat = mysqli_fetch_array($result_chat)) {
    $id_chat = $row_chat['user_id'];
	$query_ch = "Select nick from users where id = '$id_chat'";
    $result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД'); 
	$row_ch=mysqli_fetch_array($result_ch);
	$say = $row_chat['say'];
	?><p><a href="profile.php?id=<?php echo $row_chat['user_id'];?>"><?php echo $row_ch['nick'];?></a>: <span class="white"><?php echo "$say";?></span></p>
<?php
    }
  }
  ?>
  </div>
  <?php
}
////////////////////////////////
///////////////////////////
if ($count_log <> 0) {
  /////////////////////////////////////////////////////
  ////lsjdfshdffsldkfslkdjfslkjfklsjdflkjsdlkfskldf///
  /////////////////////////////////////////////////////
  ?><div class="stats">
  <?php
  while ($row_log = mysqli_fetch_array($result_log)) {
    $sboitie = $row_log['sboitie'];
    $user_id_a = $row_log['user_id'];
    $thing = $row_log['thing'];
	$yron = $row_log['yron'];
	
	//////////////////////////////////////////////////////////////
	if (($sboitie == 1) and ($user_id_a == $log_id )) {
	$query_inf = "Select nick, gruppa from users where id = '$thing'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	$nick_inf = $row_inf['nick'];
	$gruppa_inf = $row_inf['gruppa'];
	?> <p>
	<?php if ($row_user['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
    if ($row_user['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
    if ($row_user['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
    if ($row_user['gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
    ?>
	<a href="profile.php?id=<?php echo "$log_id"?>"><?php echo $row_user['nick'];?></a> попал в <?php
	if ($gruppa_inf == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa_inf == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa_inf == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/><?php }
	if ($gruppa_inf == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="n"/><?php }
	?> <a href="profile.php?id=<?php echo "$thing";?>"><?php echo "$nick_inf";?></a> на <?php echo "$yron";?></p>
	<?php }
	///////////////////////////////////////////////////////////
	if (($sboitie == 1) and ($thing == $log_id )) {
	$query_inf = "Select nick, gruppa from users where id = '$user_id_a'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	$nick_inf = $row_inf['nick'];
	$gruppa_inf = $row_inf['gruppa'];
	?> <p style="color:#cc4300;">Вас задел 
	<?php 
	if ($gruppa_inf == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa_inf == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa_inf == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/><?php } 
	if ($gruppa_inf == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="n"/><?php }
	?> <a style="color:#cc4300;" href="profile.php?id=<?php echo "$user_id_a";?>"><?php echo "$nick_inf";?></a> на <?php echo "$yron";?></p>
  <?php }
	//////////////////////////////////////////////////////////////
    if (($sboitie == 2) and ($user_id_a == $log_id )) {
    $query_inf = "Select nick, gruppa from users where id = '$thing'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	$nick_inf = $row_inf['nick'];
	$gruppa_inf = $row_inf['gruppa'];
	?> <p>Вы убили <?php
	if ($gruppa_inf == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa_inf == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa_inf == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/> <?php }
	if ($gruppa_inf == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="n"/><?php }
	?>
	<a href="profile.php?id=<?php echo "$thing"; ?>">
    <?php  echo "$nick_inf";?></a></p><?php }
		//////////////////////////////////////////////////////////////
    if (($sboitie == 2) and ($thing == $log_id )) {
    $query_inf = "Select nick, gruppa from users where id = '$user_id_a'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	$nick_inf = $row_inf['nick'];
	$gruppa_inf = $row_inf['gruppa'];
	?> <p>Вас убил <?php
	if ($gruppa_inf == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	if ($gruppa_inf == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	if ($gruppa_inf == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/> <?php }
	if ($gruppa_inf == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="n"/><?php }
	?>
	<a href="profile.php?id=<?php echo "$user_id_a"; ?>">
    <?php  echo "$nick_inf";?></a></p><?php }
	/////////////////////////////////////////////
	if (($sboitie == 3) and ($user_id_a == $log_id )) {?> <p class="white">Вы промахнулись</p><?php }
	if (($sboitie == 4) and ($user_id_a == $log_id )) {?> <p>Вы получили <img src="img/ico/materials.png" width="12" height="12"/> <?php echo "$thing";?></p><?php }
	if (($sboitie == 4) and ($user_id_a <> $log_id )) {?> <p>
	  <?php
	  $query_inf = "Select nick, gruppa from users where id = '$user_id_a'";
      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
      $row_inf = mysqli_fetch_array($result_inf);
	  $nick_inf = $row_inf['nick'];
	  $gruppa_inf = $row_inf['gruppa'];
	  if ($gruppa_inf == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	  if ($gruppa_inf == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="d"/><?php }
	  if ($gruppa_inf == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="n"/><?php } 
	if ($gruppa_inf == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="n"/><?php }
	  ?> <a href="profile.php?id=<?php echo "$user_id_a";?>"><?php echo "$nick_inf";?></a> получил <img src="img/ico/materials.png" width="12" height="12"/> <?php echo "$thing";?></p>    <?php }
	  if (($sboitie == 5) and ($user_id_a == $log_id )) {?><p >Вы использовали <img src="img/ico/apte4ka.png" width="12" height="12"/> аптечку</p><?php }
	  if (($sboitie == 6) and ($user_id == $log_id )) {?><p class="bonus"><b>Ваш уровень поднялся до <?php echo "$yron";?></b></p><?php }
	  if (($sboitie == 7) and ($user_id == $log_id )) {?><p><?php if ($row_us['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
    if ($row_user['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
    if ($row_user['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
    if ($row_user['gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
    ?>
	<a href="profile.php?id=<?php echo "$log_id"?>"><?php echo $row_user['nick'];?></a> атаковал БП на <?php echo "$yron";?></p><?php }
	if (($sboitie == 8) and ($user_id_a == $log_id )) {?> <p class="white">Оружие заклинило</p><?php }
	if (($sboitie == 9) and ($user_id_a == $log_id )) {?><p class="white">Вы использовали <img src="img/ico/antirad.png" width="12" height="12"/> антирад</p><?php }
	$query_inf = "Select name from monsters where id_monster = '$user_id_a'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	if (($sboitie == 10) and ($user_id == $thing )) {
	$query_inf = "Select name from monsters where id_monster = '$user_id_a'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	?><p style="color:#cc4300;">Вас атаковал <?php echo $row_inf['name'] . ' на ' . "$yron";?></p><?php }
	if (($sboitie == 11) and ($user_id == $thing )) {
	$query_inf = "Select name from monsters where id_monster = '$user_id_a'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	?><p style="color:#cc4300;">Вас убил <?php echo $row_inf['name']?></p><?php }
	if (($sboitie == 12) and ($user_id_a == $log_id )) {
	$query_inf = "Select name from monsters where id_monster = '$thing'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	$name = $row_inf['name'];
	?> <p><?php if ($row_user['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
    if ($row_user['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
    if ($row_user['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
    if ($row_user['gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
    ?> <a href="profile.php?id=<?php echo "$log_id"?>"><?php echo $row_user['nick'];?></a> попал в <?php echo "$name";?> на <?php echo "$yron";?></p>
	<?php }
	if (($sboitie == 13) and ($user_id_a == $log_id )) {
	$query_inf = "Select name from monsters where id_monster = '$thing'";
    $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД'); 
    $row_inf = mysqli_fetch_array($result_inf);
	$name = $row_inf['name'];
	?> <p><?php if ($row_user['gruppa'] == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
    if ($row_user['gruppa'] == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
    if ($row_user['gruppa'] == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/><?php }
    if ($row_user['gruppa'] == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="o"/><?php }
    ?> <a href="profile.php?id=<?php echo "$log_id"?>"><?php echo $row_user['nick'];?></a> убил <?php echo "$name";?></p>
	<?php }
	if (($sboitie == 14) and ($user_id_a == $log_id )) {?><p class="bonus"><b>Вы нашли <img src="img/ico/antirad.png" width="12" height="12"/> антирад</b></p><?php }
	if (($sboitie == 15) and ($user_id_a == $log_id )) {?><p class="bonus"><b>Вы нашли <img src="img/ico/apte4ka.png" width="12" height="12"/> аптечку</b></p><?php }
  }
  
  ?>
  </div>
  
  <?php
}