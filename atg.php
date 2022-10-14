<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'S.F.R.P.G. игра на мобильный';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
//////////////////////////////////////
?>
<div class='rules1'>
<div id="main">
<div class="stats">
  <p class="podmenu">Об игре</p>
</div>

<div class="stalker_link" style="font-size: 13px">
<p>Сталкер Онлайн - это проект, посвященный книгам о мире S.T.A.L.K.E.R., а так же самой игре на PC - S.T.A.L.K.E.R. Call Of Pripyat.</p>
<br/>
<p>Наша задумка, которую мы хотим воплотить - это возможность людям, которые, не имея доступа к компьютеру/ноутбуку или же по другой причине, не могут окунуться в мир Сталкера на PC. А так же как-то продолжить познание этого фантастического мира для фанатов игры.</p>
<br/>
<p>Скучно на работе/учебе? Проведи время среди своих собратьев-сталкеров!<br/>
Помоги уничтожить Зону - вступи в "Долг"! Или ты сторонник другого мнения о происходящем? Сделай выбор сам: создай отряд, позови туда своих друзей, и вместе идите к своей цели!</p>
<br/>
<p>Мы постарались максимально разнообразить игровой процесс чтобы вы никогда не скучали ;)</p>
<br/>
<p>Надеюсь, что вам у нас понравится!</p>
</br>
</div>
</div>
</div>

<?php



//////////////////////////////////////

if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/navig.php');
}
require_once('conf/foot.php');
?>
</body>
</html>