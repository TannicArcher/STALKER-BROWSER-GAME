<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Пригласить друзей';
require_once('conf/head.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
?>
<script type="text/javascript">
document.location.href = "reg.php";
</script>
<?php
exit();
}
require_once('conf/top.php');

?>
<div id="main">
<div class="stats">
<p class="podmenu">Пригласить друзей</p>
</div>
<div class="stats">
<p>Если ты привлекаешь в игру своих друзей, то за это ты получаешь игровые RUB, которые можно забирать у Дядьки Яра в Скадовске каждый час.</p>
<br/>
<p>Бонусные RUB рассчитываются по принципу: уровень * количество рефералов.</p>
<br/><br/>
<p>
Ты можешь разместить эту ссылку:
</p>
<b>
<p>* У себя на сайте, для Ваших друзей и посетителей сайта;</p>
<p>* На Ваших любимых форумах в интернете;</p>
<p>* В гостевых книгах и блогах,</p></b><br/>
<p>
чтобы твои друзья и все кто увидит твою реф-ссылку - смогли по ней кликнуть и перейти в игру, и принести тебе в
будущем много денег и славы!
<p/><br/>
<p>
Твоя ссылка для друзей:
<p/>
<b><p class="bonus">stalkeronlinegame.epizy.com/login.php?inv=<?php echo $_SESSION['id'];?></p></b>
</div>
<?php
$user_id = $_SESSION['id'];
$query_num = "Select id from users where invite= '$user_id'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result_num);
?>
<div class="stats">
<p class="white">Приглашено друзей [<?php echo "$total";?>]</p>
</div><?php
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
	  $query_us = "Select nick ,id,gruppa from users where invite= '$user_id' order by timereg";
      $result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
	  while ($row_us = mysqli_fetch_array($result_us)) {
	    $nick = $row_us['nick'];
	    $id_us = $row_us['id'];
		$gruppa = $row_us['gruppa'];
	    ?>
	    <div class="zx">
		<?php
        if ($gruppa == 'svoboda') {?><img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/><?php }
	    if ($gruppa == 'dolg') {?><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/><?php }
		if ($gruppa == 'naemniki') {?><img src="img/ico/odinochkion.png" width="12" height="12" alt="s"/><?php }
	  ?> <a href="profile.php?id=<?php echo "$id_us"; ?>"><?php echo "$nick";?></a></div>
	  
	    <?php
	  }
	  ?>
	  <div class="zx">
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
	<?php
   /////////////////////////////////
   //////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);

?>
</body>
</html>