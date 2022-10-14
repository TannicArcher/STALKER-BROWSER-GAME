<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) and (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
}
$H=getenv("HTTP_REFERER");
if (empty($H)) {
  ?>
  <script type="text/javascript">
  document.location.href = "mail2.php";
  </script>
  <?php
  exit();
}
$user_id = $_SESSION['id'];
$set_id = $_GET['set_id'];
$id1 = $user_id;
$id2 = $set_id;
$type = $_GET['type'];
if (empty($type)) {
  $type = $_POST['type'];
}
$set_id = mysqli_real_escape_string($dbc, trim($set_id));	
//////////////////Если не указан тип
if (empty($type)) {
?>
<script type="text/javascript">
  document.location.href = "mail2.php";
</script>
<?php
exit();
}
//////////////////

//////////////////Если указан неправильный тип
if ($type <>1 and $type <>2 and $type <>3 and $type <>4 and $type <>5 and $type <>13) {
?>
<script type="text/javascript">
  document.location.href = "mail2.php";
</script>
<?php
exit();
}
///////////////////

/////////////////Если не указан ид
if (empty($set_id)) {
?>

<script type="text/javascript">
  document.location.href = "mail2.php";
</script>
<?php
exit();
}
//////////////

//////////////Сам себе не отправляет
if ($user_id == $set_id) {
?>
<script type="text/javascript">
  document.location.href = "mail2.php";
</script>
<?php
exit();
}
///////////////

///////////////Если этого id не существует
$set_id =  mysqli_real_escape_string($dbc, trim($set_id));
$query_isset = "Select id, gruppa, admin, p_ban, message from users where id='$set_id' limit 1";
$result_isset = mysqli_query($dbc, $query_isset) or die ('Ошибка передачи запроса к БД');
$row_isset = mysqli_num_rows($result_isset);
$row_isset = mysqli_fetch_array($result_isset);
if (empty($row_isset)) {
?>
<script type="text/javascript">
  document.location.href = "mail2.php";
</script>
<?php
exit();
}
/////////////
$query_list = "Select * from black_list where user_id='$id1' and black_id='$id2' limit 1";
$result_list = mysqli_query($dbc, $query_list) or die ('Ошибка передачи запроса к БД45');
$row_list = mysqli_fetch_array($result_list);
$query_list1 = "Select * from black_list where user_id='$id2' and black_id='$id1' limit 1";
$result_list1 = mysqli_query($dbc, $query_list1) or die ('Ошибка передачи запроса к БД46');
$row_list1 = mysqli_fetch_array($result_list1);

if ($row_list != 0) {?>
  <script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id2";?>&err=3";
  </script>
  <?php
  exit();
}
if ($row_list1 != 0) {?>
  <script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$id2";?>&err=4";
  </script>
  <?php
  exit();
}

$query_user = "Select * from users where id='$user_id' limit 1";
$result_user = mysqli_query($dbc, $query_user) or die ('Ошибка передачи запроса к БД');
$row_user = mysqli_fetch_array($result_user);
$p_ban = $row_user['p_ban'];
$arena = $row_user['arena'];
$arena1 = $row_user['arena1'];
$prem = $row_user['premium'];
$adminka = $row_user['admin'];

///////////// Проверка на группу на админа не распространяется)
if ($p_ban == '1') {?>
    <script type="text/javascript">
    document.location.href = "mail4.php?id=<?php echo "$set_id";?>&err=2";
    </script>
    <?php
    exit();
  }
if ($arena == '1' or $arena1 == '1') {?>
    <script type="text/javascript">
    document.location.href = "mail4.php?id=<?php echo "$set_id";?>&err=5";
    </script>
    <?php
    exit();
  }
/////////////
$message = $row_isset['message'];
$message_up = ($message + 1);

