<?php
 session_start();
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>DIG3134 - Starter Kit for Project 1</title>
</head>

<body>
<?php

// GUESS.PHP. A simple number guessing game for DIG3134
// The purpose of this program is to help you learn basic PHP syntax, and
// to review how functions work.
//			-- Mike Moshell, December 2010
//
// Also you will learn a simple client-side interaction model that will
// be used throughout the course.

	$testnumber=2;
		
	#getform: a simple utility that will later become a safety feature
	function getform() // Copy all Post info into the $Form array.
	{global $Form;
		foreach ($_POST as $key=>$val)
		{
			logprint ("getform sees key=$key and val=$val",1);
			$Form[$key]=$val;
		}
	} #getform
	
	#logprint: a simple diagnostic tool
	function logprint($saywhat,$ctrl)
	{global $testnumber;
	if ($testnumber==$ctrl)
		print $saywhat;
	}#logprint
	
	#makenumber:creates a random number between 1 and 100
	function makenumber()
	{
		return rand(1,100);
	}
	
	###### MAIN PROGRAM BEGINS HERE #######
	
	print "<form method='post'>";
	
	$Form['guess']=''; 		// old guess should not come around from the session.
	
	getform();				// Read the new POST information into the $Form variable.
	
	$target=$Form['target']; // What number are we trying to hit?
	$guess=$Form['guess'];
	$nextaction=$Form['nextaction'];
	
	if(!$nextaction) // If there is no 'nextaction'. then this is our first call to the program.
	{
		$target=makenumber();
		$Form['target']=$target;
		
		print "<p>This is a number guessing game.</p>";
		print "<p>We will cheat to make it easier for you, ".
										"by printing out the number you are trying to guess.</p>";
		print "<p>target=$target. Enter your first guess (an integer between 1-100, inclusive.)<br />";
		print "<input type='text' name='guess'>";		
	
	}
	else if ($nextaction=="GIVE UP")
	{
		print "Quitter!";
		exit; // so as not to draw buttons any more.
	}
	else if ($nextaction=="GUESS")
	{
		$target=$_POST['tarvalue'];
		
		if ($target==$guess)
		{
			print "You got it! Yaa hoo!";
			exit;// we're done
		}
		else
		{
			if ($target>$guess)
				print "Too low.";
			else
				print "too high.";
				
			print "Enter your next guess (1-100)<br />";
			print "<input type='text' name='guess'><br />";
		}	
	}
	else
		print "Error 100: nextaction=$nextaction, but I don't know what to do.";
	
	print "<input type='hidden' name='tarvalue' value='$target'>";
	
	print "<input type='submit' name='nextaction' value='GUESS'>";
	print "<input type='submit' name='nextaction' value='GIVE UP'>";
	print "</form>";
	
?>
</body>
</html>