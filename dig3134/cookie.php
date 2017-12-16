<?php 

	// The first cookie example for DIG 3134
	// Spring 2011 - Moshell
	
	#printheader: make the standard HTML header
	function printheader()
	{
		print ' <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 		
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
		print "<title>Moshell's First Cookie Example</title>";
		print "</head><body><form method='post'>";

	}
	
	#printfooter:Wrap up the page
	function printfooter()
	{
		print "</form></body></html>";
	}
	
	#makeform1:
	function makeform1($who)
	{
		printheader();
		print "Welcome back, $who! How can we help?";
		print "<input type='submit' name='nextstep' value='Buy Stuff'>";
		print "<input type='submit' name='nextstep' value='Return Stuff'>";
		printfooter();
	}
	
		#makeform1:
	function makeform2()
	{
		printheader();
		print "Welcome to our store! Please enter your name.";
		print "<input type='text' name='namevalue'>";
		print "<input type='submit' name='nextstep' value='Continue'>";
		printfooter();
	}
		
		#makeform1:
	function makeform3()
	{
		printheader();
		print "How can we help?";
		print "<input type='submit' name='nextstep' value='Buy Stuff'>";
		print "<input type='submit' name='nextstep' value='Return Stuff'>";
		printfooter();
	}
	
	// MAIN PROGRAM BEGINS HERE
	// NOTE: setcookie MUST occur before any other output.
	// That's why we use functions makeform1, 2, 3 and call
	// makeform3 AFTER the setcookie.
	
   $namec=$_COOKIE['namecookie'];
   if ($namec)
       makeform1 ($namec);
   else
  {   $namev=$_POST['namevalue'];
       if (!$namev)
			makeform2( ); // ask for name
       else
       {    // time() is unix time, seconds since Jan 1,1970
	   		// (seconds/minute)*(minutes/hour)*(hours/day)* days wanted
	   		$untiltime=time()+60*60*24*7;
 			setcookie('namecookie', $namev, $untiltime);
			makeform3(); //
        }
   }?>
   
  
