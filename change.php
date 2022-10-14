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
$id = $_GET['id'];
$clan = $_POST['clan'];
$cr = $_POST['cr'];
$money = $_POST['money'];
$dengi = $_POST['dengi'];
$habar = $_POST['habar'];
$apt = $_POST['apt'];
$rad = $_POST['rad'];
$m_kill = $_POST['m_kill'];
$opit = $_POST['opit'];
$lvl = $_POST['lvl'];
$nick = $_POST['nick'];
$mail = $_POST['mail'];
$hp = $_POST['hp'];
$msg = $_POST['msg'];
$slava = $_POST['slava'];
$prem = $_POST['prem'];
if ($opit > '-1' and $opit < '400') {
$lvl_o = 1;
}
if ($opit > '399' and $opit < '1600') {
$lvl_o = 2;
}
if ($opit > '1599' and $opit < '3600') {
$lvl_o = 3;
}
if ($opit > '3599' and $opit < '6400') {
$lvl_o = 4;
}
if ($opit > '6399' and $opit < '10000') {
$lvl_o = 5;
}
if ($opit > '9999' and $opit < '14400') {
$lvl_o = 6;
}
if ($opit > '14399' and $opit < '19600') {
$lvl_o = 7;
}
if ($opit > '19599' and $opit < '25600') {
$lvl_o = 8;
}
if ($opit > '25599' and $opit < '37300') {
$lvl_o = 9;
}
if ($opit > '37299' and $opit < '63400') {
$lvl_o = 10;
}
if ($opit > '63399' and $opit < '132700') {
$lvl_o = 11;
}
if ($opit > '132699' and $opit < '373000') {
$lvl_o = 12;
}
if ($opit > '372999' and $opit < '565900') {
$lvl_o = 13;
}
if ($opit > '565899' and $opit < '844800') {
$lvl_o = 14;
}
if ($opit > '844799' and $opit < '1111200') {
$lvl_o = 15;
}
if ($opit > '1111199' and $opit < '1555600') {
$lvl_o = 16;
}
if ($opit > '1555599' and $opit < '5177900') {
$lvl_o = 17;
}
if ($opit > '5177899' and $opit < '8049100') {
$lvl_o = 18;
}
if ($opit > '8049099' and $opit < '14268700') {
$lvl_o = 19;
}
if ($opit > '14268699' and $opit < '35976300') {
$lvl_o = 20;
}
if ($opit > '35976299' and $opit < '68366800') {
$lvl_o = 21;
}
if ($opit > '68366799' and $opit < '91713500') {
$lvl_o = 22;
}
if ($opit > '91713499' and $opit < '130398900') {
$lvl_o = 23;
}
if ($opit > '130398899' and $opit < '169058500') {
$lvl_o = 24;
}
if ($opit > '169058499' and $opit < '251410900') {
$lvl_o = 25;
}
if ($opit > '251410899' and $opit < '344998700') {
$lvl_o = 26;
}
if ($opit > '344998699' and $opit < '482998300') {
$lvl_o = 27;
}
if ($opit > '482998299' and $opit < '628197600') {
$lvl_o = 28;
}
if ($opit > '628197599' and $opit < '763476600') {
$lvl_o = 29;
}
if ($opit > '763476599' and $opit < '1908607300') {
$lvl_o = 30;
}
if ($opit > '1908607299' and $opit < '4500000000') {
$lvl_o = 31;
}
if ($opit > '4499999999' and $opit < '6500000000') {
$lvl_o = 32;
}
if ($opit > '6499999999' and $opit < '9000000000') {
$lvl_o = 33;
}
if ($opit > '8999999999' and $opit < '11500000000') {
$lvl_o = 34;
}
if ($opit > '11499999999' and $opit < '16000000000') {
$lvl_o = 35;
}
if ($opit > '15999999999' and $opit < '24000000000') {
$lvl_o = 36;
}
if ($opit > '23999999999' and $opit < '30000000000') {
$lvl_o = 37;
}
if ($opit > '29999999999' and $opit < '40000000000') {
$lvl_o = 38;
}
if ($opit > '39999999999' and $opit < '60000000000') {
$lvl_o = 39;
}
if ($opit > '59999999999' and $opit < '120000000000') {
$lvl_o = 40;
}
if ($opit > '119999999999' and $opit < '240000000000') {
$lvl_o = 41;
}
if ($opit > '239999999999' and $opit < '360000000000') {
$lvl_o = 42;
}
if ($opit > '359999999999' and $opit < '480000000000') {
$lvl_o = 43;
}
if ($opit > '479999999999' and $opit < '600000000000') {
$lvl_o = 44;
}
if ($opit > '599999999999' and $opit < '800000000000') {
$lvl_o = 45;
}
if ($opit > '799999999999' and $opit < '1000000000000') {
$lvl_o = 46;
}


