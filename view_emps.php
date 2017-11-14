<!DOCTYPE html>
<!--	Author: 	Jeremiah Roland
		Date:		November 14, 2017
		File:		view_emps.php
		Purpose: 	Assignment 8
-->
<html>
<head>
	<title>View Employees Page</title>
	<link rel ="stylesheet" type="text/css" href="HW8_CSS.css"> 
</head>
<body>
<?php
	$connect = mysqli_connect("localhost", "root", "", "sakila");
	//test if the connection can be made 
	if(!$connect)
	{
		die("ERROR: Can't connect to database");
	}
	$userQuery = "SELECT s.last_name, s.first_name, a.address, c.city, a.district, co.country, a.postal_code, s.email, a.phone
						FROM staff s
						INNER JOIN address a ON s.address_id = a.address_id
						INNER JOIN city c ON a.city_id = c.city_id 
						INNER JOIN country co ON c.country_id = co.country_id";
	$result = mysqli_query($connect, $userQuery); 
	mysqli_close($connect); 
	
	//tests for the results before processing them 
	if(!$result)
	{
		die("Couln't run query"); 
	}
	if(mysqli_num_rows($result) == 0)
	{
		print("No records were found with the query");
	}
	else
	{
		//process results 
		//use an associative array to extract the next record from the result
		//until no results are left 
		//$row is the associative array 
?> 
		<table>
		<table border = "2">
		<tr>
			<th>Last Name</th> <th>First Name</th> <th>Address</th> <th>City</th> <th>District</th> <th>Country</th> <th>Postal Code</th> 
			<th>Email</th> <th>Phone</th>
		</tr>
<?php 
		print("<h1>List of Employees</h1>"); 
		//each time the loop repeats, $row is assigned the next record in the result set 
		//as an associative array 
		while($row = mysqli_fetch_assoc($result))
		{
?> 
		<tr>
			<th><?php echo $row['first_name']?></th> <th><?php echo $row['last_name']?></th> <th><?php echo $row['address']?></th> 
			<th><?php echo $row['city']?></th> <th><?php echo $row['district']?></th> <th><?php echo $row['country']?></th> 
			<th><?php echo $row['postal_code']?></th> <th><?php echo $row['email']?></th> <th><?php echo $row['phone']?></th> 
		</tr> 
<?php 
		}
	}
?> 
		</table>
<?php 
			//give the user a link back to the start page 
		print("<p><a href =\"manager.html\">Return to Manager Page</a></p>")
?> 

</body>
</html> 
