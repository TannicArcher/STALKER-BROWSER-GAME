<br />
<?php
$user_id122 = $_SESSION['id'];
$query123 = "Select opit, lvl from users where id = '$user_id122' limit 1";
$result123 = mysqli_query($dbc, $query123) or die ('Ошибка передачи запроса к БД');
$row123 = mysqli_fetch_array($result123);
$opit123 = $row123['opit'];
$opit123 = ( $opit123 / '100');
$lvl123 = $row123['lvl'];
$query_lvl1 = "Select opit from opit where opit_id='$lvl123' limit 1";
$result_lvl1 = mysqli_query($dbc, $query_lvl1) or die ('Ошибка передачи запроса к БД');
$row_lvl1 = mysqli_fetch_array($result_lvl1);
$lvl1_opit = $row_lvl1['opit'];
$query_lvl2 = "Select opit from opit where lvl='$lvl123' limit 1";
$result_lvl2 = mysqli_query($dbc, $query_lvl2) or die ('Ошибка передачи запроса к БД');
$row_lvl2 = mysqli_fetch_array($result_lvl2);
$lvl2_opit = $row_lvl2['opit'];
$opit123 = ( $lvl1_opit - $lvl2_opit );
$proc = (( '100' / $lvl1_opit ) * $opit123 );
$polos = (( '400' / '100') * $proc );
?>
<p style="border-top:1px solid #444e4f;"></p>
<p><img src="http://stalkeronlinegame.epizy.com/img/ico/po2.png" width="<?php echo "$proc";?>%" height="2"/>
<p style="border-top:1px solid #444e4f;"></p>
</p><br />