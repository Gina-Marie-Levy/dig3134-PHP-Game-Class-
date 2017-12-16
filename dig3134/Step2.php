<?php  
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>Project 1 Starter Kit</title> 
</head>

<body> 
<form method='post'>

<?php 

function showcard($n)
{
	if ($n==11)
		$selector='j';
	else if ($n==12)
		$selector='q';
	else
		$selector=$n;
		
	$cardname=$selector.'spade.png';
	return "<img src='cards/$cardname'>";
}

///////////////////// 
// This is the starter kit for Project 1 in DIG 3134 - Fall 2013 
//	J. Michael Moshell - UCF Digital Media 
/////////////////////

$nextaction=$_POST['dowhat'];

//////////////////////////////////////

if (!$nextaction) // If nobody clicked a button to get to this page,

{								   	
///////////// 	
// SCREEN 1 	
/////////////
	$target1= rand(1,14);
	$_SESSION['target1']=$target1; // so we will have it later
	
	$target2= rand(1,14);
	$_SESSION['target2']=$target2; // so we will have it later
	
	//$c=showcard($target1);
	//$c=showcard($target2);
	
	print "<p>This is the Acey Deucy Game.</p>";
	print "<p>We will cheat to make it easier for you, ".
		"by printing out the number you are trying to guess.</p>";
	print "<p>Target 1 is: $target1 <br />";
	print "<p>Target 2 is: $target2 <br />";
	print "<input type='text' name='guessvalue'> <br />";

	print "<input type='submit' name='dowhat' value='GUESS'>"; 		
	print "<input type='submit' name='dowhat' value='GIVE UP'>"; 		
	print "<input type='submit' name='dowhat' value='JUNK BUTTON'>"; 

} 	 	
else if ($nextaction=="GIVE UP") 	
{ 		
	print "Quitter!"; 		
	exit; // so as not to draw buttons any more. 	
} 	
else if ($nextaction=="GUESS") 	
{
	#################### 		
	# SCREEN TWO 		
	####################

	$guess=$_POST['guessvalue']; 		
	$target=$_SESSION['targetvalue']; 				 		
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
		print "<input type='text' name='guessvalue'><br />"; 		
}


		print "<input type='submit' name='dowhat' value='GUESS'>"; 		
		print "<input type='submit' name='dowhat' value='GIVE UP'>";

} 	
else 		
		print "Error 100: nextaction=$nextaction, but I don't know what to do."; 
?> 
</form> 
</body> 
</html> 


