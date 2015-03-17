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
		if (strpos($line, 'subject=/CN') !== FALSE){
			$subject = $line ;
			$user = get_string_between($subject, "subject=/CN=", "/L=");
			$i = strpos($subject, '/L=');
			$location =  substr($subject, $i+3);		
		}
		if (strpos($line, 'issuer=/') !== FALSE){
			$issuer = $line ;
			$gpgid =  substr($issuer, 11);		
		}
	}
	unset($line); // break the reference with the last element 

/*






*/


/*			else{
				foreach ($output as $line) {
					if (strpos($line, 'subject=/') !== FALSE){
						$user = $line ;
					}
					if (strpos($line, 'issuer=/') !== FALSE){
						$location = $line ;
					}
				}
				unset($value); // break the reference with the last element 
			} */



?>





<div align="center">

<table border="0">
	<tr>
		<td colspan="5"><a href="https://retroshare.rocks/"><center><img src="retroshare-header.png" align="absmiddle" alt="RetroShare" ></td>
	</tr>
	<tr>
		<td colspan="5"><center><b>Choose a Chatserver</b><BR><BR></center></td>
	</tr>
	<tr>
		<td colspan="1"><a href="/copyleft/"><center><img src="copyleft.png" align="absmiddle" alt="copyleft" height="128" width="128"></a></center><center>Chatserver<BR>Copyleft</center></td>
		<td colspan="1"><a href="/kopimi/"><center><img src="kopimi.png" align="absmiddle" alt="kopimi" height="128" width="128"></a></center><center>Chatserver<BR>Kopimi</center></td>
		<td colspan="1"><a href="/chatasaurus/"><center><img src="chatasaurus.png" align="absmiddle" alt="chatasaurus" height="128" width="128"></a></center><center>Chatserver<BR>Chatasaurus</center></td>
		<td colspan="1"><a href="/telecomix/"><center><img src="telecomix.png" align="absmiddle" alt="chatasaurus" height="128" width="128"></a></center><center>Chatserver<BR>Telecomix</center></td>
		<td colspan="1"><a href="https://retrochat.piratenpartei.at/"><center><img src="pirate.png" align="absmiddle" alt="pirate" height="128" width="128"></a></center><center>Chatserver<BR>Pirate Party</center></td>
		<td colspan="1">
</td>
	</tr>
	<tr>
	<td> 
	</td>
<td colspan="3"  ><br>


<form method="post" action="?action=exec">

			<fieldset>
				<b>Open Port Check Tool</b>
				<div>
					<label>Your IP:</label>
					<input name="ip" type="text" value="<?php print $ip; ?>"><BR>
				
					<label>Port:</label>
					<input name="port" type="text" value="<?php print $port; ?>"><BR>
					<center><input type="submit" value="Check my Port" /></center>
				</div>
			</fieldset>
		</form>

		</td>
		<td> 
		</td>

	
	</tr>


	<tr>
		<td colspan="5"  ><?php if($user): ?>
			<p><?php //print $subject; 
				echo '<center>';
 				echo "<font color='#00FF00'>" . "<B>"."Success: " . "</B>" . "</font>" . "I can see your service on " . "<B>". $ip. "</B>" . " on port (" ."<B>".$port. "</B>" .  ")"; 				print "<BR>" . "Your ISP is not blocking port " . $port ;				
				print "<BR>"."User: " . $user;	
				print "<BR>" ."Location: " . $location;
				//print "<BR>" . $issuer ;
				print "<BR>" . "GPG-ID: " . $gpgid ;
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


		</td>
	</tr>

</table>
</div>
</body>
</html>


