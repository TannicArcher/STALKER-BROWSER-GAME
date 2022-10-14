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
$thing_id = $_GET['thing'];
$query_c = "Select user_id from things where place=1 and user_id = '$user_id' limit 20";
$result_c = mysqli_query($dbc, $query_c) or die ('Ошибка передачи запроса к БД');
$count = mysqli_num_rows($result_c);
if ($count==20) {
?>
<script type="text/javascript">
document.location.href="bag.php?err=1";
</script>
<?php
exit();
}
$query = "Select user_id from things where thing_id='$thing_id' and place=0 and user_id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result);
if (!empty($total)) {
  $query = "Update things set place = '1' where user_id = '$user_id' and thing_id = '$thing_id' limit 1";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
if (empty($H)) {
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
exit();
}
?>
<script type="text/javascript">
         document.location.href="<?php echo "$H" ?>";
         </script>
<?php
mysqli_close($dbc);
?>