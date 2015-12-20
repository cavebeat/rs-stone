<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<meta http-equiv="expires" content="0">
	<head>
	<title>RetroShare Rocks</title>
	<meta name="robots" content="noindex">
</head>
<body>


<?php

$ip = $_SERVER['REMOTE_ADDR'];

$action = isset($_GET['action']) ? $_GET['action'] : null;
#$ip = isset($_POST['ip']) ? $_POST['ip'] : 'encrypted.google.com';
$port = isset($_POST['port']) ? (int)$_POST['port'] : 443;
$output = '';
$problem = '';
$wrong = '';
$user = '';
$location = '';
$issuer = '' ;

function get_string_between($string, $start, $end){
	$string = " ".$string;
	$ini = strpos($string,$start);
	if ($ini == 0) return "";
	$ini += strlen($start);   
	$len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}


switch($action){
	case 'exec':
		if($ip && $port && $port <= 0xffff){
			exec('openssl s_client -connect '.$ip.':'.$port, $output, $code);
			//$output = join(PHP_EOL, $output);
			if(!$output){
				$problem = 'Not working with '.$ip.':'.$port.'. Code: '.$code;
			}
		}
		else{
			$wrong = 'Wrong input.';
		}
		break;
	
	default:
		break;
}

	foreach ($output as &$line) {
		//if (strpos($line, 'subject=/CN') !== FALSE){
			//$subject = $line ;
			//$user = get_string_between($subject, "subject=/CN=", "/L=");
			//$i = strpos($subject, '/L=');
			//$location =  substr($subject, $i+3);		
		//}
		if (strpos($line, 'issuer=/') !== FALSE){
			$issuer = $line ;
			$gpgid =  substr($issuer, 11);		
		}
	}
	unset($line); // break the reference with the last element 
?>





<div align="center">

<table border="0">
	<tr><td colspan="5"><a href="https://retroshare.rocks/"><center><img src="retroshare-header.png" align="absmiddle" alt="RetroShare" ></td></tr>
	<tr><td colspan="5"><center><b>Choose a Chatserver</b><BR><BR></center></td></tr>
	<tr>
		<td colspan="1"><a href="/copyleft/"><center><img src="copyleft.png" onmouseover="this.src='copyleft_color.png'" onmouseout="this.src='copyleft.png'" align="absmiddle" alt="copyleft" height="128" width="128"></a></center><center>Copyleft v06<BR><img src="gnupg.png" align="absmiddle" alt="GPG-ID" height="20" width="15"  ><font size="2"> 0xA104CD8BA3CA7224</font><BR> <?php $path = 'isup/copyleft'; include 'status.php'; ?></center></td>

		<td colspan="1"><a href="/kopimi/"><center><img src="kopimi.png" onmouseover="this.src='kopimi_color.png'" onmouseout="this.src='kopimi.png'" align="absmiddle" alt="kopimi" height="128" width="128"></a></center><center>Kopimi v06<BR><img src="gnupg.png" align="absmiddle" alt="GPG-ID" height="20" width="15"  ><font size="2"> 0xEF0FC8E21CFE3DCE</font><BR> <?php $path = 'isup/kopimi'; include 'status.php'; ?></center></td>

		<td colspan="1"><a href="http://107.150.3.74/w2c/gxs/"><center><img src="chatasaurus.png" onmouseover="this.src='chatasaurus_color.png'" onmouseout="this.src='chatasaurus.png'" align="absmiddle" alt="chatasaurus" height="128" width="128"></a></center><center>Chatasaurus v06<BR><img src="gnupg.png" align="absmiddle" alt="GPG-ID" height="20" width="15"  ><font size="2"> 0x1AC6DD5267D432A0</font><BR> <?php $path = 'isup/chatasaurus'; include 'status.php'; ?></center></td>
	
	<td colspan="1"><a href="https://retrochat.piratenpartei.at/" target="_blank"><center><img src="pirate.png" onmouseover="this.src='pirate_color.png'" onmouseout="this.src='pirate.png'" align="absmiddle" alt="pirate" height="128" width="128"></a></center><center>PirateParty v06<BR><img src="gnupg.png" align="absmiddle" alt="GPG-ID" height="20" width="15"  ><font size="2"> 0xD69260E2F99BD034</font><BR> <?php $path = 'isup/pirateparty'; include 'status.php'; ?>
