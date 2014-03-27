<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>POC REST Click to call / Click to transfer</title>
	</head>
	<body>		
		<h1>POC REST Click to call / Click to transfer</h1>
	    <fieldset style="width:350px">
		    <legend>Transfer progress</legend>		    
		    
		    <?php
		    	
		    	// Do some input checking & assign variables
				if (strlen($_POST['target']) > 0 )
				{
					$from = $_POST['from'];			//Userid in sipx = A
					$to = $_POST['to'];				//Number to dial = B
					$target = $_POST['target'];		//Party to transfer = C
					$pinFrom = $_POST['pinFrom'];	//sipx pin for A				
					
					callTransfer($from, $to, $target, $pinFrom);
				}
				else
				{ 
					echo 'Invalid input!<br/><br/>';
					echo '<form action="CallSetup.php"><input type="submit" value="<< Back" /></form>';
				}		
			
				/**
				 * Transfer the call
				 * Based on : http://wiki.sipfoundry.org/display/sipXecs/Configuration+RESTful+Service
				 * 
				 * @param A-party
				 * @param B-party
				 * @param C-party
				 * @param A-pin
				 */
				function callTransfer($from, $to, $target, $pinFrom) 
				{
				
					echo 'Transfering extension ' . $to . ' to extension ' . $target . '.....</br></br>';
					
					// Init session
				    $ch = curl_init();
				
					// A transfers B to C via transfer, use A credentials!!!
				    $url = 'http://192.168.1.200:6667/callcontroller/'. $from .'/' . $to . '?target=' . $target . '&action=transfer';
				    
				    curl_setopt($ch, CURLOPT_URL, $url);
				    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
				    curl_setopt($ch, CURLOPT_POST, 1);
				    curl_setopt($ch, CURLOPT_USERPWD, $from . ':' . $pinFrom);
				    		
				   	// Execute the command
				   	$result = curl_exec($ch);
				   	curl_close($ch);
				   	
				   	echo '<br/>Executed command: ' . $url . '<br/>';
				}	  
			?>
	    	<br/>
	    	<form action="CallMenu.php" method="post">
	    		<input type="submit" value="Back to menu" />
	    	</form>	    	 	
		</fieldset>
	</body>
</html>



		
