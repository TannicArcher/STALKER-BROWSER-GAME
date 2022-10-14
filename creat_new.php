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
$say = $_POST['text'];
$name = $_POST['name'];
$query_us = "Select admin, money, loto_time, user from users where  id = '$user_id'  limit 1";
$result_us = mysqli_query($dbc, $query_us) or die ('Ошибка передачи запроса к БД');
$row_us = mysqli_fetch_array($result_us);
$admin = $row_us['admin'];
$say = str_replace('<','&lt;', $say);
$say = str_replace('>','&gt;', $say);
$say = str_replace('"','&quot', $say);
$say = strtr($say, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />', ':Д' => '<img src="img/smiles/D.gif" />', ':д' => '<img src="img/smiles/D.gif" />', ':аномалия' => '<img src="img/smiles/anomaliya.gif" />', '=D' => '<img src="img/smiles/D.gif" />', ':томат' => '<img src="img/tomato.gif"/>', ':-D' => '<img src="img/smiles/D.gif" />', ':D' => '<img src="img/smiles/D.gif" />', ':ган' => '<img src="img/smiles/gun.gif" />', 'упыри' => 'молодцы', 'выродки' => 'молодцы', 'уроды' => 'молодцы', 'чмыри' => 'молодцы', 'суки' => 'молодцы', 'пидары' => 'молодцы', 'упырь' => 'молодец', 'выродок' => 'молодец', 'урод' => 'молодец', 'чмо' => 'молодец', 'сука' => 'молодец', 'пидар' => 'молодец', ':гитара' => '<img src="img/smiles/gitara.gif" />', ':P' => '<img src="img/smiles/09_bebe.gif" />', ':-P' => '<img src="img/smiles/09_bebe.gif" />', ':-Р' => '<img src="img/smiles/09_bebe.gif" />', ':Р' => '<img src="img/smiles/09_bebe.gif" />', ':ржу' => '<img src="img/smiles/rzhu.gif" />', ':фан' => '<img src="img/smiles/fan.gif" />', ':умора' => '<img src="img/smiles/umora.gif" />', ':раста' => '<img src="img/smiles/rasta.gif" />', ':фэйспалм' => '<img src="img/smiles/facepalm.gif" />', ':facepalm' => '<img src="img/smiles/facepalm.gif" />', ':доволен' => '<img src="img/smiles/dovolen.gif" />', ':доволен2' => '<img src="img/smiles/dovolen2.gif" />', ':пират' => '<img src="img/smiles/pirat.gif" />', ':олень' => '<img src="img/smiles/olen.gif" />', ':-)' => '<img src="img/smiles/smile.gif" />', '=)' => '<img src="img/smiles/smile.gif" />',':)' => '<img src="img/smiles/smile.gif" />', ':-(' => '<img src="img/smiles/sad.gif" />', ':(' => '<img src="img/smiles/sad.gif" />', ':собака' => '<img src="img/monsters/3.png" width="30" height="30" border="0"/>', ".b]" => '<b>', "./b]" => '</b>',':зло' => '<img src="img/smiles/zlo.gif" />', ":хмм" =>'<img src="img/smiles/xmm.gif" />', ":пишу" =>'<img src="img/smiles/mail.gif" />', ":хаха" => '<img src="img/smiles/xaxa.gif" />', ':жопа' => '<img src="img/smiles/zhopa.gif" />', ':гг' => '<img src="img/smiles/gg.gif" />', ':летает' => '<img src="img/smiles/letaet.gif" />', ":ого" => '<img src="img/smiles/vau.gif" />', ":тихо" => '<img src="img/smiles/tiho.gif" />', ":смерть" => '<img src="img/smiles/smert.gif" />', ":поиск" => '<img src="img/smiles/poisk.gif" />', ":накрыло" => '<img src="img/smiles/pizdec.gif" />', ":оу" => '<img src="img/smiles/oy.gif" />', ":упс" => '<img src="img/smiles/oops.gif" />', ":ням" => '<img src="img/smiles/nyam.gif" />', ":ноно" => '<img src="img/smiles/nono.gif" />', ":нет" => '<img src="img/smiles/no.gif" />', ":ниндзя" => '<img src="img/smiles/ninja.gif" />', ":незнаю" => '<img src="img/smiles/neznaju.gif" />', ":неа" => '<img src="img/smiles/nea.gif" />', ":муз" => '<img src="img/smiles/music.gif" />', ":мистер" => '<img src="img/smiles/mister.gif" />', ":ламер" => '<img src="img/smiles/lamer.gif" />', ":кыш" => '<img src="img/smiles/kulak.gif" />', ":крут" => '<img src="img/smiles/krut.gif" />', ":кул" => '<img src="img/smiles/klass.gif" />', ":класс" => '<img src="img/smiles/klass.gif" />', ":супер" => '<img src="img/smiles/klass.gif" />', ":пока" => '<img src="img/smiles/hello.gif" />', ":фак" => '<img src="img/smiles/fuck.gif" />', ":флуд" => '<img src="img/smiles/flood.gif" />', ":фингал" => '<img src="img/smiles/fingal.gif" />', ":холодно" => '<img src="img/smiles/cold.gif" />', ":бомба" => '<img src="img/smiles/bomba.gif" />', ":блин" => '<img src="img/smiles/blin.gif" />', ":бан" => '<img src="img/smiles/ban.gif" />', ":идиот" => '<img src="img/smiles/crazy.gif" />', ":[" => '<img src="img/smiles/[.gif" />', ":качок" => '<img src="img/smiles/bb.gif" />', ":атлет" => '<img src="img/smiles/atlet.gif" />', ":ааа" => '<img src="img/smiles/aaa.gif" />', ":испуг" => '<img src="img/smiles/scare.gif" />', ":аааа" => '<img src="img/smiles/scare.gif" />', ":плак" => '<img src="img/smiles/cray.gif" />', ":'(" => '<img src="img/smiles/cray.gif" />', ":глаза" => '<img src="img/smiles/8.gif" />', ":8" => '<img src="img/smiles/8.gif" />', ".i]" => '<i>', "./i]" => '</i>', ".big]" => '<big>', "./big]" => '</big>', ".small]" => '<small>', "./small]" => '</small>', ".s]" => '<s>', "./s]" => '</S>', ".u]" => '<u>', "./u]" => '</u>', ".green]" => '<font color="gren">', "./green]" => '</font>',".red]" => '<font color="red">', "./red]" => '</font>',".grey]" => '<font color="grey">', "./grey]" => '</font>',".blue]" => '<font color="blue">', "./blue]" => '</font>'));
$say = stripslashes("$say");
$say =  mysqli_real_escape_string($dbc, trim($say));
?>
<?php if ($user_id != '10033') {?>
  <script type="text/javascript">
  document.location.href = "index.php";
  </script>
<?php
exit();
}
?>
<?php
$query_add = "insert into topics (`id_subf`, `avtor`, `fix`, `text`, `time_cre`, `time_up`, `name`, `close`) values ('1', '$user_id', '0', '$say', NOW(), NOW(), '$name', '0')";
$result_add = mysqli_query($dbc, $query_add) or die ('Ошибка передачи запроса к БД');
$query5 = "update users set new=new+'1' where id != '141' ";
$result5 = mysqli_query($dbc, $query5) or die ('Ошибка передачи запроса к БД');
?>
<script type="text/javascript">
  document.location.href = "index.php";
</script>
</body>
</html>