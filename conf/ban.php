<?php
$id = $_SESSION['id'];
$ss_agent = $_SERVER['HTTP_USER_AGENT'];

$query_ban_agent = "Select * from ban_agent where agent = '$ss_agent' ";
$result_ban_agent = mysqli_query($dbc, $query_ban_agent) or die ('Ошибка передачи запроса к БД');
$row_ban_agent = mysqli_fetch_array($result_ban_agent);


$block = '0';
@$query_pb = "Select * from bans where user_id = '$id' and type = '4'";
@$result_pb = mysqli_query($dbc, $query_pb) or die ('Ошибка передачи запроса к БД');
@$row_pb = mysqli_fetch_array($result_pb);
if ($row_pb > '0') {
$block = '1';
$mod_id1 = $row_pb['mod_id'];
$time_ban1 = $row_pb['time_ban'];
$time_type1 = $row_pb['time_type'];
$wtf1 = $row_pb['wtf'];
@$query_pb1 = "Select nick from users where id = '$mod_id1'";
@$result_pb1 = mysqli_query($dbc, $query_pb1) or die ('Ошибка передачи запроса к БД');
@$row_pb1 = mysqli_fetch_array($result_pb1);
$mn1 = $row_pb1['nick'];


$tp1 = ($time_type1 * '60');
$wwon1 = (date("Y-m-d H:i:s"));
$wwon1 = strtotime("$wwon1");
$loto_time1 = $time_ban1;
$loto_time1 = strtotime("$loto_time1");
$loto_time1 = ($loto_time1 + $tp1);
$btp = ($loto_time1 - $wwon1);

if ($btp < '1') {
@$query = "delete from bans where user_id = '$id' and type = '4' limit 1";
@$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
$block = '0';
}
}

@$query = "Select ban, why_ban, nick from users where id = '$id'";
@$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
@$row = mysqli_fetch_array($result);
$ban = $row['ban'];
if ($block == 1) { 
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
mysqli_close($dbc);
exit();
}

if ($ban == 1) { 
?>
<?php
echo 'Ваш аккаунт заблокирован администратором.';
exit();
?>
<?php
}

if (!empty($row_ban_agent)) { 
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
<?php
mysqli_close($dbc);
exit();
}
?>
