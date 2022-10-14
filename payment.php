<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Пополнение баланса';
require_once('conf/head2.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
<div id="main" style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/dlfon.gif) repeat;">
<div class="stats">
<p class="podmenu">Пополнение счёта</p>
</div>
<?php if ($user_top == '10033') {?>

 <div id="newmes"></div> 


 <script>  
        function show()  
        {  
            $.ajax({  
                url: "newmessage.php",  
                cache: false,  
                success: function(html){  
                    $("#newmes").html(html);  
                }  
            });  
        }  
      
        $(document).ready(function(){  
            show();  
            setInterval('show()',1000);  
        });  
    </script>  



<?php }?>


<?php
/////////////КУРС
$wmb = '319';
$wmu = '0.25';
$wmz = '0.03';
$wmr = '1';



$wmb2k = ($wmb * '15');
$wmu2k = ($wmu * '15');
$wmz2k = ($wmz * '15');
$wmb2k = round("$wmb2k");
$wmu2k = round("$wmu2k");
$wmz2k = round("$wmz2k");
?>
<script>
function show_hide(id){
var item = document.getElementById(id);
if (item.style.display == 'none') {item.style.display = 'block';}
else item.style.display = 'none';
}
</script>
<?php
$type=$_GET['type'];
if (empty($type) or $type <> 1 and $type <> 2 and $type <> 3 and $type <> 4 and $type <> 5 and $type <> 6 and $type <> 7 and $type <> 8) {
  $type=1;
}
?>
<div class="stats">
<a class="menu" <?php if ($type == 1) {?>style="color: #ffffff;"<?php } ?> href="payment.php?type=1"><img src="img/ico/point.png" width="12" height="12"/>Через смс</a>
<a class="menu" <?php if ($type == 2) {?>style="color: #ffffff;"<?php } ?> href="payment.php?type=2"><img src="img/ico/point.png" width="12" height="12"/>Через Web Money</a>
<a class="menu" <?php if ($type == 7) {?>style="color: #ffffff;"<?php } ?> href="payment.php?type=7"><img src="img/ico/point.png" width="12" height="12"/>Через Qiwi</a>
</div>
<?php
if ($type == 1) {/////по смс
  ?>
  <div class="stats">
<div class="link">
<a href="payment.php?type=3" class="link"><img src="img/ico/den.png" width="12" height="12"/>Как купить?</a>
</div>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>SMS-агенты:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div>
<div class="link">
<a href="profile.php?id=10033" class="link">Администратор</a>
</div>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Цены:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><div style="background:#444e4f url(http://stalkeronlinegame.epizy.com/img/007.png) repeat-x top;"><br/></div>
<center>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<p class="net">Россия:</p>
</div>

<br/>
<p><b><img src="img/ico/money.png" width="12" height="12"/> 3000 RUB = 15 рублей</b><br/></p>
<p>- - -</p>
<a href="javascript:show_hide('block')">Доп. информация</a><img src="img/ico/bottom.png" width="12" height="12"/>
<div id="block" style="display:none">
<p><span class="bonus">Система поддерживает только следующие операторы: Мегафон, Билайн, МТС и Байкалвестком.<br/>
Взимается комиссия мобильной коммерции:<br/>
Билайн 5.95%<br/>
Мегафон 7.95%<br/>
МТС 12.5% + 10 руб.<br/>
Байкалвестком 5.9%</span></p>
</div>
<p>- - -</p>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<p class="net">Украина:</p>
</div>
<br/>
  <b><img src="img/ico/money.png" width="12" height="12"/> 9000 RUB = 12,75 грн<br/>
  <img src="img/ico/money.png" width="12" height="12"/> 20000 RUB <span class="bonus">(+10000)</span> = 26,56 грн<br/>
  <img src="img/ico/money.png" width="12" height="12"/> 40000 RUB <span class="bonus">(+20000)</span> = 53,13 грн</b><br/>
<p>- - -</p>
<a href="javascript:show_hide('block1')">Доп. информация</a><img src="img/ico/bottom.png" width="12" height="12"/>
<div id="block1" style="display:none">
<p><span class="bonus">Система поддерживает только следующие операторы: Life, Киевстар, МТС.</span></p>
</div>
<p>- - -</p>
  </div>
  </div>
  <?php
}
if ($type == 2) {/////по ВМ
  ?>
  <div class="stats">
<div class="link">
<a href="payment.php?type=4" class="link"><img src="img/ico/den.png" width="12" height="12"/>Как купить?</a>
</div>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Цены:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><div style="background:#444e4f url(http://stalkeronlinegame.epizy.com/img/007.png) repeat-x top;"><br/></div>
<center>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<p class="net">Россия:</p>
</div>

<br/>
<p><b><img src="img/ico/money.png" width="12" height="12"/> 3000 RUB = 15 wmr</b><br/></p>

<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<p class="net">Украина:</p>
</div>
<br/>
  <p><b><img src="img/ico/money.png" width="12" height="12"/> 3000 RUB = <?php echo "$wmu2k";?> wmu</b><br/></p>

<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<p class="net">Беларусь:</p>
</div>
<br/>
<p><b><img src="img/ico/money.png" width="12" height="12"/> 3000 RUB = <?php echo "$wmb2k";?> wmb</b><br/></p>
  </center>
  <?php
}
if ($type == 3) {/////Для смс
  ?>
  <div class="stats">
  <p class="bonus"><b>Ваши действия:</b></p>
<p class="white">
1. Пишите свой номер (с которого хотите произвести оплату) и сумму покупки в почту <b><a href="profile.php?id=10033">главного администратора</a></b> игры.<br />
2. Вам придет смс, на которое нужно ответить согласно инструкции внутри данного сообщения.<br />
3.<span class="red">(для Украины</span>) После подтверждения оплаты на ваш телефон придет второе сообщение, сообщение с кодом. Его необходимо написать в почту <b><a href="profile.php?id=10033">главного администратора</a></b> игры.<br />
Сразу после оплаты на ваш счет поступят игровые RUB</p>
</div>
  <?php
}
if ($type == 4) {/////для ВМ
  ?>
  <div class="stats">
  <p class="bonus"><b>Ваши действия:</b></p>
<p class="white">
1. Выбираете номер подходящего вам кошелька, на который вы должны будете перевести нужную вам сумму денег.<br />
2. Переводите желаемую сумму денег, указывая в комментариях ваш логин или id.<br />
Сразу после оплаты на ваш счет поступят игровые RUB</p>
<p><b>Кошельки:</b></p>
R345051167519 (русские рубли)<br />
U272387025088 (украинские гривны) <br />
B251098484773 (белорусские рубли) <br />
Z407935654391 (доллары)
</div>
  <?php
}
if ($type == 5) {/////Россия
  ?>
  <div class="stats">
<p><b><img src="img/ico/den.png" width="12" height="12"/><a href="payment.php?type=3"><span class="bonus">Как купить?</span></a></b></p><br/>
  <p class="bonus"><b>SMS-агенты:</b></p>
<p><b><a href="profile.php?id=530">nations</a></b></p><br />
<p class="bonus"><b>Цены:</b></p>  
<p class="white"><b>Россия:</b></p>
  <p>[<img src="img/ico/money.png" width="12" height="12"/> 3000 RUB = 15 рублей]<br />
- - - - -<br/>
<p>- - -</p>
<p><span class="bonus">Система поддерживает только следующие операторы: Мегафон, Билайн, МТС и Байкалвестком.<br/>
Взимается комиссия мобильной коммерции:<br/>
Билайн 5.95%<br/>
Мегафон 7.95%<br/>
МТС 12.5% + 10 руб.<br/>
Байкалвестком 5.9%</span></p>
<p><a href="payment.php?type=1">Доп. информация</a><img src="img/ico/up.png" width="12" height="12"/></p>
<p>- - -</p><br/>
<p class="white"><b>Украина:</b></p>
  <p>[<img src="img/ico/money.png" width="12" height="12"/> 9000 RUB = 12,75 грн]
  <p>[<img src="img/ico/money.png" width="12" height="12"/> 20000 RUB <span class="bonus">(+10000)</span> = 26,56 грн]
  <p>[<img src="img/ico/money.png" width="12" height="12"/> 40000 RUB <span class="bonus">(+20000)</span> = 53,13 грн]<br/>
<p>- - -</p>
<a href="payment.php?type=6">Доп. информация</a><img src="img/ico/bottom.png" width="12" height="12"/>
<p>- - -</p><br/>
  </div><br />
  </div>
  <?php
}
if ($type == 6) {/////Украина
  ?>
  <div class="stats">
<p><b><img src="img/ico/den.png" width="12" height="12"/><a href="payment.php?type=3"><span class="bonus">Как купить?</span></a></b></p><br/>
  <p class="bonus"><b>SMS-агенты:</b></p>
<p><b><a href="profile.php?id=530">nations</a></b></p><br />
<p class="bonus"><b>Цены:</b></p>  
<p class="white"><b>Россия:</b></p>
  <p>[<img src="img/ico/money.png" width="12" height="12"/> 3000 RUB = 15руб]<br />
- - - - -<br/>

<a href="payment.php?type=5">Доп. информация</a><img src="img/ico/bottom.png" width="12" height="12"/>
<p>- - -</p><br/>
<p class="white"><b>Украина:</b></p>
  <p>[<img src="img/ico/money.png" width="12" height="12"/> 9000 RUB = 12,75 грн]
  <p>[<img src="img/ico/money.png" width="12" height="12"/> 20000 RUB <span class="bonus">(+10000)</span> = 26,56 грн]
  <p>[<img src="img/ico/money.png" width="12" height="12"/> 40000 RUB <span class="bonus">(+20000)</span> = 53,13 грн]<br/>
<p>- - -</p>
<p><span class="bonus">Система поддерживает только следующие операторы: Life, Киевстар, МТС.<span></p>
<p><a href="payment.php?type=1">Доп. информация</a><img src="img/ico/up.png" width="12" height="12"/></p>
<p>- - -</p><br/>
  </div><br />
  </div>
<?php }
if ($type == 7) {?>
  <div class="stats">
<div class="link">
<a href="payment.php?type=8" class="link"><img src="img/ico/den.png" width="12" height="12"/>Как купить?</a>
</div>
<div style="background-color: #1E1E1E;">
<p style="border-top:1px solid #444e4f;"></p>
<center><b>Цены:</b></center>
<p style="border-top:1px solid #444e4f;"></p>
</div><div style="background:#444e4f url(http://stalkeronlinegame.epizy.com/img/007.png) repeat-x top;"><br/></div>
<center>
<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<p class="net">Россия:</p>
</div>

<br/>
<p><b><img src="img/ico/money.png" width="12" height="12"/> 3000 RUB = 15 wmr</b><br/></p>

<div style="background:#2e2e2d url(http://stalkeronlinegame.epizy.com/link.png) repeat-x top;">
<p class="net">Украина:</p>
</div>
<br/>
  <p><b><img src="img/ico/money.png" width="12" height="12"/> 3000 RUB = <?php echo "$wmu2k";?> wmu</b><br/></p>
 </center>
</div>
<?php }
if ($type == 8) {?>
  <div class="stats">
  <p class="bonus"><b>Ваши действия:</b></p>
<p class="white">
Всё очень просто: пересылаете необходимую сумму денег на кошелек <span class="bonus">+79282308349</span>, указывая в прикрепленном к переводу сообщении ваш ник или id.<br/>Если хотите ускорить процесс пополнения своего игрового баланса - после перевода сообщите об этом <a class="blue" href="mail4.php?id=10033">главному администратору</a> игры.</p>
</div>
<?php }
?>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>