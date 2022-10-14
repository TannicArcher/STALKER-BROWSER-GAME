<center>
	  <?php
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  ///////////////////////////////////////
	  ////////////////////////////////////////
	  if ($cur_page > 1) {?>
<a class="btn_dark" href="<?php echo "$phpself";?>?page=<?php $page = ($cur_page - '1'); echo "$page";?>&id1=<?php echo "$id1";?>&id2=<?php echo "$id2";?>"><</a>
     <?php }
	  else {
	    echo ' ';
	  }
	  if ($cur_page > 0) {?>
<span class="btn_dark"><?php echo "$cur_page";?></span>
     <?php }

    if (($cur_page+1)<=$num_page) {?>
<a class="btn_dark" href="<?php echo "$phpself";?>?page=<?php $page = ($cur_page + '1'); echo "$page";?>&id1=<?php echo "$id1";?>&id2=<?php echo "$id2";?>">></a>
     <?php }
	  else {
	    echo ' ';
	  }

?>
</center>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>