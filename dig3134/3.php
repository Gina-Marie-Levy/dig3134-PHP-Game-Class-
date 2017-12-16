<?php

$age['Mary']=89;
$age['Elizabeth']=14;
$age['John']=42;

$person='Sam';

for($i=1; $i<=4; $i++)
{
$who=$age[$person];
if ($i<=4)
	print "$person is".$age[$person]." years old. <br />";
else
	print "I don't know $person's age. <br />";
}

?>