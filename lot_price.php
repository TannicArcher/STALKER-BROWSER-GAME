<?php
//*******************************************************************//
//**///////////////////////Автор: Андрей Наумов////////////////////**//
//**//////Двиг был написан мною и никаких соавторов не имеется/////**//
//**////////////////////////VK: vk.com/linux8//////////////////////**//
//**/////Устроюсь как на временную, так и на постоянную работу/////**//
//**//////////Знаю: Php, MySQL, CSS, xhtml, photoshop//////////////**//
//**/////Цена договорная, зависит от сложности и объёма работы/////**//
//**///////////////////////////////////////////////////////////////**//
//**////////////Спасибо за использование моего движка//////////////**//
//**/////Буду рад радовать вас новыми и интересными движками///////**//
//*******************************************************************//

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
  document.location.href = "index.php";
</script>
<?php
exit();
}
$user_id = $_SESSION['id'];
$lot = $_GET['lot'];
$lot = htmlentities($lot, ENT_QUOTES);
$lot = mysqli_real_escape_string($dbc, trim($lot));
if (empty($lot)) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
  $query_lot = "Select  thing_id, price,price_now, price_user from auction where id_lot='$lot' limit 1";
  $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД');
  $row_lot = mysqli_fetch_array($result_lot);
if ($row_lot == 0) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
/////////////////Лот не пустой и он существует.
$thing=$row_lot['thing_id'];
$query = "Select user_id, inf_id, type from things where thing_id='$thing' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2');
$row = mysqli_fetch_array($result);
if ($row['user_id'] == $_SESSION['id']) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
////////////////////////////Шмотка есть и она не принадлежит пользователю.
$type = $_GET['type'];
if (empty($type)) {
  $type=2;
}
if ($type <> 1 and $type <>2) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
$new_price= ($row_lot['price_now']+($row_lot['price_now']*0.10));
$new_price = round($new_price);
if ($new_price >= $row_lot['price'] and $type==1) {
  ?>
  <script type="text/javascript">
  document.location.href = "a_clothes.php";
  </script>
  <?php
  exit();
}
$tip = $row['type'];
$inf_cl = $row['inf_id'];
if ($tip == 1) {
  $query_inf = "Select name from clothes where clothes_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Назваине брони
if ($tip == 2) {
  $query_inf = "Select name from pistols where pistols_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название Пистолета
if ($tip == 3) {
  $query_inf = "Select name from weapons where weapons_id = '$inf_cl' limit 1";
  $result_inf = mysqli_query($dbc, $query_inf) or die ('Ошибка передачи запроса к БД');
  $row_inf = mysqli_fetch_array($result_inf);
}//Название оружия
$name=$row_inf['name'];
////////////////////На всё проверили и тип тоже и на превышении цены.
$user_id=$_SESSION['id'];
$query_u = "Select money from users where id = '$user_id'";
$result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД4');
$row_u = mysqli_fetch_array($result_u);
$money = $row_u['money'];
if ($type == 1) {
  if ($money <$new_price) {
   ?>
   <script type="text/javascript">
   document.location.href="lot.php?lot=<?php echo "$lot" ?>&err=1";
   </script>
   <?php
   exit();
  }
  else {
      $query_u = "update users set money=money-'$new_price' where id='$user_id' limit 1";
      $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД5');
	  $query_lot = "update auction set price_now='$new_price', price_user='$user_id' where id_lot='$lot' limit 1";
      $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	  if ($row_lot['price_user'] <> 0) {
	    $user = $row_lot['price_user'];
		$price_now = $row_lot['price_now'];
	    $query_lot = "insert into message (`type`, `ot`, `dlya`, `text`, `thing`, `time`, `reading`, `delite_ot`, `delite_dlya`) values (6, '$lot', '$user', '$name', '$price_now', NOW(),0,0,0)";
		$result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
		$query_u = "update users set message=message+1 where id='$user' limit 1";
        $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД5');
	  }
  }
}
if ($type==2) {
  if ($money <$row_lot['price']) {
   ?>
   <script type="text/javascript">
   document.location.href="lot.php?lot=<?php echo "$lot" ?>&err=2";
   </script>
   <?php
   exit();
  }
  else {
	  $price_buy=$row_lot['price'];
	  $price_buy=($price_buy*0.9);
      $need_money = $row_lot['price'];
      $query_u = "update users set money=money-'$need_money', message=message+1 where id='$user_id'";
      $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД5');
	  $query_lot = "insert into message (`type`, `ot`, `dlya`, `text`, `thing`, `time`, `reading`, `delite_ot`, `delite_dlya`) values (7, '', '$user_id', '$name', '$thing', NOW(),0,0,0)";
	  $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	  $query_lot = "delete from auction where id_lot='$lot'";
      $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	  
	  
	  $user_thing=$row['user_id'];
	  $query_u = "update users set message=message+1 where id='$user_thing'";
      $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД5');
	  $query_lot = "insert into message (`type`, `ot`, `dlya`, `text`, `thing`, `time`, `reading`, `delite_ot`, `delite_dlya`) values (8, '', '$user_thing', '$name', '$price_buy', NOW(),0,0,0)";
	  $result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
	  
	  if ($row_lot['price_user'] <> 0) {
	    $user = $row_lot['price_user'];
		$price_now = $row_lot['price_now'];
	    $query_lot = "insert into message (`type`, `ot`, `dlya`, `text`, `thing`, `time`, `reading`, `delite_ot`, `delite_dlya`) values (6, '$lot', '$user', '', '$price_now', NOW(),0,0,0)";
		$result_lot = mysqli_query($dbc, $query_lot) or die ('Ошибка передачи запроса к БД6');
		$query_u = "update users set message=message+1 where id='$user'";
        $result_u = mysqli_query($dbc, $query_u) or die ('Ошибка передачи запроса к БД5');
		
	  }
  } 
}
///////////////
?>
<script type="text/javascript">
         document.location.href="<?php echo "$H" ?>";
         </script>
<?php
mysqli_close($dbc);
?>