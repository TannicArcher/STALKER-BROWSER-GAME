<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Отряды';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
  $user_id = $_SESSION['id'];
}
?>
    <div id="main">
    <div class="stats">
    <p class="podmenu">Отряды</p>
	</div>
<?php
$query_5 = "Select * from users where id='$user_id' limit 1";
$result_5 = mysqli_query($dbc, $query_5) or die ('Ошибка передачи запроса к БД');
$row_5 = mysqli_fetch_array($result_5);
$clan_rang = $row_5['clan_rang'];
$clan = $row_5['clan'];
?>
   <?php
   $query_num = "Select clan_id from clans" ;
	$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
	$total = mysqli_num_rows($result_num); 
	?>
	<p class="podmenu">Всего отрядов <?php echo "[ $total ]"; ?></p>
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
	  $query_us = "Select * from clans order by clan_opit DESC limit $skip, $result_per_page";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['name'];
$gerb = $row_us['gerb'];
	    $id_us = $row_us['clan_id'];
		$gruppa = $row_us['gruppa'];
$opit = $row_us['clan_opit'];
$opit = ($opit / '100000');
$opit = round("$opit");
	    ?>
<div style="background: url(/style/img/1.jpg);"><br/></div>
<div style="background: url(/style/img/line.png);">
<b><?php
if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="s"/><?php }
if ($gruppa == 'mon') {?><img src="img/ico/monolit.png" width="12" height="12" alt="н"/><?php }
?><?php echo "$nick";?></b><br/>
<a href="clan.php?id=<?php echo "$id_us";?>"><?php if ($gerb > '0') {?><img src="img/gerb/<?php echo "$gerb"; ?>.jpg" width="75" height="75"/><?php } else {?><img src="img/gerb/<?php
if ($gruppa == 'naemniki') {?>o<?php }
if ($gruppa == 'svoboda') {?>s<?php }
if ($gruppa == 'dolg') {?>d<?php }
if ($gruppa == 'mon') {?>m<?php }
?>.jpg" width="75" height="75"/><?php }?></div></a>
<img src="style/img/line.png" width="100%" height="2"/>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;"><span class="white"><b>Опыт: <img src="img/star.png"/><?php echo "$opit";?>k</b></span></div>
<img src="style/img/line.png" width="100%" height="2"/>
</div>  
	    <?php
	  }
	  ?>
<center>
<div style="background: url(/style/img/2.jpg);">
	  <?php
	  ///////////////////////////////////////
	  ////////////////////////////////////////
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=1"><<</a> ';
      }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {
	    echo '<a href="' . "$phpself" . '?page=' . ($cur_page-1) . '"><</a> ';
      }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3)?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2)?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1)?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1)?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2)?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3)?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {
	  echo '<a href="' . "$phpself" . '?page=' . ($cur_page+1) . '">></a> ';
    }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {
	  echo ' <a href="' . "$phpself" .  '?page=' . $num_page . '">>></a> ';
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
	<?php
   /////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>