<?php // welcomesess.php - Moshell's first session example

 session_start();

	// The first session example for DIG 3134
	// Spring 2011 - Moshell
	
	#printheader: make the standard HTML header
	function printheader()
	{
		print ' <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 		
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
		print "<title>Moshell's First Session Example</title>";
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
	
   $namesess=$_SESSION['namesession'];
   if ($namesess)
       makeform1 ($namesess);
   else
  {   $namev=$_POST['namevalue'];
       if (!$namev)
			makeform2( ); // ask for name
       else
       {   
 			$_SESSION['namesession']=$namev;
			makeform3(); //
        }
   }?>
   
######################################################
# worry.php - for exploring the 'isset' function.
#			
######################################################
   <?php 
 session_start();

	// The first session example for DIG 3134
	// Spring 2011 - Moshell
	
	#printheader: make the standard HTML header
	function printheader()
	{
		print ' <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 		
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
		print "<title>Worry.php: examining the 'isset' function</title>";
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
		print "Welcome to our isset example 'worry.php'! 
						Please enter your name.";
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
	$probe=$list[1];
	
   $namesess=$_SESSION['namesession'];
   
   if (isset($_SESSION['namesession']))
		print "The session variable 'namesession' is set. Its value is:".
			$_SESSION['namesession'].":<br />";
	
   if (isset($namesess))
   		print "the variable \$namesess is set. Its value is $namesess.";
		
   if ($namesess)
       makeform1 ($namesess);
   else
  {   $namev=$_POST['namevalue'];
       if (!$namev)
			makeform2( ); // ask for name
       else
       { 
 			$_SESSION['namesession']=$namev;
			makeform3(); //
        }
   }?>
   
########################################################

<?php // worryclear.php - just clears out the session variable.
 	session_start();
 	$_SESSION['namesession']='';
 ?>
