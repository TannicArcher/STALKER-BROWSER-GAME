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
$page_title = 'Аватар';
require_once('conf/head.php');
require_once('conf/top.php');
?>
<?php
$user_id = $_SESSION['id'];
$rnv = rand(2000,60000);
$us_n = ($user_id.$rnv);
$query = "Select * from users where id='$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$row = mysqli_fetch_array($result);
$money = $row['money'];
?>
<?php if ($money < '3000') {?>
<p class="red">У вас недостаточно средств!</p>
<?php } else {?>
<?php
if ((($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg"))
&& ($_FILES["file"]["size"] < 61440))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
$_FILES["file"]["name"] = "$us_n.png";
 
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "img/ava/" . $_FILES["file"]["name"]);
echo "<p>Аватар успешно загружен!</p>";
$by = '1';
    }
  }
else
  {
  echo "Ошибка при загрузке";
$by = '0';
}
?>
<?php if ($by == '1') {
$query = "update users set avatar='$us_n', money=money-3000 where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>
<?php }?>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>