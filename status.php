<?php

    //$path = 'isup/pirateparty';
    $status = file_get_contents($path);
        //echo $path . "<BR>";
        //echo $status . "<BR>";

	$online="online";
	$offline="offline"; 
	$unknown="unknown"; 
	
	if (strcmp($status, $online) == 1 ){
		echo '<img src="isup/check.png" align="absmiddle" alt="online"><font size="2">online</font>';
		//echo "online";
	}
        if (strcmp($status, $offline) == 1 ){
		echo '<img src="isup/stop.png" align="absmiddle" alt="offline"><font size="2">offline</font>';
        }
        if (strcmp($status, $unknown) == 1 ){
                echo '<img src="isup/attn.png" align="absmiddle" alt="unavailable"><font size="2">unavailable</font>';
        }


	//else{
	//	echo "unknown";
	//}
?>
