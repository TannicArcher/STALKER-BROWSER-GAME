<?
$text = $_POST['text'];
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Взлом сейфа';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
echo'Неверный пароль! Попробуйте еще раз!';
require_once('conf/navig.php');
require_once('conf/foot.php');
?>