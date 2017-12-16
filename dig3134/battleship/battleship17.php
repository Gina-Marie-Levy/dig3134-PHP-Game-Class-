<?php
	session_start();
	
// STARTER KIT for Battleship Project - DIG 3134 - Fall 2012 - Moshell

$Gridsize=10;
$water='"img/water.png"';
$missed='"img/missed.png"';
$hitblack='"img/hitblack.png"';
$hitblack2='"img/hitblack2.png"';
$hitblack3='"img/hitblack3.png"';
$hitgold='"img/hitgold.png"';
$hitgold2='"img/hitgold2.png"';
$hitgold3='"img/hitgold3.png"';
$gold='"img/gold.jpg"';
$black='"img/black.jpg"';
$lightblue='"img/lightblue.jpg"';
$darkblue='"img/darkblue.jpg"';

$hitsound='"img/explosion.wav"';

$Cellwidth=350/$Gridsize;

//print "Gina $Cellwidth"; 

//#numtochar: maps 1 to A, 2 to B, etc.

#countcolor: returns the number of a given color that was found in grid 
function countcolor ($color) 
{	global $Grid, $Gridsize; 	
$colorcount=0; 	
for ($y=1; $y<=$Gridsize; $y++) 
{ 		
for ($x=1; $x<=$Gridsize; $x++) 		
{ 
	//$thiscolor=$Grid[$x][$y];
	//print "x=$x, y=$y, thiscolor=$thiscolor, color=$color <br />";
				
if ($Grid[$x][$y]==$color) 				
	$colorcount++; 	
} # x loop 	
} # y loop 	 	
return $colorcount; 
} #countcolor

 
function numtochar($numin) 
{
 	$numa=ord('A'); 	
	//we want numin=1 to produce chr('A'), so 	
	$numout=$numa+$numin-1;
	 //  now if numin=1, numout = chr('A') 	
	$charout=chr($numout);  
	//  and if numin=2, numout = chr('B') etc. 	
	return $charout; 
} #numtochar 

//#chartonum: maps A to 1, B to 2, etc. 
function chartonum($charin) 
{
	$cu=strtoupper($charin); //"character upper"
 	$numa=ord('A'); 		//	we want charin='A' to produce 1, so 	
	$numin=ord($cu); 	//	we want num=1 to produce A, so: 	
	$numout=$numin-$numa+1; //  now if numin=1, numout = chr('A') 	
return $numout; 
} #chartonum 
 


function makeheader()
{ global $Cellwidth;

	print '
	  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Battleship - Starter Kit</title>';


print "	<style type='text/css'>
			.mtable td 
			{
				width:$Cellwidth"."px; height:$Cellwidth"."px;
				color:WHITE
			}
			

body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: skyblue;
	background-image:url('img/background.png');
	background-repeat:no-repeat;
	background-position:right center;
	margin: 0;
	padding: 0;
	color: #000;
}



		</style>";

print '</head>
<body><form method="post">
';
} # makeheader
function preparegrid()
{global $Grid, $Gridsize,$lightblue,$darkblue;

	for ($y=0; $y<=$Gridsize+1; $y++)
	{
		for ($x=0; $x<=$Gridsize+1; $x++)
		{
			if ($x==0) // left margin
			{
				$Grid[$x][$y]=$darkblue;
			}
			else if ($y==0) // top margin
			{
				$Grid[$x][$y]=$darkblue;
			}
			else if (($x==$Gridsize+1)||($y==$Gridsize+1))
			{	// right margin and bottom margin
				$Grid[$x][$y]=$darkblue;
			}
			else	// fill the dude with white!
				$Grid[$x][$y]=$lightblue;
				
		} # x loop
	} # y loop
} # preparegrid

function prepareships()
{global $Ships, $Gridsize,$missed, $hitblack,$hitblack2,$hitblack3, $hitgold,$hitgold2,$hitgold3;

	for ($y=1; $y<=$Gridsize; $y++)
	{
		for ($x=1; $x<=$Gridsize; $x++)
		{
			$Ships[$x][$y]=$missed;
		} # x loop
	} # y loop
	
// Plant the Black Ship
	//$y=1;
	//for ($x=1; $x<=5; $x++)
		//$Ships[$x][$y]=$hitblack;

//Cruiser	
	$y=7;
	for ($x=4; $x<=7; $x++)
		$Ships[$x][$y]=$hitblack2;

//Battleship
	$x=10;
	for ($y=4; $y<=8; $y++)
		$Ships[$x][$y]=$hitblack3;

//Destroyer
	$x=1;
	for ($y=8; $y<=10; $y++)
		$Ships[$x][$y]=$hitblack;
	
// Plant the Gold Ship
	//$y=1;
	//for ($x=6; $x<=10; $x++)
		//$Ships[$x][$y]=$hitgold;
		
//Battleship
	$y=2;
	for ($x=4; $x<=8; $x++)
		$Ships[$x][$y]=$hitgold3;
		
//Destroyer
	$y=5;
	for ($x=2; $x<=4; $x++)
		$Ships[$x][$y]=$hitgold;
		
//Cruiser
	$y=3;
	for ($x=5; $x<=8; $x++)
		$Ships[$x][$y]=$hitgold2;
		
		

} # prepareships

