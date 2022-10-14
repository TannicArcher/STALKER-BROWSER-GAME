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
  exit();
}

$log_id = $_SESSION['id'];
$query_ch = "Select clan, gruppa, money from users where id = '$log_id'";
$result_ch = mysqli_query($dbc, $query_ch) or die ('Ошибка передачи запроса к БД1'); 
$row_ch = mysqli_fetch_array($result_ch);
$clan_ch = $row_ch['clan'];
$money = $row_ch['money'];
$gruppa_cr=$row_ch['gruppa'];
$create = $_GET['create'];
if (empty($clan_ch) and $create ==0) {
  $page_title = 'Создать клан';
  require_once('conf/head.php');
  require_once('conf/top.php');
  ////////////////////////////////////////////////////////////
  if (isset($_POST['create'])) {
    $name=$_POST['name'];
    $sgn = '#^[йцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮqwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM! ]+$#';
    $en = '#[a-zA-Z]#';
    $rus = '#[а-яА-Я]#';
	$cr = 1;
	if (!empty($name)) {
      if ((preg_match($en, $name)) and (preg_match($rus, $name))) {
	    ?> 
	    <p id="error">Назватие должно содержать только русские или английские буквы</p>
	    <?php
        $cr = 0;
	  }
	  if (!preg_match($sgn, $name)) {
		?> 
	    <p id="error">Имеются запрещенные символы или цифры в названии</p>
	    <?php
        $cr = 0;
      }
	  $long_name = iconv_strlen($name, 'UTF-8');
	  if (($long_name<2) or ($long_name>16)){
	    ?> <p id="error">Название должно быть в пределах от 2 до 16 символов</p>
	    <?php
	    $cr = 0;
	  }
	  if ($cr<> 0) {
	  $query = "Select clan_id from clans where name = '$name'";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД2'); 
      $row = mysqli_num_rows($result);
	  if (!empty($row)) {  ?> <p id="error">Такой отряд уже существует</p>
	    <?php
	    $cr = 0;
	  }
	  
	  if ($money<5000) {
	  ?> <p id="error">У вас недостаточно средств</p>
	    <?php
	    $cr = 0;
	  }
	  }
	  ///////Всё норм)) Создаём клан
	  if ($cr == 1) {
	  $money=($money-5000);
	  $name = mysqli_real_escape_string($dbc, trim($name));
	  $query_cr = "insert into clans (`name`, `gruppa`, `clan_opit`, `mentor`) values ('$name', '$gruppa_cr', '0', '0')";
	  $result_cr = mysqli_query($dbc, $query_cr) or die ('Ошибка передачи запроса к БД3');
	  $query_cr = "select clan_id from clans where name='$name'";
	  $result_cr = mysqli_query($dbc, $query_cr) or die ('Ошибка передачи запроса к БД4');
	  $row_cr = mysqli_fetch_array($result_cr);
	  $clan_id = $row_cr['clan_id'];
	  $query = "update users set clan = '$clan_id', clan_rang = 10, money = '$money' where id = '$log_id'";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД5');
      $query = "DELETE FROM  in_clan WHERE id_in = '$log_id'";
      $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД6');
	  ?>
      <script type="text/javascript">
      document.location.href = "company.php?company_id=<?php echo "$clan_id";?>";
      </script>
      <?php
      exit();
	  
	  }
	  //////////////////////////////
    }
	else {
      ?>
      <p id="error">Введите название отряда</p>
      <?php
      $cr = 0;
    }
  }
  ////////////////////////////////////////////////////////////
  ?>
   <div class="stats">
   <p>Название отряда:</p>
   <form enctype="multipart/form-data" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
	 <input type="text" style="height:13px;" class="input" name="name" />
	 <div class="knopka">
     <input type="submit" class="input" value="Создать" name="create"/>
     </div>
	 </form>
  <p><span class="bonus">Стоимость:<img src="img/ico/money.png" width="12" height="12"/> 5000 RUB</span></p>
  </div>
  <?php  
   require_once('conf/navig.php');
   require_once('conf/foot.php'); 
}
else {
?>
      <script type="text/javascript">
      document.location.href = "company.php?company_id=<?php echo "$clan_ch";?>";
      </script>
      <?php
}
//////////////////////////////////////////////  
mysqli_close($dbc);
?>

