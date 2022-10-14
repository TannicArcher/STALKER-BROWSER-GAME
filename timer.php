<script>
// Here’s where the Javascript starts
countdown = 1650715291;

// Converting date difference from seconds to actual time
function convert_to_time(secs)
{
	secs = parseInt(secs);	
	hh = secs / 3600;	
	hh = parseInt(hh);	
	mmt = secs - (hh * 3600);	
	mm = mmt / 60;	
	mm = parseInt(mm);	
	ss = mmt - (mm * 60);	
		
	if (hh > 23)	
	{	
	   dd = hh / 24;	
	   dd = parseInt(dd);	
	   hh = hh - (dd * 24);	
	} else { dd = 0; }	
		
	if (ss < 10) { ss = "0"+ss; }	
	if (mm < 10) { mm = "0"+mm; }	
	if (hh < 10) { hh = "0"+hh; }	
	if (dd == 0) { return (hh+":"+mm+":"+ss); }	
	else {	
		if (dd > 1) { return (dd+" дней "+hh+":"+mm+":"+ss); }
		else { return (dd+" день "+hh+":"+mm+":"+ss); }
	}	
}

// Our function that will do the actual countdown
function do_cd()
{
	if (countdown < 0)	
	{ 	
		
		
	}	
	else	
	{	
		document.getElementById('cd').innerHTML = convert_to_time(countdown);
		setTimeout('do_cd()', 1000);
	}	
	countdown = countdown - 1;	
}

document.write("<div id='cd'></div>\n");

do_cd();
</script>
<?php
$text = 'Вот текст с пробелами';
echo "$text";
$text = str_replace(' ', "", $text);
echo "<br/>$text";
?>
