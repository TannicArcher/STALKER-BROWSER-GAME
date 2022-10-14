<?php
include("connect.php");
include("conf/dbc.php");
include("conf/session_start.php");
$user_id = $_SESSION['id'];
$id1 = $user_id;
$id2 = $_GET['id'];
$query_list = "Select * from black_list where user_id='$id1' and black_id='$id2' limit 1";
$result_list = mysqli_query($dbc, $query_list) or die ('Ошибка передачи запроса к БД45');
$row_list1 = mysqli_fetch_array($result_list);
$query_list = "Select * from black_list where user_id='$id2' and black_id='$id1' limit 1";
$result_list = mysqli_query($dbc, $query_list) or die ('Ошибка передачи запроса к БД445');
$row_list2 = mysqli_fetch_array($result_list);
$ban_p = '0';
$query_pb = "Select * from bans where user_id = '$user_top' and type = '1'";
$result_pb = mysqli_query($dbc, $query_pb) or die ('Ошибка передачи запроса к БД');
$row_pb = mysqli_fetch_array($result_pb);
if ($row_pb > '0') {
$ban_p = '1';
}
$text = $_POST['message'];
require_once('inc_smiles.php');
?>
<?php
header("Content-type: text/html; charset=windows-1251");

//**********************************************
if(empty($_POST['js'])){
	if($_POST['message'] != ''){
if ($row_list1 == 0 and $row_list2 == 0 and $ban_p == '0') {
	$message = @iconv("UTF-8", "windows-1251", $text);
		$message = stripslashes($message);
		$message = mysql_real_escape_string($message);


		$date = date("d-m-Y в H:i:s");
		$result = mysql_query("INSERT INTO `message` (`type`, `ot`, `dlya`, `text`, `time`) VALUES ('1', '$user_id', '$id2', '$message', NOW())");
		if($result == true){
			echo 0; //Ваше сообшение успешно отправлено
		}else{
			echo 1; //Сообщение не отправлено. Ошибка базы данных
		}
	}else{
		echo 2; //Нельзя отправлять пустые сообщения
	}
$query = "update users set message=message+'1' where id = '$id2' ";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД3');


$query_ = "Select * from kontakts where user_id='$id1' and drug_id='$id2' limit 1";
$result_ = mysqli_query($dbc, $query_) or die ('Ошибка передачи запроса к БД5');
$row_ = mysqli_fetch_array($result_);

$query_ = "Select * from kontakts where user_id='$id2' and drug_id='$id1' limit 1";
$result_ = mysqli_query($dbc, $query_) or die ('Ошибка передачи запроса к БД5');
$row_21 = mysqli_fetch_array($result_);

if ($row_ == 0) {
$query = "insert into kontakts (`user_id`, `drug_id`, `time`) values ('$id1', '$id2', NOW() )";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6');
}
if ($row_21 == 0) {
$query0 = "insert into kontakts (`user_id`, `drug_id`, `time`) values ('$id2', '$id1', NOW() )";
$result0 = mysqli_query($dbc, $query0) or die ('Ошибка передачи запроса к БД7'); 
}
if ($row_ != 0) {
$query = "update kontakts set `time`=NOW() where user_id='$id1' and drug_id='$id2' or user_id='$id2' and drug_id='$id1' limit 2";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД8');
}
}
} else {
echo 4; //ЧС или бан.
}
?>    