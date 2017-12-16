<?php
	$names=array('duck','chicken','turkey', 'axolotl');
    $price=array(7,5,18,200);
    
print"<table>";
for($i=0;$i<=3;$i++)
{
	$item=$names[$i];
    $cost=$prices[$i];
    print"<tr><td><input type='radio' name='purchase'value='$i'>
    $item</td><td>$cost</td></tr>";
}
print "</table>";

?>