<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<pre>&lt;?php  
session_start();
?&gt;

&lt;!DOCTYPE html PUBLIC &quot;-//W3C//DTD XHTML 1.0 Transitional//EN&quot; &quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd&quot;&gt;

&lt;html xmlns=&quot;http://www.w3.org/1999/xhtml&quot;&gt;

&lt;head&gt; 
&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=UTF-8&quot; /&gt; 
&lt;title&gt;Project 1 Starter Kit&lt;/title&gt; 
&lt;/head&gt;

&lt;body&gt; 
&lt;form method='post'&gt;

&lt;?php 
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
	$target=rand(1,100);
	$_SESSION['targetvalue']=$target; // so we will have it later
	
	print &quot;&lt;p&gt;This is a number guessing game.&lt;/p&gt;&quot;;
	print &quot;&lt;p&gt;We will cheat to make it easier for you, &quot;.
		&quot;by printing out the number you are trying to guess.&lt;/p&gt;&quot;;
	print &quot;&lt;p&gt;target=$target. Enter your first guess (an integer between 1-100, inclusive.)&lt;br /&gt;&quot;;
	print &quot;&lt;input type='text' name='guessvalue'&gt; &lt;br /&gt;&quot;;

	print &quot;&lt;input type='submit' name='dowhat' value='GUESS'&gt;&quot;; 		
	print &quot;&lt;input type='submit' name='dowhat' value='GIVE UP'&gt;&quot;; 		
	print &quot;&lt;input type='submit' name='dowhat' value='JUNK BUTTON'&gt;&quot;; 

} 	 	
else if ($nextaction==&quot;GIVE UP&quot;) 	
{ 		
	print &quot;Quitter!&quot;; 		
	exit; // so as not to draw buttons any more. 	
} 	
else if ($nextaction==&quot;GUESS&quot;) 	
{
	#################### 		
	# SCREEN TWO 		
	####################

	$guess=$_POST['guessvalue']; 		
	$target=$_SESSION['targetvalue']; 				 		
	if ($target==$guess)

	{ 			
		print &quot;You got it! Yaa hoo!&quot;; 			
		exit;// we're done 		
	} 		
	else 		
	{ 			
		if ($target&gt;$guess) 				
			print &quot;Too low.&quot;; 			
		else 				
			print &quot;too high.&quot;; 				 			
		
		print &quot;Enter your next guess (1-100)&lt;br /&gt;&quot;; 			
		print &quot;&lt;input type='text' name='guessvalue'&gt;&lt;br /&gt;&quot;; 		
}


		print &quot;&lt;input type='submit' name='dowhat' value='GUESS'&gt;&quot;; 		
		print &quot;&lt;input type='submit' name='dowhat' value='GIVE UP'&gt;&quot;;

} 	
else 		
		print &quot;Error 100: nextaction=$nextaction, but I don't know what to do.&quot;; 
?&gt; 
&lt;/form&gt; 
&lt;/body&gt; 
&lt;/html&gt; </pre>
</body>
</html>