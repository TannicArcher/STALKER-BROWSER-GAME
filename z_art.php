<?php
$error1 = $_GET['err1'];
$error2 = $_GET['err2'];
$error3 = $_GET['err3'];
$error4 = $_GET['err4'];
$error5 = $_GET['err5'];
$re1 = $_GET['re1'];
$re2 = $_GET['re2'];
$re3 = $_GET['re3'];
?>
<?php if ($error1 == '1') {?>
<div style="border-style: solid; border-width: 1px; border-color: #net;">
<p class="red">Активность артефактов не обнаружена. Использовано <span class="white"><?php echo "$re1";?>/10</span> попыток.</p>
</div>
<?php }?>
<?php if ($error2 == '1') {?>
<div style="border-style: solid; border-width: 1px; border-color: #net;">
<p class="bonus">Удачная попытка. Прогресс: <span class="white">+<?php echo "$re2";?>%</span></p>
</div>
<?php }?>
<?php if ($error3 == '1') {?>
<div style="border-style: solid; border-width: 1px; border-color: #net;">
<p class="red">Вы попали в аномалию. Здоровье: <span class="white">-<?php echo "$re3";?></span></p>
</div>
<?php }?>
<?php if ($error4 == '1') {?>
<div style="border-style: solid; border-width: 1px; border-color: #net;">
<p class="red">Использованы все попытки.</p>
</div>
<?php }?>
<?php if ($error5 == '1') {?>
<div style="border-style: solid; border-width: 1px; border-color: #net;">
<p class="red">Вас убила аномалия</p>
</div>
<?php }?>