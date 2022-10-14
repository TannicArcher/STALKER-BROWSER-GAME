<?php
$dbc = mysqli_connect ('sql112.epizy.com', 'epiz_31567044', 'l8iJvfOQAP', 'epiz_31567044_stalker') or die ('Ошибка соединения с БД');
mysqli_set_charset($dbc, 'utf8');



//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Функция InitVars ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
class InitVars {
# Недопустимые слова в запросах INSERT
var $deny_words = array('UNION', 'CHAR', 'INSERT', 'DELETE', 'SELECT', 'UPDATE', 'GROUP', 'ORDER', 'BENCHMARK', 'union', 'char', 'insert', 'delete', 'select', 'update', 'group', 'order', 'benchmark', 'UNIOu', 'UNIoN', 'UNiON', 'UnION', 'uNION', 'uNIOn', 'uNIoN', 'uNiON', 'unION', 'uniOn', 'UNIon', 'uNiOn', 'UNion', 'UnIoN', 'UnIon', 'unIoN', 'DELETe', 'DELEte', 'DELete', 'DElete', 'Delete', 'dELETE', 'deLETE', 'deleTE', 'delETE', 'DeLeTe', 'dElEtE', 'dElETE', 'DELeTe', 'DElETE', 'DeLETE', 'DELEtE', 'DEletE', 'DeleTE', 'DelETE', 'DEleTE', 'DELetE', 'CHAr', 'CHaR', 'ChAR', 'cHAR', 'chAR', 'CHar', 'CahR', 'chAr', 'cHAr', 'chAR', 'ChAr', 'INSERt', 'INSErT', 'INSeRT', 'INsERT', 'InSERT', 'iNSERT', 'INSErt', 'INSerT', 'INseRT', 'InsERT', 'inSERT', 'INSert', 'INserT', 'InseRT', 'insERT', 'INsert', 'InserT', 'inseRT', 'Insert', 'insertT', 'SELECt', 'SELEcT', 'SELeCT', 'SElECT', 'SeLECT', 'sELECT', 'SELEct', 'SELecT', 'SEleCT', 'SelECT', 'seLECT', 'SELect', 'SElecT', 'SeleCT', 'selECT', 'SElect', 'SelecT', 'seleCT', 'Select', 'selectT'
, 'GROUP', 'GROUp', 'GROuP', 'GRoUP', 'GrOUP', 'gROUP', 'GROup', 'GRouP', 'GroUP', 'grOUP', 'GRoup', 'GrouP', 'groUP', 'Group', 'grouP', 'ORDEr', 'ORDeR', 'ORdER', 'OrDER', 'oRDER', 'ORDer', 'ORdeR', 'OrdER', 'orDER', 'ORder', 'OrdeR', 'ordER', 'Order', 'ordeR', 'UPDATe', 'UPDAtE', 'UPDaTE', 'UPdATE', 'UpDATE', 'uPDATE', 'UPDAte', 'UPDatE', 'UPdaTE', 'UpdATE', 'upDATE', 'UPDate', 'UPdatE', 'UpdaTE', 'updATE', 'UPdate', 'UpdatE', 'updaTE', 'Update', 'updatE', 'BENCHMARK', 'BENCHMARk', 'BENCHMArK', 'BENCHMaRK', 'BENCHmARK', 'BENChMARK', 'BENcHMARK', 'BEnCHMARK', 'BeNCHMARK', 'bENCHMARK', 'BENCHMArk', 'BENCHMarK', 'BENCHmaRK', 'BENChmARK', 'BENchMARK', 'BEncHMARK', 'BenCHMARK', 'beNCHMARK', 'BENCHMark', 'BENCHmarK', 'BENChmaRK', 'BENchmARK', 'BEnchMARK', 'BencHMARK', 'benCHMARK', 'BENCHmark', 'BENChmarK', 'BENchmaRK', 'BEnchmARK', 'BenchMARK', 'bencHMARK', 'BENChmark', 'BENchmarK'
, 'BENchmarK', 'BEnchmaRK', 'BenchmARK', 'benchMARK', 'BENchmark', 'BEnchmarK', 'BenchmaRK', 'benchmARK', 'BEnchmark', 'BenchmarK', 'benchmaRK', 'Benchmark', 'benchmarK', 'BeNcHmArK', 'bEnChMaRk', 'BEnCHMaRK', 'BENChMaRK', 'truncate', 'TRUNCATE', 'TRUNCATe', 'TRUNCAtE', 'TRUNCaTE', 'TRUNcATE', 'TRUnCATE', 'TRuNCATE', 'TrUNCATE', 'tRUNCATE', 'TRUNCAte', 'TRUNCatE', 'TRUNcaTE', 'TRUncATE', 'TRunCATE', 'TruNCATE', 'trUNCATE', 'TRUNCate', 'TRUNcatE', 'TRUncaTE', 'TRuncATE', 'TrunCATE', 'truNCATE', 'TRUNcate', 'TRUncatE', 'TRuncaTE', 'TruncATE', 'trunCATE', 'TRUncate', 'TRuncatE', 'TruncaTE', 'truncATE', 'TRuncate', 'TruncateE', 'truncaTE', 'Truncate', 'truncatE'
, 'groUp', 'grOup', 'gRoup', 'grOUp', 'gROup', 'gROUp', 'ordEr', 'orDer', 'oRder', 'orDEr', 'oRDer', 'oRDEr', 'updaTe', 'updAte', 'upDate', 'uPdate', 'updATe', 'upDAte', 'uPDate', 'upDATe', 'uPDAte', 'uPDATe', 'uniOn', 'unIon', 'uNion', 'unIOn', 'uNIon', 'uNIOn', 'chAr', 'cHar', 'cHAr', 'inseRt', 'insErt', 'inSert', 'iNsert', 'insERt', 'inSErt', 'iNSert', 'inSERt', 'iNSErt', 'iNSERt', 'seleCt', 'selEct', 'seLect', 'sElect', 'selECt', 'seLEct', 'sELect', 'seLECt', 'sELEct', 'sELECt', 'truncaTe', 'truncAte', 'trunCate', 'truNcate', 'trUncate', 'tRuncate', 'truncATe', 'trunCAte', 'truNCate', 'trUNcate', 'tRUncate', 'trunCATe', 'truNCAte', 'trUNCate', 'tRUNcate', 'truNCATe', 'trUNCAte', 'tRUNCate', 'trUNCATe', 'tRUNCAte', 'tRUNCATe'
, 'GrOuP', 'gRoUp', 'GRoUp', 'GrOUp', 'OrDeR', 'oRdEr', 'gRouP', 'grOuP', 'OrDeR', 'orDeR', 'oRdeR', 'UpDaTe', 'uPdAtE', 'UPdAtE', 'uPDatE', 'upDAtE', 'UnIoN', 'uNiOn', 'uNIoN', 'UniOn', 'InSeRt', 'iNsErT', 'iNSeRt', 'InsErT', 'InSerT', 'iNsERt', 'sElEcT', 'SeLeCt', 'sELeCt', 'SelEcT', 'sElECt', 'SeLecT', 'deleTe', 'delEte', 'deLete', 'dElete', 'delETe', 'deLEte', 'dELete', 'deLETe', 'dELEte', 'dELETe', 'TrUnCaTe', 'tRuNcAtE', 'TRunCAte', 'trUNcaTE', 'tRUncATe', 'TruNCatE', 'trUNcaTE', 'TRunCAte', 'TRUnCATe', 'TRuNCAtE', 'tRUNcATE', 'TrUNCaTE', 'tRuncAte', 'TRuNcATE', 'BeNcHmArK', 'bEnChMaRk', 'BEncHMarK', 'beNCmArk', 'bENcHmARk', 'BenChMarK', 'BEncHmaRK', 'beNChMArk'
, 'TRUNCATe', 'TRUNCAtE', 'TRUNCaTE', 'TRUNcATE', 'TRUnCATE', 'TRuNCATE', 'TrUNCATE', 'tRUNCATE', 'TRUNCAte', 'TRUNCatE', 'TRUNcaTE', 'TRUncATE', 'TRunCATE', 'TruNCATE', 'trUNCATE', 'TRUNCate', 'TRUNcatE', 'TRUncaTE', 'TRuncATE', 'TrunCATE', 'trunCATE', 'TRUncate', 'TRuncatE', 'TruncaTE', 'truncATE', 'TRuncate', 'TruncaE', 'truncaTE', 'Truncate', 'truncatE'
);
function InitVars() {
}
# Метод конвентирует суперглобальные массивы $_POST, $_GET в перемнные
# Например : $_GET['psw'] будет переобразовано в $psw с тем же значением
function convertArray2Vars() {
foreach ($_GET as $_ind => $_val) {
global $$_ind;
if (is_array($$_ind))
$$_ind = htmlspecialchars(stripslashes($_val));
}
foreach ($_POST as $_ind => $_val) {
global $$_ind;
if (is_array($$_ind))
$$_ind = htmlspecialchars(stripslashes($_val));
}
}
# Метод проверяет $_GET и $_POST переменные на наличие опасных данных и SQL инъекций
function checkVars() {
//Проверка опасных данных.
foreach ($_GET as $_ind => $_val) {
$_GET[$_ind] = htmlspecialchars(stripslashes($_val));
$exp = explode(" ", $_GET[$_ind]);
foreach ($exp as $ind => $val) {
if (in_array($val, $this->deny_words))
$this->antihack("Запрещено! Доступ закрыт!<br> Ваш ip адресс помечен!");
}
}
foreach ($_POST as $_ind => $_val) {
$_POST[$_ind] = htmlspecialchars(stripslashes($_val));
$exp = explode(" ", $_POST[$_ind]);
foreach ($exp as $ind => $val) {
if (in_array($val, $this->deny_words))
$this->antihack("Запрещено! Доступ закрыт!<br> Ваш ip адресс помечен!");
}
}
}
function antihack($msg) {
echo '<font color="red"><b>Antihack error: </b></font>' . $msg . '<br>\n';
die;
}
}

/*несколько строчек, которые спасут мир(Кредитор.aisamyeri)*/

function Kpegumop($str) {

$string = substr_replace('javascript:',$str);

return $str;
}

if (isset($_POST)) {
foreach($_POST as $key => $value) { 
$tmpPOST[$key] = addslashes(Kpegumop($value));

} 

if ($_POST !=null)$_POST = $tmpPOST;

}

if (isset($_GET)) {
foreach($_GET as $key => $value) { 
$tmppGET[$key] = addslashes(Kpegumop($value));

} 

if ($_GET !=null)$_GET = $tmppGET;

}

/*проверяем адресную строку на xss если кака прекращаем работу скрипта(Кредитор.авт.valerik)*/

if(substr_count($_SERVER['REQUEST_URI'],"'"))exit;

 // фильтрация get
 foreach ($_GET as $getstr) {
if (eregi('\'|<|>|union|select|bench|h1|script|`',$getstr)) {
header("Location:/not_query.php");
exit;
}}
// фильтрация post
foreach ($_POST as $poststr) {
if (eregi('\'|union|select|bench|alert|h1|script|`',$poststr)) {
header("Location:/not_query.php");
exit;
}}
?>