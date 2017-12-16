<html><head><title>Simple Address Book Example</title>
</head>
<body><form method='post'>
<?php
// Simple Address Book Application Example - Level 1
//	DIG 3134 - Fall 2013 - Moshell

	function  showlist($mysqli,$assign='')
    {
		if ($assign)
    		$myquery="SELECT * FROM task_maker WHERE assign-date LIKE '$assign%'";
		else
    		$myquery="SELECT * FROM project4";
	
	    $result=$mysqli->query($myquery)
			or die ($mysqli->error); 
	
		$count=$result->num_rows;
	
		if($count > 0)
		{	$output="<table border=1>";
			$rownumber=0;
			while ($row=$result->fetch_assoc())
			{	
				$personid=$row['tasknumber'];
				$assigndate=$row['assign-date'];
				$duedate=$row['due-date'];
				$priority=$row['priority'];
				$course=$row['course'];
				$prof=$row['prof'];
				$title=$row['title'];
				$description=$row['description'];
			
				$output.= "<tr><td align='center'>$personid</td><td>$assign-date</td><td> $due-date</td><td>$priority</td><td>$course</td><td>$prof</td><td>$title</td><td>$description</td></tr>";
			}
			$output.= "</table> <br />";
			print $output;
		} #count
		else print "There are no tasks in the list.<br />";
	} #showlist
	
	function drawinputs()
	{
		print "<input type='text' name='assign-date'>Assign-Date <br />
				<input type='text' name='due-date'>Due-Date<br />
				<input type='text' name='priority'>Priority <br />
				<input type='text' name='course'>Course <br />
				<input type='text' name='prof'>Prof<br />
				<input type='text' name='title'>Title <br />
				<input type='text' name='description'>Description <br />
				<input type='text' name='delsel'>Pick number you want to delete<br />
				<input type='submit' name='action' value='Add Person'> <br /><br />
				<input type='submit' name='action' value='Delete Person'> <br /><br />
				Filter the displayed list. Only display people with last names that begin with this string:
				<br />
				<input type='text' name='matchlast'>
				<br />
				<input type='submit' name='action' value='Filter List'><br />
				";
	} # drawinputs
	
	function addperson($mysqli)
	{
		$assigndateX=$_POST['assign-date'];
		$duedateX=$_POST['due-date'];
		$priorityX=$_POST['priority'];
		$courseX=$_POST['course'];
		$profX=$_POST['prof'];
		$titleX=$_POST['title'];
		$descriptionX=$_POST['description'];
		
		// ESSENTIAL cleaning to avoid SQL Injectin Attack
		$assigndate=$mysqli->real_escape_string($assigndateX);
		$duedate=$mysqli->real_escape_string($duedateX);
		$priority=$mysqli->real_escape_string($priorityX);
		$course=$mysqli->real_escape_string($courseX);
		$prof=$mysqli->real_escape_string($profX);
		$title=$mysqli->real_escape_string($titleX);
		$desciption=$mysqli->real_escape_string($descriptionX);
		
		// The 'null' in the VALUES list allows the auto-incrementing idnumber to work
		$query="INSERT INTO project4 VALUES (null,'$assign-date','$due-date','$priority', '$course', '$prof', '$title', '$description')";

		$result=$mysqli->query($query)
			or die ($mysqli->error); 
	} #addperson
	
	// STARTER item for deleteperson function
	function deleteperson($mysqli)
	{
		$deleteselectorX=$_POST['delsel'];
		$deletselector=$mysqli->real_escape_string($deleteselectorX);
		// hint: query will look sort of like this:
		 $q="DELETE FROM project4 WHERE tasknumber=$deletselector";
		 
		 $result=$mysqli->query($q)
			or die ($mysqli->error); 
		
		// hint 2: If you use a text input box for the 
		// ID number, protect it against SQL INJECTION!
	}
	
    // MAIN PROGRAM
    	
// Create the mysqli object

	$mysqli = new mysqli("localhost", 'bratprincess', 
			'heaven20', 'task_maker');
            
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

    print "<h2>Task Maker Project 4</h2>";
    
	$act=$_POST['action'];
	
	if ($act=='Add Person')
	{
		addperson($mysqli);	
		showlist($mysqli);
	}
	
	else if ($act=='Delete Person')
	{
		deleteperson($mysqli);	
		showlist($mysqli);
	}
	
	else if ($act=='Filter List')
	{
		$matchlastX=$_POST['matchlast'];
		$matchlast=$mysqli->real_escape_string($matchlastX);
		showlist($mysqli,$matchlast);
	}
	else // Startup case; no action, so just show list.
	
		showlist($mysqli);
	
	// In all cases:
	drawinputs();
	
?>
</form>
</body>
</html>

