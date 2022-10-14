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
$page_title = 'Сайт продаётся';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
?>
<div id="main">
<center><p class="podmenu">Сайт продаётся</p></center>
 <div style="border:dashed #990000 1px;
padding-left: 6px;
padding-bottom: 6px;
padding-top: 6px;">
<div style="background-color:#990000;
padding-top: 1px;
padding-bottom: 1px;
margin-right: 5px;
padding-left: 3px;
padding-top:6px;
padding-bottom: 6px;
margin-bottom: 5px;
color:#FFFFFF">
  <p><center><b>Уважаемые пользователи!</b></center></p>
  <p><b>- Нашему ресурсу нужна новая администрация, которая будет заниматься игрой.</b></p>
  <p><b>- Цена договорная. Все торги происходят <a href="http://vk.com/nations11">здесь</a>.</b></p>
  <p><b>- Если вы даже представления не имеете как это работает, то лучше даже не писать.</b></p>
  <p><b>- В продажу включено: сайт, хостинг, домен, <a href="http://sinned.sfrpg.keo.su/">вторая игра</a></b></p>
  </div>
  </div>
<?php
require_once('conf/navig.php');
require_once('conf/foot.php');
?>
</body>
</html>