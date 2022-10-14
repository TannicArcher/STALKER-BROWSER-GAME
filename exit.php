<?php
session_start();
if (isset($_SESSION['id'])) {
  $_SESSION = array();
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '' , time() - 3600);
	session_destroy();
  }
  setcookie('id', '' , time() - 3600);
  setcookie('nick', '' , time() - 3600);
}
?>
<script type="text/javascript">
document.location.href = "index.php";
</script>