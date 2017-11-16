<!DOCTYPE html>
<!--
Assignment 08
Group 7
Author: James Hare/ Caleb Ooten
CPSC 3220
Professor Schwab
Nov 21, 2017.
-->
<html>
    <head>
        <title>Add Employee</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            html {
                background:  linear-gradient(to right, lightgrey , lightskyblue);
            }
			h1 {
				font-family: Calibri, Arial, Helvetica;
			}
			table, tr, {
				padding: 5px;
			}
			table {
				border-spacing: 10px;
				border: 1px;
			}
        </style>
    </head>
    
    <body>
		<center>
		<h1>Add an Employee</h1>
		<?php
		/**
		 * Created by PhpStorm.
		 * User: ceooten
		 * Date: 11/15/17
		 * Time: 11:14 AM
		 */
		$address = $_POST['address'];
		$city_id = $_POST['city_id'];
		$district = $_POST['district'];
		$postalcode = $_POST['postalcode'];
		$phone = $_POST['phone'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$store_id = $_POST['store_id'];
		$host="127.0.0.1";
		$port=3306;
		$socket="";
		$user="root";
		$password="";
		$dbname="";
		$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
		or die ('Could not connect to the database server' . mysqli_connect_error());
		$sql = "INSERT INTO sakila.address (address, city_id, district, postal_code, phone) VALUES ('$address', '$city_id', '$district', '$postalcode', '$phone')";
		if ($con->query($sql) === TRUE) {
			echo "Employee data successfully added to address table.";
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}
		?>
		<br>
		<?php
		$result = mysqli_query($con, 'SELECT MAX(address_id) FROM sakila.address');
		$row = mysqli_fetch_row($result);
		$sql2 = "INSERT INTO sakila.staff (first_name, last_name, address_id, email, store_id) VALUES ('$firstname', '$lastname', '$row[0]', '$email', '$store_id')";
		if ($con->query($sql2) === TRUE) {
			echo "Employee data successfully added to staff table.";
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}
		$con->close();
		?>
		</br> </br>
		<input type="button" value="Go Back" onclick="window.location.href='manager.html'">
		</br>
		</center>
    </body>
  
</html>
