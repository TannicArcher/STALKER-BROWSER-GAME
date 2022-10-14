<script>
function show_hide(id){
var item = document.getElementById(id);
if (item.style.display == 'none') {item.style.display = 'block';}
else item.style.display = 'none';
}
</script>
<script language="JavaScript" type="text/javascript">

                function tag(text1, text2) {

                if ((document.selection)) {

                document.message.msg.focus();

                document.message.document.selection.createRange().text = text1+document.message.document.selection.createRange().text+text2;

                } else if(document.forms['message'].elements['msg'].selectionStart!=undefined) {

                var element = document.forms['message'].elements['msg'];

                var str = element.value;

                var start = element.selectionStart;

                var length = element.selectionEnd - element.selectionStart;

                element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);

				document.forms['message'].elements['msg'].focus();

                } else document.message.msg.value += text1+text2;

				document.forms['message'].elements['msg'].focus();
}
</script>
<div style="background: #303030; opacity: 0.4; filter: alpha(Opacity=40);">
<center>
<a href="javascript:show_hide('block')" style="display: block; opacity: 1;">
<img src="img/smiles/smile.gif" />
</a></center>
</div>
<style type="text/css">
.smile {
min-height: 16px;
}
</style>

<div class="r2" id="block" style="display: none;">
<a href="javascript:tag(':)', '')"><img class="smile" src="img/smiles/smile.gif" /></a> 
<a href="javascript:tag('=)', '')"><img class="smile" src="img/smiles/smile2.gif" /></a> 
<a href="javascript:tag(':(', '')"><img class="smile" src="img/smiles/sad.gif" /></a> 
<a href="javascript:tag(':D', '')"><img class="smile" src="img/smiles/D.gif" /></a>  
<a href="javascript:tag(':плак', '')"><img class="smile" src="img/smiles/cray.gif" /></a>
<a href="javascript:tag(':тост', '')"><img class="smile" src="img/smiles/tost.gif" /></a>
<a href="javascript:tag(':P', '')"><img class="smile" src="img/smiles/09_bebe.gif" /></a>
<a href="javascript:tag(':ржу', '')"><img class="smile" src="img/smiles/rzhu.gif" /></a>
<a href="javascript:tag(':аномалия1', '')"><img class="smile" src="img/smiles/anomaliya.gif" /></a>
<a href="javascript:tag(':аномалия2', '')"><img class="smile" src="img/smiles/9950.gif" /></a>
<a href="javascript:tag(':фан', '')"><img class="smile" src="img/smiles/fan.gif" /></a>
<a href="javascript:tag(':умора', '')"><img class="smile" src="img/smiles/umora.gif" /></a>
<a href="javascript:tag(':раста', '')"><img class="smile" src="img/smiles/rasta.gif" /></a>
<a href="javascript:tag(':фэйспалм', '')"><img class="smile" src="img/smiles/facepalm.gif" /></a>
<a href="javascript:tag(':доволен1', '')"><img class="smile" src="img/smiles/dovolen.gif" /></a> 
<a href="javascript:tag(':доволен2', '')"><img class="smile" src="img/smiles/dovolen2.gif" /></a> 
<a href="javascript:tag(':пират', '')"><img class="smile" src="img/smiles/pirat.gif" /></a>  
<a href="javascript:tag(':олень', '')"><img class="smile" src="img/smiles/olen.gif" /></a>
<a href="javascript:tag(':гитара', '')"><img class="smile" src="img/smiles/gitara.gif" /></a>
<a href="javascript:tag(':ган', '')"><img class="smile" src="img/smiles/gun.gif" /></a>
<a href="javascript:tag(':гг', '')"><img class="smile" src="img/smiles/gg.gif" /></a>
<a href="javascript:tag(':томат', '')"><img class="smile" src="img/tomato.gif"/></a>
<a href="javascript:tag(':*', '')"><img class="smile" src="img/smiles/25_kiss.gif"/></a>
<a href="javascript:tag(':король', '')"><img class="smile" src="img/smiles/korol3.gif"/></a>
<a href="javascript:tag(';)', '')"><img class="smile" src="img/smiles/04_wink.gif"/></a>
<a href="javascript:tag(':летает', '')"><img class="smile" src="img/smiles/letaet.gif" /></a>
<a href="javascript:tag(':жопа', '')"><img class="smile" src="img/smiles/zhopa.gif" /></a> 
<a href="javascript:tag(':испуг', '')"><img class="smile" src="img/smiles/scare.gif" /></a> 
<a href="javascript:tag(':зло', '')"><img class="smile" src="img/smiles/zlo.gif" /></a>  
<a href="javascript:tag(':хмм', '')"><img class="smile" src="img/smiles/xmm.gif" /></a>
<a href="javascript:tag(':хаха', '')"><img class="smile" src="img/smiles/xaxa.gif" /></a>
<a href="javascript:tag(':ого', '')"><img class="smile" src="img/smiles/vau.gif" /></a>
<a href="javascript:tag(':тихо', '')"><img class="smile" src="img/smiles/tiho.gif" /></a>
<a href="javascript:tag(':смерть', '')"><img class="smile" src="img/smiles/smert.gif" /></a>
<a href="javascript:tag(':поиск', '')"><img class="smile" src="img/smiles/poisk.gif" /></a>
<a href="javascript:tag(':накрыло', '')"><img class="smile" src="img/smiles/pizdec.gif" /></a>
<a href="javascript:tag(':оу', '')"><img class="smile" src="img/smiles/oy.gif" /></a>
<a href="javascript:tag(':упс', '')"><img class="smile" src="img/smiles/oops.gif" /></a>
<a href="javascript:tag(':ням', '')"><img class="smile" src="img/smiles/nyam.gif" /></a> 
<a href="javascript:tag(':ноно', '')"><img class="smile" src="img/smiles/nono.gif" /></a> 
<a href="javascript:tag(':нет', '')"><img class="smile" src="img/smiles/no.gif" /></a>  
<a href="javascript:tag(':ниндзя', '')"><img class="smile" src="img/smiles/ninja.gif" /></a>
<a href="javascript:tag(':незнаю', '')"><img class="smile" src="img/smiles/neznaju.gif" /></a>
<a href="javascript:tag(':неа', '')"><img class="smile" src="img/smiles/nea.gif" /></a>
<a href="javascript:tag(':муз', '')"><img class="smile" src="img/smiles/music.gif" /></a>
<a href="javascript:tag(':мистер', '')"><img class="smile" src="img/smiles/mister.gif" /></a>
<a href="javascript:tag(':ламер', '')"><img class="smile" src="img/smiles/lamer.gif" /></a>
<a href="javascript:tag(':кыш', '')"><img class="smile" src="img/smiles/kulak.gif" /></a>
<a href="javascript:tag(':крут', '')"><img class="smile" src="img/smiles/krut.gif" /></a>
<a href="javascript:tag(':супер', '')"><img class="smile" src="img/smiles/klass.gif" /></a>
<a href="javascript:tag(':пока', '')"><img class="smile" src="img/smiles/hello.gif" /></a>
<a href="javascript:tag(':фак', '')"><img class="smile" src="img/smiles/fuck.gif" /></a> 
<a href="javascript:tag(':флуд', '')"><img class="smile" src="img/smiles/flood.gif" /></a> 
<a href="javascript:tag(':фингал', '')"><img class="smile" src="img/smiles/fingal.gif" /></a>  
<a href="javascript:tag(':холодно', '')"><img class="smile" src="img/smiles/cold.gif" /></a>
<a href="javascript:tag(':бомба', '')"><img class="smile" src="img/smiles/bomba.gif" /></a>
<a href="javascript:tag(':блин', '')"><img class="smile" src="img/smiles/blin.gif" /></a>
<a href="javascript:tag(':бан1', '')"><img class="smile" src="img/smiles/ban.gif" /></a>
<a href="javascript:tag(':атлет', '')"><img class="smile" src="img/smiles/atlet.gif" /></a>
<a href="javascript:tag(':ааа', '')"><img class="smile" src="img/smiles/aaa.gif" /></a>
<a href="javascript:tag(':пишу', '')"><img class="smile" src="img/smiles/mail3.gif" /></a>
<a href="javascript:tag(':[', '')"><img class="smile" src="img/smiles/[.gif" /></a>
<a href="javascript:tag(':идиот', '')"><img class="smile" src="img/smiles/crazy.gif" /></a>
<a href="javascript:tag(':качок', '')"><img class="smile" src="img/smiles/bb.gif" /></a>
<a href="javascript:tag(':8', '')"><img class="smile" src="img/smiles/8.gif" /></a>
<a href="javascript:tag(':баян', '')"><img class="smile" src="img/smiles/bajan.gif" /></a>
<a href="javascript:tag(':чмак', '')"><img class="smile" src="img/smiles/chmak.gif" /></a>
<a href="javascript:tag(':чмок2', '')"><img class="smile" src="img/smiles/chmok2.gif" /></a>
<a href="javascript:tag(':влюбви1', '')"><img class="smile" src="img/smiles/inlove1.gif" /></a>
<a href="javascript:tag(':влюбви2', '')"><img class="smile" src="img/smiles/inlove2.gif" /></a>
<a href="javascript:tag(':влюбви3', '')"><img class="smile" src="img/smiles/inlove3.gif" /></a>
<a href="javascript:tag(':письмо1', '')"><img class="smile" src="img/smiles/mail.gif" /></a>
<a href="javascript:tag(':письмо2', '')"><img class="smile" src="img/smiles/mail2.gif" /></a>
<a href="javascript:tag(':нравится', '')"><img class="smile" src="img/smiles/nravitsya.gif" /></a>
<a href="javascript:tag(':сердце', '')"><img class="smile" src="img/smiles/serdce.gif" /></a>
<a href="javascript:tag(':стеснит1', '')"><img class="smile" src="img/smiles/stesnit.gif" /></a>
<a href="javascript:tag(':стеснит2', '')"><img class="smile" src="img/smiles/stesnit2.gif" /></a>
<a href="javascript:tag(':воздп', '')"><img class="smile" src="img/smiles/vozdp.gif" /></a>
<a href="javascript:tag(':бан2', '')"><img class="smile" src="img/smiles/ban2.gif" /></a>
<a href="javascript:tag(':ура2', '')"><img class="smile" src="img/smiles/yahoo.gif" /></a>
<a href="javascript:tag(':стена', '')"><img class="smile" src="img/smiles/wall.gif" /></a>
<a href="javascript:tag(':пиво', '')"><img class="smile" src="img/smiles/drink.gif" /></a>
<a href="javascript:tag(':артефакт', '')"><img class="smile" src="img/smiles/smile_artefact.gif" /></a>
<a href="javascript:tag(':монолит', '')"><img class="smile" src="img/smiles/image.jpg" /></a>
<a href="javascript:tag(':полтергейст', '')"><img class="smile" src="img/smiles/520500.gif" /></a>
<a href="javascript:tag(':контролер', '')"><img class="smile" src="img/smiles/smile_control.gif" /></a>
<a href="javascript:tag(':кровосос', '')"><img class="smile" src="img/smiles/smile_krovosos.gif" /></a>
<a href="javascript:tag(':псевдогигант', '')"><img class="smile" src="img/smiles/smile_pseudogigant.gif" /></a>
<a href="javascript:tag(':снорк', '')"><img class="smile" src="img/smiles/smile_snork.gif" /></a>
</div>