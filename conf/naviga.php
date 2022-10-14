<center>
	  <?php
	  $phpself= $_SERVER['PHP_SELF'];
	  $phpself = htmlentities($phpself, ENT_QUOTES);
	  ///////////////////////////////////////
	  ////////////////////////////////////////
	  if ($cur_page > 1) {?>
<a class="btn_dark" href="<?php echo "$phpself";?>?page=1&type=<?php echo "$tip";?>"><<</a>
     <?php }
	  else {
	    echo ' ';
	  }
	  if (($cur_page-3)>0) {
	 $k = ($cur_page-3);
	    ?><a class="btn_dark" href="<?php echo "$phpself" . '?page=' . ($cur_page-3)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a><?php
      }
	 if (($cur_page-2)>0) {
	 $k = ($cur_page-2);
	    ?> <a class="btn_dark" href="<?php echo "$phpself" . '?page=' . ($cur_page-2)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
     if (($cur_page-1)>0) {
	 $k = ($cur_page-1);
	    ?> <a class="btn_dark" href="<?php echo "$phpself" . '?page=' . ($cur_page-1)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
	?> <span class="btn_dark" style="padding: 8px 13px;"><?php echo " $cur_page ";?></span><?php
	 if (($cur_page+1)<=$num_page) {
	 $k = ($cur_page+1);
	    ?> <a class="btn_dark" href="<?php echo "$phpself" . '?page=' . ($cur_page+1)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
	  	 if (($cur_page+2)<=$num_page) {
	 $k = ($cur_page+2);
	    ?> <a class="btn_dark" href="<?php echo "$phpself" . '?page=' . ($cur_page+2)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
	 if (($cur_page+3)<=$num_page) {
	 $k = ($cur_page+3);
	    ?> <a class="btn_dark" href="<?php echo "$phpself" . '?page=' . ($cur_page+3)?>&type=<?php echo "$tip";?>"><?php echo "$k";?></a> <?php
      }
	/////
	if ($cur_page < $num_page) {?>
<a class="btn_dark" href="<?php echo "$phpself";?>?page=<?php echo "$num_page";?>&type=<?php echo "$tip";?>">>></a>
     <?php }
	else {
	  echo ' ';
	}

	////////////////////////////////
	///////////////////////////////
	?></center>
<p class="podmenu" style="border-top:1px solid #444e4f; background-color:#1c252f;"></p>