<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>POC REST Click to call / Click to transfer</title>
	</head>
	<body>		
		<h1>POC REST Click to call / Click to transfer</h1>
	    <fieldset style="width:350px">
		    <legend>Call progress</legend>
		    
		    <?php	
		    	
		    	// Do some input checking & assign variables
				if (strlen($_POST['from']) > 0 && strlen($_POST['to']) > 0 && strlen($_POST['pinFrom']) > 0 )
				{
					$from = $_POST['from'];			//Userid in sipx = A
					$to = $_POST['to'];				//Number to dial = B
					$pinFrom = $_POST['pinFrom'];	//sipx pin
					
					callSetup($from,$to,$pinFrom);
				}
				else
				{ 
					echo 'Invalid input!<br/><br/>';					
				}		
			
				/**
				 * Setup the call
				 * Based on : http://wiki.sipfoundry.org/display/sipXecs/Configuration+RESTful+Service
				 * 
				 * @param A-party
				 * @param B-party
				 * @param A-pin
				 */
				function callSetup($from, $to, $pinFrom) 
				{
				
					echo 'Calling from extension '. $from . ' to extension ' . $to . '.....</br></br>';
					
					// Init session
				    $ch = curl_init();	
				    
				    // Set url for A and B party, call via INVITE
				    $url = "http://192.168.1.200:6667/callcontroller/" . $from . "/" . $to . "?sipMethod=INVITE";
				
				    // Set the options, use A/from credentials!
				    curl_setopt($ch, CURLOPT_URL, $url);
				    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
				    curl_setopt($ch, CURLOPT_POST, 1);
				    curl_setopt($ch, CURLOPT_USERPWD, $from.":".$pinFrom);
				
				   	// Execute the command
				   	$result = curl_exec($ch);
				   	curl_close($ch);
				   	
				   	echo '<br/>Executed command: ' . $url . '<br/>';
				}	  
			?>
			<br/>
			<form action="CallMenu.php"><input type="submit" value="<< Back to menu" /></form>
		</fieldset>
		<br/>
		<fieldset style="width:350px">
	    	<legend>Transfer call</legend>
	    	<form action="CallTransfer.php" method="post">
	    	<table>
	    	 	<tr>
	    	 		<td>Transfer call to:</td>
	    	 		<td><input type="text" name="target" size="5" value="230"/></td>
	    	 	</tr>
	    	 </table>
	    	 <input type="hidden" name="from" value="<?php echo $_POST['from']?>" />
	    	 <input type="hidden" name="to" value="<?php echo $_POST['to']?>" />
	    	 <input type="hidden" name="pinFrom" value="<?php echo $_POST['pinFrom']?>" />
	    	 <input type="submit" value="Transfer" />	    	 	
		</fieldset>
	</body>
</html>



		
