<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Список отрядов';
require_once('conf/head.php');
$user_id = $_SESSION['id'];
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
<div id="main">
<?php
$query_5 = "Select * from users where id='$user_id' limit 1";
$result_5 = mysqli_query($dbc, $query_5) or die ('Ошибка передачи запроса к БД');
$row_5 = mysqli_fetch_array($result_5);
$clan_rang = $row_5['clan_rang'];
$clan = $row_5['clan'];
$admin = $row_5['admin'];
$query_num2 = "Select id from users where clan='$clan' " ;
$result_num2 = mysqli_query($dbc, $query_num2) or die ('Ошибка передачи запроса к БД');
$sostav1 = mysqli_num_rows($result_num2); 
$query_7 = "Select * from clans where clan_id='$clan' limit 1";
$result_7 = mysqli_query($dbc, $query_7) or die ('Ошибка передачи запроса к БД');
$row_7 = mysqli_fetch_array($result_7);
$slava1 = $row_7['slava'];
$slava1_1 = ($slava1 / '2');
$slava1_2 = ($slava1 * '2');
$war3 = $row_7['war'];
$clan_hab = $row_7['clan_habar'];
$time_war3 = $row_7['time_war'];
$time_war3 = strtotime("$time_war3");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_war2q = ($time_war3 + '18000');
$time_q2 = ($time_war2q - $now);
?>
<?php
$query_num = "Select clan_id from clans where slava > '$slava1_1' and slava < '$slava1_2' and clan_id <> '$clan'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result_num); 
?>
<?php
$ltt = 'Такого отряда не существует';
if ($clan == '0') {?>
<?php
echo "$ltt";
exit();
?>
<?php } else {?>
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
	  $query_us = "Select * from clans where slava > '$slava1_1' and slava < '$slava1_2' and clan_id <> '$clan' order by slava DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $name = $row_us['name'];
	    $clan_id = $row_us['clan_id'];
	    $gruppa = $row_us['gruppa'];
	    $rating = $row_us['rating'];
	    $win = $row_us['win'];
	    $over = $row_us['over'];
	    $war = $row_us['war'];
	    $time_war = $row_us['time_war'];
	    $time_war = strtotime("$time_war");
	    $slava2 = $row_us['slava'];
	    $gerb = $row_us['gerb'];
$slava1_1 = ($slava1 / '2');
$slava1_2 = ($slava1 * '2');
$time_war1q = ($time_war + '18000');
$time_q1 = ($time_war1q - $now);
$query_bit = "Select * from bitva_o where clan1='$clan_id' or clan2='$clan_id' limit 1";
$result_bit = mysqli_query($dbc, $query_bit) or die ('Ошибка передачи запроса к БД1');
$row_bit = mysqli_fetch_array($result_bit);
$clan1 = $row_bit['clan1'];
$clan2 = $row_bit['clan2'];
$query_11 = "Select * from clans where clan_id='$clan1' limit 1";
$result_11 = mysqli_query($dbc, $query_11) or die ('Ошибка передачи запроса к БД2');
$row_11 = mysqli_fetch_array($result_11);
$nname1 = $row_11['name'];
$query_111 = "Select * from clans where clan_id='$clan2' limit 1";
$result_111 = mysqli_query($dbc, $query_111) or die ('Ошибка передачи запроса к БД3');
$row_111 = mysqli_fetch_array($result_111);
$nname2 = $row_111['name'];
$query_num1 = "Select id from users where clan='$clan_id' and last_active > NOW()-(1000) " ;
$result_num1 = mysqli_query($dbc, $query_num1) or die ('Ошибка передачи запроса к БД');
$sost1 = mysqli_num_rows($result_num1); 
$query_num3 = "Select id from users where clan='$clan_id' " ;
$result_num3 = mysqli_query($dbc, $query_num3) or die ('Ошибка передачи запроса к БД');
$sostav2 = mysqli_num_rows($result_num3);
$ssq = '0';

$query_sub = "Select * from users where clan = '$clan_id' order by lvl desc";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$slava = $row_sub['slava'];
?>
<?php
$ssq = ($ssq + $slava);
?>
<?php 
}
	    ?>
<div style="background: url(/style/img/1.jpg);"><br/></div>
<div style="background: url(/style/img/line.png);">
<b><?php
if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="н"/><?php }
if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="н"/><?php }
if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
?><?php echo "$name";?></b><br/>
<a href="clan.php?id=<?php echo "$clan_id";?>"><?php if ($gerb > '0') {?><img src="img/gerb/<?php echo "$gerb"; ?>.jpg" width="75" height="75"/><?php } else {?><img src="img/gerb/<?php
if ($gruppa == 'naemniki') {?>o<?php }
if ($gruppa == 'svoboda') {?>s<?php }
if ($gruppa == 'dolg') {?>d<?php }
if ($gruppa == 'mon') {?>m<?php }
?>.jpg" width="75" height="75"/><?php }?></div></a>
<img src="style/img/line.png" width="100%" height="2"/>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;"><span class="white"><b>Слава: <img src="img/slava.png"/><?php echo "$slava2";?></b></span></div>
<img src="style/img/line.png" width="100%" height="2"/>
</div>
<div style="background: url(/style/img/line.png);">
<?php if ($clan_id != $clan and $war == '0' and $time_q1 < '1' and $clan_rang > '7' and $clan_hab > '49999' and $time_q2 < '1' and $sostav1 > '4' and $sostav2 > '4' and $slava2 > $slava1_1 and $slava2 < $slava1_2) {?><a href="bitva_on.php?c_id=<?php echo "$clan_id";?>" onclick="return confirm
('Уверены?')"><img src="style/img/sig1.gif"/></a><?php }?>
<?php if ($war != '0') {?><a class="menu2" href="clan.php?id=<?php if ($clan_id == $clan1) {?><?php echo "$clan2";?><?php } else {?><?php echo "$clan1";?><?php }?>"><span class="red">Воюет с отрядом <?php if ($clan_id == $clan1) {?><?php echo "$nname2";?><?php } else {?><?php echo "$nname1";?><?php }?></span></a><?php }?>
<?php if ($war == '0' and $time_q1 > '0' and $sostav2 > '4') {?><span style="text-decoration:none; display: block; color: white;"><b>Отряд отдыхает</b></span><?php }?>
</div>
	    <?php
	  }
	  ?>
<center>
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
</center>
<?php }?>
	<?php
   /////////////////////////////////
   //////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>