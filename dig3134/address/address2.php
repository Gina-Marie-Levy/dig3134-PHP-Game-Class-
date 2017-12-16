<html><head><title>Simple Address Book Example 3</title>
</head>
<body><form method='post'>
<?php
// Simple Address Book Application Example - Level 3
//	DIG 3134 - Fall 2013 - Moshell

	function  showlist($mysqli,$last='')
    {
		if ($last)
    		$myquery="SELECT * FROM addressbook WHERE lastname LIKE '$last%'";
		else
    		$myquery="SELECT * FROM addressbook";
	
	    $result=$mysqli->query($myquery)
			or die ($mysqli->error); 
	
		$count=$result->num_rows;
	
		if($count > 0)
		{	$output="<table border=1><tr><th></th><th>Last Name</th><th>First Name</th><th>Address</th></tr>";
			$rownumber=0;
			while ($row=$result->fetch_assoc())
			{	
				$personid=$row['idnumber'];
				$lastname=$row['lastname'];
				$firstname=$row['firstname'];
				$address=$row['address'];
						
				$output.= "<tr><td align='center'>$personid</td>			<td>$lastname</td><td>
						$firstname</td><td>$address</td></tr>";
			}
			$output.= "</table> <br />";
			
			// Now let the person select the item to be deleted
			
			print $output;
		} #count
		else print "There are no addresses in the list.<br />";
	} #showlist
	
	function drawinputs()
	{
		print "<input type='text' name='firstname'>First Name <br />
				<input type='text' name='lastname'>Last Name <br />
				<input type='text' name='address'>Address<br />
				<input type='submit' name='action' value='Add Person'> <br /><br />
				Filter the displayed list. Only display people with last names that begin with this string:
				<br />
				<input type='text' name='matchlast'>
				<br />
				<input type='submit' name='action' value='Filter List'><br /><br />
				
				<br />
				Item number to be deleted:<input type='text' name='delsel' size=2>
				
				<br />
				<input type='submit' name='action' value='Delete Person'><br />
				";
	} # drawinputs
	
	function addperson($mysqli)
	{
		$lastnameX=$_POST['lastname'];
		$firstnameX=$_POST['firstname'];
		$addressX=$_POST['address'];
		
		// ESSENTIAL cleaning to avoid SQL Injectin Attack
		$lastname=$mysqli->real_escape_string($lastnameX);
		$firstname=$mysqli->real_escape_string($firstnameX);
		$address=$mysqli->real_escape_string($addressX);
		
		// The 'null' in the VALUES list allows the auto-incrementing idnumber to work
		$query="INSERT INTO addressbook VALUES (null,'$lastname','$firstname','$address')";

		$result=$mysqli->query($query)
			or die ($mysqli->error); 
	} #addperson
	
	// STARTER item for deleteperson function
	function deleteperson($mysqli,$deletenumber)
	{		
		$query="DELETE FROM addressbook WHERE idnumber=$deletenumber";
		$result=$mysqli->query($query)
			or die ($mysqli->error); 
	}
	
    // MAIN PROGRAM
    	
// Create the mysqli object

	$mysqli = new mysqli("localhost", 'student', 
			'studentpass', 'address');
            
// Check for any errors. 

	$errnum=mysqli_connect_errno();
	if ($errnum) 
	{
     	$errmsg=mysqli_connect_error();
		print "Connect failed. error number=$errnum<br />
        		error message=$errmsg";    
		exit();
	}
	
// Now interact with the user

    print "<h2>Simple Address Book Example 3</h2>";
    
	$act=$_POST['action'];
	
	if ($act=='Add Person')
	{
		addperson($mysqli);	
		showlist($mysqli);
	}
	else if ($act=='Filter List')
	{
		$matchlastX=$_POST['matchlast'];
		$matchlast=$mysqli->real_escape_string($matchlastX);
		showlist($mysqli,$matchlast);
	}
	else if ($act=='Delete Person')
	{
		$deletenumberX=$_POST['delsel'];
		$deletenumber=$mysqli->real_escape_string($deletenumberX);
		deleteperson($mysqli,$deletenumber);
		showlist($mysqli);
	}
	else // Startup case; no action, so just show list.
	
		showlist($mysqli);
	
	// In all cases:
	drawinputs();
	
?>
</form>
</body>
</html>