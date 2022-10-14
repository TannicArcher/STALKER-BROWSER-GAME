<?php
//*******************************************************************//
//**///////////////////////Автор: Андрей Наумов////////////////////**//
//**//////Двиг был написан мною и никаких соавторов не имеется/////**//
//**////////////////////////VK: vk.com/linux8//////////////////////**//
//**/////Устроюсь как на временную, так и на постоянную работу/////**//
//**//////////Знаю: Php, MySQL, CSS, xhtml, photoshop//////////////**//
//**/////Цена договорная, зависит от сложности и объёма работы/////**//
//**///////////////////////////////////////////////////////////////**//
//**////////////Спасибо за использование моего движка//////////////**//
//**/////Буду рад радовать вас новыми и интересными движками///////**//
//*******************************************************************//

require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "reg.php";
  </script>
  <?php
  exit();
}
$page_title = 'Кардан';
require_once('conf/head.php');
require_once('conf/top.php');
//////////////////////////////////////
?>
<div id="main">
  <p class="podmenu">Техник</p>
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Кардан</p>
  <p><img src="img/ico/kardan.png"/></p>
  <div class="stats">
Примечание:</span> <span class="white">В зоне уже давно. Пользуется популярностью у сталкеров, которые улучшают своё снаряжение</span></p>
  <p class="white">Мастер на все руки. Может сделать то, о чём другие только мечтают, причем идеально! Но, у каждого есть минусы. Кардан - алкоголик.</p><br />
  <p>Для улучшения выберите одно из снаряжения и нажмите "улучшить".</p>
  <p><img src="img/ico/point.png" width="12" height="12"/> <a href="clothes.php?id=<?php echo $_SESSION['id'];?>">Снаряжение на мне</a></p>
  <p><img src="img/ico/point.png" width="12" height="12"/> <a href="bag.php">Снаряжение в рюкзаке</a></p>
  <p><img src="img/ico/point.png" width="12" height="12"/> <a href="stash.php">Снаряжение в тайнике</a></p>
  </div>
</div>
<?php

//////////////////////////////////////

require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>