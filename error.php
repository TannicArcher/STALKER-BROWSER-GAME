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
$page_title = 'Ошибка';
require_once('conf/head.php');
require_once('conf/top.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
  </script>
  <?php
  exit();
}
$err = $_GET['err'];
$user_id = $_SESSION['id'];
///Если не указали инф.
if (empty($err)) {
  $err=1;
}
//////////////////////////
if ($err == 1) {
?>
  <div class="main">
  <div class="stats">
  <p class="podmenu">Доступ закрыт</p>
  </div>
  <div class="stats">
  <p class="white">Вы не можете читать этот форум. Руководство ограничило к нему доступ.</p>
  </div>
  </div>
  <?php
}
if ($err == 2) {
?>
  <div class="main">
  <div class="stats">
  <p class="podmenu">Доступ закрыт</p>
  </div>
  <div class="stats">
  <p class="white">Вы не можете создавать разделы.</p>
  </div>
  </div>
  <?php
}
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>
</body>
</html>