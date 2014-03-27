<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>POC REST Click to call / Click to transfer</title>
	</head>
	<body>		
		<h1>POC REST Click to call / Click to transfer</h1>
	    <fieldset style="width:350px">
	    	<legend>Input extension numbers</legend>		
			<form action="CallSetup.php" method="post">
		  		<table>
		    	 	<tr>
		    	 		<td>Call from:</td>
		    	 		<td><input type="text" name="from" size="5" value="210"/></td>
		    	 		<td>Pin:</td>
		    	 		<td><input type="text" name="pinFrom" size="5" value="1234"/></td>
		    	 	</tr>
		    	 	<tr>
		    	 		<td>Call to:</td>
		    	 		<td><input type="text" name="to" size="5" value="220" /></td>		    	 		
		    	 	</tr>
		    	</table>		    
		      	<input type="submit" value="Call" />
		      </form>
		</fieldset>
		<?php if (array_key_exists('error', $_POST)) 
			{
				echo $_POST['error'];
			}
		?>		
	</body>
</html>
		
