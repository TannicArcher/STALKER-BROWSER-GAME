<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "../reg.php";
  </script>
  <?php
  exit();
}
$page_title = 'Заполнение анкеты';
require_once('conf/head.php');
require_once('conf/top.php');


  $str = "'pay''.$user_top.''rvX2AFwf4Nttj4nr'";
  $md5 = md5($str);
?>


<div class="ms-fon">
<div class="stats">
  <center><p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Пополнение баланса</p></center>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        function calculateBonuses() {
            var coinPrice = parseFloat($('#unitpayForm #coinPrice').val());
            var coins = parseInt($('#unitpayForm #coins').val());
            if (isNaN(coins) || isNaN(coinPrice) || coins <= 0) {
                $('#unitpayForm #sum').val('');
                return;
            }
            var price = ((coins * coinPrice) / '1000');
            if (price > 1500000) {
                price = 1500000;
            }
            $('#unitpayForm #sum').val(price);
        }
        $('#unitpayForm input#coins').keyup(function () {
            calculateBonuses();
        });
        calculateBonuses();
        $('#unitpayForm').submit(function(){
            var sum = parseFloat($('#unitpayForm #sum').val());
            if (isNaN(sum) || sum < 10 || sum > 15000) {
                alert('Неверная сумма платежа');
                return false;
            }
        });
    });
</script>
 <center>
<div class="r4">Стоимость<br/>
 1000 RUB: 5 рублей (Россия).<br/>
 Стоимость для остальных стран зависит от курса валют.<br/>
 Точная стоимость будет указана после выбора суммы.</div><br/>
</div>
<center>
<div style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/bg.jpg) repeat;">
<h3><p class="white">Любое число:</p></h1>
</div>
<div class="bg_wave">
<form id="unitpayForm" action="https://unitpay.ru/pay/5659-c86d9" method="post">
    <label for="account">ID персонажа:</label><br/>
<input type="text" value="<?php echo "$user_top";?>" name="account" required="required" id="account" style="width: 90%;"><br/>
    <label for="coins">Количество RUB:</label><br/>
    <input type="text" id="coins" name="coins" value="3000" required="required" style="width: 90%;"><br/>
    <input type="hidden" id="sum" name="sum" value="">
    <input type="hidden" id="coinPrice" name="coinPrice" value="5">
    <input type="hidden" name="desc" value="Покупка RUB в Сталкер Онлайн">
    <input type="submit" class="btn" value="Оплатить" style="width: 30%;">
</form><br/>
</div>
<div style="background:#000001 url(http://stalkeronlinegame.epizy.com/img/bg.jpg) repeat;">
<h3><p class="white">Число по выбору:</p></h1>
</div>
<div class="bg_wave">

<form action="https://unitpay.ru/pay/5659-c86d9" method="post">
    <label for="account">ID персонажа:</label> <br/>
    <input type="text" id="account" name="account" value="<?php echo "$user_top";?>" style="width: 90%;"><br>
    <label for="sum">Количество RUB:</label><br/>
    <select id="sum" name="sum" style="width: 90%;">
        <option value="10">2000 RUB</option>
        <option value="25">5000 RUB</option>
        <option value="50">10000 RUB</option>
        <option value="75">15000 RUB</option>
        <option value="125">25000 RUB</option>
        <option value="250">50000 RUB</option>
        <option value="500">100000 RUB</option>
        <option value="750">150000 RUB</option>
        <option value="1250">250000 RUB</option>
        <option value="2500">500000 RUB</option>
    </select><br>
    <input type="hidden" name="desc" value="Покупка RUB в Сталкер Онлайн">
    <input class="btn" type="submit" value="Оплатить" style="width: 30%;">
</form><br/>
</div>
</center>
</div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>