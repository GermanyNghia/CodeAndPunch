<?php

use function PHPSTORM_META\type;

session_start();
include("authentication.php");
include("student_restrict.php");
// Retrieve the selected student's information from the database
include("registerDB.php");

if (isset($_GET['id'])) {
    $id= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    $query = "SELECT * FROM students WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
}

// Display the form to edit the student's information
if (isset($student)) {
?><header>
    <link rel="stylesheet" href="default.css">
</header>
<h1>Edit Student </h1>
    <form method="POST" action="editstudent.php?id=<?php echo $id; ?>">
    <label>Student's name:</label> <br>
        <input type="text" name="student_name" value="<?php echo $student['student_name']; ?>">
        <br>
        <label>Student's email:</label> <br>
        <input type="text" name="student_email" value="<?php echo $student['student_email']; ?>">
        <br>
        <label>Student's class:</label> <br>
		<input type="text" name="student_class" value="<?php echo $student['student_class']; ?>">
		<br>
        <label>Student's ID:</label> <br>
        <input type="text" name="student_ID" value="<?php echo $student['student_ID']; ?>">
        <br>
        <label>Student's phone number:</label> <br>
        <input type="text" name="phone_num" value="<?php echo $student['phone_num']; ?>">
        <br>
        <input type="submit" name="submit" value="Update">
    </form>
<?php
}

// Handle form submission to update the student's information
if (isset($_POST['submit'])) {
    $name = $_POST['student_name'];
    $email = $_POST['student_email'];
	$class = $_POST['student_class'];
	$ID = $_POST['student_ID'];
    $phone = $_POST['phone_num'];
    $query = "UPDATE students SET student_name='$name', student_email='$email', student_class='$class', 
	student_ID='$ID' ,phone_num='$phone' WHERE id = $id";
    mysqli_query($connect, $query);
    header("Location: studentList.php");
    mysqli_stmt_close($stmt);
mysqli_close($connect);
}
?>