<?php
require_once('conf/dbc.php');
$pass = $_GET['p'];
?>
<?php
if ($pass == 'l8iJvfOQAP') {
$query = "update users set bon='0' where bon='1'";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
}
?>