<div class="stats">
<?php
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
$id = $_SESSION['id'];
$query90 = "Select profile from users where id = '$id'";
$result90 = mysqli_query($dbc, $query90) or die ('Ошибка передачи запроса к БД'); 
$row90 = mysqli_fetch_array($result90);
$profile = $row90['profile'];
?>
<div class="link"><a href="../<?php if ($profile == '2') {?>me.php<?php } else {?>profile.php?id=<?php echo "$id";?><?php }?>" class="link"><img src="../img/ico/profile.png" width="12" height="12" alt="."/> Мой профиль</a></div>
  <?php
  $query = "Select clan from users where id = '$id'";
  $result = mysqli_query($dbc, $query) or die ('Ошибка передачи запроса к БД'); 
  $row = mysqli_fetch_array($result);
  $clan = $row['clan'];
  if (!empty($clan)) {
    ?>
<div class="link"><a href="../clan.php" class="link"><img src="../img/ico/flag1.png" width="12" height="12" alt="."/> Мой отряд</a></div>
    <?php
  }
}
?>
<div class="link"><a href="../index.php" class="link"><img src="../img/ico/rad.png" width="12" height="12" alt="."/> На главную</a></div>
</div>