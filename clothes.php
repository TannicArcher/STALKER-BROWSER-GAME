<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Одежда';
require_once('conf/head.php');
$user_id = $_GET['id'];
$user_id = mysqli_real_escape_string($dbc, trim($user_id));	
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
$query = "Select * from users where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
if ($row['gruppa'] == 'mytants') {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
if ($row['gruppa'] == 'monolits') {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
if ($row['gruppa'] == 'zombie') {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
if ($row['gruppa'] == 'bandits') {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
if ($row == 0) {
require_once('conf/notfound.php');
}
else {
  ?>
  <div id="main">
    <div class="stats">
	  <p class="podmenu">Снаряжение <?php echo $row['nick']; ?></p>
    </div>
	<?php
  if ($user_id == $_SESSION['id']) {?>
	<div class="stats">
	<p><img src="img/ico/point.png" width="12" height="12"/> <a href="bag.php">Открыть рюкзак</a></p>
	<p><img src="img/ico/point.png" width="12" height="12"/> <a href="allremont.php">Починить всё</a></p>
    </div>
    <?php
	}
	$query_cl = "Select inf_id,stat1,stat2, stat3, upgrade_stat3 ,speed, sost,privat,thing_id, upgrade_speed, upgrade_stat1, upgrade_stat2 from things where user_id = '$user_id' and type = '4' and place='2' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$thing_id = $row_cl['thing_id'];
	$sostoyanie_1 = $row_cl['sost'];
	$upgrade_speed = $row_cl['upgrade_speed'];
	$upgrade_stat1 = $row_cl['upgrade_stat1'];
	$upgrade_stat2 = $row_cl['upgrade_stat2'];
	$upgrade_stat3 = $row_cl['upgrade_stat3'];
	$razriv = $row_cl['stat3'];
	$hp = $row_cl['stat1'];
	$radiation = $row_cl['speed'];
	$prochn = $row_cl['stat2'];
	$helmet_id = $row_cl['inf_id'];
	$privat = $row_cl['privat'];
	$query_cl = "Select screen,name,klass from helmets where helmet_id = '$helmet_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/helmets/<?php echo $row_cl['screen'];?>" alt="Слот №1" width="40" height="40"/></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a class="white" href="thing.php?thing=<?php echo "$thing_id";?>"><?php echo $row_cl['name'];?></a><?php if ($privat == 0) { echo ", новый";}
	if ($privat == 1) { echo ", личный";}?></p>
        <p><?php
		if ($upgrade_stat2 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat2 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat2 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat2 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?>
		 Броня: <span class="white"><?php echo "$prochn";?></span> </p>
        <p><?php
		if ($upgrade_stat1 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat1 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat1 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat1 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Здор: <span class="white"><?php echo "$hp";?></span> 
		</p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	<div class="clothes">
	  <p><?php
		if ($upgrade_speed == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_speed == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_speed == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_speed >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Рад. защ: <span class="white"><?php echo "$radiation";?></span>
		</p>
	  <p>- - - - - - - - - - - - </p>
      <p>Состояние: <span class="white"><?php echo "$sostoyanie_1";?>/8</span></p>
	  </div>
	  <?php
      if ($user_id == $_SESSION['id']) {
	  if ($sostoyanie_1 == 0) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>240</a></p>
	  <?php }
	   if ($sostoyanie_1 == 1) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>210</a></p><?php }  
	   if ($sostoyanie_1 == 2) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($sostoyanie_1 == 3) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($sostoyanie_1== 4) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($sostoyanie_1 == 5) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($sostoyanie_1 == 6) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($sostoyanie_1 == 7) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  <p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>]</p>
	  <?php
	  }
      ?>
	  
    </div>
	<?php
	}
	else {
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/helmets/0.png" alt="Слот №1" /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p><span class="white">Ничего не одето</span></p>
        <p>Броня: <span class="white">---</span></p>
        <p>Здоровье: <span class="white">---</span></p>
		<p>Рад.защ: <span class="white">---</span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	</div>

	    <?php
	}
	$query_cl = "Select inf_id,stat1,stat2, stat3, upgrade_stat3 ,speed, sost,privat,thing_id, upgrade_speed, upgrade_stat1, upgrade_stat2 from things where user_id = '$user_id' and type = '6' and place='2' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$thing_id = $row_cl['thing_id'];
	$sostoyanie_1 = $row_cl['sost'];
	$upgrade_speed = $row_cl['upgrade_speed'];
	$upgrade_stat1 = $row_cl['upgrade_stat1'];
	$upgrade_stat2 = $row_cl['upgrade_stat2'];
	$upgrade_stat3 = $row_cl['upgrade_stat3'];
	$razriv = $row_cl['stat3'];
	$hp = $row_cl['stat1'];
	$radiation = $row_cl['speed'];
	$prochn = $row_cl['stat2'];
	$art_id = $row_cl['inf_id'];
	$privat = $row_cl['privat'];
	$query_cl = "Select screen,name,klass from art where art_id = '$art_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/art/<?php echo $row_cl['screen'];?>" alt="Слот №1"/></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['speed'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['speed'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['speed'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['speed'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a class="white" href="thing.php?thing=<?php echo "$thing_id";?>"><?php echo $row_cl['name'];?></a><?php if ($privat == 0) { echo ", новый";}
	if ($privat == 1) { echo ", личный";}?></p>
        <p><?php
		if ($upgrade_stat1 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat1 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat1 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat1 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Реген: <span class="white"><?php echo "$radiation";?></span> 
		</p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <?php
      if ($user_id == $_SESSION['id']) {
	  if ($sostoyanie_1 == 0) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>240</a></p>
	  <?php }
	   if ($sostoyanie_1 == 1) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>210</a></p><?php }  
	   if ($sostoyanie_1 == 2) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($sostoyanie_1 == 3) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($sostoyanie_1== 4) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($sostoyanie_1 == 5) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($sostoyanie_1 == 6) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($sostoyanie_1 == 7) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  <p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>]</p>
	  <?php
	  }
      ?>
	  
    </div>
	<?php
	}
	else {
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/helmets/0.png" alt="Слот №1" /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p><span class="white">Пояс пуст</span></p>
        <p>Реген: <span class="white">---</span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	</div>
	<?php
	}
	$query_cl = "Select inf_id,stat1,stat2, stat3, upgrade_stat3 ,speed, sost,privat,thing_id, upgrade_speed, upgrade_stat1, upgrade_stat2 from things where user_id = '$user_id' and type = '7' and place='2' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$thing_id = $row_cl['thing_id'];
	$sostoyanie_1 = $row_cl['sost'];
	$upgrade_speed = $row_cl['upgrade_speed'];
	$upgrade_stat1 = $row_cl['upgrade_stat1'];
	$upgrade_stat2 = $row_cl['upgrade_stat2'];
	$upgrade_stat3 = $row_cl['upgrade_stat3'];
	$razriv = $row_cl['stat3'];
	$hp = $row_cl['stat1'];
	$radiation = $row_cl['speed'];
	$prochn = $row_cl['stat2'];
	$dec_id = $row_cl['inf_id'];
	$privat = $row_cl['privat'];
	$query_cl = "Select screen,name,klass from detectors where dec_id = '$dec_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/dec/<?php echo $row_cl['screen'];?>" alt="Слот №3" <?php if ($dec_id == '1') {?>width="65" height="75"<?php } else {?>width="66" height="65"<?php }?> /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['speed'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['speed'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['speed'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['speed'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a class="white" href="thing.php?thing=<?php echo "$thing_id";?>"><?php echo $row_cl['name'];?></a><?php if ($privat == 0) { echo ", новый";}
	if ($privat == 1) { echo ", личный";}?></p>
        <p><?php
$lal = ('100' - $radiation);
		if ($upgrade_stat1 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat1 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat1 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat1 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> ш.н.а.: <span class="white"><?php echo "$radiation";?>%</span> 
		</p>
<p> ш.п. в а.: <span class="white"><?php echo "$lal";?>%</span></p>
<p> ш.у.п.д.: <span class="white"><?php echo "$radiation";?>%</span></p>
<p> п.п.п.д.: <span class="white"><?php echo "$hp";?>-<?php echo "$prochn";?>%</span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	  <?php
      if ($user_id == $_SESSION['id']) {
	  if ($sostoyanie_1 == 0) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>240</a></p>
	  <?php }
	   if ($sostoyanie_1 == 1) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>210</a></p><?php }  
	   if ($sostoyanie_1 == 2) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($sostoyanie_1 == 3) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($sostoyanie_1== 4) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($sostoyanie_1 == 5) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($sostoyanie_1 == 6) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($sostoyanie_1 == 7) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  <p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>]</p>
	  <?php
	  }
      ?>
	  
    </div>
	<?php
	}
	else {
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/helmets/0.png" alt="Слот №1" /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p><span class="white">Детектора нет</span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	</div>
	<?php
	}
///////////////////////////////////////////////////////////////////////////////////Слот№2
	$query_cl = "Select inf_id,stat1,stat2, stat3, upgrade_stat3 ,speed, sost,privat,thing_id, upgrade_speed, upgrade_stat1, upgrade_stat2 from things where user_id = '$user_id' and type = '1' and place='2' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	if ($row_cl != 0) {
	$thing_id = $row_cl['thing_id'];
	$sostoyanie_1 = $row_cl['sost'];
	$upgrade_speed = $row_cl['upgrade_speed'];
	$upgrade_stat1 = $row_cl['upgrade_stat1'];
	$upgrade_stat2 = $row_cl['upgrade_stat2'];
	$upgrade_stat3 = $row_cl['upgrade_stat3'];
	$razriv = $row_cl['stat3'];
	$hp = $row_cl['stat1'];
	$radiation = $row_cl['speed'];
	$prochn = $row_cl['stat2'];
	$clothes_id = $row_cl['inf_id'];
	$privat = $row_cl['privat'];
	$query_cl = "Select screen,name,klass from clothes where clothes_id = '$clothes_id' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/clothes/<?php echo $row_cl['screen'];?>" alt="Слот №1" width="70" height="70"/></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p>
		<?php
		if ($row_cl['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row_cl['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a class="white" href="thing.php?thing=<?php echo "$thing_id";?>"><?php echo $row_cl['name'];?></a><?php if ($privat == 0) { echo ", новый";}
	if ($privat == 1) { echo ", личный";}?></p>
        <p><?php
		if ($upgrade_stat2 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat2 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat2 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat2 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?>
		 Броня: <span class="white"><?php echo "$prochn";?></span> </p>
        <p><?php
		if ($upgrade_stat1 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat1 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat1 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat1 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Здор: <span class="white"><?php echo "$hp";?></span> 
		</p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	<div class="clothes">
	  <p><?php
		if ($upgrade_stat3 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat3 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat3 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat3 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Прочность: <span class="white"><?php echo "$razriv";?></span></p>
	  <p><?php
		if ($upgrade_speed == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_speed == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_speed == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_speed >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Рад. защ: <span class="white"><?php echo "$radiation";?></span>
		</p>
	  <p>- - - - - - - - - - - - </p>
      <p>Состояние: <span class="white"><?php echo "$sostoyanie_1";?>/8</span></p>
	  </div>
	  <?php
      if ($user_id == $_SESSION['id']) {
	  if ($sostoyanie_1 == 0) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>240</a></p>
	  <?php }
	   if ($sostoyanie_1 == 1) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>210</a></p><?php }  
	   if ($sostoyanie_1 == 2) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($sostoyanie_1 == 3) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($sostoyanie_1== 4) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($sostoyanie_1 == 5) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($sostoyanie_1 == 6) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($sostoyanie_1 == 7) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  <p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>] [<a href="upgrade.php?thing=<?php echo "$thing_id";?>">Улучшить</a>]</p>
	  <?php
	  }
      ?>
	  
    </div>
	<?php
	}
	else {
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/clothes/0.png" alt="Слот №1" /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p><span class="white">Ничего не одето</span></p>
        <p>Броня: <span class="white">---</span></p>
        <p>Здоровье: <span class="white">---</span></p>
		<p>Прочность: <span class="white">---</span></p>
		<p>Рад.защ: <span class="white">---</span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	</div>
	<?php
	}
///////////////////////////////////////////////////////////////////////////////////Слот№2
	$query_cl = "Select inf_id,stat1,stat2,stat3, upgrade_stat3 ,sost,privat,speed,upgrade_speed, upgrade_stat1, upgrade_stat2, thing_id from things where user_id = '$user_id' and type = '2' and place='2' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row2 = mysqli_fetch_array($result_cl);
	if ($row2 != 0) {
	$privat = $row2['privat'];
	$thing_id = $row2['thing_id'];
	$yron2 = $row2['stat1'];
	$tochn2 = $row2['stat2'];
	$safety = $row2['stat3'];
	$speed2 = $row2['speed'];
	$upgrade_speed = $row2['upgrade_speed'];
	$upgrade_stat1 = $row2['upgrade_stat1'];
	$upgrade_stat2 = $row2['upgrade_stat2'];
	$upgrade_stat3 = $row2['upgrade_stat3'];
	$sostoyanie_2 = $row2['sost'];
	$pistols_id = $row2['inf_id'];
	$query2 = "Select screen,name,klass from pistols where pistols_id = '$pistols_id' limit 1";
	$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
	$row2 = mysqli_fetch_array($result2);
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/weapons/<?php echo $row2['screen'];?>" alt="Слот №1" /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p><?php
		if ($row2['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row2['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row2['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row2['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a class="white" href="thing.php?thing=<?php echo "$thing_id";?>"><?php echo $row2['name'];?></a><?php if ($privat == 0) { echo ", новый";}
	if ($privat == 1) { echo ", личный";}?></p>
        <p><?php
		if ($upgrade_stat1 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat1 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat1 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat1 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Урон: <span class="white"><?php echo "$yron2";?></span> </p>
    <p><?php
		if ($upgrade_stat2 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat2 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat2 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat2 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Точн: <span class="white"><?php echo "$tochn2";?></span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	<div class="clothes">
	  <p><?php
		if ($upgrade_stat3 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat3 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat3 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat3 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Надёжность: <span class="white"><?php echo "$safety";?></span></p>
	  <p><?php
		if ($upgrade_speed == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>-1сек)</span><?php }
		if ($upgrade_speed == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>-2сек)</span><?php }
		if ($upgrade_speed == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>-3сек)</span><?php }
		if ($upgrade_speed >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>-4сек)</span><?php }
		?> Скорострельность: <span class="white"><?php echo "$speed2";?>сек</span></p>
	   <p>- - - - - - - - - - - - </p>
      <p>Состояние: <span class="white"><?php echo "$sostoyanie_2";?>/8</span></p>
	  </div>
	  <?php
      if ($user_id == $_SESSION['id']) {
	   if ($sostoyanie_2 == 0) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>240</a></p>
	  <?php }
	   if ($sostoyanie_2 == 1) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>210</a></p><?php }  
	   if ($sostoyanie_2 == 2) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($sostoyanie_2 == 3) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($sostoyanie_2== 4) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($sostoyanie_2 == 5) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($sostoyanie_2 == 6) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($sostoyanie_2== 7) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  <p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>] [<a href="upgrade.php?thing=<?php echo "$thing_id";?>">Улучшить</a>]</p>
	  <?php
	  }
      ?>
	<?php
	}
	else {
	?>
	<div class="slot">
      <table width="190" border="0" cellpadding="0" cellspacing="0">
      <tbody>
      <tr>
      <td width="54" valign="top"><img src="img/weapons/0pistol.png" alt="Слот №1" /></td>
      <td width="136" valign="top">
	  <div class="clothes">
	    <p><span class="white">Ничего не одето</span></p>
        <p>Урон: <span class="white">---</span></p>
        <p>Точность: <span class="white">---</span></p>
		<p>Надёжность: <span class="white">---</span></p>
		<p>Скорострельность: <span class="white">---</span></p>
      </div>
	  </td>
      </tr>
      </tbody>
      </table>
	</div>
	
	<?php
	}
	?>
	</div>
	<?php
	//////////////////////////////////////////////////////////////
	$query_cl = "Select inf_id,stat1,stat2,stat3,upgrade_stat1, upgrade_stat2, upgrade_stat3, upgrade_speed,sost,privat,speed,thing_id from things where user_id = '$user_id' and type = '3' and place='2' limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row3 = mysqli_fetch_array($result_cl);
	if ($row3 != 0) {
	$privat = $row3['privat'];
	$thing_id = $row3['thing_id'];
	$yron3 = $row3['stat1'];
	$tochn3 = $row3['stat2'];
	$safety = $row3['stat3'];
	$speed3 = $row3['speed'];
	$upgrade_speed = $row3['upgrade_speed'];
	$upgrade_stat1 = $row3['upgrade_stat1'];
	$upgrade_stat2 = $row3['upgrade_stat2'];
	$upgrade_stat3 = $row3['upgrade_stat3'];
	$sostoyanie_3 = $row3['sost'];
	$weapons_id = $row3['inf_id'];
	$query3 = "Select screen,name,klass from weapons where weapons_id = '$weapons_id'";
	$result3 = mysqli_query($dbc, $query3) or die ('Ошибка передачи запроса к БД');
	$row3 = mysqli_fetch_array($result3);
	?>	
	<div class="slot">
	<div class="clothes">
	<p><?php
		if ($row3['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
		if ($row3['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
		if ($row3['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
		if ($row3['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
		?><a class="white" href="thing.php?thing=<?php echo "$thing_id";?>"><?php echo $row3['name'];?></a><?php if ($privat == 0) { echo ", новый";}
	if ($privat == 1) { echo ", личный";}?></p>
    <img src="img/weapons/<?php echo $row3['screen'];?>" alt="Слот №3" width="145" height="50"/>
    <p><?php
		if ($upgrade_stat1 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat1 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat1 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat1 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Урон: <span class="white"><?php echo "$yron3";?></span> 
	</p>
    <p><?php
		if ($upgrade_stat2 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat2 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat2 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat2 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Точн: <span class="white"><?php echo "$tochn3";?></span> 
	</p>
	<p><?php
		if ($upgrade_stat3 == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>+15%)</span><?php }
		if ($upgrade_stat3 == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>+25%)</span><?php }
		if ($upgrade_stat3 == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>+50%)</span><?php }
		if ($upgrade_stat3 >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>+75%)</span><?php }
		?> Надёжность: <span class="white"><?php echo "$safety";?></span></p>
	<p><?php
		if ($upgrade_speed == 1) {?><span class="bonus">(<img src="img/ico/class1.png" width="12" height="12"/>-15%)</span><?php }
		if ($upgrade_speed == 2) {?><span class="bonus">(<img src="img/ico/class2.png" width="12" height="12"/>-25%)</span><?php }
		if ($upgrade_speed == 3) {?><span class="bonus">(<img src="img/ico/class3.png" width="12" height="12"/>-50%)</span><?php }
		if ($upgrade_speed >= 4) {?><span class="bonus">(<img src="img/ico/class4.png" width="12" height="12"/>-75%)</span><?php }
		?> Скорострельность: <span class="white"><?php echo "$speed3";?>сек</span></p>
    <p>- - - - - - - - - - - - </p>
    <p>Состояние: <span class="white"><?php echo "$sostoyanie_3";?>/8</span></p>
	 </div>
	  <?php
      if ($user_id == $_SESSION['id']) {
	   if ($sostoyanie_3 == 0) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>240</a></p>
	  <?php }
	   if ($sostoyanie_3 == 1) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>210</a></p><?php }  
	   if ($sostoyanie_3 == 2) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>180</a></p><?php } 
	   if ($sostoyanie_3 == 3) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>150</a></p><?php } 
	   if ($sostoyanie_3== 4) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>120</a></p><?php } 
	   if ($sostoyanie_3 == 5) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>90</a></p><?php }
	   if ($sostoyanie_3 == 6) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>60</a></p><?php }  
	   if ($sostoyanie_3== 7) {?><p><a href="fix.php?thing=<?php echo "$thing_id";?>">Починить за <img src="img/ico/materials.png" width="12" height="12"/>30</a></p><?php }
	  ?>
	  <p>[<a href="inbag.php?thing=<?php echo "$thing_id";?>">В рюкзак</a>]  [<a href="upgrade.php?thing=<?php echo "$thing_id";?>">Улучшить</a>]</p>
	 <?php
	 }
     ?>
	</div>
	<?php
	}
	else {
	?>
	<div class="slot">
	<div class="clothes">
	<p><span class="white">Ничего не одето</span></p>
	<img src="img/weapons/0weapon.png" alt="Слот №3" width="145" height="50"/>
    <p>Урон: <span class="white">---</span></p>
    <p>Точность: <span class="white">---</span></p>
	<p>Надёжность: <span class="white">---</span></p>
	<p>Скорострельность: <span class="white">---</span></p>
	</div>
	</div>
	<?php
	}
	?>
</div>
	<?php
}
  require_once('conf/navig.php');
  require_once('conf/foot.php');
  mysqli_close($dbc);
  ?>

</body>
</html>