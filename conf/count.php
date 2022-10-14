<div class="stats">
  <img src="img/ico/odinochkion.png" width="12" height="12" alt="o"/>
  <?php
  $query_number_naim = "Select id from users where gruppa = 'naemniki' and location = '$location' and last_active > NOW() - (600) and hp > 0 and ban != 1";
  $result_number_naim = mysqli_query($dbc, $query_number_naim) or die ('Ошибка передачи запроса к БД'); 
  $number_naim = mysqli_num_rows ($result_number_naim);
  echo "$number_naim";
  ?>
  <img src="img/ico/dolgon.png" width="12" height="12" alt="d" /> 
  <?php
  $query_number_dolg = "Select id from users where gruppa = 'dolg' and location = '$location' and last_active > NOW() - (600) and hp > 0 and ban != 1";
  $result_number_dolg = mysqli_query($dbc, $query_number_dolg) or die ('Ошибка передачи запроса к БД'); 
  $number_dolg = mysqli_num_rows ($result_number_dolg);
  echo "$number_dolg";
  ?>
  <img src="img/ico/svobodaon.png" width="12" height="12" alt="s"/> 
  <?php
  $query_number_svoboda = "Select id from users where gruppa = 'svoboda' and location = '$location' and last_active > NOW() - (600) and hp > 0 and ban != 1";
  $result_number_svoboda = mysqli_query($dbc, $query_number_svoboda) or die ('Ошибка передачи запроса к БД'); 
  $number_svoboda = mysqli_num_rows ($result_number_svoboda);
  echo "$number_svoboda";
  ?>
  <img src="img/ico/monolit.png" width="12" height="12" alt="s"/> 
  <?php
  $query_number_mon = "Select id from users where gruppa = 'mon' and location = '$location' and last_active > NOW() - (600) and hp > 0 and ban != 1";
  $result_number_mon = mysqli_query($dbc, $query_number_mon) or die ('Ошибка передачи запроса к БД'); 
  $number_mon = mysqli_num_rows ($result_number_mon);
  echo "$number_mon";
  ?>
  </div>