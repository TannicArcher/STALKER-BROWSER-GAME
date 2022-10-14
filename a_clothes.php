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
}
$page_title = 'Аукцион снаряжения';
require_once('conf/head.php');
require_once('conf/top.php');
$user_id = $_SESSION['id'];
$query = "Select money, habar from users where id = '$user_id'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$money = $row['money'];
$habar = $row['habar'];
$tip=$_GET['type'];
if (empty($tip)) {
  $tip=1;
}
?>
<div id="main">
  <div class="stats">
    <p class="podmenu">Аукцион снаряжения</p>
  </div>
  <div class="stats"><p>[<a <?php if ($tip == 1) {?>class="white"<?php }?> href="a_clothes.php?type=1">Всё</a>] [<a <?php if ($tip == 2) {?>class="white"<?php }?> href="a_clothes.php?type=2">Одежда</a>] [<a <?php if ($tip == 3) {?>class="white"<?php }?> href="a_clothes.php?type=3">Пистолет</a>] [<a <?php if ($tip == 4) {?>class="white"<?php }?> href="a_clothes.php?type=4">Автомат</a>]</p>
  </div>
  <?php 
  ?>
  <div class="stats">
    <p>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo "$money"; ?></span>] [<img src="img/ico/materials.png" width="12" height="12"/> <span class="white"><?php echo "$habar"; ?></span>]</p>
  </div>
  <div class="stats">
    <p class="white" style="background-color:#1e2833;"><b>[Лоты]</b></p>
	<?php
	if ($tip==1) {
	  $query_c = "Select id_lot, thing_id, type, date,price,price_now from auction where type = 1 or type=2 or type=3";
      $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
	}
	if ($tip==2) {
	  $query_c = "Select id_lot, thing_id, type, date,price,price_now from auction where type = 1";
      $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
	}
	if ($tip==3) {
	  $query_c = "Select id_lot, thing_id, type, date,price,price_now from auction where type=2";
      $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
	}
	if ($tip==4) {
	  $query_c = "Select id_lot, thing_id, type, date,price,price_now from auction where type=3";
      $result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
	}
	$total = mysqli_num_rows($result_c);
	if ($total >0) {
//////////////////////////////////////////////////////
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
	  if ($tip == 1) {
	    $query_cl = "Select id_lot, thing_id, type, date,price,price_now from auction where type = 1 or type=2 or type=3 order by date DESC limit $skip, $result_per_page";
        $result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	  }
	  if ($tip == 2) {
	    $query_cl = "Select id_lot, thing_id, type, date,price,price_now from auction where type = 1 order by date DESC limit $skip, $result_per_page";
        $result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	  }
	  if ($tip == 3) {
	    $query_cl = "Select id_lot, thing_id, type, date,price,price_now from auction where type=2 order by date DESC limit $skip, $result_per_page";
        $result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	  }
	  if ($tip == 4) {
	    $query_cl = "Select id_lot, thing_id, type, date,price,price_now from auction where type=3 order by date DESC limit $skip, $result_per_page";
        $result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	  }
	  while ($row_cl = mysqli_fetch_array($result_cl)) {
	    if ($row_cl['type']==1) {
		  $thing_id=$row_cl['thing_id'];
		  $query_th = "Select inf_id, need_lvl from things where thing_id='$thing_id' limit 1";
          $result_th = mysqli_query($dbc, $query_th) or die ('Ошибка передачи запроса к БД');
		  $row_th = mysqli_fetch_array($result_th);
		  
		  $inf_id= $row_th['inf_id'];
	      $query_inf = "Select name, klass, lvl_need, screen from clothes where clothes_id='$inf_id' limit 1";
          $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
		  $row_inf = mysqli_fetch_array($result_inf);
		  ?>
		  <div class="zx">
<a href="lot.php?lot=<?php echo $row_cl['id_lot'];?>" style="text-decoration:none; color: white;"><div class="r2">
<center>
<?php
if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
?><?php echo $row_inf['name'];?><br/>
<p><img src="img/clothes/<?php echo $row_inf['screen'];?>" alt="Слот №1" width="60" height="60"/></p>
		<p><span class="white"><?php echo $row_th['need_lvl'];?></span> ур</p>
		<?php if ($row_cl['price_now'] < $row_cl['price']) {?><p>Ставка: [<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_now'];?></span>]</p><?php }?>
		<p>Выкуп:
		<?php if ($row_cl['price'] >=0) {?>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span>]<?php }?></p>
</center>
</div>
</a>
	</div>
		  <?php
		}
		if ($row_cl['type']==2) {
		  $thing_id=$row_cl['thing_id'];
		  $query_th = "Select inf_id, need_lvl from things where thing_id='$thing_id' limit 1";
          $result_th = mysqli_query($dbc, $query_th) or die ('Ошибка передачи запроса к БД');
		  $row_th = mysqli_fetch_array($result_th);
		  
		  $inf_id= $row_th['inf_id'];
	      $query_inf = "Select name, klass, lvl_need, screen from pistols where pistols_id='$inf_id' limit 1";
          $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
		  $row_inf = mysqli_fetch_array($result_inf);
		  ?>
		  <div class="zx">
<a href="lot.php?lot=<?php echo $row_cl['id_lot'];?>" style="text-decoration:none; color: white;"><div class="r2">
<center>
<?php
if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
?><?php echo $row_inf['name'];?><br/>
<p><img src="img/weapons/<?php echo $row_inf['screen'];?>" alt="Слот №1" width="60" height="50"/></p>
		<p><span class="white"><?php echo $row_th['need_lvl'];?></span> ур</p>
		<?php if ($row_cl['price_now'] < $row_cl['price']) {?><p>Ставка: [<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_now'];?></span>]</p><?php }?>
		<p>Выкуп:
		<?php if ($row_cl['price'] >=0) {?>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span>]<?php }?></p>
</center>
</div>
</a>
	</div>
		  <?php
		}
	    if ($row_cl['type']==3) {
		  $thing_id=$row_cl['thing_id'];
		  $query_th = "Select inf_id, need_lvl from things where thing_id='$thing_id' limit 1";
          $result_th = mysqli_query($dbc, $query_th) or die ('Ошибка передачи запроса к БД');
		  $row_th = mysqli_fetch_array($result_th);
		  
		  $inf_id= $row_th['inf_id'];
	      $query_inf = "Select name, klass, lvl_need, screen from weapons where weapons_id='$inf_id' limit 1";
          $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
		  $row_inf = mysqli_fetch_array($result_inf);
		  ?>
		  <div class="zx">
<a href="lot.php?lot=<?php echo $row_cl['id_lot'];?>" style="text-decoration:none; color: white;"><div class="r2">
<center>
<?php
if ($row_inf['klass'] == 1) {?><img src="img/ico/class1.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 2) {?><img src="img/ico/class2.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 3) {?><img src="img/ico/class3.png" width="12" height="12"/><?php }
if ($row_inf['klass'] == 4) {?><img src="img/ico/class4.png" width="12" height="12"/><?php }
?><?php echo $row_inf['name'];?><br/>
<p><img src="img/weapons/<?php echo $row_inf['screen'];?>" alt="Слот №1" width="145" height="50"/></p>
		<p><span class="white"><?php echo $row_th['need_lvl'];?></span> ур</p>
		<?php if ($row_cl['price_now'] < $row_cl['price']) {?><p>Ставка: [<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price_now'];?></span>]</p><?php }?>
		<p>Выкуп:
		<?php if ($row_cl['price'] >=0) {?>[<img src="img/ico/money.png" width="12" height="12"/> <span class="white"><?php echo $row_cl['price'];?></span>]<?php }?></p>
</center>
</div>
</a>
	</div>
		  <?php
		}
	  }
	}
//////////////////////////////////////////////////////
    }
	else {
	?><br/ ><p class="white">Нет выставленных лотов</p><?php
   }
?>
<center>
<div class="zx">
	  <?php
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  ///////////////////////////////////////
	  ////////////////////////////////////////
	  if ($cur_page > 1) {?>
<a href="a_clothes.php?page=1&type=<?php echo "$tip";?>"><<</a>
     <?php }
	  else {
	    echo '<< ';
	  }
	  if ($cur_page > 1) {?>
<?php
$cur_pagel = ($cur_page - '1');
?>
<a href="a_clothes.php?page=<?php echo "$cur_pagel";?>&type=<?php echo "$tip";?>"><</a> 
      <?php }
	  else {
	    echo '<';
	  }
	/////
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a href="<?php echo "$phpself" . '?page=' . ($cur_page-3)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-2)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page-1)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="white"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+1)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+2)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a href="<?php echo "$phpself" . '?page=' . ($cur_page+3)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {?>
<?php
$cur_paged = ($cur_page + '1');
?>
<a href="a_clothes.php?page=<?php echo "$cur_paged";?>&type=<?php echo "$tip";?>">></a>
    <?php }
	else {
	  echo '>';
	}
	if ($cur_page < $num_page) {?>
<a href="a_clothes.php?page=<?php echo "$num_page";?>&type=<?php echo "$tip";?>">>></a>
     <?php }
	else {
	  echo ' >>';
	}

	////////////////////////////////
	///////////////////////////////
	?>
	</div></center>
	<?php
   /////////////////////////////////
   //////////////////////////////////
   ?>
</div>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>