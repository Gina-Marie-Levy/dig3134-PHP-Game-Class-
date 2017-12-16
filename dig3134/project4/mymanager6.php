<html><head><title>Task Maker Project 4</title>
</head>
<body><form method='post'>
<?php
// Simple Address Book Application Example - Level 1
//	DIG 3134 - Fall 2013 - Moshell

	function  showlist($mysqli,$lastX='')
    {
		$courseX=$_POST['courseek'];
		if ($courseX)
		{
			$course=$mysqli->real_escape_string($courseX);
			// hint: query will look sort of like this:
		 	$myquery="SELECT * FROM project4 WHERE course='$course'";
	
		}
		else if ($lastX)
		{
			$last=$mysqli->real_escape_string($lastX);
    		$myquery="SELECT * FROM project4 WHERE prof LIKE '$last%'";
		}
		else if (something)
		
	    	$myquery="SELECT * FROM project4 ORDER BY prof";
	
		else (something else)

	    	$myquery="SELECT * FROM project4 ORDER BY duedate";
		
		else
		
			$myquery="SELECT * FROM project4";

	    $result=$mysqli->query($myquery)
			or die ($mysqli->error); 
	
		$count=$result->num_rows;
	
		if($count > 0)
		{	$output="<table border=1>";
			$rownumber=0;
			$output.= "<tr><td align='center'></td><td>Assignment Date</td><td> Due Date </td><td>Priority</td><td>Course</td><td>Professor</td><td>Title of Assignment</td><td>Description</td></tr>";
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
				
				$radio="<input type='radio' name='delsel' value=$personid>";
			
				$output.= "<tr><td align='center'>$radio</td><td>$assigndate</td><td> $duedate</td><td>$priority</td><td>$course</td><td>$prof</td><td>$title</td><td>$description</td></tr>";
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
				<input type='submit' name='action' value='Add Person'> <br /><br />
				<input type='submit' name='action' value='Delete Person'> <br /><br />
				<input type='submit' name='action' value='Edit Record'> <br /><br />
				Filter the displayed list. Only display people with last names that begin with this string:
				<br />
				<input type='text' name='courseek'> Course to Seek:
				<br />
				<input type='submit' name='action' value='Filter List'><br />
				<input type='submit' name='action' value='Refresh'><br />
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
		$description=$mysqli->real_escape_string($descriptionX);
		
		// The 'null' in the VALUES list allows the auto-incrementing idnumber to work
		$query="INSERT INTO project4 VALUES (null,'$assigndate','$duedate','$priority', '$course', '$prof', '$title', '$description')";

// print "ADDPERSON: insertion query=$query";

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
	// STARTER item for deleteperson function
	function saverecord($mysqli)
	{
		$editrecordX=$_POST['editrecord'];
		$assigndateX=$_POST['assign-date'];
		$duedateX=$_POST['due-date'];
		$priorityX=$_POST['priority'];
		$courseX=$_POST['course'];
		$profX=$_POST['prof'];
		$titleX=$_POST['title'];
		$descriptionX=$_POST['description'];
		
		// ESSENTIAL cleaning to avoid SQL Injectin Attack
		$editrecord=$mysqli->real_escape_string($editrecordX);
		$assigndate=$mysqli->real_escape_string($assigndateX);
		$duedate=$mysqli->real_escape_string($duedateX);
		$priority=$mysqli->real_escape_string($priorityX);
		$course=$mysqli->real_escape_string($courseX);
		$prof=$mysqli->real_escape_string($profX);
		$title=$mysqli->real_escape_string($titleX);
		$description=$mysqli->real_escape_string($descriptionX);

		// hint: query will look sort of like this:
		/* $q="UPDATE project4 SET 'assign-date'='$assigndate', 'due-date'='$duedate', 
		 priority='$priority', course='$course', prof='$prof', title='$title', description='$description'
		WHERE tasknumber=$editrecord";
		 */
		 $q="INSERT INTO project4 VALUES (null,'$assigndate','$duedate','$priority', '$course', '$prof', '$title', '$description')";
	
	//print "SAVERECORD";
		 
		 $result=$mysqli->query($q)
			or die ($mysqli->error); 
			
		 $q="DELETE FROM project4 WHERE tasknumber=$editrecord";
		 
		 $result=$mysqli->query($q)
			or die ($mysqli->error); 
		
	}#saverecord
	
	function editrecord($mysqli)
	{
		$editrecordX=$_POST['delsel'];
		$editrecord=$mysqli->real_escape_string($editrecordX);
	
	//Step 1: SHOW the record we want to edit, in input-boxes
	    		$myquery="SELECT * FROM project4 WHERE tasknumber=$editrecord";
	
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
			
				$output.= "Personid=$personid <br />
				<input type='hidden' name='editrecord' value='$personid'>
				<input type='text' name='assign-date' value='$assigndate'> Assignment Date <br />
				<input type='text' name='due-date' value='$duedate'> Due Date <br />
				<input type='text' name='priority' value='$priority'> Priority <br />
				<input type='text' name='course' value='$course'> Course <br />
				<input type='text' name='prof' value='$prof'> Prof <br />
				<input type='text' name='title' value='$title'> Title <br />
				<input type='text' name='description' value='$description'> Description <br />";
				
			}
		} #count
		
	//Step 2: SHOW some buttons to either accept the changes, or 'cancel'
	// Button should say 'Save' or 'Cancel'
		
		$output.= "<input type='submit' name='action' value='Save'> <br />
				<input type='submit' name='action' value='Cancel'> <br />";
		print $output;
		exit;
		
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
	
	else if ($act=='Edit Record')
	{
		editrecord($mysqli);	
	}
	
	else if ($act=='Save')
	{
		saverecord($mysqli);	
		showlist($mysqli);
	}
	else if ($act=='Filter List')
	{
		$matchlastX=$_POST['matchlast'];
		$matchlast=$mysqli->real_escape_string($matchlastX);
		showlist($mysqli,$matchlast);
	}
	else // Startup case (or "Cancel" case); no action, so just show list.
	
		showlist($mysqli);
	
	// In all cases:
	drawinputs();
	
?>
</form>
</body>
</html>