///////Если нужно отправить текст
if ($type == 1) {
  $text = $_POST['text'];
  $number = strlen($text);
  if (empty($text)) {//////////Если пустое сообщение|||||err = 1
    ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=1&set_id=<?php echo "$set_id"?>";
    </script>
  <?php
  exit();
  }
  if ($text == ' ') {//////////Если пустое сообщение|||||err = 1
    ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=1&set_id=<?php echo "$set_id"?>";
    </script>
  <?php
  exit();
  }
  if ($p_ban == '1') {//////////Если бан почты|||||err = 14
    ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=14&set_id=<?php echo "$set_id"?>";
    </script>
  <?php
  exit();
  }
  if ($number > 1024) {////////////Если больше 1024 симв|||||err = 2
       ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=2&set_id=<?php echo "$set_id"?>";
    </script>
  <?php
  exit();
  }
  $habar = $row_user['habar'];
  if ($habar <1) {////////////Мало железа|||||err = 3
       ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=3&set_id=<?php echo "$set_id"?>";
    </script>
  <?php
  exit();
  }
  
  $text = preg_replace('/(\r\n)+/', "\r\n", $text);
  $text = preg_replace('/(\r)+/', "\r", $text);
  $text = preg_replace('/(\n)+/', "\n", $text);
  $number = strlen($text);
  if ($number < 1) {////////////Если меньшн 1 симв|||||err = 2
       ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=12&set_id=<?php echo "$set_id"?>";
    </script>
  <?php
  exit();
  }
  $text = str_replace('<','&lt;', $text);
  $text = str_replace('>','&gt;', $text);
  $text = str_replace('"','&quot', $text);
  $text=stripslashes("$text");
require_once('inc_smiles.php');
  
  $text =  mysqli_real_escape_string($dbc, trim($text));
  $query = "insert into message (`type`, `ot`, `dlya`, `text`, `time`) values ('1', '$user_id', '$set_id', '- $text', NOW())";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message_up' where id='$set_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $habar = ($habar -1);
  $query_up = "update users set habar = '$habar' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////

///////Eсли нужно отправить шмот
if ($type == 2) {
  $thing = $_GET['thing'];
  $thing = mysqli_real_escape_string($dbc, trim($thing));	
  if (empty($thing)) {//если не выбрана вещь
     ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=4&set_id=<?php echo "$set_id"?>";
    </script>
    <?php
    exit();
  }
  $query_cl = "Select inf_id, type from things where thing_id = '$thing' and place='0' and user_id = '$user_id' and privat = 0 limit 1";
  $result_cl = mysqli_query($dbc, $query_cl) or die ('Ошибка передачи запроса к БД');
  $row_cl = mysqli_fetch_array($result_cl);
  $row_isset_cl = mysqli_num_rows($result_cl);
  $tip = $row_cl['type'];
  $inf_id = $row_cl['inf_id'];
  if (empty($row_isset_cl)) {//если вещь не в рюкзаке, не автора, не новая,
     ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=5&set_id=<?php echo "$set_id"?>&type=2";
    </script>
    <?php
    exit();
  }
  $money= $row_user['money'];
  if ($money<1) {//если вещь не в рюкзаке, не автора, не новая,
     ?>
    <script type="text/javascript">
    document.location.href = "send1.php?err=6&set_id=<?php echo "$set_id"?>&type=2";
    </script>
    <?php
    exit();
  }
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
  $name = $row_inf['name'];
  $query = "insert into message (`type`, `ot`, `dlya`, `thing`, `time`, `text`) values ('2', '$user_id', '$set_id', '$thing', NOW(), '$name')";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message_up' where id='$set_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $money = ($money -1);
  $query_up = "update users set money = '$money' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $query_up = "update things set user_id = '$set_id', place=3 where thing_id='$thing' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
////////////////////////////

///////Eсли нужно отправить деньги
if ($type == 3 and $prem == '1' or $type == '3' and $adminka == '1') {
    $money= $row_user['money'];
    $money_send = $_POST['money'];
	$money_send = mysqli_real_escape_string($dbc, trim($money_send));	
$money_send = round("$money_send");
    $sgn = '#[1-9]#';
	if ($money_send==0) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=10&set_id=<?php echo "$set_id"?>&type=3";
      </script>
      <?php
      exit();
	}
    if (!preg_match($sgn, $money_send)) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=7&set_id=<?php echo "$set_id"?>&type=3";
      </script>
      <?php
      exit();
	}
$prover = ($money - $money_send);
	if ($prover < '0') {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=3&set_id=<?php echo "$set_id"?>&type=4";
      </script>
      <?php
      exit();
	}
	if ($money_send<20) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=8&set_id=<?php echo "$set_id"?>&type=3";
      </script>
      <?php
      exit();
	}
	$money_need = (($money_send/100*5)+$money_send);
	$money_need = round ($money_need);
	if ($money_need>$money) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=9&set_id=<?php echo "$set_id"?>&type=3";
      </script>
      <?php
      exit();
	}
  $query = "insert into message (`type`, `ot`, `dlya`, `thing`, `time`) values ('3', '$user_id', '$set_id', '$money_send', NOW())";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message_up' where id='$set_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $money = ($money - $money_need);
  $query_up = "update users set money = '$money' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////////////////

//////Если нужно отправить хабар
if ($type == 4) {
    $money= $row_user['money'];
	$habar = $row_user['habar'];
    $habar_send = $_POST['habar'];
	$habar_send = mysqli_real_escape_string($dbc, trim($habar_send));	
$habar_send = round("$habar_send");
    $sgn = '#[1-9]#';
	if ($habar_send==0) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=10&set_id=<?php echo "$set_id"?>&type=4";
      </script>
      <?php
      exit();
	}
    if (!preg_match($sgn, $habar_send)) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=7&set_id=<?php echo "$set_id"?>&type=4";
      </script>
      <?php
      exit();
	}
	if (5>$money) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=9&set_id=<?php echo "$set_id"?>&type=4";
      </script>
      <?php
      exit();
	}
