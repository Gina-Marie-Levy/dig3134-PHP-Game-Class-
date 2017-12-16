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
		else if ($n==13)
		$selector='k';
		else if ($n==14)
		$selector='1';
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

if (!$nextaction || $nextaction=="Yes" || $nextaction=="Pass" || $nextaction=="Next Draw") // If nobody clicked a button to get to this page,

{								   	
///////////// 	
// SCREEN 1 	
/////////////
	$target1= rand(1,12);
	
	$target2= rand($target1+2,14);
	
	If($target1<$target2)
	{
		$low=$target1;
		$high=$target2;
	}

	else
	
	{
		$low=$target2;
		$high=$target1;
	}
	
	$_SESSION['low']=$low;
	$_SESSION['high']=$high;
	

	print "<h2><strong>Acey Deucy Game.</strong></h2>";
	print "<p>Bet if the next card falls inbetween the 2 cards shown.</p>";

				
	 $c=showcard($low); print $c;
	 
	 //if ($nextaction=='BET')
	// $guess=rand(1,14); 
	//$c=showcard($guess); print $c;
	 $c=showcard($high); print $c;
	
	
	print "<br /><input type='submit' name='dowhat' value='Bet'>"; 		
	print "<input type='submit' name='dowhat' value='Pass'>"; 		
	print "<input type='submit' name='dowhat' value='JUNK BUTTON'>";
	print "<input type='submit' name='dowhat' value='Next Draw'>"; 

} 	 	
else if ($nextaction=="No") 	
{ 		
	print "Quitter!"; 		
	exit; // so as not to draw buttons any more. 	
} 	
else if ($nextaction=="Bet") 	
{
	#################### 		
	# SCREEN TWO 		
	####################

	$guess=rand(1,14); 
	
	$low=$_SESSION['low'];
	$high=$_SESSION['high']; 
	
	$c=showcard($low); print $c;
	 

	$c=showcard($guess); print $c;
	
	$c=showcard($high); print $c;
				 		
	
	if ($low<$guess && $guess<$high)

	
	{ 			
		print "<img src='win.gif'>"; 			
		print "<br />Would you like to play again?"; 		
	} 		
	else 		
	{ 			
		print "<img src='lose.gif'>";
		print "<br />Would you like to play again?";
	}
	
		print "<input type='submit' name='dowhat' value='Yes'>"; 		
		print "<input type='submit' name='dowhat' value='No'>";
		print "<input type='submit' name='dowhat' value='Next Draw'>";
			
}

else 		
		print "Error 100: nextaction=$nextaction, but I don't know what to do."; 
?> 
</form> 
</body> 
</html> 


