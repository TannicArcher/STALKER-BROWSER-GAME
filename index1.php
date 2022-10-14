<?php
require_once('conf/dbc.php');
require_once('conf/session_start.php');
if ((!isset($_SESSION['id'])) or (!isset($_SESSION['nick'])))  {
  ?>
  <script type="text/javascript">
  document.location.href = "login.php";
  </script>
  <?php
  exit();
}
$page_title = 'S.T.A.L.K.E.R - игра на ';
require_once('conf/head1.php');
require_once('conf/banned.php');
$user_id = $_SESSION['id'];
?>






<div class="r2">
<a href="javascript:tag(':)', '')"><img src="img/smiles/smile.gif" /></a> 
<a href="javascript:tag(':(', '')"><img src="img/smiles/sad.gif" /></a> 
<a href="javascript:tag(':D', '')"><img src="img/smiles/D.gif" /></a>  
<a href="javascript:tag(':плак', '')"><img src="img/smiles/cray.gif" /></a>
</div>








<?php
if ((isset($_SESSION['id'])) and (isset($_SESSION['nick'])))  {
  require_once('conf/navigin.php');
}
?>
<?php
require_once('conf/blok.php');
?>
</body>
</html>