function drawgrid()
{global $Grid,$Gridsize;

	$result='<table class="mtable">';
	for ($y=0; $y<=$Gridsize+1; $y++)
	{
		$result.="<tr>";
		for ($x=0; $x<=$Gridsize+1; $x++)
		{
			if ($x==0) $char=$y; 	   // numbers down the left (Y) axis
			else if ($y==0) $char=numtochar($x);  // numbers across the top (X) axis
			else $char="&nbsp;";	   // nonblank space everywhere else
			
			$color=$Grid[$x][$y];
			$result.="<td align='center' style='background-image:url($color)'>$char</td>";
		} # x loop
		$result.="</tr>";
	} # y loop
	$result.="</table>";
	print $result;
} #drawgrid

function drawinputs($player)
{
	print "<p>Coordinates position:<input type='text' size=2 name='xyinput'><br />";
	
	
	if ($player=="Gold")
	print "<input type='submit' name='action' value='Gold, Drop a Bomb'>";
	else
	print "<input type='submit' name='action' value='Black, Drop a Bomb'>";
	
	
	
	print "<input type='submit' name='action' value='Clear'>";
		
		
		
}

/////// MAIN PROGRAM ///////
	makeheader();
	$action=$_POST['action'];
	$player=$_SESSION['Player'];
	$bdsunk=$_SESSION['bdsunk'];
	$bcrsunk=$_SESSION['bcrsunk'];
	$bbsunk=$_SESSION['bbsunk'];
	$gdsunk=$_SESSION['gdsunk'];
	$gcrsunk=$_SESSION['gcrsunk'];
	$gbsunk=$_SESSION['gbsunk'];

	
	print "player=$player<br />";
		
	print "$player's turn to Drop a Bomb!";
	
	print "action=$action";
	
	if ((!$action)||($action=='Clear')||($action=='Play Again?'))
	{
		preparegrid();
		prepareships();
		$bdsunk=0;
		$bcrsunk=0;
		$bbsunk=0;
		$gdsunk=0;
		$gcrsunk=0;
		$gbsunk=0;
		
	}
	else if ($action=='Black, Drop a Bomb'|| $action=='Gold, Drop a Bomb')
	{
		$Grid=$_SESSION['Grid'];
		$Ships=$_SESSION['Ships'];
		
		$xy=$_POST['xyinput'];
		$xc=substr($xy, 0, 1);
		$x=chartonum($xc);
		$y=substr($xy, 1, 2);
		
		if($y>10||$y<1||$x>10||$x<1)
		print "You can't bomb there, pick another coordinate.";
		else
		{
			if($player=="Black")
				$player="Gold";
			else
				$player="Black";
			
			$Grid[$x][$y]=$Ships[$x][$y];
		}
			
		
			
	}
	else
		print "Unknown action:$action";
		
	// No matter what happens above, we always draw the grid and the
	// input controls.
	
	$bbscount=countcolor($hitblack3);
	$bcrcount=countcolor($hitblack2);
	$bdscount=countcolor($hitblack);
	
	//print "I see $blackcount black squares.";
	
	if ($bbscount==5 &&!$bbsunk)
	{
	print "Black's Battleship is sunk!";
	$bbsunk=1;	
	}
	
	if ($bcrcount==4 &&!$bcrsunk)
	{
	print "Black's Cruiser is sunk!";
	$bcrsunk=1;	
	}
	
	if ($bdscount==3 &&!$bdsunk)
	{
	print "Black's Destroyer is sunk!";
	$bdsunk=1;	
	}
	
	if ($bdsunk && $bbsunk && $bcrsunk)
		{
		print "<br /> Gold Won!";
		
		print "<input type='submit' name='action' value='Play Again?'> <br />";
		}

	
	$gbscount=countcolor($hitgold3);
	$gcrcount=countcolor($hitgold2);
	$gdscount=countcolor($hitgold);
	
	//print "I see $goldcount gold squares.";
	
	if ($gbscount==5 &&!$gbsunk)
	{
	print "Gold's Battleship is sunk!";
	$gbsunk=1;	
	}
	
	if ($gcrcount==4 &&!$gcrsunk)
	{
	print "Gold's Cruiser is sunk!";
	$gcrsunk=1;	
	}
	
	if ($gdscount==3 &&!$gdsunk)
	{
	print "Gold's Destroyer is sunk!";
	$gdsunk=1;	
	}
	
		
	if ($gdsunk && $gbsunk && $gcrsunk)
		{
		print "<br /> Black Won!";
		
		print "<input type='submit' name='action' value='Play Again?'><br />";
		}

	drawgrid();
	drawinputs($player);
	
	$_SESSION['Grid']=$Grid;
	$_SESSION['Ships']=$Ships;
	$_SESSION['Player']=$player;
	$_SESSION['bdsunk']=$bdsunk;
	$_SESSION['bbsunk']=$bbsunk;
	$_SESSION['bcrsunk']=$bcrsunk;
	$_SESSION['gdsunk']=$gdsunk;
	$_SESSION['gbsunk']=$gbsunk;
	$_SESSION['gcrsunk']=$gcrsunk;
	
	
	
?>
</form>
</body>
</html>
