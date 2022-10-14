<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
require_once('conf/ban.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
?>
<script type="text/javascript">
  document.location.href = "reg.php?err_login=1";
</script>
<?php
};
$page_title = 'С Новым Годом!';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">

<?php
  echo '<title>' . $page_title . '</title>';
?>

<link type="text/css" rel="stylesheet" href="style/main.css" />
</head>
<body>
<?php
$user_id = $_SESSION['id'];
$query4 = "Select * from users where id='$user_id' limit 1";
$result4 = mysqli_query($dbc, $query4) or die ('Ошибка передачи запроса к БД');
$row4 = mysqli_fetch_array($result4);
$query = "update users set ny = '1' where id = '$user_id' limit 1";
$result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД');
?>
<div class="regf" style="border:1px solid #909090;border-top:1px solid #fff;border-bottom:1px solid #fff; border-radius: 8px;">
<div id="main">
<div class="stats">
<img src="img/ico/newyear.jpg" width="100%" height="200px" alt="С новым годом!"/>
</div>
<small><p class="lal" style="color: DeepSkyBlue; margin-left: 3px;">
Вот казалось бы… Чернобыльская Зона – Богом забытое гиблое место, в котором помимо местной флоры и фауны обитает лишь кучка свихнувшихся психов, желающих нажиться на местных богатствах. Психи эти именуют себя сталкерами. Так вот. Казалось бы, что эти глупые, бросившие обычный мир люди, могут чувствовать? Вроде бы и ничего. Да не так это. Лучше всего бравая душа этих парней раскрывается на праздниках.  Хотя нет. Вернее будет сказать не так. Душа их раскрывается в канун праздника. Наша маленькая зарисовочка полностью посвящена подготовке к одному из самых веселых праздников – к Новому году. И так… Поехали!!!<br/>
Сейчас надо просто представить Бар «100 Рентген» 31 декабря. Обычные подранные стены заклеиваются различными плакатами и «художественными произведениями» самих посетителей. Везде все чистится и убирается. На кухне тридцать три китайца-свободовца готовит еду. Члены различных группировок сносят свои «дары» к праздничному столу. Долговцы притаранили несколько ящиков с водкой и пивом, свободовцы…. Думаю не надо уточнять, что именно они принесли, сталкеры и чистонебовцы настреляли дичи, которая пошла к китайцам, монолитовцы…… Ну эти просто пообещали никого не убивать «во имя Монолита» и пришли нажраться. Бандитов разумеется никто не звал. Ибо как сказал Коряга: «Спи*дят все! Вплоть до ширинки на трусах». Сидор с Барменом уже примерно подсчитывают убытки от погрома. Но где же главная достопримечательность праздника? Где же елка?<br/>
- Значит так, бездельники... –вступил со своим словом Меченый - на елку в этом году денег нет... Поэтому будем без нее…<br/>
-Как это без нее???? – загудело сталкерское сообщество. –Нельзя без елочки! Ты у нас легенда, или кто????<br/>
- Легенда, мать вашу...- недовольно проворчал Шрам.<br/>
-Ну я то легенда, но….. –Меченый попытался культурно отмазаться от похода за елкой.<br/>
-Вот и чеши! – довольно улыбаясь и потягивая кофе из чашки крикнул Дегтярев. Меченый попытался что-то возразить, но взглянув в глаза братьев сталкеров решил не спорить и угрюмо наклонив лицо пошел восвояси… То есть в лес за елкой.<br/>
В зале снова начался галдежь. Работа над украшением бара кипела. Внезапно послышался голос Болотного Доктора.<br/>
-Зулус, твою мать!!! Харе водку казенную жрать. И не волнует меня, что она ваша, долговская. Хватит, я сказал, и все! Сходи лучше в подвал и принеси еще елочных игрушек. А то эти Кардан с Азотом расфигарили. Они пытались с них спутниковый приемник для ПДА сделать, но что-то ни хера у них не вышло. – доктор тяжело вздохнул.<br/>
-Короче, поднимай задницу и дуй в подвал. Я все сказал.<br/>
Зулус кое-как поднялся со своего места. Сразу послышался звон пустых бутылок, которыми он был обложен, пока сидел на одном месте неизвестно сколько. Долговец сделал один неуверенный шаг. Все в зале перестали трындеть и с замиранием сердца следили за чудным передвижением этого алкоголика. Даже барыги оторвались от своих подсчетов и уставились на Зулуса. Все надеялись на чудо… На то, что хоть раз этот алкаш нормально пройдет. Но нет. Чуда не случилось. На третьем шаге наш горе боец умудрился наступить на пустую бутылку и, поехав на ней, с размаху грохнуться на пол. Сначала в зале была гробовая тишина, а потом Бар взорвало. Все сталкеры смеялись как сумасшедшие. Ну, или почти все. Лидер пьяной группы монолитовцев рассказывал свободовцам о том, что какой-то… эмн… «мужчина нетрадиционной ориентации с крылышками» умудрился отключить их «гениальное! Просто гениальное! Вековое!» изобретение. Свободовец с явно накуренным видом слушал все это, а потом предложил о стрелке разузнать у Меченого.<br/>
-Говорят, этот парень шарит много…<br/>
-Да? –икнул монолитовец. –Серьезно? Ну я спрошу…. А пока. Дай затянуться – фанатик расплылся в лыбе.<br/>
Ну да ладно. Вернемся к бедному Зулусу, который кряхтя от боли пытался встать с пола. <br/>
-Зулус! – снова крикнул Доктор. <br/>
-Доктор…. – так и лежа на полу говорил долговец –я не пойду. Я в прошлый раз уже сходил по вашей просьбе. Спасибо. Надолго хватило.<br/>
-Да? – Доктор улыбнулся – и чего же тебе хватило? Расскажешь народу?<br/>
Зулус, шепча маты сквозь обнажённые в голивудской улыбке зубы, отчаянно пытался подняться с пола. И, о чудо! У него это вышло. Далее последовало не менее интересное зрелище. Представьте это.. В хлам  пьяный человек пытается что-то достать из кармана облегающих штанов. Прикольно, да? Вот так это и было. Зулус кряхтя от волнения пытался достать из кармана ЧТО-ТО. Это ЧТО-ТО было большим, угловатым и, судя по всему - живым. И вот долговец наконец-то достал вожделенный предмет из своего кармана. Это оказался всего лишь ПДА. Только нестандартный какой-то, увеличенный. На корпусе мелькнул голубоватый глазок высококачественной камеры. <br/>
В общем-то это и была камера. Однажды вместо вот такого вот ПДА ему подсунули обычный фотик "мыльницу". Чёрный его подери, какой мат стоял, пробегающий мимо снорк, аж поворот пропустил заслушавшись. Помнится, собаки это тело от стены долго отдирали... <br/>
- Это, - долговец торжественно поднял компьютер высоко над головой, уподобляясь гладиатору, поднимающему голову поверженного противника. Лицо светилось торжеством победы. Видимо, достать эту болванку из кармана было ещё сложнее чем казалось, - документальное кино. Называется " Как Зулус за полтергейстами в подвал ходил". <br/>
-ну-ка давай посмотрим. – к Зулусу подбежал один из наемников тут работающих и выхватив ПДА куда-то его унес. Зал озарился тремя десятками широких улыбок, на застывших в ожидании лицах. <br/>
-Ну что ж, поглядим, чего там Зулус наснимал. – долетело до сталкера из зала. Вскоре, с громким гулом, сделавшим бы честь и трансформаторной будке, потухли прожектора. Экран на одной из стен засветился, отражая луч проектора. "Кино", мать его, оказалось семисекундным роликом, по окончанию которого лица посетителей вытянулись до неузнаваемости. Кажется, никто не рассчитывал увидеть, а тем более - услышать такой бред. Но эти семь секунд, пожалуй, стоит описать. <br/>
Первая секунда. Дикий вопль, дрожащие руки посылают нелестные сигналы в темноту какого-то подвала, из которой доносятся какие-то завывания в стиле пресловутых частушек Кабана.<br/>
Вторая секунда. Дрожащее изображение не позволяет рассмотреть вообще ничего.<br/>
Третья секунда. Вторая часть бестселлера "Секунда №2".<br/>
Четвёртая секунда. В фокусе появился какой-то ящик.<br/>
Пятая секунда. Ящик никак не хочет поддаваться дрожащим рукам, упорно пытаясь удержать крышку на месте.<br/>
Шестая секунда. Силы оказались неравными, и ящик с треском сдал позиции.<br/>
Седьмая секунда. Самая, пожалуй, насыщенная. Среди пыли и громкого ...эммм, вопля, отчётливо мелькнуло содержимое ящика: чёрные провода с какими-то блестящими наростами. Да это же... Кровосос его дери, что в Зоне делают светящиеся гирлянды?! <br/>
Вопли на заднем плане окончательно доконали бедолагу и ПДА отрубился.<br/>
Зрители сначала ничего не поняли. Вытянутые от кучи смешанных чувств лица как одно повернулись в сторону изрядно струхнувшего от такого единодушия Зулуса, требуя пояснений. Долговец, обливаясь потом, кивнул бармену, и изображение последнего кадра из ролика сменилось красочным фото. Так вот зачем он этот ролик показал... Бар взорвался волной смеха. На фото был изображён наш знакомый Зулус. Но не просто Зулус, а Зулус светящийся. Гирлянды, намотанные вокруг всего тела, создавали весьма эффектную картину, работая от карманного аккумулятора, и разноцветные огоньки разрывали послезакатные сумерки, освещая бетонную стену, за которую держался согнувшийся пополам контролёр. Долговец стоял спиной, но не было никаких сомнений насчёт его состояния - тихий в трезвости Зулус стал зомби. А рядом стоял такой же зомби, но раза в два выше и раза в четыре шире... Кабан?! Как потом рассказал Болотный Доктор, перед смертью Кабан взлетел над кронами деревьев Рыжего Леса и, с грацией пингвина и скоростью штурмовика, ринулся покорять сначала воздушное, а затем и водное пространство Зоны, приземлившись на берегу Припяти. Там его и нашёл контролёр, попытавшийся когда-то взять под контроль накуренного в хлам свободовца. Стоит ли говорить, что полтергейста в подвале не было? Вместо него в подвале сидел контролёр-приколист с весьма своеобразным чувством юмора, заставившим Зулуса нарядится новогодней ёлочкой.<br/>
Долговец хотел было что-то сказать, но тут раздался тихий хруст кожуры и на весь бар запахло праздником. Клин, сталкер с отличным ночным зрением, медленно повернулся в сторону барной стойки и медленно так, задумчиво, протянул:<br/>
- Мандарины...<br/>
Все прожекторы резко направились на бармена и осветили этого прожору. Послышался сердитый треск и громкий хлопок, посыпались искры и всех вокруг обрызгало горячим пластиком. Возмущённо-восторженный вопль потряс стены бара, перепуганный бармен рванул к выходу, по дороге задев рубильник. Свет врезался в глаза с силой боксёрского хука, заставив толпу недовольно взреветь. На стойке, ничуть не стесняясь того, что здесь вообще-то Зона, лежал ящик мандарин.<br/>
Драка за ящик была эпична: летели столы, стулья, тела зазевавшихся сталкеров, кулаки крушили челюсти, мелькали ноги особо ловких бойцов, черепа с треском встречались друг с другом, качалась лампа на потолке, шатались стены, трясся потолок... В конце концов, ящик разделили поровну, достали из кладовки сбежавшего бармена два ящика шампанского, и, впервые за два десятка лет существования Зоны, в ней почти цивилизовано отпраздновали Новый Год на развалинах того, что ещё час назад было баром... <br/>
Уже где-то в половине третьего, когда не спали в пьяном бреду лишь самые крепкие ребята, в зал влетел Меченый.<br/>
-Ребята! Ребята! – не мог толком отдышаться он…. –я нам елку принес!<br/>
-опоздал ты немного, Меченый.. –натужно проговорил Сидорович, сидящий на обломках стола с бутылкой водки и мандаринкой. Меченый как ребенок надул губы и обиженным таким тоном произнес…<br/>
-вот сюки…. А водки хоть оставили? Что я, зря два часа руками махал?<br/>
-а чего ты хоть руками махал?<br/>
-ну так я это… топора не нашел… Вот и пришлось рубить чем было.<br/>
-Ну хорошо.. Иди сюда. Есть еще водка для тебя. И мандаринки есть.<br/>
Меченый подошел к Сидоровичу, сел рядом с ним, взял из рук торгаша бутылку, открыл и отпил немного с горла.<br/>
-все-таки еще более-менее культурно погуляли. Это все из-за того, что без меня.<br/>
-ну это да – Сидорович взял одну дольку мандаринки в рот – прошлый раз ты на спор пытался самогонный аппарат Бармена починить, так обломки крыши до сих пор на Радаре находят. Убытков побольше было.<br/>
-ну я же не виноват – снова обиделся Меченый.<br/>
-Не виноват… Елку куда дел то? Сейчас ставить будем!..<br/>
Красиво украшенная гирляндами елка «радовала глаз» сталкеров всю ночь..<br/><br/>
<font color="#ffffff">В</font> <font color="#fffbfb">ч</font><font color="#fff6f6">е</font><font color="#fff2f2">с</font><font color="#ffeeee">т</font><font color="#ffe9e9">ь</font> <font color="#ffe5e5">Н</font><font color="#ffe0e0">о</font><font color="#ffdcdc">в</font><font color="#ffd8d8">о</font><font color="#ffd3d3">г</font><font color="#ffcfcf">о</font> <font color="#ffcbcb">г</font><font color="#ffc6c6">о</font><font color="#ffc2c2">д</font><font color="#ffbebe">а</font> <font color="#ffb9b9">в</font> <font color="#ffb5b5">и</font><font color="#ffb0b0">г</font><font color="#ffacac">р</font><font color="#ffa8a8">у</font> <font color="#ffa3a3">б</font><font color="#ff9f9f">ы</font><font color="#ffa39f">л</font><font color="#ffa79f">о</font> <font color="#ffac9f">д</font><font color="#ffb09f">о</font><font color="#ffb49f">б</font><font color="#ffb89f">а</font><font color="#ffbc9f">в</font><font color="#ffc09f">л</font><font color="#ffc59f">е</font><font color="#ffc99f">н</font><font color="#ffcd9f">о</font> <font color="#ffd19f">н</font><font color="#ffd59f">е</font><font color="#ffd99f">с</font><font color="#ffde9f">к</font><font color="#ffe29f">о</font><font color="#ffe69f">л</font><font color="#ffea9f">ь</font><font color="#ffee9f">к</font><font color="#fff29f">о</font> <font color="#fff79f">о</font><font color="#fffb9f">б</font><font color="#ffff9f">н</font><font color="#fbff9f">о</font><font color="#f7ff9f">в</font><font color="#f2ff9f">л</font><font color="#eeff9f">е</font><font color="#eaff9f">н</font><font color="#e6ff9f">и</font><font color="#e2ff9f">й</font><font color="#deff9f">.</font> <font color="#d9ff9f">Н</font><font color="#d5ff9f">а</font><font color="#d1ff9f">д</font><font color="#cdff9f">е</font><font color="#c9ff9f">ю</font><font color="#c5ff9f">с</font><font color="#c0ff9f">ь</font><font color="#bcff9f">,</font> <font color="#b8ff9f">ч</font><font color="#b4ff9f">т</font><font color="#b0ff9f">о</font> <font color="#acff9f">п</font><font color="#a7ff9f">р</font><font color="#a3ff9f">и</font><font color="#9fff9f">я</font><font color="#9fffa3">т</font><font color="#9fffa7">н</font><font color="#9fffac">ы</font><font color="#9fffb0">х</font> <font color="#9fffb4">в</font><font color="#9fffb8">а</font><font color="#9fffbc">м</font><font color="#9fffc0">!</font>
<br/><font color="#9fffc5">Н</font><font color="#9fffc9">е</font> <font color="#9fffcd">з</font><font color="#9fffd1">а</font><font color="#9fffd5">б</font><font color="#9fffd9">ы</font><font color="#9fffde">в</font><font color="#9fffe2">а</font><font color="#9fffe6">й</font><font color="#9fffea">т</font><font color="#9fffee">е</font> <font color="#9ffff2">з</font><font color="#9ffff7">а</font><font color="#9ffffb">г</font><font color="#9fffff">л</font><font color="#9ffbff">я</font><font color="#9ff7ff">д</font><font color="#9ff2ff">ы</font><font color="#9feeff">в</font><font color="#9feaff">а</font><font color="#9fe6ff">т</font><font color="#9fe2ff">ь</font> <font color="#9fdeff">п</font><font color="#9fd9ff">о</font><font color="#9fd5ff">д</font> <font color="#9fd1ff">е</font><font color="#9fcdff">л</font><font color="#9fc9ff">к</font><font color="#9fc5ff">у</font> <font color="#9fc0ff">–</font> <font color="#9fbcff">к</font><font color="#9fb8ff">а</font><font color="#9fb4ff">ж</font><font color="#9fb0ff">д</font><font color="#9facff">о</font><font color="#9fa7ff">г</font><font color="#9fa3ff">о</font> <font color="#9f9fff">ж</font><font color="#a39fff">д</font><font color="#a79fff">у</font><font color="#ac9fff">т</font> <font color="#b09fff">п</font><font color="#b49fff">о</font><font color="#b89fff">д</font><font color="#bc9fff">а</font><font color="#c09fff">р</font><font color="#c59fff">к</font><font color="#c99fff">и</font> <font color="#cd9fff">о</font><font color="#d19fff">т</font> <font color="#d59fff">Д</font><font color="#d99fff">е</font><font color="#de9fff">д</font><font color="#e29fff">а</font> <font color="#e69fff">М</font><font color="#ea9fff">о</font><font color="#ee9fff">р</font><font color="#f29fff">о</font><font color="#f79fff">з</font><font color="#fb9fff">а</font><font color="#ff9fff">!</font>
 <img src="img/smiles/smile.gif" alt=":)"/>
</p></small>
</div>
<p style="border-top:1px solid #444e4f;"></p>
<div class="link"><a href="elka.php" class="link">С новым годом!</a></div>
</div>
</body>
</html>