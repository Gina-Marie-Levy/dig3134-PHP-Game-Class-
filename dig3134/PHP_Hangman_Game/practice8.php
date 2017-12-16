<?php // wofstarter01.php
	session_start();

// WHEEL OF FORTUNE (Project 2) Starter Kit
// J. Michael Moshell - 13 Sept 2012

	
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
		<meta http-equiv="Content-Style-Type" content="text/css">
<style type="text/css">
<!--
	body{background-image:url("background.gif"); background-repeat: no-repeat; background-attachment:fixed; background-position: center; }
	H1		{font-family: "Courier New", Courier, monospace; font-size: 18pt;}
	P		{font-family: Verdana, Arial, sans-serif; font-size: 12pt;}
	A:link	{COLOR: yellow; TEXT-DECORATION: underline;}
	A:visited	{COLOR: purple; TEXT-DECORATION: underline;}
	A:active	{COLOR: purple; TEXT-DECORATION: underline;}
	A:hover	{COLOR: white; TEXT-DECORATION: underline;}
-->
</style>
		<title>Play PHP Hangman Game</title>
	
		<style type="text/css">
			.mtable td 
			{
				width:60px;
				height:60px;
				color: Purple;
				font-size: 35px;
				text-align: center; 
			}
		</style>
		
<BODY bgColor="black" link="navy" vlink="navy" alink="navy">
<DIV ALIGN="center">
	
		</head>
		
		<body>
		<h1>Play PHP Hangman Game-Dig 3134: Project2</h1>
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
		print "Guess a letter.";
		print "<input type='submit' name='action' value='Go'>";
		print "<input type='submit' name='action' value='Reveal'>";
		print "<input type='submit' name='action' value='Next Phrase'>";
	}
	
	######## MAIN PROGRAM ##########
	
	//$alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; //the Alphabet to guess from

	makeheader();

	$list=file("list.txt");
	
	$wrongs=$_SESSION['wrongs'];	
	$linenumber=$_SESSION['linenumber'];	
	$visible=$_SESSION['visible'];
	$guesses=$_SESSION['guesses'];

	$act=$_POST['action'];
	
	if (!$linenumber ||$act=='Play Again?')
		$linenumber=0;
			
	if ($act=='Next Phrase')
	{
		$visible=array();//array is telling the letters to be invisible or empty.
		$linenumber++;
		$wrongs=0;
		
		if ($linenumber>=4)
		{
			print "No more phrases";
			print "<input type='submit' name='action' value='Play Again?'>";
			exit;
		}
	}
		
	$phrase=$list[$linenumber];
	print"phrase=$phrase";
	$letters=str_split($phrase);
	
	$letterlength=count($letters);

	print "ACT=$act <br  />";
	
	
	if (!$act || ($act=='Play Again?'))
	{
		logprint("noact",1);
		$visible=array(0,0,0,0,0,0,0,0); // 8 cells; ignore first one.
		$guesses=6;
		$linenumber= 0;
		$wrongs=0;
	} # initialization block
	
	else if ($act=="Reveal")
	{
		for ($i=0; $i<=$letterlength-1; $i++)
			$visible[$i]=1;
			
		//print "we did REVEAL!";
	
	}
	
	
	else //the guess case
	{ // main repeated action. Get a guessletter, scan the array.
		$guessletter=strtoupper($_POST['guessletter']); // a-> A, etc. uppecase
		
		$hit=0;
		
		for ($i=0; $i<=$letterlength; $i++)
		{
			
			if ($guessletter==$letters[$i])
			{
				$visible[$i]=1;
				$hit=1;
			}
		}
	
		if (!$hit)
			$wrongs++;
				
	} #repeated action block
	
	

	print "<h1>wrongs=$wrongs</h1>";
	$filename="hangman_$wrongs".".gif";
	print "<IMG SRC='$filename'>";
	
/*

//Picture is going to display every time a person gets it wrong the hangman will pop up until max number is reached.
for ($c=0; $c<$len_alpha; $c++)
  {
    if (strstr($list, $alpha[$c]))
    {
      if (strstr($words[$n], $alpha[$c])) {$links .= "\n<B>$alpha[$c]</B> "; }
      else { $links .= "\n<FONT color=\"purple\">$alpha[$c] </font>"; $wrong++; }
    }
    else
    { $links .= "\n<A HREF=\"$self?letters=$alpha[$c]$letters&n=$n\">$alpha[$c]</A> "; }
  }
  $nwrong=$wrong; if ($nwrong>6) $nwrong=6;
  print "\n<p><BR>\n<" ALIGN=\"middle\" BORDER=0 WIDTH=120 HEIGHT=120 ALT=\"Wrong: $wrong out of $max\">\n";	
*/

	
	
	



	display($visible,$letters);
	drawinputscreen($guesses);
	
	display($alpha);
		
	$_SESSION['wrongs']=$wrongs;
	$_SESSION['linenumber']=$linenumber;
	$_SESSION['visible']=$visible;
	$_SESSION['guesses']=$guesses;
?>

<body>
</body>
</html>