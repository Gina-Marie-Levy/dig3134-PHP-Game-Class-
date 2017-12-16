<?php

$k=1;
if($k>5)
	$n=$k-4;
else
	$n=$k+1;
    
$textarray=file('mystery.txt');
$q=$textarray[$n];
print "The next person of the USA will be $q.";
?>