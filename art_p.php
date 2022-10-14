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
?>
<?php
$user_id = $_SESSION['id'];
$query_us = "Select * from users where id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$lvl = $row_us['lvl'];
$hp = $row_us['hp'];
$loc = $row_us['loc'];
$art_apt = $row_us['art_apt'];
$art_pop = $row_us['art_pop'];
$art_poisk = $row_us['art_poisk'];
$art_pr = $row_us['art_pr'];
$art_tip = $row_us['art_tip'];
$art_vid = $row_us['art_vid'];
$art_time = $row_us['art_time'];
$art_time = strtotime("$art_time");
$now = (date("Y-m-d H:i:s"));
$now = strtotime("$now");
$time_art = ($art_time + '10800');
$time_art = ($time_art - $now);
$query_dec = "Select * from things where user_id = '$user_id' and type='7' and place='2' limit 1";
$result_dec = mysqli_query($dbc, $query_dec) or die ('Ошибка передачи запроса к БД');
$row_dec = mysqli_fetch_array($result_dec);
$stat1 = $row_dec['stat1'];
$stat2 = $row_dec['stat2'];
$shans = $row_dec['speed'];
$yr1 = ($lvl * '25');
$yr2 = ($lvl * '95');
$lal = rand(1,100);
$lal1 = rand($stat1,$stat2);
$lal2 = rand(1,100);
$lalhutor = rand(1,3);
?>
<?php if ($time_art > '0') {?>
  <script type="text/javascript">
  document.location.href = "zonas.php";
  </script>
  <?php
  exit();
}
?>
<?php if (empty($row_dec)) {?>
  <script type="text/javascript">
  document.location.href = "zonas.php";
  </script>
  <?php
  exit();
}
?>
<?php
if ($art_poisk == '0') {?>
<?php
$query1 = "update users set art_poisk='1', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'hutor' and $art_tip == '0') {?>
<?php
if ($lal2 < $shans and $art_pop < '10') {
$query1 = "update users set art_tip='1', art_vid='$lalhutor' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($lal2 > $shans and $art_pop < '10') {
$query1 = "update users set art_pop=art_pop+'1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$err1 = 1;
$art_pop = ($art_pop + '1');
}
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'hutor' and $art_tip == '1' and $art_pr < '100') {?>
<?php
$lal3 = rand($yr1,$yr2);
if ($lal < $shans) {
$query1 = "update users set art_pr=art_pr+'$lal1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$err2 = 1;
}
if ($lal > $shans) {
$query1 = "update users set hp=hp-'$lal3' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$err3 = 1;
$hp = ($hp - $lal3);
}
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'hutor' and $art_tip == '1' and $art_pr > '99' and $art_vid == '1') {?>
<?php
$query1 = "update users set art1=art1+'1', art_poisk='0', art_tip='0', art_pr='0', art_pop='0', art_time=NOW(), art_vid='0', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'hutor' and $art_tip == '1' and $art_pr > '99' and $art_vid == '2') {?>
<?php
$query1 = "update users set art2=art2+'1', art_poisk='0', art_tip='0', art_pr='0', art_pop='0', art_time=NOW(), art_vid='0', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'hutor' and $art_tip == '1' and $art_pr > '99' and $art_vid == '3') {?>
<?php
$query1 = "update users set art3=art3+'1', art_poisk='0', art_tip='0', art_pr='0', art_pop='0', art_time=NOW(), art_vid='0', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'zemsnaryad' and $art_tip == '0') {?>
<?php
if ($lal2 < $shans and $art_pop < '10') {
$query1 = "update users set art_tip='1', art_vid='$lalhutor' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($lal2 > $shans and $art_pop < '10') {
$query1 = "update users set art_pop=art_pop+'1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$err1 = 1;
$art_pop = ($art_pop + '1');
}
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'zemsnaryad' and $art_tip == '1' and $art_pr < '100') {?>
<?php
$lal3 = rand($yr1,$yr2);
if ($lal < $shans) {
$query1 = "update users set art_pr=art_pr+'$lal1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$err2 = 1;
}
if ($lal > $shans) {
$query1 = "update users set hp=hp-'$lal3' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$err3 = 1;
$hp = ($hp - $lal3);
}
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'zemsnaryad' and $art_tip == '1' and $art_pr > '99' and $art_vid == '1') {?>
<?php
$query1 = "update users set art2=art2+'1', art_poisk='0', art_tip='0', art_pr='0', art_pop='0', art_time=NOW(), art_vid='0', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'zemsnaryad' and $art_tip == '1' and $art_pr > '99' and $art_vid == '2') {?>
<?php
$query1 = "update users set art4=art4+'1', art_poisk='0', art_tip='0', art_pr='0', art_pop='0', art_time=NOW(), art_vid='0', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php
if ($art_poisk == '1' and $loc == 'zemsnaryad' and $art_tip == '1' and $art_pr > '99' and $art_vid == '3') {?>
<?php
$query1 = "update users set art5=art5+'1', art_poisk='0', art_tip='0', art_pr='0', art_pop='0', art_time=NOW(), art_vid='0', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<?php if ($art_pop > '9') {?>
<?php
$query1 = "update users set art_pop='0', art_poisk='0', art_tip='0', art_pr='0', art_time=NOW(), art_vid='0', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$err4 = 1;
?>
<?php }?>
<?php if ($hp < '1') {?>
<?php
$query1 = "update users set art_pop='0', art_poisk='0', art_tip='0', art_pr='0', art_time=NOW(), art_vid='0', art_apt='0' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
$err5 = 1;
?>
<?php }?>
<?php
if ($art_poisk == '1' and $art_tip == '1' and $art_pr > '99') {?>
<?php
$query1 = "update users set art_n=art_n+'1' where id = '$user_id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
?>
<?php }?>
<script type="text/javascript">
  document.location.href = "zonas.php?re1=<?php echo "$art_pop";?>&re2=<?php echo "$lal1";?>&re3=<?php echo "$lal3";?>&err1=<?php echo "$err1";?>&err2=<?php echo "$err2";?>&err3=<?php echo "$err3";?>&err4=<?php echo "$err4";?>&err5=<?php echo "$err5";?>";
</script>
</body>
</html>