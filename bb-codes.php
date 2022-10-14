<?
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Смайлы';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
[b]Текст[/b] => <b>Текст</b></br>[i]Текст[/i] => <i>Текст</i> </br >[big] Текст [/big] => <big>Текст</big> </br > [small] Текст[/small] <small>Текст</small> </br >[s]Текст[/s] <s>Текст</s></br > [u]Текст[/u] => <u>Текст</u> </br >[pre]Текст[/pre] => <pre>Текст</pre> </br >[green]Текст[/green] => <font color="gren">Текст</font> </br >[grey]Текст[/grey] => <font color="grey">Текст</font>
 </br > [blue]Текст[/blue] => <font color="blue">Текст</font>
</br > [red]Текст[/red] => <font color="red">Текст</font>
<?
require_once('conf/navig.php');
require_once('conf/foot.php'); 
?>