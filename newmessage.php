<?php
$dbc = mysqli_connect ('sql112.epizy.com', 'epiz_31567044', 'l8iJvfOQAP', 'epiz_31567044_stalker') or die ('Ошибка соединения с БД lol');
mysqli_set_charset($dbc, 'utf8');

include("conf/session_start.php");
?>
<?php
$now = (date("H:i:s"));
echo "$now";
?>

<?php
$mes = $_GET['mes'];
$user_id = $_SESSION['id'];
$bag= mysql_fetch_array(mysql_query ("SELECT *  FROM  `message` WHERE `dlya`='"( $user_id."' and `reading`='0' ")));


$query_num = "Select message_id from message where dlya='$user_id' and reading = '0'" ;
$result_num = mysqli_query($dbc, $query_num) or die ('Ошибка передачи запроса к БД11');
$total51 = mysqli_num_rows($result_num); 
?>

<?php
if ($total51 > '0') {?>
<audio autoplay >
  <source src="http://stalkeronlinegame.epizy.com/stalker_sms.mp3" type="audio/mp3">
</audio>
<?php }?>