$prover = ($habar - $habar_send);
	if ($prover < '0') {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=3&set_id=<?php echo "$set_id"?>&type=4";
      </script>
      <?php
      exit();
	}
	if ($habar_send>$habar) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=3&set_id=<?php echo "$set_id"?>&type=4";
      </script>
      <?php
      exit();
	}
	if ($habar_send<1) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=3&set_id=<?php echo "$set_id"?>&type=4";
      </script>
      <?php
      exit();
	}
  $query = "insert into message (`type`, `ot`, `dlya`, `thing`, `time`) values ('4', '$user_id', '$set_id', '$habar_send', NOW())";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message_up' where id='$set_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $money = ($money - 5);
  $habar = ($habar-$habar_send);
  $query_up = "update users set money = '$money', habar='$habar' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
/////////////////////////////

//////Если нужно отправить аптечки
if ($type == 5) {
    $money= $row_user['money'];
	$aptechki = $row_user['aptechki'];
    $aptechki_send = $_POST['aptechki'];
	$aptechki_send = mysqli_real_escape_string($dbc, trim($aptechki_send));
$aptechki_send = round("$aptechki_send");	
    $sgn = '#[1-9]#';
	if ($aptechki_send==0) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=10&set_id=<?php echo "$set_id"?>&type=5";
      </script>
      <?php
      exit();
	}
    if (!preg_match($sgn, $aptechki_send)) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=7&set_id=<?php echo "$set_id"?>&type=5";
      </script>
      <?php
      exit();
	}
	if (5>$money) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=9&set_id=<?php echo "$set_id"?>&type=5";
      </script>
      <?php
      exit();
	}
$prover = ($aptechki - $aptechki_send);
	if ($prover < '0') {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=3&set_id=<?php echo "$set_id"?>&type=4";
      </script>
      <?php
      exit();
	}
	if ($aptechki_send>$aptechki) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=11&set_id=<?php echo "$set_id"?>&type=5";
      </script>
      <?php
      exit();
	}
	if ($aptechki_send<1) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=11&set_id=<?php echo "$set_id"?>&type=5";
      </script>
      <?php
      exit();
	}
  $query = "insert into message (`type`, `ot`, `dlya`, `thing`, `time`) values ('5', '$user_id', '$set_id', '$aptechki_send', NOW())";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message_up' where id='$set_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $money = ($money - 5);
  $aptechki = ($aptechki-$aptechki_send);
  $query_up = "update users set money = '$money', aptechki='$aptechki' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////

///////Eсли нужно отправить wmr
if ($type == 13) {
    $wmr= $row_user['wmr'];
    $wmr_send = $_POST['wmr'];
	$wmr_send = mysqli_real_escape_string($dbc, trim($wmr_send));	
    $sgn = '#[1-9]#';
	if ($wmr_send==0) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=10&set_id=<?php echo "$set_id"?>&type=13";
      </script>
      <?php
      exit();
	}
    if (!preg_match($sgn, $wmr_send)) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=7&set_id=<?php echo "$set_id"?>&type=13";
      </script>
      <?php
      exit();
	}
	if ($wmr_send<10) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=13&set_id=<?php echo "$set_id"?>&type=13";
      </script>
      <?php
      exit();
	}
	$wmr_need = (wmr_send);
	$wmr_need = round ($wmr_need);
	if ($wmr_need>$wmr) {
	  ?>
      <script type="text/javascript">
      document.location.href = "send1.php?err=9&set_id=<?php echo "$set_id"?>&type=13";
      </script>
      <?php
      exit();
	}
  $query = "insert into message (`type`, `ot`, `dlya`, `thing`, `time`) values ('13', '$user_id', '$set_id', '$wmr_send', NOW())";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $query_up = "update users set message = '$message_up' where id='$set_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
  $wmr = ($wmr - $wmr_need);
  $query_up = "update users set wmr = '$wmr' where id='$user_id' limit 1";
  $result_up = mysqli_query($dbc, $query_up) or die ('Ошибка передачи запроса к БД');
}
///////////////////////////////////////
?>
<?php
$query_ = "Select * from kontakts where user_id='$id1' and drug_id='$id2' limit 1";
$result_ = mysqli_query($dbc, $query_) or die ('Ошибка передачи запроса к БД5');
$row_ = mysqli_fetch_array($result_);

$query_ = "Select * from kontakts where user_id='$id2' and drug_id='$id1' limit 1";
$result_ = mysqli_query($dbc, $query_) or die ('Ошибка передачи запроса к БД5');
$row_21 = mysqli_fetch_array($result_);

if ($row_ == 0) {
$query = "insert into kontakts (`user_id`, `drug_id`, `time`) values ('$id1', '$id2', NOW() )";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6');
}
if ($row_21 == 0) {
$query0 = "insert into kontakts (`user_id`, `drug_id`, `time`) values ('$id2', '$id1', NOW() )";
$result0 = mysqli_query($dbc, $query0) or die ('Ошибка передачи запроса к БД7'); 
}
if ($row_ != 0) {
$query = "update kontakts set `time`=NOW() where user_id='$id1' and drug_id='$id2' or user_id='$id2' and drug_id='$id1' limit 2";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8');
}
?>
<script type="text/javascript">
  document.location.href = "mail4.php?id=<?php echo "$set_id";?>";
</script>
<?php
mysqli_close($dbc);
?>