</center></td>

	<td colspan="1"><a href="/telecomix/"><center><img src="telecomix.png" onmouseover="this.src='telecomix_color.png'" onmouseout="this.src='telecomix.png'" align="absmiddle" alt="telecomix" height="128" width="128"></a></center><center>Telecomix v06<BR><img src="gnupg.png" align="absmiddle" alt="GPG-ID" height="20" width="15"  ><font size="2"> 0x9494A9FACA7E7992</font><BR> <?php $path = 'isup/telecomix'; include 'status.php'; ?></center></td>
	</tr>


<!--<tr><td colspan="5" ><img src="tor.jpg" align="absmiddle" alt="Tor"> Hidden Service Chatserver<BR>
<a href="http://udgdahofbq52bzxk.onion" target="_blank">http://udgdahofbq52bzxk.onion</a><BR><img src="gnupg.png" align="absmiddle" alt="GPG-ID" height="20" width="15"  ><font size="2"> 0x21473D694D79F48F</font></td></tr>-->
<BR>
<tr><td colspan="5" ><BR><BR> .onion Website and SourceCode Mirror<BR>
<img src="favicon.ico" align="absmiddle" alt="RS" height="20" width="20"> <a href="http://rsweb4zpnr4c3jti.onion" target="_blank">http://rsweb4zpnr4c3jti.onion</a><BR><img src="git.png" align="absmiddle" alt="Git" height="20" width="20" > <a href="http://rsgitcndakghiw57.onion/" target="_blank">http://rsgitcndakghiw57.onion/</a></td></tr>

<tr>
<td colspan="5" ><center><table border="0" >
	<tr><td colspan="2" ><br>
	<form method="post" action="?action=exec">
		<fieldset>
			<b>Open Port Check Tool</b>
			<div>
			<label>Your IP: </label><input name="ip" type="text" value="<?php print $ip; ?>"><BR>
			<right><label>RS Port: </label></right>
			<input name="port" type="text" value="<?php print $port; ?>"><BR>
			<center><input type="submit" value="Check my Port" /></center>
			</div>
		</fieldset>
	</form>
	</td></tr>
</table></center></td>
</tr>
<tr><td colspan="5" ><?php if($issuer): ?>
			<p><?php //print $subject; 
				echo '<center>';
				print "<BR>" . "GPG-ID: "."<img src='gnupg.png' align='absmiddle' alt='GPG-ID' height='20' width='15'  >" ." 0x" . $gpgid . "<BR>";				
 				echo "<font color='#00FF00'>" . "<B>"."Success: " . "</B>" . "</font>" . "I can see your RetroShare on " . "<B>". $ip. "</B>" . " and port (" ."<B>".$port. "</B>" .  ")"; 				print "<BR>" . "Your ISP is not blocking port " . $port ;				
				//if($user) print "<BR>"."User: " . $user;	
				//if($location) print "<BR>" ."Location: " . $location;
				echo '</center>';				
				 ?></p>
				<?php endif; ?>		

				<?php if($problem): ?>
				<p><?php  
				echo '<center>';
				print "<BR>" . "Problem: " . $problem ;
				echo '</center>';				
				 ?></p>
				<?php endif; ?>
				
				<?php if($wrong): ?>
				<p><?php  
				echo '<center>';
				print "<BR>" . $wrong ;
				echo '</center>';				
				 ?></p>
				<?php endif; ?>
</td></tr>



</table>
</div>
</body>
</html>


