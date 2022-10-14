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
$user_id = $_SESSION['id'];
$mes_id = $_GET['mes_id'];
$mes_id = mysqli_real_escape_string($dbc, trim($mes_id));
////////////////Если не указано сообщениЕ,  то удаляем всё.
if (empty($mes_id)) {
  $query = "Select reading, ot, dlya, message_id from message where ot = '$user_id' or dlya = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  while ($row = mysqli_fetch_array($result)) {
    $message_id = $row['message_id'];
    if (($row['ot'] == $user_id)) { 
	  $query_del = "update message set delite_ot = '$user_id' where message_id = '$message_id' limit 1";
      $result_del = mysqli_query($dbc, $query_del) or die ('Ошибка передачи запроса к БД');
	}
	if (($row['reading'] == 1) and ($row['dlya'] == $user_id)) { 
	  $query_del = "update message set delite_dlya = '$user_id' where message_id = '$message_id' limit 1";
      $result_del = mysqli_query($dbc, $query_del) or die ('Ошибка передачи запроса к БД');
	}
  }
}

///////////////////////////
?>
<script type="text/javascript">
  document.location.href = "mail.php";
</script>
<?php
mysqli_close($dbc);
?>