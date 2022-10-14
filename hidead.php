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
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  $h=getenv("HTTP_REFERER");
  if (empty($h)) {
  ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
  }
  $user=$_SESSION['id'];
  $query_read = "update users set read_ad = '0' where id = '$user'";
  $result_read = mysqli_query($dbc, $query_read) or die ('Ошибка передачи запроса к БД');
  ?>
  <script type="text/javascript">
  document.location.href = "<?php echo "$h";?>";
  </script>
  <?php
}
else {
?>
<script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
</script>
<?php
}
mysqli_close($dbc);
?>

