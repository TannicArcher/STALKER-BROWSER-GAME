<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Сталкер Онлайн';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
//////////////////////////////////////
$help = $_GET['help'];
if (empty($help)) { 
?>
<div id="main">
<div class="stats">
  <p class="podmenu">Помощь</p>
</div>
<div class="stats">
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="help.php?help=game">Об игре</a></p>
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="texpod.php">Список модераторов</a></p>
<br />
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="help.php?help=fight">Сражение</a></p>
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="help.php?help=salesman">Торговля</a></p>
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="help.php?help=company">Отряды</a></p>
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="help.php?help=clothes">Снаряжение</a></p>
</br>
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="help.php?help=forum">Общение</a></p>
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="atg.php">Описание игры</a></p>
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="rules.php">Правила</a></p>
<p><img src="img/ico/point.png"  alt=""width="12" height="12"/> <a class="white" href="accept.php">Соглашение</a></p>
</div>
</div>
<?php
}
if (!empty($help) and $help <> 'game' and $help <> 'fight' and $help <> 'salesman' and $help <> 'company' and $help <> 'clothes' and $help <> 'forum' and $help <> 'bitva') {
  require_once('conf/notfound.php');
}
else {
  if ($help == 'bitva') {?>
  <div id="main">
  <div class="stats">
  <p class="podmenu">Ошибка</p>
  </div>
  <div class="stats"> 
<p class="red">Произошла ошибка при нападении на другой отряд.</p>
<p class="bonus">Возможные причины:</p>
<li class="white">В составе вашего отряда меньше 10 человек.</li>
<li class="white">В складе вашего отряда меньше 100000 хабара</li>
<li class="white">В составе вражеского отряда меньше 10 человек.</li>
<li class="white">Ваш отряд отдыхает после прошлой битвы (стандартная пауза между битвами - 5 часов).</li>
<li class="white">Вражеский отряд отдыхает после прошлой битвы.</li>
<li class="white">Ваше звание (в отряде) ниже генерала.</li>
<li class="white">Вражеский отряд уже ведет перестрелку с другим отрядом.</li>
<li class="white">Слава вашего отряда меньше славы вражеского отряда больше, чем в 2 раза.</li>
<li class="white">Слава вашего отряда больше славы вражеского отряда больше, чем в 2 раза.</li>
<li class="white">Вы пытаетесь напасть на собственный отряд.</li>
  </div>
<?php }
  if ($help == 'game') {
  ?>
  <div id="main">
  <div class="stats">
  <p class="podmenu">Об Игре</p>
  </div>
  <div class="stats"> 
  <p><span class="white"><b>S.T.A.L.K.E.R</b></span> - это онлайн игра (MMORPG) нового поколения для мобильных телефонов, посвященная книгам о мире S.T.A.L.K.E.R. и самой игре на PC - S.T.A.L.K.E.R. Call Of Pripyat.</p><br />
  <p>Уникальная система боя и массовые сражения ждут тебя</p><br />
  <p>Непрерывная война между тремя сторонами (Долг, Свобода, Одиночки) за контроль над территориями. Захваты блокпостов, нападения на монстров с надежными друзьями и соклановцами, которые никогда не оставят в беде.</p><br />
  <p>Поначалу происходящее может показаться необычным, но <b>не спешите бросать игру в самом начале</b>. Поиграйте несколько дней, разберитесь в происходящем, <b>и вы не пожалеете</b>, открыв для себя отличное развлечение на много месяцев вперед.</p><br />
  <p>В игре минимум графики и легкие странички <b>для экономии вашего трафика</b>!</p><br />
  <p><b>Играть можно совершенно бесплатно!</b></p><br />
  <p><b>Уже давно о Сталкерах ходят легенды, теперь легендой может стать каждый!</b></p>
  </div>
  <?php
  }
  if ($help == 'fight') {
  ?>
  <div id="main">
  <p class="podmenu">Сражения</p>
  <div class="stats"> 
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Зона</p>
  <div class="white">
  <p>В зоне идёт бой за контроль над локациями. Цель – захватить и удерживать как можно больше блокпостов.</p><br />
  <div class="stats">
  <p>Интерфейс простой:</p>
  <p><span class="bonus">1. </span><img src="img/ico/life.png" alt="h" width="12" height="12"/>826  <img src="img/ico/pistol.png" alt="p" width="12" height="12"/>0  <img src="img/ico/weapon.png" alt="w" width="36" height="12"/>-- <img src="img/ico/goodrad.png" alt="r" width="12" height="12"/>0</p>
  <p><span class="bonus">2. </span><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/> <b>Затон, скадовск</b></p>
  <p><span class="bonus">3.</span> <img src="img/ico/bp.png" width="12" height="12" alt="s"/> 7206/10000</p>
  <p><span class="bonus">4.</span> <img src="img/ico/odinochki.png" width="12" height="12" alt="o"/> 24 <img src="img/ico/dolg.png" width="12" height="12" alt="d" /> 17 <img src="img/ico/svoboda.png" width="12" height="12" alt="s"/> 21</p>
  </div><br />
   <p><span class="bonus">1. </span><img src="img/ico/life.png" alt="h" width="12" height="12"/>826  <img src="img/ico/pistol.png" alt="p" width="12" height="12"/>0  <img src="img/ico/weapon.png" alt="w" width="36" height="12"/>-- <img src="img/ico/goodrad.png" alt="r" width="12" height="12"/>0</p>
   <p> В этой строке указаны Ваше здоровье, количество секунд, которое осталось до окончания перезарядки вашего пистолета. Показывается, что автомат не одет. А также уровень облучения.</p><br />
  <p><span class="bonus">2. </span><img src="img/ico/dolgon.png" width="12" height="12" alt="s"/> <b>Затон, скадовск</b></p>
  <p>В этой строке указано название локации и подлокации, в которой вы находитесь. Перед названием стоит цветная иконка с изображением герба группировки. Чей герб изображён, тому и принадлежит блокпост (данная подлокация)</p><br />
  <p><span class="bonus">3.</span> <img src="img/ico/bp.png" width="12" height="12" alt="s"/> 7206/10000</p>
  <p>В этой строке показывается состояние счетчика общего участия. Любые действия в этой локации ваших союзников и врагов увеличивают этот счетчик. Как только счетчик достигнет максимума, выпадает награда в хабаре.</p><br />
  <p>Награду получит игрок, чья активность окажется самой высокой среди всех, кто находится в этот момент в данной подлокации. После получения награды его личная активность будет уменьшена вдвое.</p><br />
  <p><span class="bonus">4.</span> <img src="img/ico/odinochki.png" width="12" height="12" alt="o"/> 24 <img src="img/ico/dolg.png" width="12" height="12" alt="d" /> 17 <img src="img/ico/svoboda.png" width="12" height="12" alt="s"/> 21</p>
  <p>В этой строке указано количество игроков с разных сторон в локации.<p><br />
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Арена</p>
  <p>Извините, на данный момент Арена ещё не запущена</p>
  <?php
  }
  if ($help == 'salesman') {
  ?>
  <div id="main">
  <p class="podmenu">Торговля</p>
  <p class="bonus"><b>Торговля</b> - это места, в которых ты можешь продать, купить, улучшить или обменять свои вещи.</p>
  <div class="stats"> 
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Аукцион</p>
  <div class="white">
  <p><a href="http://stalkeronlinegame.epizy.com/auction.php">Аукцион</a> - выгодный способ покупки и продажи товаров. Продать/купить снаряжение на аукционе можно только за игровые RUB. Даже если вы купили за хабар, к примеру, обрез, продать его за такую же валюту (в данном случае - хабар) не предоставляется возможным. Покупка снаряжения через аукцион экономит ваш хабар, но бьет по карману, в принципе, курс <a href="payment.php?type=2">покупки RUB</a> на нашем сайте очень выгоден.</p>
  </div>
   <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Торговцы</p>
  <div class="white">
  <p><a href="http://stalkeronlinegame.epizy.com/salesman.php">Сыч</a>. Продаёт снаряжение. Отличается от аукционов тем, что вы покупаете у торгаша по установленной цене.</p>
  </div>
  </div>
  <?php
  }
  if ($help == 'company') {
  ?>
  <div id="main">
  <p class="podmenu">Отряды</p>
  <div class="white">
  <p class="bonus">У отряда есть уровень, чем выше уровень, тем больше возможностей у отряда.</p>
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Опыт отряда</p>
  <p>Участие отряда зарабатывается всеми членами отряда в бою - атаками. Чем больше опыт отряда, тем выше его уровень. Если в отряде есть "мертвые души", то они своим присутствием притормаживают прокачку. Еще проще говоря: чем больше людей в отряде, тем быстрее он растет, но тупо набирать народ невыгодно - слишком большое количество халявщиков будет постепенно снижать эффективность прокачки.<br />
 Если игрок выходит из отряда и вступает в новый или возвращается назад, его личное участие в отряде обнуляется, но сам отряд опыт не теряет.</p>
 <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Звания </p>
  <p>В отряде имеются такие звания:</p>
  <p> <img src="img/rangs/lideron.png" width="12" height="12" alt="л"/> Лидер - основатель отряда. Имеет право исключать из отряда любого члена, повышать и понижать в звании любого члена отряда, имеет доступ на все разделы форума отряда.</p>
  <p> <img src="img/rangs/generalon.png" width="12" height="12" alt="г"/> Генерал - имеют право исключать из отряда нижестоящих членов, повышать и понижать в звании нижестоящих членов отряда </p>
  <p> <img src="img/rangs/polkovnikon.png" width="12" height="12" alt="п"/> Полковник - имеют право исключать из отряда нижестоящих членов, повышать и понижать в звании нижестоящих членов отряда </p>
  <p> <img src="img/rangs/mayoron.png" width="12" height="12" alt="м"/> Майор - имеют право исключать из отряда нижестоящих членов, повышать и понижать в звании нижестоящих членов отряда </p>
  <p> <img src="img/rangs/kapitanon.png" width="12" height="12" alt="к"/> Капитан - заслуженные члены отряда.  </p>
  <p> <img src="img/rangs/leitenanton.png" width="12" height="12" alt="л"/> Лейтенант - проверенные, но не совсем показавшие свою преданность отряду.  </p>
  <p> <img src="img/rangs/serjanton.png" width="12" height="12" alt="с"/> Сержант - не проверенные люди.  </p>
  <p> <img src="img/rangs/ryadovoyon.png" width="12" height="12"alt="р"/> Рядовой - рядовой член отряда.  </p>
  <p> <img src="img/rangs/rekryton.png" width="12" height="12" alt="н"/> Рекрут - рекрут отряда. </p>
  </div>
  <?php
  }
  if ($help == 'clothes') {?>
  <div id="main">
  <div class="stats">
  <p class="podmenu">Снаряжение</p>
  </div>
  <div class="white">
  <p>В нашей игре представлено практически всё оружие и снаряжение из официальной компьютерной игры под названием STALKER.</p>
  <p>Всего существует три слота (типа) снаряжения. Это костюм, пистолет и автомат.</p>
  <p>Каждое снаряжение вы можете подобрать себе по вкусу. Всё зависит от вас.</p>
  <p>Вы можете улучшить любое снаряжение у мастера.</p>
  </div>
  <?php
  }
  if ($help == 'forum') {?>
  <div id="main">
  <div class="stats">
  <p class="podmenu">Общение</p>
  </div>
  <div class="white">
  <p>Администрация игры, помимо увлекательной игры, предоставляет вам возможность общаться со своими единомышленниками</p>
  <p>Для этого существует <a href="forum.php?type=main">форум</a>, <a href="mailbox.php">почта</a> и форум отряда</p>
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Форум</p>
  <p>На форуме могут писать только те игроки, которые достигли 10 уровня.</p>
  <p>Также, мы настоятельно рекомендуем ознакомиться с <a href="rules.php">правилами</a>, действующими на форуме.</p>
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Почта</p>
  <p>Каждому игроку предоставлена личная почта, с помощью которой он может связаться с администрацией или другими игроками.</p>
  <p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;">Форум отряда</p>
  <p>Форум отряда ничем не отличается от обычного форума за исключением того, за ним смотрят только администрация клана.</p>
  <p>Возможно присвоение уровня для просмотра.</p>
  </div>
  <?php
  }
  if (!empty($help)) {
  ?>
  </br>
  <p><img src="img/ico/left.png"  alt=""width="12" height="12"/> <a href="help.php">Помощь</a></p>
  </br>
  <?php
  }
  ?>
  </div>
  <?php
} 



//////////////////////////////////////

if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/navig.php');
}
require_once('conf/foot.php');
?>
</body>
</html>