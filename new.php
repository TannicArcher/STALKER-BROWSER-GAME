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
};
$page_title = 'Новости';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<?php
$user_id = $_SESSION['id'];
$query = "update users set location = 'mail', new='0' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$query1 = "Select * from users where id='$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$row1 = mysqli_fetch_array($result1);
?>
<?php
$query_num = "Select id_top from topics where id_subf = '1'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД');
$total = mysqli_num_rows($result_num); 
?>
<div id="main">
<div class="stats">
   <?php
if (!empty($_GET['page'])) {
  $cur_page = $_GET['page'];
}
else {
  $cur_page = 1;
}
    $result_per_page = 1;
	$skip = (($cur_page - 1) * $result_per_page);
		$num_page = ceil($total / $result_per_page);
	if ($num_page > 0) {
$query_sub = "Select * from topics where id_subf = '1' order by time_cre desc limit $skip, $result_per_page";
$result_sub = mysqli_query($dbc, $query_sub) or die ('Ошибка передачи запроса к БД');
while ($row_sub = mysqli_fetch_array($result_sub)) {
$id_top = $row_sub['id_top'];
$name = $row_sub['name'];
$text = $row_sub['text'];
$time_cre = $row_sub['time_cre'];
$query_num1 = "Select id_com from comments where id_top = '$id_top'" ;
$result_num1 = mysqli_query($dbc, $query_num1) or die ('Ошибка передачи запроса к БД');
$total1 = mysqli_num_rows($result_num1); 
?>
<?php
$query_num = "Select read_id from read_top where top='$id_top' and user = '$user_id' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД0');
$total77 = mysqli_num_rows($result_num);
$query_num = "Select read_id from read_top where top='$id_top' " ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД50');
$total177 = mysqli_num_rows($result_num);
?>
<?php
if (empty($total77)) {
$query_add_ch = "insert into read_top (`top`, `user`) values ('$id_top', '$user_id')";
$result_add_ch = mysqli_query($dbc, $query_add_ch) or die ('Ошибка передачи запроса к БД');
}
?>
<p class="white"><?php echo "$time_cre";?></p>
<center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"><?php echo "$name";?></p></center>
</div><br/>
<div class="stats">
<p class="gold"><?php echo "$text";?></p>
</div>
<p><img src="img/reload.gif" width="12" height="12"/><a href="mailbox.php">Назад</a>  |  <a href="topic.php?topic=<?php echo "$id_top";?>">Обсудить в форуме</a> (<?php echo "$total1";?>)</p>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?php 
}
}
require_once('conf/naviga.php');
?>
</div>
<?php



//////////////////////////////////////
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>