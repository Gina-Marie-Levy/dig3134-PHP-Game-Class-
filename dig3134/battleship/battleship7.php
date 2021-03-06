<?php
	session_start();
	
// STARTER KIT for Battleship Project - DIG 3134 - Fall 2012 - Moshell

$Gridsize=10;
$water='"img/water.png"';
$missed='"img/missed.png"';
$hitblack='"img/hitblack.png"';
$hitgold='"img/hitgold.png"';
$gold='"img/gold.jpg"';
$black='"img/black.jpg"';
$lightblue='"img/lightblue.jpg"';
$darkblue='"img/darkblue.jpg"';

$Cellwidth=350/$Gridsize;

//print "Gina $Cellwidth"; 

//#numtochar: maps 1 to A, 2 to B, etc. 
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
{global $Ships, $Gridsize,$missed, $hitblack,$hitgold;

	for ($y=1; $y<=$Gridsize; $y++)
	{
		for ($x=1; $x<=$Gridsize; $x++)
		{
			$Ships[$x][$y]=$missed;
		} # x loop
	} # y loop
	
	// Plant the Black Ship
	$y=1;
	for ($x=1; $x<=5; $x++)
		$Ships[$x][$y]=$hitblack;
	
	// Plant the Gold Ship
	$y=1;
	for ($x=6; $x<=10; $x++)
		$Ships[$x][$y]=$hitgold;

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
	
	//print "player=$player<br />";
	
	If($player=="Black")
		$player="Gold";
		
	else
		$player="Black";
		
	//print "$player's turn to Drop a Bomb!";
	
	//print "action=$action";
	
	if ((!$action)||($action=='Clear'))
	{
		preparegrid();
		prepareships();
	}
	else if ($action=='Black, Drop a Bomb'|| $action=='Gold, Drop a Bomb')
	{
		$Grid=$_SESSION['Grid'];
		$Ships=$_SESSION['Ships'];
		
		$xy=$_POST['xyinput'];
		$xc=substr($xy, 0, 1);
		$x=chartonum($xc);
		$y=substr($xy, 1, 2);

		$Grid[$x][$y]=$Ships[$x][$y];
	}
	else
		print "Unknown action:$action";
		
	// No matter what happens above, we always draw the grid and the
	// input controls.
	drawgrid();
	drawinputs($player);
	
	$_SESSION['Grid']=$Grid;
	$_SESSION['Ships']=$Ships;
	$_SESSION['Player']=$player;
	
?>
</form>
</body>
</html>
