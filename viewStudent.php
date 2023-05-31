<?php
session_start();
include("authentication.php");
// Include the database connection file
include("registerDB.php");


// Fetch data in descending order (lastest entry first)
$result = mysqli_query($connect, "SELECT * FROM students ORDER BY id ASC");
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>
	<h1>Student List</h1>
	<Button>
	<a href="addStudent.php">Add New Data</a>
	</Button>
	<button>
	<a href="home.php">Home</a>
	</button>	
	<table width='80%' border=0>
		<tr bgcolor='#DDDDDD'>
			<td><strong>ID</strong></td>
			<td><strong>Student's name</strong></td>
			<td><strong>Student's email</strong></td>
			<td><strong>Student's class</strong></td>
			<td><strong>Student's ID</strong></td>
			<td><strong>Student's phone Number</strong></td>
		</tr>
		<?php

		// Fetch the next row of a result set as an associative array
		while ($res = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>".$res['id']."</td>";
			
			echo "<td>".$res['student_name']."</td>";
			echo "<td>".$res['student_email']."</td>";
			echo "<td>".$res['student_class']."</td>";
			echo "<td>".$res['student_ID']."</td>";
            echo "<td>".$res['phone_num']."</td>";	
			
			echo "<td><a href=\"editStudent.php?id={$res['id']}\">Edit</a> | 
			<a href=\"deleteStudent.php?id={$res['id']}\" onClick=\"return confirm
			('Are you sure you want to delete?')\">Delete</a></td>";
			
		}
		?>
	</table>	 
</body>
</html>