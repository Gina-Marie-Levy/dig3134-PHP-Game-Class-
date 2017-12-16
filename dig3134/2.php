<?php

$age['Mary']=89;
$age['Elizabeth']=14;
$age['John']=42;

$person='Sam';

if($age[$person]<4)
	print "$person is".$age[$person]." years old.";
else
	print "I don't know $person's age.";

?>