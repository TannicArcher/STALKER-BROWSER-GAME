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
$page_title = 'Фото';
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
<div class="r5">
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
      "img/foto/" . $_FILES["file"]["name"]);
echo "<p>Фото успешно загружено!</p>";
$by = '1';
    }
  }
else
  {
  echo "Ошибка при загрузке";
$by = '0';
}
?>
<?php
if ($by == '1') {?>
<?php
$query_an = "Select * from anketa where user_id = '$user_id122' limit 1";
$result_an = mysqli_query($dbc, $query_an) or die ('Ошибка передачи запроса к БД');
$row_an = mysqli_fetch_array($result_an);

if ($row_an < 1) {
$query_q = "insert into anketa (`user_id`, `photo`) values ('$user_id122', '$us_n')";
$result_q = mysqli_query($dbc, $query_q) or die ('Ошибка передачи запроса к БД');
}
if ($row_an > 0) {
$query = "update anketa set photo='$us_n' where user_id = '$user_id122' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>
<?php
}
?>
</div>
<p style="border-top: 1px solid #444e4f;"></p>
<a href="cr_ank.php" class="menu">Назад к анкете</a>
<p style="border-top: 1px solid #444e4f;"></p>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
mysqli_close($dbc);
?>