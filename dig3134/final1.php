<?php
	session_start();
    
print '
	  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Battleship - Starter Kit</title>';
	
	
$age['Mary']=89;
$age['Elizabeth']=14;
$age['John']=42;

$person='Sam';
    

if ($age[$person]>0)
	print "$person is." $age[$person]." years old.";
else
	print "I don't know $person's age.";
?>
 
 </body>
</html>   
