<?php // wofstarter01.php
	session_start();

// WHEEL OF FORTUNE (Project 2) Starter Kit
// J. Michael Moshell - 13 Sept 2012

$list=file("list.txt");

$linenumber=0;
	
	# A standard diagnostic tool
	function logprint ($what,$num)
	{global $testnumber;
		if ($num==$testnumber)
			print "LP:$what <br />";
	}
	
	#makeheader:
	function makeheader( )
	{
		print '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>WOF tarter Kit</title>
	
		<style type="text/css">
			.mtable td 
			{
				width:50px;
			}
		</style>
	
		</head>
		
		<body>
		<h1>Moshell\'s WOF Starter Kit</h1>
		<form method="post">
		';
	} # makeheader
	
	#makefooter:
	function makefooter ()
	{
		print "</form></body></html>";
	}

	#display: Draws the Jeopardy table
	function display($visible, $letters)
	{
		$linelength=count($letters);
		print "<table class='mtable' border=1><tr>";
		for ($i=0; $i<=$linelength-2; $i++)
		{
			logprint("i=$i,vi=".$visible[$i]." ltr=".$letters[$i],1);
			
			//print "i=$i,visible=".$visible[$i]."<br />";
			 if ($visible[$i])
			 {
				print "<td>".$letters[$i]."</td>";
			 }
			else
				print "<td>&nbsp;</td>";
		}
		print "</tr></table>";
	}
	
	#drawinputscreen: Asks for input.
	function drawinputscreen($guesses)
	{
		print "<input type='text' name='guessletter'>";
		print "Guess a letter. You have $guesses guesses left.";
		print "<input type='submit' name='action' value='Go'>";
		print "<input type='submit' name='action' value='Go'>";
		print "<input type='submit' name='action' value='Go'>";
	}
	
	######## MAIN PROGRAM ##########
	
	makeheader();

	$letters=array ('X','P','E','R','F','E','C','T');
	
	$phrase=$list[$linenumber];
	print"phrase=$phrase";
	$letters=str_split($phrase);
	
	$letterlength=7;

	$visible=$_SESSION['visible'];
	$guesses=$_SESSION['guesses'];
	
	$act=$_POST['action'];
	if (!$act)
	{
		logprint("noact",1);
		$visible=array(0,0,0,0,0,0,0,0); // 8 cells; ignore first one.
		$guesses=5;
	} # initialization block
	else 
	{ // main repeated action. Get a guessletter, scan the array.
		$guessletter=strtoupper($_POST['guessletter']); // a-> A, etc. uppecase
		
		
		for ($i=0; $i<=$letterlength; $i++)
		{
			
			if ($guessletter==$letters[$i])
			{
				$visible[$i]=1;
			}
		}
		$guesses=$guesses-1;
	} #repeated action block
	
	display($visible,$letters);
	drawinputscreen($guesses);
		
	$_SESSION['visible']=$visible;
	$_SESSION['guesses']=$guesses;
?>

<body>
</body>
</html>