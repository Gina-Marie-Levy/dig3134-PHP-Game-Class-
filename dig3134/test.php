<?php  
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Project 1 Starter Kit</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #42413C;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}
/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ this fixed width container surrounds the other divs ~~ */
.container {
	width: 960px;
	background-color: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background-color: #ADB96E;
}

/* ~~ This is the layout information. ~~ 

1) Padding is only placed on the top and/or bottom of the div. The elements within this div have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

*/

.content {

	padding: 10px 0;
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background-color: #ADB96E;
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style></head>

<body>

<div class="container">
  <div class="header"><a href="#"><img src="" alt="Insert Logo Here" name="Insert_logo" width="180" height="90" id="Insert_logo" style="backgroun-color: #C6D580; display: block; color: #ADB96E;" /></a> 
    <!-- end .header --></div>
  <div class="content">

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
	

	print "<h2><center><strong>Acey Deucy Game.</strong><center></h2>";
	print "<p><center>Bet if the next card falls inbetween the 2 cards shown.<center></p>";

				
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
		print "<h2><center><img src='win.gif'><center></h2>"; 			
		print "<br /><center>Would you like to play again?<center>"; 		
	} 		
	else 		
	{ 			
		print "<h2><center><img src='lose.gif'><center></h2>";
		print "<br /><center>Would you like to play again?<center>";
	}
	
		print "<input type='submit' name='dowhat' value='Yes'>"; 		
		print "<input type='submit' name='dowhat' value='No'>";
		print "<input type='submit' name='dowhat' value='Next Draw'>";
			
}

else 		
		print "<center>Error 100: nextaction=$nextaction, but I don't know what to do.<center>"; 
?> 
</form> 
</body> 
</html> 


    <!-- end .content --></div>
  <div class="footer">
    
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>