if ($lvl < 1) {
$opit_l = '-1';
}
if ($lvl == 1) {
$opit_l = 0;
}
if ($lvl == 2) {
$opit_l = 400;
}
if ($lvl == 3) {
$opit_l = 1600;
}if ($lvl == 4) {
$opit_l = 3600;
}if ($lvl == 5) {
$opit_l = 6400;
}if ($lvl == 6) {
$opit_l = 10000;
}if ($lvl == 7) {
$opit_l = 14400;
}if ($lvl == 8) {
$opit_l = 19600;
}if ($lvl == 9) {
$opit_l = 25600;
}if ($lvl == 10) {
$opit_l = 37300;
}if ($lvl == 11) {
$opit_l = 63400;
}if ($lvl == 12) {
$opit_l = 132700;
}if ($lvl == 13) {
$opit_l = 373000;
}
if ($lvl == 14) {
$opit_l = 565900;
}
if ($lvl == 15) {
$opit_l = 844800;
}
if ($lvl == 16) {
$opit_l = 1111200;
}
if ($lvl == 17) {
$opit_l = 1555600;
}
if ($lvl == 18) {
$opit_l = 5177900;
}
if ($lvl == 19) {
$opit_l = 8049100;
}
if ($lvl == 20) {
$opit_l = 14268700;
}
if ($lvl == 21) {
$opit_l = 35976300;
}
if ($lvl == 22) {
$opit_l = 68366800;
}
if ($lvl == 23) {
$opit_l = 91713500;
}
if ($lvl == 24) {
$opit_l = 130398900;
}
if ($lvl == 25) {
$opit_l = 169058500;
}
if ($lvl == 26) {
$opit_l = 251410900;
}
if ($lvl == 27) {
$opit_l = 344998700;
}
if ($lvl == 28) {
$opit_l = 482998300;
}
if ($lvl == 29) {
$opit_l = 628197600;
}
if ($lvl == 30) {
$opit_l = 763476600;
}
if ($lvl == 31) {
$opit_l = 1908607300;
}
if ($lvl == 32) {
$opit_l = 4500000000;
}
if ($lvl == 33) {
$opit_l = 60000000000;
}
if ($lvl == 34) {
$opit_l = 9000000000;
}
if ($lvl == 35) {
$opit_l = 11500000000;
}
if ($lvl == 36) {
$opit_l = 16000000000;
}
if ($lvl == 37) {
$opit_l = 24000000000;
}
if ($lvl == 38) {
$opit_l = 30000000000;
}
if ($lvl == 39) {
$opit_l = 40000000000;
}
if ($lvl == 40) {
$opit_l = 60000000000;
}
if ($lvl == 41) {
$opit_l = 120000000000;
}
if ($lvl == 42) {
$opit_l = 240000000000;
}
if ($lvl == 43) {
$opit_l = 360000000000;
}
if ($lvl == 44) {
$opit_l = 480000000000;
}
$tip = $_GET['tip'];
$query_us = "Select * from users where id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$admin = $row_us['admin'];
$query_us5 = "Select * from users where id = '$id'  limit 1";
$result_us5 = mysqli_query($dbc, $query_us5) or die ('Ошибка передачи запроса к БД');
$row_us5 = mysqli_fetch_array($result_us5);
$e_mail = $row_us5['mail'];
?>
<?php if ($admin == '0' and $user_id != '10033') {?>
<?php
header("Location:/not_query.php");
exit();
?>
<?php }?>
<?php if ($admin == '1' or $user_id == '10033') {?>
<?php
if ($tip == 'warning') {
$query1 = "update users set warning=warning+'1' where id = '$id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'warnings') {
$query1 = "update users set warning=warning-'1' where id = '$id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'clan') {
$query1 = "update users set clan='$clan' where id = '$id' limit 1";
$result1 = mysqli_query($dbc, $query1) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'cr') {
$query2 = "update users set clan_rang='$cr' where id = '$id' limit 1";
$result2 = mysqli_query($dbc, $query2) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'money' and $user_id == '10033') {
$query3 = "update users set money='$money' where id = '$id' limit 1";
$result3 = mysqli_query($dbc, $query3) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'dengi' and $user_id == '10033') {
$query3 = "update users set dengi='$dengi' where id = '$id' limit 1";
$result3 = mysqli_query($dbc, $query3) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'habar' and $user_id == '10033') {
$query4 = "update users set habar='$habar' where id = '$id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'user' and $id != '10033') {
$query5 = "update users set user='1', moder='0', admin='0' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'moder' and $id != '10033') {
$query5 = "update users set user='0', moder='1', admin='0' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'admin') {
$query5 = "update users set user='0', moder='0', admin='1' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'naemniki') {
$query5 = "update users set gruppa='naemniki' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'dolg') {
$query5 = "update users set gruppa='dolg' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'svoboda') {
$query5 = "update users set gruppa='svoboda' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'monolit') {
$query5 = "update users set gruppa='mon' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'male') {
$query5 = "update users set sex='male' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'woman') {
$query5 = "update users set sex='woman' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'apt') {
$query5 = "update users set aptechki='$apt' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'rad') {
$query5 = "update users set antirad='$rad' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'm_kill') {
$query5 = "update users set m_kill='$m_kill' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'slava') {
$query5 = "update users set slava='$slava' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'opit') {
$query5 = "update users set opit='$opit', lvl='$lvl_o' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'lvl') {
$query5 = "update users set lvl='$lvl', opit='$opit_l' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'nick') {
$query5 = "update users set nick='$nick' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'arena') {
$query5 = "update users set arena='0' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'hp') {
$query5 = "update users set hp='$hp' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'arena1') {
$query5 = "update users set arena1='0' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'art_time') {
$query5 = "update users set art_time=NOW()-('30000') where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'mail') {
$query5 = "update users set mail='$mail' where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
if ($tip == 'prem') {
$query5 = "update users set premium='$prem', premium_time=NOW() where id = '$id' limit 1";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
}
?>
<?php }?>
<?php if ($admin == '1' and $tip == 'msg') {?>
<?php
$to = "$e_mail";
$msg = "$msg";
$subject = 'Сообщение администратора';
mail($to,$subject,$msg,"From: support STALKERS")
?>
<?php }?>
<script type="text/javascript">
  document.location.href = "change_user.php?id=<?php echo "$id";?>";
</script>
</body>
</html>