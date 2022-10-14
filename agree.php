<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Вы уверены?';
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
$inf=$_GET['inf'];
$user_id = $_SESSION['id'];
///Если не указали инф.
if (empty($inf)) {
 ?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
  <?php
  exit();
}
//////////////////////////
if ($inf == 'company') {///если согласие на клан
  $query = "Select clan from users where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $clan = $row['clan'];
  ///Если клана не существует
  if ($clan == 0) {
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  ///////////////////////////////
  ?>
  <div id="error">Вы уверены, что хотите покинуть отряд?</div>
  <div class="stats">
  <p><img src="img/ico/point.png" width="12" height="12"/> <a href="outcompany.php">Да</a></p> 
  <p><img src="img/ico/point.png" width="12" height="12"/> <a href="company.php?company_id=<?php echo "$clan"?>">Нет</a></p>
  </div>
  <?php
}///если согласие на клан КОНЕЦ
////////////////////////////////////

if ($inf == 'outuser') {///если согласие на выгнать пользователя
  $query = "Select clan, clan_rang from users where id = '$user_id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
  $row = mysqli_fetch_array($result);
  $clan = $row['clan'];
  $id = $_GET['id'];
  ///ид не указан
  if (empty($id)) {
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  ///////////////////////////////
  ///Если клана не существует
  if ($clan == 0) {
    ?>
    <script type="text/javascript">
    document.location.href = "index.php";
    </script>
    <?php
    exit();
  }
  ///////////////////////////////
  ?>
  <div id="error">Вы уверены?</div>
  <div class="stats">
  <p><img src="img/ico/point.png" width="12" height="12"/> <a href="rang.php?inf=out&id=<?php echo "$id";?>">Да</a></p> 
  <p><img src="img/ico/point.png" width="12" height="12"/> <a href="company.php?company_id=<?php echo "$clan"?>">Нет</a></p>
  </div>
  <?php
}///если согласие на клан КОНЕЦ
////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>