<?php
session_start();





if (!isset($_SESSION['id'])) {
  if ((isset($_COOKIE['id'])) and (isset($_COOKIE['nick']))) {
    $user_id = $_COOKIE['id'];
    $nickcode = $_COOKIE['nick'];
	$user_id  =  mysqli_real_escape_string($dbc, trim($user_id));
	$nickcode =  mysqli_real_escape_string($dbc, trim($nickcode));
	$query = "Select nick from users where id = '$user_id' and nickcode = '$nickcode'";
    $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
    $row = mysqli_fetch_array($result);
	if (!empty($row)) {
      $_SESSION['id'] = $_COOKIE['id'];
	  $_SESSION['nick'] = $row['nick'];
	}
  }
}

if (!isset($_COOKIE['id'])) {
  if ((isset($_SESSION['id'])) and (isset($_SESSION['nick']))) {
   $user_id = $_SESSION['id'];
   $nick = $_SESSION['nick'];
   $user_id  =  mysqli_real_escape_string($dbc, trim($user_id));
   $nick = mysqli_real_escape_string($dbc, trim($nick));	
   $query = "Select nickcode from users where id = '$user_id' and nick = '$nick'";
   $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
   $row = mysqli_fetch_array($result);
$nickcode1 = $row['nickcode'];
   if (!empty($row)) {
     setcookie('id', "$user_id", time() + (60 * 60 * 24 * 30));    // expires in 30 days
     setcookie('nick', $row['nickcode'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
   }
  }
}
?>