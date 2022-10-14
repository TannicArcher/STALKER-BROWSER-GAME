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
$page_title = 'Сообщение';
require_once('conf/head.php');
require_once('conf/top.php');;
?>
<div id="main">
<?php
$user_id = $_SESSION['id'];
$set_id = $_GET['set_id'];
//////////////Сам себе не отправляет
if ($user_id == $set_id) {
?>
<script type="text/javascript">
  document.location.href = "mail.php";
</script>
<?php
exit();
}
///////////////

$set_id =  mysqli_real_escape_string($dbc, trim($set_id));
$query = "Select nick,p_ban,admin,moder,gruppa from users where id='$set_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
$row = mysqli_fetch_array($result);
$total = mysqli_num_rows($result);
if (!empty($total)) {
///////////////////////////////Пользователь такой есть.
if ($row['gruppa'] == 'mytants' or $row['gruppa'] == 'bandits' or $row['gruppa'] == 'monolits' or $row['gruppa'] == 'zombie') {
    ?>
    <script type="text/javascript">
    document.location.href = "mail.php";
    </script>
    <?php
    exit();
}
///////////// Проверка на группу на админа не рапостроняется)
$query_isset = "Select id, gruppa, p_ban, admin, moder from users where id='$user_id' limit 1";
$result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
$row_isset = mysqli_fetch_array($result_isset);
if ($row['admin'] <> 1 and $row_isset['admin'] <> 1) {
  if ($row['gruppa'] <> $row_isset['gruppa']) {
    ?>
    <script type="text/javascript">
    document.location.href = "mail.php";
    </script>
    <?php
    exit();
  }
}
/////////////
  ?>
  <div class="stats">
  <p class="podmenu">Сообщение для <?php echo $row['nick'];?></p>
  </div>
  <?php
  $err = $_GET['err'];
  if (!empty($err)) {
    ?>
	<div id="error">
	<?php
	if ($err == 1) {echo "Введите сообщение";}
	if ($err == 2) {echo "Вы ввели больше 1024 символов";}
	if ($err == 3) {echo "Недостаточно хабара";}
	if ($err == 4) {echo "Выберите вещь";}
	if ($err == 5) {echo "Вещь должна быть новой и находиться в рюкзаке";}
	if ($err == 6) {echo "Недостаточно денег";}
	if ($err == 7) {echo "Значение вводятся числами";}
	if ($err == 8) {echo "Сумма должна быть не меньше 20";}
	if ($err == 9) {echo "У вас нет столько денег";}
	if ($err == 10) {echo "Введите кол-во";}
	if ($err == 11) {echo "У вас нет столько аптечек";}
	if ($err == 12) {echo "Вы ввели меньше 1 символов";}
	if ($err == 13) {echo "Сумма должна быть не меньше 10";}
	if ($err == 14) {echo "Бан почты";}
	?>
	</div>
	<?php
  }
  $type = $_GET['type'];
  if (empty($type)) {
    $type = 1;
  }
  ?>
  <p class="podmenu" style="font-size:13px;"> Что отправляем</p>
<?php if ($row['admin'] == 1) {
?>
<div id="main">
 <div style="border:dashed #990000 1px;
padding-left: 6px;
padding-bottom: 6px;
padding-top: 6px;">
<div style="background-color:#990000;
padding-top: 1px;
padding-bottom: 1px;
margin-right: 5px;
padding-left: 3px;
padding-top:6px;
padding-bottom: 6px;
margin-bottom: 5px;
color:#FFFFFF">
  <p><b>Учтите, что вы пишите администратору. Попрошайничество, просьбы в назначении на должность и использование нецензурной лексики караются баном игры. Администратор - не почтальон. Не нужно пользоваться его возможностями и отправлять снаряжение для пересылки вашим "клиентам" из другой группировки. Так же, администратор не какой-то там барыга, он не торгует снаряжением, тем более улучшенным.</b></p>
  </div>
  </div>
<?php } ?>
 <script type="text/javascript">
  document.location.href = "send1.php?set_id=<?php echo "$set_id";?>";
  </script>
  <div style="border-bottom:dotted #444e4f 1px; border-top: dotted #444e4f 1px; padding-bottom:4px; padding-top:4px;">
  <p><img src="img/ico/point.png" width="12" height="12"/> <?php if ($type == 1) {?><span class="white">Сообщение</span><?php } else {?><a href="send.php?type=1&set_id=<?php echo "$set_id";?>">Сообщение</a><?php }?></p>
  <p><img src="img/ico/point.png" width="12" height="12"/> <?php if ($type == 2) {?><span class="white">Cнаряжение</span><?php } else {?><a href="send.php?type=2&set_id=<?php echo "$set_id";?>">Снаряжение</a><?php }?></p>
  <p><img src="img/ico/point.png" width="12" height="12"/> <?php if ($type == 3) {?><span class="white">Деньги</span><?php } else {?><a href="send.php?type=3&set_id=<?php echo "$set_id";?>">Деньги</a><?php }?></p>
  <p><img src="img/ico/point.png" width="12" height="12"/> <?php if ($type == 4) {?><span class="white">Хабар</span><?php } else {?><a href="send.php?type=4&set_id=<?php echo "$set_id";?>">Хабар</a><?php }?></p>
  <p><img src="img/ico/point.png" width="12" height="12"/> <?php if ($type == 5) {?><span class="white">Аптечки</span><?php } else {?><a href="send.php?type=5&set_id=<?php echo "$set_id";?>">Аптечки</a><?php }?></p>
  </div>
  <?php
////////////////////////////////////// Текст начало
if ($type == 1) {
  ?>
  <div class="stats">
  <p>Сообщение:</p>
  <form enctype="multipart/form-data" method="post" action="sendmessage.php?type=1&set_id=<?php echo "$set_id"; ?>">
  <textarea rows="2" cols="35px" name="text"></textarea>
  <div class="knopka">
  <input type="submit" style="width:67px;" class="input" value="Отправить" name="addad"/> Стоимость:<img src="img/ico/materials.png" width="12" height="12"/><span class="white"> 1  </span>
  </div>
  </form>
</div>
  <?php
}
////////////////////////////////////// Текст конец

//////////////////////////////////////Cнаряжение начало
if ($type == 2) {
  ?>
  <div class="stats"><p class="white">Выбранная вещь:</p>
  <?php
  $thing = $_GET['thing'];
  $thing = htmlentities($thing, ENT_QUOTES);
  if (!empty($thing)) {
    $query_cl = "Select inf_id,user_id,type from things where thing_id = '$thing' and place='0' and privat = 0 limit 1";
	$result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
	$row_cl = mysqli_fetch_array($result_cl);
	$row_isset_cl = mysqli_num_rows($result_cl);
	if (!empty($row_isset_cl)) {
	  if ($row_cl['user_id'] <> $user_id) {
	   ?>
       <script type="text/javascript">
       document.location.href = "send.php?type=2&set_id=<?php echo"$set_id";?>";
       </script>
       <?php
       exit(); 
	  }
	  else {
	    $inf_id = $row_cl['inf_id'];
	    $tip = $row_cl['type'];
	    if ($tip == 1) {
	      $query_inf = "Select name from clothes where clothes_id = '$inf_id' limit 1";
	      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	      $row_inf = mysqli_fetch_array($result_inf);
	    }//Назваине брони
		if ($tip == 2) {
	      $query_inf = "Select name from pistols where pistols_id = '$inf_id' limit 1";
	      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	      $row_inf = mysqli_fetch_array($result_inf);
	    }//Название Пистолета
		if ($tip == 3) {
	      $query_inf = "Select name from weapons where weapons_id = '$inf_id' limit 1";
	      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	      $row_inf = mysqli_fetch_array($result_inf);
	    }//Название оружия
		if ($tip == 4) {
	      $query_inf = "Select name from helmets where helmet_id = '$inf_id' limit 1";
	      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	      $row_inf = mysqli_fetch_array($result_inf);
	    }//Название шлема
		?>
	<p>
		<?php
		if ($tip == '1') {?><img src="img/ico/shield.png" width="12" height="12" alt="s"/><?php }
	    if ($tip == '2') {?><img src="img/ico/pistol.png" width="12" height="12" alt="d"/><?php }
	    if ($tip == '3') {?><img src="img/ico/weapon.png" width="36" height="12" alt="n"/><?php }
	    if ($tip == '4') {?><img src="img/ico/helmet.png" width="12" height="12" alt="h"/><?php }
		echo $row_inf['name'];?> [<a href="send.php?type=2&set_id=<?php echo"$set_id";?>">отменить</a>]</p>
		<?php
	  }
	}
	else {
	?>
    <script type="text/javascript">
    document.location.href = "send.php?type=2&set_id=<?php echo"$set_id";?>";
    </script>
    <?php
    exit(); 
	}
  }
  ?>
  </div>
  <?php 
  if (isset($thing)) {?>
  <div class="stats">
  <p>[<a href="sendmessage.php?type=2&set_id=<?php echo "$set_id";?>&thing=<?php echo "$thing";?>">ОТПРАВИТЬ</a>] Стоимость:<img src="img/ico/money.png" width="12" height="12"/><span class="white"> 1</span></p>
  </div>
  <?php
  }
  ?>
  <div class="stats"><p class="white">Выбрать вещь:</p>
  <?php
  if (!empty($thing)) {
    $query_cl = "Select inf_id, type,thing_id from things where user_id = '$user_id' and place='0' and thing_id <> '$thing' and privat = 0 limit 20";
    $result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
  }
  else {
    $query_cl = "Select inf_id, type,thing_id from things where user_id = '$user_id' and place='0' and privat = 0 limit 20";
    $result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
  }
  while ($row_cl=mysqli_fetch_array($result_cl)) {
    $inf_id = $row_cl['inf_id'];
	$tip = $row_cl['type'];
	if ($tip == 1) {
	      $query_inf = "Select name from clothes where clothes_id = '$inf_id' limit 1";
	      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	      $row_inf = mysqli_fetch_array($result_inf);
	    }//Назваине брони
	if ($tip == 2) {
	      $query_inf = "Select name from pistols where pistols_id = '$inf_id' limit 1";
	      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	      $row_inf = mysqli_fetch_array($result_inf);
	    }//Название Пистолета
	if ($tip == 3) {
	      $query_inf = "Select name from weapons where weapons_id = '$inf_id' limit 1";
	      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	      $row_inf = mysqli_fetch_array($result_inf);
	    }//Название оружия
		if ($tip == 4) {
	      $query_inf = "Select name from helmets where helmet_id = '$inf_id' limit 1";
	      $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
	      $row_inf = mysqli_fetch_array($result_inf);
	    }//Название шлема
	?>
	<p>
	<?php
	if ($tip == '1') {?><img src="img/ico/shield.png" width="12" height="12" alt="c"/><?php }
	if ($tip == '2') {?><img src="img/ico/pistol.png" width="12" height="12" alt="p"/><?php }
	if ($tip == '3') {?><img src="img/ico/weapon.png" width="36" height="12" alt="w"/><?php }
	if ($tip == '4') {?><img src="img/ico/helmet.png" width="12" height="12" alt="h"/><?php }
    echo $row_inf['name'];?> [<a href="send.php?type=2&set_id=<?php echo"$set_id";?>&thing=<?php echo $row_cl['thing_id']; ?>">выбрать</a>]</p>
	<?php
  }
  ?>
  </div>
  <?php
}
//////////////////////////////////////Снаряжение конец

//////////////////////////////////////Деньги начало
  if ($type == 3) {
    ?>
	<div class="stats">
	<p>Деньги:</p>
    <form enctype="multipart/form-data" method="post" action="sendmessage.php?type=3&set_id=<?php echo "$set_id"; ?>">
    <input type="text" class="input" name="money" style="width:50px;"/>
    <input type="submit" style="width:70px;" class="input" value="Отправить" name="send"/>
    </form>
	<p class="bonus">Стоимость отправки: 5% от переводимой суммы, но не менее <img src="img/ico/money.png" width="12" height="12"/> 20</p>
	</div>
    <?php
  }
///////////////////////////////////////Деньги конец

//////////////////////////////////////Хабар
if ($type == 4) {
    ?>
	<div class="stats">
	<p>Хабар:</p>
    <form enctype="multipart/form-data" method="post" action="sendmessage.php?type=4&set_id=<?php echo "$set_id"; ?>">
    <input type="text" class="input" name="habar" style="width:50px;"/>
    <input type="submit" style="width:70px;" class="input" value="Отправить" name="send"/>
    </form>
	<p>Стоимость:<img src="img/ico/money.png" width="12" height="12"/><span class="white"> 5  </span></p>
	</div>
    <?php
  }
//////////////////////////////////////Хабар КОНЕЦ

//////////////////////////////////////Аптечки
if ($type == 5) {
    ?>
	<div class="stats">
	<p>Аптечки:</p>
    <form enctype="multipart/form-data" method="post" action="sendmessage.php?type=5&set_id=<?php echo "$set_id"; ?>">
    <input type="text" class="input" name="aptechki" style="width:50px;"/>
    <input type="submit" style="width:70px;" class="input" value="Отправить" name="send"/>
    </form>
	<p>Стоимость:<img src="img/ico/money.png" width="12" height="12"/><span class="white"> 5  </span></p>
	</div>
    <?php
  }
//////////////////////////////////////Аптечки КОНЕЦ

//////////////////////////////////////Вмр начало
  if ($type == 13) {
    ?>
	<div class="stats">
	<p>WMR:</p>
    <form enctype="multipart/form-data" method="post" action="sendmessage.php?type=13&set_id=<?php echo "$set_id"; ?>">
    <input type="text" class="input" name="money" style="width:50px;"/>
    <input type="submit" style="width:70px;" class="input" value="Отправить" name="send"/>
    </form>
	<p class="bonus">Отправка бесплатная, но сумма отправки не должна быть меньше <img src="img/ico/money.png" width="12" height="12"/> 10</p>
	</div>
    <?php
  }
///////////////////////////////////////Вмр конец

}
else {
require_once('conf/notfound.php');
}
	
?>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>

</body>
</html>