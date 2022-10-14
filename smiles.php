<?
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
$page_title = 'Смайлы';
require_once('conf/head.php');
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/top.php');
}
$h=getenv("HTTP_REFERER");
?>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<img src="img/reload.gif" width="12" height="12"/> <a href="<?php echo "$h" ; ?>">Назад</a>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
:тост => <img src="img/smiles/tost.gif" /><br/>
 :P => <img src="img/smiles/09_bebe.gif" /><br/>
:ржу => <img src="img/smiles/rzhu.gif" /><br/>
:аномалия => <img src="img/smiles/anomaliya.gif" /><br/>
:фан => <img src="img/smiles/fan.gif" /><br/>
:умора => <img src="img/smiles/umora.gif" /><br/>
:раста => <img src="img/smiles/rasta.gif" /><br/>
:фэйспалм => <img src="img/smiles/facepalm.gif" /><br/>
:доволен => <img src="img/smiles/dovolen.gif" /><br/>
 :доволен2 => <img src="img/smiles/dovolen2.gif" /><br/>
 :пират => <img src="img/smiles/pirat.gif" /><br/>
 :олень => <img src="img/smiles/olen.gif" /> <br/>
:) => <img src="img/smiles/smile.gif" /></br>
 :( => <img src="img/smiles/sad.gif" /></br>
 :D => <img src="img/smiles/D.gif" /></br>
 :гитара => <img src="img/smiles/gitara.gif" /></br>
 :ган => <img src="img/smiles/gun.gif" /></br>
 :гг => <img src="img/smiles/gg.gif" /></br>
 :томат => <img src="img/tomato.gif"/><br />
 :* => <img src="img/smiles/25_kiss.gif"/><br />
 :король => <img src="img/smiles/korol3.gif"/><br />
 ;) => <img src="img/smiles/04_wink.gif"/><br />
 :летает => <img src="img/smiles/letaet.gif" /></br>
 :жопа => <img src="img/smiles/zhopa.gif" /></br>
 :аааа или :испуг => <img src="img/smiles/scare.gif" /></br>
 :'( => <img src="img/smiles/cray.gif" /></br>
 :зло => <img src="img/smiles/zlo.gif" /></br>
 :хмм =><img src="img/smiles/xmm.gif" /></br>
 :хаха => <img src="img/smiles/xaxa.gif" /></br>
 :ого => <img src="img/smiles/vau.gif" /></br>
 :тихо => <img src="img/smiles/tiho.gif" /></br>
 :смерть => <img src="img/smiles/smert.gif" /></br>
 :поиск => <img src="img/smiles/poisk.gif" /></br>
 :накрыло => <img src="img/smiles/pizdec.gif" /></br>
 :оу => <img src="img/smiles/oy.gif" /></br>
 :упс => <img src="img/smiles/oops.gif" /></br>
 :ням => <img src="img/smiles/nyam.gif" /></br>
 :ноно => <img src="img/smiles/nono.gif" /></br>
 :нет => <img src="img/smiles/no.gif" /></br>
 :ниндзя => <img src="img/smiles/ninja.gif" /></br>
 :незнаю => <img src="img/smiles/neznaju.gif" /></br>
 :неа => <img src="img/smiles/nea.gif" /></br>
 :муз => <img src="img/smiles/music.gif" /></br>
 :мистер => <img src="img/smiles/mister.gif" /></br>
 :ламер => <img src="img/smiles/lamer.gif" /></br>
 :кыш => <img src="img/smiles/kulak.gif" /></br>
 :крут => <img src="img/smiles/krut.gif" /></br>
 :кул или :супер => <img src="img/smiles/klass.gif" /></br>
 :пока => <img src="img/smiles/hello.gif" /></br>
 :фак => <img src="img/smiles/fuck.gif" /></br>
 :флуд => <img src="img/smiles/flood.gif" /></br>
 :фингал => <img src="img/smiles/fingal.gif" /></br>
 :холодно => <img src="img/smiles/cold.gif" /></br>
 :бомба => <img src="img/smiles/bomba.gif" /></br>
 :блин => <img src="img/smiles/blin.gif" /></br>
 :бан => <img src="img/smiles/ban.gif" /></br>
 :атлет => <img src="img/smiles/atlet.gif" /></br>
 :ааа => <img src="img/smiles/aaa.gif" /></br>
 :пишу => <img src="img/smiles/mail.gif" /></br>
 :[ => <img src="img/smiles/[.gif" /></br>
 :идиот => <img src="img/smiles/crazy.gif" /></br>
 :качок => <img src="img/smiles/bb.gif" /></br>
 :8 => <img src="img/smiles/8.gif" />
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>
<?
require_once('conf/navig.php');
require_once('conf/foot.php'); 
?>